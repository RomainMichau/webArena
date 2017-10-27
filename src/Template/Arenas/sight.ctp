<div class="container clearfix row small-12 medium-10">

    <?php
    use Cake\View\Helper\HtmlHelper;
            echo  $this->Html->script('Message') ;

    $this->assign('title', $titredepage);?>
    <div id='okui'>
        vous avez gagnez 1 action toute les <?php echo $actiontime ?> secondes. (max:  <?php echo $actionmax ?> )
    </div>

    <div class="grid-x">

        <div class="medium-3 cell control-panel">
            <div class="grid-x">
                <div class="small-4 cell"> <?= $this->Html->image('f'.$fid.'.png', ['alt' => 'imgNotFound','width'=>'80','height'=>'80']); ?> </div>
                <div class="small-8 cell">
                    <?= $fighter->name; ?> <br>
                    Niveau: <?= $fighter->level; ?> <br>
                    Vie: <?= $fighter->current_health; ?>

                </div>
            </div>
            <div class="row centered-text height-60px">
                 <?= $this->Form->button('', ['id'=>'up', 'class' => 'button arrow']); ?>
            </div>
            <div class="grid-x centered-text height-60px">
                <div class="small-4 cell"> <?= $this->Form->button('', ['id'=>'left', 'class' => 'button arrow rotate-270 float-right']); ?> </div>
                <div class="small-4 cell"></div>
                <div class="small-4 cell"> <?= $this->Form->button('', ['id'=>'right', 'class' => 'button arrow rotate-90 float-left']); ?> </div>
            </div>
            <div class="row centered-text">
                <?= $this->Form->button('', ['id'=>'down', 'class' => 'button arrow rotate-180']); ?>
            </div>
            <div class="row centered-text height-60px">
                <?= $this->Form->button('', ['id'=>'aup', 'class' => 'button sword rotate-90']); ?>
            </div>
            <div class="grid-x centered-text height-60px">
                <div class="small-4 cell"> <?= $this->Form->button('', ['id'=>'aleft', 'class' => 'button sword float-right']); ?> </div>
                <div class="small-4 cell"></div>
                <div class="small-4 cell"> <?= $this->Form->button('', ['id'=>'aright', 'class' => 'button sword flip float-left']); ?> </div>
            </div>
            <div class="row centered-text">
                <?= $this->Form->button('', ['id'=>'adown', 'class' => 'button sword rotate-270']); ?>
            </div>
            <div class="row centered-text">
                <?= $this->Form->button('Crier', ['id'=>'cri', 'class' => 'button']); ?>
            </div>
            <div class="row">
                <div id='info'></div>
                <div id='info2'></div>
            </div>

        </div>

        <div class="medium-9 cell">
            <table id="tab">

                <?php
                $i=0;

                 foreach ($tab as $value1) { ?>
                    <tr>
                        <?php foreach ($value1 as $value2) { ?>
                        <td <?php  $i++; if($value2=='f'.$fid){ ?> class='case' <?php } else{ ?> class='case' <?php } ?> id='cid<?php echo $i; ?>'>
                            <?php
                            $x = $i% 15;
                            if($x == 0){
                                 $x = 15;
                            }
                            $y = ($i-$x)/15 +1;

                            $dist= abs($y-$jy)+abs($x-$jx);

                                    if($value2!='vide'&&$dist<=$vue){
                                        echo $this->Html->image($value2.'.png', ['alt' => 'ImgNotFound','class'=>'main']);
                                    }else if($dist<=$vue) {
                                        echo $this->Html->image('case_vide_v.png', ['alt' => 'ImgNotFound']);
                                    }
                                    else if($dist>$vue) {
                                        echo $this->Html->image('case_vide_i.png', ['alt' => 'ImgNotFound'/*,'width'=>'60','height'=>'50'*/]);
                                    }
                                ?>
                        </td>
                        <?php } ?>
                    </tr>
                <?php } ?>

            </table>

        </div>

    </div>
</div>




