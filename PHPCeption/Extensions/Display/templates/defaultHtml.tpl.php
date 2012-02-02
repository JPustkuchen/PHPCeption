<?php
/* @var $e Exception */
?>

<h1>Exception: <span class="message"><? echo $e->getMessage(); ?></span></h1>
<ul>
    <li><strong></strong>: <span class="file"><? echo $e->getFile(); ?></span></li>
    <li><strong></strong>: <span class="line"><? echo $e->getLine(); ?></span></li>
    <li><strong>Trace</strong>: <p class="trace"><? echo $e->getTraceAsString(); ?></p></li>
</ul>