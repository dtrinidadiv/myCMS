<?php
 
require( "config.php" );

//This PHP function starts a new session for the user, which we can use to track whether the user is logged in or not. 
//(If a session for this user already exists, PHP automatically picks it up and uses it.)
session_start();

//Grab the action parameter and username session variable
// / If a value doesn't exist then we set the corresponding variable to an empty string ("").
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";

/**
*The user shouldn't be allowed to do anything unless they're logged in as an admin. 
*So the next thing we do is inspect $username to see if the session contained a value for the username key, 
*which we use to signify that the user is logged in. If $username's value is empty — and the user isn't already trying to log in or out — 
*then we display the login page and exit immediately.
*/

if ( $action != "login" && $action != "logout" && !$username ) {
  login();
  exit;
}
 

// Decide which action to perform
switch ( $action ) {
  case 'login':
    login();
    break;
  case 'logout':
    logout();
    break;
  case 'newArticle':
    newArticle();
    break;
  case 'editArticle':
    editArticle();
    break;
  case 'deleteArticle':
    deleteArticle();
    break;
  default:
    listArticles();
}
 

//This is called when the user needs to log in, or is in the process of logging in.
function login() {
 
  $results = array();
  $results['pageTitle'] = "Administrator Login | #DEVCOHOLIC.ADMIN";
 
  if ( isset( $_POST['login'] ) ) {
 
    // User has posted the login form: attempt to log the user in

    //ADMIN_USERNAME and ADMINP_PASSWORD Is Declared in config.php
    //used sha1 hash for the password
    if ($_POST['username']== ADMIN_USERNAME && sha1($_POST['password']) == ADMIN_PASSWORD ) { 
 
      // Login successful: Create a session and redirect to the admin homepage
      $_SESSION['username'] = ADMIN_USERNAME;
      header( "Location: admin.php" ); //redirect the browser to admin.php
 
    } else {
 
      // Login failed: display an error message to the user
      $results['errorMessage'] = "Invalid username or password. Please try again.";
      require( TEMPLATE_PATH . "/admin/loginForm.php" );
    }
 
  } else {
 
    // User has not posted the login form yet: display the form
    require( TEMPLATE_PATH . "/admin/loginForm.php" );
  }
 
}
 
//It simply removes the username session key and redirects back to admin.php.
function logout() {
  unset( $_SESSION['username'] );
  header( "Location: admin.php" );
}
 
 
function newArticle() {
 
  $results = array();
  $results['pageTitle'] = "New Article";
  $results['formAction'] = "newArticle";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the article edit form: save the new article
    $article = new Article;
    $article->storeFormValues( $_POST );
    $article->insert();
    header( "Location: admin.php?status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the article list
    header( "Location: admin.php" );
  } else {
 
    // User has not posted the article edit form yet: display the form
    $results['article'] = new Article;
    require( TEMPLATE_PATH . "/admin/editArticle.php" );
  }
 
}
 
 
function editArticle() {
 
  $results = array();
  $results['pageTitle'] = "Edit Article";
  $results['formAction'] = "editArticle";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the article edit form: save the article changes
 
    if ( !$article = Article::getById( (int)$_POST['articleId'] ) ) {
      header( "Location: admin.php?error=articleNotFound" );
      return;
    }
 
    $article->storeFormValues( $_POST );
    $article->update();
    header( "Location: admin.php?status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the article list
    header( "Location: admin.php" );
  } else {
 
    // User has not posted the article edit form yet: display the form
    $results['article'] = Article::getById( (int)$_GET['articleId'] );
    require( TEMPLATE_PATH . "/admin/editArticle.php" );
  }
 
}
 
 
function deleteArticle() {
  
  //displaying an error if the article couldn't be found in the database
  if ( !$article = Article::getById( (int)$_GET['articleId'] ) ) {
    header( "Location: admin.php?error=articleNotFound" );
    return;
  }
 
  //calls the article's delete() method to remove the article from the database.
  $article->delete();
  header( "Location: admin.php?status=articleDeleted" );
}
 
 
function listArticles() {
  $results = array();
  $data = Article::getList();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "All Articles";
 
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "articleNotFound" ) 
        $results['errorMessage'] = "Error: Article not found.";
  }
 
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) 
        $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "articleDeleted" ) 
        $results['statusMessage'] = "Article deleted.";
  }
 
  require( TEMPLATE_PATH . "/admin/listArticles.php" );
}
 
?>