<?php

// ----- Example 1a: Use try-catch in bootstrap to define controlled behaviour!

// Initialize Exception Handling
try {
    // Your bootstrap code!
    // Just some stupid code examples
    $a = 1;
    $a ++;

    // Throw exception anywhere within the code...
    throw new Exception("Dummy Exception 1a: Log only!");
} catch (Exception $e) {
    // Handle exceptions using PHPCeption.
    require_once 'PHPCeption/PHPCeption.php';
    $phpceptionObj = PHPCeption_PHPCeption::createInstance();
    require_once 'PHPCeption/Configurations/LogOnly.php';
    $phpceptionObj->handle($e, PHPCeption_Configurations_LogOnly::createInstance());
}
// Notice: Code after catch will be executed!

// ===========================================================================

// ----- Example 1b: Use try-catch in bootstrap to define controlled behaviour!

// Initialize Exception Handling
try {
  // Your bootstrap code!
  // Just some stupid code examples
  $a = 1;
  $a ++;

  // Throw exception anywhere within the code...
  throw new Exception("Dummy Exception 1b: NoDisplay (Log+Notify only!)");
} catch (Exception $e) {
  // Handle exceptions using PHPCeption.
  require_once 'PHPCeption/PHPCeption.php';
  $phpceptionObj = PHPCeption_PHPCeption::createInstance();
  require_once 'PHPCeption/Configurations/NoDisplay.php';
  $phpceptionObj->handle($e, PHPCeption_Configurations_NoDisplay::createInstance());
}
// Notice: Code after catch will be executed!

// ===========================================================================

// ----- Example 1c: Use try-catch in bootstrap to define controlled behaviour!

// Initialize Exception Handling
try {
  // Your bootstrap code!
  // Just some stupid code examples
  $a = 1;
  $a ++;

  // Throw exception anywhere within the code...
  throw new Exception("Dummy Exception 1c: Display and exit manually!");
} catch (Exception $e) {
  // Handle exceptions using PHPCeption.
  require_once 'PHPCeption/PHPCeption.php';
  $phpceptionObj = PHPCeption_PHPCeption::createInstance();
  require_once 'PHPCeption/Configurations/NoDisplay.php';
  $phpceptionObj->handle($e);
  exit();
}
// Notice: Code after catch will NOT be executed because of manual exit!
echo 'Example text 1c...';