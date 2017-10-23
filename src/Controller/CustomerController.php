<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Customer Controller
 *
 * @property \App\Model\Table\CustomerTable $Customer
 */
class CustomerController extends AppController
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
        $this->set('customer', $this->paginate($this->Customer));
        $this->set('_serialize', ['customer']);
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customer->get($id, [
            'contain' => ['Groups']
        ]);
        $this->set('customer', $customer);
        $this->set('_serialize', ['customer']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customer->newEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customer->patchEntity($customer, $this->request->data);
            if ($this->Customer->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The customer could not be saved. Please, try again.'));
            }
        }
        $groups = $this->Customer->Groups->find('list', ['limit' => 200]);
        $this->set(compact('customer', 'groups'));
        $this->set('_serialize', ['customer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customer->get($id, [
            'contain' => ['Groups']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customer->patchEntity($customer, $this->request->data);
            if ($this->Customer->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The customer could not be saved. Please, try again.'));
            }
        }
        $groups = $this->Customer->Groups->find('list', ['limit' => 200]);
        $this->set(compact('customer', 'groups'));
        $this->set('_serialize', ['customer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customer->get($id);
        if ($this->Customer->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
