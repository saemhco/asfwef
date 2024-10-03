<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Proceso de Admision</li>
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
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-graduation-cap"></i> </span>
                                <h2>PROCESO DE INSCRIPCIÓN - {{admision_m.descripcion}} </h2>
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
                                            <td width="15%"><strong>APELLIDOS Y NOMBRES:</strong></td>
                                            <td width="30%">{{ postulante.apellidop }} {{ postulante.apellidom }} {{
                                                postulante.nombres }}</td>
                                            <td width="15%"><strong>ARCHIVO DNI: </strong></td>
                                            <td width="40%">{% if postulante.archivo == "" %} NO {%
                                                elseif(postulante.archivo !== "") %} SI {% endif %}</td>
                                        </tr>

                                        <tr>
                                            <td width="15%"><strong>TIPO DE INSTITUCIÓN: </strong></td>
                                            <td width="30%">{% if postulante.tipo_institucion == 1 %} PUBLICO {%
                                                elseif(postulante.tipo_institucion == 2) %} PRIVADO {% endif %}</td>
                                            <td width="15%"><strong>UNIVERSIDAD:</strong></td>
                                            <td width="40%">{{ postulante.institucion }}</td>
                                        </tr>

                                        <tr>
                                            <td width="15%"><strong>CATEGORÍA:</strong></td>
                                            <td width="30%">
                                                {% for categoriapostulante_table in categoriapostulante %}
                                                {% if categoriapostulante_table.codigo == postulante.categoria %}
                                                {{categoriapostulante_table.nombres }}
                                                {% endif %}
                                                {% endfor %}
                                            </td>
                                            <td width="15%"><strong>ESCUELA / FACULTAD: </strong></td>
                                            <td width="40%">{{ postulante.escuela }}</td>
                                        </tr>

                                        <tr>
                                            <td width="15%"><strong>FOTO: </strong></td>
                                            <td width="30%">{% if postulante.foto == "" %} NO {%
                                                elseif(postulante.foto !== "") %} SI {% endif %}</td>
                                            <td width="15%"><strong>ARCHIVO CONSTANCIA: </strong></td>
                                            <td width="40%">{% if postulante.archivo_escuela == "" %} NO {%
                                                elseif(postulante.archivo_escuela !== "") %} SI {% endif %}</td>
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
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Informacion de Registro</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    {{ form('registropostulantesa/insertInscripcionReservada','method':
                                    'post','id':'form_admisionproceso','class':'smart-form','enctype':'multipart/form-data')
                                    }}

                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-3">
                                                <label class="text-info">Nro. de Voucher / Nro. Operación</label>
                                                <label class="input"> <i class="icon-prepend fa fa-list-ol"></i>
                                                    <input type="text" id="input_recibo" name="recibo" placeholder=""
                                                        value="{{admision.recibo}}">

                                                </label>
                                            </section>
                                            <section class="col col-md-3">
                                                <label class="text-info">Monto Cancelado</label>
                                                <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                    <input type="text" id="input_monto" name="monto" placeholder=""
                                                        value="{{admision.monto}}">

                                                </label>
                                            </section>



                                            <section class="col col-md-5">
                                                <div class="input input-file">
                                                    <label class="text-info">Agregar Imagen del Voucher de Pago (TIpo de
                                                        archivo: jpg, png o jpeg)</label>
                                                    <label class="input">
                                                        <input id="file_imagen" type="file" name="file_imagen"
                                                            onchange="this.parentNode.nextSibling.value = this.value">
                                                        <input type="hidden" id="input-imagen" name="input-imagen" value="">
                                                    </label>
                                                </div>
                                                <input type="hidden" id="input_postulante" name="postulante"
                                                    value="{{ postulante.codigo }}">
                                                <input type="hidden" id="input_admision" name="admision"
                                                    value="{{admision_m.codigo}}">
                                            </section>

                                        </div>
                                    </fieldset>
                                    <footer>
                                        <button id="save" type="button" class="btn btn-primary">
                                            Registrar Reserva
                                        </button>
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

{{ form('','method': 'post','id':'modal_imagen_tasa_lugar_pago','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <center>
                <img class="img-responsive" src=""
                error="this.onerror=null;this.src='';" id="input-lugar_pago"></img>
            </center>
        </section>
    </div>
</fieldset>
{{ endForm() }}

{{ form('','method': 'post','id':'modal_voucher','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
   
                <center>
                    <img class="img-responsive" src="{{ url('adminpanel/imagenes/admision/'~admision.imagen) }}"></img>
                </center>
    
        </section>
    </div>
</fieldset>
{{ endForm() }}

<div class="hidden">
    <div id="success">
        <p>
            Se registró correctamente su postulacion...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="warning">
        <p>
            ¿Está seguro que desea inscribirse para el examen de admision ENAE?...
        </p>
    </div>
</div>

<div class="hidden">
    <div id="waringFiles">
        <p>
            Por favor cargar los archivos requeridos en su Registro...
        </p>
    </div>
</div>

<script type="text/javascript">
    var id = "";

    {% if id is defined %}
    id = {{ id }};
    {% endif %}
</script>

<script type="text/javascript">
    var foto = "{{ postulante.foto }}";
    var archivo = "{{ postulante.archivo }}";
    var archivo_escuela = "{{ postulante.archivo }}";

    console.log("Foto:" + foto);
    console.log("Archivo:" + archivo);
    console.log("Archivo Escuela:" + archivo_escuela);

</script>