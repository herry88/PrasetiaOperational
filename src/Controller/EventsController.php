<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Email\Email;
use PHPMailer;
use Cake\Event\Event;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
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
//        $mail = new PHPMailer;
//        $mail->isSMTP();                                      // Set mailer to use SMTP
//        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
//        $mail->SMTPAuth = true;                               // Enable SMTP authentication
//        $mail->Username = 'junifar.hidayat@prasetiadwidharma.co.id';                 // SMTP username
//        $mail->Password = 'prasetia';                           // SMTP password
//        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//        $mail->Port = 587;                                    // TCP port to connect to
//
//        $mail->From = 'admin@prasetia.co.id';
//        $mail->FromName = 'Admin';
//        $mail->addAddress('junifar@gmail.com', 'Junifar');     // Add a recipient
//        // $mail->addAddress('ellen@example.com');               // Name is optional
//        // $mail->addReplyTo('info@example.com', 'Information');
//        // $mail->addCC('cc@example.com');
//        // $mail->addBCC('bcc@example.com');
//
//        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//        $mail->isHTML(true);                                  // Set email format to HTML
//
//        $mail->Subject = 'Here is the subject';
//        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//
//        if(!$mail->send()) {
//            echo 'Message could not be sent.';
//            echo 'Mailer Error: ' . $mail->ErrorInfo;
//        } else {
//            echo 'Message has been sent';
//        }

        $email = new Email('default');
        $email->template('default')
            ->emailFormat('html')
            ->to('junifar@gmail.com')
            ->from('app@domain.com')
            ->send();

        $this->set('events', $this->paginate($this->Events));
        $this->set('_serialize', ['events']);
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => []
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('event'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('event'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
