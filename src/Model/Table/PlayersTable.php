<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class PlayersTable extends Table
{
    public function resetPassword($email, $newpass){
        $query = $this->find('all')->where(['email' => $email]);
        $player = $query->first();
        $player->password = $newpass;
        $this->save($player);
    }
    
    public function userExists($email){
        $query = $this->find('all')->where(['email' => $email]);
        
        return $query->first() ? true : false;
       
    }
}