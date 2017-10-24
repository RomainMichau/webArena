<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use Cake\ORM\Table;

/**
 * Description of surroundings
 *
 * @author romaix
 */
class SurroundingsTable extends Table {

    public function getSurroundingByCoord($x, $y) {
        // $this->setSource('surroundings');
        $surrounding = $this->find('all')->from("surroundings")->where("coordinate_x=" . $x . " and coordinate_y=" . $y);
        //pr($fighter->toArray());
        if (sizeof($surrounding->toArray()) == 0) {

            return NULL;
        }
        return $surrounding->toArray()[0];
    }

    //put your code here
}
