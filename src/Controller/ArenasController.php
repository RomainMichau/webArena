<?php
namespace App\Controller;
use App\Controller\AppController;
/**
 * Personal Controller
 * User personal interface
 *
 */
class ArenasController  extends AppController
{
    public function index()
    {
         $this->set('titredepage', "index");
    }
    public function login()
    {
        $this->set('titredepage', "login");
        $this->loadModel('Fighters');
        $figterlist=$this->Fighters->getBestFighter();
        $this->set('titredepage', $figterlist[0]->name);

    }
    public function fighter()
    {
         $this->set('titredepage', "fighter");
    }
    public function sight()
    {
         $this->set('titredepage', "sight");

    }
    public function diary()
    {
         $this->set('titredepage', "diary");

    }
}