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

    function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'fighters']);
    }

    public function index() {
        $this->set('titredepage', "index");
    }

    public function fighters() {
        $this->loadModel('Fighters');
        $fighters = $this->Fighters->getAllFighters();
        $this->set('fighters', $fighters);
    }


    public function fighter() {

        $this->loadModel('Fighters');
        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
       
        $this->set('fighter', $fighter);
    }

    public function createFighter() {

        $this->loadModel('Fighters');
        $fightersTable = $this->Fighters;
        $newFighter = $this->request->getData();
        if (!empty($newFighter)) {
            $extention = strtolower(pathinfo($newFighter['avatar_file']['name'], PATHINFO_EXTENSION));
            if ($newFighter['name']) {
                $player_id = $this->Auth->user()['id'];
                $newId = $this->Fighters->addFighter($newFighter, $fightersTable, $player_id);
                if($newFighter['avatar_file']['tmp_name'] and in_array($extention, array('jpg', 'jpeg', 'png')))
                {
                    move_uploaded_file($newFighter['avatar_file']['tmp_name'], 'img/' . 'f' . $newId . ".png");
                }
                else
                {
                    copy('img/' . 'img_not_found.png', 'img/' . 'f' . $newId . ".png");
                }
                $this->redirect(['controller' => 'Arenas', 'action' => 'fighter', $newId]);
            }
        }
    }

    public function editFighter($id)
    {
        $this->loadModel('Fighters');
        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        $fightersTable = $this->Fighters;

        $this->set('fighter', $fighter);

        $updateFighter = $this->request->getData();


        if (!empty($updateFighter)) {
            $extention = strtolower(pathinfo($updateFighter['avatar_file']['name'], PATHINFO_EXTENSION));
            $this->Fighters->updateFighter($updateFighter, $fightersTable, $id);
            if ($updateFighter['name']) {
                if($updateFighter['avatar_file']['tmp_name'] and in_array($extention, array('jpg', 'jpeg', 'png')))
                {
                    move_uploaded_file($updateFighter['avatar_file']['tmp_name'], 'img/' . 'f' . $id . ".png");
                }
            }
            $this->redirect(['controller' => 'Arenas', 'action' => 'fighter', $id]);
        }
    }

    public function sight() {
        $session = $this->request->session();
        $session->write('c', 5);
        // pr(self::$pri);
        //  pr($this->Auth->user());
        $this->loadModel('Fighters');
        $this->loadModel('Events');
        //pr($this->Events->tst());



        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        //  pr(  $ennemy=$this->Fighters->getFighterByCoord($fighter->coordinate_x+1, $fighter->coordinate_y));
        $this->set('titredepage', "sight");

        // pr($this->Fighters->getAllFighrersByPlayerId($this->Auth->user()['id'])[0]);
        $this->loadModel('Surroundings');
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
        $this->set('vue', $fighter->skill_sight);
        $this->set('fid', $fighter->id);
        $this->set('jx', $fighter->coordinate_x);
        $this->set('jy', $fighter->coordinate_y);

        //   $this->tst();
    }

    public function diary() {
        $this->set('titredepage', "diary");
    }

    public function moveFighter($dir) {
        $session = $this->request->session();
        $session->write('c', 5);
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->viewBuilder()->layout('ajax');
        // $this->set('pri', $session->read('c'));
        $this->loadModel('Fighters');
        $this->loadModel('Surroundings');
        $success = 0;
        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        $id = $fighter->id;
        $x = $fighter->coordinate_x;
        $y = $fighter->coordinate_y;
        if ($dir == 1) {
            $ennemy = $this->Fighters->getFighterByCoord($x + 1, $y);
        }
        if ($dir == 2) {
            $ennemy = $this->Fighters->getFighterByCoord($x - 1, $y);
        }
        if ($dir == 3) {
            $ennemy = $this->Fighters->getFighterByCoord($x, $y - 1);
        }
        if ($dir == 4) {
            $ennemy = $this->Fighters->getFighterByCoord($x, $y + 1);
        }
        if ($ennemy == NULL) {
            $success = $this->Fighters->moveFighter($id, $dir);
        }
        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];


        $nx = $fighter->coordinate_x;
        $ny = $fighter->coordinate_y;
        $v = $fighter->skill_sight;
        $tab = array();
        if ($success == 1 && $dir == 1) {
            for ($i = 1; $i <= $v + 1; $i++) {
                $res1 = $this->Fighters->getFighterByCoord($x + $i, $y - $v + $i - 1);
                if (isset($res1)) {
                    array_push($tab, array($x + $i, $y - $v + $i - 1, 'f' . $res1->id));
                } else {
                    $res12 = $this->Surroundings->getSurroundingByCoord($x + $i, $y - $v + $i - 1);

                    if (isset($res12)) {
                        array_push($tab, array($x + $i, $y - $v + $i - 1, 's' . $res12->id));
                    }
                }

                $res2 = $this->Fighters->getFighterByCoord($x + $i, $y + $v - $i + 1);
                if (isset($res2)) {
                    array_push($tab, array($x + $i, $y + $v - $i + 1, 'f' . $res2->id));
                } else {
                    $res22 = $this->Surroundings->getSurroundingByCoord($x + $i, $y + $v - $i + 1);

                    if (isset($res22)) {
                        array_push($tab, array($x + $i, $y + $v - $i + 1, 's' . $res22->id));
                    }
                }
            }
        }


        if ($success == 1 && $dir == 2) {
            for ($i = 1; $i <= $v + 1; $i++) {
                $res1 = $this->Fighters->getFighterByCoord($x - $i, $y - $v + $i - 1);
                if (isset($res1)) {
                    array_push($tab, array($x - $i, $y - $v + $i - 1, 'f' . $res1->id));
                } else {
                    $res12 = $this->Surroundings->getSurroundingByCoord($x - $i, $y - $v + $i - 1);

                    if (isset($res12)) {
                        array_push($tab, array($x - $i, $y - $v + $i - 1, 's' . $res12->id));
                    }
                }

                $res2 = $this->Fighters->getFighterByCoord($x - $i, $y + $v - $i + 1);
                if (isset($res2)) {
                    array_push($tab, array($x - $i, $y + $v - $i + 1, 'f' . $res2->id));
                } else {
                    $res22 = $this->Surroundings->getSurroundingByCoord($x - $i, $y + $v - $i + 1);

                    if (isset($res22)) {
                        array_push($tab, array($x - $i, $y + $v - $i + 1, 's' . $res22->id));
                    }
                }
            }
        }

        if ($success == 1 && $dir == 2) {
            for ($i = 1; $i <= $v + 1; $i++) {
                $res1 = $this->Fighters->getFighterByCoord($x - $i, $y - $v + $i - 1);
                if (isset($res1)) {
                    array_push($tab, array($x - $i, $y - $v + $i - 1, 'f' . $res1->id));
                } else {
                    $res12 = $this->Surroundings->getSurroundingByCoord($x - $i, $y - $v + $i - 1);

                    if (isset($res12)) {
                        array_push($tab, array($x - $i, $y - $v + $i - 1, 's' . $res12->id));
                    }
                }

                $res2 = $this->Fighters->getFighterByCoord($x - $i, $y + $v - $i + 1);
                if (isset($res2)) {
                    array_push($tab, array($x - $i, $y + $v - $i + 1, 'f' . $res2->id));
                } else {
                    $res22 = $this->Surroundings->getSurroundingByCoord($x - $i, $y + $v - $i + 1);

                    if (isset($res22)) {
                        array_push($tab, array($x - $i, $y + $v - $i + 1, 's' . $res22->id));
                    }
                }
            }
        }

        if ($success == 1 && $dir == 3) {
            for ($i = 1; $i <= $v + 1; $i++) {
                $res1 = $this->Fighters->getFighterByCoord($x - $v + $i - 1, $y - $i);
                if (isset($res1)) {
                    array_push($tab, array($x - $v + $i - 1, $y - $i, 'f' . $res1->id));
                } else {
                    $res12 = $this->Surroundings->getSurroundingByCoord($x - $v + $i - 1, $y - $i);

                    if (isset($res12)) {
                        array_push($tab, array($x - $v + $i - 1, $y - $i, 's' . $res12->id));
                    }
                }

                $res2 = $this->Fighters->getFighterByCoord($x + $v - $i + 1, $y - $i);
                if (isset($res2)) {
                    array_push($tab, array($x + $v - $i + 1, $y - $i, 'f' . $res2->id));
                } else {
                    $res22 = $this->Surroundings->getSurroundingByCoord($x + $v - $i + 1, $y - $i);

                    if (isset($res22)) {
                        array_push($tab, array($x + $v - $i + 1, $y - $i, 's' . $res22->id));
                    }
                }
            }
        }

        if ($success == 1 && $dir == 4) {
            for ($i = 1; $i <= $v + 1; $i++) {
                $res1 = $this->Fighters->getFighterByCoord($x - $v + $i - 1, $y + $i);
                if (isset($res1)) {
                    array_push($tab, array($x - $v + $i - 1, $y + $i, 'f' . $res1->id));
                } else {
                    $res12 = $this->Surroundings->getSurroundingByCoord($x - $v + $i - 1, $y + $i);

                    if (isset($res12)) {
                        array_push($tab, array($x - $v + $i - 1, $y + $i, 's' . $res12->id));
                    }
                }

                $res2 = $this->Fighters->getFighterByCoord($x + $v - $i + 1, $y + $i);
                if (isset($res2)) {
                    array_push($tab, array($x + $v - $i + 1, $y + $i, 'f' . $res2->id));
                } else {
                    $res22 = $this->Surroundings->getSurroundingByCoord($x + $v - $i + 1, $y + $i);

                    if (isset($res22)) {
                        array_push($tab, array($x + $v - $i + 1, $y + $i, 's' . $res22->id));
                    }
                }
            }
        }


        $this->set('tab', $tab);
        $this->set('vue', $v);
        $this->set('success', $success);
        $this->set('nx', $nx);
        $this->set('x', $x);
        $this->set('ny', $ny);
        $this->set('y', $y);
        // return $this->requestAction('sight');
    }

    public function attack($dir) {
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->viewBuilder()->layout('ajax');
        $this->loadModel('Fighters');
        $this->loadModel('Events');
        $this->set('success', 0);
        $this->set('death', 0);
        $myfighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        // $ennemy=$this->Fighters->getFighterByCoord($myfighter->coordinate_x+1, $myfighter->coordinate_y);
        if ($dir == 1) {


            $ennemy = $this->Fighters->getFighterByCoord($myfighter->coordinate_x + 1, $myfighter->coordinate_y);
        }
        if ($dir == 2) {
            $ennemy = $this->Fighters->getFighterByCoord($myfighter->coordinate_x - 1, $myfighter->coordinate_y);
        }
        if ($dir == 3) {
            $ennemy = $this->Fighters->getFighterByCoord($myfighter->coordinate_x, $myfighter->coordinate_y - 1);
        }
        if ($dir == 4) {
            $ennemy = $this->Fighters->getFighterByCoord($myfighter->coordinate_x, $myfighter->coordinate_y + 1);
        }
        $this->set('ennemy', 0);
        if (isset($ennemy)) {
            $this->set('name', $ennemy->name);
            $this->set('eid', $ennemy->id);
            $this->set('x', $ennemy->coordinate_x);
            $this->set('y', $ennemy->coordinate_y);
            $this->set('ennemy', 1);
           
            $x = $myfighter->coordinate_x;
            $y = $myfighter->coordinate_y;
               

            $r = rand(1, 20);
            if ($r > 10 + $ennemy->level - $myfighter->level) {
                 $name = $myfighter->name . " attaque " . $ennemy->name;
                $this->Fighters->setHealth($ennemy->id, $ennemy->current_health - $myfighter->skill_strength);
                $ennemy = $this->Fighters->getFighterById($ennemy->id);
                $this->set('success', 1);
                $this->Fighters->xpUp($myfighter->id, 1);
                if ($ennemy->current_health <= 0) {
                    
                    $this->Fighters->xpUp($myfighter->id, $ennemy->level);
                    $this->set('death', 1);
                     $name = $myfighter->name . " a tué " . $ennemy->name;
                    $this->Fighters->deleteFighter($ennemy->id);
                }
                $this->set('health', $ennemy->current_health);
                $this->set('f', 10 + $ennemy->level - $myfighter->level);
            }else{
                 $name = $ennemy->name.' esquive un coup de '. $myfighter->name;
            }
             $this->Events->addEvent($name, $x, $y);
        }
        $this->set('id', $this->Auth->user()['id']);
    }

    public function detect($coord) {
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->viewBuilder()->layout('ajax');
        $this->loadModel('Fighters');
        $this->loadModel('Surroundings');
        $success = 0;
        $y = $coord % 10;
        if ($y == 0) {
            $y = 10;
        }
        $x = floor($coord / 10) + 1;
        $ennemy = $this->Fighters->getFighterByCoord($x, $y);


        if (!isset($ennemy)) {
            $sur = $this->Surroundings->getSurroundingByCoord($x, $y);
            if (isset($sur)) {
                $success = 1;
                $this->set('cx', $sur->coordinate_x);
                $this->set('cy', $sur->coordinate_y);
                $this->set('type', 2);   //type2 : objet
                $this->set('obj', $sur);
            }
        } else {
            $success = 1;
            $this->set('cx', $ennemy->coordinate_x);
            $this->set('cy', $ennemy->coordinate_y);
            $this->set('type', 1);   //type1 : fighter
            $this->set('obj', $ennemy);
        }
        $this->set('success', $success);
    }

    public function skillSightUp() {
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->viewBuilder()->layout('ajax');

        $this->loadModel('Fighters');

        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        $this->Fighters->skillSightUp($fighter->id);
    }

    public function skillStrengthUp() {
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->viewBuilder()->layout('ajax');

        $this->loadModel('Fighters');

        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        $this->Fighters->skillStrengthUp($fighter->id);
    }

    public function skillHealthUp() {
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->viewBuilder()->layout('ajax');

        $this->loadModel('Fighters');

        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        //$this->set('name',$fighter);

        $this->Fighters->skillHealthUp($fighter->id);
    }

}
