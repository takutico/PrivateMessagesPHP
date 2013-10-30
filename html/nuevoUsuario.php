<div id='frmNewUser' class="form">
  <div><label>Nombre:</label>
    <input type='text' class='nombreUsuario' name='nombreUsuario' value='<?php echo $_POST['nombreUsuario']; ?>'>
    <span class="error" hidden="true"></span>
  </div>
  <div><label>Apellidos:</label>
    <input type='text' class='apellidosUsuario' name='apellidosUsuario'value='<?php echo $_POST['apellidosUsuario']; ?>'>
    <span class="error" hidden="true"></span>
  </div>
  <div><label>Email:</label>
    <input type='text' class='emailUsuario' name='emailUsuario'value='<?php echo $_POST['emailUsuario']; ?>'>
    <span class="error" hidden="true"></span>
  </div>
  <div><label>Nick:</label>
    <input type='text' class='nickUsuario' name='nickUsuario'value='<?php echo $_POST['nickUsuario']; ?>'>
    <span class="error" hidden="true"></span>
  </div>
  <div><label>Pass:</label>
    <input type='text' class='passUsuario' name='passUsuario'value='<?php echo $_POST['passUsuario']; ?>'>
    <span class="error" hidden="true"></span>
  </div>
  <div id="btn"><input type='submit' value='Nuevo Usuario' class='btnNewUser' id="btnNewUser" name='btnNewUser'></div>
</div>
