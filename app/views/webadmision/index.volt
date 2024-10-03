{% block content %}



{% if  config.global.xAbrevIns  == 'UNCA'  %}
    <?php $this->partial('index/content-comunicados'); ?>
    <?php //$this->partial('index/tabs-noticias'); ?>    
    <?php //$this->partial('index/tabs-eventos'); ?>
    <?php $this->partial('index/tabs-servicios'); ?>
    <?php //$this->partial('index/modal'); ?>
    
{% endif %}



{% endblock %}