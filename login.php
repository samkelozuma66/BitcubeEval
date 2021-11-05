<?php

include 'config.php';
include 'error.php';

  if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(empty($_POST['email'])){
      $emailErr = "please input email";
    }
    elseif(empty($_POST['password'])){
      $passErr = "password required";    
    }               
    else{            
          $user = $conn ->getRow('user',['email'=>$_POST['email']]);      
          
          if(count($user)<=0){
            $emailErr = "Sorry!! you are not registered"; 
          }   
        }  
    if(isset($user[0])){
        if($user[0]['password']==md5($_POST['password'])){
          
          $_SESSION['id']=$user[0]['id'];
          $_SESSION['first_name']=$user[0]['firstname'];
          $_SESSION['last_name']=$user[0]['lastname'];
          $_SESSION['email']=$user[0]['email']; 

          if(isset($_POST['remeberme']))
          {
            echo "<script>localStorage.setItem('email', '".$_POST['email']."');</script>";
            echo "<script>localStorage.setItem('password', '".$_POST['password']."');</script>";
            //echo "<script>alert('".$_POST['remeberme']."')</script>";
          }
          
          echo "<script>window.location.href='profile.php'</script>";
          /*//print_r($_SESSION); die;  remeberme localStorage.setItem("lastname", "Smith");
          if($_SESSION['id_number']== null){
            echo "<script>window.location.href='registerUpdate.php'</script>";
          } 
          elseif($_SESSION['status']!='approved'){
            echo "<script>window.location.href='registerUpdate.php'</script>";
          }elseif($_SESSION['regType']=='individual')
          {
            echo "<script>window.location.href='model/index.php'</script>";
          }elseif($_SESSION['regType']=='company'){
            echo "<script>window.location.href='studio/index.php'</script>";
          }    */     
        }else{
          $passErr = "Invalid password!!!!"; 
        }
        
    }
  }          
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon1.png">
    <title>Pondacam </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="https://www.pondacams.com/assets/css/materialdesignicons.min.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="https://www.pondacams.com/assets/css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.6.55/css/materialdesignicons.min.css">
    <!-- End layout styles -->
    <style>
      .error{
        color:red;
      }
    </style>
  <script type="text/javascript">
    var email = localStorage.getItem("email");
    var password = localStorage.getItem("password");

    if (email !== "" && email !== null) 
    {
      if (password !== "" && password !== null) 
      {
        //alert("Credetials Save");
      }
    }
  </script>
   
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
          <div class="row flex-grow">
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
              <div class="auth-form-transparent text-left p-3">
                <div class="brand-logo" >
                  <h1>LOGIN</h1>
                </div>
                <h4>Welcome back!</h4>
                <h6 class="font-weight-light">Happy to see you again!</h6>
                <form class="pt-3" method = "post"  >
                  <div class="form-group">
                    <label for="exampleInputEmail">Email</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-account-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="email" name = "email" id="email" class="form-control form-control-lg border-left-0"
                      value = "<?php if(isset($_POST['email'])){echo $_POST['email']; } ?>" id="" placeholder="Username">
                    </div>
                    <div><span class = "error"><?php echo $emailErr?> </span></div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-lock-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="password" name="password" id="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword"
                      value = "<?php if(isset($_POST['password'])){echo $_POST['password']; } ?>" placeholder="Password">             
                    </div>
                    <div><span class = "error"><?php echo $passErr?> </span></div>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" name="remeberme"class="form-check-input"> Keep me signed in <i class="input-helper"></i></label>
                    </div>
                    <a href="reset-password.html" class="auth-link text-black">Forgot password?</a>
                  </div>
                  <div class="my-3">
                    <button type = "submit" id="login" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >LOGIN</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Don't have an account? 
				          <a href="register.php" class="text-primary">Create</a>
                  </div>
                  
                  <div class="text-center mt-4 font-weight-light">  
				          <a href="index.php" class="text-primary">JOIN CHATS</a>
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
    <script type="text/javascript">
      var email = localStorage.getItem("email");
      var password = localStorage.getItem("password");

      const queryString = window.location.search;

      const urlParams = new URLSearchParams(queryString);

      const logout = urlParams.get('logout')

      
      if (email !== "" && email !== null && logout == null) 
      {
        if (password !== "" && password !== null) 
        {
          var inEmail = document.getElementById("email");
          var inPassw = document.getElementById("password");
          var btnLogin = document.getElementById("login");
          inEmail.value = email;
          inPassw.value =password;
          btnLogin.click();
          //alert("Credetials Save");
        }
      }
    </script>
    <script src="https://www.pondacams.com/assets/js/off-canvas.js"></script>
    <script src="https://www.pondacams.com/assets/js/hoverable-collapse.js"></script>
    <script src="https://www.pondacams.com/assets/js/misc.js"></script>
    <script src="https://www.pondacams.com/assets/js/settings.js"></script>
    <script src="https://www.pondacams.com/assets/js/todolist.js"></script>
    <!-- endinject -->
  
</body>
</html>