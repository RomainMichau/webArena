<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class FightersTable extends Table {
    public static $actiontime=10;
    public static $maxaction=3;
   
    
    
    public function getAllFighters() {
        $fighters = $this->find('all')->from("fighters")->toArray();
        return $fighters;
    }
    
    public function getActionTime(){
        return static::$actiontime;
    }
    public function getMaxAction(){
        return static::$maxaction;
    }
    
    
    
    public function setNextActionTime($id,$date){
         $fighter = $this->get($id);
           $fighter->next_action_time = $date;
           $this->save($fighter);
    }

    


    public function setHealth($id, $health) {
        $fighter = $this->get($id);
        $fighter->current_health = $health;
        $this->save($fighter);
    }

    public function getAllFightersByPlayerId($player_id) {
        $fighters = $this->find('all')->from("fighters")->where(["player_id" => $player_id])->toArray();
        return $fighters;
    }

    public function getFighterById($id) {
        $fighter = $this->get($id);
        return $fighter;
    }

    public function xpUp($id, $nb) {

        $fighter = $this->get($id);
        $fighter->xp = $fighter->xp + $nb;
        $this->save($fighter);
    }

    public function levelUp($id) {
        $fighter = $this->get($id);
        $fighter->level = $fighter->level + 1;
        $this->save($fighter);
    }

    public function getFighterByCoord($x, $y) {
        // $this->setSource('surroundings');
        $fighter = $this->find('all')->from('fighters')->where('coordinate_x=' . $x . ' and coordinate_y=' . $y);
        //pr($fighter->toArray());
        if (sizeof($fighter->toArray()) == 0) {

            return NULL;
        }
        return $fighter->toArray()[0];
    }

    public function moveFighter($id, $dir) {        //1:bas 2:haut 3:gauche 4:droit
        // $this->setSource('surroundings');
        $fighter = $this->get($id);

        //pr($fighter->toArray());
        //pr('oki');

        if ($dir == 1 && $fighter->coordinate_x < 15) {
            $fighter->coordinate_x = $fighter->coordinate_x + 1;
            $this->save($fighter);
            return 1;
        } else if ($dir == 2 && $fighter->coordinate_x > 1) {
            $fighter->coordinate_x = $fighter->coordinate_x - 1;
            $this->save($fighter);
            return 1;
        } else if ($dir == 3 && $fighter->coordinate_y > 1) {
            $fighter->coordinate_y = $fighter->coordinate_y - 1;
            $this->save($fighter);
            return 1;
        } else if ($dir == 4 && $fighter->coordinate_y < 10) {
            $fighter->coordinate_y = $fighter->coordinate_y + 1;
            $this->save($fighter);
            return 1;
        }

        return 0;
    }

    public function addFighter($newFighter, $player_id, $x, $y) {
        $fighter = $this->newEntity();

        $fighter->name = $newFighter['name'];
        $fighter->player_id = $player_id;
        $fighter->coordinate_x = $x;
        $fighter->coordinate_y = $y;
        $fighter->level = 1;
        $fighter->xp = 0;
        $fighter->skill_sight = 2;
        $fighter->skill_strength = 1;
        $fighter->skill_health = 5;
        $fighter->current_health = 5;
        date_default_timezone_set('Europe/Paris');
        $fighter->next_action_time = date('Y-m-d H:i:s');

        $fighter->guild_id = NULL;

        if ($this->save($fighter)) {
            $id = $fighter->id;
            return $id;
        }
    }

    public function updateFighter($updateFighter, $idFighter) {
        $fighter = $this->get($idFighter);

        $fighter->name = $updateFighter['name'];

        if ($this->save($fighter)) {
            return true;
        }
        return false;
    }

    public function skillSightUp($id) {
        $fighter = $this->get($id);
        $fighter->skill_sight = $fighter->skill_sight + 1;
        $fighter->level = $fighter->level + 1;

        $this->save($fighter);
    }

    public function skillStrengthUp($id) {
        $fighter = $this->get($id);
        $fighter->level = $fighter->level + 1;

        $fighter->skill_strength = $fighter->skill_strength + 1;
        $this->save($fighter);
    }

    public function skillHealthUp($id) {
        $fighter = $this->get($id);
        $fighter->skill_health = $fighter->skill_health + 1;
        $fighter->level = $fighter->level + 1;
        $fighter->current_health = $fighter->skill_health;
        $this->save($fighter);
    }

    public function deleteFighter($id) {
        $entity = $this->get($id);
        $this->delete($entity);
    }

}
