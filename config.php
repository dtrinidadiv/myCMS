<?php
ini_set( "display_errors", true );  // change to false in deployment
date_default_timezone_set( "Asia/Manila" );  // http://www.php.net/manual/en/timezones.php
define( "DB_DSN", "mysql:host=localhost;dbname=cms" ); 
define( "DB_USERNAME", "root" ); //Set these values to your MySQL username
define( "DB_PASSWORD", "" ); //Set these values to your MySQL password

/**
*	---set path names : CLASS_PATH, which is the path to the class files, 
*	and TEMPLATE_PATH, which is where our script should look for the HTML template files.
*/
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );


define( "HOMEPAGE_NUM_ARTICLES", 3 ); // controls the maximum number of article headlines to display on the site homepage.

/**
*	---constants contain the login details for the CMS admin user.
*/	
define( "ADMIN_USERNAME", "admin" );
define( "ADMIN_PASSWORD", "d033e22ae348aeb5660fc2140aec35850c4da997" ); // used sha-1 hash (admin)

require( CLASS_PATH . "/article.php" ); //Since the Article class file needed by all scripts in the app, we include it here.
 

/**
*	---simple function to handle any PHP exceptions that might be raised as our code runs.
*/

function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log( $exception->getMessage() );
}
set_exception_handler( 'handleException' ); //we set it as the exception handler by calling PHP's set_exception_handler() function.
?>