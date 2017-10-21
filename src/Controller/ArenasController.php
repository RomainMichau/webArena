<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Personal Controller
 * User personal interface
 *
 */
class ArenasController extends AppController {

    public function index() {
        $this->set('titredepage', "index");
    }

    public function login() {
        $this->set('titredepage', "login");
        $session = $this->request->session();

        $session->write('id_player', '2');
    }

    public function fighter() {
        $this->loadModel('Fighters');

        $this->Fighters->Levelup(1);

        $fighter = $this->Fighters->getFighterById(1);
        $this->set('fighter', $fighter);
    }

    public function createFighter() {
        $this->loadModel('Fighters');
        $fightersTable = $this->Fighters;
        $fighter = $fightersTable->newEntity();
        $fighter->name = "fab";
        $fighter->player_id = "1bzz3";
        $fighter->coordinate_x = 1;
        $fighter->coordinate_y = 1;
        $fighter->level = 1;
        $fighter->xp = 1;
        $fighter->skill_sight = 1;
        $fighter->skill_strength = 1;
        $fighter-> skill_health  = 1;
        $fighter->current_health = 1;
        $fighter->next_action_time = 1;
        $fighter->guild_id = 1;

        if ($fightersTable->save($fighter)) {
            // L'entity $article contient maintenant l'id
            $id = $fighter->id;
        }
    }

    public function sight() {

        $this->set('titredepage', "sight");
        $this->loadModel('Fighters');
        $this->loadModel('Surroundings');
        $session = $this->request->session();
        // pr();
        for ($i = 1; $i <= 15; $i++) {
            for ($j = 1; $j <= 10; $j++) {
                if ($this->Fighters->getFighterByCoord($i, $j) != NULL) {
                    $tab[$i][$j] = 'f' . $this->Fighters->getFighterByCoord($i, $j)->id;
                    //  pr($tab[$i][$j]);
                } elseif ($this->Surroundings->getSurroundingByCoord($i, $j) != NULL) {
                    $tab[$i][$j] = 's' . $this->Surroundings->getSurroundingByCoord($i, $j)->id;
                } else {
                    $tab[$i][$j] = 'vide';
                }
            }
        }
        $this->set('tab', $tab);
        //   $this->tst();
    }

    public function diary() {
        $this->set('titredepage', "diary");
    }

    public function moveFighter() {
        $this->autoRender = false;
        $session = $this->request->session();
        $this->loadModel('Fighters');
        $this->Fighters->goUp(1,1);
        $this->redirect(
                ['controller' => 'Arenas', 'action' => 'sight', 2]);
        // return $this->requestAction('sight');
    }

}
