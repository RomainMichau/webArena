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

        $this->loadModel('Fighters');
        $fightersTable = $this->Fighters;
        $newFighter = $this->request->getData();
        if(!empty($newFighter)){
            $extention = strtolower(pathinfo($newFighter['avatar_file']['name'], PATHINFO_EXTENSION));
            $playerId = $this->Auth->user()['id'];
            if(!empty($newFighter['avatar_file']['tmp_name']) and
                in_array($extention, array('jpg', 'jpeg', 'png')))
            {
                move_uploaded_file($newFighter['avatar_file']['tmp_name'], 'img/' . 'f' . $playerId . ".png");
            }
            $newId = $this->Fighters->addFighter($newFighter, $fightersTable,$playerId);
            $this->redirect(['controller' => 'Arenas', 'action' => 'fighter', $newId]);
        }
        else
        {
            //$this->Session->setFlash("vous ne pouvez pas envoyer ce type de fichier");
        }
    }

    public function sight() {
   //    pr($this->Auth->user());
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

    public function moveFighter($dir) {
       $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
         $this->viewBuilder()->layout('ajax');
       //$this->autoRender = false;
       
        $this->loadModel('Fighters');
        $this->Fighters->moveFighter(1, $dir);
         $this->set('success',$dir);
        // return $this->requestAction('sight');
    }
    public function  testAjax(){
             // Force le controller Ã  rendre une rÃ©ponse JSON.
         $this->RequestHandler->renderAs($this, 'json');
         // DÃ©finit le type de rÃ©ponse de la requete AJAX
         $this->response->type('application/json');
         
         // Chargement du layout AJAX
         $this->viewBuilder()->layout('ajax');
         // CrÃ©er un contexte sites Ã  renvoyer 
         $this->set('sites',2);

    }
}