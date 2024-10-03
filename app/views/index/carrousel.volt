<div class="col-lg-12">
    <div class="owl-carousel owl-theme">
        {% for enlace in enlaces %}             
                <div class="card card-danger">
                    <a class="img-hover" target="_blank" href="{{ enlace.url}}">
                        {{ image("adminpanel/imagenes/enlaces/"~enlace.imagen, "width":"140", "height":"140") }}
                    </a>
                </div>
        {% endfor %}
    </div>
    {#<div class="owl-dots"></div>#}
</div>