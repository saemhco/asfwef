

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li>
        <li>Registrar Preguntas </li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false"
                data-widget-custombutton="false" data-widget-sortable="false">
                <header class="">
                    <center style="margin-top: -5px !important;">
                        <span class="widget-icon">Opciones</span>
                    </center>
                </header>
                <div>
                    <div class="jarviswidget-editbox">

                    </div>
                    <div class="widget-body text-center">
                        <a href="{{ url('registroencuestas/registropreguntas') }}" class="btn btn-primary btn-block"><i
                            class="fa fa-plus"></i></a>

                        <a href="javascript:void(0);" onclick="editar();" class="btn btn-warning btn-block"><i
                                class="fa fa-edit"></i></a>
                        {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i
                                class="fa fa-eye"></i></a> #}
                        <a href="javascript:void(0);" onclick="eliminar();" class="btn btn-danger btn-block"><i
                                class="fa fa-trash"></i></a>

                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-11" style="margin-bottom: -30px;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                            data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                            data-widget-colorbutton="false" data-widget-custombutton="false"
                            data-widget-sortable="false" data-widget-togglebutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Registro de Preguntas</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">

                                    <table id="tbl_enc_encuestas_preguntas"
                                        class="table tablecuriosity table-striped table-bordered table-hover"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center><i class="fa fa-check-circle"></i></center>
                                                </th>

                                                <th data-class="expand">Tipo de pregunta</th>
                                                <th data-hide="phone,tablet">Tipo de respuesta</th>
                                                <th data-hide="phone,tablet">Numero</th>
                                                <th data-hide="phone,tablet">Descripcion</th>
                                                <th data-hide="phone,tablet">Estado</th>



                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <footer>
                                        <a href="{{ url('registroencuestas') }}" role="button" class="btn tbn-block btn-primary" ><i class="fa fa-chevron-left" ></i>&nbsp;&nbsp;&nbsp;Volver</a>
                                    </footer>	
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
</div>



{{ form('registroencuestas/saveEncuestasPreguntas','method':
'post','id':'form_tbl_enc_encuestas_preguntas','class':'smart-form','enctype':'multipart/form-data','style':'display:none;')
}}
<fieldset>
    <div class="row">

        <section class="col col-md-12">
            <label class="text-info">Tipo de preguntas</label>
            <label class="select">
                <select id="input-ep-id_tipo_pregunta" name="id_tipo_pregunta">
                    <option value="">Seleccione...</option>
                    {% for tipopreguntas_select in tipopreguntas %}
                    <option value="{{ tipopreguntas_select.codigo }}">{{ tipopreguntas_select.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Tipo de respuesta</label>
            <label class="select">
                <select id="input-ep-id_tipo_respuesta" name="id_tipo_respuesta">
                    <option value="">Seleccione...</option>
                    {% for tiporespuesta_select in tiporespuestas %}
                    <option value="{{ tiporespuesta_select.codigo }}">{{ tiporespuesta_select.nombres }}</option>
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info">Numero</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-ep-numero" name="numero" placeholder="Numero">
                <input type="hidden" id="input-ep-id_encuesta_pregunta" name="id_encuesta_pregunta" value="">
                <input type="hidden" id="input-ep-id_encuesta" name="id_encuesta" value="{{ id_encuesta }}">
            </label>
        </section>


        <section class="col col-md-12">
            <label class="text-info">Descripción</label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                <textarea rows="3" id="input-ep-descripcion" name="descripcion" placeholder=""></textarea>
            </label>
        </section>


    </div>
</fieldset>
{{ endForm() }}

<script type="text/javascript">
    var publica = "si";
    var id_encuesta = "{{id_encuesta}}";
    console.log(id_encuesta);
</script>