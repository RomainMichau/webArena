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

        for ($i = 0; $i < 15; $i++) {
            for ($j = 0; $j < 10; $j++) {
                if ($this->Fighters->getFighterByCoord($i, $j) != NULL) {
                    $tab[$i][$j] = $this->Fighters->getFighterByCoord($i, $j);
                } else {
                    $tab[$i][$j] = 2;
                }
            }
        }
      //  pr($tab);
    }

    public function diary() {
        $this->set('titredepage', "diary");
    }

}
