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

    public function fighters() {
        $this->loadModel('Fighters');
        $fighters = $this->Fighters->getAllFighrers();
        $this->set('fighters', $fighters);
    }

    public function fightersByPlayer() {
        $this->loadModel('Fighters');
        $player_id = "545f827c-576c-4dc5-ab6d-27c33186dc3e";
        $fighters = $this->Fighters->getAllFighrersByPlayerId($player_id);
        $this->set('fighters', $fighters);
    }

    public function fighter($id) {
        $this->loadModel('Fighters');
        $this->Fighters->Levelup(1);
        $fighter = $this->Fighters->getFighterById($id);
        $this->set('fighter', $fighter);
    }

    public function createFighter() {

        //$this->Fighters->find("all");




        $this->loadModel('Figàhters');
        $fightersTable = $this->Fighters;
        $newFighter = $this->request->getData();
        if (isset($newFighter['name'])&&($newFighter['name'])!='') {
            $newId = $this->Fighters->addFighter($newFighter, $fightersTable);
            $this->redirect(['controller' => 'Arenas', 'action' => 'fighter', $newId]);
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
        $this->Fighters->goUp(1, 1);
        $this->redirect(
                ['controller' => 'Arenas', 'action' => 'sight']);
        // return $this->requestAction('sight');
    }

}
