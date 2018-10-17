//Ajax para el mensaje de inicio de sesion redireccion de pagina por tipo de usuario
jQuery(document).on('submit','#formlg',function(event){
    event.preventDefault();
    $('#loading-screen').fadeIn();

    jQuery.ajax({
        url: 'consultar/loginConsulta.php',
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
        url: 'insertar/insertaCliente.php',
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
            $("#mensaje").text("Cliente guardado exitosamente");
            $('.mensaje').css('background-color', '#388742');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
            setTimeout("location.href = 'adminMenu.php'",3000);
        }else{
            $("#mensaje").text("El nombre de usuario ya está en uso");
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
    bootbox.confirm({
        message: "Desea actualizar el cliente definitivamente?",
        buttons: {
            confirm: {
                label: 'Si',
                className: 'btn-success',
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (resultado) {
            if(resultado == true){
                jQuery.ajax({
                    url: 'actualizar/actualizaCliente.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#frmActualizaCliente').serialize(),
                    beforeSend: function(){           
                    }
                })
                .done(function(respuesta){
                    console.log(respuesta);
                    if(!respuesta.mensaje){
                        $("#mensaje").text("Cliente actualizado exitosamente");
                        $('.mensaje').css('background-color', '#388742');
                        $('.mensaje').slideDown('slow');
                        setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
                        setTimeout("location.href = 'adminMenu.php'",3000);
                    }else{
                        $("#mensaje").text("Porfavor seleccione un cliente");
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
            }else{

            }
        }
    });
});


//Ajax para el mensaje de crear administrador
jQuery(document).on('submit','#frmNuevoAdministrador',function(event){
    event.preventDefault();

    jQuery.ajax({
        url: 'insertar/insertaAdministrador.php',
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
            $("#mensaje").text("Administrador guardado exitosamente");
            $('.mensaje').css('background-color', '#388742');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
            setTimeout("location.href = 'adminMenu.php'",3000);
        }else{
            $("#mensaje").text("El nombre de usuario ya está en uso");
            $('.mensaje').css('background-color', '#E74F4F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }
        $("#ajaxStart").attr("disabled", false);
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
        url: 'insertar/insertaEvento.php',
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
            $("#mensaje").text("Evento guardado exitosamente");
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
    bootbox.confirm({
        message: "Desea actualizar el evento definitivamente?",
        buttons: {
            confirm: {
                label: 'Si',
                className: 'btn-success',
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (resultado) {
            if(resultado == true){
                jQuery.ajax({
                    url: 'actualizar/actualizaEvento.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#frmActualizaEvento').serialize(),
                    beforeSend: function(){           
                    }
                })
                .done(function(respuesta){
                    console.log(respuesta);
                    if(!respuesta.mensaje){
                        $("#mensaje").text("Evento actualizado exitosamente");
                        $('.mensaje').css('background-color', '#388742');
                        $('.mensaje').slideDown('slow');
                        setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
                        setTimeout("location.href = 'adminMenu.php'",3000);
                    }else{
                        $("#mensaje").text("Porfavor seleccione un evento");
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
            }else{

            }
        }
    });
});

//Ajax para el mensaje de actualizar evento desde cliente
jQuery(document).on('submit','#frmInfoEvento',function(event){
    event.preventDefault();
    var id = $('#idInfoEvento').text();

    jQuery.ajax({
        url: 'actualizar/actualizaEvento.php?idInfoEvento='+id,
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){           
        }
    })
    .done(function(respuesta){
        console.log(respuesta);
        if(!respuesta.mensaje){
            $("#mensaje").text("Evento actualizado exitosamente");
            $('.mensaje').css('background-color', '#388742');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
            setTimeout("location.href = 'userMenu.php'",3000);
        }else{
            $("#mensaje").text("Error al actualizar el evento");
            $('.mensaje').css('background-color', '#E74F4F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }
        $('#nombreInfoEvento').attr("disabled", true);
        $('#fechaInfoEvento').attr("disabled", true);
        $('#descripcionInfoEvento').attr("disabled", true);
        $('#lugarInfoEvento').attr("disabled", true);
        $('#btnGuardar').attr("disabled", true);
    })
    .fail(function(resp){
        console.log(resp.responseText);
    })
    .always(function(){
        console.log("complete");
    });
});

//Ajax para el mensaje de actualizar perfil
jQuery(document).on('submit','#frmPerfil',function(event){
    event.preventDefault();
    var id = $('#idPerfilCliente').text();

    jQuery.ajax({
        url: 'actualizar/actualizaCliente.php?idPerfilCliente='+id,
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){           
        }
    })
    .done(function(respuesta){
        console.log(respuesta);
        if(!respuesta.mensaje){
            $("#mensaje").text("Perfil actualizado exitosamente");
            $('.mensaje').css('background-color', '#388742');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
            setTimeout("location.href = 'userMenu.php'",3000);
        }else{
            $("#mensaje").text("Error al actualizar el perfil");
            $('.mensaje').css('background-color', '#E74F4F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }
        $('#nombreClientePerfil').attr("disabled", true);
        $('#correoClientePerfil').attr("disabled", true);
        $('#usuarioClientePerfil').attr("disabled", true);
        $('#contraseniaClientePerfil').attr("disabled", true);
        $('#btnGuardarPerfil').attr("disabled", true);
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
        url: 'insertar/InsertaStaff.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){           
        }
    })
    .done(function(respuesta){
        console.log(respuesta);
        if(!respuesta.mensaje){
            $("#mensaje").text("Staff guardado exitosamente");
            $('.mensaje').css('background-color', '#388742');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
            setTimeout("location.href = 'adminMenu.php'",3000);
        }else{
            $("#mensaje").text("El evento seleccionado ya esta siendo utilizado por otro staff");
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
    bootbox.confirm({
        message: "Desea actualizar el staff definitivamente?",
        buttons: {
            confirm: {
                label: 'Si',
                className: 'btn-success',
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (resultado) {
            if(resultado == true){
                jQuery.ajax({
                    url: 'actualizar/actualizaStaff.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#frmActualizaStaff').serialize(),
                    beforeSend: function(){           
                    }
                })
                .done(function(respuesta){
                    console.log(respuesta);
                    if(!respuesta.mensaje){
                        $("#mensaje").text("Staff actualizado exitosamente");
                        $('.mensaje').css('background-color', '#388742');
                        $('.mensaje').slideDown('slow');
                        setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
                        setTimeout("location.href = 'adminMenu.php'",3000);
                    }else{
                        $("#mensaje").text("Porfavor seleccione un evento");
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
            }else{

            }
        }
    });
});

function salir() {
    setTimeout(function(){ $('#loading-screen').fadeIn(); },0);
    setTimeout("location.href = 'salir.php'",1000);
}

function reporteInvitacionPDF() {
    var idCliente = $('#idInfoCliente').text();
    var idEvento = $('#idInfoEvento').text();
    location.href="pdf.php?idInfoCliente="+idCliente+"&&idInfoEvento="+idEvento;
            $("#mensaje").text("Reporte generado exitosamente");
            $('.mensaje').css('background-color', '#388742');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);    
}

function reporteInformeEventoPDF() {
    var idCliente = $('#idInfoCliente').text();
    var idEvento = $('#idInfoEvento').text();
    location.href="pdfInforme.php?idInfoCliente="+idCliente+"&&idInfoEvento="+idEvento;
            $("#mensaje").text("Reporte generado exitosamente");
            $('.mensaje').css('background-color', '#388742');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);    
}

//Ajax para el enviar mensaje solicitud evento
jQuery(document).on('submit','#frmSolicitudEvento',function(event){
    event.preventDefault();

    jQuery.ajax({
        url: '../solicitarEvento.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){           
        }
    })
    .done(function(respuesta){
        console.log(respuesta);
    })
    .fail(function(resp){
        console.log(resp.responseText);
        $("#mensaje").text("Error de la solicitud");
        $('.mensaje').css('background-color', '#E74F4F');
        $('.mensaje').slideDown('slow');
        setTimeout(function(){
            $('.mensaje').slideUp('slow');
        },3000);
        $('#frmSolicitudEvento').trigger("reset");
    })
    .always(function(){
        $("#mensaje").text("Solicitud de evento enviada");
        $('.mensaje').css('background-color', '#2F5EB7');
        $('.mensaje').slideDown('slow');
        setTimeout(function(){
            $('.mensaje').slideUp('slow');
        },3000);
        $('#frmSolicitudEvento').trigger("reset");
    });
});

//Ajax para el enviar mensaje solicitud de cuenta
jQuery(document).on('submit','#frmSolicitudCuenta',function(event){
    event.preventDefault();

    jQuery.ajax({
        url: '../solicitarCuenta.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){           
        }
    })
    .done(function(respuesta){
        console.log(respuesta);
    })
    .fail(function(resp){
        console.log(resp.responseText);
        $("#mensaje").text("Error de la solicitud");
        $('.mensaje').css('background-color', '#E74F4F');
        $('.mensaje').slideDown('slow');
        setTimeout(function(){
            $('.mensaje').slideUp('slow');
        },3000);
        $('#frmSolicitudCuenta').trigger("reset");
    })
    .always(function(){
        $("#mensaje").text("Solicitud de cuenta enviada");
        $('.mensaje').css('background-color', '#2F5EB7');
        $('.mensaje').slideDown('slow');
        $('#frmSolicitudCuenta').trigger("reset");
        setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
        setTimeout("location.href = 'index.php'",3000);
    });
});

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
        $("#mensaje").text("Se cerrará la sesión por inactividad");
            $('.mensaje').css('background-color', '#2F5EB7');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
            setTimeout(function(){ $('#loading-screen').fadeIn(); },3000);
            setTimeout("location.href = 'adminMenu.php'",5000);
    }

    function resetTimer() {
        clearTimeout(t);
        t = setTimeout(logout, 600000)
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
    var lugar = lista[4];
    var nombreCliente = lista[5];
    if(cadena === "null"){
    document.getElementById("nombreEventoNuevo").value = "";
    document.getElementById("fechaEventoNuevo").value = "";
    document.getElementById("descripcionEventoNuevo").value = "";
    document.getElementById("lugarEventoNuevo").value = "";
    document.getElementById("clienteEventoNuevo").value = "";
    }else{
    document.getElementById("nombreEventoNuevo").value = nombreEvento;
    document.getElementById("fechaEventoNuevo").value = fecha;
    document.getElementById("descripcionEventoNuevo").value = descripcion;
    document.getElementById("lugarEventoNuevo").value = lugar;
    document.getElementById("clienteEventoNuevo").value = nombreCliente;
    }
}
function listarEventoGestion(array) {
    var lista = array.split(",");
    var idEvento = lista[0];
    var nombreEvento = lista[1];
    var fecha = lista[2];
    var descripcion = lista[3];
    var lugar = lista[4];
    var estado = lista[5];
    if(array === "null"){
        document.getElementById("nombreInfoEvento").value = "";
        document.getElementById("fechaInfoEvento").value = "";
        document.getElementById("descripcionInfoEvento").value = "";
        document.getElementById("lugarInfoEvento").value = "";
    }else{
        document.getElementById("idInfoEvento").innerHTML = idEvento;
        document.getElementById("nombreInfoEvento").value = nombreEvento;
        document.getElementById("fechaInfoEvento").value = fecha;
        document.getElementById("descripcionInfoEvento").value = descripcion;
        document.getElementById("lugarInfoEvento").value = lugar;
        document.getElementById("estado").innerHTML = estado;
    }

    if(estado == "Finalizado"){
        document.getElementById('btnGuardar').style.display = 'none';
        document.getElementById('btnEditar').style.display = 'none';
    }else{
        document.getElementById('btnGuardar').style.display = 'inline';
        document.getElementById('btnEditar').style.display = 'inline';
    }
}
function listarPerfil() {
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

function editarBoton(){
    document.getElementById("btnGuardar").disabled = false;
    document.getElementById("nombreInfoEvento").disabled = false;
    document.getElementById("lugarInfoEvento").disabled = false;
    document.getElementById("fechaInfoEvento").disabled = false;
    document.getElementById("descripcionInfoEvento").disabled = false;
}

function editarBotonPerfil(){
    document.getElementById("btnGuardarPerfil").disabled = false;
    document.getElementById("nombreClientePerfil").disabled = false;
    document.getElementById("contraseniaClientePerfil").disabled = false;
    document.getElementById("usuarioClientePerfil").disabled = false;
    document.getElementById("correoClientePerfil").disabled = false;
}