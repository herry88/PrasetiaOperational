<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Types Controller
 *
 * @property \App\Model\Table\TypesTable $Types
 */
class TypesController extends AppController
{
	public function beforeFilter(Event $event)
    {
       parent::beforeFilter($event);
	   //echo ($this->Auth->user('id'));
	   
	   if ( $this->Auth->user('id') ){
		   $this->Auth->allow(['add','edit','index']);
	   } else {
		   echo "not allow";
		   $this->Auth->deny();
	   }
	  
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('master-data-layout');
        $types = $this->Types->find('all');

        $this->set(compact('types'));
    }

    /**
     * View method
     *
     * @param string|null $id Type id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $type = $this->Types->get($id, [
            'contain' => ['Objects']
        ]);
        $this->set('type', $type);
        $this->set('_serialize', ['type']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $type = $this->Types->newEntity();
        if ($this->request->is('post')) {
            $type = $this->Types->patchEntity($type, $this->request->data);
            if ($this->Types->save($type)) {
                $this->Flash->success(__('The type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('type'));
        $this->set('_serialize', ['type']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $type = $this->Types->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $type = $this->Types->patchEntity($type, $this->request->data);
            if ($this->Types->save($type)) {
                $this->Flash->success(__('The type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('type'));
        $this->set('_serialize', ['type']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Type id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->viewBuilder()->setLayout('master-data-layout');
        
        $this->request->allowMethod(['post', 'delete']);
        $type = $this->Types->get($id);
        if ($this->Types->delete($type)) {
            $this->Flash->success(__('The type has been deleted.'));
        } else {
            $this->Flash->error(__('The type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
