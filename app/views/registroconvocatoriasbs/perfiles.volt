<style>
   .dataTables_filter input { width: 335px !important; }
</style>
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
                        <a href="javascript:void(0);"  onclick="agregar_perfiles();" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar_perfiles();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                            {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                        <a href="javascript:void(0);" onclick="eliminar_perfiles();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                                            <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                    </th>

                                                    <th data-class="expand">Nombre</th>
                                                    <th>Nombre Corto</th>
                                                    <th data-hide="phone,tablet">Postulantes</th>
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
                                        <a href="{{ url('registroconvocatoriasbs') }}" role="button" class="btn tbn-block btn-primary" ><i class="fa fa-chevron-left" ></i>&nbsp;&nbsp;&nbsp;Volver</a>
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
{{ form('registroconvocatoriasbs/savePerfiles','method': 'post','id':'form_convocatorias_perfiles','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">

        <section class="col col-md-9">
            <label class="text-info" >Nombre</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-nombre" name="nombre" placeholder="Nombre" value="">
                <input type="hidden" id="input-id_convocatoria_bs_perfil" name="id_convocatoria_bs_perfil" value="">
                <input type="hidden" id="input-convocatoria" name="id_convocatoria_bs" value="{{ convocatoria }}">
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
        <section class="col col-md-3" >
            <label class="text-info" >Fecha Inicio (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_inicio" name="fecha_inicio" placeholder="Fecha Inicio" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Hora Inicio (HH:MM:SS)</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                    <input type="text" id="input-hora_inicio" name="hora_inicio" placeholder="Hora Inicio" value="">
            </label>
        </section>
        <section class="col col-md-3" >
            <label class="text-info" >Fecha Fin (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                <input type="text" id="input-fecha_fin" name="fecha_fin" placeholder="Fecha Fin" class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Hora fin (HH:MM:SS)</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                   <input type="text" id="input-hora_fin" name="hora_fin" placeholder="Hora Fin" value="">
            </label>
        </section>
    </div>

    <div class="row">
       
        <section class="col col-md-12">
            <label class="text-info" >Condiciones</label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#collapse_competencias"><i class="fa fa-hand-o-up"></i> Click Aquí para editar</button>

            <div id="collapse_competencias" class="collapse">
                <label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
                    <textarea rows="5" id="input-condiciones" name="condiciones_ckeditor" placeholder=""></textarea> 
                </label>
            </div>
        </section>

        

    </div>

    <div class="row">
        <section class="col col-md-6">

            <label class="text-info" >Agregar Archivo</label>
            <div class="input input-file" id="archivo_perfiles_modal">

                <span class="button"><input  type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo" readonly="">

            </div>

        </section>

        <section class="col col-md-6">

            <label class="text-info" >Agregar Imagen (600 x 400 px)</label>
            <div class="input input-file" id="imagen_perfiles_modal">

                <label class="input">

                    <span class="button"><input type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-image" name="input-file"  placeholder="Agregar Imagen" readonly="">
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

