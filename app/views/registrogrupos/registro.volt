<style>
    #cke_input-descripcion {
        border:solid 1px black;
    }
</style>

{% set id_grupo = "" %}
{% if grupos.id_grupo is defined %}
    {% set id_grupo = grupos.id_grupo %}
{% endif %}

{% set tipo = "" %}
{% if grupos.tipo is defined %}
    {% set tipo = grupos.tipo %}
{% endif %}



{% set nombre = "" %}
{% if grupos.nombre is defined %}
    {% set nombre = grupos.nombre %}
{% endif %}




<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar grupos</li>
    </ol>
</div>
<!-- END RIBBON -->     


<!-- MAIN CONTENT -->
<div id="content">

    {% if grupos.id_grupo is defined %}

        <div class="row">
           <div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
                <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">								
                    <header class="">
                        <center style="margin-top: -5px !important;">
                            <span class="widget-icon">Opciones</span>
                        </center>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">								

                        </div>
                        <div class="widget-body text-center">
                            <a href="javascript:void(0);"  onclick="agregar_grupos_detalles();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                            <a href="javascript:void(0);" onclick="editar_grupos_detalles();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                                {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                            <a href="javascript:void(0);" onclick="eliminar_grupos_detalles();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-sm-11" style="margin-bottom: -30px;">
                <section id="widget-grid" class="">
                    <div class="row">
                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
                            <div class="jarviswidget" id="wid-id-0" 
                                 data-widget-editbutton="false" 
                                 data-widget-deletebutton="false"
                                 data-widget-fullscreenbutton="false"
                                 data-widget-colorbutton="false"	
                                 data-widget-custombutton="false"
                                 data-widget-sortable="false"
                                 data-widget-togglebutton="false"
                                 >

                                <header>
                                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                    {% for tipo_usuario_select in tipo_usuario %}                                       
                                        {% if tipo_usuario_select.codigo == tipo %}
                                            <h2>Grupos: {{ nombre }} - {{ tipo_usuario_select.nombres }}</h2>
                                        {% endif %}
                                    {% endfor %}

                                </header>

                                <div>
                                    <div class="jarviswidget-editbox">										
                                        <input class="form-control" type="text">	
                                    </div>										
                                    <div class="widget-body no-padding">										

                                        <table id="tbl_grupos_detalles" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                            <thead>			                
                                                <tr>
                                                    <th>
                                            <center><i class="fa fa-check-circle"></i></center>
                                            </th>
                                            <th data-hide="expand">Personal</th>
                                                {#<th data-class="phone,tablet">Grupo</th>#}
                                                {#<th data-hide="phone,tablet">Estado</th>#}

                                            </tr>
                                            </thead>
                                            <tbody>			
                                            </tbody>
                                        </table>   
                                        <footer>
                                            <a href="{{ url('registrogrupos') }}" role="button" class="btn tbn-block btn-primary" ><i class="fa fa-chevron-left" ></i>&nbsp;&nbsp;&nbsp;Volver</a>
                                        </footer>



                                    </div>		
                                </div>
                            </div>	
                        </article>	
                    </div>
                </section>
            </div>
        </div>
    {% endif %}
</div>
<div class="hidden">
    <div id="exito_grupos">
        <p>
            Se guardo correctamente...
        </p>
    </div>
</div>

<!--Formulario de registro archivos-->
{{ form('registrogrupos/saveGruposDetalles','method': 'post','id':'form_grupos_detalles','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <select style="width:100%" class="select2" id="input-personal"  name="personal">
                <optgroup label="">
                    <option value="0">SELECCIONE...</option>
                    {% if tipo == 2 %}
                        {% for docente_select in docente %}                                       
                            <option value="{{ docente_select.codigo }}">{{ docente_select.apellidop }} {{ docente_select.apellidom }} {{ docente_select.nombres }}</option>                                       
                        {% endfor %}
                    {% elseif  tipo == 3%}
                        {% for personal_select in personal %}                                       
                            <option value="{{ personal_select.codigo }}">{{ personal_select.apellidop }} {{ personal_select.apellidom }} {{ personal_select.nombres }}</option>                                       
                        {% endfor %}
                    {% elseif  tipo == 4%}
                        {% for publico_select in publico %}                                       
                            <option value="{{ publico_select.codigo }}">{{ publico_select.apellidop }} {{ publico_select.apellidom }} {{ publico_select.nombres }}</option>                                       
                        {% endfor %}
                    {% endif %}
                </optgroup>
            </select>
            <p id="input-warning"><p>
        </section>
        <input type="hidden" id="input-id_personal_grupo" name="id_personal_grupo" value="">
        <input type="hidden" id="input-personal_oculto" name="personal_oculto" value="">
        <input type="hidden" id="input-grupo" name="grupo" value="{{ id_grupo }}">
    </div>
</fieldset>
{{ endForm() }}
<!-- fin form -->
<script type="text/javascript" >
    var idl = "";
    var publica = "si";

    {% if id is defined %}
        idl = {{ id }};
    {% endif %}
        //alert("Hola");
</script>
<script type="text/javascript" >
    {% if id_grupo %}
        var id_grupo = {{ id_grupo }};
    {% else %}
        var id_grupo = 0;
    {% endif %}

    {% if id_tipo_usuario %}
        var id_tipo_usuario = {{ id_tipo_usuario }};
    {% else %}
        var id_tipo_usuario = 0;
    {% endif %}
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>