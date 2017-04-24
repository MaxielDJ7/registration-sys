<?php
require_once 'dbConnect.php';

//checks to see if user is already logged in

if($user->is_loggedin()!="")
{
	$user->redirect('profile.php');
}

//Email and pass are retrieved and passed through login function

if(isset($_POST['login']))
{
	$email = strip_tags($_POST['email']);
	$pass = strip_tags($_POST['pass']);

	if($user->login($email,$pass))
	{
    //echo "it worked";
		$user->redirect('profile.php');
	}
	else
	{
    //echo "still";
		$error = "Wrong Details !";
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

             <h3> Login</h3>

           </div>

           <div class="form-group col-md-6 col-md-offset-3">

               <label for="email"> Email Address</label>
               <input type="text" name="email" class="form-control" id="email"
               placeholder="email">
           </div>

           <div class="form-group col-md-6 col-md-offset-3">

               <label for="password"> Password</label>
               <input type="password" name="pass" class="form-control" id="pass"
               placeholder="password">
           </div>

           <div class="form-group col-md-3 col-md-offset-9">

               <button type="submit" name="login" class="btn btn-default">Login</button>
           </div>

       </form>

       </div>

       </div>



   </body>




 </html>
