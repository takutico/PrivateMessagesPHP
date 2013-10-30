$(function() {
  
  
  // inicialmente no se muestra el formulario
  $("#newPass").hide();
  
  
  // cuando se pincha en el link "Nuevo Mensaje" se muestra el formulario
  $("#menuCambiarPass").click(function(){
    if($("#newPass").is(':hidden'))
      $("#newPass").show();
    else
      $("#newPass").hide();
    
    //$(".result_ok").hide();
    //$(".result_fail").hide();
  });	
  
  
  // Accion que se realiza tras pulsar el boton de envio
  $("#btnChangePass").click(function(){  
    $(".error").fadeOut().remove();

    if ($("#txtNewPass").val() == "") {  
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
  
  
});


// expresion regurar para el email
  /*var emailreg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  $(".email").bind('blur keyup', function(){  
    if ($(".email").val() != "" && emailreg.test($(".email").val())) {	
      $('.error').fadeOut();  
      return false;  
    }  
  });*/