<?php
  require_once 'dbConnect.php';

  if($user->is_loggedin()!="")
{
    $user->user('profile.php');
}

if(isset($_POST['signup']))
{
   $name = trim($_POST['name']);
   $email = trim($_POST['email']);
   $pass = trim($_POST['pass']);

//form validations

    if($name=="")	{
  		$error[] = "provide your name !";
  	}
  	else if($email=="")	{
  		$error[] = "provide email address !";
  	}
  	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))	{
  	    $error[] = 'Please enter a valid email address !';
  	}
  	else if($pass=="")	{
  		$error[] = "provide password !";
  	}
  	else if(strlen($pass) < 6){
  		$error[] = "Password must be atleast 6 characters";
  	}
    else{

      try
      {
         $stmt = $dbh->prepare("SELECT `name`,`email` FROM `user` WHERE `name`=? OR `email`=?");

         $stmt->bindParam(1, $name);
         $stmt->bindParam(2, $email);

         $row=$stmt->fetch(PDO::FETCH_ASSOC);

         if($row[`email`]==$email) {
            $error[] = "sorry email id already taken !";
         }
         else
         {
            if($user->register($name,$email,$pass))
            {
                //echo "signup registered Successful";
               $user->redirect('login.php');

            }
         }
     }
     catch(PDOException $e)
     {
        echo $e->POSTMessage();
     }
  }
}


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

         <div class= "col-md-3 col-md-offset-9">

             <a href= "login.php">Login</a>
             <a href= "signup.php"> Sign Up</a>
             <a href= "profile.php">Profile</a>

         </div>

     </div>

     </nav>

     <div class="container-fluid">
       <div class="row">

         <form method='post'>

           <div class= "header col-md 6 col-md-offset-3">

             <h3> Signup</h3>

           </div>

           <div class="form-group col-md-6 col-md-offset-3">

               <label for="name"> Name</label>
               <input type="name" name="name" class="form-control" id="name"
               placeholder="name">
           </div>

           <div class="form-group col-md-6 col-md-offset-3">

               <label for="email"> Email Address</label>
               <input type="email" name="email" class="form-control" id="email"
               placeholder="email">
           </div>

           <div class="form-group col-md-6 col-md-offset-3">

               <label for="password"> Password</label>
               <input type="password" name="pass" class="form-control" id="password"
               placeholder="password">
           </div>

           <div class="form-group col-md-6 col-md-offset-3">

               <label for="confirm"> Confirm Password</label>
               <input type="password" name="confirm" class="form-control" id="confirm"
               placeholder="confirm">
           </div>


           <div class="form-group col-md-3 col-md-offset-9">

               <button type="submit" name="signup" class="btn btn-default">Sign Up</button>
           </div>

       </form>

       </div>

       </div>



   </body>




 </html>
