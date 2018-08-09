$(document).ready(function() {
    $('#ImportarCSV').click(function(evento) {
        $('#busqueda').show();   
    });
});

$(document).ready(function() {
    $('#confirmar').click(function(evento) {
        $('#busqueda').hide();
        $('#beneficiosUser').show();    
    });
});