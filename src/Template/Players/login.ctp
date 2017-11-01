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
                <label>Mot de passe
                    <input type="password" name="password" id="password" placeholder="Mot de passe" />
                </label>
            </div>
        </div>

        <div class="grid-x align-center">
            <?= $this->Form->button(__('Connexion'), ['class' => 'cell small-3 large success button form-button']); ?>
        </div>

        <br />
        <br />
        <br />
        <?= $this->Html->link('Mot de passe oublié ?', array('controller' => 'Players', 'action' => 'forgotPassword'), ['class' => 'white']);?>
        
     <?= $this->Form->end() ?>
</div>




