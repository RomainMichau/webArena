<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class FightersTable extends Table
{
    public function test(){
        return "ok";
    }
    public function getBestFighter(){

        $figterlist=$this->find('all')->from("fighters")->where("id = 1");
        $figterlist = $figterlist->toArray();
        return $figterlist;
    }

}