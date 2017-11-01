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
    {}
    
    //Ajoute un utilisateur à la BDD a partir d'un username et password
    public function add()
    {
        $this->set('titredepage', 'Inscription');
        
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
                        if($this->Players->userExists($this->request->getData("email"))){

                             $this->Flash->error(__('l\'adresse mail est deja utilisé.'))
                            ;
                        }else{
            if ($this->Players->save($user)) { //Si on arrive a sauvegarder
                $this->Flash->success(__('The user has been saved.')); //Succès
                
                $user = $this->Auth->identify();
                $this->Auth->setUser($user);
                
               return $this->redirect(['controller' => 'Arenas', 'action' => 'createFighter', 0]);//Redirige l'utilisateur vers l'url par défaut
            }
            $this->Flash->error(__('Unable to add the user.')); //Erreur
        }}
        //$this->set('user', $user); // je sais pas ce que ça fait
    }
    
    //Login un utilisateur a partir d'un email (username) et un password
    public function login()
    {   
        
         $this->set('titredepage', 'Connexion');
         
         //Dès qu'on submit le formulaire
         if ($this->request->is('post')) {

            $user = $this->Auth->identify(); //Fonction identify de Auth par défaut, qui va checker (email/password) maintenant

            if ($user) {
                $this->Auth->setUser($user); //Si on trouve, alors on défini la session
                return $this->redirect(['controller' => 'Arenas', 'action' => 'sight']);        // Et on redirige vers la vue
            }
            
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }  
    
    public function forgotPassword(){
        $this->set('titredepage', 'Récupération du MDP');
        $this->loadModel('Players');
        
        if ($this->request->is('post')){
            
            $data = $this->request->getData();
            
            if($this->Players->userExists($data['email'])){
                
                $this->Players->resetPassword($data['email'], $data['password']);
            
                $this->Flash->success(__('Vous avez bien changé votre mot de passe')); //Succès
                
                $this->redirect(['action' => 'login']);
                
            }else{
            
                $this->Flash->error(__('Cette adresse mail n\'existe pas'));
            
            }    
        }
    }
    
    public function logout()
    {
        $this->request->session()->destroy();
        return $this->redirect($this->Auth->logout());
    } 
}