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
    .done(function(resp){
        console.log(resp.responseText);
    })
    .done(function(){
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
            $("span").text("Cliente guardado exitosamente");
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }
    })
    .done(function(resp){
        console.log(resp.responseText);
    })
    .done(function(){
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
            $("span").text("Administrador guardado exitosamente");
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }
    })
    .done(function(resp){
        console.log(resp.responseText);
    })
    .done(function(){
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
            $("span").text("Evento guardado exitosamente");
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }
    })
    .done(function(resp){
        console.log(resp.responseText);
    })
    .done(function(){
        console.log("complete");
    });
});