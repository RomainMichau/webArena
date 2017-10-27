<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class GuildsTable extends Table
{
    public function getAllGuilds(){
        $guilds = $this->find('all')->from("guilds")->toArray();
        return $guilds;
    }

    public function getGuild($id){
        $guild = $this->find('all')->from("guilds")->where(["id" => $id])->toArray()[0];
        return $guild;
    }
}