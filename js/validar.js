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
            setTimeout(function(){
                $('.error').slideUp('slow');               
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