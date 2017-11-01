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
<html class="no-js" lang="en" dir="ltr">
    <head>
        <?= $this->Html->charset() ?>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?= $this->Html->css(['foundation.css', 'foundation-icons/foundation-icons.css', 'webarena.css']) ?>
        <?= $this->Html->script('jquery') ?>

        <title> <?= $this->fetch('title') ?> </title>
        <?= $this->Html->meta('icon') ?>
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
    </head>
    <body>
        <div class="off-canvas-content" data-off-canvas-content>

            <!-- MAIN NAVIGATION (HEADER) -->
            <header class="top-bar">

                <!-- LEFT SIDE -->
                <div class="top-bar-left">
                    <ul class="menu">
                        <li class="menu-text">
                        <?php
                            if(!$user)              
                                echo $this->Html->link('Web Arena', ['controller' => 'Arenas', 'action' => 'index'], ['id' => 'site-title', 'title' => 'Retour à l\'accueil']);
                            else   
                                echo $this->Html->link('<img src="/webArena/img/layout/deco.png" alt="[Déconnexion]" id="logout-img"/>' . 'Web Arena', ['controller' => 'Players', 'action' => 'logout'], ['escape' => false, 'id' => 'site-title', 'title' => 'Déconnexion']);
                        ?>
                        </li>
                    </ul>
                </div>
            
               <!-- RIGHT SIDE -->
                <?php
                    switch($this->fetch('title'))
                        {
                            case 'Accueil':   
                                    echo '<div class="top-bar-right" id="login-corner">';  
                                        echo '<ul class="vertical menu align-center">';   
                                        echo '<li>';          
                                        echo $this->Html->link('Connexion' , ['controller' => 'Players', 'action' => 'login']);   
                                        echo '</li> <li>';  
                                        echo $this->Html->link('Inscription' , ['controller' => 'Players', 'action' => 'add']);
                                        echo '</li>';  
                                        echo '</ul>'; 
                                    echo '</div>';    
                                    break;
                            case 'Vision':
                            case 'Combattant':
                            case 'Journal':
                            case 'Guildes':
                            case 'Guilde':
                            case 'Messages':
                            case 'Conversation':
                            case 'Modifier combattant':
                                    echo '<div class="top-bar-right" id="ingame-corner">'; 
                                    echo '<ul class="menu align-center">';

                                    echo '<li id="player-info">';                                           
                                        echo '<ul class="vertical menu align-center">';
                                        echo '<li>' . $user['email'] . '</li>';
                                        echo '<li>';
                                        echo $this->Html->link(
                                            $this->Html->image('/img/f' . $this->request->session()->read('user_fighter_id') . '.png', ['alt' => 'Avatar', 'id' => 'player-img', 'title' => 'Voir combattant']),
                                                "/arenas/fighter",
                                                ['escape' => false]
                                        );
                                        echo '</li>';
                                        echo '</ul>';
                                    echo '</li>';
                                    echo '<li id="players-access">';
                                    echo '<button type="button" class="button" data-toggle="fighters" id="pop"  > Population <i class="fi-mail"></i></button>';
                                    echo '</li>';
                                    echo '</ul>';
                                    echo '</div>';

                                    $in_game = 1; 
                                    break;
                            }
                        ?>
            </header>

                <!-- CASE IN GAME -->
                <?php if(isset($in_game))                               
                        {
                ?> 
                <!-- CENTER BLOCK -->
                <div class="grid-x" id="center-block">

                    <!-- NAVIGATION BETWEEN GAME PAGES -->
                    <nav class="medium-2 small-2 cell">
                        <ul class="vertical menu align-center icons icon-top">
                            <li class="<?= $this->fetch('title') === 'Vision' ? 'is-active' : ''; ?>"> <?= $this->Html->link('<i class="fi-map"></i> <span class="show-for-medium">Vision</span>', ['controller' => 'Arenas', 'action' => 'sight'], ['escape' => false]); ?> </li>
                            <li class="<?= $this->fetch('title') === 'Journal' ? 'is-active' : ''; ?>"> <?= $this->Html->link('<i class="fi-book"></i> <span class="show-for-medium">Journal</span>', ['controller' => 'Arenas', 'action' => 'diary'], ['escape' => false]); ?> </li>
                            <li class="<?= $this->fetch('title') === 'Combattant' ? 'is-active' : ''; ?>"> <?= $this->Html->link('<i class="fi-torso"></i> <span class="show-for-medium">Combattant</span>', ['controller' => 'Arenas', 'action' => 'fighter'], ['escape' => false]); ?> </li>
                            <li class="<?= $this->fetch('title') === 'Guildes' ? 'is-active' : ''; ?>"> <?= $this->Html->link('<i class="fi-torsos-all"></i> <span class="show-for-medium">Guildes</span>', ['controller' => 'Arenas', 'action' => 'guilds'], ['escape' => false]); ?> </li>
                        </ul>
                    </nav>

                    <!-- PAGE CONTENT -->
                    <?= $this->Flash->render() ?>                           
                    <div class="medium-10 small-10 cell" id="page-content">
                        <?= $this->fetch('content') ?>
                    </div>  

                </div>
                
                <!-- CASE NOT IN GAME (ONLY FORMS) -->
                <?php
                        }
                    else                                                 
                        {
                ?> 
                <!-- CENTER BLOCK -->
                <div id="<?= $this->fetch('title') === 'Accueil' ? 'index-content' : 'center-block' ?>">

                    <!--IF NOT INDEX -->
                    <?php if($this->fetch('title') !== 'Accueil'): ?>

                    <!--PAGE TITLE -->
                    <div class="grid-x align-center"> 
                        <h2 class="cell small-4 text-center" id="form-title"><?= $this->fetch('title'); ?></h2>
                    </div>
                    <!-- PAGE CONTENT INSIDE A FORM BOX -->
                    <?= $this->Flash->render() ?>   
                    <div class="grid-x align-center"> 
                        <div class="cell small-7" id="form-box">
                            <?= $this->fetch('content') ?>
                        </div>  
                    </div>    
                    <?php endif; ?>     
                         
                </div>
                <?php
                        }
                ?>

            <!-- FOOTER -->
            <footer>
                <div class="wrap grid-x small-up-1 medium-up-3">
                    <div class="cell">
                        <h3> Groupe SI TD02 </h3>
                        <hr />
                        <p>
                            <ul class="no-bullet">
                                <li><strong>CASARA</strong> Alexandre</li>
                                <li><strong>JACOB</strong> Vincent</li>
                                <li><strong>LOCQUEVILLE</strong> Fabrice</li>
                                <li><strong>MICHAU</strong> Romain</li>
                            </ul>
                        </p>
                    </div> 
                    <div class="cell">
                        <h3> Options </h3>
                        <hr />
                        <p>
                            <ul class="no-bullet">
                                <li><strong>B</strong> - Gestion de la communication et des guildes </li>
                                <li><strong>C</strong> - Gestion d'une limite temporelle </li>
                                <li><strong>G</strong> - Utilisation de Foundation 6 </li>
                            </ul>
                        </p>
                    </div> 
                    <div class="cell">
                        <h3> Gestion de versions </h3>
                        <hr />
                        <p>
                            <?= $this->Html->link('versions.log', '/versions.log', ['target' => '_blank']);?>
                        </p>
                    </div> 
                </div>
            </footer>
        </div>
    
            <!-- CASE IN GAME - COMPUTE AND DISPLAY PLAYERS INFO OFF CANVAS -->
        <?php if(isset($in_game))                               
               {
        ?> 
        <!-- FIGHTERS LIST (OFF CANVAS) -->
        <div class="off-canvas position-right" id="fighters" data-off-canvas>
            <!-- Close button -->
            <button class="close-button" aria-label="Close menu" type="button" data-close>
                <span aria-hidden="true">&times;</span>
            </button>

                <!-- If no other fighter, simply display a message -->

                <?php if($this->request->session()->read('fighters_nb') == 0)                               
                      {
                ?> 
                    <p id="nobody-here">
                        Vous êtes seul sur la grille !
                    </p>
                    <hr />
                <?php
                      }

                 // Else, dynamic menu [Photo] name [lvl]
                 else                               
                      {
                ?> 
                        <ul id="fighters-list" class="vertical menu align-left icons icon-left">
                        <?php for($i = 1; $i <= $this->request->session()->read('fighters_nb'); $i++): ?>

                            <?php $fighter_i = $this->request->session()->read('fighter' . $i); ?>
                        
                            <li id='<?='canvas'.$fighter_i->id ?>' class='bailleducanvas'>      <!-- j'utilise ça dans le js , merci de pas surprimer sans me demander ROMAIN --> 
                               <?= $this->Html->link($this->Html->image('/img/f' . $fighter_i->id . '.png', ['alt' => 'Icon']) . ' <span>' . $fighter_i->name . ' <span class="level">[' . $fighter_i->level . ']</span></span>', ['controller' => 'Messages', 'action' => 'conversation', $fighter_i->id, $this->request->session()->read('user_fighter_id')], ['escape' => false]); ?>
                                    
                                <hr />
                            </li>

                        <?php endfor; ?>
                        </ul>
                <?php
                      }
                ?>
       <?php
                }
        ?>
        <?= $this->Html->script([ '/vendor/jquery', '/vendor/what-input', '/vendor/foundation', 'Arenas']) ?>
    </body>
</html>
