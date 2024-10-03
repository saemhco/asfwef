<style>
   .dataTables_filter input { width: 335px !important; }
</style>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registro</li><li>Voucher</li>
    </ol>
</div>
<!-- END RIBBON -->


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-sm-12" style="margin-bottom: -30px;">
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
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Enviar Bases </h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body no-padding">
                                    {{ form('gestionconvocatorias/EnviarBases','method': 'post','id':'form_voucher_docente_documento','class':'smart-form','enctype':'multipart/form-data') }}
                                    <fieldset>
            <div class="row">
                   <section class="col col-md-12">
                        <label class="text-info" >Solicitud de inscripción y postulación al concurso público(Anexo N° 03)</label>
                        <label class="input">
                                            <input id="solicitudinscripcion" type="file" name="solicitudinscripcion" onchange="this.parentNode.nextSibling.value = this.value">
                                        </label>
                    </section>
                </div>
            <div class="row">
                   <section class="col col-md-12">
                        <label class="text-info" >Bases del concurso público</label>
                        <label class="input">
                                            <input id="baseconcurso" type="file" name="baseconcurso" onchange="this.parentNode.nextSibling.value = this.value">
                                        </label>
                    </section>
                </div>
            <div class="row">
                   <section class="col col-md-12">
                        <label class="text-info" >Formato de Declaración Jurada de no tener impedimentos y veracidad de la información (Anexo N° 02)</label>
                        <label class="input">
                                            <input id="declaracionjurada" type="file" name="declaracionjurada" onchange="this.parentNode.nextSibling.value = this.value">
                                        </label>
                    </section>
                </div>
            <div class="row">
                   <section class="col col-md-12">
                        <label class="text-info" >Formato de Declaración Jurada de Uso de Derecho por Primera Vez de la Bonificación por ser Personal Licenciado de las Fuerzas Armadas (Anexo N° 06)</label>
                        <label class="input">
                                            <input id="declaracionjuradafa" type="file" name="declaracionjuradafa" onchange="this.parentNode.nextSibling.value = this.value">
                                        </label>
                    </section>
                </div>
            <input type="hidden" id="idvoucher" name="idvoucher" value="{{ idvoucher }}">
        </div>
    </fieldset>
<footer>
    <a href="javascript:history.back()"  type="button" class="btn btn-default" >
                                                Volver
                                            </a>
    <button id="publicar" type="button" class="btn btn-primary">
        Enviar Bases
    </button>

</footer>

{{ endForm() }}
    </div>
</div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>