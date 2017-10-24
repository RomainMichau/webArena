<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class PlayersTable extends Table
{
    public function resetPassword($email){
        $query = $this->find('all')->where(['email' => $email]);
        $player = $query->first();
        $player->password = "admin";
        $this->save($player);
    }
}