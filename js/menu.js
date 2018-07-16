$(document).ready(function() {
    $('#Home').click(function(evento) {
        $('#Inicio').show();
        $('#NuevoEvento').css("display" , "none");
        $('#NuevoCliente').css("display" , "none");
        $('#ActualizarEvento').css("display" , "none");
        $('#ActualizarCliente').css("display" , "none");
        $('#Administrador').css("display" , "none");   
    });
});
$(document).ready(function() {
    $('#NewEvent').click(function(evento) {
        $('#NuevoEvento').show();
        $('#Inicio').css("display" , "none");
        $('#NuevoCliente').css("display" , "none");
        $('#ActualizarEvento').css("display" , "none");
        $('#ActualizarCliente').css("display" , "none");
        $('#Administrador').css("display" , "none");   
    });
});
$(document).ready(function() {
    $('#NewClient').click(function(evento) {
        $('#NuevoCliente').show();
        $('#NuevoEvento').css("display" , "none");
        $('#Inicio').css("display" , "none");
        $('#ActualizarEvento').css("display" , "none");
        $('#ActualizarCliente').css("display" , "none");
        $('#Administrador').css("display" , "none");   
    });
});
$(document).ready(function() {
    $('#UpdateEvent').click(function(evento) {
        $('#ActualizarEvento').show();
        $('#NuevoEvento').css("display" , "none");
        $('#NuevoCliente').css("display" , "none");
        $('#Inicio').css("display" , "none");
        $('#ActualizarCliente').css("display" , "none");
        $('#Administrador').css("display" , "none");   
    });
});
$(document).ready(function() {
    $('#UpdateClient').click(function(evento) {
        $('#ActualizarCliente').show();
        $('#NuevoEvento').css("display" , "none");
        $('#NuevoCliente').css("display" , "none");
        $('#ActualizarEvento').css("display" , "none");
        $('#Inicio').css("display" , "none");
        $('#Administrador').css("display" , "none");   
    });
});
$(document).ready(function() {
    $('#Administrator').click(function(evento) {
        $('#Administrador').show();
        $('#NuevoEvento').css("display" , "none");
        $('#NuevoCliente').css("display" , "none");
        $('#ActualizarEvento').css("display" , "none");
        $('#ActualizarCliente').css("display" , "none");
        $('#Inicio').css("display" , "none");   
    });
});
$(document).ready(function() {
    $('#Cliente').click(function(evento) {
        alert("Informacion Guardada con Exito");  
    });
});
function validarFormulario(){
          $("#formulario").validate();
       }
$(document).ready(function(){
          validarFormulario();
});
