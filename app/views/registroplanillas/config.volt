
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Gestion Planillas</li><li>Configuración de Planillas</li>
    </ol>
</div>
<!-- END RIBBON -->		


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">


        <div class="col-md-12">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget" id="wid-id-11" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false">

                            <header>
                                <h2><strong>CONFIGURACION DE TIPO DE PLANILLA (INGRESOS - DESCUENTOS - APORTES) </strong></h2>	
                            </header>

                            <!-- widget div-->
                            <div>
                                <form id="form-config"  method="POST">
                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->

                                </div>
                                <!-- end widget edit box -->
                                
                                <!-- widget content -->
                                <div class="widget-body no-padding">

                                    <!-- widget body text-->
                                        <div class="row" >
                                            <div class="col col-md-12" >  

                                                <table class="table table-sm table-primary table-bordered" style=";margin-bottom:0px !important;">
                                                   
                                                    <tr>
                                                            <th colspan="8">
                                                            <center> TIPO DE PLANILLA : <strong>{{ tipoplanilla.nombre }}</strong> </center>
                                                            <input type="hidden" name="tipoplanilla" value="{{ tipoplanilla.codigo }}"> 
                                                         </th>
                                                    </tr>
                                                   
                                                </table>
                                                <table class="table table-sm table-primary table-bordered" style="font-size: 10px !important;margin-bottom:0px !important;">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="3">
                                                                <center>PARÁMETROS DE CONFIGURACIÓN</center>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="3">
                                                                <center>

                                                                        {% set check = "" %}
                                                                        {% if nuevo == 1 %}
                                                                            {% if config["afecta_afp"] == 1 %}
                                                                                {% set check = "checked='checked'" %}
                                                                            {% else %}
                                                                                {% set check = "" %}
                                                                            {% endif %}
                                                                        {% endif %}
                                                                        
                                                                        <strong style="margin-top:4px !important;">AFECTA AFP</strong>
                                                                    
                                                                        <input type="checkbox" name="afecta_afp" value="1" id="input-afecta_afp" {{ check }} >
                                                                        <i></i>
                                                                    
                                                                </center>
                                                            </th>
                                                        </tr>  
                                                 
                                                        <tr>
                                                            <th>
                                                                <center>INGRESOS</center>
                                                            </th>
                                                            <th>
                                                                <center>DESCUENTOS</center>
                                                            </th>
                                                            <th>
                                                                <center>APORTES</center>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <!-- Ingresos -->
                                                                <table class="tabletable-sm table-primary table-bordered" style="font-size: 10px !important;" width="100%" >
                                                                    <thead>
                                                                        <tr>
                                                                            <td width="75%">
                                                                                <input type="text" id="ingresos" class="form-control input-xs"
                                                                                placeholder="Etiqueta"
                                                                                
                                                                                 name="">
                                                                            </td>
                                                                             <td width="20%">
                                                                                <input type="text" id="factor-ingreso" class="form-control input-xs" 
                                                                                placeholder="Factor" 
                                                                                
                                                                                name="">
                                                                            </td>
                                                                            <td width="5%" >
                                                                                <button type="button" id="btn-ingresos" class="btn btn-xs btn-primary"  >
                                                                                    <i class="fa fa-plus" ></i>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                                <br>
                                                                 <!-- Ingresos -->
                                                                <table class="tabletable-sm table-primary table-bordered" style="font-size: 10px !important;margin-bottom:0px !important;" width="100%" >
                                                                    <thead>
                                                                        <tr>
                                                                            <td width="5%" >
                                                                                N°
                                                                            </td>
                                                                            <td width="70%">
                                                                                ETIQUETA
                                                                            </td>
                                                                            <td width="20%">
                                                                               FACTOR
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="llena-ingresos" >
                                                                    {% if nuevo == 1 %}
                                                                    {% set enum_r = 0 %}
                                                                    {% for i in 1..10 %}
                                                                        {%  set etq = "ing"~i~"_desc" %}
                                                                        {%  set factor = "ing"~i~"_factor" %}
                                                                        {% if config[etq] %}
                                                                            {% set enum_r += 1 %}
                                                                            <tr>
                                                                                <td class='orden'>{{ enum_r }}</td>
                                                                                <td><input type='text' class='form-control input-xs' name='ingresos-etq[]' value='{{ config[etq] }}' >
                                                                                <td><input type='text' class='form-control input-xs' name='ingresos-factor[]' value='{{ config[factor] }}' ></td>
                                                                            </tr>   
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                    {% endif %}
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <!-- Descuentos -->
                                                               <table class="tabletable-sm table-primary table-bordered" style="font-size: 10px !important;" width="100%" >    <thead>
                                                                        <tr>
                                                                            <td width="75%">
                                                                                <input type="text" id="descuentos" class="form-control input-xs"
                                                                                placeholder="Etiqueta"
                                                                                
                                                                                 name="">
                                                                            </td>
                                                                             <td width="20%">
                                                                                <input type="text" id="factor-descuento" class="form-control input-xs" 
                                                                                placeholder="Factor" 
                                                                                
                                                                                name="">
                                                                            </td>
                                                                            <td width="5%" >
                                                                                <button class="btn btn-xs btn-primary" id="btn-descuentos" type="button" >
                                                                                    <i class="fa fa-plus" ></i>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    </thead>
                                                                   
                                                                </table>
                                                                <br>
                                                                <table class="tabletable-sm table-primary table-bordered" style="font-size: 10px !important;margin-bottom:0px !important;" width="100%" >
                                                                    <thead>
                                                                        <tr>
                                                                            <td width="5%" >
                                                                                N°
                                                                            </td>
                                                                            <td width="70%">
                                                                                ETIQUETA
                                                                            </td>
                                                                            <td width="20%">
                                                                               FACTOR
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="llena-descuentos" >
                                                                    {% if nuevo == 1 %}
                                                                    {% set enum_r = 0 %}
                                                                    {% for i in 1..20 %}
                                                                        {%  set etq = "desc"~i~"_desc" %}
                                                                        {%  set factor = "desc"~i~"_factor" %}
                                                                        {% if config[etq] %}
                                                                            {% set enum_r += 1 %}
                                                                            <tr>
                                                                                <td class='orden'>{{ enum_r }}</td>
                                                                                <td><input type='text' class='form-control input-xs' name='descuentos-etq[]' value='{{ config[etq] }}' >
                                                                                <td><input type='text' class='form-control input-xs' name='descuentos-factor[]' value='{{ config[factor] }}' ></td>
                                                                            </tr>   
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                    {% endif %}
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <!-- Aportes -->
                                                                <table class="tabletable-sm table-primary table-bordered" style="font-size: 10px !important;margin-bottom:0px !important;" width="100%" >
                                                                    <thead>
                                                                        <tr>
                                                                            <td width="75%">
                                                                                <input type="text" id="aportes" class="form-control input-xs"
                                                                                placeholder="Etiqueta"
                                                                                
                                                                                 name="">
                                                                            </td>
                                                                             <td width="20%">
                                                                                <input type="text" id="factor-aporte" class="form-control input-xs" 
                                                                                placeholder="Factor" 
                                                                                
                                                                                name="">
                                                                            </td>
                                                                            <td width="5%" >
                                                                                <button 
                                                                                id="btn-aportes"
                                                                                type="button" 
                                                                                class="btn btn-xs btn-primary" >
                                                                                    <i class="fa fa-plus" ></i>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    </thead>
                                                                    
                                                                </table>
                                                                 <br>
                                                                <table class="tabletable-sm table-primary table-bordered" style="font-size: 10px !important;margin-bottom:0px !important;" width="100%" >
                                                                    <thead>
                                                                        <tr>
                                                                            <td width="5%" >
                                                                                N°
                                                                            </td>
                                                                            <td width="70%">
                                                                                ETIQUETA
                                                                            </td>
                                                                            <td width="20%">
                                                                               FACTOR
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="llena-aportes" >
                                                                    {% if nuevo == 1 %}
                                                                    {% set enum_r = 0 %}
                                                                    {% for i in 1..5 %}
                                                                        {%  set etq = "ap"~i~"_desc" %}
                                                                        {%  set factor = "ap"~i~"_factor" %}
                                                                        {% if config[etq] %}
                                                                            {% set enum_r += 1 %}
                                                                            <tr>
                                                                                <td class='orden'>{{ enum_r }}</td>
                                                                                <td><input type='text' class='form-control input-xs' name='aportes-etq[]' value='{{ config[etq] }}' >
                                                                                <td><input type='text' class='form-control input-xs' name='aportes-factor[]' value='{{ config[factor] }}' ></td>
                                                                            </tr>   
                                                                        {% endif %}
                                                                    {% endfor %}
                                                                    {% endif %}
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                                <table class="table table-sm table-primary table-bordered" style="font-size: 10px !important;margin-bottom:0px !important;">
                                                    <thead>
                                                                        <tr>
                                                                            <th width="50%">
                                                                                CUARTA CATEGORIA
                                                                            </th>
                                                                            <th width="50%">
                                                                                QUINTA CATEGORIA
                                                                            </th>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="llena-descuentos" >
                                                                    {% set cuarta = "" %}
                                                                    {% set quinta = "" %}
                                                                    {% if nuevo == 1 %}
                                                                        {% set cuarta = config["cuarta_cat"] %}
                                                                        {% set quinta = config["quinta_cat"] %}
                                                                    {% endif %}
                                                                    <tr>
                                                                                
                                                                        <td><input type='text' class='form-control input-xs' name='cuarta_cat' value='{{ cuarta }}' >
                                                                        <td><input type='text' class='form-control input-xs' name='quinta_cat' value='{{ quinta }}' ></td>
                                                                    </tr>
                                                                    </tbody>
                                                </table>
                                                <table class="table">
                                                   
                                                       
                                                    <tr>
                                                        <td  class="text-center">
                                                            <a role="button" href="javascript:history.back()" class="btn btn-info" ><i class="fa fa-chevron-left" ></i> Regresar</a>
                                                            <button type="button" id="btn-guarda"  class="btn btn-info" ><i class="fa fa-save" ></i> Guardar</button>
                                                        </td>
                                                    </tr>   
                                                </table>
                                            </div>
                                        </div>

                                 

                                </div>
                                <!-- end widget content -->
                                </form>
                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end widget -->	
                    </article>	
                </div>
            </section>
        </div>			
    </div>	
</div>


