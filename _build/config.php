<?php 
  // set user

  $USER = 'agoff';

  $DEV = 'DEV';
  $PROD = 'PROD';

  // set build environment
  $BUILD_ENV = $DEV;

  // set debug mode
  $DEBUG_MODE = true;


  $LOCAL_DIR = 'C:/Users/Andrew/Desktop/New folder (2)/';
  $PROD_DIR = 'Users'. $USER .'/public_html/';

  $PROJECT_DIR = ($BUILD_ENV === $DEV) ? $LOCAL_DIR : $PROD_DIR;
?>

