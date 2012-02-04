<?php

// -------------------------------------------------------
// Example 1: Use try-catch in bootstrap to define controlled behaviour!

// Initialize Exception Handling
try {
    // Your bootstrap code!
    // Just some stupid code examples
    $a = 1;
    $a ++;

    // Throw exception anywhere within the code...
    throw new Exception("Dummy Exception 1: Log only!");
} catch (Exception $e) {
    // Handle exceptions using PHPCeption.
    require_once 'PHPCeption/PHPCeption.php';
    $phpceptionObj = PHPCeption_PHPCeption::createInstance();
    require_once 'PHPCeption/Configurations/LogOnly.php';
    $phpceptionObj->handle($e, PHPCeption_Configurations_LogOnly::createInstance());
}
// Notice: Code after catch will be executed!

// ----------------------------------------------------------------------

// Example 2: Use try-catch in bootstrap to define controlled behaviour!

// Initialize Exception Handling
try {
  // Your bootstrap code!
  // Just some stupid code examples
  $a = 1;
  $a ++;

  // Throw exception anywhere within the code...
  throw new Exception("Dummy Exception 2: NoDisplay (Log+Notify only!)");
} catch (Exception $e) {
  // Handle exceptions using PHPCeption.
  require_once 'PHPCeption/PHPCeption.php';
  $phpceptionObj = PHPCeption_PHPCeption::createInstance();
  require_once 'PHPCeption/Configurations/NoDisplay.php';
  $phpceptionObj->handle($e, PHPCeption_Configurations_NoDisplay::createInstance());
}
// Notice: Code after catch will be executed!

// ----------------------------------------------------------------------

// Example 3: Define exception handler!
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
throw new Exception("Dummy Exception 3");

//Notice: Following code will NOT be executed!