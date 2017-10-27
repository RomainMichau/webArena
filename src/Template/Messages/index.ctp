<?php
$this->assign('title', 'Messages');?>
<div class="grid-container">
    <div class="grid-x grid-padding-x small-up-1 medium-up-2 large-up-3">
        <?php foreach($messages as $message): ?>
            <div class="cell">
                <div class="card" style="width: 300px;">
                    <div class="card-divider">
                        name: <?php echo $message->title; ?>
                    </div>
                    <div class="card-section">
                        <p> id:  <?php echo $message->id;?>  </p>
                        <p> message: <?php echo $message->message ?> </p>
                        <p> fighter_id_from: <?php echo $message->fighter_id_from ?> </p>
                        <p> fighter_id_: <?php echo $message->fighter_id ?> </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
