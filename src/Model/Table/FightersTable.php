<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class FightersTable extends Table {

    public function test() {
        return "ok";
    }

    public function getAllFighters() {
        $fighters = $this->find('all')->from("fighters")->toArray();
        return $fighters;
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
        $fighter = $this->find('all')->from("fighters")->where("coordinate_x=" . $x . " and coordinate_y=" . $y);
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

    public function addFighter($newFighter, $fightersTable, $player_id) {
        $fighter = $fightersTable->newEntity();

        $fighter->name = $newFighter['name'];
        $fighter->player_id = $player_id;
        $fighter->coordinate_x = 1;
        $fighter->coordinate_y = 1;
        $fighter->level = 1;
        $fighter->xp = 1;
        $fighter->skill_sight = 1;
        $fighter->skill_strength = 1;
        $fighter->skill_health = 1;
        $fighter->current_health = 1;
        $fighter->next_action_time = 1;
        $fighter->guild_id = 1;

        if ($fightersTable->save($fighter)) {
            $id = $fighter->id;
            return $id;
        }
    }
    public function skillSightUp($id){
        $fighter = $this->get($id);
        $fighter->skill_sight = $fighter->skill_sight + 1;
    }
    public function skillStrengthUp($id){
        $fighter = $this->get($id);
        $fighter->skill_strength = $fighter->skill_strength + 1;
    }
    public function skillHealthUp($id){
        $fighter = $this->get($id);
        $fighter->skill_health = $fighter->skill_health + 1;
    }

}
