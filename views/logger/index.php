<?php
use yii\helpers\Html;

?>
<div class="site-error">

    <h1>Logger</h1>
    <ul>
        <?php
        foreach ($result as $logItem) { ?>
            <li><?= $logItem ?></li>
            
        <?php } ?>
        </ul>

</div>
