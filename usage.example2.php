<?php

// ----- Example 2: Define exception handler!

// Set this at the very beginning of your project!`
// Notice: After the Exception has been handled by this function, execution is
// finally aborted.
function handle_exception (Exception $e)
{
  // Handle exceptions using PHPCeption.
  require_once 'PHPCeption/PHPCeption.php';
  $phpceptionObj = PHPCeption_PHPCeption::createInstance();
  $phpceptionObj->handle($e);
}
set_exception_handler('handle_exception');

// Throw exception
throw new Exception("Dummy Exception 2");

//Notice: Following code will NOT be executed!
echo 'Example text 2...';