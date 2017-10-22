<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Validation\Validation;


/**
 * Personal Controller
 * User personal interface
 *
 */
class PlayersController  extends AppController
{
      

    
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
            $user->email = $this->request->getData("username"); //Récupère le username
            $user->password = $this->request->getData("password"); //Récupère le password
            
            
            if ($this->Players->save($user)) { //Si on arrive a sauvegarder
                $this->Flash->success(__('The user has been saved.')); //Succès
                return $this->redirect(['action' => 'add']); //Redirige l'utilisateur vers la page players/add (A CHANGER)
            }
            $this->Flash->error(__('Unable to add the user.')); //Erreur
        }
        $this->set('user', $user); // je sais pas ce que ça fait
    }
    
    //Login un utilisateur a partir d'un email (username) et un password
    public function login()
    {
        
         $this->set('titredepage', "login2");

         
        /*if ($this->request->is('post')) {
            //$user = $this->Auth->identify();
            $user = $this->Players->identify($this->request->data);
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('Username or password is incorrect'));
            }
        }*/
         
         //Dès qu'on submit le formulaire
         if ($this->request->is('post')) {

            if (Validation::email($this->request->data['username'])) { //Si c'est un email valide
                $this->Auth->config('authenticate', [
                    'Form' => [
                        'fields' => ['username' => 'email'] //Par défaut, Auth check le couple (username/password), mais on veut (email/password)
                    ]
                ]);
                $this->Auth->constructAuthenticate(); //je sais pas
                $this->request->data['email'] = $this->request->data['username']; //Change la data qu'on récup
                unset($this->request->data['username']);
            }

            $user = $this->Auth->identify(); //Fonction identify de Auth par défaut, qui va checker (email/password) maintenant

            if ($user) {
                $this->Auth->setUser($user); //Si on trouve, alors on défini la session
                return $this->redirect($this->Auth->redirectUrl()); //Ensuite on redirige vers l'url par défaut défini dans AppController.php
            }
            
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }    
    
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
    
}