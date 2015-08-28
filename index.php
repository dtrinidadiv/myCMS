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
 

 function archive() {
  $results = array();
  $categoryId = ( isset( $_GET['categoryId'] ) && $_GET['categoryId'] ) ? (int)$_GET['categoryId'] : null;
  $results['category'] = Category::getById( $categoryId );
  $data = Article::getList( 100000, $results['category'] ? $results['category']->id : null );
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
  $data = Article::getList( HOMEPAGE_NUM_ARTICLES );
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $data = Category::getList();
  $results['categories'] = array();
  foreach ( $data['results'] as $category ) $results['categories'][$category->id] = $category; 
  $results['pageTitle'] = "#DEVCOHOLICS";
  require( TEMPLATE_PATH . "/homepage.php" );
}
 
?>