<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?= $this->Html->css(['webarena.css', 'https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.css']) ?>
        <?= $this->Html->script(['jquery', 'Arenas', 'https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js']) ?>

        <title> <?= $this->fetch('title') ?> </title>
        <?= $this->Html->meta('icon') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
    </head>
    <body>
        <header> 
            <div class="top-bar">
                <div class="top-bar-left"> 
                    <?php
                        if(!$user) echo $this->Html->link('Accueil', ['controller' => 'Arenas', 'action' => 'index']);

                        switch($this->fetch('title'))
                        {
                            case 'Accueil':                     
                                echo $this->Html->link('Connexion' , ['controller' => 'Players', 'action' => 'login']);   
                                echo $this->Html->link('Inscription' , ['controller' => 'Players', 'action' => 'add']);   
                                break;
                            case 'Création de combattant':
                                echo $user['email'];
                                break;
                            case 'Vision':
                            case 'Combattant':
                            case 'Journal':
                            case 'Guildes':
                            case 'Guilde':
                            case 'Messages':
                            case 'Conversation':
                            case 'Combattants de la grille':            // On affiche en plus L'avatar du combattant, venant vers sa page
                            case 'Modifier combattant':
                                echo '<div id="newmessage"></div>';
                                echo $user['email'];
                                echo $this->Html->link(
                                    $this->Html->image('/img/f' . $this->request->session()->read('user_fighter_id') . '.png', ['alt' => 'Avatar', 'width' => '20px']),
                                    "/arenas/fighter",
                                    ['escape' => false]
                                );
                                $in_game = 1;  
                        }
                    ?>
                </div>
                <div class="top-bar-right"> 
                    <?php
                         if($user) echo $this->Html->link('Déconnexion', ['controller' => 'Players', 'action' => 'logout']);
                    ?>
                </div>
            </div>
        </header>
        <?php if(isset($in_game))                               // Si on est en jeu on affiche la navigation des pages de jeu
            {
        ?> 
        <nav>
            <ul class="menu">
                <li> <?= $this->Html->link('Vision', ['controller' => 'Arenas', 'action' => 'sight']); ?> </li>
                <li> <?= $this->Html->link('Combattant', ['controller' => 'Arenas', 'action' => 'fighter']); ?> </li>
                <li> <?= $this->Html->link('Journal', ['controller' => 'Arenas', 'action' => 'diary']); ?> </li>
                <li> <?= $this->Html->link('Combattants de la grille', ['controller' => 'Arenas', 'action' => 'fighters']); ?> </li>
                <li> <?= $this->Html->link('Guildes', ['controller' => 'Arenas', 'action' => 'guilds']); ?> </li>
            </ul>
        </nav>
         <?php
            }
        ?>

        <?= $this->Flash->render() ?>                           <!-- ?? -->
        <div class="container clearfix">
            <?= $this->fetch('content') ?>
        </div>  

        <footer>
            <h3 class="row centered-text"> TD <strong> SI-2 </strong> </h3>
            <div class="grid-x">
                <div class="small-3 cell"></div>
                <div class="small-1 cell"> Fait par : </div>
                <div class="small-2 cell">
                    <ul class="">
                        <li>CASARA</li>
                        <li>JACOB</li>
                        <li>LOCQUEVILLE</li>
                        <li>MICHAU</li>
                    </ul>
                </div>
                <div class="small-2 cell">
                    <p> Options : B C et G </p>
                </div>
                <div class="small-2 cell">
                    <p> Gestion de versions GIT : <?= $this->Html->link('versions', '/versions.log');?> </p>
                </div>
                    
            </div>
        </footer>
    </body>
</html>
