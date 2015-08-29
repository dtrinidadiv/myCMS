<?php
 
require( "config.php" ); // include the config file so that all the configuration settings are available to the script

/**
* check that the $_GET['action'] value exists by using isset(). 
*If it doesn't, we set the corresponding $action variable to an empty string ("").
*/
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['user-username'] ) ? $_SESSION['user-username'] : "";

if (isset( $_SESSION['user-username'] ) && $action == 'user-login') {
    homepage();
  exit;
}

if ($action != "user-login" && $action != "user-logout" && !$username ) {
    login();
  exit;
}
 // Decide which action to perform base on the $action value
switch ( $action ) {
   case 'user-login':
    login();
    break;
  case 'user-logout':
    logout();
    break;
  case 'archive':
    archive();
    break;
  case 'viewArticle':
    viewArticle();
    break;
  default:
    homepage();
}
 
 function login() {
 
  $results = array();
  $results['pageTitle'] = "User Login";
 
  if ( isset( $_POST['user-login'] ) ) {
 
    // User has posted the login form: attempt to log the user in
 
    if ( $_POST['username'] == USER_USERNAME && $_POST['password'] == USER_PASSWORD ) {
 
      // Login successful: Create a session and redirect to the admin homepage
      $_SESSION['user-username'] = USER_USERNAME;
      header( "Location: index.php" );
 
    } else {
 
      // Login failed: display an error message to the user
      $results['errorMessage'] = "Incorrect username or password. Please try again.";
      require( TEMPLATE_PATH . "/user/loginForm.php" );
    }
 
  } else {
 
    // User has not posted the login form yet: display the form
    require( TEMPLATE_PATH . "/user/loginForm.php" );
  }
 
}


 
 
function logout() {
  unset( $_SESSION['user-username'] );
  header( "Location: index.php" );
}



 function archive() {
  $results = array();
  $categoryId = ( isset( $_GET['categoryId'] ) && $_GET['categoryId'] ) ? (int)$_GET['categoryId'] : null;
  $results['category'] = Category::getById( $categoryId );
  $data = Article::getList(0, 100000, $results['category'] ? $results['category']->id : null );
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $data = Category::getList();
  $results['categories'] = array();
  foreach ( $data['results'] as $category ) $results['categories'][$category->id] = $category;
  $results['pageHeading'] = $results['category'] ?  $results['category']->name : "All ";
  $results['pageTitle'] = $results['pageHeading'] . "Articles";
  require( TEMPLATE_PATH . "/archive.php" );
}


// This function displays a list of all the articles in the database. 
// calling the getList() method of the Article class
function viewArticle() {
  if ( !isset($_GET["articleId"]) || !$_GET["articleId"] ) {
    homepage();
    return;
  }
 
  $results = array();
  $results['article'] = Article::getById( (int)$_GET["articleId"] );
  $results['category'] = Category::getById( $results['article']->categoryId );
  $results['pageTitle'] = $results['article']->title . " | #DEVCOHOLICS";
  require( TEMPLATE_PATH . "/viewArticle.php" );
}
 
function homepage() {
  $results = array();
  $data = Article::getList(0, HOMEPAGE_NUM_ARTICLES );
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $data = Category::getList();
  $results['categories'] = array();
  foreach ( $data['results'] as $category ) $results['categories'][$category->id] = $category; 
  $results['pageTitle'] = "#DEVCOHOLICS";
  require( TEMPLATE_PATH . "/homepage.php" );
}
 
?>