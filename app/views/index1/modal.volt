<!-- Modal -->
<div class="modal modal-primary" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog animated zoomIn animated-3x" role="document">
        <div class="modal-content">

            <div class="modal-body" style="padding:10px 10px 1px 10px;">
                <div class="card card-primary">
                    <div id="carousel-example-generic2" class="ms-carousel carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic2" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic2" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic2" data-slide-to="2"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            {% for modal in modales %}    

                                    <div class="carousel-item {% if modal.orden === modal_ultimo  %}active{% endif %}">
                                        <div class="card-header">
                                            <h3 class="card-title"> {{ modal.titulo }}</h3>
                                        </div>
                                        <div style="padding:10px 30px 1px 30px;">
                                                    
                                            {% if modal.esimagen == "A"   %}        
                                                        <center><a href="{{ modal.enlace }}" target="_blank">{{ image("adminpanel/imagenes/imagenes_modales/"~modal.imagen, "class":"img-fluid", "alt":"") }}</a></center>
                                            {%  elseif(modal.esimagen == "X") %}
                                                    <h3> {{ modal.subtitulo }}</h3>                                                    
                                                    <h4> {{ modal.descripcion }}</h4>
                                            {% endif %}
                                            
                                            <center>
                                                <button type="button" class="btn btn-danger btn-raised text-center" data-dismiss="modal" id="boton_cerrar_modal">Cerrar</button>
                                                <a href="{{ modal.enlace }}" target="_blank"><button type="button" class="btn btn-primary btn-raised text-center">Ver mas ... </button></a>  
                                            </center>
                                        </div>
                                    </div>
 
                            {% endfor %}
                        </div>
                        <!-- Controls -->

                        <a href="#carousel-example-generic2" class="btn-circle btn-circle-xs btn-circle-raised btn-circle-white color-primary left carousel-control-prev" role="button" data-slide="prev"><i class="zmdi zmdi-chevron-left"></i></a>
                        <a href="#carousel-example-generic2" class="btn-circle btn-circle-xs btn-circle-raised btn-circle-white color-primary right carousel-control-next" role="button" data-slide="next"><i class="zmdi zmdi-chevron-right"></i></a>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
