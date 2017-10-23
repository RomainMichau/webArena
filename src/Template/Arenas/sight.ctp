<?php
use Cake\View\Helper\HtmlHelper;

$this->assign('title', $titredepage);?>
<div>
<table class="unstriped"> 
    <?php echo $this->Html->image('f'.$fid.'.png', ['alt' => 'imgNotFound','width'=>'80','height'=>'80']);
    $i=0;
     foreach ($tab as $value1) { ?>
        <tr>    
            <?php foreach ($value1 as $value2) { ?>     
            <td <?php  $i++; if($value2=='f'.$fid){ ?> class='case' <?php } else{ ?> class='case' <?php } ?> id='cid<?php echo $i; ?>' >
                <?php          
                               if($value2!='vide'){
                               echo $this->Html->image($value2.'.png', ['alt' => 'imgNotFound','width'=>'42','height'=>'35']);}
                               else{ ?> <div class='vide'></div> <?php }
                    ?>
            </td>           
            <?php } ?>
        </tr>
    <?php } ?>
</table> 
    <div id='info'></div>

</div>

 <?php
 
    echo $this->Form->button('monter', ['type' => 'button','id'=>'up']);
     echo $this->Form->button('descendre', ['type' => 'button','id'=>'down']);
      echo $this->Form->button('gauche', ['type' => 'button','id'=>'left']);
      echo $this->Form->button('droite', ['type' => 'button','id'=>'right']);  
     
 echo $this->Form->button('attaque haut', ['type' => 'button','id'=>'aup']);
     echo $this->Form->button('attaque bas', ['type' => 'button','id'=>'adown']);
      echo $this->Form->button('attaque gauche', ['type' => 'button','id'=>'aleft']);
      echo $this->Form->button('attaque droit', ['type' => 'button','id'=>'aright']); 

