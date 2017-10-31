<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class MessagesTable extends Table
{
    public function getAllMessages()
    {
        $messages = $this->find('all')->from("messages")->toArray();
        return $messages;
    }

    public function getAllMessagesWith($id1, $id2)
    {
        $messages = $this->find('all')->from("messages")
            ->where(['fighter_id_from' => $id1, 'fighter_id' => $id2])
            ->orWhere(['fighter_id_from' => $id2, 'fighter_id' => $id1])
            ->orderDesc('date')
            ->toArray();
        return $messages;
    }

    public function addMessage($newMessage, $idReceiver, $idFighterAuth)
    {
        $message = $this->newEntity();

        $message->message = $newMessage['nouveau_message'];
        $message->date = date('Y-m-d H:i:s');
        $message->fighter_id_from = $idFighterAuth;
        $message->fighter_id = $idReceiver;
        $message->title = "nl";
        $this->save($message);
    }

    public  function getNewMessage($id){
                $messages = $this->find('all')->from("messages")->where('title = \'nl\'  AND fighter_id ='.$id);
                return $messages->toArray();

    }

    
      public  function checkread($idfrom,$idto){
                
                $mes=$this->find(all)
        -> where(['fighter_id_from '=> $idfrom  ,'fighter_id '=> $idto ,'title' => 'nl'])
        ;
                return $mes->toArray();

    }
    public  function setRead($idfrom,$idto){
                
                $this->query()
        ->update()
        ->set(['title' => 'lu'])
        -> where(['fighter_id_from '=> $idfrom  ,'fighter_id '=> $idto ,'title' => 'nl'])
        ->execute();

    }
}
