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
        date_default_timezone_set('Europe/Paris');
       $event= $this->newEntity();
        $d=date('Y-m-d H:i:s');
        $event->name=$name;
        $event->coordinate_x=$x;
        $event->coordinate_y=$y;
        $event->date=$d;
        $this->save($event);
        
              
        
        
    }

    /**
     * [getVisibleLatestEvents description]
     * @param  [type] $fighter_x   [description]
     * @param  [type] $fighter_y   [description]
     * @param  [type] $sight_skill [description]
     * @return [type]              [description]
     */
    public function getVisibleLatestEvents($fighter_x, $fighter_y, $sight_skill)
    {
        // Getting date interval [now - 1 day ; now]
        date_default_timezone_set('Europe/Paris');                           
        $now = date('Y-m-d H:i:s');                             // Current time with datetime format

        $end_date = \DateTime::createFromFormat('Y-m-d H:i:s', $now);
        
        $start_date = \DateTime::createFromFormat('Y-m-d H:i:s', $now);
        $start_date->modify('-1 day');

        // Query
        $query = $this->find();
        $query->select(['date', 'x' => 'coordinate_x', 'y' => 'coordinate_y', 'name'])
        ->where(function ($exp, $q) use ($start_date, $end_date) { return $exp->between('date', $start_date, $end_date); })

        /*
        ->andWhere(function ($exp, $q) use ($fighter_x, $fighter_y, $sight_skill) { 
            $dist_x = abs($fighter_x - coordinate_x);
            $dist_y = abs($fighter_y - coordinate_y);
        }); */

        // [(abs($fighter_x - coordinate_x) + abs($fighter_y - coordinate_y)) . ' <=' => $sight_skill . '']
        //->andWhere('' => $sight_skill);
        
        // Execution of query and return of result
        $query->hydrate(false);
        $result = $query->toList();

        return $result;
    }
}
