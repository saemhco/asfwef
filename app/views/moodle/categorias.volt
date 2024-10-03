<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Moodle</li><li>Catgroias / Cursos</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">

       
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
                        <a href="javascript:void(0);" onclick="agregar()" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar()" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>

                        <a href="javascript:void(0);" onclick="eliminar()" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

                        <a href="javascript:void(0);" onclick="migrar()" class="btn btn-info btn-block"><i class="fa fa-refresh"></i></a>
                        
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
                                    <span class="widget-icon"> <i class="fa fa-laptop"></i> </span>
                                    <h2>Registro de Categorias</h2>
                                </header>

                                <div>
                                    <div class="jarviswidget-editbox">										
                                        <input class="form-control" type="text">	
                                    </div>										
                                    <div class="widget-body no-padding">										

                                        <table id="tbl_categorias" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                            <thead>			                
                                                <tr>
                                                    <th><center><i class="fa fa-check-circle"></i></center></th>
                                                    <th data-class="expand"> ID</th>
                                                    <th> Categoria</th>
                                                    <th data-hide="phone,tablet"> IdMoodle</th>
                                                </tr>
                                            </thead>
                                            <tbody>				
                                            </tbody>
                                        </table>				
                                    </div>		
                                </div>
                            </div>	
                        </article>	
                    </div>
                </section>
            	
        </div>	
    </div>

 </div>   


{{ form('moodle/saveCategoria','method': 'post','id':'form_categorias','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                 <input type="text" id="input-idnumber" name="idnumber" placeholder="Codigo">
            </label>
        </section>
        <section class="col col-md-12">
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                 <input type="text" id="input-name" name="name" placeholder="Nombre" >
                 <input type="hidden" id="input-id" name="id" value="">
            </label>
        </section>
    </div>
</fieldset>
{{ endForm() }}