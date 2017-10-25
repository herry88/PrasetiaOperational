<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * RemindPhotos Controller
 *
 * @property \App\Model\Table\RemindPhotosTable $RemindPhotos
 *
 * @method \App\Model\Entity\RemindPhoto[] paginate($object = null, array $settings = [])
 */
class RemindPhotosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('master-data-layout');
        $this->paginate = [
            'contain' => ['Reminds']
        ];
        $remindPhotos = $this->paginate($this->RemindPhotos);

        $this->set(compact('remindPhotos'));
        $this->set('_serialize', ['remindPhotos']);
    }

    /**
     * View method
     *
     * @param string|null $id Remind Photo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $remindPhoto = $this->RemindPhotos->get($id, [
            'contain' => ['Reminds']
        ]);

        $this->set('remindPhoto', $remindPhoto);
        $this->set('_serialize', ['remindPhoto']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $this->viewBuilder()->setLayout('master-data-layout');
        $remind_photo = $this->RemindPhotos->newEntity();
        if ($this->request->is('post')) {
            //logic upload images 
            if (!empty($this->request->data['photo']['name'])) {
                 
                 $path = pathinfo($this->request->data['photo']['name']);
                $fileName = $path['filename'] .date('Ymdhis'). '.' .$path['extension'];
                //$fileName = $this->request->data['photo']['name'];
                $uploadPath = WWW_ROOT.'uploads' . DS . 'files' . DS . $this->request->data['remind_id']. DS;// $folder_name;
                $folder = new Folder();
                $folder->create($uploadPath);
                $uploadPath =WWW_ROOT.'uploads/files/'.$this->request->data['remind_id'].'/';
                
               // $uploadPath =WWW_ROOT.'uploads/files/';
                $uploadFile = $uploadPath.$fileName;
                //$uploadFile = $uploadPath.$fileName; 
                 if (move_uploaded_file($this->request->data['photo']['tmp_name'], $uploadFile)) {
                     
                     $this->request->data['photo'] = $fileName;
                 }
            }//end if logic images
            
            $remind_photo = $this->RemindPhotos->patchEntity($remind_photo, $this->request->getData());
            if ($this->RemindPhotos->save($remind_photo)) {
                $this->Flash->success(__('The remind photo has been saved.'));

                return $this->redirect(['controller' => 'reminds','action'=>'view/'.$this->request->data['remind_id']]);
            }
            $this->Flash->error(__('The remind photo could not be saved. Please, try again.'));
        }
        $reminds = $this->RemindPhotos->Reminds->find('list', ['limit' => 200]);
        $remind_id = $id;
        $this->set(compact('remind_photo', 'reminds','remind_id'));
        $this->set('_serialize', ['remind_photo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Remind Photo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $remindPhoto = $this->RemindPhotos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $remindPhoto = $this->RemindPhotos->patchEntity($remindPhoto, $this->request->getData());
            if ($this->RemindPhotos->save($remindPhoto)) {
                $this->Flash->success(__('The remind photo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The remind photo could not be saved. Please, try again.'));
        }
        $reminds = $this->RemindPhotos->Reminds->find('list', ['limit' => 200]);
        $this->set(compact('remindPhoto', 'reminds'));
        $this->set('_serialize', ['remindPhoto']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Remind Photo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $remind_id = null)
    {
         //$file->delete();
         $uploadPath = WWW_ROOT.'uploads' . DS . 'files' . DS . $remind_id. DS;// $folder_name;
         
         
        $this->request->allowMethod(['post', 'delete']);
        $remindPhoto = $this->RemindPhotos->get($id);
        
        if ($this->RemindPhotos->delete($remindPhoto)) {
            $file= new file($uploadPath.$remindPhoto['photo']);
            $file->delete();
            $this->Flash->success(__('The remind photo has been deleted.'));
        } else {
            $this->Flash->error(__('The remind photo could not be deleted. Please, try again.'));
        }
        
        return $this->redirect(['controller' => 'reminds' ,'action'=>'view/'.$remind_id]);
        //return $this->redirect(['action' => 'index']);
    }
}
