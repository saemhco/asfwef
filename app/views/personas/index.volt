<style>
    .dataTables_filter input { width: 335px !important; }
 </style>
 <div id="ribbon">
 
     <!-- breadcrumb -->
     <ol class="breadcrumb">
         <li>Panel</li><li>Persona</li>
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
                         <a href="javascript:void(0);" onclick="agregar()" class="btn btn-primary btn-block"><i class="fa fa-plus"></i></a>
 
                         <a href="javascript:void(0);" onclick="editar()" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
 
                         <a href="javascript:void(0);" onclick="eliminar()" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

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
                                 <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                                 <h2>Registros de Personas</h2>
                             </header>
 
                             <div>
                                 <div class="jarviswidget-editbox">										
                                     <input class="form-control" type="text">	
                                 </div>										
                                 <div class="widget-body no-padding">										
 
                                     <table id="tbl_personas" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                         <thead>			                
                                             <tr>
                                                 <th><center><i class="fa fa-check-circle"></i></center></th>                                               
                                         <th>Nombre</th>			
                                         <th>Email</th>			
                                         <th>Telefono</th>			
                                         <th>Estado</th>			
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
 
 {{ form('personas/save','method': 'post','id':'form_personas','class':'smart-form','style':'display:none;') }}
 <fieldset>
     <div class="row">
         <section class="col col-md-12">
             <label class="input"> <i class="icon-prepend fa fa-user"></i>
                 <input type="text" id="input-nombre" name="nombre" placeholder="Nombre Completo" >
                 <input type="hidden" id="input-id" name="id" value="">
             </label>
         </section>
         <section class="col col-md-12">
            <label class="input"> <i class="icon-prepend fa fa-envelope-o"></i>
                <input type="text" id="input-email" name="email" placeholder="Email" >
            </label>
        </section>
        <section class="col col-md-12">
            <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                <input type="text" id="input-telefono" name="telefono" placeholder="Telefono" >
            </label>
        </section>
     </div>   
 </fieldset>
 {{ endForm() }}