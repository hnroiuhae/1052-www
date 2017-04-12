<!DOCTYPE html>
<html lang="zh-tw">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./img/icon_linux.png">
    <title>金門領酒系統</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/mainstyle.css" rel="stylesheet">
    <link rel="import" href="./php/modals.php">
  </head>
  <!-- Bootstrap core JavaScript
================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="./js/vendor/jquery-3.1.1.slim.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="./js/vendor/jquery.min.js"><\/script>')

  </script>
  <script src="./js/vendor/tether.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="./js/ie10-viewport-bug-workaround.js"></script>
  <!-- Custom JS for this -->
  <!--script src="XXX.js"></script-->

</html>
<?php session_start(); ?>
<?php

//echo "Connected successfully";
    include 'db.php';
    /*
    $sql = "INSERT INTO clients (clientID, pw, name, phone, id)VALUES ('6', 'test', 'hello', '0912254358', 'E123456789')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
    }
    */
    ///////////////
    
//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
    $clientID = 6;
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    //$email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['RecoveryPhoneNumber']);
    $password = mysqli_real_escape_string($conn, $_POST['Passwd']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['PasswdAgain']);
    $id = mysqli_real_escape_string($conn, $_POST['ID']);
    /*
    //name can contain only alpha characters and space
    if (!preg_match("/^\\d{4},[\\s\\p{L}]+$/u",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if (!preg_match("/^[A-Z][12][0-9]{8}+$/",$id)) {
        $error = true;
        $id_error = "id error";
    }
    
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    
    if(!preg_match("/^09\d{2}-?\d{3}-?\d{3}$/",$phone)){
        $error = true;
        $phone_error = "phone must be maximum 10 digits";
    }
    
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if($password != $cpassword) {
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
    }
    */
    if (!$error) {
        if(mysqli_query($conn, "INSERT INTO clients ( pw, name, phone, id)VALUES ('" . $password . "', '" . $name . "', '" . $phone . "', '" . $id . "')")) {
            $successmsg = "Successfully Registered! <a href='index2.php'>Click here to Login</a>";
        } else {
            $errormsg = "Error in registering...Please try again later!";
        }
    }
}
    ///////////////
    $conn->close();
?>

  <body>
    <!--?php include 'nav.php'; ?-->
    <div class="container">

      <!--/row-->

      <hr>

    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
                <fieldset>
                    <legend>Sign Up</legend>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="ID">ID</label>
                        <input type="text" name="ID" id="ID" placeholder="ID" required value="<?php if($error) echo $id; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($id_error)) echo $id_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="Passwd">Password</label>
                        <input type="password" name="Passwd" id="Passwd" placeholder="Password" required class="form-control" />
                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="PasswdAgain">Confirm Password</label>
                        <input type="password" name="PasswdAgain" id="PasswdAgain" placeholder="Confirm Password" required class="form-control" />
                        <span class="text-danger"><?php if (isset($cpasswd_error)) echo $cpasswdAgain_error; ?></span>
                    </div>

                    <!--div class="form-group">
                        <label for="EmailAddress">Email</label>
                        <input type="text" name="EmailAddress" id="EmailAddress" placeholder="Email" required value="<?//php if($error) echo $email; ?>" class="form-control" />
                        <span class="text-danger"><?//php if (isset($email_error)) echo $email_error; ?></span>
                    </div-->

                    <div class="form-group">
                        <label for="RecoveryPhoneNumber">Phone</label>
                        <input type="text" name="RecoveryPhoneNumber" id="RecoveryPhoneNumber" placeholder="Phone" required value="<?php if($error) echo $phone; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($phone_error)) echo $phone_error; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        Already Registered? <a href="index2.php">Login Here</a>
        </div>
    </div>



      
      <?php include 'footer.php'; ?>
    </div>
    <!--/.container-->
    <!-- Custom Modal for this -->
    <script>
      var link = document.querySelector('link[rel="import"]');
      var content = link.import;
      // Grab DOM from modals.html's document.
      var el = content.querySelector('.modals');
      document.body.appendChild(el.cloneNode(true));

    </script>
    <!-- Custom JS for this -->
    <script>
   function checkPassword(str)
  {
    // at least one number, one lowercase and one uppercase letter
    // at least six characters
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    return re.test(str);
  }
    </script>

    <script src="./js/main.js"></script>
  </body>

  </html>
  <?php $_SESSION['last_action'] = bin2hex(openssl_random_pseudo_bytes(128)); ?>
