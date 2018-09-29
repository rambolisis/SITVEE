//Ajax para el mensaje de inicio de sesion redireccion de pagina por tipo de usuario
jQuery(document).on('submit','#formlg',function(event){
    event.preventDefault();
    $('#loading-screen').fadeIn();

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
                setTimeout("location.href = 'adminMenu.php'",1000);
            }else if(respuesta.tipo == 'Usuario'){
                setTimeout("location.href = 'userMenu.php'",1000);
            }
        }else{
            $('#loading-screen').fadeOut();
            setTimeout(function(){$('.error').slideDown('slow');},500);   
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
            $('.mensaje').css('background-color', '#388742');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
            setTimeout("location.href = 'adminMenu.php'",3000);
        }else{
            $("span").text("El nombre de usuario ya está en uso");
            $('.mensaje').css('background-color', '#E74F4F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }
        $('#frmNuevoCliente').trigger("reset");
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
            $('.mensaje').css('background-color', '#388742');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
            setTimeout("location.href = 'adminMenu.php'",3000);
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
            $('.mensaje').css('background-color', '#388742');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
            setTimeout("location.href = 'adminMenu.php'",3000);
        }else{
            $("span").text("El nombre de usuario ya está en uso");
            $('.mensaje').css('background-color', '#E74F4F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }
        $('#frmNuevoAdministrador').trigger("reset");
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
            $('.mensaje').css('background-color', '#388742');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
            setTimeout("location.href = 'adminMenu.php'",3000);
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
            $('.mensaje').css('background-color', '#388742');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
            setTimeout("location.href = 'adminMenu.php'",3000);
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
        url: 'InsertaStaff.php',
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
            $('.mensaje').css('background-color', '#388742');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
            setTimeout("location.href = 'adminMenu.php'",3000);
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
            $('.mensaje').css('background-color', '#388742');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
            setTimeout("location.href = 'adminMenu.php'",3000);
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

function salir() {
    setTimeout(function(){ $('#loading-screen').fadeIn(); },0);
    setTimeout("location.href = 'salir.php'",1000);
}

function session() {
    var t;
    window.onload = resetTimer;
    // DOM Events
    document.onmousemove = resetTimer;
    document.onkeypress = resetTimer;
    document.onload = resetTimer;
    document.onmousemove = resetTimer;
    document.onmousedown = resetTimer; 
    document.ontouchstart = resetTimer;
    document.onclick = resetTimer;     
    document.onscroll = resetTimer;
    document.onkeypress = resetTimer;

    function logout() {
        $("span").text("Se cerrará la sesión por inactividad");
            $('.mensaje').css('background-color', '#2F5EB7');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
            setTimeout(function(){ $('#loading-screen').fadeIn(); },3000);
            setTimeout("location.href = 'adminMenu.php'",5000);
    }

    function resetTimer() {
        clearTimeout(t);
        t = setTimeout(logout, 10000)
    };
}

//Listar
function listarCliente() {
    var cadena = document.getElementById("clienteId").value;
    var lista = cadena.split(",");
    var nombre = lista[1];
    var correo = lista[2];
    var usuario = lista[3];
    var clave = lista[4];
    if(cadena === "null"){
    document.getElementById("nombreNuevo").value = "";
    document.getElementById("correoNuevo").value = "";
    document.getElementById("usuarioNuevo").value = "";
    document.getElementById("contraseniaNueva").value = "";
    }else{
    document.getElementById("nombreNuevo").value = nombre;
    document.getElementById("correoNuevo").value = correo;
    document.getElementById("usuarioNuevo").value = usuario;
    document.getElementById("contraseniaNueva").value = clave;
    }
    
}
function listarEvento() {
    var cadena = document.getElementById("eventoId").value;
    var lista = cadena.split(",");
    var nombreEvento = lista[1];
    var fecha = lista[2];
    var descripcion = lista[3];
    var nombreCliente = lista[4];
    if(cadena === "null"){
    document.getElementById("nombreEventoNuevo").value = "";
    document.getElementById("fechaEventoNuevo").value = "";
    document.getElementById("descripcionEventoNuevo").value = "";
    document.getElementById("clienteEventoNuevo").value = "";
    }else{
    document.getElementById("nombreEventoNuevo").value = nombreEvento;
    document.getElementById("fechaEventoNuevo").value = fecha;
    document.getElementById("descripcionEventoNuevo").value = descripcion;
    document.getElementById("clienteEventoNuevo").value = nombreCliente;
    }
}
function listarStaff() {
    var cadena = document.getElementById("staffId").value;
    var lista = cadena.split(",");
    var usuario = lista[3];
    var clave = lista[4];
    if(cadena === "null"){
    document.getElementById("usuarioStaff").value = "";
    document.getElementById("contraseniaStaff").value = "";
    }else{
    document.getElementById("usuarioStaff").value = usuario;
    document.getElementById("contraseniaStaff").value = clave;
    }
}