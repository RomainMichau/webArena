<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class FightersTable extends Table {

    public function test() {
        return "ok";
    }

    public function getAllFighrers()
    {
        $fighters = $this->find('all')->from("fighters")->toArray();
        return $fighters;
    }

    public function getAllFighrersByPlayerId($player_id)
    {
        $fighters = $this->find('all')->from("fighters")->where(["player_id" => $player_id])->toArray();
        return $fighters;
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
    
    public function goUp($id,$dir) {        //1:bas 2:haut 3:gauche 4:droit
         // $this->setSource('surroundings');
       $fighter = $this->get($id);
        //pr($fighter->toArray());
       
        if($fighter->coordinate_x>1){
            if($dir==1){
            $fighter->coordinate_x=$fighter->coordinate_x+1;}
            if($dir==2){
            $fighter->coordinate_x=$fighter->coordinate_x-1;}
            if($dir==3){
            $fighter->coordinate_x=$fighter->coordinate_y-1;}
            if($dir==4){
            $fighter->coordinate_x=$fighter->coordinate_y+1;}
            $this->save($fighter);
            return NULL;
        }
        return NULL;
    }
     
}
