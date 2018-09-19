var ListaEntradas = new ListaEntradas();
var ListaBeneficios = new ListaBeneficios();

$().ready(function () {
    $('#viewfile').click(function () { // en esta parte lo que haremos es que el boton de importar lea el archivo y lo pase a la tabla
        var input = $("#inputfile").val();
        $(".custom-file-label").text(input);
        var rdr = new FileReader();
        rdr.onload = function (e) {
            var therows = e.target.result.split("\n");
            var newrow = "";
            var mostrar;
            ListaEntradas.Clear();
            $('#table-data').empty();
            for (var row = 0; row < therows.length - 1; row++) {

                var columns = (therows[row].split(";").length !== 5) ? therows[row].split(",") : therows[row].split(";"); // cuando se lea el archivo y vengan ; va a ser una nueva columna

                var colcount = columns.length;
                if ((mostrar = (colcount !== 5))) {
                    //si son mas columnas de las que permite la tabla mande el mensaje
                    newrow += "<tr scope='row'><td>Compruebe el Formato del Documento</td><td></td><td></td><td></td></tr>";
                } else {
                    GuardarEntrada(columns);
                    //si son las columnas permite la tabla mete los datos
                    newrow += '<tr id="fila_' + row + '"><td>' + columns[0] + "</td><td>" + columns[1] + "</td><td>" + columns[2] + "</td><td>" + columns[3] + "</td><td>" + columns[4] + "</td>";
                    //newrow += "<td>" + '<a href="#" onclick="hideRow(event)" class="btn btn-danger">Eliminar</a>' + "</td></tr>";
                    newrow += "<td>" + '<input type="checkbox"  id="ocultar' + row + '"/>' + "</td></tr>";
                }
            }
            if (!mostrar) {
                $("#confirmar").show();
                $("#divTabla").show();
                $("#fila").show();
            } else {
                $("#confirmar").hide();
                $("#fila").hide();
            }
            $('#tableMain').append(newrow); // se le agrega una nueva fila a la tabla
        }
        try {
            rdr.readAsText($("#inputfile")[0].files[0]);
        }
        catch(err) {
            $("span").text("Porfavor inserte un documento csv");
            $('.mensaje').css('background-color', '#E74F4F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);// si el texto no tiene nada vuelve a pedir que inserte el documuento
        }
        
    });


    //obtenemos el valor de los input

    $('#adicionar').click(function () {
        var beneficio = document.getElementById("beneficio").value;
        var cantidad = document.getElementById("cantidad").value;
        if (beneficio != "" && cantidad >= 1 && cantidad < 100 && cantidad != "") {
            ListaBeneficios.add(new Beneficio(beneficio, cantidad));
            var fila = '<tr id="row' + i + '"><td>' + beneficio + '</td><td>' + cantidad + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove" onclick="hideRow2(event)">Quitar</button></td></tr>'; //esto seria lo que contendria la fila
            var i = ListaBeneficios.get().length; //contador para asignar id al boton que borrara la fila
            i++;

            $('#mytable tr:first').after(fila);
            $("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
            var nFilas = $("#mytable tr").length;
            $("#adicionados").append(nFilas - 1);
            //le resto 1 para no contar la fila del header
            document.getElementById("cantidad").value = "";
            document.getElementById("beneficio").value = "";
            document.getElementById("beneficio").focus();
        } else {
            if (beneficio == "" && cantidad == "") {
                $("#beneficio").attr("placeholder", "Campo Vacio, Ingrese Informacion");
                $("#beneficio").css("border-color", "red");
                $("#cantidad").attr("placeholder", "Campo Vacio, Ingrese la Cantidad");
                $("#cantidad").css("border-color", "red");
            }
            if (cantidad != "" && beneficio == "") {
                $("#cantidad").attr("placeholder", "Cantidad...");
                $("#cantidad").css("border-color", "black");
                $("#beneficio").attr("placeholder", "Campo Vacio, Ingrese Informacion");
                $("#beneficio").css("border-color", "red");
            }
            if (beneficio != "" && cantidad == "") {
                $("#beneficio").attr("placeholder", "Beneficio...");
                $("#beneficio").css("border-color", "black");
                $("#cantidad").attr("placeholder", "Campo Vacio, Ingrese la Cantidad");
                $("#cantidad").css("border-color", "red");
            }
            if (cantidad <= 1 && cantidad >= 100){
                alert("Solo se pueden utilizar cantidades de 1 a 99");
            }
        }
        if (cantidad != "" && beneficio != "") {
            $("#beneficio").attr("placeholder", "Beneficio...");
            $("#beneficio").css("border-color", "black");
            $("#cantidad").attr("placeholder", "Cantidad...");
            $("#cantidad").css("border-color", "black");
        }
    });

    $('#ImportarCSV').click(function (evento) {
        $('#busqueda').show();
        $('#table-data').empty();
        $('#divTabla').hide();
        ListaEntradas.Clear();
        $("#confirmar").hide();
        $("#fila").hide();
        $('#beneficiosUser').hide();
    });

    
});

function hideRow() {
    var Temp = ListaEntradas.getJson();
    var total = ListaEntradas.get().length - 1;
    for (var index = total; index >= 0; index--) {
        var borrar = document.getElementById("ocultar" + index).checked;
        if (!borrar)
            ListaEntradas.remove(index);
    }
    if (ListaEntradas.get().length < 1) {
        ListaEntradas.setEntradas(JSON.parse(Temp));
        return false;
    }
    return true;
}

function GuardarEntrada(columns) {
    var entrada = new Entrada(columns[0].trim(), columns[1].trim(), columns[2].trim(), columns[3].trim(), columns[4].trim());
    ListaEntradas.add(entrada);
}

function Enviar() {
    var estado = hideRow();
    var eventoId = document.getElementById("eventoId").value;
    if (!estado) {
        $("span").text("Porfavor seleccione al menos un invitado");
        $('.mensaje').css('background-color', '#E74F4F');
        $('.mensaje').slideDown('slow');
        setTimeout(function(){
            $('.mensaje').slideUp('slow');
        },3000);
    }else if(eventoId == "null"){
        $("span").text("Debe seleccionar un evento");
        $('.mensaje').css('background-color', '#E74F4F');
        $('.mensaje').slideDown('slow');
        setTimeout(function(){
            $('.mensaje').slideUp('slow');
        },3000);
    }else{
        $('#busqueda').hide();
        $('#beneficiosUser').show();
    }
}

function ListaEntradas() {
    var instances = [];
    if (!('prototypemethodsset' in ListaEntradas)) {
        var proto = ListaEntradas.prototype;
        proto.get = function () {
            return instances;
        };
        proto.getJson = function () {
            return JSON.stringify(instances);;
        };
        proto.add = function (datos) {
            instances.push(datos);
        };
        proto.setEntradas = function (datos) {
            instances = datos;
        };
        proto.remove = function (index) {
            instances.splice(index, 1);
        };
        proto.Clear = function () {
            instances = [];
        };
        proto.prototypemethodsset = true;
    }

}

class Entrada {
    constructor(Nombre, Primer_Apellido, Segundo_Apellido, Correo, Telefono) {
        this.Nombre = Nombre;
        this.Primer_Apellido = Primer_Apellido;
        this.Segundo_Apellido = Segundo_Apellido;
        this.Correo = Correo;
        this.Telefono = Telefono;
    }
}


function hideRow2(event) {
    var row = $(event.target || event.srcElement).parents('tr');
    var indexrow = ListaBeneficios.get().length - row.index();
    row.remove();
    ListaBeneficios.remove(indexrow);
}

function Enviar2() {
        if(ListaBeneficios.getJson()=="[]"){
            $("span").text("Porfavor agregue al menos un beneficio");
            $('.mensaje').css('background-color', '#E74F4F');
            $('.mensaje').slideDown('slow');
            setTimeout(function(){
                $('.mensaje').slideUp('slow');
            },3000);
        }else{
        $('#loading-screen').fadeIn();
        ListaEntradas.get().forEach(element => {
            element.Beneficios = ListaBeneficios.get();
        });
        'use strict';

        const READY_STATE_COMPLETE = 4, STATUS_OK = 200;

        var myNavigator = () => {
            let nav = (window.XMLHttpRequest) ? new XMLHttpRequest() :  new ActiveXObject('Microsft.XMLHTTP');
            return nav;
        }

        var setRequest = (callback, route, data) => {
            var req = myNavigator();
            data = data;

            req.onreadystatechange = callback;
            req.open('POST', route, true);
            req.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            req.send('data=' + data);
        }

        var eventoId = document.getElementById("eventoId").value;
        let route = 'InsertarUserMenu.php?idEvento='+eventoId,
        data = ListaEntradas.getJson();

        setRequest(function(){

            if (this.readyState == READY_STATE_COMPLETE) {

                if (this.status == STATUS_OK) {
                    console.log(this.responseText);
                    $('#loading-screen').fadeOut();
                    $('#enviar2').attr("disabled", true);
                    $("span").text("Datos guardados exitosamente");
                    $('.mensaje').css('background-color', '#14BD2F');
                    $('.mensaje').slideDown('slow');
                    setTimeout(function(){$('.mensaje').slideUp('slow');},2000);
                    setTimeout("location.href = 'userMenu.php'",3000);
                }else{
                    $('#loading-screen').fadeOut();
                    $('#enviar2').attr("disabled", false);
                    $("span").text("Error de conexion");
                    $('.mensaje').css('background-color', '#E74F4F');
                    $('.mensaje').slideDown('slow');
                    setTimeout(function(){
                        $('.mensaje').slideUp('slow');
                    },3000);
                }
            }
        }, route, data);
    }
}


class Beneficio {
    constructor(Nombre_Beneficio, Cantidad) {
        this.Nombre_Beneficio = Nombre_Beneficio;
        this.Cantidad = Cantidad;
    }
}

function ListaBeneficios() {
    var instances = [];
    if (!('prototypemethodsset' in ListaBeneficios)) {
        var proto = ListaBeneficios.prototype;
        proto.get = function () {
            return instances;
        };
        proto.add = function (datos) {
            instances.push(datos);
        };
        proto.remove = function (index) {
            instances.splice(index, 1);
        };
        proto.Clear = function () {
            instances = [];
        };
        proto.getJson = function () {
            return JSON.stringify(instances);;
        };
        proto.prototypemethodsset = true;
    }
}

function Ocultar(){
    $('#beneficiosUser').hide();
    $('#busqueda').show();
}
