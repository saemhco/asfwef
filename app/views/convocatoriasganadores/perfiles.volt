<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Convocatorias Perfiles</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-12" style="margin-bottom: -30px;">
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
                                <h2>Perfiles de Convocatorias</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-12" >
                                                <table id="tbl_convocatoria_perfiles" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                                    <thead>			                
                                                        <tr>
                        

                                                    <th data-class="expand">Nombre</th>
                                                    <th>Nombre Corto</th>
                                                    <th data-hide="phone,tablet">Ganadores</th>
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
                                        <a href="{{ url('convocatoriasganadores') }}" role="button" class="btn tbn-block btn-primary" ><i class="fa fa-chevron-left" ></i>&nbsp;&nbsp;&nbsp;Volver</a>
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
<!-- fomulario de perfiles -->
{{ form('convocatorias/savePerfiles','method': 'post','id':'form_convocatorias_perfiles','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-9">
            <label class="text-info" >Nombre</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-nombre" name="nombre" placeholder="Nombre" value="">
                <input type="hidden" id="input-codigo_perfiles" name="codigo_perfiles" value="">
                <input type="hidden" id="input-convocatoria" name="convocatoria" value="{{ convocatoria }}">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Nombre Corto</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-nombre_corto" name="nombre_corto" placeholder="Nombre Corto" value="">
            </label>
        </section>



    </div>

    <div class="row">
        <section class="col col-md-4" >
            <label class="text-info" >Fecha Inicio (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio" name="fecha_inicio" placeholder="Fecha Inicio" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>
        <section class="col col-md-2">
            <label class="text-info" >Hora Inicio (HH:MM:SS)</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                    <input type="text" id="input-hora_inicio" name="hora_inicio" placeholder="Hora Inicio" value="">
            </label>
        </section>
        <section class="col col-md-4" >
            <label class="text-info" >Fecha Fin (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin" name="fecha_fin" placeholder="Fecha Fin" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>
        <section class="col col-md-2">
            <label class="text-info" >Hora fin (HH:MM:SS)</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                   <input type="text" id="input-hora_fin" name="hora_fin" placeholder="Hora Fin" value="">
            </label>
        </section>
    </div>

    <div class="row">
        <section class="col col-md-6">
            <label class="text-info" >Formación Académica</label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_formacion_academica"><i class="fa fa-hand-o-up"></i> Click Aquí para editar</button>

            <div id="imagen_formacion_academica" class="collapse">
                <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                    <textarea rows="5" id="input-formacion_academica" name="formacion_academica_ckeditor" placeholder=""></textarea> 
                </label>
            </div>
        </section>

        <section class="col col-md-6">
            <label class="text-info" >Experiencia Laboral General</label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_experiencia_laboral_general"><i class="fa fa-hand-o-up"></i> Click Aquí para editar</button>

            <div id="imagen_experiencia_laboral_general" class="collapse">
                <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                    <textarea rows="5" id="input-experiencia_laboral_general" name="experiencia_laboral_general_ckeditor" placeholder=""></textarea> 
                </label>
            </div>
        </section>


        <section class="col col-md-6">
            <label class="text-info" >Experiencia Laboral Específica</label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_experiencia_laboral_especifica"><i class="fa fa-hand-o-up"></i> Click Aquí para editar</button>

            <div id="imagen_experiencia_laboral_especifica" class="collapse">
                <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                    <textarea rows="5" id="input-experiencia_laboral_especifica" name="experiencia_laboral_especifica_ckeditor" placeholder=""></textarea> 
                </label>
            </div>
        </section>

        <section class="col col-md-6">
            <label class="text-info" >Competencias</label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_competencias"><i class="fa fa-hand-o-up"></i> Click Aquí para editar</button>

            <div id="imagen_competencias" class="collapse">
                <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                    <textarea rows="5" id="input-competencias" name="competencias_ckeditor" placeholder=""></textarea> 
                </label>
            </div>
        </section>

        <section class="col col-md-6">
            <label class="text-info" >Diplomados</label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_diplomados"><i class="fa fa-hand-o-up"></i> Click Aquí para editar</button>

            <div id="imagen_diplomados" class="collapse">
                <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                    <textarea rows="5" id="input-diplomados" name="diplomados_ckeditor" placeholder=""></textarea> 
                </label>
            </div>
        </section>

        <section class="col col-md-6">
            <label class="text-info" >Conocimientos Técnicos</label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_conocimientos_tecnicos"><i class="fa fa-hand-o-up"></i> Click Aquí para editar</button>

            <div id="imagen_conocimientos_tecnicos" class="collapse">
                <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                    <textarea rows="5" id="input-conocimientos_tecnicos" name="conocimientos_tecnicos_ckeditor" placeholder=""></textarea> 
                </label>
            </div>
        </section>

        <section class="col col-md-6">
            <label class="text-info" >Conocimientos Esenciales</label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_conocimientos_esenciales"><i class="fa fa-hand-o-up"></i> Click Aquí para editar</button>
            <div id="imagen_conocimientos_esenciales" class="collapse">
                <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                    <textarea rows="5" id="input-condiciones_esenciales" name="condiciones_esenciales_ckeditor" placeholder=""></textarea> 
                </label>
            </div>
        </section>

        <section class="col col-md-6">
            <label class="text-info" >Funciones</label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_funciones"><i class="fa fa-hand-o-up"></i> Click Aquí para editar</button>
            <div id="imagen_funciones" class="collapse">
                <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                    <textarea rows="5" id="input-funciones" name="funciones_ckeditor" placeholder=""></textarea>
                </label>
            </div>
        </section>

    </div>

    <div class="row">
        <section class="col col-md-6">

            <label class="text-info" >Agregar Archivo</label>
            <div class="input input-file" id="archivo_perfiles_modal">

                <span class="button"><input id="archivo_adenda" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo" readonly="">

            </div>

        </section>

        <section class="col col-md-6">

            <label class="text-info" >Agregar Imagen (600 x 400 px)</label>
            <div class="input input-file" id="imagen_perfiles_modal">

                <label class="input">

                    <span class="button"><input id="imagen_adenda" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-image" name="input-file"  placeholder="Agregar Imagen" readonly="">
                </label>
            </div>

        </section>

    </div>
</fieldset>
{{ endForm() }}
<script type="text/javascript" >
//var region_id = "";
//var provincia_id = '';
    var publica = "no";
    var idl = "";
//var distrito_id = '';
</script>
<script type="text/javascript" >
    var convocatoria = "{{convocatoria}}";
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>

