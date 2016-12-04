<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\ORM\FightersTable;

use Cake\Utility\Hash;

use Cake\I18n\Time;

use cake\Utility\Security;

use Cake\Filesystem\Folder;

/**
* Personal Controller
* User personal interface
*
*/
class ArenasController  extends AppController
{
    
    function checkConnexion() {
        
        $sessionUser = $this->request->session();
        
        //User not connected : go to login page
        if($sessionUser->read("Players.id") == null){
            $this->Flash->error(__('You have to log in to access to the page.'));
            return $this->redirect(['controller'=>'arenas', 'action' => 'login']);
        }
    }
    
    public function index()
    {

    }

    public function subscribe(){

      //if the visitor is already logged in, redirect him to the home page
      $sessionUser = $this->request->session();
      if($sessionUser->read("Players.id") != null){
          $this->Flash->error(__('You are already connected.'));
          return $this->redirect(['controller'=>'arenas', 'action' => 'index']);

      } else {
          $this->render();
      }

      $this->set('title', 'Subscribe');
      $this->loadModel('Players');
      $player = $this->Players->newEntity();

      $this->loadModel('Fighters');

      if($this->request->is('post')){

        if (isset($this->request->data['confirmation'])){

          $player = $this->Players->newEntity();
          $data=$this->request->data;
         if($data['password']==$data['confirmation']){
            $player = $this->Players->patchEntity($player, $this->request->data);
            $player->password =Security::hash($data['password']);
            if ($this->Players->save($player)) {
                $this->Fighters->createANewChampionFor($player->id,'Aragorn');
                $this->Flash->success(__('The player has been saved.'));
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('The player could not be saved. Please, try again.'));
            }
          }else{
          $this->Flash->error(__('Check your password and try again'));
          }

          $this->set(compact('player'));
          $this->set('_serialize', ['player']);

        }
    }
    }

    public function login()
    {
        //if the visitor is already logged in, redirect him to the home page
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

        if (isset($this->request->data['password'])){
          $data= $this->request->data;
          $res=$this->Players->find('all')->where(['Players.email' => $data['email']]);
          $res = $res->first();
          if($res['password'] == Security::hash($data['password']) AND $res['email'] == $data['email']){
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

    public function chat(){
        
        $this->checkConnexion();

        $this->loadModel('Messages');
        $this->loadModel('Fighters');

        $session = $this->request->session();
        $selectedFighter = $session->read('FighterSelected.id');

        $myMessage = $this->Messages->find('all')->where(['fighter_id' => $selectedFighter]);
        $myMessageSent = $this->Messages->find('all')->where(['fighter_id_from' => $selectedFighter]);

        foreach($myMessage as $message){
            $fighter = $this->Fighters->get($message->fighter_id_from);
            $message['from'] = $fighter->name ;
        }

        foreach($myMessageSent as $message){
            $fighter = $this->Fighters->get($message->fighter_id);
            $message['to'] = $fighter->name ;
        }

        $this->set(compact('myMessage','myMessageSent'));
    }

    public function newMessage(){
        
        $this->checkConnexion();
        
      $this->loadModel('Fighters');
      $this->loadModel('Messages');
      $message = $this->Messages->newEntity();
      $playerId = $this->request->session()->read('Players.id');
      $allFighters = $this->Fighters->find('all')->where(['player_id !=' => $playerId]);

      if($this->request->is('post')){
        if($this->request->data['fighter_id'] != null){
          $message->date = new Time();
          $message->title = $this->request->data['title'];
          $message->message = $this->request->data['message'];
          $message->fighter_id_from = $this->request->session()->read('FighterSelected.id');
          $data = $allFighters->toArray();
          $receiver = $data[$this->request->data['fighter_id']];
          $message->fighter_id = $receiver->id;
          if ($this->Messages->save($message)) {
            $this->Flash->success(__('The message has been sent.'));
            return $this->redirect(['action' => 'chat']);
          }
          else {
            $this->Flash->error(__('The message could not be sent. Please, try again.'));
            return $this->redirect(['action' => 'chat']);
          }
        }
        else {
          $this->Flash->error(__('You should select a reciever.'));
        }
      }
      $this->set(compact('allFighters', 'message'));
    }

    public function yell()
    {
        $this->checkConnexion();
        
        $this->loadModel('Fighters');
        $this->loadModel('Events');

        if ($this->request->is('post')) {

            $fighterSelectedId = $this->request->session()->read('FighterSelected.id');
            $myFighter = $this->Fighters->get($fighterSelectedId);

            $this->Events->addNewEvent($this->request->data['message'], $myFighter->coordinate_x, $myFighter->coordinate_y);

            $this->Flash->success(__("New yell event saved."));
            return $this->redirect(['action' => 'diary']);
        }
    }

    public function fighter()
    {
        $this->checkConnexion();
        
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
        $this->checkConnexion();
        
        $this->loadModel('Fighters');
        $fighter = $this->Fighters->newEntity();

        if ($this->request->is('post')) {

            $res = $this->Fighters->createANewChampionFor($this->request->session()->read('Players.id'),$this->request->data['name']);

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
        $this->checkConnexion();
        
        $this->loadModel('Fighters');
        $fighter = $this->Fighters->get($fighterId);

        $this->set(compact('fighter'));
        $this->set('_serialize', ['fighter']);
    }

    public function fighterAvatar($fighterId)
    {
        $this->checkConnexion();
        
        $this->loadModel('Fighters');
        $fighter = $this->Fighters->get($fighterId);

        if ($this->request->is('post')) {

            $target_path = WWW_ROOT .'/img/avatars/'. $fighterId . '.jpg';
            move_uploaded_file($this->request->data('url.tmp_name'), $target_path);

            $this->Flash->success(__('The fighter avatar has been saved.'));
            return $this->redirect(['action' => 'fighterView', $fighterId]);
        }

        $this->set(compact('fighter'));
        $this->set('_serialize', ['fighter']);
    }

    public function fighterSelect($id = null)
    {
        $this->checkConnexion();

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
        $this->checkConnexion();
        
        $this->loadModel('Fighters');
        $this->loadModel('Guilds');

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
                
                if($fighterSight >= abs($fighterX - $x) + abs($fighterY - $y)){
                    $visible = true;
                }
                else {
                    $visible = false;
                }

                if(($visible && $fighter->player_id != $playerId && $fighter->current_health > 0) || ($fighter->id == $fighterSelectedId)){
                    $fightersAround[] = $fighter;
                }
            }
      }
      else {
          $this->Flash->error(__('You have to select a fighter to play.'));
          return $this->redirect(['controller' => 'fighters', 'action' => 'index']);
      }

        $selectedFighter = $this->Fighters->get($fighterSelectedId);
        if($selectedFighter->guild_id) {
            $selectedGuild = $this->Guilds->get($selectedFighter->guild_id);
        } else {
            $selectedGuild = null;
        }

        $this->set(compact('fightersAround','selectedFighter','selectedGuild'));
        $this->set('_serialize', ['fightersAround']);

    }

    public function moveUp()
    {
        $this->checkConnexion();
        
      $this->loadModel('Fighters');
      $this->loadModel('Events');

      $fighterSelectedId = $this->request->session()->read('FighterSelected.id');
      $myFighter = $this->Fighters->find()->where(['id' => $fighterSelectedId])->first();
      $canIGo = $this->Fighters->find()->where(['coordinate_x' => $myFighter->coordinate_x - 1, 'coordinate_y' => $myFighter->coordinate_y])->first();
      if(isset($canIGo)){
        $randomValue = rand(1,20);
        $calculation = 10 + $canIGo->level - $myFighter->level ;
        if($randomValue > $calculation){
          $canIGo->current_health = $canIGo->current_health - $myFighter->skill_strength ;
          $this->Fighters->save($canIGo);
          if($canIGo->current_health <= 0){
            $this->Fighters->delete($canIGo);
            $myFighter->xp = $myFighter->xp + $canIGo->level;
            $this->Fighters->save($myFighter);
            $this->Flash->success(__('Congratulations you have killed : '. $canIGo->name .' !'));

            $this->Events->addNewEvent($myFighter->name.' killed '.$canIGo->name, $myFighter->coordinate_x, $myFighter->coordinate_y);
          }
          else {
            $myFighter->xp = $myFighter->xp + 1;
            $this->Fighters->save($myFighter);
            $this->Flash->success(__('Hit !'));

              $this->Events->addNewEvent($myFighter->name.' attacks '.$canIGo->name.' and hits', $myFighter->coordinate_x, $myFighter->coordinate_y);
          }
        }
        else {
            $this->Flash->error(__('Fail !'));
            $this->Events->addNewEvent($myFighter->name.' attacks '.$canIGo->name.' and fails', $myFighter->coordinate_x, $myFighter->coordinate_y);
        }
      }
      if(!isset($canIGo) && ($myFighter->coordinate_x-1) >= 0){
        $myFighter->coordinate_x = $myFighter->coordinate_x - 1 ;
        $this->Fighters->save($myFighter);
        $this->Flash->success(__('You moved. Your new coordinates are ('.$myFighter->coordinate_x.','.$myFighter->coordinate_y.').'));
      }
      elseif(($myFighter->coordinate_x-1) <= 0) {
        $this->Flash->error(__('You are not allowed to go there.'));
      }

      return $this->redirect(['controller' => 'Arenas', 'action' => 'sight']);
    }

    public function moveDown()
    {
        $this->checkConnexion();
        
      $this->loadModel('Fighters');
        $this->loadModel('Events');

      $fighterSelectedId = $this->request->session()->read('FighterSelected.id');
      $myFighter = $this->Fighters->find()->where(['id' => $fighterSelectedId])->first();
      $canIGo = $this->Fighters->find()->where(['coordinate_x' => $myFighter->coordinate_x + 1, 'coordinate_y' => $myFighter->coordinate_y])->first();
      if(isset($canIGo)){
        $randomValue = rand(1,20);
        $calculation = 10 + $canIGo->level - $myFighter->level ;
        if($randomValue > $calculation){
          $canIGo->current_health = $canIGo->current_health - $myFighter->skill_strength ;
          $this->Fighters->save($canIGo);
          if($canIGo->current_health <= 0){
            $this->Fighters->delete($canIGo);
            $myFighter->xp = $myFighter->xp + $canIGo->level;
            $this->Fighters->save($myFighter);
            $this->Flash->success(__('Congratulations you have killed : '. $canIGo->name .' !'));

              $this->Events->addNewEvent($myFighter->name.' killed '.$canIGo->name, $myFighter->coordinate_x, $myFighter->coordinate_y);
          }
          else {
            $myFighter->xp = $myFighter->xp + 1;
            $this->Fighters->save($myFighter);
            $this->Flash->success(__('Hit !'));

              $this->Events->addNewEvent($myFighter->name.' attacks '.$canIGo->name.' and hits', $myFighter->coordinate_x, $myFighter->coordinate_y);
          }
        }
        else {
          $this->Flash->error(__('Fail !'));
            $this->Events->addNewEvent($myFighter->name.' attacks '.$canIGo->name.' and fails', $myFighter->coordinate_x, $myFighter->coordinate_y);
        }
      }
      if(!isset($canIGo) && ($myFighter->coordinate_x+1) <= 14){
        $myFighter->coordinate_x = $myFighter->coordinate_x + 1 ;
        $this->Fighters->save($myFighter);
        $this->Flash->success(__('You moved. Your new coordinates are ('.$myFighter->coordinate_x.','.$myFighter->coordinate_y.').'));
      }
      elseif(($myFighter->coordinate_x+1) >= 14) {
        $this->Flash->error(__('You are not allowed to go there.'));
      }

      return $this->redirect(['controller' => 'Arenas', 'action' => 'sight']);
    }

    public function moveLeft()
    {
        $this->checkConnexion();
        
      $this->loadModel('Fighters');
        $this->loadModel('Events');

      $fighterSelectedId = $this->request->session()->read('FighterSelected.id');
      $myFighter = $this->Fighters->find()->where(['id' => $fighterSelectedId])->first();
      $canIGo = $this->Fighters->find()->where(['coordinate_x' => $myFighter->coordinate_x, 'coordinate_y' => $myFighter->coordinate_y - 1])->first();
      if(isset($canIGo)){
        $randomValue = rand(1,20);
        $calculation = 10 + $canIGo->level - $myFighter->level ;
        if($randomValue > $calculation){
          $canIGo->current_health = $canIGo->current_health - $myFighter->skill_strength ;
          $this->Fighters->save($canIGo);
          if($canIGo->current_health <= 0){
            $this->Fighters->delete($canIGo);
            $myFighter->xp = $myFighter->xp + $canIGo->level;
            $this->Fighters->save($myFighter);
            $this->Flash->success(__('Congratulations you have killed : '. $canIGo->name .' !'));

              $this->Events->addNewEvent($myFighter->name.' killed '.$canIGo->name, $myFighter->coordinate_x, $myFighter->coordinate_y);
          }
          else {
            $myFighter->xp = $myFighter->xp + 1;
            $this->Fighters->save($myFighter);
            $this->Flash->success(__('Hit !'));

              $this->Events->addNewEvent($myFighter->name.' attacks '.$canIGo->name.' and hits', $myFighter->coordinate_x, $myFighter->coordinate_y);
          }
        }
        else {
          $this->Flash->error(__('Fail !'));
            $this->Events->addNewEvent($myFighter->name.' attacks '.$canIGo->name.' and fails', $myFighter->coordinate_x, $myFighter->coordinate_y);
        }
      }
      if(!isset($canIGo) && ($myFighter->coordinate_y-1) >= 0){
        $myFighter->coordinate_y = $myFighter->coordinate_y - 1 ;
        $this->Fighters->save($myFighter);
        $this->Flash->success(__('You moved. Your new coordinates are ('.$myFighter->coordinate_x.','.$myFighter->coordinate_y.').'));
      }
      elseif(($myFighter->coordinate_y-1) <= 0) {
        $this->Flash->error(__('You are not allowed to go there.'));
      }
      return $this->redirect(['controller' => 'Arenas', 'action' => 'sight']);
    }

    public function moveRight()
    {
        $this->checkConnexion();
        
      $this->loadModel('Fighters');
        $this->loadModel('Events');

      $fighterSelectedId = $this->request->session()->read('FighterSelected.id');
      $myFighter = $this->Fighters->find()->where(['id' => $fighterSelectedId])->first();
      $canIGo = $this->Fighters->find()->where(['coordinate_x' => $myFighter->coordinate_x, 'coordinate_y' => $myFighter->coordinate_y + 1])->first();
      if(isset($canIGo)){
        $randomValue = rand(1,20);
        $calculation = 10 + $canIGo->level - $myFighter->level ;
        if($randomValue > $calculation){
          $canIGo->current_health = $canIGo->current_health - $myFighter->skill_strength ;
          $this->Fighters->save($canIGo);
          if($canIGo->current_health <= 0){
            $this->Fighters->delete($canIGo);
            $myFighter->xp = $myFighter->xp + $canIGo->level;
            $this->Fighters->save($myFighter);
            $this->Flash->success(__('Congratulations you have killed : '. $canIGo->name .' !'));

              $this->Events->addNewEvent($myFighter->name.' killed '.$canIGo->name, $myFighter->coordinate_x, $myFighter->coordinate_y);
          }
          else {
            $myFighter->xp = $myFighter->xp + 1;
            $this->Fighters->save($myFighter);
            $this->Flash->success(__('Hit !'));

              $this->Events->addNewEvent($myFighter->name.' attacks '.$canIGo->name.' and hits', $myFighter->coordinate_x, $myFighter->coordinate_y);
          }
        }
        else {
          $this->Flash->error(__('Fail !'));
            $this->Events->addNewEvent($myFighter->name.' attacks '.$canIGo->name.' and fails', $myFighter->coordinate_x, $myFighter->coordinate_y);
        }
      }
      elseif(!isset($canIGo) && ($myFighter->coordinate_y+1) <= 9){
        $myFighter->coordinate_y = $myFighter->coordinate_y + 1 ;
        $this->Fighters->save($myFighter);
        $this->Flash->success(__('You moved. Your new coordinates are ('.$myFighter->coordinate_x.','.$myFighter->coordinate_y.').'));
      }
      elseif(($myFighter->coordinate_y+1) >= 9) {
        $this->Flash->error(__('You are not allowed to go there.'));
      }
      return $this->redirect(['controller' => 'Arenas', 'action' => 'sight']);
    }

    /*public function hit($fighter){
      $this->loadModel('Fighters');
      $myFighter = $this->Fighters->find()->where(['id' => $fighterSelectedId])->first();
      $randomValue = rand(1,20);
      $calculation = 10 + $fighter->level - $myFighter->level ;
      if($randomValue > $calculation){
        $fighter->current_health = $fighter->current_health - $myFighter->skill_strength ;
        $this->Fighters->save($fighter);
        $this->Flash->success(__('Hit !'));
      }
      else {
        $this->Flash->error(__('Fail !'));
      }
    }*/


    public function diary()
    {
        $this->checkConnexion();
        
        $session = $this->request->session();
        $selectedFighterId = $session->read('FighterSelected.id');

        $this->loadModel('Fighters');
        $selectedFighter = $this->Fighters->get($selectedFighterId);
        
        $this->loadModel('Events');
        $this->set('events', $this->Events->findLastEventsInSight($selectedFighter->skill_sight, $selectedFighter->coordinate_x, $selectedFighter->coordinate_y));
    }

    public function guild()
    {
        $this->checkConnexion();
        
        $this->loadModel('Guilds');
        $guilds = $this->Guilds->find('all');

        $session = $this->request->session();
        $selectedFighterId = $session->read('FighterSelected.id');

        $this->loadModel('Fighters');
        $selectedFighter = $this->Fighters->get($selectedFighterId);

        $fighterGuild = $selectedFighter->guild_id;

        $this->set(compact('guilds','fighterGuild'));
        $this->set('_serialize', ['guilds']);
    }

    public function guildView($guildId)
    {
        $this->checkConnexion();
        
        $this->loadModel('Guilds');
        $guild = $this->Guilds->get($guildId);

        $this->loadModel('Fighters');
        $fighters = $this->Fighters->find('all')->where(['guild_id' => $guildId]);

        $session = $this->request->session();
        $selectedFighterId = $session->read('FighterSelected.id');
        $selectedFighter = $this->Fighters->get($selectedFighterId);

        $fighterInGuild = false;
        if($selectedFighter->guild_id == $guild->id) {
            $fighterInGuild = true;
        }

        $this->set(compact('guild','fighters','selectedFighterId','fighterInGuild'));
        $this->set('_serialize', ['guild']);
        $this->set('_serialize', ['fighters']);
    }

    public function guildJoin($guildId = null)
    {
        $this->checkConnexion();

        if($guildId != null) {

            $this->loadModel('Fighters');
            $session = $this->request->session();
            $this->Fighters->editFighterGuild($session->read('FighterSelected.id'), $guildId);

            $this->Flash->success(__('The fighter joined the guild.'));
            return $this->redirect(['action' => 'guildView', $guildId]);
        } else {
            $this->Flash->error(__('The fighter could not join the guild. Please, try again.'));
            return $this->redirect(['action' => 'guild']);
        }
    }

    public function guildQuit($guildId = null)
    {
        $this->checkConnexion();

        if($guildId != null) {

            $this->loadModel('Fighters');
            $session = $this->request->session();
            $this->Fighters->editFighterGuild($session->read('FighterSelected.id'), null);

            $this->Flash->success(__('The fighter quitted the guild.'));
            return $this->redirect(['action' => 'guild']);
        } else {
            $this->Flash->error(__('The fighter could not quit the guild. Please, try again.'));
            return $this->redirect(['action' => 'guild']);
        }
    }

    public function guildCreate()
    {
        $this->checkConnexion();
        
        $this->loadModel('Guilds');
        $guildCreate = $this->Guilds->newEntity();

            if ($this->request->is('post')) {

                $guildCreate = $this->Guilds->patchEntity($guildCreate, $this->request->data);

                if ($this->Guilds->save($guildCreate)) {

                    $this->Flash->success(__("La nouvelle guild a été sauvegardé."));
                    return $this->redirect(['action' => 'guild']);
                }

                $this->Flash->error(__("Impossible de créer la guild."));
            }

        $this->set(compact('guildCreate'));
        $this->set('_serialize', ['guildCreate']);
    }
}
