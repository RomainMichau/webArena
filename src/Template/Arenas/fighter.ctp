<?php
    $this->assign('title', $fighter->name);?>

    <?= $this->Html->image('f' . $fighter->id . '.png', ['alt' => 'imgNotFound','height' => '150']) ?>

    <p> id:  <?php echo $fighter->id;?>  </p> 
    <p> name: <?php echo $fighter->name ?> </p>
    <p> cordX: <?php echo $fighter->coordinate_x ?> , cordY: <?php echo $fighter->coordinate_y ?> </p>
    <p> level: <?php echo $fighter->level ?> </p>
    <p> xp: <?php echo $fighter->xp ?> </p>
    <p> Vous pouvez ajouter <?= floor(($fighter->xp/$fighter->level)/4) ?> skills</p>
    <p> skill_sight: <?php echo $fighter->skill_sight; ?>
        <?php
        if($fighter->xp/$fighter->level>=4)
        {
            echo $this->Form->button('Upgrade skill_sight', ['class' => 'button']);
        }
        ?> </p>
    <p> skill_strength: <?php echo $fighter->skill_strength ?>
        <?php
        if($fighter->xp/$fighter->level>=4)
        {
            echo $this->Form->button('Upgrade skill_strength', ['class' => 'button']);
        }
        ?></p>
    <p> skill_health: <?php echo $fighter->skill_health ?>
        <?php
        if($fighter->xp/$fighter->level>=4)
        {
            echo $this->Form->button('Upgrade skill_health', ['class' => 'button']);
        }
        ?></p>
    <p> current_health: <?php echo $fighter->current_health ?> </p>
