<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class FightersTable extends Table {

    public function test() {
        return "ok";
    }

    public function getBestFighter() {

        $figterlist = $this->find('all')->from("fighters")->where("id = 1");
        $figterlist = $figterlist->toArray();
        return $figterlist;
    }

    public function getFighterById($id) {
        $fighter = $this->get($id);
        return $fighter;
    }

    public function levelUp($id) {
        $fighter = $this->get($id);
        $fighter->level = $fighter->level + 1;
        $this->save($fighter);
    }
    
      public function getFighterByCoord($x, $y) {
         // $this->setSource('surroundings');
        $fighter = $this->find('all')->from("fighters")->where("coordinate_x=" .$x . " and coordinate_y=" . $y);
        //pr($fighter->toArray());
        if(sizeof($fighter->toArray())==0){
            
            return NULL;
        }
        return $fighter->toArray()[0];
    }

}
