<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\ORM\FightersTable;

/**
* Personal Controller
* User personal interface
*
*/
class ArenasController  extends AppController
{
    public function index()
    {
        $this->set('myname', "Julien Falconnet");
        /*
        $this->loadModel('Fighters');
        $figterlist=$this->Fighters->find('all');
        //pr($figterlist->toArray());

        foreach($figterlist as $figter) {
            $result = $figter->FightersTable::test();
            $this->set('myname', $result);
        }*/
    }

    public function login()
    {

    }

    public function fighter()
    {

    }

    public function sight()
    {

    }

    public function diary()
    {
        //$this->set('Events', $this->Events->find('all'));

        //$query = $events->find('all');

        /*$event = $this->Event->find('all', array(
            'conditions' => array(
                'Event.date BETWEEN NOW() -INTERVAL 1 DAY AND NOW()'),
            'order' => array('Event.date DESC'), ));*/

        //$this->set('events', $query);
    }



}
