

<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Mantenimientos</li><li>Registrar Prestamo Recursos</li>
    </ol>
</div>
<!-- END RIBBON -->     


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">     
        <div class="col-sm-12">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-md-6 col-md-offset-3">   
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"    
                             data-widget-custombutton="false"
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-laptop"></i> </span>
                                <h2>Formulario de Prestamos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('prestamosrecursos/save','method': 'post','id':'form_prestamosrecursos','class':'smart-form') }}
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-4">

                                                <button type="button" style="width:100%; height:30px;" class="btn btn-success" id="open_modalusuarios">
                                                    <i class="fa fa-search"></i> Buscar
                                                </button>
                                            </section>
                                            <section class="col col-8">


                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text" id="input-nombres" name="nombres" placeholder="Selecione Usuario" value="" >
                                                </label>
                                                <input type="hidden" id="input-apellidop" name="apellidop" value="">
                                                <input type="hidden" id="input-codigo" name="codigo" value="">
                                                <input type="hidden" id="input-perfil" name="perfil" value="">

                                            </section>



                                        </div>

                                        <div class="row">
                                            <section class="col col-4">

                                                <button type="button" style="width:100%; height:30px;" class="btn btn-warning" id="open_modalrecursos">
                                                    <i class="fa fa-plus"></i> Añadir recurso
                                                </button>
                                            </section>
                                            <section class="col col-8">


                                                <label class="input"> <i class="icon-prepend fa fa-desktop"></i>
                                                    <input type="text"id="input-descripcion" name="descripcion" placeholder="Selecione Recurso" value="" >
                                                </label>
                                                <input type="hidden" id="input-serie" name="serie" value="">
                                                <input type="hidden" id="input-recurso_id" name="recurso_id" value="">
                                                <input type="hidden" id="input-estado" name="estado" value="">


                                            </section>


                                        </div>


                                        <div class="row">
                                            <section class="col col-4">
                                                
                                            </section>
                                            <section class="col col-8">

                                                <label class="input"> <i class="icon-prepend fa fa-clock-o"></i>
                                                    <input type="text"id="input-hora_entrada" name="hora_entrada" placeholder="Hora entrada (Hora: Minutos) " value="" >
                                                </label>

                                            </section>



                                            <!--
                                            <section class="col col-6">

                                               <label class="input"> <i class="icon-prepend fa fa-clock-o"></i>
                                                   <input type="text"id="input-hora_salida" name="hora_salida" placeholder="Hora salida (Hora: Minutos) " value="" >
                                               </label>

                                           </section>
                                            -->


                                        </div>



                                    </fieldset>
                                    <footer>
                                        <button id="publicar" type="button" class="btn btn-primary">
                                            Publicar Ahora
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
    </div>  
</div>


<div id="modalusuarios" style="display: none;">
    <table  id="tbl_lectores" class="table tablecuriosity table-striped table-bordered table-hover" width="100%" >
        <thead>
            <tr>

                <th><center><i class="fa fa-check-circle"></i></center></th>
        <th>Nombres</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Tipo de usuario</th>
        <th>Codigo Usuario</th>

        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>



<div id="modalrecursos" style="display: none;">
    <table  id="tbl_recursos" class="table tablecuriosity table-striped table-bordered table-hover" width="100%" >
        <thead>
            <tr>

                <th><center><i class="fa fa-check-circle"></i></center></th>
        <th>Descripcion</th>
        <th>Modelo</th>
        <th>Color</th>
        <th>Serie</th>
        <th>Estado</th>


        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>



