<div id="modificarUser" class="form">
  <div><label>Email:</label>
    <input type='text' id='emailModificarUsuario' name='emailModificarUsuario'value='<?php echo $_POST['emailModificarUsuario']; ?>' readonly="true">
    <span class="error" hidden="true"></span>
  </div>
  <div><label>Nombre:</label>
    <input type='text' class='nombreModificarUsuario' name='nombreModificarUsuario' value='<?php echo $_POST['nombreModificarUsuario']; ?>'>
    <span class="error" hidden="true"></span>
  </div>
  <div><label>Apellidos:</label>
    <input type='text' class='apellidosModificarUsuario' name='apellidosModificarUsuario'value='<?php echo $_POST['apellidosModificarUsuario']; ?>'>
    <span class="error" hidden="true"></span>
  </div>
  <div><label>Nick:</label>
    <input type='text' class='nickModificarUsuario' name='nickModificarUsuario'value='<?php echo $_POST['nickModificarUsuario']; ?>'>
    <span class="error" hidden="true"></span>
  </div>
  <div><label>Pass:</label>
    <input type='text' class='passModificarUsuario' name='passModificarUsuario'value='<?php echo $_POST['passModificarUsuario']; ?>'>
    <span class="error" hidden="true"></span>
  </div>
  <div id="btn">
    <input type='submit' value='Modificar Usuario' class='btnModificarUser' id="btnModificarUser" name='btnModificarUser'>
  </div>
</div>
