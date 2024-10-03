<style>
    #cke_input-perfil {
        border:solid 1px black;
    }
</style>

{% set id_contrato = "" %}
{% if contratos.id_contrato is defined %}
    {% set id_contrato = contratos.id_contrato %}
{% endif %}

{% set anio = "" %}
{% if contratos.anio is defined %}
    {% set anio = contratos.anio %}
{% endif %}

{% set numero = "" %}
{% if contratos.numero is defined %}
    {% set numero = contratos.numero %}
{% endif %}

{% set contrato = "" %}
{% if contratos.contrato is defined %}
    {% set contrato = contratos.contrato %}
{% endif %}

{% set tipo = "" %}
{% if contratos.tipo is defined %}
    {% set tipo = contratos.tipo %}
{% endif %}

{% set perfil = "" %}
{% if contratos.perfil is defined %}
    {% set perfil = contratos.perfil %}
{% endif %}

{% set certificacion = "" %}
{% if contratos.certificacion is defined %}
    {% set certificacion = contratos.certificacion %}
{% endif %}

{% set concurso = "" %}
{% if contratos.concurso is defined %}
    {% set concurso = contratos.concurso %}
{% endif %}

{% set resolucion = "" %}
{% if contratos.resolucion is defined %}
    {% set resolucion = contratos.resolucion %}
{% endif %}

{% set confianza = "" %}
{% if contratos.confianza is defined %}
    {% set confianza = contratos.confianza %}
{% endif %}

{% set imagen = "" %}
{% if contratos.imagen is defined %}
    {% set imagen = contratos.imagen %}
{% endif %}

{% set archivo = "" %}
{% if contratos.archivo is defined %}
    {% set archivo = contratos.archivo %}
{% endif %}

{% set personal = "" %}
{% if contratos.personal is defined %}
    {% set personal = contratos.personal %}
{% endif %}

{% set fecha_inicio = "" %}
{% if contratos.fecha_inicio is defined %}
    {% set fecha_inicio = utilidades.fechita(contratos.fecha_inicio,'d/m/Y') %}
{% endif %}

{% set fecha_fin = "" %}
{% if contratos.fecha_fin is defined %}
    {% set fecha_fin = utilidades.fechita(contratos.fecha_fin,'d/m/Y') %}
{% endif %}

{% set area = "" %}
{% if contratos.area is defined %}
    {% set area = contratos.area %}
{% endif %}

{% set condicion = "" %}
{% if contratos.condicion is defined %}
    {% set condicion = contratos.condicion %}
{% endif %}

{% set regimen = "" %}
{% if contratos.regimen is defined %}
    {% set regimen = contratos.regimen %}
{% endif %}


{% set tipo_dependencia = "" %}
{% if contratos.tipo_dependencia is defined %}
    {% set tipo_dependencia = contratos.tipo_dependencia %}
{% endif %}

{% set dependencia = "" %}
{% if contratos.dependencia is defined %}
    {% set dependencia = contratos.dependencia %}
{% endif %}

{% set carrera = "" %}
{% if contratos.carrera is defined %}
    {% set carrera = contratos.carrera %}
{% endif %}

{% set cargo_general = "" %}
{% if contratos.cargo_general is defined %}
    {% set cargo_general = contratos.cargo_general %}
{% endif %}

{% set cargo = "" %}
{% if contratos.cargo is defined %}
    {% set cargo = contratos.cargo %}
{% endif %}

{% set categoria_laboral = "" %}
{% if contratos.categoria_laboral is defined %}
    {% set categoria_laboral = contratos.categoria_laboral %}
{% endif %}

{% set modalidad = "" %}
{% if contratos.modalidad is defined %}
    {% set modalidad = contratos.modalidad %}
{% endif %}

{% set local = "" %}
{% if contratos.local is defined %}
    {% set local = contratos.local %}
{% endif %}


{% set monto = "" %}
{% if contratos.monto is defined %}
    {% set monto = contratos.monto %}
{% endif %}

{% set visado = "" %}
{% if contratos.visado is defined %}
    {% set visado = contratos.visado %}
{% endif %}

{% set estado = "" %}
{% set txt_buton = "Guardar" %}
{% if contratos.estado is defined %}
    {% set estado = contratos.estado %}
    {% set txt_buton = "Actualizar" %}
{% endif %}


{% set nivel_remunerativo = "" %}
{% if contratos.nivel_remunerativo is defined %}
    {% set nivel_remunerativo = contratos.nivel_remunerativo %}
{% endif %}


{% set fecha_fin_adenda = "" %}
{% if contratos.fecha_fin_adenda is defined %}
    {% set fecha_fin_adenda = utilidades.fechita(contratos.fecha_fin_adenda,'d/m/Y') %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Contrato</li>
    </ol>
</div>
<!-- END RIBBON -->     


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">     
        <div class="col-sm-12">
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
                                <span class="widget-icon"> <i class="fa fa-book"></i> </span>
                                <h2>Registro de Contratos </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registrocontratos/save','method': 'post','id':'form_contratos','class':'smart-form','enctype':'multipart/form-data') }}
                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-4">

                                                <label class="text-info" >Tipo de Contrato 
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_contrato"  name="tipo" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for t_c in tipocontratos %}
                                                            {% if t_c.codigo == tipo %}
                                                                <option selected="selected" value="{{ t_c.codigo }}">{{ t_c.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ t_c.codigo }}">{{ t_c.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="text-info" >Número</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-numero" name="numero" placeholder="Número" value="{{ numero }}" onblur="concatenacionNombre();">

                                                </label>
                                            </section>



                                            <section class="col col-md-2" >
                                                <label class="text-info" >Fecha Inicio</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>

                                                    {% if estado == ""  %}
                                                        <input type="text" id="input-fecha_inicio" name="fecha_inicio" placeholder="Fecha Inicio" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_actual }}">
                                                        <input type="hidden" id="input-id_contrato" name="id_contrato" value="" >
                                                        <input type="hidden" id="input-anio" name="anio" value="">
                                                    {% else %}
                                                        <input type="text" id="input-fecha_inicio" name="fecha_inicio" placeholder="Fecha Inicio" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_inicio }}">
                                                        <input type="hidden" id="input-id_contrato" name="id_contrato" value="{{ id_contrato }}" >
                                                        <input type="hidden" id="input-anio" name="anio" value="{{ anio }}">
                                                    {% endif %}

                                                </label>
                                            </section>

                                            <section class="col col-md-2" >
                                                <label class="text-info" >Fecha Fin</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha" name="fecha_fin" placeholder="Fecha" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_fin }}">
                                                </label>
                                            </section>  
                                            
                                            

                                            
                                            <section class="col col-md-2" >
                                                <label class="text-info" >Fecha Fin Adenda</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_fin_adenda" name="fecha_fin_adenda" placeholder="Fecha Fin Adenda" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_fin_adenda }}">
                                                </label>
                                            </section>  



                                            <section class="col col-md-12">
                                                <label class="text-info" >Contrato</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-contrato" name="contrato" placeholder="Contrato" value="{{ contrato }}">

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Certificación</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-certificacion" name="certificacion" placeholder="Certificación" value="{{ certificacion }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Concurso</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-concurso" name="concurso" placeholder="Concurso" value="{{ concurso }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Resolución</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-resolucion" name="resolucion" placeholder="Resolución" value="{{ resolucion }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-4">

                                                <label class="text-info" >Personal
                                                </label>

                                                    <select style="width:100%" id="input-personal" name="personal">
                                                        <optgroup label="">
                                                            <option value="0">Apellido Paterno Apellidos Materno Nombres</option>
                                                            {% for p in personal_model %}                                       
                                                            {% if p.codigo == personal %}
                                                                <option value="{{ p.codigo }}" selected="selected">{{ p.apellidop }} {{ p.apellidom }} {{ p.nombres }} </option>  
                                                            {% else %}
                                                                <option value="{{ p.codigo }}">{{ p.apellidop }} {{ p.apellidom }} {{ p.nombres }} </option>  
                                                            {% endif %}
                                                        {% endfor %}
                                                        </optgroup>
                                                    </select>
                                  
                                            </section>
                                            <section class="col col-md-4">

                                                <label class="text-info" >Area
                                                </label>
                                                <label class="select">
                                                    <select id="input-area"  name="area" >
                                                        <option value="" > Nombre del Area</option>
                                                        {% for a in areas %}                                       
                                                            {% if a.codigo == area %}
                                                                <option value="{{ a.codigo }}" selected="selected">{{ a.nombres }} </option>  
                                                            {% else %}
                                                                <option value="{{ a.codigo }}">{{ a.nombres }} </option>  
                                                            {% endif %}
                                                        {% endfor %}

                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Carrera
                                                </label>
                                                <label class="select">
                                                    <select id="input-carrera"  name="carrera" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for ca in carreras %}
                                                            {% if ca.codigo == carrera %}
                                                                <option selected="selected" value="{{ ca.codigo }}">{{ ca.descripcion }}</option>   
                                                            {% else %}
                                                                <option value="{{ ca.codigo }}">{{ ca.descripcion }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-md-4">

                                                <label class="text-info" >Condición Laboral 
                                                </label>
                                                <label class="select">
                                                    <select id="input-condicion"  name="condicion" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for c in condicion_trabajo %}
                                                            {% if c.codigo == condicion %}
                                                                <option selected="selected" value="{{ c.codigo }}">{{ c.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ c.codigo }}">{{ c.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Régimen Laboral 
                                                </label>
                                                <label class="select">
                                                    <select id="input-regimen"  name="regimen" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for r in regimen_trabajo %}
                                                            {% if r.codigo == regimen %}
                                                                <option selected="selected" value="{{ r.codigo }}">{{ r.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ r.codigo }}">{{ r.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Categoria Laboral
                                                </label>
                                                <label class="select">
                                                    <select id="input-categoria_laboral"  name="categoria_laboral" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for c_l in categorialaboral %}
                                                            {% if c_l.codigo == categoria_laboral %}
                                                                <option selected="selected" value="{{ c_l.codigo }}">{{ c_l.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ c_l.codigo }}">{{ c_l.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Tipo de Dependencia
                                                </label>
                                                <label class="select">
                                                    <select id="input-tipo_dependencia"  name="tipo_dependencia" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for r in tipodependencia_trabajo %}
                                                            {% if r.codigo == tipo_dependencia %}
                                                                <option selected="selected" value="{{ r.codigo }}">{{ r.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ r.codigo }}">{{ r.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-8">
                                                <label class="text-info" >Dependencia</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-dependencia" name="dependencia" placeholder="Dependencia" value="{{ dependencia }}" >
                                                </label>
                                            </section>




                                            <section class="col col-md-4">
                                                <label class="text-info" >Cargo General
                                                </label>
                                                <label class="select">
                                                    <select id="input-cargo_general"  name="cargo_general" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for ca in cargogeneral %}
                                                            {% if ca.codigo == cargo_general %}
                                                                <option selected="selected" value="{{ ca.codigo }}">{{ ca.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ ca.codigo }}">{{ ca.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-8">
                                                <label class="text-info" >Cargo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-cargo" name="cargo" placeholder="Cargo" value="{{ cargo }}" >
                                                </label>
                                            </section>



                                            <section class="col col-md-4">
                                                <label class="text-info" >Local
                                                </label>
                                                <label class="select">
                                                    <select id="input-local"  name="local" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for lo in locales %}
                                                            {% if lo.codigo == local %}
                                                                <option selected="selected" value="{{ lo.codigo }}">{{ lo.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ lo.codigo }}">{{ lo.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Nivel Remunerativo</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-nivel_remunerativo" name="nivel_remunerativo" placeholder="Monto" value="{{ nivel_remunerativo }}" >
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Monto</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-monto" name="monto" placeholder="Monto" value="{{ monto }}" >
                                                </label>
                                            </section>


                                            <section class="col col-md-12">
                                                <label class="text-info" >Perfil</label>
                                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                    <textarea rows="16" id="input-perfil" name="perfil_ckeditor">{{ perfil }}</textarea> 
                                                </label>
                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info" >Agregar Archivo</label>
                                                <div class="input input-file">
                                                    <label class="input">
                                                        <span class="button"><input id="input-archivo" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file1" name="input-file"  placeholder="Agregar Archivo" readonly="">
                                                    </label>
                                                </div>

                                                {% if archivo !== ""   %}

                                                    <div class="alert alert-success fade in">                                                        

                                                        Click aqui para ver el archivo 
                                                        <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/registrocontratos/'~archivo) }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                                    </div>


                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                    </div>

                                                {% endif %}

                                            </section>
                                            <section class="col col-md-6" >
                                                <div class="input input-file">
                                                    <label class="text-info" >Agregar Imagen (600x400 px)</label>
                                                    <label class="input">

                                                        <span class="button"><input id="imagen" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file2" name="input-file"  placeholder="Agregar Imagen" readonly="">
                                                    </label>
                                                </div>

                                                {% if imagen !== ""   %}
                                                    <label class="text-info" >Imagen Contrato</label>

                                                    <br>
                                                    <img class="img-responsive" src="{{ url('adminpanel/imagenes/contratos/'~imagen) }}" error="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>

                                                {% endif %}




                                                {% if imagen !== ""   %}

                                                {% else %}

                                                    <div class="alert alert-warning fade in">                                                       
                                                        <i class="fa-fw fa fa-warning"></i>
                                                        <strong>Pendiente</strong> Aun no ha subido una imagen.
                                                    </div>

                                                {% endif %}
                                            </section>

                                            <section class="col col-md-2">

                                                <label class="checkbox">

                                                    {% if confianza == '1' %}
                                                        <input type="checkbox" name="confianza" value="{{ confianza }}" id="input-confianza" checked>
                                                    {% else %}
                                                        <input type="checkbox" name="confianza" value="{{ confianza }}" id="input-confianza">
                                                    {% endif %}
                                                    <i></i>Confianza</label>
                                            </section>
                                            <section class="col col-md-2">

                                                <label class="checkbox">

                                                    {% if visado == '1' %}
                                                        <input type="checkbox" name="visado" value="{{ visado }}" id="input-visado" checked>
                                                    {% else %}
                                                        <input type="checkbox" name="visado" value="{{ visado }}" id="input-visado">
                                                    {% endif %}
                                                    <i></i>Visado</label>
                                            </section>

                                        </div> 
                                    </fieldset>





                                    <footer>
                                        <button id="publicar" type="button" class="btn btn-primary">
                                            {{ txt_buton }}
                                        </button>
                                        <a href="javascript:history.back()"  type="button" class="btn btn-default" >
                                            Volver
                                        </a>

                                    </footer>
                                    {{ endForm() }}
                                </div>      
                            </div>
                        </div>  
                    </article>  
                </div>
            </section>
        </div>

        {% if estado !== "" %}
        <div class="col-sm-1">
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
                        <a href="javascript:void(0);"  onclick="agregar();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                            {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-11">
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
                                <h2>Registro de Addendas</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_adenda" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th>
                                        <center><i class="fa fa-check-circle"></i></center>
                                        </th>
                                        <th data-class="expand">Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th data-hide="phone,tablet">Numero</th>
                                        <th data-hide="phone,tablet">Adenda</th>
                                        <th data-hide="phone,tablet">Estado</th>
                                        </tr>
                                        </thead>
                                        <tbody>			
                                        </tbody>
                                    </table>
                                    <table class="table-primary table-bordered table" style="font-size: 10px !important;" >

                                        <tbody>

                                            <tr>
                                                <td>
                                        <center> <a role="button" href="javascript:history.back()" class="btn btn-primary  btn-md"><i class="fa fa-arrow-left"></i>  Volver </a></center>
                                        </td>
                                        </tr>
                                        </tbody>    
                                    </table>

                                </div>		
                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>

        {% endif %}

    </div>  
</div>
<!--Formulario-->
{{ form('registrocontratos/saveAdendas','method': 'post','id':'form_adenda','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-3">
            <label class="text-info" >Número</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-numero_adenda" name="numero" placeholder="Número" value="" readonly>
                <input type="hidden" id="input-codigo_adenda" name="id_contrato_adenda" value="">
                <input type="hidden" id="input-contrato_adenda" name="id_contrato" value="{{ id_contrato }}">
                <input type="hidden" id="input-anio_adenda" name="anio" value="{{ anio }}">
            </label>
        </section>

        <section class="col col-md-9">
            <label class="text-info" >Adenda</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-adenda" name="adenda" placeholder="adenda" value="" readonly>
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info" >Certificación</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-certificacion_adenda" name="certificacion" placeholder="Certificación" value="">
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info" >Resolución</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-resolucion_adenda" name="resolucion" placeholder="Resolución" value="">
            </label>
        </section>

    </div>

    <div class="row">
        <section class="col col-md-3" >
            <label class="text-info" >Fecha Inicio (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio_adenda" name="fecha_inicio" placeholder="Fecha Inicio" class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-3" >
            <label class="text-info" >Fecha Fin (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin_adenda" name="fecha_fin" placeholder="Fecha Fin" class="datepicker" data-dateformat='dd/mm/yy' value="">

            </label>
        </section>

        <section class="col col-md-2">
            <label class="checkbox" style="margin-top: 15px;">
                <input type="checkbox" name="visado_adenda" value="" id="input-visado_adenda">
                <i></i>Visado</label>
        </section>

    </div>

    <div class="row">
        <section class="col col-md-6">

            <label class="text-info" >Agregar Archivo</label>
            <div class="input input-file" id="archivo_adenda_modal">

                <span class="button"><input id="archivo_adenda" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo" readonly="">

            </div>

        </section>

        <section class="col col-md-6">

            <label class="text-info" >Agregar Imagen (600 x 400 px)</label>
            <div class="input input-file" id="imagen_adenda_modal">

                <label class="input">

                    <span class="button"><input id="imagen_adenda" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-image" name="input-file"  placeholder="Agregar Imagen" readonly="">
                </label>
            </div>

        </section>

    </div>
</fieldset>
{{ endForm() }}
<div class="hidden">
    <div id="exito_contratos">
        <p>
            Se grabo contrato correctamente...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_contrato_registrado">
        <p>
            Contrado ya registrado...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_numero_vacio">
        <p>
            Debe ingresar el numero de contrato...
        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_tipo_vacio">

        <p>
            Debe seleccionar el tipo de contrato...

        </p>
    </div>
</div>
<div class="hidden">
    <div id="error_pdf">

        <p>
            Solo se permite archivos con extencion ".pdf" ...

        </p>
    </div>
</div>
<script type="text/javascript" >
    var id1 = "";
    var id2 = "";
    var publica = "si";
    var xAbrevIns = "{{ config.global.xAbrevIns }}";

    {% if id1 is defined %}
        id1 = {{ id1 }};
    {% endif %}

    {% if id2 is defined %}
        id2 = {{ id2 }};
    {% endif %}
</script>
<script type="text/javascript" >
    var id_contrato = {{ id_contrato }};
</script>
