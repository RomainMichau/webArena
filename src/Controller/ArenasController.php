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
        $user = $this->Auth->user();
        $player_id = $user['id'];
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
            $player_id = $this->Auth->user()['id'];
            $newId = $this->Fighters->addFighter($newFighter, $fightersTable, $player_id);
            $this->redirect(['controller' => 'Arenas', 'action' => 'fighter', $newId]);
            $extention = strtolower(pathinfo($newFighter['avatar_file']['name'], PATHINFO_EXTENSION));
            $playerId = $this->Auth->user()['id'];
            if(!empty($newFighter['avatar_file']['tmp_name']) and
                in_array($extention, array('jpg', 'jpeg', 'png')))
            {
                move_uploaded_file($newFighter['avatar_file']['tmp_name'], 'img/' . 'f' . $newId . ".png");
            }
        }
        else
        {
            //$this->Session->setFlash("vous ne pouvez pas envoyer ce type de fichier");
        }
    }

    public function sight() {
      pr($this->Auth->user());
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
        //$id=$thid->Fighters->currentFighter()->id;
        $id=2;
        $this->Fighters->moveFighter($id, $dir);
         $this->set('success',$id);
        // return $this->requestAction('sight');
    }
  
}