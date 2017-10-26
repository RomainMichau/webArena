<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class MessagesTable extends Table
{
    public function getAllMessages(){
        $messages = $this->find('all')->from("messages")->toArray();
        return $messages;
    }
    public function getAllMessagesWith($id1, $id2)
    {
        $messages = $this->find('all')->from("messages")
            ->where([$id1 => 'fighter_id_from', $id2 => 'fighter_id'])
            ->orWhere([$id2 => 'fighter_id_from', $id1 => 'fighter_id'])
            ->toArray();



        pr($messages);
        return $messages;
    }
}
