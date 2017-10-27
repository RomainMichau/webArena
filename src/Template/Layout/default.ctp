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
        <title> <?= $this->fetch('title') ?> </title>
        <?= $this->Html->meta('icon') ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.css" />
        <?= $this->Html->css('webarena.css') ?>
        <?= $this->Html->script('jquery') ?>
        <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js') ?>
        <?=  $this->Html->script('Arenas') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
    </head>

    <body>

    <?php if($user)
        {
    ?>      <ul class="menu">
            <li> <?= $this->Html->link('Acceuil', '/');?> </li>
            <li> <?= $this->Html->link('fighters', array('controller' => 'Arenas', 'action' => 'fighters'));?> </li>
            <li> <?= $this->Html->link('fighterByPlayer', array('controller' => 'Arenas', 'action' => 'fighter'));?> </li>
            <li> <?= $this->Html->link('creer fighter (temporaire)', array('controller' => 'Arenas', 'action' => 'createFighter/1'));?> </li>
            <li> <?= $this->Html->link('Vision', array('controller' => 'Arenas', 'action' => 'sight'));?> </li>
            <li> <?= $this->Html->link('diary', array('controller' => 'Arenas', 'action' => 'diary'));?> </li>
            <li> <?= $this->Html->link('guilds', array('controller' => 'Arenas', 'action' => 'guilds'));?> </li>
            <li> <?= $this->Html->link('logout', array('controller' => 'Players', 'action' => 'logout'));?> </li>

            <li> <?= $user['email'];?> </li>
            <li id='newmessage'></li>
        </ul>
            <?php
        }
        else
        {
    ?>
        <ul class="menu">
            <li> <?= $this->Html->link('Acceuil', '/');?> </li>

            <li> <?= $this->Html->link('login', array('controller' => 'Players', 'action' => 'login'));?> </li>
            <li> <?= $this->Html->link('add', array('controller' => 'Players', 'action' => 'add'));?> </li>
        </ul>
            <?php
        }
    ?>

        <nav class="top-bar expanded" data-topbar role="navigation">
            <ul class="title-area large-3 medium-4 columns">
                <li class="name">
                    <h1><a href=""><?= $this->fetch('title') ?></a></h1>
                </li>
            </ul>
            <div class="top-bar-section">
                <ul class="right">
                    <li><a target="_blank" href="https://book.cakephp.org/3.0/">Documentation</a></li>
                    <li><a target="_blank" href="https://api.cakephp.org/3.0/">API</a></li>
                </ul>
            </div>
        </nav>
        <?= $this->Flash->render() ?>

        <div class="container clearfix row">
            <?= $this->fetch('content') ?>
        </div>

        <footer>
            TD SI-2
            <p> Dev: Vincent Jacob - Aleksander Kasara - Fabrice Locqueville - Romain Michau aka le bg </p>
            <p> Option: CBG </p>
            <?= $this->Html->link('versions', array('controller' => 'arenas', 'action' => 'versions'));?>
        </footer>
    </body>
</html>
