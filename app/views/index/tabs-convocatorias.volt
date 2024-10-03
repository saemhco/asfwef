<div class="card">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-tabs-transparent indicator-success nav-tabs-full nav-tabs-3" role="tablist">
        
        
        
        <li class="nav-item"><a class="nav-link withoutripple active" href="#cas" aria-controls="cas" role="tab" data-toggle="tab"><i class="zmdi zmdi-account"></i> <span class="d-none d-sm-inline">Convocatorias CAS</span></a></li>
        <li class="nav-item"><a class="nav-link withoutripple" href="#docentes" aria-controls="docentes" role="tab" data-toggle="tab"><i class="zmdi zmdi-account"></i> <span class="d-none d-sm-inline">Concurso Docentes</span></a></li>
        <li class="nav-item"><a class="nav-link withoutripple" href="#proyectos" aria-controls="proyectos" role="tab" data-toggle="tab"><i class="zmdi zmdi-account"></i> <span class="d-none d-sm-inline">Concurso de Proyectos</span></a></li>
        
    </ul>

    <div class="card-body">
        <!-- Tab panes -->
        <div class="tab-content">
           
            <div role="tabpanel" class="tab-pane fade active show" id="cas">
                <?php $this->partial('index/convocatoria_cas'); ?>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="docentes">
                <?php $this->partial('index/convocatoria_docentes'); ?>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="proyectos">
                <?php $this->partial('index/convocatoria_proyectos'); ?>
            </div>
            
        </div>
    </div>
</div> <!-- card -->