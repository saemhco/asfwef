

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Mantenimientos</li><li>Registrar Prestamo</li>
    </ol>
</div>
<!-- END RIBBON -->     


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">     
        <div class="col-sm-12">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-md-10 col-md-offset-1">   
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
                                <h2>Formulario de Prestamos</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('prestamos/save','method': 'post','id':'form_prestamos','class':'smart-form') }}
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-2">

                                                <button type="button" style="width:120px; height:30px;" class="btn btn-success" id="open_modallectores">
                                                    <i class="fa fa-search"></i> Buscar Lector
                                                </button>
                                            </section>
                                            <section class="col col-4">


                                                <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                    <input type="text"id="input-nombres" name="titulo" placeholder="Lector" value="" >
                                                </label>

                                                <input type="hidden" id="input-codigo" name="codigo" value="{{ codigo }}">
                                                <input type="hidden" id="input-codigos" name="codigos" value="">
                                                <input type="hidden" id="input-perfil" name="perfil" value="">

                                            </section>

                                            <section class="col col-3" >

                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_entrega" name="fecha_entrega" placeholder="Fecha de Entrega" class="datepicker" data-dateformat='dd/mm/yy' value="">
                                                </label>


                                            </section>
                                            <section class="col col-3">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_devolucion" name="fecha_devolucion" placeholder="Fecha devolucion" class="datepicker" data-dateformat='dd/mm/yy' value="">
                                                </label>
                                            </section>



                                        </div>

                                        <div class="row">




                                            <section class="col col-2">

                                                <button type="button" style="width:120px; height:30px;" class="btn btn-warning" id="open_modallibros">
                                                    <i class="fa fa-plus"></i> Añadir Libro
                                                </button>
                                            </section>

                                        </div>



                                        <div class="col-md-12" >
                                            <div class="col-md-12" >
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="8">Lista de Libros Prestados</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Código</th>
                                                            <th>N° ISBN</th>
                                                            <th>Título</th>
                                                            <th>Acciones</i></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody-contratos">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>



                                    </fieldset>
                                    <footer>
                                        <button id="publicar" type="button" class="btn btn-primary">
                                           Registrar Prestamo
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


<div id="modallectores">
    <table  id="tbl_lectores" class="table tablecuriosity table-striped table-bordered table-hover" width="100%" >
        <thead>
            <tr>

                <th><center><i class="fa fa-check-circle"></i></center></th>
        <th>Nombres</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Tipo de lector</th>
        <th>Codigo Lector</th>

        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>



<div id="modallibros">
    <table  id="tbl_libros" class="table tablecuriosity table-striped table-bordered table-hover" width="100%" >
        <thead>
            <tr>

                <th><center><i class="fa fa-check-circle"></i></center></th>
    <th>Código</th>
        <th>Titulo</th>
        <th>Categoria</th>



        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>



