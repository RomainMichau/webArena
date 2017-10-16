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
    }
    public function fighter()
    {
        $this->loadModel('Fighters');
        $this->Fighters->passerLeNiveau(1);
        $fighter=$this->Fighters->getFighterById(1);
        $this->set('fighter', $fighter);
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