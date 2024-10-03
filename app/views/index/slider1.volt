
<div style ="margin-top: -58px;"><!-- REVOLUTION SLIDER -->
    <div class="slider fullwidthbanner-container roundedcorners">
        <!--
                Navigation Styles:
                
                        data-navigationStyle="" theme default navigation
                        
                        data-navigationStyle="preview1"
                        data-navigationStyle="preview2"
                        data-navigationStyle="preview3"
                        data-navigationStyle="preview4"
                        
                Bottom Shadows
                        data-shadow="1"
                        data-shadow="2"
                        data-shadow="3"
                        
                Slider Height (do not use on fullscreen mode)
                        data-height="300"
                        data-height="350"
                        data-height="400"
                        data-height="450"
                        data-height="500"
                        data-height="550"
                        data-height="600"
                        data-height="650"
                        data-height="700"
                        data-height="750"
                        data-height="800"
        -->
        <div class="fullwidthbanner" data-height="500" data-shadow="0" data-navigationStyle="preview2">
            <ul class="hide">


                <!-- SLIDE  -->
                {% for slider in sliders %}
                    <li data-transition="random" data-slotamount="1" data-masterspeed="1000" data-saveperformance="off" data-title="Slide 2">

                        <img src="webpage/assets/images/_smarty/1x1.png" data-lazyload="{{ url('adminpanel/imagenes/imagenes_sliders/'~slider.imagen) }}" alt="" data-bgfit="cover" data-bgposition="center bottom" data-bgrepeat="no-repeat" />

                        <div class="overlay dark-2"><!-- dark overlay [1 to 9 opacity] --></div>

                        <div class="tp-caption customin ltl tp-resizeme large_bold_white"
                             data-x="center"
                             data-y="30"
                             data-customin="x:0;y:150;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                             data-speed="800"
                             data-start="1200"
                             data-easing="easeOutQuad"
                             data-splitin="none"
                             data-splitout="none"
                             data-elementdelay="0.01"
                             data-endelementdelay="0.1"
                             data-endspeed="1000"
                             data-endeasing="Power4.easeIn" style="z-index: 10;font-size: 20px; text-shadow:5px 4px 6px black;">
                            {{ slider.texto_principal}}
                        </div>

                        <div class="tp-caption customin ltl tp-resizeme large_bold_white"
                             data-x="center"
                             data-y="220"
                             data-customin="x:0;y:150;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                             data-speed="800"
                             data-start="1200"
                             data-easing="easeOutQuad"
                             data-splitin="none"
                             data-splitout="none"
                             data-elementdelay="0.01"
                             data-endelementdelay="0.1"
                             data-endspeed="1000"
                             data-endeasing="Power4.easeIn" style="z-index: 10;font-size: 45px; text-shadow:5px 4px 6px black;">
                            {{ slider.texto_1}}
                        </div>

                        <div class="tp-caption customin ltl tp-resizeme large_bold_white"
                             data-x="center"
                             data-y="270"
                             data-customin="x:0;y:150;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                             data-speed="800"
                             data-start="1200"
                             data-easing="easeOutQuad"
                             data-splitin="none"
                             data-splitout="none"
                             data-elementdelay="0.01"
                             data-endelementdelay="0.1"
                             data-endspeed="1000"
                             data-endeasing="Power4.easeIn" style="z-index: 10;font-size: 20px; text-shadow:5px 4px 6px black;">
                            {{ slider.texto_2}}
                        </div>

                        <div class="tp-caption customin ltl tp-resizeme"
                             data-x="center"
                             data-y="380"
                             data-customin="x:0;y:150;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                             data-speed="800"
                             data-start="1550"
                             data-easing="easeOutQuad"
                             data-splitin="none"
                             data-splitout="none"
                             data-elementdelay="0.01"
                             data-endelementdelay="0.1"
                             data-endspeed="1000"
                             data-endeasing="Power4.easeIn" style="z-index: 10;">
                            <a href="{{ slider.enlace}}" class="btn btn-block btn-raised btn-primary" style="font-weight: bold;">
                                <span>Leer mas ...</span> 
                            </a>
                        </div>

                    </li>

                {% endfor %}



            </ul>
            <div class="tp-bannertimer"><!-- progress bar --></div>
        </div>
    </div>
</div>
    <!-- /REVOLUTION SLIDER -->