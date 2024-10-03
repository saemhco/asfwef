<div
	style="margin-top: -10px;">
	<!-- REVOLUTION SLIDER -->
	<div class="slider fullwidthbanner-container roundedcorners">
		<div class="fullwidthbanner" data-height="730" data-shadow="0" data-navigationstyle="preview2">
			<ul
				class="hide">
				<!-- SLIDE  -->
				{% for slider in sliders %}
					<li data-transition="random" data-slotamount="1" data-masterspeed="1000" data-saveperformance="off" data-title="">
						<div style="width: 100%;">
							<img style=" width: 100%;background-position: center;object-fit: cover;" src="webpage/assets/images/_smarty/1x1.png" data-lazyload="{{ url('adminpanel/imagenes/sliders/'~slider.imagen) }}" alt="" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat"/>
						</div>
						<div class="overlay dark-2"><!-- dark overlay [1 to 9 opacity] --></div>

						<div class="tp-caption customin ltl tp-resizeme large_bold_white" data-x="center" data-y="30" data-customin="x:0;y:150;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;" data-speed="800" data-start="1200" data-easing="easeOutQuad" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.1" data-endspeed="1000" data-endeasing="Power4.easeIn" style="z-index: 10;font-size: 20px; text-shadow:5px 4px 6px black;">
							{{ slider.texto_principal}}
						</div>

						<div class="tp-caption customin ltl tp-resizeme large_bold_white" data-x="center" data-y="220" data-customin="x:0;y:150;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;" data-speed="800" data-start="1200" data-easing="easeOutQuad" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.1" data-endspeed="1000" data-endeasing="Power4.easeIn" style="z-index: 10;font-size: 45px; text-shadow:5px 4px 6px black;">
							{{ slider.texto_1}}
						</div>

						<div class="tp-caption customin ltl tp-resizeme large_bold_white" data-x="center" data-y="270" data-customin="x:0;y:150;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;" data-speed="800" data-start="1200" data-easing="easeOutQuad" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.1" data-endspeed="1000" data-endeasing="Power4.easeIn" style="z-index: 10;font-size: 20px; text-shadow:5px 4px 6px black;">
							{{ slider.texto_2}}
						</div>

						<div class="tp-caption customin ltl tp-resizeme" data-x="center" data-y="380" data-customin="x:0;y:150;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;" data-speed="800" data-start="1550" data-easing="easeOutQuad" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.1" data-endspeed="1000" data-endeasing="Power4.easeIn" style="z-index: 10;">
							<a target="_blank" href="{{ slider.enlace}}" class="btn btn-block btn-raised btn-primary" style="font-weight: bold;">
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
