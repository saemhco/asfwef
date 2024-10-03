
<div class="col-lg-12">
    <div class="owl-carousel owl-theme" {#style="width: 1090px;"#}>
        {% for enlace in enlaces %}             

                <div class="card card-danger">
                    <a class="img-hover" target="_blank" href="{{ enlace.url}}">
                        {{ image("adminpanel/imagenes/imagenes_enlaces/"~enlace.imagen, "class":"img-fluid", "alt":"") }}
                    </a>
                </div>
            {% endfor %}
        
    </div>
    {#<div class="owl-dots"></div>#}
</div>