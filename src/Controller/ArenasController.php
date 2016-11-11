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

      $this->set('title', 'Login');
      $this->loadModel('Players');
      $player = $this->Players->newEntity();

      if($this->request->is('post')){

        if (!isset($this->request->data['Confirmation'])){
          $data= $this->request->data;
          $res=$this->Players->find('all')->where(['Players.email' => $data['email']]);
          $res = $res->first();
          if($res['password'] == $data['password'] AND $res['email'] == $data['email']){
            $session = $this->request->session();

            $session->write([
              'Players.id' => $res['id'] ,
              'Players.email' => $res['email']
            ]);
            $this->Flash->success(__('The player has been loaded.'));
            return $this->redirect(['action' => 'index']);
          }else{
              $this->Flash->error(__('The player could not be loaded. Please, try again.'));
          }
        }
        else {
          $player = $this->Players->newEntity();
          $player = $this->Players->patchEntity($player, $this->request->data);
          if ($this->Players->save($player)) {
              $this->Flash->success(__('The player has been saved.'));

              return $this->redirect(['action' => 'index']);
          } else {
              $this->Flash->error(__('The player could not be saved. Please, try again.'));
          }

          $this->set(compact('player'));
          $this->set('_serialize', ['player']);

        }
      }
    }

    public function fighter()
    {

    }

    public function sight()
    {

        $this->loadModel('Fighters');

        $this->set('fighters', $this->Fighters->findLastEvents());
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
        $this->loadModel('Events');
        $this->set('events', $this->Events->findLastEvents());

    }
}
