<?php
use Cake\View\Helper\HtmlHelper;

$this->assign('title', $titredepage);?>
<div>
<table class="unstriped" id="tab"> 
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
                            echo $this->Html->image('case_vide_v.png', ['alt' => 'ImgNotFound','width'=>'60','height'=>'50']);
                        }
                        else if($dist>$vue) {
                            echo $this->Html->image('case_vide_i.png', ['alt' => 'ImgNotFound','width'=>'60','height'=>'50']);
                        }
                    ?>
            </td>           
            <?php } ?>
        </tr>
    <?php } ?>
</table> 
    <div id='info'></div>
     <div id='info2'></div>

</div>

 <?php
 
    echo $this->Form->button('monter', ['id'=>'up', 'class' => 'button']);
    echo $this->Form->button('descendre', ['id'=>'down', 'class' => 'button']);
    echo $this->Form->button('gauche', ['id'=>'left', 'class' => 'button']);
    echo $this->Form->button('droite', ['id'=>'right', 'class' => 'button']);  
     
    echo $this->Form->button('attaque haut', ['id'=>'aup', 'class' => 'button']);
    echo $this->Form->button('attaque bas', ['id'=>'adown', 'class' => 'button']);
    echo $this->Form->button('attaque gauche', ['id'=>'aleft', 'class' => 'button']);
    echo $this->Form->button('attaque droit', ['id'=>'aright', 'class' => 'button']);  
    echo $this->Form->button('crier', ['id'=>'cri', 'class' => 'button']);  ?>
