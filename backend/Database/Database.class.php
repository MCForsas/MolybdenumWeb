<?php
/*
  Class used to connect to database and execute queries
*/
class Database{
  
  private $database;
  
  function __construct(){ //Connects to database
    require_once($_SERVER['DOCUMENT_ROOT'].'/MolybdenumWeb/backend/Configuration/Globals.php');
    try{
        $this->database = new PDO(
          'mysql:host='.DATABASE_HOST.
          ';dbname='.DATABASE_NAME,
          DATABASE_USER,
          DATABASE_PASSWORD,
          array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION) //Don't have a clue what it does
        );
    } catch (PDOException $e){
        die(json_encode(array('outcome' => false, 'message' => 'Unable to connect to the server')));
        //TODO replace with prettier message
    }
  }

  public function executeQuery($query,$arguments){ //executes secure query
    require_once('SecureInput.php');
    
    $execution = $this->database->prepare($query);
    
    foreach ($arguments as $key => $value) { //binds values
      $value = secureText($value);
      if(!$execution->bindValue($key,$value)){
        die('Error 000'); //TODO: fix this error shit
      }
    }
    
    //$execution->debugDumpParams();
    try{
        $execution->execute();
    } catch (Exception $ex) {
        die(implode("|",$execution->errorInfo()));
        //TODO don't display errors
    }
    
    return $execution->fetchAll();  
  }
  
  public function executePlainQuery($query){ //executes secure query
    require_once('SecureInput.php');
    
    $securedQuery = secureText($query);
    $execution = $this->database->prepare($securedQuery);

    try{
        $execution->execute();
    } catch (Exception $ex) {
        die(implode(" | ",$execution->errorInfo()));
        //TODO don't display errors
    }
    
    return $execution->fetchAll();  
  }

  //Generates random unique id for record
  public function generateUniqueId($lenght = 13) {
    // uniqid gives 13 chars, but you could adjust it to your needs.
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($lenght / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
    } else {
        throw new Exception("no cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $lenght);
  }
}
?>
