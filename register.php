<?php
include 'config.php';
include 'error.php';
$error ="";
$user_otp ="";
$fnameErr = "";
$done = 0;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $error = true;
    if(empty($_POST['first_name'])){
        $fnameErr = "please input First name";                      
        $error = false;
    }elseif(!preg_match("/^[a-zA-Z0-9 ]*$/", $_POST['first_name'])){
        $error = false;
        $fnameErr = "only alphabet and white space allowed";
    }
    if(empty($_POST['last_name'])){
        $nameErr = "please input Last name";                      
        $error = false;
    }elseif(!preg_match("/^[a-zA-Z0-9 ]*$/", $_POST['first_name'])){
        $error = false;
        $nameErr = "only alphabet and white space allowed";
    }
    $mail = $conn->getRow('user',['email'=>$_POST['email']]);
    if(empty($_POST['email'])){
        $error = false;
        $emailErr = "input field required";
    }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $error = false;
        $emailErr = "Invalid email format";
    }elseif(count($mail)>0){
      $error = false;
      $emailErr = "Email Already Exist!!!!";
    }
    /* echo "<pre>"; Password must have at least 1 uppercase character, 1 lowercase character, 1 special character,1 number and must be at least 6 characters long
    print_r($mail);die; */
    /* */
    
    if(empty($_POST['password'])){
        $error = false;
        $passErr = "password required";
    
    }elseif(empty($_POST['confirm_password'])){
        $error = false;
        $CpassErr = "please confirm password"; 
    }elseif($_POST['password']!=$_POST['confirm_password']){
        $error = false;
        $passErr = "password do not match!!!";
    }
    else
    {
      $pass = $_POST['password'];
      if(strlen($pass)<6)
      {
        $error = false;
        $passErr = "Password must be at least 6 characters long ";
      }
      elseif (preg_match("/[A-Z]/", $pass)===0) 
      {
        $error = false;
        $passErr = "Password must have at least 1 uppercase character";
      }
      elseif (preg_match("/[a-z]/", $pass)===0) 
      {
        $error = false;
        $passErr = "Password must have at least 1 lowercase character";
      }
      elseif (preg_match("/[0-9]/", $pass)===0) 
      {
        $error = false;
        $passErr = "Password must have at least 1 number";
      }
      elseif (preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $pass)===0) 
      {
        $error = false;
        $passErr = "Password must have at least 1 special character '\'^£$%&*()}{@#~?><>,|=_+¬-'";
      }
    }    
  }
if($error){ 
    
    $data = ['firstname'=>$_POST['first_name'],'lastname'=>$_POST['last_name'],'email'=>$_POST['email'],'password'=>md5($_POST['password'])];
    $done = $conn ->insData('user',$data);
         
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon1.png">
    <title>Pondacam | Signup</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="https://pondacams.com/assets/css/materialdesignicons.min.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="https://pondacams.com/assets/css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.6.55/css/materialdesignicons.min.css">
    <!-- End layout styles -->
    <style>
        .error{
                color : red;
            }
        </style>
  <?php
  echo $done;
    if($done){       
      $_SESSION['name'] = $_POST['first_name'];
      $_SESSION['email']=$_POST['email'];
      echo "<script> swal.fire('HI! ".$_SESSION['name']." You have been registered.Email :".$_SESSION['email']."');</script>";
     //echo "<script>window.location.href='verify_otp.php'</script>";
    } 
  ?>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
          <div class="row flex-grow">
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
              <div class="auth-form-transparent text-left p-3">
                <div class="brand-logo" >
                  <h1>REGISTER</h1>
                </div>
                <h4>Join us today! It takes only few steps</h4>
                <form class="pt-3" method = 'post'>
                  <div class="form-group">
                    <label for="exampleInputEmail">First Name</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-account-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control form-control-lg border-left-0" name = "first_name" id="first_name"
                       placeholder="Firstname" value = "<?php if(isset($_POST['first_name'])){echo $_POST['first_name']; }?>">
                    </div>
                    <span class = "error"><?php echo $fnameErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">Last Name</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-account-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control form-control-lg border-left-0" name = "last_name" id="last_name"
                       placeholder="Lastname" value = "<?php if(isset($_POST['last_name'])){echo $_POST['last_name']; }?>">
                    </div>
                    <span class = "error"><?php echo $nameErr ?></span>
                  </div>
				          <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-email-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="email" class="form-control form-control-lg border-left-0"name = "email" id="email"
                      placeholder="email " value = "<?php if(isset($_POST['email'])){echo $_POST['email']; }?>">
                    </div>
                    <span class = "error"><?php echo $emailErr ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-lock-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="password" class="form-control form-control-lg border-left-0" name = "password" id="password" placeholder="Enter your password"
                      value = "<?php if(isset($_POST['password'])){echo $_POST['password']; }?>">            
                    </div>
                    <span class = "error"><?php echo $passErr ?></span>  
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword">Confirm Password</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-lock-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="password" class="form-control form-control-lg border-left-0" name = "confirm_password" id="password" placeholder="Confirm your password"
                      value = "<?php if(isset($_POST['confirm_password'])){echo $_POST['confirm_password']; }?>"> 
                    </div>
                    <span class = "error"><?php echo $CpassErr ?></span>  
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions 
						            <i class="input-helper"></i></label>
                    </div>
                  </div>
                  <div class="my-3">
                    <button type = "submit" name = "sendMail" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >CREATE  ACCOUNT</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? 
				           <a href="login.php" class="text-primary">Login</a>
                  </div>
                </form>
              </div>
            </div>
            <style type="text/css">
               .test{
                  background: url(me.JPG);
                  background-size: cover;
                  background-repeat: no-repeat;
                  background-position: 100% 35%;
               }
            </style>
            <div class="col-lg-6 test d-flex flex-row">
              <p class="text-white font-weight-medium text-center flex-grow align-self-end">Designed By SAMKELO ZUMA Copyright &copy; 2021 All rights reserved.</p>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    
    <script src="https://pondacams.com/assets/js/off-canvas.js"></script>
    <script src="https://pondacams.com/assets/js/hoverable-collapse.js"></script>
    <script src="https://pondacams.com/assets/js/misc.js"></script>
    <script src="https://pondacams.com/assets/js/settings.js"></script>
    <script src="https://pondacams.com/assets/js/todolist.js"></script>
    <!-- endinject -->
  
</body>
</html>