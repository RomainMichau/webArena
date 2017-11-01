<div class="row">
    <?php $this->assign('title', $titredepage);?>

    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?> 
        <div class="grid-x align-center first-form-row">
            <div class="cell small-7 text-center"> 
                <label>Email
                    <input type="email" name="email" id="email" placeholder="Adresse E-Mail" />
                </label>
            </div>
        </div>
        <div class="grid-x align-center">
            <div class="cell small-7 text-center">
                <label>Nouveau mot de passe
                    <input type="password" name="password" id="password" placeholder="Nouveau mot de passe" />
                </label>
            </div>
        </div>

        <div class="grid-x align-center">
            <?= $this->Form->button(__('Confirmer'), ['class' => 'cell small-3 large success button form-button']); ?>
        </div>
     <?= $this->Form->end() ?>
</div>