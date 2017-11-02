<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class FightersTable extends Table {
    ///  parametre  
    private static $ACTIONTIME = 1;   //ne pas descendre en dessous de 1
    private static $MAXACTION = 3;
    private static $SKILL_H_INIT = 5;
    private static $SKILL_SI_INIT = 2;
    private static $SKILL_ST_INIT = 1;
    private static $BEGIN_LVL = 0;
    private static $BEGIN_XP = 0;

    public function getAllFighters() {
        $fighters = $this->find('all')->from("fighters")->toArray();
        return $fighters;
    }

    public function getActionTime() {
        return static::$ACTIONTIME;
    }

    public function getMaxAction() {
        return static::$MAXACTION;
    }

    public function setNextActionTime($id, $date) {
        $fighter = $this->get($id);
        $fighter->next_action_time = $date;
        $this->save($fighter);
    }

    public function getVoisin($id) {
        $fighter = $this->get($id);

        $f1 = $this->getFighterByCoord($fighter->coordinate_x + 1, $fighter->coordinate_y);
        $f2 = $this->getFighterByCoord($fighter->coordinate_x - 1, $fighter->coordinate_y);
        $f3 = $this->getFighterByCoord($fighter->coordinate_x, $fighter->coordinate_y + 1);
        $f4 = $this->getFighterByCoord($fighter->coordinate_x, $fighter->coordinate_y - 1);
        return array($f1, $f2, $f3, $f4);
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
        $this->Parameters = TableRegistry::get('Parameters');
        //pr($fighter->toArray());
        //pr('oki');

        if ($dir == 1 && $fighter->coordinate_x < $this->Parameters->get_size_x()) {
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
        } else if ($dir == 4 && $fighter->coordinate_y < $this->Parameters->get_size_y()) {
            $fighter->coordinate_y = $fighter->coordinate_y + 1;
            $this->save($fighter);
            return 1;
        }

        return 0;
    }

    public function addFighter($newFighter, $player_id, $x, $y) {
        $fighter = $this->newEntity();
        //  $this->Paramters= TableRegistry::get('Parameters');
        $fighter->name = $newFighter['name'];
        $fighter->player_id = $player_id;
        $fighter->coordinate_x = $x;
        $fighter->coordinate_y = $y;
        $fighter->level = static::$BEGIN_LVL;
        $fighter->xp = static::$BEGIN_XP;
        $fighter->skill_sight = static::$SKILL_SI_INIT;
        $fighter->skill_strength = static::$SKILL_ST_INIT;
        $fighter->skill_health = static::$SKILL_H_INIT;
        $fighter->current_health = static::$SKILL_H_INIT;
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

    public function getFightersOfGuild($id) {
        $fighters = $this->find('all')->from("fighters")->where(["guild_id" => $id])->toArray();
        return $fighters;
    }

    public function updateGuildId($idGuild, $fighter) {
        if ($idGuild != 0) {
            $fighter->guild_id = $idGuild;
        } else {
            $fighter->guild_id = NULL;
        }
        $this->save($fighter);
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
   
    public function nbMembre($gid){
        $query= $this->find('all')->from("fighters")->where(["guild_id" => $gid]);
        $nb=$query->count();
        return $nb;
    }

}
