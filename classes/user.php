<?php
 
/**
 * Class to handle user
 */
 
class User
{
  // Properties
 
  /**
  * @var int The user ID from the database
  */
  public $id = null;
 
  /**
  * @var string userName of the user
  */
  public $uname = null;
 
  /**
  * @var string email of the user
  */
  public $email = null;

   /**
  * @var string password of the user
  */
  public $password = null;
  
  /**
  * @var string userName of the user
  */
  public $fname = null;


  /**
  * @var string userName of the user
  */
  public $lname = null;

  /**
  * @var string A short description of the user
  */
  public $aboutme = null;
 
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
 
  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['uname'] ) ) $this->uname = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['uname'] );
    if ( isset( $data['email'] ) ) $this->email = $data['email'];
    if ( isset( $data['password'] ) ) $this->password = $data['password'];
    //if ( isset( $data['fname'] ) ) $this->fname = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['fname'] );
    //if ( isset( $data['lname'] ) ) $this->lname = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['lname'] );
    //if ( isset( $data['aboutme'] ) ) $this->aboutme = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['aboutme'] );
  }
 
 
  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */
 
  public function storeFormValues ( $params ) {
 
    // Store all the parameters
    $this->__construct( $params );
  }
 
 
  /**
  * Returns a Category object matching the given category ID
  *
  * @param string The username
  * @return user|false The user object, or false if the record was not found or there was a problem
  */
 
  public static function getByUsername( $uname ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM users WHERE uname = :uname";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":uname", $id, PDO::PARAM_STR);
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new User( $row );
  }
 
 
  /**
  * Returns all (or a range of) User objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
   *@param int Optional The number of rows per page to return (default=all)
  * @param string Optional column by which to order the categories (default="name ASC")
  * @return Array|false A two-element array : results => array, a list of Category objects; totalRows => Total number of categories
  */
 
  public static function getList( $numRows=0, $perPage=10000000,$order="id ASC" ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM users
            ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows, :perPage";
 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->bindValue( ":perPage", $perPage, PDO::PARAM_INT );
    $st->execute();
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $user = new User( $row );
      $list[] = $user;
    }
 
    // Now get the total number of user that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
 
 
  /**
  * Inserts the current Category object into the database, and sets its ID property.
  */
 
  public function insert() {
 
    // Does the User object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "User::insert(): Attempt to insert a User object that already has its ID property set (to $this->id).", E_USER_ERROR );
 
    // Insert the User
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO users ( uname,email,password) VALUES ( :uname, :email,:password)";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":uname", $this->uname, PDO::PARAM_STR );
    $st->bindValue( ":email", $this->email, PDO::PARAM_STR );
    $st->bindValue( ":password", sha1($this->password), PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }
 
 
  /**
  * Updates the current Category object in the database.
  */
 
  // public function update() {
 
  //   // Does the Category object have an ID?
  //   if ( is_null( $this->id ) ) trigger_error ( "User::update(): Attempt to update a User object that does not have its ID property set.", E_USER_ERROR );
    
  //   // Update the User
  //   $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
  //   $sql = "UPDATE categories SET name=:name, description=:description WHERE id = :id";
  //   $st = $conn->prepare ( $sql );
  //   $st->bindValue( ":name", $this->name, PDO::PARAM_STR );
  //   $st->bindValue( ":description", $this->description, PDO::PARAM_STR );
  //   $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
  //   $st->execute();
  //   $conn = null;
  // }
 
 
  // /**
  // * Deletes the current Category object from the database.
  // */
 
  // public function delete() {
 
  //   // Does the Category object have an ID?
  //   if ( is_null( $this->id ) ) trigger_error ( "Category::delete(): Attempt to delete a Category object that does not have its ID property set.", E_USER_ERROR );
 
  //   // Delete the Category
  //   $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
  //   $st = $conn->prepare ( "DELETE FROM categories WHERE id = :id LIMIT 1" );
  //   $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
  //   $st->execute();
  //   $conn = null;
  // }
 
}
 
?>