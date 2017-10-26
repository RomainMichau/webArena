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
        $this->save($message);
    }
}
