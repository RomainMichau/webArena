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
        if (!$this->hasAFighter()) {
            return null;
        }
        // Mise à jour des fighters dans la session
        $this->updateSession();
        
        $this->loadModel('Messages');
        $this->loadModel('Fighters');
        $messages = $this->Messages->getAllMessagesWith($id1, $id2);
             $this->set('messages', $messages);
     //   $fighterto=$this->Fighters->getFighterById()
        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        $tab=array();
        
          foreach($messages as $message){
              
              $fighterfrom = $this->Fighters->getFighterById($message->fighter_id_from);
              if($fighterfrom==$fighter)
              {
                  $fighterfrom->name="moi";
              }
              array_push($tab, $fighterfrom);
          }
        
        $this->set('tab', array_reverse($tab));
        
        
        
        if($fighter->id == $id1 or $fighter->id == $id2)
        {
            $newMessage = $this->request->getData();
           
            if($newMessage&&$newMessage['nouveau_message']!='')
            { 
                if($id1 == $fighter->id)
                {$idReceiver = $id2; $idFighterAuth = $fighter->id;}
                else
                {$idReceiver = $id1; $idFighterAuth = $fighter->id;}

                $this->Messages->addMessage($newMessage, $idReceiver, $idFighterAuth);
                $this->redirect(['controller' => 'Messages', 'action' => 'conversation', $id1, $id2]);
            }
        }
        else
        {
            $this->redirect(['controller' => 'Arenas', 'action' => 'fighters']);
        }




    }

      public function hasAFighter() {
        $this->loadModel('Fighters');
        $fighters = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id']);
        //   pr($fighters);
        if ($fighters == NULL) {
            //  pr('zsdertdefrg');
            $this->redirect(['controller' => 'Arenas', 'action' => 'createFighter', 1]);
            return false;
        } else {
            return true;
        }
    }
    
    // Re-put every fighters info in session (apart from current player)
    public function updateSession() {
        $this->loadModel('Fighters');
        $fighters = $this->Fighters->getAllFighters();
        $idFighterAuth = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0]->id;

        $fighters_nb = count($fighters) - 1;                                // Minus current player
        $this->request->session()->write('fighters_nb', $fighters_nb); 

        $fighter_no = 1;
        foreach($fighters as $fighter) {
            if($fighter->id !== $idFighterAuth) {
                $this->request->session()->write('fighter' . $fighter_no, $fighter);
                $fighter_no++;
            }
        }
    }
    
}