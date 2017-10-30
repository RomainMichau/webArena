<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
/**
 * Description of Parameter
 *
 * @author romai
 */
class ParametersTable extends Table {
   private static $SIZE_X = 15; 
   private static $SIZE_Y = 10; 
 
   
    public function get_size_x(){
        return static::$SIZE_X;
    }
    public function get_size_y(){
        return static::$SIZE_Y;
    }
    

    //put your code here
}
