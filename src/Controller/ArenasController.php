<?php

namespace App\Controller;

use Cake\I18n\Time;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Validation\Validator;

/**
 * Personal Controller
 * User personal interface
 *
 */
class ArenasController extends AppController {

    public function hasAFighter() {
        $this->loadModel('Fighters');
        $fighters = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id']);
        //   pr($fighters);
        if ($fighters == NULL) {
            //  pr('zsdertdefrg');
            $this->redirect(['controller' => 'Arenas', 'action' => 'createFighter', 1]);
            return false;
        } else {
            return true;
        }
    }

    function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
    }

    public function index() {
        $this->set('titredepage', 'Accueil');
    }

    // SIGHT



    public function sight() {

        if (!$this->hasAFighter()) {
            return null;
        }
        // Mise à jour des fighters dans la session
        $this->updateSession();

        // pr(self::$pri);
        //  pr($this->Auth->user());
        $this->loadModel('Fighters');
        $this->loadModel('Events');
        $this->loadModel('Parameters');

        //pr($this->Events->tst());
        date_default_timezone_set('Europe/Paris');
        //$myfighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        // $time = new Time($myfighter->next_action_time);
        // $time2=new Time(Time::now());
        //$time3=new Time(Time::now()->addSeconds(-50));
        //    pr($time3);
        // pr($this->Fighters->getActionTime());

        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];


        //  pr(  $ennemy=$this->Fighters->getFighterByCoord($fighter->coordinate_x+1, $fighter->coordinate_y));
        $this->set('titredepage', 'Vision');
        $this->set('actionmax', $this->Fighters->getMaxAction());
        $this->set('actiontime', $this->Fighters->getActionTime());
        $this->set('sizex', $this->Parameters->get_size_x());
        $this->set('sizey', $this->Parameters->get_size_y());

        // pr($this->Fighters->getAllFighrersByPlayerId($this->Auth->user()['id'])[0]);
        $this->loadModel('Surroundings');
        // pr();
        for ($i = 1; $i <= $this->Parameters->get_size_x(); $i++) {
            for ($j = 1; $j <= $this->Parameters->get_size_y(); $j++) {
                if ($this->Fighters->getFighterByCoord($i, $j) != NULL) {
                    $tab[$j][$i] = 'f' . $this->Fighters->getFighterByCoord($i, $j)->id;
                    //  pr($tab[$i][$j]);
                } elseif ($this->Surroundings->getSurroundingByCoord($i, $j) != NULL) {
                    $tab[$j][$i] = 's' . $this->Surroundings->getSurroundingByCoord($i, $j)->id;
                } else {
                    $tab[$j][$i] = 'vide';
                }
            }
        }
        //     pr($tab);
        $this->set('fighter', $fighter);
        $this->set('tab', $tab);
        $this->set('vue', $fighter->skill_sight);
        $this->set('fid', $fighter->id);
        $this->set('jx', $fighter->coordinate_x);
        $this->set('jy', $fighter->coordinate_y);

        // Id du fighter dans la session si on ne l'a pas déjà fait
        if (!$this->request->session()->read('user_fighter_id'))
            $this->request->session()->write('user_fighter_id', $fighter['id']);
    }

    //DIARY

    public function diary() {

        // Checks if fighter is dead
        if (!$this->hasAFighter()) {
            return null;
        }
        // Mise à jour des fighters dans la session
        $this->updateSession();

        // Loading of models and curent visible events
        $this->loadModel('Fighters');
        $this->loadModel('Events');

        $this->set('titredepage', 'Journal');

        // Gets fighter of player
        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];

        // Gets all visible latest events for that fighter
        $this->set('events', $this->Events->getVisibleLatestEvents($fighter->coordinate_x, $fighter->coordinate_y, $fighter->skill_sight));
    }

    public function guilds() {

        if (!$this->hasAFighter()) {
            return null;
        }

        // Mise à jour des fighters dans la session
        $this->updateSession();

        $this->loadModel('Fighters');
        $this->loadModel('Guilds');
        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        $guilds = $this->Guilds->getAllGuilds();
        $this->set('guilds', $guilds);
        $this->set('fighter', $fighter);


        $newGuild = $this->request->getData();

        if ($newGuild) {
            $idNewGuild = $this->Guilds->addGuild($newGuild);
            $this->joinGuild($idNewGuild);
            $this->redirect(['controller' => 'Arenas', 'action' => 'guilds']);
        }
    }

    public function joinGuild($newidGuild, $oldidGuild = NULL) {
        $this->loadModel('Fighters');
        $this->loadModel('Guilds');
        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];


        $this->Fighters->updateGuildId($newidGuild, $fighter);
        if ($newidGuild != 0) {
            $this->redirect(['controller' => 'Arenas', 'action' => 'guild', $newidGuild]);
        } else {  // pr($idGuild);
            if ($this->Fighters->nbMembre($oldidGuild) <= 0) {
                //  $this->Guilds->deleteGuilds($oldidGuild);
            }
            $this->redirect(['controller' => 'Arenas', 'action' => 'guilds']);
        }
    }

    public function guild($id) {

        if (!$this->hasAFighter()) {
            return null;
        }

        // Mise à jour des fighters dans la session
        $this->updateSession();

        $this->loadModel('Fighters');
        $this->loadModel('Guilds');
        $guid = $this->Guilds->getGuild($id);
        $fighters = $this->Fighters->getFightersOfGuild($id);
        $this->set('nb', $this->Fighters->nbMembre($id));
        $this->set('guild', $guid);
        $this->set('fighters', $fighters);
    }

    //FIGHTER
    public function fighters() {

        $this->loadModel('Fighters');
        $fighters = $this->Fighters->getAllFighters();
        $idFighterAuth = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0]->id;
        $this->set('fighters', $fighters);
        $this->set('idFighterAuth', $idFighterAuth);
    }

    public function fighter() {

        if (!$this->hasAFighter()) {
            return null;
        }

        // Mise à jour des fighters dans la session
        $this->updateSession();

        $this->hasAFighter();
        $this->loadModel('Fighters');

        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];

        $this->set('fighter', $fighter);
    }

    public function createFighter($d) {


        //$this->Fighters->find("all");
        $this->set('dead', $d);
        $validator = new Validator();


        $this->loadModel('Fighters');
        $this->loadModel('Parameters');
        $this->loadModel('Surroundings');


        do {
            $x = rand(1, $this->Parameters->get_size_x());
            $y = rand(1, $this->Parameters->get_size_y());
        } while (
        null != ($this->Fighters->getFighterByCoord($x, $y)) || null != $this->Surroundings->getSurroundingByCoord($x, $y));

        $newFighter = $this->request->getData();


        if (!empty($newFighter)) {
            $validator->requirePresence('name')->notEmpty('name', 'Please fill this field');
            $errors = $validator->errors($this->request->getData());
            if (!$errors) {
                $extention = strtolower(pathinfo($newFighter['avatar_file']['name'], PATHINFO_EXTENSION));
                if ($newFighter['name']) {
                    $player_id = $this->Auth->user()['id'];
                    $newId = $this->Fighters->addFighter($newFighter, $player_id, $x, $y);
                    if ($newFighter['avatar_file']['tmp_name'] and in_array($extention, array('jpg', 'jpeg', 'png'))) {
                        move_uploaded_file($newFighter['avatar_file']['tmp_name'], 'img/' . 'f' . $newId . ".png");
                    } else {
                        copy('img/' . 'img_not_found.png', 'img/' . 'f' . $newId . ".png");
                    }
                    $this->request->session()->write('user_fighter_id', $newId);               // Id du fighter dans la session
                    $this->redirect(['controller' => 'Arenas', 'action' => 'sight']);
                }
            }
        }
    }

    public function editFighter($id) {

        if (!$this->hasAFighter()) {
            return null;
        }

        // Mise à jour des fighters dans la session
        $this->updateSession();

        $this->loadModel('Fighters');
        $validator = new Validator();

        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];

        $this->set('fighter', $fighter);

        $updateFighter = $this->request->getData();



        if (!empty($updateFighter)) {
            $validator->requirePresence('name')->notEmpty('name', 'Please fill this field');
            $errors = $validator->errors($this->request->getData());
            if (!$errors) {
                $extention = strtolower(pathinfo($updateFighter['avatar_file']['name'], PATHINFO_EXTENSION));
                $this->Fighters->updateFighter($updateFighter, $id);
                if ($updateFighter['avatar_file']['tmp_name'] and in_array($extention, array('jpg', 'jpeg', 'png'))) {
                    move_uploaded_file($updateFighter['avatar_file']['tmp_name'], 'img/' . 'f' . $id . ".png");
                }
                $this->redirect(['controller' => 'Arenas', 'action' => 'fighter', $id]);
            }
        }
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


        $action = 0;
        $max = $this->Fighters->getMaxAction();
        $timeaction = $this->Fighters->getActionTime();

        $ti = new Time($fighter->next_action_time);
        $time = new Time($ti);
        $time->setDateTime($ti->year, $ti->month, $ti->day, $ti->hour, $ti->minute, $ti->second);
        $i = 1;
        if ($max > 1) {
            $i = $max - 1;
        }



        for ($i; $i >= 1; $i = $i - 1) {

            if ($time->wasWithinLast((($i + 1) * $timeaction) - 1 . ' seconds') && !$time->wasWithinLast(($i * $timeaction) - 1 . ' seconds')) {
                $time2 = $time;
                $action = 1;
                $this->set('t11', $time2);
                $time2->addSecond($timeaction / 2);
                $this->set('t12', $time2);
                $this->Fighters->setNextActionTime($fighter->id, $time2);
            }
        }

        if (!$time->wasWithinLast((($max + 1) * $timeaction) - 1 . ' seconds')) {
            $action = 1;


            $time = Time::now();
            $this->set('t21', $time);
            $this->set('t', $time->addSecond(- $timeaction * ($max - 1)));
            $this->set('t22', $time);
            $this->Fighters->setNextActionTime($fighter->id, $time);
        }
        $this->set('action', $action);

        if ($action == 1) {


            if ($dir == 1) {
                $ennemy = $this->Fighters->getFighterByCoord($x + 1, $y);
                $sur = $this->Surroundings->getSurroundingByCoord($x + 1, $y);
            }
            if ($dir == 2) {
                $ennemy = $this->Fighters->getFighterByCoord($x - 1, $y);
                $sur = $this->Surroundings->getSurroundingByCoord($x - 1, $y);
            }
            if ($dir == 3) {
                $ennemy = $this->Fighters->getFighterByCoord($x, $y - 1);
                $sur = $this->Surroundings->getSurroundingByCoord($x, $y - 1);
            }
            if ($dir == 4) {
                $ennemy = $this->Fighters->getFighterByCoord($x, $y + 1);
                $sur = $this->Surroundings->getSurroundingByCoord($x, $y + 1);
            }
            if ($ennemy == NULL && $sur == NULL) {
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
        }
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


        // $time->addSecond(40);
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
        $time = new Time($myfighter->next_action_time);

        $action = 0;
        $max = $this->Fighters->getMaxAction();
        $timeaction = $this->Fighters->getActionTime();



        if (isset($ennemy)) {
            $this->set('ennemy', 1);
            $i = 1;
            if ($max > 1) {
                $i = $max - 1;
            }

            for ($i; $i >= 1; $i = $i - 1) {

                if ($time->wasWithinLast((($i + 1) * $timeaction) - 1 . ' seconds') && !$time->wasWithinLast(($i * $timeaction) - 1 . ' seconds')) {
                    $time2 = $time;
                    $action = 1;
                    $this->set('t11', $time2);
                    $time2->addSecond($timeaction / 2);
                    $this->set('t12', $time2);
                    $this->Fighters->setNextActionTime($myfighter->id, $time2);
                }
            }

            if (!$time->wasWithinLast((($max + 1) * $timeaction) - 1 . ' seconds')) {
                $action = 1;


                $time = Time::now();
                $this->set('t21', $time);
                $this->set('t', $time->addSecond(- $timeaction * ($max - 1)));
                $this->set('t22', $time);
                $this->Fighters->setNextActionTime($myfighter->id, $time);
            }
        }

        $this->set('action', $action);


        if (isset($ennemy) == 1 && $action == 1) {
            $this->set('name', $ennemy->name);
            $this->set('eid', $ennemy->id);
            $this->set('x', $ennemy->coordinate_x);
            $this->set('y', $ennemy->coordinate_y);


            $x = $myfighter->coordinate_x;
            $y = $myfighter->coordinate_y;


            $r = rand(1, 20);
            if ($r > 10 + $ennemy->level - $myfighter->level) {
                $name = $myfighter->name . " attaque " . $ennemy->name;
                $cvoisin = 0;
                if (isset($myfighter->guild_id)) {

                    $voisin = $this->Fighters->getVoisin($ennemy->id);
                    for ($i = 0; $i < sizeof($voisin); $i++) {

                        if (isset($voisin[$i])) {
                            $this->set("guild", $voisin[$i]);
                            if ($voisin[$i]->guild_id == $myfighter->guild_id && $voisin[$i]->id != $myfighter->id) {
                                $cvoisin++;
                            }
                        }
                    }
                }
                $this->set('cvoisin', $cvoisin);
                $this->Fighters->setHealth($ennemy->id, $ennemy->current_health - $myfighter->skill_strength - $cvoisin);
                $ennemy = $this->Fighters->getFighterById($ennemy->id);
                $this->set('success', 1);
                $this->Fighters->xpUp($myfighter->id, 1);
                if ($ennemy->current_health <= 0) {

                    $this->Fighters->xpUp($myfighter->id, $ennemy->level);
                    $this->set('death', 1);
                    $this->set('idennemy', $ennemy->id);
                    $name = $myfighter->name . " a tué " . $ennemy->name;
                    $this->Fighters->deleteFighter($ennemy->id);
                }
                $this->set('health', $ennemy->current_health);
                $this->set('f', 10 + $ennemy->level - $myfighter->level);
            } else {
                $name = $ennemy->name . ' esquive un coup de ' . $myfighter->name;
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
        $this->loadModel('Parameters');
        $myfighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        $x2 = $myfighter->coordinate_x;
        $y2 = $myfighter->coordinate_y;
        $this->loadModel('Surroundings');
        $maxx = $this->Parameters->get_size_x();
        $success = 0;
        $x = $coord % $maxx;
        if ($x == 0) {
            $x = $maxx;
        }
        $y = (($coord - $x) / $maxx) + 1;

        $ennemy = $this->Fighters->getFighterByCoord($x, $y);
        //    $this->set("vue",abs($x-$x2)+abs($y-$y2));
        if (abs($x - $x2) + abs($y - $y2) > $myfighter->skill_sight) {
            $ennemy = null;
        }
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

    public function cri($m) {

        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->viewBuilder()->layout('ajax');

        $this->loadModel('Events');
        $this->loadModel('Fighters');
        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        $x = $fighter->coordinate_x;
        $y = $fighter->coordinate_y;
        $m = $fighter->name . " cri \"" . $m . "\"";
        $this->Events->addEvent($m, $x, $y);

        //$this->set('name',$fighter);
    }

    public function alertmessage() {
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->viewBuilder()->layout('ajax');
        $this->loadModel('Messages');
        $this->loadModel('Fighters');
        $tab =array();
        $time = new Time();
        $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
        $message = $this->Messages->getNewMessage($fighter->id);
        for ($i = 0; $i < sizeof($message); $i++) {
         //   $this->set("ok",1);
            $time = $message[$i]->date;

            $fighter2 = $this->Fighters->getFighterById($message[$i]->fighter_id_from);
            array_push($tab, $fighter2->id);
        }
        
        $this->set('tab', $tab);
        $this->set('id1', $fighter->id);

    }

    // Re-put every fighters info in session (apart from current player)
    public function updateSession() {
        $this->loadModel('Fighters');
        $fighters = $this->Fighters->getAllFighters();
        $idFighterAuth = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0]->id;

        $fighters_nb = count($fighters) - 1;                                // Minus current player
        $this->request->session()->write('fighters_nb', $fighters_nb);

        $fighter_no = 1;
        foreach ($fighters as $fighter) {
            if ($fighter->id !== $idFighterAuth) {
                $this->request->session()->write('fighter' . $fighter_no, $fighter);
                $fighter_no++;
            }
        }
    }
   public function messagelu($idfrom) {
          $this->set('done',1);

        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->viewBuilder()->layout('ajax');
        $this->loadModel('Messages');
        $this->loadModel('Fighters');
          $fighter = $this->Fighters->getAllFightersByPlayerId($this->Auth->user()['id'])[0];
   $this->Messages->setRead($idfrom,$fighter->id);
   $this->set('done',1);
   //$this->set('res',$this->Messages->checkread($idfrom,$fighter->id));
  // $this->set('$idfrom',$idfrom); $this-> set('$idto',$fighter->id);
   
   
   
   }
}
