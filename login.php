<?php include_once 'helpers/helper.php'; ?>

<?php subview('header.php'); ?>
<link rel="stylesheet" href="assets/css/form.css">
<?php
if(isset($_GET['pwd'])) {
    if($_GET['pwd']=='updated') {
        echo "<script>alert('Your password has been reset!!');</script>";
    }
}    
?>
<?php
if(isset($_GET['error'])) {
    if($_GET['error'] === 'invalidcred') {
        echo '<script>alert("Invalid Credentials")</script>';
    } else if($_GET['error'] === 'wrongpwd') {
        echo '<script>alert("Wrong Password")</script>';
    } else if($_GET['error'] === 'sqlerror') {
        echo"<script>alert('Database error')</script>";
    }
}
if(isset($_COOKIE['Uname']) && isset($_COOKIE['Upwd'])) {
  require 'helpers/conn.php';   
  $email_id = $_POST['user_id'];
  $password = $_POST['user_pass'];
  $sql = 'SELECT * FROM users WHERE username=? OR email=?;';
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$sql)) {
      header('Location: views/login.php?error=sqlerror');
      exit();            
  } else {
      mysqli_stmt_bind_param($stmt,'ss',$_COOKIE['Uname'],$_COOKIE['Uname']);            
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)) {
          $pwd_check = password_verify($_COOKIE['Upwd'],$row['password']);
          if($pwd_check == false) {
              setcookie('Uname', '',time() - 3600);
              setcookie('Upwd', '',time() - 3600);              
              header('Location: views/login.php?error=wrongpwd');
              exit();    
          }
          else if($pwd_check == true) {
              session_start();
              $_SESSION['userId'] = $row['user_id'];
              $_SESSION['userUid'] = $row['username'];
              $_SESSION['userMail'] = $row['email'];                            
              header('Location: views/index.php?login=success');
              exit();                  
          } else {
              header('Location: views/login.php?error=invalidcred');
              exit();                    
          }
      }
      header('Location: views/login.php?error=invalidcred');
      exit();         
  }
  header('Location: views/login.php?error=invalidcred');
  exit();      
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
?>
<style>
  
  input {
    border :0px !important;
    border-bottom: 2px solid #838383 !important;
    color :#000 !important;
    border-radius: 0px !important;
    font-weight: bold !important;
    background-color: whitesmoke !important;  
    border: none;
    border-bottom: 2px solid #838383;      
  }
  *:focus {
    outline: none !important;
  }
  label {
    color : #000 !important;
    font-size: 19px;
  }
  h5.form-name {
    color: #000;
   
    font-weight: 50;
    margin-bottom: 0px !important;
    margin-top: 10px;
  }
  h5 {
    color: #ffffff;
    font-weight: bold;
    font-size: 22px ;
	  font-family: 'Montserrat', sans-serif;    
  }
  a:hover {
    text-decoration: none;
  }
  
  
  h1 {
    font-size: 30px !important;
    margin-bottom: 20px;  

    text-align: center;
    font-family :'product sans' !important;
    font-weight: bolder;
  }
  div.form-out {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);  
    background-color: whitesmoke !important;
    padding: 40px;
    margin-top: 60px;
  }
  .input-group {
  position: relative;
  display: inline-block;
  width: 100%;
}
  
  @media screen and (max-width: 768px){
    body {
      background-color: #fff;
      background-image: none;
    }
    div.form-out {
    padding: 20px;
    background-color: none !important;
    margin-top: 20px;
  }  
  
}
</style>
<main>
<div class="container mt-0">
  <div class="row">
    <div class="col-md-3"></div>
      <div class="bg-light form-out col-md-6">
      <h1>Login as Passenger</h1>
      
      <form method="POST" class=" text-center" 
        action="includes/login.inc.php">

        <div class="form-row">  
            <div class="col-1 p-0 mr-1">
                <i class="fa fa-user text-secondary" 
                    style="float: right;margin-top:35px;"></i>
            </div> 
          <div class="col-10 mb-2">              
            <div class="input-group">
                
                <input type="text"  placeholder="Username" name="user_id" id="user_id" required
                   >
              </div>              
          </div>       
          <div class="col-1 p-0 mr-1">
                <i class="fa fa-lock text-secondary" 
                    style="float: right;margin-top:35px;"></i>
          </div>                
          <div class="col-10">
            <div class="input-group">
               
                <input type="password"  placeholder="Password"  name="user_pass" id="user_pass"
                      required>
              </div>            
          </div> 

        </div>          
        <div class="row mt-3">
       
          <div class="col">
          <a id="reset-pass" class="mr-5" href="reset-pwd.php"
              style="float: right !important;">Reset Password</a>        
          </div>         
        </div>   
        <div class="row mt-4">
          <div class="col">
            <a href="register.php">
              <button type="button" class="btn btn-info mt-3">
                <div style="font-size: 1.5rem;">
                Register
                </div>
              </button>
            </a> 
          </div> 
          <div class="col">
            <button name="login_but" type="submit" 
              class="btn btn-success mt-3">
              <div style="font-size: 1.5rem;">
              Login
              </div>
            </button>
          </div>       
        </div>       
      
      </form>
    </div>
    <div class="col-md-3"></div>
    </div>
</div>  

<?php subview('footer.php'); ?> 
<script>
$(document).ready(function(){
  $('.input-group input').focus(function(){
    me = $(this) ;
    $("label[for='"+me.attr('id')+"']").addClass("animate-label");
  }) ;
  $('.input-group input').blur(function(){
    me = $(this) ;
    if ( me.val() == ""){
      $("label[for='"+me.attr('id')+"']").removeClass("animate-label");
    }
  }) ;
  
});
</script>
</main>

 <?php subview('footer.php'); ?> 
 