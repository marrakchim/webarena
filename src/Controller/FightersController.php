<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Fighters Controller
 *
 * @property \App\Model\Table\FightersTable $Fighters
 */
class FightersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->loadModel('Fighters');
        $fighters = $this->paginate($this->Fighters);
        $playerId = $this->request->session()->read('Players.id');
        $fighters = $this->Fighters->find('all')->where(['player_id' => $playerId]);

        $this->set(compact('fighters'));
        $this->set('_serialize', ['fighters']);
    }

    /**
     * View method
     *
     * @param string|null $id Fighter id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fighter = $this->Fighters->get($id, [
            'contain' => []
        ]);

        $this->set('fighter', $fighter);
        $this->set('_serialize', ['fighter']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fighter = $this->Fighters->newEntity();
        if ($this->request->is('post')) {
            $fighter = $this->Fighters->patchEntity($fighter, $this->request->data);
            if ($this->Fighters->save($fighter)) {
                $this->Flash->success(__('The fighter has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The fighter could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('fighter'));
        $this->set('_serialize', ['fighter']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Fighter id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fighter = $this->Fighters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fighter = $this->Fighters->patchEntity($fighter, $this->request->data);
            if ($this->Fighters->save($fighter)) {
                $this->Flash->success(__('The fighter has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The fighter could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('fighter'));
        $this->set('_serialize', ['fighter']);
    }

    public function selectFighter($id = null){

      if($id != null) {
        $session = $this->request->session();

        //$myFighter = $this->Fighters->find('all')->where(['id' => $id]);
        //$myFighter = $this->Fighters->find('first', array('conditions' => array('Fighters.id' => $id)));

        $session->write(['FighterSelected.id' => $id]);
        //$session->write(['FighterSelected.x' => $myFighter->coordinate_x]);
        //$session->write(['FighterSelected.y' => $myFighter->coordinate_y]);

        $this->Flash->success(__('The fighter has been selected.'));
        return $this->redirect(['controller' => 'arenas', 'action' => 'sight']);
      } else {
        $this->Flash->error(__('The fighter could not be selected. Please, try again.'));
        return $this->redirect(['action' => 'index']);
      }
    }

    /**
     * Delete method
     *
     * @param string|null $id Fighter id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fighter = $this->Fighters->get($id);
        if ($this->Fighters->delete($fighter)) {
            $this->Flash->success(__('The fighter has been deleted.'));
        } else {
            $this->Flash->error(__('The fighter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
