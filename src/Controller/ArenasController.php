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

    public function sight() {
        
        $this->set('titredepage', "sight");
        $this->loadModel('Fighters');
        $this->loadModel('Surroundings');
        
        for ($i = 1; $i <= 15; $i++) {
            for ($j = 1 ; $j <= 10; $j++) {
                if ($this->Fighters->getFighterByCoord($i, $j) != NULL) {
                    $tab[$i][$j] = 'f'.$this->Fighters->getFighterByCoord($i, $j)->id;
                  //  pr($tab[$i][$j]);
                } elseif($this->Surroundings->getSurroundingByCoord($i, $j)!=NULL) {
                    $tab[$i][$j] = 's'.$this->Surroundings->getSurroundingByCoord($i, $j)->id;
                }
                else{$tab[$i][$j]='vide';}
            }
        }
      $this->set('tab',$tab);
   //   $this->tst();
    }

    public function diary() {
        $this->set('titredepage', "diary");
    }
    
    public function moveFighter(){pr("oki");}

}
