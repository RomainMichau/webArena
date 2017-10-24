<?php

namespace App\Model\Table;

use Cake\ORM\Table;


/**
 * Description of EventsTable
 *
 * @author romai
 */
class EventsTable extends Table {
    //put your code here
    public function tst(){
    return("oki");
    }
    public  function addEvent($name,$x,$y){
       $event= $this->newEntity();
        $d=date('Y-m-d H:i:s');
        $event->name=$name;
        $event->coordinate_x=$x;
        $event->coordinate_y=$y;
        $event->date=$d;
        $this->save($event);
        
              
        
        
    }
}
