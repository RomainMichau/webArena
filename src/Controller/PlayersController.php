<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Personal Controller
 * User personal interface
 *
 */
class PlayersController  extends AppController
{
      

    function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'index', 'login', 'logout', 'forgotPassword']);
    }
    
    public function index()
    {   
           
        $this->set('titredepage', "index2");

    }
    
    //Ajoute un utilisateur à la BDD a partir d'un username et password
    public function add()
    {
        $this->set('titredepage', "add2");
        
        //Crée un nouveau user
        $user = $this->Players->newEntity();
        
        //Dès qu'on submit le formulaire
        if ($this->request->is('post')) {
            
            /*
             *  A CHANGER (pas propre)
             */
            $user->id = uniqid(); //Donne un ID manuellement 
            $user->email = $this->request->getData("email"); //Récupère le username
            $user->password = $this->request->getData("password"); //Récupère le password
            
            
            if ($this->Players->save($user)) { //Si on arrive a sauvegarder
                $this->Flash->success(__('The user has been saved.')); //Succès
                
                $user = $this->Auth->identify();
                $this->Auth->setUser($user);
                
                return $this->redirect($this->Auth->redirectUrl()); //Redirige l'utilisateur vers l'url par défaut
            }
            $this->Flash->error(__('Unable to add the user.')); //Erreur
        }
        //$this->set('user', $user); // je sais pas ce que ça fait
    }
    
    //Login un utilisateur a partir d'un email (username) et un password
    public function login()
    {
        
         $this->set('titredepage', "login2");
         
         //Dès qu'on submit le formulaire
         if ($this->request->is('post')) {

            $user = $this->Auth->identify(); //Fonction identify de Auth par défaut, qui va checker (email/password) maintenant

            if ($user) {
                $this->Auth->setUser($user); //Si on trouve, alors on défini la session
                
                return $this->redirect($this->Auth->redirectUrl()); //Ensuite on redirige vers l'url par défaut défini dans AppController.php
            }
            
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }  
    
    public function forgotPassword(){
        $this->set('titredepage', "forgotPassword2");
        $this->loadModel('Players');
        
        if ($this->request->is('post')){
            $this->Players->resetPassword($this->request->getData("email"));
        }
    }
    
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
    
}