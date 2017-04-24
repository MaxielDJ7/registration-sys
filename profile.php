<?php
  include_once 'dbConnect.php';

  //Checks if user is logged in
  if(!$user->is_loggedin())
  {
   $user->redirect('signup.php');
  }
  //Retrieves appropriate user info to personalize profile
  else{
    $user_id = $_SESSION['user_session'];
    $stmt = $dbh->prepare("SELECT * FROM `user` WHERE `sessionid`=:user_id");
    $stmt->execute(array(':user_id'=>$user_id));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  }
    //Uploads images

    $file=$_FILES['image']['tmp_name'];
    if(isset($file))
    {
      $sessionid= $userRow['sessionid'];

      $image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
      $image_name= addslashes($_FILES['image']['name']);
      $image_size= getimagesize($_FILES['image']['tmp_name']);

      if( $image_size == false)
      {
        echo "Thats not an image";
      }
      else{
        echo $image;

        //if($user->upload($sessionid,$image_name,$image))

      }

    }

//  }

?>

<!DOCTYPE html>

<html>

  <head>

    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/style.css" rel="stylesheet">

  </head>

  <body>

    <nav class="row navbar">

      <div class="container-fluid">

        <div class= "col-md-2 col-md-offset-10">

          <a href= "profile.php">Profile</a>
          <a name= "logout" href= "logout.php"> Signout</a>


        </div>

    </div>

    </nav>

    <div class="container-fluid">
      <div class="row">

        <form method="post" action="profile.php" enctype="multipart/form-data">

          <div class= "header col-md 6 col-md-offset-3">

            <h3> <?php print($userRow['name']); ?>'s Profile</h3>

          </div>


          <div class= "row">

            <div class="form-group col-md-9 col-md-offset-3">

              <div class="row">

                <div class="form-group col-md-3 col-md-offset-9">


                </div>

              </div>

              <label for="image"> Profile Picture: </label>

              <input type="file" name="image"/>

              <button type="submit" name="upload" class="btn-primary btn-sm"> Update</button>

            </div>

          </div>

          <div class= "row">
            <div class="form-group col-md-6 col-md-offset-3">

              <label for="email_edit"> Email on file: </label>

              <input type= "text" name= "email_edit" placeholder="<?php print($userRow['email']); ?> ">

              <button type="submit" name="update" class=" btn-primary btn-sm"> Update </button>

            </div>
        </div>

      </form>

      </div>

      </div>



  </body>




</html>
