<?php
/*
 * @var $e Exception
 */
?>

<h1>
	Exception: <span class="message"><? echo htmlentities($e->getMessage()); ?></span>
</h1>
<ul>
	<li><strong></strong>: <span class="file"><? echo htmlentities($e->getFile()); ?></span></li>
	<li><strong></strong>: <span class="line"><? echo htmlentities($e->getLine()); ?></span></li>
	<li><strong>Trace</strong>:
		<p class="trace"><? echo htmlentities($e->getTraceAsString()); ?></p></li>
</ul>