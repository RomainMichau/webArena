<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class FightersTable extends Table
{
    public function test(){
        return "ok";
    }
    public function getBestFighter(){

        $figterlist=$this->find('all')->from("fighters")->where("id = 1");
        $figterlist = $figterlist->toArray();
        return $figterlist;
    }
    public function getFighterById($id){
        $fighter = $this->get($id);
        return $fighter;
    }
    public function passerLeNiveau($id){

        $fighter = $this->get($id);
        $fighter->level = $fighter->level + 1;
        $this->save($fighter);
    }
}