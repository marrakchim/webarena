<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tools Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Fighters
 *
 * @method \App\Model\Entity\Tool get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tool newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Tool[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tool|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tool patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tool[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tool findOrCreate($search, callable $callback = null)
 */
class ToolsTable extends Table
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

        $this->table('tools');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Fighters', [
            'foreignKey' => 'fighter_id'
        ]);
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
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->integer('bonus')
            ->requirePresence('bonus', 'create')
            ->notEmpty('bonus');

        $validator
            ->integer('coordinate_x')
            ->allowEmpty('coordinate_x');

        $validator
            ->integer('coordinate_y')
            ->allowEmpty('coordinate_y');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['fighter_id'], 'Fighters'));

        return $rules;
    }
    
    public function initializeTool() {
        
        for($i=0;$i<8;$i++){
            $this->createTool();
        }
    }
    
    public function createTool()
    {
        $tool = $this->newEntity();
        
        $type = rand(0,2);
        
        switch($type) {
                
            case 0: $tool->type = 'sight';
                break;
            case 1: $tool->type = 'strength';
                break;
            case 2: $tool->type = 'life';
                break;
                
        }
        
        $tool->bonus = rand(1,3);
        $tool->coordinate_x = rand(0,14);
        $tool->coordinate_y = rand(0,9);
        
        $this->save($tool);
    }
      
    public function pickTool($toolId, $fighterId)
    {
        $tool = $this->get($toolId);
        
        $tool->fighter_id = $fighterId;
        
        return $this->save($tool);
    } 
    
    public function releaseFighterTools($fighterId)
    {
        $tools = $this->find()->where(['fighter_id' => $fighterId]);
        
        foreach($tools as $tool) {
            $tool->fighter_id = null;
        }
        
    }
}
