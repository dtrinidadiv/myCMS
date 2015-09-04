<?php
 
/**
 * Class to handle articles
 */
 
class Article
{
 
  // Properties
 
  /**
  * @var int The article ID 
  */
  public $id = null;
 
  /**
  * @var int When the article was published
  */
  public $publicationDate = null;

  /**
  * @var int The article category ID
  */
  public $categoryId = null;
 
  /**
  * @var string Full title of the article
  */
  public $title = null;
 
  /**
  * @var string summary of the article
  */
  public $summary = null;
 
  /**
  * @var string The HTML content of the article
  */
  public $content = null;
 
 
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
 
  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['publicationDate'] ) ) $this->publicationDate = (int) $data['publicationDate'];
    if ( isset( $data['categoryId'] ) ) $this->categoryId = (int) $data['categoryId'];
    /**
    *The title and summary are filtered using a regular expression to only allow a certain range of characters. 
    *It's good security practice to filter data on input like this, only allowing acceptable values and characters through.
    */
    if ( isset( $data['title'] ) ) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title'] );
    if ( isset( $data['summary'] ) ) $this->summary = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['summary'] );

    /**
    * don't filter the content property because admin will be using html markup in the article content
    */
    if ( isset( $data['content'] ) ) $this->content = $data['content'];
  }
 
 
  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */
 
  public function storeFormValues ( $params ) { //this function will handle the create and update article
 
    // Store all the parameters
    $this->__construct( $params );
 
    /**
    * Parse and store the publication date. It also Handles publication dates in the format YYYY-MM-DD, 
    * converting the date into the UNIX timestamp format suitable for storing in the object.
    */

    if ( isset($params['publicationDate']) ) {
      $publicationDate = explode ( '-', $params['publicationDate'] );
 
      if ( count($publicationDate) == 3 ) {
        list ( $y, $m, $d ) = $publicationDate;
        $this->publicationDate = mktime ( 0, 0, 0, $m, $d, $y );
      }
    }
  }
 
 
  /**
  * Returns an Article object matching the given article ID
  *
  * @param int The article ID
  * @return Article|false The article object, or false if the record was not found or there was a problem
  */

  //static keyword to the method definitionallows the method to be called directly without specifying an object
 
  public static function getById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); // makes a connection to the MySQL database using the login details from the config.php 
    $sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM articles WHERE id = :id"; 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null; //close connection
    if ( $row ) return new Article( $row );
  }
 
 
   /**
  * Returns all (or a range of) Article objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param int Optional Return just articles in the category with this ID
  * @param string Optional column by which to order the articles (default="publicationDate DESC")
  * @return Array|false A two-element array : results => array, a list of Article objects; totalRows => Total number of articles
  */
 
  public static function getList( $numRows=0, $perPage=10000000, $categoryId=null, $order="publicationDate DESC" ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $categoryClause = $categoryId ? "WHERE categoryId = :categoryId" : "";
    $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publicationDate) AS publicationDate
            FROM articles $categoryClause
            ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows, :perPage";
 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->bindValue( ":perPage", $perPage, PDO::PARAM_INT );
    if ( $categoryId ) $st->bindValue( ":categoryId", $categoryId, PDO::PARAM_INT );
    $st->execute();
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $article = new Article( $row );
      $list[] = $article;
    }
 
    // Now get the total number of articles that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
 
 
  /**
  * Inserts the current Article object into the database, and sets its ID property.
  */
 
  public function insert() {
 
    // Does the Article object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Article::insert(): Attempt to insert an Article object that already has its ID property set (to $this->id).", E_USER_ERROR );
 
    // Insert the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO articles ( publicationDate, categoryId, title, summary, content ) VALUES ( FROM_UNIXTIME(:publicationDate), :categoryId, :title, :summary, :content )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
    $st->bindValue( ":categoryId",1, PDO::PARAM_INT );
    $st->bindValue( ":title", "$this->title", PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }
 
 
  /**
  * Updates the current Article object in the database.
  */
 
  public function update() {
 
    // Does the Article object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Article::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR );
    
    // Update the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE articles SET publicationDate=FROM_UNIXTIME(:publicationDate), categoryId=:categoryId, title=:title, summary=:summary, content=:content WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
    $st->bindValue( ":categoryId", $this->categoryId, PDO::PARAM_INT );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
 
  /**
  * Deletes the current Article object from the database.
  */
 
  public function delete() {
 
    // Does the Article object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Article::delete(): Attempt to delete an Article object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM articles WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
}
 
?>