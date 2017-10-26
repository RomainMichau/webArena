<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Personal Controller
 * User personal interface
 *
 */
class MessagesController  extends AppController
{
    function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'index', 'login', 'logout', 'forgotPassword']);
    }
    
    public function index()
    {
        $this->loadModel('Messages');
        $messages = $this->Messages->getAllMessages();
        $this->set('messages', $messages);
    }

    public function conversation($id1, $id2)
    {
        $this->loadModel('Messages');
        $messages = $this->Messages->getAllMessagesWith($id1, $id2);
        pr($messages);
        $this->set('messages', $messages);
    }
    
    //public function messages(){}
    
}