$(document).ready(function() {
    $('#Home').click(function(evento) {
        $('#Inicio').show();
        $('#NuevoEvento').css("display" , "none");
        $('#NuevoCliente').css("display" , "none");
        $('#ActualizarEvento').css("display" , "none");
        $('#ActualizaraCliente').css("display" , "none");
        $('#Administrador').css("display" , "none");   
        $('#NuevoStaff').css("display" , "none");
        $('#ActualizarStaff').css("display" , "none");
    });
});
$(document).ready(function() {
    $('#NewEvent').click(function(evento) {
        $('#NuevoEvento').show();
        $('#Inicio').css("display" , "none");
        $('#NuevoCliente').css("display" , "none");
        $('#ActualizarEvento').css("display" , "none");
        $('#ActualizaraCliente').css("display" , "none");
        $('#Administrador').css("display" , "none");  
        $('#NuevoStaff').css("display" , "none"); 
        $('#ActualizarStaff').css("display" , "none");
    });
});
$(document).ready(function() {
    $('#NewStaff').click(function(evento) {
        $('#NuevoStaff').show();
        $('#Inicio').css("display" , "none");
        $('#NuevoCliente').css("display" , "none");
        $('#ActualizarEvento').css("display" , "none");
        $('#ActualizaraCliente').css("display" , "none");
        $('#Administrador').css("display" , "none");   
        $('#NuevoEvento').css("display" , "none");
        $('#ActualizarStaff').css("display" , "none");
    });
});
$(document).ready(function() {
    $('#UpdateStaff').click(function(evento) {
        $('#ActualizarStaff').show();
        $('#Inicio').css("display" , "none");
        $('#NuevoCliente').css("display" , "none");
        $('#ActualizarEvento').css("display" , "none");
        $('#ActualizaraCliente').css("display" , "none");
        $('#Administrador').css("display" , "none");   
        $('#NuevoEvento').css("display" , "none");
        $('#NuevoStaff').css("display" , "none"); 
    });
});
$(document).ready(function() {
    $('#NewClient').click(function(evento) {
        $('#NuevoCliente').show();
        $('#NuevoEvento').css("display" , "none");
        $('#Inicio').css("display" , "none");
        $('#ActualizarEvento').css("display" , "none");
        $('#ActualizaraCliente').css("display" , "none");
        $('#Administrador').css("display" , "none");   
        $('#NuevoStaff').css("display" , "none");
        $('#ActualizarStaff').css("display" , "none");
    });
});
$(document).ready(function() {
    $('#UpdateEvent').click(function(evento) {
        $('#ActualizarEvento').show();
        $('#NuevoEvento').css("display" , "none");
        $('#NuevoCliente').css("display" , "none");
        $('#Inicio').css("display" , "none");
        $('#ActualizaraCliente').css("display" , "none");
        $('#Administrador').css("display" , "none");   
        $('#NuevoStaff').css("display" , "none");
        $('#ActualizarStaff').css("display" , "none");
    });
});
$(document).ready(function() {
    $('#UpdateClient').click(function(evento) {
        $('#ActualizaraCliente').show();
        $('#NuevoEvento').css("display" , "none");
        $('#NuevoCliente').css("display" , "none");
        $('#ActualizarEvento').css("display" , "none");
        $('#Inicio').css("display" , "none");
        $('#Administrador').css("display" , "none");  
        $('#NuevoStaff').css("display" , "none"); 
        $('#ActualizarStaff').css("display" , "none");
    });
});
$(document).ready(function() {
    $('#Administrator').click(function(evento) {
        $('#Administrador').show();
        $('#NuevoEvento').css("display" , "none");
        $('#NuevoCliente').css("display" , "none");
        $('#ActualizarEvento').css("display" , "none");
        $('#ActualizaraCliente').css("display" , "none");
        $('#Inicio').css("display" , "none");   
        $('#NuevoStaff').css("display" , "none");
        $('#ActualizarStaff').css("display" , "none");
    });

});
function myFunction() {
    var x = document.getElementById("pass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}


