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
                    newrow += "<tr scope='row'><td>Comprueve el Formato del Documento</td><td></td><td></td><td></td></tr>";
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
        rdr.readAsText($("#inputfile")[0].files[0]); // si el texto no tiene nada vuelve a pedir que inserte el documuento
    });


    //obtenemos el valor de los input

    $('#adicionar').click(function () {
        var beneficio = document.getElementById("beneficio").value;
        var cantidad = document.getElementById("cantidad").value;
        if (beneficio != "" && cantidad >= 1 && cantidad <= 100 && cantidad != "") {
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
        $('#beneficiosUser').hide();
    });

    $('#confirmar').click(function (evento) {
        if (ListaEntradas.get().length > 0) {
            $('#busqueda').hide();
            $('#beneficiosUser').show();
        } else {
            $("#divTabla").hide();
        }
    });
});

function hideRow() {
    var total = ListaEntradas.get().length - 1;
    for (var index = total; index >= 0; index--) {
        var borrar = document.getElementById("ocultar" + index).checked;
        if (!borrar)
            ListaEntradas.remove(index);
    }
}

function GuardarEntrada(columns) {
    var entrada = new Entrada(columns[0].trim(), columns[1].trim(), columns[2].trim(), columns[3].trim(), columns[4].trim());
    ListaEntradas.add(entrada);
}

function Enviar() {
    hideRow();
    if (ListaEntradas.get().length < 0) {
        $('#table-data').empty();
        ListaEntradas.Clear();
        $("#confirmar").hide();
        $("#fila").hide();
        alert("Tienes que ingresar el archivo para Continuar\nY tienes que seleccionar algún empleado\nIngrese sus datos de nuevo");
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
        this.Beneficios = [];
    }
}


function hideRow2(event) {
    var row = $(event.target || event.srcElement).parents('tr');
    var indexrow = ListaBeneficios.get().length - row.index();
    row.remove();
    ListaBeneficios.remove(indexrow);
}

function Enviar2() {
    ListaEntradas.get().forEach(element => {
        element.Beneficios = ListaBeneficios.get();
    });
    alert(ListaEntradas.getJson());
}



class Beneficio {
    constructor(Nombre, Cantidad) {
        this.Nombre = Nombre;
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