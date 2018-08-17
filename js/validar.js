//Ajax para el mensaje de inicio de sesion redireccion de pagina por tipo de usuario
jQuery(document).on('submit','#formlg',function(event){
    event.preventDefault();

    jQuery.ajax({
        url: 'loginConsulta.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){           
        }
    })
    .done(function(respuesta){
        console.log(respuesta);
        if(!respuesta.error){
            if(respuesta.tipo == 'Administrador'){
                location.href = 'adminMenu.php';
            }else if(respuesta.tipo == 'Usuario'){
                location.href = 'userMenu.php';
            }
        }else{
            $('.error').slideDown('slow');
        }
    })
    .fail(function(resp){
        console.log(resp.responseText);
    })
    .always(function(){
        console.log("complete");
    });
});

//Ajax para el mensaje de crear cliente
jQuery(document).on('submit','#frmNuevoCliente',function(event){
    event.preventDefault();

    jQuery.ajax({
        url: 'insertaCliente.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){           
        }
    })
    .done(function(respuesta){
        console.log(respuesta);
        if(!respuesta.mensaje){
            $('#frmNuevoCliente').trigger("reset");
            $("span").text("Cliente guardado exitosamente");
            $('.mensaje').css('background-color', '#14BD2F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }
    })
    .fail(function(resp){
        console.log(resp.responseText);
    })
    .always(function(){
        console.log("complete");
    });
});

//Ajax para el mensaje de actualizar cliente
jQuery(document).on('submit','#frmActualizaCliente',function(event){
    event.preventDefault();

    jQuery.ajax({
        url: 'actualizaCliente.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){           
        }
    })
    .done(function(respuesta){
        console.log(respuesta);
        if(!respuesta.mensaje){
            $("span").text("Cliente actualizado exitosamente");
            $('.mensaje').css('background-color', '#14BD2F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
            setTimeout("location.href = 'adminMenu.php'",100);
        }else{
            $("span").text("Porfavor seleccione un cliente");
            $('.mensaje').css('background-color', '#E74F4F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }
        $('#frmActualizaCliente').trigger("reset");
    })
    .fail(function(resp){
        console.log(resp.responseText);
    })
    .always(function(){
        console.log("complete");
    });
});


//Ajax para el mensaje de crear administrador
jQuery(document).on('submit','#frmNuevoAdministrador',function(event){
    event.preventDefault();

    jQuery.ajax({
        url: 'insertaAdministrador.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){           
        }
    })
    .done(function(respuesta){
        console.log(respuesta);
        if(!respuesta.mensaje){
            $('#frmNuevoAdministrador').trigger("reset");
            $("span").text("Administrador guardado exitosamente");
            $('.mensaje').css('background-color', '#14BD2F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }
    })
    .fail(function(resp){
        console.log(resp.responseText);
    })
    .always(function(){
        console.log("complete");
    });
});

//Ajax para el mensaje de crear el evento
jQuery(document).on('submit','#frmNuevoEvento',function(event){
    event.preventDefault();

    jQuery.ajax({
        url: 'insertaEvento.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){           
        }
    })
    .done(function(respuesta){
        console.log(respuesta);
        if(!respuesta.mensaje){
            $('#frmNuevoEvento').trigger("reset");
            $("span").text("Evento guardado exitosamente");
            $('.mensaje').css('background-color', '#14BD2F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }
    })
    .fail(function(resp){
        console.log(resp.responseText);
    })
    .always(function(){
        console.log("complete");
    });
});

//Ajax para el mensaje de actualizar evento
jQuery(document).on('submit','#frmActualizaEvento',function(event){
    event.preventDefault();

    jQuery.ajax({
        url: 'actualizaEvento.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){           
        }
    })
    .done(function(respuesta){
        console.log(respuesta);
        if(!respuesta.mensaje){
            $("span").text("Evento actualizado exitosamente");
            $('.mensaje').css('background-color', '#14BD2F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }else{
            $("span").text("Porfavor seleccione un evento");
            $('.mensaje').css('background-color', '#E74F4F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }
        $('#frmActualizaEvento').trigger("reset");
    })
    .fail(function(resp){
        console.log(resp.responseText);
    })
    .always(function(){
        console.log("complete");
    });
});

//Ajax para el mensaje de crear staff
jQuery(document).on('submit','#frmNuevoStaff',function(event){
    event.preventDefault();

    jQuery.ajax({
        url: 'insertaStaff.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){           
        }
    })
    .done(function(respuesta){
        console.log(respuesta);
        if(!respuesta.mensaje){
            $("span").text("Staff guardado exitosamente");
            $('.mensaje').css('background-color', '#14BD2F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }else{
            $("span").text("El evento seleccionado ya esta siendo utilizado por otro staff");
            $('.mensaje').css('background-color', '#E74F4F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }
        $('#frmNuevoStaff').trigger("reset");
    })
    .fail(function(resp){
        console.log(resp.responseText);
    })
    .always(function(){
        console.log("complete");
    });
});

//Ajax para el mensaje de actualizar staff
jQuery(document).on('submit','#frmActualizaStaff',function(event){
    event.preventDefault();

    jQuery.ajax({
        url: 'actualizaStaff.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){           
        }
    })
    .done(function(respuesta){
        console.log(respuesta);
        if(!respuesta.mensaje){
            $("span").text("Staff actualizado exitosamente");
            $('.mensaje').css('background-color', '#14BD2F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000); 
        }else{
            $("span").text("Porfavor seleccione un evento");
            $('.mensaje').css('background-color', '#E74F4F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }
        $('#frmActualizaStaff').trigger("reset");
    })
    .fail(function(resp){
        console.log(resp.responseText);
    })
    .always(function(){
        console.log("complete");
    });
});