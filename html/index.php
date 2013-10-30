<?php include_once './common/header.inc.php';?>

<div align="center">
  <form name="login_user" action="login.php" method="post" class="loginform">
    <label>Email:</label>
    <input type='text' name='email' /><br /><br />

    <label>Password:</label>
    <input type="password" name='pass' /><br /><br />

    <input type="submit" name="login" style="width:100px;" tabindex="6" value="Entrar" />
  </form>
</div>

<?php include_once './common/footer.inc.php';?>

<style type="text/css">
/***** login - START *****/
*{
	font-family: sans-serif;
	font-size: 12px;
	color: #798e94;
}
  /*Form para el login que se situe en el centro de la pantalla*/
.loginform{
  border: 1px solid #CED5D7;
  border-radius: 6px;
  padding: 20px 20px 20px 20px;
  margin: 10px 0 10px 0;
  background-color: white;
  box-shadow: 0px 5px 10px #B5C1C5, 0 0 0 10px #EEF5F7 inset;
  width: 400px;
  height: 200px;
  margin-top: 100px;
}

.loginform label{
	display: block; 
	font-weight: bold;
}
.loginform div{
	margin-bottom: 0px;
}
.loginform input[type='text'], .loginform input[type='password']{
	padding: 7px 6px;
	width: 294px;
	border: 1px solid #CED5D7;
	resize: none;
	box-shadow:0 0 0 3px #EEF5F7;
	margin: 5px 0;
}
.loginform input[type='submit']{
	border: 1px solid #CED5D7;
	box-shadow:0 0 0 3px #EEF5F7;
	padding: 8px 16px;
	border-radius: 20px;
	font-weight: bold;
	text-shadow: 1px 1px 0px white;
	cursor: pointer;
	background: #e4f1f6; 
	background: -moz-linear-gradient(top, #e4f1f6 0%, #cfe6ef 100%);
	background: -webkit-linear-gradient(top, #e4f1f6 0%,#cfe6ef 100%); 
}
  /***** login - END *****/
</style>