<?php

$this->assign('title', $fighter->name);?>

    <?= $this->Html->image('f' . $fighter->id . '.png', ['alt' => 'imgNotFound','height' => '150']) ?>

<p> id:  <?php echo $fighter->id;?>  </p> 
<p> name: <?php echo $fighter->name ?> </p>
<p> cordX: <?php echo $fighter->coordinate_x ?> , cordY: <?php echo $fighter->coordinate_y ?> </p>
<p> level: <span id='lvl'> <?php echo $fighter->level ?></span> </p>
<p> xp: <?php echo $fighter->xp ?> </p>
<p> Vous pouvez ajouter<span id='skil'> <?= floor(($fighter->xp-$fighter->level*4)/4)+1  ?></span> skills</p>
<p> skill_sight: <span id='pssi'><?php echo $fighter->skill_sight; ?> </span>
        <?php
        if($fighter->xp/$fighter->level>=4)
        {
            echo $this->Form->button('Upgrade skill_sight', ['id'=>'ssi','class' => 'button']);
        }
        ?> </p>
<p> skill_strength:<span id='psst'> <?php echo $fighter->skill_strength ?> </span>
        <?php
        if($fighter->xp/$fighter->level>=4)
        {
            echo $this->Form->button('Upgrade skill_strength', ['id'=>'sst','class' => 'button']); 
        }
        ?></p>
<p>  skill_health: <span id='psh'> <?php echo $fighter->skill_health ?></span>
        <?php
        if($fighter->xp/$fighter->level>=4)
        {
            echo $this->Form->button('Upgrade skill_health', ['id'=>'sh','class' => 'button']);
        }
        ?></p>
<p> current_health: <?php echo $fighter->current_health ?> </p>
