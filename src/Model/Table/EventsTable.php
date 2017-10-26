<?php

namespace App\Model\Table;

use Cake\ORM\Table;

/**
 * Description of EventsTable
 *
 * @author romai
 */
class EventsTable extends Table {

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
     * [getVisibleLatestEvents]
     * @param  [int] $fighter_x   [fighter x pos]
     * @param  [int] $fighter_y   [fighter y pos]
     * @param  [int] $sight_skill [number of sight skill]
     * @return [visible recent events] [null if none]
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
        ->where(function ($exp, $q) use ($start_date, $end_date) { return $exp->between('date', $start_date, $end_date); });

        // Event visible if |fighter_x - event_x| + |fighter_y - event_y| <= sight_skill
        $man_dist = $query->newExpr('ABS(' . $fighter_x . '-coordinate_x) + ABS(' . $fighter_y . '-coordinate_y)');
        $query->andWhere([$sight_skill . ' >=' => $man_dist]);
        
        // Query execution and return
        return ($query->isEmpty()) ? null : $query->toArray();
    }
}
