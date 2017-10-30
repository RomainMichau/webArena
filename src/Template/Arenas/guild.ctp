<div class="grid-container">
    <?php
    $this->assign('title', 'Guilde');?>
    <?= $guild->id?>
    <?= $guild->name?>
    <?= $nb ?> membre(s)
    <div class="grid-x grid-padding-x small-up-1 medium-up-2 large-up-3">
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
