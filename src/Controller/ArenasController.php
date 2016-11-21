<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\ORM\FightersTable;

use Cake\Utility\Hash;

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
            return $this->redirect(['controller'=>'Fighters', 'action' => 'index']);
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

    public function logout(){
      if($this->request->session() !== null){
        $this->request->session()->destroy();
        $this->Flash->success(__('You have been disconected.'));
        return $this->redirect([
          'controller' => 'arenas',
          'action' => 'index']);
      }else{
        $this->Flash->error(__('You could not be disconected. Please, try again.'));
      }
	  }

    public function fighter()
    {

    }

    public function sight()
    {

      if ($this->request->session()->read('FighterSelected.id') != null) {
        $this->loadModel('Fighters');
        $fighters = $this->paginate($this->Fighters);
        $playerId = $this->request->session()->read('Players.id');
        $myFighter = $this->request->session()->read('Fighter');
        $fighters = $this->Fighters->find('all')->where(['player_id !=' => $playerId]);

        $fightersAround = array();

        foreach ($fighters as $fighter) {
          $x = $fighter->coordinate_x;
          $y = $fighter->coordinate_y;

          if($x+$y > 4){
            $fightersAround[] = $fighter;
          }

        }

      }
      else {
        $this->Flash->error(__('You have to select a fighter to play.'));
        return $this->redirect(['controller' => 'fighters', 'action' => 'index']);

      }

      $this->set(compact('fightersAround'));
      $this->set('_serialize', ['fightersAround']);

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
