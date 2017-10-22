<?php
use Cake\View\Helper\HtmlHelper;

$this->assign('title', $titredepage);?>
<table class='damier'> 
    <?php echo $this->Html->image('f'.$fid.'.png', ['alt' => 'imgNotFound','width'=>'80','height'=>'80']);
    $i=0;
     foreach ($tab as $value1) { ?>
        <tr>    
            <?php foreach ($value1 as $value2) { ?>     
            <td <?php  $i++; if($value2=='f'.$fid){ ?> class='case_fighter' <?php } else{ ?> class='case' <?php } ?> id='cid<?php echo $i; ?>' >
                <?php          
                               if($value2!='vide'){
                               echo $this->Html->image($value2.'.png', ['alt' => 'imgNotFound','width'=>'42','height'=>'42']);}
                               else{ ?> <div class='vide'></div> <?php }
                    ?>
            </td>           
            <?php } ?>
        </tr>
    <?php } ?>
</table>

 <?php
    echo $this->Form->button('monter', ['type' => 'button','id'=>'up']);
     echo $this->Form->button('descendre', ['type' => 'button','id'=>'down']);
      echo $this->Form->button('gauche', ['type' => 'button','id'=>'left']);
       echo $this->Form->button('droite', ['type' => 'button','id'=>'right']);
