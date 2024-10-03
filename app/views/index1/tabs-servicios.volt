<div class="card card-warning">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-tabs-transparent indicator-danger nav-tabs-full nav-tabs-3" role="tablist">
        <li class="nav-item"><a class="nav-link withoutripple active" href="#Servicios" aria-controls="Servicios" role="tab" data-toggle="tab"><i class="zmdi zmdi-reader"></i> <span class="d-none d-sm-inline">Servicios</span></a></li>        
        <li class="nav-item"><a class="nav-link withoutripple" href="#Ambientes" aria-controls="Ambientes" role="tab" data-toggle="tab"><i class="zmdi zmdi-calendar"></i> <span class="d-none d-sm-inline">Ambientes</span></a></li>
        
    </ul>

    <div class="card-body">
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active show" id="Servicios">
                <?php $this->partial('index/servicios'); ?>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="Ambientes">
                <?php $this->partial('index/ambientes'); ?>
            </div>  
        </div>
    </div>
</div> <!-- card -->