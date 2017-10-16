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

        $fighter = $this->find('all')->from("fighters")->where("id = ".$id);
        if(sizeof($fighter->toArray()) == 1) {
            $fighter = $fighter->toArray()[0];
            return $fighter;
        }
    }
    
    public function levelUp(){

        $fighters= $this->find('all')->from("fighters");
        pr($fighters);
        
    }

}