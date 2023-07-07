
<?php
if(isset($_GET['pwd'])) {
    if($_GET['pwd']=='updated') {
        echo "<script>alert('Your password has been reset!!');</script>";
    }
}
?>

<style>
 

body {
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 16px;
  height: 100vh;
  width: 100%;
  background-color: #fff;
}





.login{
  width: 100%;
  display: grid;
  grid-gap: 15px;
  padding: 35px;
  border-radius: 12px;
  box-shadow: 0 0 25px rgba(0, 0, 0, 0.06);
}
.login__icon {
  font-size: 1.125rem;
  font-weight: bold;
  letter-spacing: -0.025rem;
  line-height: 1;
}
.login__title {
  margin-bottom: 17.5px;
  font-size: 1.424rem;
  font-weight: bold;
  letter-spacing: -0.075rem;
  line-height: 1;
}
.login__title::first-letter{
  text-transform: capitalize;
}
.login__row{
  display: grid;
  grid-gap: 8px;
}
.login__label{
  
  font-size: 0.79rem;
  font-weight: bold;
  text-transform: capitalize;
}
.login__input, .login__button{
  height: 40px;
  font-size: 0.79rem;
  border-radius: 8px;
  cursor: pointer;
}
.login__input{
  padding: 0 17.5px;
  background-color: transparent;
}
.login__button{
  height: 45px;
  font-size: 0.702rem;
  letter-spacing: 0.075rem;
  font-weight: bold;
  text-transform: uppercase;
}
.login__link{
  font-size: 0.702rem;
  text-align: center;
  cursor: pointer;
}
.login__link::first-letter{
  text-transform: capitalize;
}

.login {
  background-color: #ffffff;
}
.login__icon {
  color: #3f66ff;
}
.login__title {
  color: #000;
}
.login__label {
  color: #000;
}
.login__input, .login__button {
  border: 1px solid #000;
  outline-color: #3f66ff;
}
.login__input {
  color: #625a85;
  caret-color: #3f66ff;
}
.login__input::placeholder {
  color: #9791b4;
}
.login__button {
  background-color: #000;
  color: #ffffff;
}
.login__link {
  color: #b4afc9;
}

</style>
<main>
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
?>

    <?php
    if(isset($_GET['error'])) {
        if($_GET['error'] === 'destless') {
            echo "<script>alert('Dest. date/time is less than src.');</script>";
        } else if($_GET['error'] === 'sqlerr') {
          echo "<script>alert('Database error');</script>";
        }
    }
    ?>
    
   
      
      <form class="login form" method="POST"  
        action="../includes/admin/login.inc.php">
        <h2 class="login__title">Login as Admin</h2>
        <div class="login__row">
                <label class="login__label" for="user_id">Username/ Email</label>
                <input class="login__input" type="text" name="user_id" id="user_id" required >
        </div>

              <div class="login__row">
                <label class="login__label" for="user_pass">Password</label>
                <input  class="login__input" type="password" name="user_pass" id="user_pass"
                      required>
              </div>
                       
              <div class="login__row">
        <button class="login__button" name="login_but" type="submit">
          Login
        </button>
        </div>
      </form>
    
   
<?php include_once 'footer.php'; ?>

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
