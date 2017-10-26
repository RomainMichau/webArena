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
        $this->loadModel('Fighters');

        $messages = $this->Messages->getAllMessagesWith($id1, $id2);
        $this->set('messages', $messages);
        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];


        $newMessage = $this->request->getData();

        if($newMessage)
        {
            if($id1 == $fighter->id)
            {$idReceiver = $id2; $idFighterAuth = $fighter->id;}
            else
            {$idReceiver = $id1; $idFighterAuth = $fighter->id;}

            $this->Messages->addMessage($newMessage, $idReceiver, $idFighterAuth);
            $this->redirect(['controller' => 'Messages', 'action' => 'conversation', $id1, $id2]);
        }

    }
    
    //public function messages(){}
    
}