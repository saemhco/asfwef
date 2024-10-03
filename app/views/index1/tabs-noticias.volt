

<div class="card card-warning">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-tabs-transparent indicator-warning nav-tabs-full nav-tabs-4" role="tablist">
        <li class="nav-item"><a class="nav-link withoutripple active" href="#Noticias" aria-controls="Noticias" role="tab" data-toggle="tab"><i class="zmdi zmdi-reader"></i> <span class="d-none d-sm-inline">Noticias</span></a></li>
        <li class="nav-item"><a class="nav-link withoutripple" href="#Boletines" aria-controls="Boletines" role="tab" data-toggle="tab"><i class="zmdi zmdi-calendar"></i> <span class="d-none d-sm-inline">Boletines</span></a></li>
        <li class="nav-item"><a class="nav-link withoutripple" href="#Eventos" aria-controls="Eventos" role="tab" data-toggle="tab"><i class="zmdi zmdi-calendar"></i> <span class="d-none d-sm-inline">Eventos</span></a></li>
        <li class="nav-item"><a class="nav-link withoutripple" href="#Videos" aria-controls="Videos" role="tab" data-toggle="tab"><i class="zmdi zmdi-youtube"></i> <span class="d-none d-sm-inline">Videos</span></a></li>
    </ul>

    <div class="card-body">
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active show" id="Noticias">
                <?php $this->partial('index/noticias'); ?>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="Boletines">
                <?php $this->partial('index/boletines'); ?>
            </div> 
            <div role="tabpanel" class="tab-pane fade" id="Eventos">
                <?php $this->partial('index/eventos'); ?>
            </div> 
            <div role="tabpanel" class="tab-pane fade" id="Videos">
                <?php $this->partial('index/videos'); ?>
            </div> 
        </div>
    </div>
</div> <!-- card -->