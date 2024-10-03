<p/>

    <div class="row d-flex justify-content-center">
        {% for video in videos %} 
            <div class="col-lg-3 col-md-6">
                <div class="card card-light-inverse">
                    <div class="withripple zoom-img" style="margin-top: 30px;">
                        <div class="responsive-video md-margin-bottom-40">
                                <iframe width="100%" src="//www.youtube.com/embed/{{ video.youtube}}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="card-body" style="margin-top: -15px;">
                        <h6 class="color-primary"><p>{{ video.titular}}</p></h6>
                        <p class="text-center">                    
                            <a target="_blank" href="https://www.youtube.com/watch?v={{ video.youtube}}" class="btn btn-danger btn-raised text-right" role="button">
                                <i class="zmdi zmdi-collection-image-o"></i><span>Ver en Youtube</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        {% endfor %}
    </div>
    <center>
        <a href="videos.html" class="btn btn-danger btn-raised text-right" role="button">
            <i class="fa fa-mail-forward"></i>
            <span>Videos anteriores</span>
        </a>
    </center>