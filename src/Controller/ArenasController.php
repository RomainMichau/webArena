<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Personal Controller
 * User personal interface
 *
 */
class ArenasController extends AppController {

    function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['sight', 'index', 'fighters']);
    }
    
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
        $fighters = $this->Fighters->getAllFighters();
        $this->set('fighters', $fighters);
    }

    public function fightersByPlayer() {
        $this->loadModel('Fighters');
        $user = $this->Auth->user();
        $player_id = $user['id'];
        $fighters = $this->Fighters->getAllFightersByPlayerId($player_id);
        $this->set('fighters', $fighters);
    }

    public function fighter($id) {
        $this->loadModel('Fighters');
        $this->Fighters->Levelup($id);
        $fighter = $this->Fighters->getFighterById($id);
        $this->set('fighter', $fighter);
    }

    public function createFighter() {

        //$this->Fighters->find("all");

        $this->loadModel('Fighters');
        $fightersTable = $this->Fighters;
        $newFighter = $this->request->getData();
        if (!empty($newFighter)) {
            $player_id = $this->Auth->user()['id'];
            $newId = $this->Fighters->addFighter($newFighter, $fightersTable, $player_id);
            $this->redirect(['controller' => 'Arenas', 'action' => 'fighter', $newId]);
            $extention = strtolower(pathinfo($newFighter['avatar_file']['name'], PATHINFO_EXTENSION));
            $playerId = $this->Auth->user()['id'];
            if (!empty($newFighter['avatar_file']['tmp_name']) and
                    in_array($extention, array('jpg', 'jpeg', 'png'))) {
                move_uploaded_file($newFighter['avatar_file']['tmp_name'], 'img/' . 'f' . $newId . ".png");
            }
        } else {
            //$this->Session->setFlash("vous ne pouvez pas envoyer ce type de fichier");
        }
    }

    public function sight() {
      
     //  pr($this->Auth->user());
        $this->loadModel('Fighters');
      
        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        //  pr(  $ennemy=$this->Fighters->getFighterByCoord($fighter->coordinate_x+1, $fighter->coordinate_y));
        $this->set('titredepage', "sight");

        // pr($this->Fighters->getAllFighrersByPlayerId($this->Auth->user()['id'])[0]);
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

        $this->set('fid', $fighter->id);
        $this->set('x', $fighter->coordinate_x);
        $this->set('y', $fighter->coordinate_y);

        //   $this->tst();
    }

    public function diary() {
        $this->set('titredepage', "diary");
    }

    public function moveFighter($dir) {
        
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->viewBuilder()->layout('ajax');      
        $this->loadModel('Fighters');
        $fighter = $this->Fighters-> getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        $id = $fighter->id;
        $success=$this->Fighters->moveFighter($id, $dir);
        $fighter = $this->Fighters-> getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        $x = $fighter->coordinate_x;
        $y = $fighter->coordinate_y;
        $this->set('success', $success);
        $this->set('x', $x);
        $this->set('y', $y);
        // return $this->requestAction('sight');
    }
    
    public function attack($dir){
         $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->viewBuilder()->layout('ajax');
          $this->loadModel('Fighters');
         
       $myfighter=$this->Fighters-> getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        // $ennemy=$this->Fighters->getFighterByCoord($myfighter->coordinate_x+1, $myfighter->coordinate_y);
              if($dir==1)
        {
        
        
            $ennemy=$this->Fighters->getFighterByCoord($myfighter->coordinate_x+1, $myfighter->coordinate_y);   
        }
      if($dir==2)
        {
            $ennemy=$this->Fighters->getFighterByCoord($myfighter->coordinate_x-1, $myfighter->coordinate_y);
        }
        if($dir==3)
        {
           $ennemy= $this->Fighters->getFighterByCoord($myfighter->coordinate_x, $myfighter->coordinate_y-1);
        }
        if($dir==4)
        {
            $ennemy=$this->Fighters->getFighterByCoord($myfighter->coordinate_x, $myfighter->coordinate_y+1);
        }
             if($ennemy!=null){
             $this->set('en',$ennemy->id);}
             else{ $this->set('en','i');}
       //$this->set('en',2);
    }
    

}
