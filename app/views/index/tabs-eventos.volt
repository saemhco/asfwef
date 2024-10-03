<!--
<div class="card card-warning" >
-->
<div class="card-body" style="background: white;" >
    <!-- Nav tabs 
    <ul class="nav nav-tabs nav-tabs-transparent indicator-warning nav-tabs-full nav-tabs-3" role="tablist">
        <li class="nav-item"><a class="nav-link withoutripple active" href="#Noticias" aria-controls="Noticias" role="tab" data-toggle="tab"><i class="zmdi zmdi-reader"></i> <span class="d-none d-sm-inline">Noticias</span></a></li>
    </ul>
    -->

    <div class="text-center mb-4">
        <p style="font-size: 25px;">PRÓXIMOS</p>            
        <p style="font-size: 30px; color: #326ab7;">EVENTOS</p>            
        </p>
    </div>
    
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active show" id="Noticias">
                <?php $this->partial('index/eventos'); ?>
            </div>
        </div>
    
</div> <!-- card -->
