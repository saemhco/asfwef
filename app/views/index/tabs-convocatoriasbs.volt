<div class="card">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-tabs-transparent indicator-success nav-tabs-full nav-tabs-3" role="tablist">
        <li class="nav-item"><a class="nav-link withoutripple active" href="#cservicios" aria-controls="cservicios" role="tab" data-toggle="tab"><i class="zmdi zmdi-account"></i> <span class="d-none d-sm-inline">Convocatorias Servicios</span></a></li>
        <li class="nav-item"><a class="nav-link withoutripple" href="#cbienes" aria-controls="cbienes" role="tab" data-toggle="tab"><i class="zmdi zmdi-account"></i> <span class="d-none d-sm-inline">Concurso Bienes</span></a></li>        
    </ul>

    <div class="card-body">
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active show" id="cservicios">
                <?php $this->partial('index/convocatoria_servicios'); ?>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="cbienes">
                <?php $this->partial('index/convocatoria_bienes'); ?>
            </div>
            
                        
        </div>
    </div>
</div> <!-- card -->