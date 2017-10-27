<?php
use Cake\View\Helper\HtmlHelper;
        echo  $this->Html->script('Message') ;

$this->assign('title', $titredepage);?>
<div id='okui'>
    vous avez gagnez 1 action toute les <?php echo $actiontime ?> secondes. (max:  <?php echo $actionmax ?> )
</div>
    
<div class="grid-x">
    
    <div class="medium-3 cell">
        <div class="grid-x centered-text">
            <div class="medium-4 cell"></div>
            <div class="medium-4 cell"> <?= $this->Form->button('', ['id'=>'up', 'class' => 'button arrow']); ?> </div>
            <div class="medium-4 cell"></div>
        </div>
        <div class="grid-x centered-text">
            <div class="medium-4 cell"> <?= $this->Form->button('', ['id'=>'left', 'class' => 'button arrow rotate-270']); ?> </div>
            <div class="medium-4 cell"></div>
            <div class="medium-4 cell"> <?= $this->Form->button('', ['id'=>'right', 'class' => 'button arrow rotate-90']); ?> </div>
        </div>
        <div class="grid-x centered-text">
            <div class="medium-4 cell"></div>
            <div class="medium-4 cell"> <?= $this->Form->button('', ['id'=>'down', 'class' => 'button arrow rotate-180']); ?> </div>
            <div class="medium-4 cell"></div>
        </div>
        <div class="grid-x">
            <div class="medium-4 cell"></div>
            <div class="medium-4 cell"> <?= $this->Form->button('attaque haut', ['id'=>'aup', 'class' => 'button']); ?> </div>
            <div class="medium-4 cell"></div>
        </div>
        <div class="grid-x">
            <div class="medium-4 cell"> <?= $this->Form->button('attaque gauche', ['id'=>'aleft', 'class' => 'button']); ?> </div>
            <div class="medium-4 cell"></div>
            <div class="medium-4 cell"> <?= $this->Form->button('attaque droit', ['id'=>'aright', 'class' => 'button']); ?> </div>
        </div>
        <div class="grid-x">
            <div class="medium-4 cell"></div>
            <div class="medium-4 cell"> <?= $this->Form->button('attaque bas', ['id'=>'adown', 'class' => 'button']); ?> </div>
            <div class="medium-4 cell"></div>
        </div>
        <div class="grid-x">
            <?= $this->Form->button('crier', ['id'=>'cri', 'class' => 'button']); ?>
        </div>   
            
    </div>
    
    <div class="medium-9 cell">
        <table id="tab"> 

            <?php echo $this->Html->image('f'.$fid.'.png', ['alt' => 'imgNotFound','width'=>'80','height'=>'80']);
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

                                if($value2!='vide'&&$dist<=2){
                                    echo $this->Html->image($value2.'.png', ['alt' => 'ImgNotFound']);
                                }else if($dist<=$vue) {
                                    echo $this->Html->image('case_vide_v.png', ['alt' => 'ImgNotFound'/*,'width'=>'60','height'=>'50'*/]);
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


    <div id='info'></div>
    <div id='info2'></div>


