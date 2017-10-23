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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

   
    <?= $this->Html->css('webarena.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?php
    echo $this->Html->script('http://code.jquery.com/jquery.min.js'); 
    echo $this->Html->script('Arenas');?>

    <?php if($user)
        {
            echo $this->Html->link('Acceuil', '/');
            echo " ";
            echo $this->Html->link('fighters', array('controller' => 'Arenas', 'action' => 'fighters'));
            echo " ";
            echo $this->Html->link('fighterByPlayer', array('controller' => 'Arenas', 'action' => 'fightersByPlayer'));
            echo " ";
            echo $this->Html->link('Vision', array('controller' => 'Arenas', 'action' => 'sight'));
            echo " ";
            echo $this->Html->link('diary', array('controller' => 'Arenas', 'action' => 'diary'));
            echo " ";
            echo $this->Html->link('logout', array('controller' => 'Players', 'action' => 'logout'));
            echo " ";
            echo $user['email'];
        }
        else
        {
            echo $this->Html->link('Acceuil', '/');
            echo " ";
            echo $this->Html->link('fighters', array('controller' => 'Arenas', 'action' => 'fighters'));
            echo " ";
            echo $this->Html->link('login', array('controller' => 'Players', 'action' => 'login'));
            echo " ";
            echo $this->Html->link('add', array('controller' => 'Players', 'action' => 'add'));
        }
    ?>

</head>
<body>
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
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
        TD SI-2
        <p>Dev: Vincent Jacob - Aleksander Kasara - Fabrice Locqueville- Romain Michau aka le bg   </p>
        <p> Option: DG </p>
        
    </footer>
</body>
</html>
