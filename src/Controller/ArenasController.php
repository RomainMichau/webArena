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
        if(!empty($newFighter)){
            $extention = strtolower(pathinfo($newFighter['avatar_file']['name'], PATHINFO_EXTENSION));
            $playerId = 3;
            if(!empty($newFighter['avatar_file']['tmp_name']) and
                in_array($extention, array('jpg', 'jpeg', 'png')))
            {
                move_uploaded_file($newFighter['avatar_file']['tmp_name'], 'img/' . 'f' . $playerId . ".png");
            }
            $newId = $this->Fighters->addFighter($newFighter, $fightersTable);
            $this->redirect(['controller' => 'Arenas', 'action' => 'fighter', $newId]);
        }
        else
        {
            //$this->Session->setFlash("vous ne pouvez pas envoyer ce type de fichier");
        }
    }

    public function sight() {
       // pr(APP."Arenas");
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
    public function  testAjax(){
             // Force le controller à rendre une réponse JSON.
         $this->RequestHandler->renderAs($this, 'json');
         // Définit le type de réponse de la requete AJAX
         $this->response->type('application/json');
         
         // Chargement du layout AJAX
         $this->viewBuilder()->layout('ajax');
         // Créer un contexte sites à renvoyer 
         $this->set('sites',2);

}
}