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
        $sessionUser = $this->request->session();

        if($sessionUser->read("Players.id") != null){
            $this->Flash->error(__('You are already connected.'));
            return $this->redirect(['controller'=>'arenas', 'action' => 'index']);

        } else {
            $this->render();
        }

        $this->set('title', 'Login');
        $this->loadModel('Players');
        $player = $this->Players->newEntity();

        $this->loadModel('Fighters');

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

            $selectedFighter = $this->Fighters->selectRandomFighter($res['id']);

            $session->write(['FighterSelected.id' => $selectedFighter->id]);

            return $this->redirect(['controller'=>'arenas', 'action' => 'sight']);
          }else{
              $this->Flash->error(__('The player could not be loaded. Please, try again.'));
          }
        }
        else {
          $player = $this->Players->newEntity();
          $player = $this->Players->patchEntity($player, $this->request->data);
          if ($this->Players->save($player)) {
              $this->Flash->success(__('The player has been saved.'));
              return $this->redirect(['action' => 'login']);
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
        $this->loadModel('Fighters');
        $playerId = $this->request->session()->read('Players.id');
        $fighters = $this->Fighters->find('all')->where(['player_id' => $playerId]);

        $session = $this->request->session();
        $selectedFighter = $session->read('FighterSelected.id');

        $this->set(compact('fighters','selectedFighter'));
        $this->set('_serialize', ['fighters']);
    }

    public function fighterAdd()
    {
        $this->loadModel('Fighters');
        $fighter = $this->Fighters->newEntity();

        if ($this->request->is('post')) {

            $res=$this->Fighters->createANewChampionFor($this->request->session()->read('Players.id'),$this->request->data['name']);

            if ($res) {
                $this->Flash->success(__('The fighter has been saved.'));
                return $this->redirect(['action' => 'fighter']);
            } else {
                $this->Flash->error(__('The fighter could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('fighter'));
        $this->set('_serialize', ['fighter']);
    }

    public function fighterView($fighterId)
    {
        $this->loadModel('Fighters');
        $fighter = $this->Fighters->get($fighterId);

        $this->set(compact('fighter'));
        $this->set('_serialize', ['fighter']);
    }

    public function fighterAvatar($fighterId)
    {
        $this->loadModel('Fighters');
        $fighter = $this->Fighters->get($fighterId);

        if ($this->request->is('post')) {

            $res=$this->Fighters->updateAvatar();

            if ($res) {
                $this->Flash->success(__('The fighter has been saved.'));
                return $this->redirect(['action' => 'fighter']);
            } else {
                $this->Flash->error(__('The fighter could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('fighter'));
        $this->set('_serialize', ['fighter']);
    }

    public function fighterSelect($id = null){

        if($id != null) {
            $session = $this->request->session();

            $session->write(['FighterSelected.id' => $id]);

            $this->Flash->success(__('The fighter has been selected.'));
            return $this->redirect(['controller' => 'arenas', 'action' => 'sight']);
        } else {
            $this->Flash->error(__('The fighter could not be selected. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function sight()
    {
        $this->loadModel('Fighters');

        $fighterSelectedId = $this->request->session()->read('FighterSelected.id');

        if ($fighterSelectedId != null) {

            $fighters = $this->paginate($this->Fighters);
            $playerId = $this->request->session()->read('Players.id');
            $fighters = $this->Fighters->find('all');
            $myFighter = $this->Fighters->find()->where(['id' => $fighterSelectedId])->first();
            $fighterX = $myFighter->coordinate_x;
            $fighterY = $myFighter->coordinate_y;
            $fighterSight = $myFighter->skill_sight;

            $fightersAround = array();

            foreach ($fighters as $fighter) {
                $x = $fighter->coordinate_x;
                $y = $fighter->coordinate_y;

                if(($fighterX + $fighterSight >= $x || $fighterX - $fighterSight <= $x) || ($fighterY + $fighterSight >= $y || $fighterY - $fighterSight <= $y)){
                    $visible = true;
                }
                else {
                    $visible = false;
                }
                //$visible = true;

                if(($visible && $fighter->player_id != $playerId) || ($fighter->id == $fighterSelectedId)){
                    $fightersAround[] = $fighter;
                }
            }
      }
      else {
          $this->Flash->error(__('You have to select a fighter to play.'));
          return $this->redirect(['controller' => 'fighters', 'action' => 'index']);
      }

        $session = $this->request->session();
        $selectedFighter = $this->Fighters->get($session->read('FighterSelected.id'));

        $this->set(compact('fightersAround','selectedFighter'));
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
