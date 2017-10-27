<?php
$this->assign('title', 'Guilde');?>
<div class="grid-container">
    <div class="grid-x grid-padding-x small-up-2 medium-up-3">
        <?= $guild->id?>
        <?= $guild->name?>

        <?php foreach( $fighters as $fighter ): ?>
            <div class="cell">
                <div class="card" style="width: 300px;">
                    <div class="card-divider">
                        <p> id: <?php echo $fighter->id ?> </p>
                        <p> name: <?php echo $fighter->name ?> </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>