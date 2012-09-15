<?php

// ----- Example 3: Transform errors into exceptions to use PHPCeption as all in one-solution!

// Define exception handler.
function handle_exception (Exception $e)
{
  // Handle exceptions using PHPCeption.
  require_once 'PHPCeption/PHPCeption.php';
  $phpceptionObj = PHPCeption_PHPCeption::createInstance();
  $phpceptionObj->handle($e);
}
set_exception_handler('handle_exception');

// Define error handler.
function exception_error_handler($errno, $errstr, $errfile, $errline ) {
  throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler("exception_error_handler");

/* Exception ausloesen */
strpos();

//Notice: Following code will NOT be executed!
echo 'Example text 3...';