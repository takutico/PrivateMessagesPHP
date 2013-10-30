$(function() {
  
  
  /***** TBLUSUARIOS - START *****/
  $('#filtroUsuarios').hide();
  $('#showFiltros').click(function(){
    if($("#filtroUsuarios").is(':hidden')){
      $("#mensajeToUserAsunto").val('');
      $("#mensajeToUserMensaje").val('');
      $("#filtroUsuarios").show("slow");
    }else {
      $("#filtroUsuarios").hide("slow");
    }
  });
  
  
  // Envio de mensajes a usuarios
  $('#frmMensajeToUser').hide();
  $('.enviarMensaje').click(function(){
    $('#mensajeToUserTo').val($(this).attr('name'));
    $('#frmMensajeToUser').show();
  });
  
  
  // Si se inserta algo en el input se elimina el error
  $(".nombreModificarUsuario, .apellidosModificarUsuario, .nickModificarUsuario, .passModificarUsuario").bind('blur keyup', function(){  
    if ($(this).val() != "") {  			
      $(this).next('span').hide();
      return false;  
    }
  });
  
  
  //Accion que se realiza al pulsar el boton de modificar user
  $('#btnModificarUser').click(function(){
    
      var errorNombre   = false;
      var errorApellido = false;
      var errorNick     = false;
      var errorPass     = false;

      // Se comprueban que tengan datos, en el caso de no tener datos se muestra el mensaje de error
      if($('.nombreModificarUsuario').val() === ''){
        $('.nombreModificarUsuario').next('span').html('Ingrese un nombre');
        $('.nombreModificarUsuario').next('span').show();
        errorNombre = true;
      } else if($('.nombreModificarUsuario').val() !== ''){
        $('.nombreModificarUsuario').next('span').hide();
        errorNombre = false;
      }
      if($('.apellidosModificarUsuario').val() === ''){
        $('.apellidosModificarUsuario').next('span').html('Ingrese un apellido');
        $('.apellidosModificarUsuario').next('span').show();
        errorApellido = true;
      } else if($('.apellidosModificarUsuario').val() !== ''){
        $('.apellidosModificarUsuario').next('span').hide();
        errorApellido = false;
      }
      if($('.nickModificarUsuario').val() === ''){
        $('.nickModificarUsuario').next('span').html('Ingrese un nick');
        $('.nickModificarUsuario').next('span').show();
        errorNick = true;
      } else if($('.nickModificarUsuario').val() !== ''){
        $('.nickModificarUsuario').next('span').hide();
        errorNick = false;
      }
      if($('.passModificarUsuario').val() === ''){
        $('.passModificarUsuario').next('span').html('Ingrese un pass');
        $('.passModificarUsuario').next('span').show();
        errorPass = true;
      }  else if($('.passModificarUsuario').val() !== ''){
        $('.passModificarUsuario').next('span').hide();
        errorPass = false;
      }

      // Si no existen errores se hace el post para modificar los datos
      if(!errorNombre && !errorApellido && !errorNick && !errorPass){
        // Si ha llegado hasta aqui es que estan todos los datos correctos y se procede a la modificacion
        $.post("../controlador/funcionesUsuarios.php"
        ,{funcion:"modificarDatosUsuario"
          ,emailModificarUsuario :     $('#emailModificarUsuario').val()
          ,nombreModificarUsuario :    $('.nombreModificarUsuario').val()
          ,apellidosModificarUsuario : $('.apellidosModificarUsuario').val()
          ,nickModificarUsuario :      $('.nickModificarUsuario').val()
          ,passModificarUsuario :      $('.passModificarUsuario').val()
        }
        , function (data){
          $(data).insertAfter('#btnRM');
          
          // Se actualiza la tabla de usuarios
          $.post("../controlador/funcionesUsuarios.php"
            ,{funcion:"actualizarTabla"}
            , function (data2){
            $('#tblUsuarios').html(data2);
          });
        });
      }
    
  });
  
  
  // Inicialmente se oculta el formulario de modificacion de datos de usuario
  $('#modificarUser').hide();
  
  
  // Modificacion de datos de usuarios
  $('.modificarUsuario').click(function(){
    // Inicialmente se ocultan todos los errores
    $('.nombreModificarUsuario').next('span').hide();
    $('.apellidosModificarUsuario').next('span').hide();
    $('.nickModificarUsuario').next('span').hide();
    $('.passModificarUsuario').next('span').hide();

    // Se muestra el popup del formulario de modificacion de usuario
    $('#modificarUser').bPopup();       
    
    // Se hace el post
    $.post("../controlador/funcionesUsuarios.php"
      ,{funcion:"getDatosUsuario",idUsuario:$(this).attr('name')}
      , function (data){
        $('#emailModificarUsuario').val(data['email']);
        $('.nombreModificarUsuario').val(data['name']);
        $('.apellidosModificarUsuario').val(data['lastname']);
        $('.nickModificarUsuario').val(data['nick']);
        $('.passModificarUsuario').val(data['pass']);
    
      }, "json");
      $('#datosMensaje').show();
  });

  
  $('#btnCancelarModificarUser').click(function(){
    $('#emailModificarUsuario').val('');
    $('.nombreModificarUsuario').val('');
    $('.apellidosModificarUsuario').val('');
    $('.nickModificarUsuario').val('');
    $('.passModificarUsuario').val('');
    $('#modificarUser').hide();
  });
  /***** TBLUSUARIOS - END *****/
  
  
  /***** TBLMENSAJES - START *****/
  $('#filtroMensajes').show();
  $('#showFiltroMensajes').html('Ocultar filtro');
  $('#showFiltroMensajes').click(function(){
    if($("#filtroMensajes").is(':hidden')){
      $("#filtroMensajes").show("slow");
      $('#showFiltroMensajes').html('Ocultar filtro');
    }else {
      $("#filtroMensajes").hide("slow");
      $('#showFiltroMensajes').html('Mostrar filtro');
    }
  });

  
  // acciones sobre el panel de daatos de mensajes
  $('#datosMensaje').hide();

  $('.leerMensaje').click(function(){
    var de = $(this).attr('rel');
      $.post("../controlador/funcionesMensajes.php"
      ,{funcion:"getDatosMensajes",idMensaje:$(this).attr('name')}
      , function (data){
        $('#leerMensajeIdMensaje').val(data['idmessage']);
        $('#datosMensajeBtnResponder').attr('rel', data['idmessage']);
        $(".datosMensajeDe").val(data['msg_from']);
        $(".datosMensajeAsunto").val(data['msg_subject']);
        $(".datosMensajeMensaje").html(data['msg_body']);
        
        if(data['msg_from'] != de){
          $('#datosMensajeBtnResponder').show();
        } else{
          $('#datosMensajeBtnResponder').hide();
        }
      }, "json");
      
      $('#datosMensaje').show();
  });
  
  
  $('.eliminarMensaje').click(function(){
    var xx = '#'+$(this).attr('name');
    $.post("../controlador/funcionesMensajes.php"
          ,{funcion:"eliminarMensaje", idMensaje:$(this).attr('name'), email:$(this).attr('rel')}
          , function(data){
            //$('#tblMensajes').html(data);
            //$(this).prev('tr').hide();
            
            console.log(xx);
            $(xx).hide();
          });
  });
  
  
  // Se oculta el formulario de respuesta
  $('#respuestaMensaje').hide();
  
  
  $('#datosMensajeBtnResponder').click(function(){
    // Se carga el destinatario
    $('#respuestaMensajeBtn').attr('rel',$(this).attr('rel'));
    $('.respuestaMensajePara').val($(".datosMensajeDe").val());
    $('.respuestaMensajeAsunto').val('r:'+$(".datosMensajeAsunto").val());
    

    // Se borran los datos
    /*$('#idMensaje').val('');
    $(".datosMensajeDe").val('');
    $(".datosMensajeAsunto").val('');
    $(".datosMensajeMensaje").html('');
    $("#datosMensaje").hide();*/
    // Se muestra el formulario de contacto
    $('#respuestaMensaje').bPopup();
  });
  
  $('#respuestaMensajeBtn').click(function(){
    // Se comprueban los datos
    var errorAsunto   = false;
    var errorMensaje = false;

    // Se comprueban que tengan datos, en el caso de no tener datos se muestra el mensaje de error
    if($('.respuestaMensajeAsunto').val() === ''){
      $('.respuestaMensajeAsunto').next('span').html('Ingrese un asunto');
      $('.respuestaMensajeAsunto').next('span').show();
      errorAsunto = true;
    } else if($('.respuestaMensajeAsunto').val() !== ''){
      $('.respuestaMensajeAsunto').next('span').hide();
      errorAsunto = false;
    }
    if($('.respuestaMensajeMensaje').val() === ''){
      $('.respuestaMensajeMensaje').next('span').html('Ingrese un mensaje');
      $('.respuestaMensajeMensaje').next('span').show();
      errorMensaje = true;
    } else if($('.respuestaMensajeMensaje').val() !== ''){
      $('.respuestaMensajeMensaje').next('span').hide();
      errorMensaje = false;
    }

    // Si no existen errores se hace el post para modificar los datos
    if(!errorAsunto && !errorMensaje){
      // Si ha llegado hasta aqui es que estan todos los datos correctos y se procede a la modificacion
      $.post("../controlador/funcionesMensajes.php"
      ,{funcion:"responderMensaje"
        ,para :       $('.respuestaMensajePara').val()
        ,asunto :     $('.respuestaMensajeAsunto').val()
        ,mensaje :    $('.respuestaMensajeMensaje').val()
        ,idMensaje :  $(this).attr('rel')
        ,desde :      $(this).attr('name')
      }
      , function (data){
        //$(data).insertAfter('#btn');
        $('#respuestaMensaje').bPopup().close();
        // Se actualiza la tabla de mensajes, pero no se sabe si estamos en mensaje
        /*$.post("../controlador/funcionesMensajes.php"
          ,{funcion:"actualizarTabla"}
          , function (data2){
          $('#tblMensajes').html(data2);
        });*/
      });
    }
    
  });
  
  
  // Al pulsar el boton cancelar se borran los datos y se
  $('#datosMensajeBtnCancelar').click(function(){
    $('#idMensaje').val('');
    $(".datosMensajeDe").val('');
    $(".datosMensajeAsunto").val('');
    $(".datosMensajeMensaje").html('');
    $("#datosMensaje").hide("slow");
    // Se borran los datos del formulario de envio
    $(".contacto").hide();
  });
  /***** TBLMENSAJES - END *****/
  
  
  /***** PASS - START *****/
  $("#newPass").hide();
  
  
  // cuando se pincha en el link "Nuevo Mensaje" se muestra el formulario
  $("#menuCambiarPass").click(function(){
    if($("#newPass").is(':hidden'))
      $("#newPass").show();
    else
      $("#newPass").hide();
  });
  
  
  // Accion que se realiza tras pulsar el boton de envio
  $("#btnChangePass").click(function(){  
    $(".error").fadeOut().remove();

    if ($("#txtNewPass").val() === "") {  
      $("#txtNewPass").focus().after('<span class="error">Ingrese el nuevo pass</span>');  
      return false;  
    }    
  });
  
  
  // evento para cuando se pierde el foco (blur) o cuando se termina de pulsar una tecla (keyup)
  $("#txtNewPass").bind('blur keyup', function(){  
    if ($(this).val() != "") {  			
      $('.error').fadeOut();
      return false;  
    }
  });
  /****** PASS - END *******/
  
  
  /****** USER - START *******/
  $('#frmNewUser').hide();
  $("#menuNuevoUsurio").click(function(){
    $('#frmNewUser').bPopup();
  });
  $(".nombreUsuario, .apellidosUsuario, .emailUsuario, .nickUsuario, .passUsuario").bind('blur keyup', function(){  
    if ($(this).val() != "") {  			
      $(this).next('span').hide();
      return false;  
    }
  });


  // Accion que se realiza tras pulsar el boton de nuevo suaurio
  $('#btnNewUser').click(function(){
      var errorNombre   = false;
      var errorApellido = false;
      var errorEmail = false;
      var errorNick     = false;
      var errorPass     = false;

      // Se comprueban que tengan datos, en el caso de no tener datos se muestra el mensaje de error
      if($('.nombreUsuario').val() === ''){
        $('.nombreUsuario').next('span').html('Ingrese un nombre');
        $('.nombreUsuario').next('span').show();
        errorNombre = true;
      } else if($('.nombreUsuario').val() !== ''){
        $('.nombreUsuario').next('span').hide();
        errorNombre = false;
      }
      if($('.apellidosUsuario').val() === ''){
        $('.apellidosUsuario').next('span').html('Ingrese un apellido');
        $('.apellidosUsuario').next('span').show();
        errorApellido = true;
      } else if($('.apellidosUsuario').val() !== ''){
        $('.apellidosUsuario').next('span').hide();
        errorApellido = false;
      }
      // expresion regurar para el email
      //var emailreg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; !emailreg.test($(".email").val())
      if($('.emailUsuario').val() === ''){
        $('.emailUsuario').next('span').html('Revise el formato del email');
        $('.emailUsuario').next('span').show();
        errorEmail = true;
      } else if($('.emailUsuario').val() !== ''){
        $('.emailUsuario').next('span').hide();
        errorEmail = false;
      }
      if($('.nickUsuario').val() === ''){
        $('.nickUsuario').next('span').html('Ingrese un nick');
        $('.nickUsuario').next('span').show();
        errorNick = true;
      } else if($('.nickUsuario').val() !== ''){
        $('.nickUsuario').next('span').hide();
        errorNick = false;
      }
      if($('.passUsuario').val() === ''){
        $('.passUsuario').next('span').html('Ingrese un pass');
        $('.passUsuario').next('span').show();
        errorPass = true;
      }  else if($('.passUsuario').val() !== ''){
        $('.passUsuario').next('span').hide();
        errorPass = false;
      }

      // Si no existen errores se hace el post para modificar los datos
      if(!errorNombre && !errorApellido && !errorEmail && !errorNick && !errorPass){
        // Si ha llegado hasta aqui es que estan todos los datos correctos y se procede a la modificacion
        $.post("../controlador/funcionesUsuarios.php"
        ,{funcion:"insertNewUser"
          ,nombreUsuario :    $('.nombreUsuario').val()
          ,apellidosUsuario : $('.apellidosUsuario').val()
          ,emailUsuario :     $('.emailUsuario').val()
          ,nickUsuario :      $('.nickUsuario').val()
          ,passUsuario :      $('.passUsuario').val()
        }
        , function (data){
          $(data).insertAfter('#btn');
        });
      }
  });
  
  /****** USER - END *******/
  
  // inicialmente no se muestra el formulario
  $(".contacto").hide();
  
  
  // cuando se pincha en el link "Nuevo Mensaje" se muestra el formulario
  $("#nuevoMensaje").click(function(){
    if($(".contacto").is(':hidden'))
      //$(".contacto").show();
      $(".contacto").bPopup();
    else
      $(".contacto").hide();
    
    $(".result_ok").hide();
    $(".result_fail").hide();
  });	
  
  
  // Accion que se realiza tras pulsar el boton de envio
  $(".boton").click(function(){  
    $(".error").fadeOut().remove();

    if ($(".asunto").val() == "") {  
      $(".asunto").focus().after('<span class="error">Ingrese un asunto</span>');  
      return false;  
    }  
    if ($(".mensaje").val() == "") {  
      $(".mensaje").focus().after('<span class="error">Ingrese un mensaje</span>');   
      return false;  
    }  
  });
  
  
  // evento para cuando se pierde el foco (blur) o cuando se termina de pulsar una tecla (keyup)
  $(".asunto, .mensaje").bind('blur keyup', function(){  
    if ($(this).val() != "") {  			
      $('.error').fadeOut();
      return false;  
    }
  });
  
  
});
