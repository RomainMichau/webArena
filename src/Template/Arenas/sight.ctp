<?php
use Cake\View\Helper\HtmlHelper;

$this->assign('title', $titredepage);?>
<table class='damier'> 
    <?php foreach ($tab as $value1) { ?>
        <tr> 
            <?php foreach ($value1 as $value2) { ?>     
            <td class='case'>
                <?php 
                 
                            echo $this->Html->image($value2.'.png', ['alt' => 'imgNotFound','width'=>'42','height'=>'42']);
                    ?>
            </td>           
            <?php } ?>
        </tr>
    <?php } ?>
</table>

 <?php
    echo $this->Form->button('monter', ['type' => 'button','id'=>'up']);
