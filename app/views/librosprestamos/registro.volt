

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Mantenimientos</li><li>Registrar Préstamo</li>
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
                                <span class="widget-icon"> <i class="fa fa-user-plus"></i> </span>
                                <h2>Datos del Lector </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										


                                <table class="table table-sm table-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="10%">
                                    <center>TIPO</center>
                                    </th>
                                    <th width="10%">
                                    <center>CÓDIGO</center>
                                    </th>
                                    <th>
                                    <center>APELLIDOS Y NOMBRES</center>
                                    </th>

                                    <th width="10%">
                                    <center>BUSCAR</center>
                                    </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="vertical-align: middle;text-align: center;"><strong id="lector_perfil"</strong></td>
                                            <td style="vertical-align: middle;text-align: center;"><strong id="lector_codigos"</strong></td>
                                            <td style="vertical-align: middle;text-align: center;"><strong id="lector_nombres"></strong></td>

                                            <td>
                                    <center>
                                        <button type="button"  class="btn btn-sm btn-success" id="open_modallectores">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </center>
                                    </td>
                                    </tr>
                                    </tbody>
                                </table>


                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>
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
                                <h2>Registros de Libros a prestar</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">

                                    {{ form('librosprestamos/save','method': 'post','id':'form_prestamos','class':'smart-form') }}                                    
                                    <fieldset>
                                        <div class="row">


                                            <section class="col col-2">

                                                <button type="button" class="btn btn-sm  btn-block btn-warning" id="open_modallibros">
                                                    <i class="fa fa-plus"></i> Añadir Libros
                                                </button>
                                            </section>
                                            <section class="col col-1" id="error_insert_libros">
                                               
                                            </section>


                                            <section class="col col-md-2">
                                                <label class="select">
                                                    MODALIDAD
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="select">
                                                    <select id="input-tipo"  name="tipo" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for tipo_prestamo in tipoprestamos %}

                                                            <option value="{{ tipo_prestamo.codigo }}">{{ tipo_prestamo.nombres }}</option>   


                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-2">
                                                <label class="select">
                                                    FECHA DE PRÉSTAMO
                                                </label>
                                            </section>

                                            <section class="col col-2">
                                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_devolucion" name="fecha_devolucion" placeholder="Fecha devolucion" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_actual }}">
                                                    <input type="hidden" id="input-codigo" name="id_libro_prestamo" value="">
                                                    <input type="hidden" id="input-codigos" name="codigos" value="">
                                                    <input type="hidden" id="input-perfil" name="perfil" value="">
                                                </label>
                                            </section>



                                        </div>




                                        <div class="col-md-12" >

                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="5"><center>LISTA DE LIBROS A PRESTAR</center></th>
                                                    </tr>
                                                    <tr>
                                                        <th width="10%"><center>CODIGO</center></th>
                                                    <th  width="20%"><center>ISBN</center></th>
                                                    <th><center>TÍTULO</center></th>
                                                    <th width="10%"><center>NÚMERO</center></th>
                                                    <th width="10%"><center>ACCIONES</center></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tbody-libros">

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </fieldset>
                                    <footer>
                                        <button id="publicar" type="button" class="btn btn-primary">
                                            Registrar Préstamo
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

        <th width="10%">Tipo</th>
        <th width="10%">Código</th>
        <th>Apellidos y Nombres</th>

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
        <th width="10%">Código</th>
        <th>Titulo</th>
        <th>Número</th>
        <th width="20%">Categoria</th>

        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>



