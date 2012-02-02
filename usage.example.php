<?php

//Initialize Exception Handling
try {
  // Your bootstrap code!

  // Just some stupid placeholders...
  $a = 1;
  $a ++;
  echo $a;

} catch (Exception $e) {
  // Handle exceptions using phpception.
  $phpceptionObj = PHPCeption_PHPCeption::createInstance();
  $phpceptionObj->handle($e);
}