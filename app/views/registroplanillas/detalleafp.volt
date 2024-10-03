<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Gestion Planillas</li><li>Afp</li>
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
                                <h2>AFP - {{ afp.nombre }}</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_afp_detalle" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th><center><i class="fa fa-check-circle"></i></center></th> 
                                                <th data-class="expand">PERIODO</th>
                                                <th data-class="expand">APORTE</th>
                                                <th data-class="expand">PRIMA</th>
                                                <th data-class="expand">CSR</th>
                                                <th data-hide="phone,tablet">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>				
                                        </tbody>
                                    </table>
                                    <a role="button" href="javascript:history.back()" class="btn btn-info" ><i class="fa fa-chevron-left" ></i> Regresar</a>				
                                </div>		
                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>			
    </div>	
</div>

{{ form('gestionplanillas/saveDetalleAfp','method': 'post','id':'form_afp_detalle','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >PERIODO</label>
            <label class="select">
                <select id="input-periodo"  name="periodo" >
                    <option value="" >SELECCIONE...</option>
                    {% for c in periodos %}                    
                        <option value="{{ c.codigo }}">{{ c.periodo }}</option>  
                    {% endfor %}
                </select> <i></i>
            </label>
            <input type="hidden" id="input-codigo" name="codigo" value="">
            <input type="hidden" id="input-afp" name="afp" value="{{ afp.codigo }}">
        </section>

        <section class="col col-md-12">
            <label class="text-info" >APORTE</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-aporte" name="aporte" placeholder="" >
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >PRIMA</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-prima" name="prima" placeholder="" >
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >CSR</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-csr" name="csr" placeholder="" >
            </label>
        </section>

        <section class="col col-md-2">
            <label class="text-info" >Estado</label>
            <label class="checkbox">
                <input type="checkbox" name="estado" value="" id="input-estado">
                <i></i>
            </label>
        </section>
        
    </div>    
</fieldset>
{{ endForm() }}

<script type="text/javascript">
    var afp_pk = "{{ afp.codigo }}";
</script>