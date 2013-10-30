<!-- CHANGE PASS - START -->
<?php
  if(isset($_POST['txtNewPass'])){
    if($_POST['txtNewPass'] == ''){
      $error1 = '<span class="error">Ingrese un pass</span>';
    }else{
      include_once '../controlador/UserController.php';
      $userControler = UserController::getInstance();
      
      if($userControler->changePass()){
        $result = '<div class="changePass_ok">Pass cambiaro correctamente :)</div>';
        // si el envio fue exitoso reseteamos lo que el usuario escribio:
        $_POST['txtNewPass'] = '';
      } else{
        $result = '<div class="changePass_error">Hubo un error al intentar cambiar el pass :(</div>';
      }
    }
  }
?>
<div id="newPass">
  <form class='frmNewPass' method='POST' action=''>
    <div style="margin-bottom: 15px;"><label>Nuevo Pass:</label>
      <input type='text' class='txtNewPass' id="txtNewPass" name='txtNewPass' value='<?php echo $_POST['txtNewPass']; ?>'><?php echo $error1 ?>
    </div>
    <div><input type='submit' value='Cambiar Pass' id="btnChangePass"></div>
    <?php echo $result; ?>
  </form>
</div>

<!-- CHANGE PASS - END -->
