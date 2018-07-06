
$(document).ready(function () {
    //obtenemos el valor de los input
    ListaBeneficios = new ListaBeneficios();
    $('#adicionar').click(function () {
        var beneficio = document.getElementById("beneficio").value;
        var cantidad = document.getElementById("cantidad").value;
        if(beneficio!="" && cantidad>=1 && cantidad<=100 && cantidad!=""){
            ListaBeneficios.add(new Beneficio(beneficio,cantidad));
        var fila = '<tr id="row' + i + '"><td>' + beneficio + '</td><td>' + cantidad + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove" onclick="hideRow(event)">Quitar</button></td></tr>'; //esto seria lo que contendria la fila
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
            }else{
                if(beneficio=="" && cantidad==""){
                                 $("#beneficio").attr("placeholder", "Campo Vacio, Ingrese Informacion");
                                 $("#beneficio").css("border-color", "red");
                                 $("#cantidad").attr("placeholder", "Campo Vacio, Ingrese la Cantidad");
                                 $("#cantidad").css("border-color", "red");
                                }else{
                                    if(beneficio==""){
                                        $("#beneficio").attr("placeholder", "Campo Vacio, Ingrese Informacion");
                                        $("#beneficio").css("border-color", "red");
                                        $("#cantidad").attr("placeholder", "Cantidad...");
                                        $("#cantidad").css("border-color", "black");
                                     }else{
                                        if(cantidad==""){
                                            $("#cantidad").attr("placeholder", "Campo Vacio, Ingrese la Cantidad");
                                            $("#cantidad").css("border-color", "red");                                           
                                            $("#beneficio").attr("placeholder", "Beneficio...");
                                            $("#beneficio").css("border-color", "black");
                                        }
              }
            }
            }
    });
    
    ListaEntradas = new ListaEntradas();
    
    var ArrayJson = JSON.parse(sessionStorage.getItem("Entradas"));
    for(var i in ArrayJson) {
        ListaEntradas.add(new Entrada(
            ArrayJson[i].Nombre,
            ArrayJson[i].Primer_Apellido,
            ArrayJson[i].Segundo_Apellido,
            ArrayJson[i].Correo,
            ArrayJson[i].Telefono
        ))
    }
});

function hideRow(event){
    var row = $(event.target || event.srcElement).parents('tr');
    var indexrow = ListaBeneficios.get().length - row.index();
    row.remove();
    ListaBeneficios.remove(indexrow);
}

function Enviar(){
    ListaEntradas.get().forEach(element => {
        element.Beneficios = ListaBeneficios.get();
    });
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
        proto.setEntradas = function(datos){
            instances=datos;
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
        this.Beneficios = [];
      }
}
 
class Beneficio{
    constructor(Nombre, Cantidad) {
        this.Nombre = Nombre;
        this.Cantidad = Cantidad;
      }
}

function ListaBeneficios(){
    var instances = [];
    if (!('prototypemethodsset' in ListaBeneficios)){
        var proto = ListaBeneficios.prototype;
        proto.get = function(){
            return instances;
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
        proto.getJson = function(){
            return JSON.stringify(instances);;
        };
        proto.prototypemethodsset = true;
    }
}