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
        $this->loadModel('Fighters');
        $figterlist=$this->Fighters->getBestFighter();
        pr($figterlist);

    }
    
    /*public function login()
    {        
         $this->set('titredepage', "login");
         
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(['action' => 'figther']);
            } else {
                $this->Flash->error(__('Username or password is incorrect'));
                $this->redirect(['action' => 'index']);
            }
        }  
    }    */
    
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