<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use Cake\I18n\Time;

/**
 * Events Model
 *
 * @method \App\Model\Entity\Event get($primaryKey, $options = [])
 * @method \App\Model\Entity\Event newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Event[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Event|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Event patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Event[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Event findOrCreate($search, callable $callback = null)
 */
class EventsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('events');
        $this->displayField('name');
        $this->primaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->integer('coordinate_x')
            ->requirePresence('coordinate_x', 'create')
            ->notEmpty('coordinate_x');

        $validator
            ->integer('coordinate_y')
            ->requirePresence('coordinate_y', 'create')
            ->notEmpty('coordinate_y');

        return $validator;
    }
    
    public function findLastEventsInSight($sight, $posX, $posY)
    {
        
        $events = $this->find('all', array(
            'conditions' => array(
                'Events.date BETWEEN NOW() -INTERVAL 1 DAY AND NOW()'),
            'order' => array('Events.date DESC'), ));
        
        $eventsInSight = array();
        
        foreach($events as $event)
        {
            if($sight >= abs($posX - $event->coordinate_x) + abs($posY - $event->coordinate_y))
            {
                $eventsInSight[] = $event;
            }
        }
        
        return $eventsInSight;
    }
    
    public function addNewEvent($eventName, $coord_x, $coord_y)
    {
        $event = $this->newEntity();
        
        $event->name = $eventName;
        
        $event->date = Time::now();
        
        $event->coordinate_x = $coord_x;
        $event->coordinate_y = $coord_y;
            
        $this->save($event);
    }
}
