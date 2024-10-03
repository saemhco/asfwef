
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Proceso de Admision</li>
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
                                <span class="widget-icon"> <i class="fa fa-graduation-cap"></i> </span>
                                <h2>PROCESO DE ADMISIÓN - {{admision_m.descripcion}} </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										


                                <table class="table table-sm table-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                    <center>DATOS DEL POSTULANTE</center>
                                    </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="15%"><strong>CÓDIGO:</strong></td>
                                            <td width="30%">{{ postulante.codigo }}</td>
                                            <td width="15%"><strong>NRO. DOC. </strong></td>
                                            <td width="40%">{{ postulante.nro_doc }}</td>
                                        </tr>
                                        <tr>
                                            <td width="15%"><strong>APELLIDOS:</strong></td>
                                            <td width="30%">{{ postulante.apellidop }} {{ postulante.apellidom }}</td>
                                            <td width="15%"><strong>NOMBRES:</strong></td>
                                            <td width="40%">{{ postulante.nombres }}</td>
                                        </tr>
                                        <tr>
                                            <td width="15%"><strong>TIPO DE COLEGIO:  </strong></td>
                                            <td width="30%">{% if postulante.colegio_publico == 1   %} PUBLICO {% elseif(postulante.colegio_publico == 0) %} PRIVADO {% endif %}</td>
                                            <td width="15%"><strong>NOMBRE DE COLEGIO:</strong></td>
                                            <td width="40%">{{ postulante.colegio_nombre }}</td>
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
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Información de Registro</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    {{ form('registropostulantes/saveInscripcion','method': 'post','id':'form_admisionproceso','class':'smart-form','enctype':'multipart/form-data') }}


                                    <fieldset>

                                        <div class="row">

                                            <section class="col col-md-4" >
                                                <label class="text-info" >Fecha de Inscripción (DD/MM/AAAA)</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input_fecha_inscripcion" name="fecha_inscripcion" placeholder="" {#class="datepicker"#} data-dateformat='dd/mm/yy' value="{{ fecha_actual }}" readonly>

                                                    <input type="hidden" id="input_postulante" name="postulante" value="{{ postulante.codigo }}">
                                                    {#<input type="hidden" id="input_semestre" name="semestre" value="{{semestre_admision.codigo}}">#}
                                                    <input type="hidden" id="input_admision" name="admision" value="{{admision_m.codigo}}">

                                                </label>
                                            </section>

                                            <section class="col col-md-4">

                                                <label class="text-info" >Modalidad Admisión
                                                </label>
                                                <label class="select">
                                                    <select id="input_modalidad"  name="modalidad" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for modalidad_select in modalidad %}

                                                            <option value="{{ modalidad_select.codigo }}">{{ modalidad_select.nombres }}</option>   

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>



                                            <section class="col col-md-4">

                                                <label class="text-info" >Tipo de Inscripción
                                                </label>
                                                <label class="select">
                                                    <select id="input_tipo_inscripcion"  name="tipo_inscripcion" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for tipo_select in tipo %}

                                                            <option value="{{ tipo_select.codigo }}">{{ tipo_select.nombres }}</option>   

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-8">

                                                <label class="text-info" >Concepto
                                                </label>
                                                <label class="select">
                                                    <select id="input_concepto"  name="concepto" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for concepto_select in conceptos %}

                                                            <option value="{{ concepto_select.codigo }}">{{ concepto_select.descripcion }}</option>   

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>



                                            <section class="col col-md-4">
                                                <label class="text-info" >Monto</label>
                                                <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                    <input type="text" id="input_monto" name="monto" placeholder="" value="">

                                                </label>
                                            </section>

                                            <section class="col col-md-6">
                                                <label class="text-info" >Nro de Voucher</label>
                                                <label class="input"> <i class="icon-prepend fa fa-list-ol"></i>
                                                    <input type="text" id="input_recibo" name="recibo" placeholder="" value="">

                                                </label>
                                            </section>
                                        </div> 
                                    </fieldset>

                                    <header>
                                        {{ config.global.xCarreraIns }}
                                    </header>



                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-6">

                                                <label class="text-info" >Primera Opción
                                                </label>
                                                <label class="select">
                                                    <select id="input_carrera1"  name="carrera1" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for carreras_select in carreras %}

                                                            <option value="{{ carreras_select.codigo }}">{{ carreras_select.descripcion }}</option>   

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-6">

                                                <label class="text-info" >Segunda Opción
                                                </label>
                                                <label class="select">
                                                    <select id="input_carrera2"  name="carrera2" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for carreras_select in carreras %}

                                                            <option value="{{ carreras_select.codigo }}">{{ carreras_select.descripcion }}</option>   

                                                        {% endfor %}
                                                    </select> <i></i>
                                                </label>
                                            </section>

                                            <section class="col col-md-6" >

                                                <div class="input input-file">
                                                    <label class="text-info" >Agregar Imagen Voucher (.png o .jpg)</label>
                                                    <label class="input">
                                                        <input id="file_imagen" type="file" name="file_imagen" onchange="this.parentNode.nextSibling.value = this.value">
                                                        <input type="hidden" id="input_imagen" name="imagen" value="">
                                                    </label>
                                                </div>
                                            </section>

                                        </div> 
                                    </fieldset>
                                    <footer>
                                        <button id="save" type="button" class="btn btn-primary">
                                            Guardar
                                        </button>
                                        {#             <a href="javascript:history.back()"  type="button" class="btn btn-default" >
                                                         Volver
                                                     </a>#}

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


<div class="hidden">
    <div id="success">
        <p>
            Se registró correctamente su postulación...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="warning">
        <p>
            Está seguro que desea inscribirse para el examen de admisión?...
        </p>
    </div>
</div>



<script type="text/javascript" >
    var id = "";

    {% if id is defined %}
        id = {{ id }};
    {% endif %}



        //alert("Hola");
</script>