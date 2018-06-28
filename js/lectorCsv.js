$(document).ready(function () {

    $('#viewfile').click(function () { // en esta parte lo que haremos es que el boton de importar lea el archivo y lo pase a la tabla
        var rdr = new FileReader();
        rdr.onload = function (e) {
            var therows = e.target.result.split("\n");
            var newrow = "";
            ListaEntradas.Clear();
            $('#table-data').empty();
            for (var row = 0; row < therows.length-1; row++) {
                
                var columns = therows[row].split(";");// cuando se lea el archivo y vengan ; va a ser una nueva columna
                
                var colcount = columns.length;
                if (colcount !== 5) {
                    //si son mas columnas de las que permite la tabla mande el mensaje
                    newrow += "<tr scope='row'><td>esta insertando mas campos</td><td></td><td></td><td></td></tr>";
                } else {
                    GuardarEntrada(columns);
                    //si son las columnas permite la tabla mete los datos
                    newrow += '<tr id="fila_'+ row +'"><td>' + columns[0] + "</td><td>" + columns[1] + "</td><td>" + columns[2] + "</td><td>" + columns[3] + "</td><td>"+ columns[4] + "</td>";
                    newrow += "<td>" + '<a href="#" onclick=hideRow(event) class="btn btn-danger">Eliminar</a>' + "</td></tr>";
                }
                
            }
            $('#tableMain').append(newrow); // se le agrega una nueva fila a la tabla
        }
        rdr.readAsText($("#inputfile")[0].files[0]); // si el texto no tiene nada vuelve a pedir que inserte el documuento
    });
});

function hideRow(event){
    var row = $(event.target || event.srcElement).parents('tr');
    var indexrow = row.index();
    row.remove();
    ListaEntradas.remove(indexrow);
}

function GuardarEntrada(columns){
    var entrada = new Entrada(columns[0].trim(),columns[1].trim(),columns[2].trim(),columns[3].trim(),columns[4].trim());
    ListaEntradas.add(entrada);
}

function Mostrar(){
    //console.log(ListaEntradas.getJson());
    alert(ListaEntradas.getJson());
}

function ListaEntradas(){
    var instances = [];
    if (!('prototypemethodsset' in ListaEntradas)){
        var proto = ListaEntradas.prototype;
        proto.get = function(){
            return instances;
        };
        proto.getJson = function(){
            return JSON.stringify(instances);;
        };
        proto.add = function(datos){
            instances.push(datos);
        };
        proto.remove = function(index){
            instances.splice(index, 1);
        };
        proto.Clear = function(){
            instances = [];
        };
        proto.prototypemethodsset = true;
    }
}

class Entrada{
    constructor(Nombre, Primer_Apellido,Segundo_Apellido,Correo,Telefono) {
        this.Nombre = Nombre;
        this.Primer_Apellido = Primer_Apellido;
        this.Segundo_Apellido = Segundo_Apellido;
        this.Correo = Correo;
        this.Telefono = Telefono;
      }
}
 
ListaEntradas = new ListaEntradas();