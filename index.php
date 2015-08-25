<?php
 
require( "config.php" ); // include the config file so that all the configuration settings are available to the script

/**
* check that the $_GET['action'] value exists by using isset(). 
*If it doesn't, we set the corresponding $action variable to an empty string ("").
*/
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
 

 // Decide which action to perform base on the $action value
switch ( $action ) {
  case 'archive':
    archive();
    break;
  case 'viewArticle':
    viewArticle();
    break;
  default:
    homepage();
}
 
// This function displays a list of all the articles in the database. 
// calling the getList() method of the Article class
function archive() {
  $results = array();
  $data = Article::getList();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Article Archive | #DEVCOHOLIC";
  require( TEMPLATE_PATH . "/archive.php" );
}

//This function displays a single article page. It retrieves the ID of the article to display from the articleId URL parameter, 
//then calls the Article class's getById() method to retrieve the article object 
function viewArticle() {

  //If no articleId was supplied, or the article couldn't be found, 
  //then the function simply displays the homepage instead
  if ( !isset($_GET["articleId"]) || !$_GET["articleId"] ) { 
    homepage();
    return;
  }
 
  $results = array();
  $results['article'] = Article::getById( (int)$_GET["articleId"] ); 
  $results['pageTitle'] = $results['article']->title . " | Widget News";
  require( TEMPLATE_PATH . "/viewArticle.php" );
}

// displays the site homepage containing a list of up to HOMEPAGE_NUM_ARTICLES articles.
function homepage() {
  $results = array();
  $data = Article::getList( HOMEPAGE_NUM_ARTICLES );
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "#DEVCOHOLIC";
  require( TEMPLATE_PATH . "/homepage.php" );
}
 
?>