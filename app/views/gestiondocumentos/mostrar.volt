<div id="ribbon">

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Gestion Documentos</li>
        <li>Mostrar</li>
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
                                <!-- <span class="widget-icon"><i class="fa fa-book"></i></span> -->
                                <center>
                                    <h2><strong>{{ documentos.descripcion}}</strong></h2>
                                </center>
                            </header>



                            <div>
                                <div class="jarviswidget-editbox">
                                    <input class="form-control" type="text">
                                </div>
                                <div class="widget-body">
                                    {% if documentos.referencia_enlace != "#" or documentos.referencia_enlace != ""  %}
                                    <center><h5><i class="fa fa-book"></i> <a style="color: #000000; text-decoration: none;" href="{{ url('adminpanel/archivos/resoluciones/'~documentos.referencia_enlace) }}" target="_blank"> Aprobado con: {{ documentos.referencia }} </a></h5></center>
                                    {% endif %}
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                
                                                <embed src="{{ url('adminpanel/archivos/documentos/'~documentos.archivo) }}"
                                                    width=845 height=1080>
                                            </div>
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
</div>