$(document).ready(function () {
    
    if(nuevo == 1){
        drawFormula();
    }

    $("#btn-guarda").on("click",function(){

 


        frm = $("#form-config");
        $.ajax({
            url: frm.attr("action"),
            type: 'POST',
            data: frm.serialize(),
            success: function (msg) {
                var result = msg;
                if (result.say === "yes")
                {
                    bootbox.alert("<strong>Se registró correctamente ...</strong>");
                } else {
                    bootbox.alert("<strong>ocurrio un error...</strong>");
                }
            }
        });       
    });

    $("#agregar").on("click",function(){
        var etiqueta = $("#etiqueta").val();
        var peso = $("#peso").val();
        var tipo = $("#tipo").val();

        if (etiqueta == "" || peso == "" || tipo == 0) {
            bootbox.alert("<strong>Los campos solicitados son requeridos</strong>");
            return 0;
        }



        var html = createRow(etiqueta,peso,tipo);
        $("#llena_etiquetas").append(html);
        drawFormula();
        enumerateRow();
    });

});

function createRow(etiqueta,peso,tipo){
    var html = "<tr>";
        html = html+"<td class='orden'></td>";
        html = html+"<td><input type='text' onkeyup='drawFormula()' class='form-control' name='etq[]' value='"+etiqueta+"' ></td>";
   
        html = html+"<td>";
            html = html+'<select class="form-control" name="tipo[]">';
                if(tipo == 1){
                    html = html+'<option value="1"  selected="selected">Inicial</option>';
                    html = html+'<option value="2">Final</option>';
                    html = html+'<option value="3">Otros</option>';
                }else if (tipo == 2){
                    html = html+'<option value="1">Inicial</option>';
                    html = html+'<option value="2" selected="selected">Final</option>';
                    html = html+'<option value="3">Otros</option>';
                } else {
                    html = html+'<option value="1">Inicial</option>';
                    html = html+'<option value="2">Final</option>';
                    html = html+'<option value="3" selected="selected">Otros</option>';
               }
            html = html+'</select>';
        html = html+"</td>";
        html = html+"<td>";
            html = html+"<button type='button' class='hidden btn btn-success btn-xs' onclick='moveRow(this,1)'><i class='fa fa-arrow-up' ></i></button> ";
            html = html+"<button type='button' class='hidden btn btn-success btn-xs' onclick='moveRow(this,0)'><i class='fa fa-arrow-down' ></i></button> ";
            html = html+"<button type='button' class='btn btn-danger btn-xs' onclick='deleteRow(this)' ><i class='fa fa-remove' ></i></button>";
        html = html+"</td>";
    html = html+"</tr>";
    return html;
}

function moveRow(t,opt){
    var row = $(t).closest('tr');
    console.log(row);
    if(opt == 1){
        row.prev().before(row);
    }else{
        row.next().after(row);
    }
    enumerateRow();
    drawFormula();
}

function deleteRow(t){
    $(t).closest('tr').remove(); 
    enumerateRow();
    drawFormula();
}

function enumerateRow(){
    var itemCounter = 0;
    $('#llena_etiquetas tr').each(function() {
        itemCounter += 1;
        $('td.orden', this).text(itemCounter);
    });
}

function drawFormula(){

    var ashetml = "";

    var etq = document.getElementsByName('etq[]');
    //var peso = document.getElementsByName('peso[]');
    for (var i = 0; i <etq.length; i++) {
        var etq_txt =etq[i];
       
        ashetml = ashetml+' <button type="button" onclick="drawPick(this)" class="label label-primary"> '+etq_txt.value+' </button >&nbsp;';
        //alert("pname["+i+"].value="+inp.value);
    }
 
    $("#llena-etiquetas").html(ashetml);
}


function drawPick(t){
    var txt = $("#llena-formula").text().trim()+$(t).text().trim();
    $("#llena-formula").text(txt.trim());
    
    var anterior = $("#anterior-form").val();
    var separator = "";
    if(anterior !== ""){
        separator = ",";
    }
    $("#anterior-form").val(anterior+separator+ $("#llena-formula").text().trim());
}


function Limpiar(){
    $("#llena-formula").text("");
}

function Anterior(){
    var ant = $("#anterior-form").val().split(",");
    console.log(ant);
    if(ant.length > 1){
        var antes = ant.length-2;
        console.log(antes);
        $("#llena-formula").text(ant[antes]);
        ant.pop();
        $("#anterior-form").val(ant.join(","));
    }else{
        $("#llena-formula").text("");
         $("#anterior-form").val("");
    }
}

