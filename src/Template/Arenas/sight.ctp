<?php
use Cake\View\Helper\HtmlHelper;

$this->assign('title', $titredepage);?>
<table class='damier'> 
    <?php foreach ($tab as $value1) { ?>
        <tr> 
            <?php foreach ($value1 as $value2) { ?>     
            <td class='case'>
                <?php 
                    if($value2!=0){
                        echo $this->Html->image($value2.'.png', ['alt' => 'CakePHP']);
                    }?>
            </td>           
            <?php } ?>
        </tr>
    <?php } ?>
</table>