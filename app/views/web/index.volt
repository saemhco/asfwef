{% block content %}
{% if  config.global.xAbrevIns  == 'UNCA'  %}
    <?php $this->partial('index/content-academico'); ?>
    <?php $this->partial('index/tabs-noticias'); ?>    
    <?php $this->partial('index/tabs-eventos'); ?>
    <?php //$this->partial('index/tabs-servicios'); ?>
    <?php //$this->partial('index/content-imagen'); ?>        
    <?php $this->partial('index/content-convocatorias'); ?>
    <?php $this->partial('index/content-convocatoriasbs'); ?>
    <?php //$this->partial('index/tabs-destacados'); ?>
    <?php //$this->partial('index/content-accesos'); ?>
    <?php $this->partial('index/tabs-carrousel'); ?>
    <?php $this->partial('index/modal'); ?>
{% endif %}
{% endblock %}