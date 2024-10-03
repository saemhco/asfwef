<style>
    .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Mantenimiento de Empleos</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
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
                        <a href="javascript:void(0);" onclick="agregar()" class="btn btn-primary btn-block"><i
                                class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar()" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminar()" class="btn btn-danger btn-block"><i
                                class="fa fa-trash"></i></a>

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
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Registro de Empleos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">
                                    
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-12" >

                                                <table id="tbl_empleo" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                                    <thead>			                
                                                        <tr>
                                                            <th><center><i class="fa fa-check-circle"></i></center></th>                                             
            
                                                            <th data-class="expand">Inicio</th>
                                                            <th data-hide="phone,tablet">Fin</th>
                                                            <th data-hide="phone,tablet">Título</th>
                                                            <th data-hide="phone,tablet">Empresa</th>
                                                            <th data-hide="phone,tablet">Tipo Contrato</th>
                                                            <th data-hide="phone,tablet">Ciudad</th>
                                                            <th data-hide="phone,tablet">Estado</th>
            
                                                    </tr>
                                                    </thead>
                                                    <tbody>				
                                                    </tbody>
                                                </table>

                                            </section>
                                        </div>
                                    </fieldset>

                                    
                                    <footer>
                                        <a href="{{ url('gestionegresados') }}" role="button" class="btn tbn-block btn-primary" ><i class="fa fa-chevron-left" ></i>&nbsp;&nbsp;&nbsp;Volver</a>
                                    </footer>
                                </div>		
                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>			
    </div>	
</div>
<div class="hidden">
    <div id="error_agregar">
        <p>
            Opcion no disponible...
        </p>
    </div>
</div>
{{ form('gestionegresados/saveEmpleos','method':
'post','id':'form_empleos','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-4">
            <label class="text-info">Tipo de contrato</label>
            <label class="select">
                <select id="input-id_tipocontrato" name="id_tipocontrato">
                    <option value="">SELECCIONE...</option>
                    {% for tipocontratos_select in tipocontratos %}

                    <option value="{{ tipocontratos_select.codigo }}">{{ tipocontratos_select.nombres }}</option>

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
        <section class="col col-md-4">
            <label class="text-info">Cargo</label>
            <label class="select">
                <select id="input-id_cargo" name="id_cargo">
                    <option value="">SELECCIONE...</option>
                    {% for cargos_select in cargos %}

                    <option value="{{ cargos_select.codigo }}">{{ cargos_select .nombres }}</option>

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
        <section class="col col-md-4">
            <label class="text-info">Jornada</label>
            <label class="select">
                <select id="input-id_jornada" name="id_jornada">
                    <option value="">SELECCIONE...</option>
                    {% for jornadas_select in jornadas %}

                    <option value="{{ jornadas_select.codigo }}">{{ jornadas_select.nombres }}</option>

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Empresas</label>
            <select style="width:100%" id="input-id_empresa" name="id_empresa">
                <optgroup label="">
                    <option value="">SELECCIONE...</option>

                    {% for empresas_select in empresas %}   
                    <option value="{{ empresas_select.id_empresa }}">{{ empresas_select.ruc }} - {{ empresas_select.razon_social }}</option>
                    {% endfor %}

                </optgroup>
            </select>
            <p id="input-warning_empresas">
            <p>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Fecha Inicio</label>
            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio" name="fecha_inicio"
                    placeholder="Fecha Inicio" class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info">Fecha Fin</label>
            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin" name="fecha_fin"
                    placeholder="Fecha Fin" class="datepicker" data-dateformat='dd/mm/yy' value="" tabindex="-1">
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Titulo</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-titulo" name="titulo"
                    placeholder="Título">
                    
                    <input type="hidden" id="input-id_empleo"
                    name="id_empleo"
                    value="">
                    <input type="hidden" id="input-id_alumno"
                    name="id_alumno"
                    value="{{id}}">
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Remuneración</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-remuneracion" name="remuneracion"
                    placeholder="Remuneración">
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Ciudad</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-empleo-ciudad" name="ciudad"
                    placeholder="Ciudad">
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Descripción</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="3" id="input-descripcion" name="descripcion"></textarea>
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Region</label>
            <label class="select">
                <select id="input-region_id" name="region_id">
                    <option value="">SELECCIONE...</option>
                    {% for regiones_select in regiones %}

                    <option value="{{ regiones_select.region }}">{{ regiones_select.descripcion }}</option>

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Provincia</label>
            <label class="select">
                <select id="input-provincia_id" name="provincia_id">
                    <option value="">SELECCIONE...</option>
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Distrito</label>
            <label class="select">
                <select id="input-distrito_id" name="distrito_id">
                    <option value="">SELECCIONE...</option>
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info">Ubigeo</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-ubigeo_id" name="ubigeo_id"
                    placeholder="Ubigeo">
            </label>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Agregar Archivo</label>
            <div class="input input-file" id="archivo_empleo_modal">
                <span class="button"><input id="input-archivo_empleo" type="file" name="archivo_empleo"
                        onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"
                        ><i class="fa fa-search"></i> Buscar</span><input type="text"
                    id="archivo_empleo" name="input-archivo" placeholder="Agregar Archivo" >
            </div>
        </section>

        <section class="col col-md-6">
            <label class="text-info">Agregar Imagen (600 x 400 px)</label>
            <div class="input input-file" id="imagen_empleo_modal">
                <label class="input">
                    <span class="button"><input id="input-imagen_empleo" type="file" name="imagen_empleo"
                            onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"
                            ><i class="fa fa-search"></i> Buscar</span><input type="text"
                        id="imagen_empleo" name="input-imagen" placeholder="Agregar Imagen">
                </label>
            </div>
        </section>


    </div>
</fieldset>
{{ endForm() }}
<script type="text/javascript">
    var id_alumno = '{{ id }}';
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>

