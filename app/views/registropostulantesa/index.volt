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
                                <h2>PROCESO DE ADMISION - {{admision_m.descripcion}} </h2>
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
                                            <td width="30%">{{ postulante.apellidop }} {{ postulante.apellidom }} {{ postulante.nombres }}</td>
                                            <td width="15%"><strong>TIPO DE INSTITUCIÓN: </strong></td>
                                            <td width="30%">{% if postulante.colegio_publico == 1 %} PUBLICO {%
                                                elseif(postulante.colegio_publico == 0) %} PRIVADO {% endif %}</td>
                                        </tr>

                                        <tr>
                                            <td width="15%"><strong>INSTITUCIÓN:</strong></td>
                                            <td width="40%">{{ postulante.institucion }}</td>
                                            <td width="15%"><strong>ESCUELA / FACULTAD: </strong></td>
                                            <td width="30%">{{ postulante.escuela }}</td>
                                        </tr>

                                        <tr>
                                            <td width="15%"><strong>CATEGORÍA:</strong></td>
                                            <td width="40%">
                                                {% for categoriapostulante_table in categoriapostulante %}
                                                {% if categoriapostulante_table.codigo == postulante.categoria %}
                                                {{categoriapostulante_table.nombres }}
                                                {% endif %}
                                                {% endfor %}
                                            </td>
                                            <td width="15%"><strong>PROCESO: </strong></td>
                                            <td width="30%">{{ postulante.proceso }}</td>
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

                                    {{ form('registropostulantesa/saveInscripcion','method':
                                    'post','id':'form_admisionproceso','class':'smart-form','enctype':'multipart/form-data')
                                    }}

                                    <fieldset>
                                        <div class="row">

                                            <section class="col col-md-12">
                                                <div class="center">
                                                    <img class="img-responsive"
                                                        src="{{ url('adminpanel/imagenes/admision/admision.jpg') }}"
                                                        error="this.onerror=null;this.src='';"></img>
                                                </div>

                                            </section>

                                            <section class="col col-md-12">
                                                <div class="input input-file">
                                                    <label class="text-info">Agregar Imagen Voucher (.png o
                                                        .jpg)</label>
                                                    <label class="input">
                                                        <input id="file_imagen" type="file" name="file_imagen"
                                                            onchange="this.parentNode.nextSibling.value = this.value">
                                                        <input type="hidden" id="input_imagen" name="imagen" value="">
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
                                            Guardar
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
            Está seguro que desea inscribirse para el examen de admision?...
        </p>
    </div>
</div>



<script type="text/javascript">
    var id = "";

    {% if id is defined %}
    id = {{ id }};
    {% endif %}
</script>