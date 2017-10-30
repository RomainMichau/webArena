<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class GuildsTable extends Table
{
    public function getAllGuilds(){
        $guilds = $this->find('all')->from("guilds")->toArray();
        return $guilds;
    }
    public function deleteGuilds($id){
       $entity = $this->get($id);
        $this->delete($entity);
    }

    public function getGuild($id){
        $guild = $this->find('all')->from("guilds")->where(["id" => $id])->toArray()[0];
        return $guild;
    }
    public function addGuild($newGuild)
    {
        $guild = $this->newEntity();

        $guild->name = $newGuild['nouveau_guild'];

        $this->save($guild);

        return $guild->id;
    }
}