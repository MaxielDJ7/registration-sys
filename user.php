<?php

class User
{
  private $db;

    function __construct($dbh)
    {
      $this->db = $dbh;
    }

    /* Hashes password and then saves it along with other
        user info into the db*/

    public function register($name,$email,$pass)
    {
       try
       {
           $new_pass = password_hash($pass, PASSWORD_DEFAULT);

           $stmt= $this->db->prepare('INSERT INTO user (`name`, `email`, `pass`) VALUES (?,?,?)');
           $stmt->bindParam(1, $name);
           $stmt->bindParam(2, $email);
           $stmt->bindParam(3, $new_pass);
           $stmt->execute();

           return $stmt;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
    }

    /* Looks up the user by email and verifies that the password
    passed through the functions matches the hashed value stored in the db*/

        public function Login($email,$pass)
    	{
    		try
    		{
    			$stmt = $this->db->prepare("SELECT `sessionid`, `email`, `pass` FROM `user` WHERE `email`=:email ");
    			$stmt->execute(array(':email'=>$email));
    			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    			if($stmt->rowCount() == 1)

          //return $userRow[`pass`];
    			{
    				if(password_verify($pass, $userRow['pass']))
    				{
    					$_SESSION['user_session'] = $userRow['sessionid'];

    					return true;
    				}
    				else
    				{
    					return false;
    				}
    			}
    		}
    		catch(PDOException $e)
    		{
    			echo $e->getMessage();
    		}
    	}

      /*retrieves user_session id*/

      public function is_loggedin()
      {
         if(isset($_SESSION['user_session']))
         {
            return true;
         }
      }

      /*whenever a function successfully executes page is redirected*/

      public function redirect($url)
      {
          header("Location: $url");
      }

      /*closes the session when user clicks logout*/

      public function logout()
      {
           session_destroy();
           unset($_SESSION['user_session']);
           return true;
      }

      public function upload( $sessionid, $image_name, $image)
      {
        try{

        //  $stmt=$dbh->prepare("INSERT INTO user(`image`,'image_name') VALUES (':image',':image_name') WHERE `sessionid`=:sessionid");

          //$stmt->execute(array(':image'=>$image,':image_name'=>$image_name, ':sessionid'=>$sessionid));

          $stmt=$dbh->prepare("INSERT INTO user(`image`,'image_name') VALUES (?,?) WHERE `sessionid`=?");

          $stmt->bindParam(1, $image);
          $stmt->bindParam(2, $image_name);
          $stmt->bindParam(3, $sessionid);
          $stmt->execute();

          return $stmt;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        //$imageFetch=$stmt->fetch(PDO::FETCH_ASSOC);

        /*if($imageFetch==0)
        {

          echo "problem uploading image";
        }
      else{

        echo "image uploaded";

      }*/


      }
}

?>
