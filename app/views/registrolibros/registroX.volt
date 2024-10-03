{% set id_libro = "" %}
{% set titulo = "" %}



{% set editorial_libro = "" %}
{% set categoria_libro = "" %}
{% set idioma_libro = "" %}

{% set fecha_publicacion = "" %}
{% set cantidad_ejemplares = "" %}

{% set tipolibro_libro = "" %}
{% set codigo_barra = "" %}
{% set codigo = "" %}
{% set isbn = "" %}
{% set anio_publicacion = "" %}
{% set paginas = "" %}
{% set lugar_publicacion = "" %}
{% set ubicacion = "" %}
{% set edicion = "" %}

{% set programa_1 = "" %}
{% set programa_2 = "" %}
{% set programa_3 = "" %}
{% set programa_4 = "" %}
{% set programa_5 = "" %}
{% set programa_6 = "" %}

{% set autor_1 = "" %}
{% set autor_2 = "" %}
{% set autor_3 = "" %}


{% if libros.titulo is defined %}
    {% set titulo = libros.titulo %}
{% endif %}





{% if libros.editorial is defined %}
    {% set editorial_libro = libros.editorial %}
{% endif %}

{% if libros.categoria is defined %}
    {% set categoria_libro = libros.categoria %}
{% endif %}

{% if libros.idioma is defined %}
    {% set idioma_libro = libros.idioma %}
{% endif %}

{% if libros.tipo_material_bibliografico is defined %}
    {% set tipo_material_bibliografico = libros.tipo_material_bibliografico %}
{% endif %}


{% if libros.fecha_publicacion is defined %}
    {% set fecha_publicacion = utilidades.fechita(libros.fecha_publicacion,'d/m/Y') %}
{% endif %}

{% if libros.cantidad_ejemplares is defined %}
    {% set cantidad_ejemplares = libros.cantidad_ejemplares %}
{% endif %}

{% if libros.codigo_barra is defined %}
    {% set codigo_barra = libros.codigo_barra %}
{% endif %}

{% if libros.codigo is defined %}
    {% set codigo = libros.codigo %}
{% endif %}

{% if libros.isbn is defined %}
    {% set isbn = libros.isbn %}
{% endif %}

{% if libros.anio_publicacion is defined %}
    {% set anio_publicacion = libros.anio_publicacion %}
{% endif %}

{% if libros.lugar_publicacion is defined %}
    {% set lugar_publicacion = libros.lugar_publicacion %}
{% endif %}

{% if libros.ubicacion is defined %}
    {% set ubicacion = libros.ubicacion %}
{% endif %}

{% if libros.edicion is defined %}
    {% set edicion = libros.edicion %}
{% endif %}


{% if libros.paginas is defined %}
    {% set paginas = libros.paginas %}
{% endif %}

{% if libros.programa_1 is defined %}
    {% set programa_1 = libros.programa_1 %}
{% endif %}

{% if libros.programa_2 is defined %}
    {% set programa_2 = libros.programa_2 %}
{% endif %}


{% if libros.programa_3 is defined %}
    {% set programa_3 = libros.programa_3 %}
{% endif %}


{% if libros.programa_3 is defined %}
    {% set programa_3 = libros.programa_3 %}
{% endif %}

{% if libros.programa_4 is defined %}
    {% set programa_4 = libros.programa_4 %}
{% endif %}

{% if libros.programa_5 is defined %}
    {% set programa_5 = libros.programa_5 %}
{% endif %}

{% if libros.programa_6 is defined %}
    {% set programa_6 = libros.programa_6 %}
{% endif %}


{% if libros.autor_1 is defined %}
    {% set autor_1 = libros.autor_1 %}
{% endif %}

{% if libros.autor_2 is defined %}
    {% set autor_2 = libros.autor_2 %}
{% endif %}

{% if libros.autor_3 is defined %}
    {% set autor_3 = libros.autor_3 %}
{% endif %}

{% set txt_buton = "Guardar" %}
{% if libros.id_libro is defined %}
    {% set id_libro = libros.id_libro %}
    {% set txt_buton = "Actualizar" %}
{% endif %}

{% set imagen = "" %}
{% if libros.imagen is defined %}
    {% set imagen = libros.imagen %}
{% endif %}

{% set resumen = "" %}
{% if libros.resumen is defined %}
    {% set resumen = libros.resumen %}
{% endif %}

{% set archivo = "" %}
{% if libros.archivo is defined %}
{% set archivo = libros.archivo %}
{% endif %}

{% set imagen = "" %}
{% if libros.imagen is defined %}
{% set imagen = libros.imagen %}
{% endif %}

<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registrar Libros</li>
    </ol>
</div>
<!-- END RIBBON -->     


<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">     
        <div class="col-sm-12">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"    
                             data-widget-custombutton="false"
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Registro de Libro</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('registrolibros/save','method': 'post','id':'form_libros','class':'smart-form','enctype':'multipart/form-data') }}

                                    <header>
                                        Identificación del Libro
                                    </header>

                                    <fieldset>

                                        <div class="row">
                                            <section class="col col-md-3">
                                                <label class="text-info" >Codigo de Libro</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-codigo" name="codigo" placeholder="codigo del Libro" value="{{ codigo }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >ISBN</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-isbn" name="isbn" placeholder="ISBN" value="{{ isbn }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Codigo de Barras</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-codigo_barra" name="codigo_barra" placeholder="codigo de barras" value="{{ codigo_barra }}" >

                                                </label>
                                            </section>

                                            {% if libros.estado is defined %}
                                                <section class="col col-md-3">
                                                    <label class="text-info" >Correlativo</label>
                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                        <input type="text" id="input-id_libro" name="id_libro" placeholder="Codigo" value="{{ id_libro }}" readonly>

                                                    </label>
                                                </section>
                                            {% endif %}

                                            <section class="col col-md-12">
                                                <label class="text-info" >Nombre del Libro</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-titulo" name="titulo" placeholder="Título del Libro" value="{{ titulo }}" >

                                                </label>
                                            </section>


                                        </div> 
                                    </fieldset>
                                    <header style="margin-top: -10px;">
                                        Información General del Libro
                                    </header>
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="text-info" >Imagen del Libro</label>





                                                <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_alumno"><i class="fa fa-hand-o-up"></i> Click Aquí para mostrar Imagen</button>

                                                <div id="imagen_alumno" class="collapse">

                                                    {% if imagen !== ""   %}
                                                    <center>
                                                        <img width="150" height="150" src="{{ url('adminpanel/imagenes/libros/'~imagen) }}" onerror="this.onerror=null;this.src='{{ url('adminpanel/img/avatars/book_green.png') }}';"></img>
                                                    </center>
                                                    {% else %}

                                                        <div class="alert alert-warning fade in">                                                       
                                                            <i class="fa-fw fa fa-warning"></i>
                                                            <strong>Pendiente</strong> Aun no ha subido una imagen.
                                                        </div>

                                                    {% endif %}
                                                </div>
                                            </section>


                                            <section class="col col-md-4">
                                                <label class="text-info" >Categoria</label>
                                                <label class="select">
                                                    <select id="input-categoria"  name="categoria" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for categoria in categorias %}
                                                            {% if categoria.codigo == categoria_libro %}
                                                                <option selected="selected" value="{{ categoria.codigo }}">{{ categoria.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ categoria.codigo }}">{{ categoria.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Idioma</label>
                                                <label class="select">
                                                    <select id="input-idioma"  name="idioma" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for idioma in idiomas %}
                                                            {% if idioma.codigo == idioma_libro %}
                                                                <option selected="selected" value="{{ idioma.codigo}}">{{ idioma.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ idioma.codigo }}">{{ idioma.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-3">
                                                <label class="text-info" >Autor 1</label>
                                                {#<label class="select">#}
                                                <select id="input-autor_1"  name="autor_1" style="width:100%">
                                                    <option value="" >SELECCIONE...</option>
                                                    {% for autoruno in autor_uno %}
                                                        {% if autoruno.id_autor == autor_1 %}
                                                            <option selected="selected" value="{{ autoruno.id_autor }}">{{ autoruno.descripcion }}</option>   
                                                        {% else %}
                                                            <option value="{{ autoruno.id_autor }}">{{ autoruno.descripcion }}</option>   
                                                        {% endif %}

                                                    {% endfor %}
                                                </select>
                                                <p id="input-autor_1_select"></p>
                                                {#</label>#}
                                            </section>

                                            <section class="col col-md-1">
                                                <label class="text-info" >Agregar</label>
                                                <label class="input">
                                                    <a href="javascript:void(0);" onclick="agregar_autor();" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i></a>
                                                </label>
                                            </section>





                                            <section class="col col-md-4">
                                                <label class="text-info" >Autor 2</label>
                                                {#<label class="select">#}
                                                <select id="input-autor_2"  name="autor_2" style="width:100%">
                                                    <option value="" >SELECCIONE...</option>
                                                    {% for autordos in autor_dos %}
                                                        {% if autordos.id_autor == autor_2 %}
                                                            <option selected="selected" value="{{ autordos.id_autor }}">{{ autordos.descripcion }}</option>   
                                                        {% else %}
                                                            <option value="{{ autordos.id_autor }}">{{ autordos.descripcion }}</option>   
                                                        {% endif %}

                                                    {% endfor %}
                                                </select> <i></i>
                                                {#</label>#}
                                            </section>



                                            <section class="col col-md-4">
                                                <label class="text-info" >Autor 3</label>
                                                {#<label class="select">#}
                                                <select id="input-autor_3"  name="autor_3" style="width:100%">
                                                    <option value="" >SELECCIONE...</option>
                                                    {% for autortres in autor_tres %}
                                                        {% if autortres.id_autor == autor_3 %}
                                                            <option selected="selected" value="{{ autortres.id_autor }}">{{ autortres.descripcion }}</option>   
                                                        {% else %}
                                                            <option value="{{ autortres.id_autor }}">{{ autortres.descripcion }}</option>   
                                                        {% endif %}

                                                    {% endfor %}
                                                </select> <i></i>
                                                {#</label>#}
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-md-3">
                                                <label class="text-info" >Editorial</label>
                                                {#<label class="select">#}
                                                <select id="input-editorial"  name="editorial" style="width:100%">
                                                    <option value="" >SELECCIONE...</option>
                                                    {% for editorial in editoriales %}
                                                        {% if editorial.id_editorial == editorial_libro %}
                                                            <option selected="selected" value="{{ editorial.id_editorial }}">{{ editorial.descripcion }}</option>   
                                                        {% else %}
                                                            <option value="{{ editorial.id_editorial }}">{{ editorial.descripcion }}</option>   
                                                        {% endif %}

                                                    {% endfor %}
                                                </select>
                                                <p <p id="input-editorial_select"></p></p>
                                                {#</label>#}
                                            </section>

                                            <section class="col col-md-1">
                                                <label class="text-info" >Agregar</label>
                                                <label class="input">
                                                    <a href="javascript:void(0);" onclick="agregar_editorial();" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i></a>
                                                </label>
                                            </section>



                                            <section class="col col-md-4">
                                                <label class="text-info" >Fecha de Publicación</label>
                                                <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                    <input type="text" id="input-fecha_publicacion" name="fecha_publicacion" placeholder="Fecha de Ingreso" class="datepicker" data-dateformat='dd/mm/yy' value="{{ fecha_publicacion }}">
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Cantidad de ejemplares</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-cantidad_ejemplares" name="cantidad_ejemplares" placeholder="Cantidad de ejemplares" value="{{ cantidad_ejemplares }}" >

                                                </label>
                                            </section>
                                        </div> 
                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="text-info" >Tipo de Material Bibliográfico</label>
                                                <label class="select">
                                                    <select id="input-tipo_material_bibliografico"  name="tipo_material_bibliografico" >
                                                        <option value="" >SELECCIONE...</option>
                                                        {% for tipolibro_select in tipomaterialbibliograficos %}
                                                            {% if tipolibro_select.codigo == tipo_material_bibliografico %}
                                                                <option selected="selected" value="{{ tipolibro_select.codigo }}">{{ tipolibro_select.nombres }}</option>   
                                                            {% else %}
                                                                <option value="{{ tipolibro_select.codigo }}">{{ tipolibro_select.nombres }}</option>   
                                                            {% endif %}

                                                        {% endfor %}
                                                    </select> <i></i> 
                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Año de Publicación</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-anio_publicacion" name="anio_publicacion" placeholder="Año de publicacion" value="{{ anio_publicacion }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >Paginas</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-paginas" name="paginas" placeholder="Paginas" value="{{ paginas }}" >

                                                </label>
                                            </section>
                                        </div>
                                        <div class="row">
                                            <section class="col col-md-4">
                                                <label class="text-info" >Lugar de Publicación</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-lugar_publicacion" name="lugar_publicacion" placeholder="Lugar de publicacione" value="{{ lugar_publicacion }}">

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" >  Ubicación</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-ubicacion" name="ubicacion" placeholder="Ubicacion" value="{{ ubicacion }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-4">
                                                <label class="text-info" > Edición</label>
                                                <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                    <input type="text" id="input-edicion" name="edicion" placeholder="Edicion" value="{{ edicion }}" >

                                                </label>
                                            </section>

                                            <section class="col col-md-12">
                                                <label class="text-info" >Resumen</label>
                                                <label class="textarea"><i class="icon-append fa fa-comment"></i>                                     
                                                    <textarea rows="5" id="input-resumen" name="resumen" placeholder="Resumen">{{ resumen }}</textarea> 
                                                </label>
                                            </section>

                                        </div>
                                    </fieldset>

                                    <header style="margin-top: -10px;">
                                        Información programa libro
                                    </header>

                                    <fieldset>

                                        <div class="row">



                                            <section class="col col-md-4">
                                                <label class="checkbox">

                                                    {% if programa_1 == 1 %}
                                                        <input type="checkbox" name="programa_1" value="{{ programa_1 }}" id="programa_1" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="programa_1" value="{{ programa_1 }}" id="programa_1">
                                                    {% endif %}

                                                    <i></i>Programa 1



                                                </label>


                                            </section>
                                            <section class="col col-md-4">
                                                <label class="checkbox">

                                                    {% if programa_2 == 1 %}
                                                        <input type="checkbox" name="programa_2" value="{{ programa_2 }}" id="programa_2" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="programa_2" value="{{ programa_2 }}" id="programa_2">
                                                    {% endif %}

                                                    <i></i>Programa 2
                                                </label>


                                            </section>
                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if programa_3 == 1 %}
                                                        <input type="checkbox" name="programa_3" value="{{ programa_3 }}" id="programa_3" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="programa_3" value="{{ programa_3 }}" id="programa_3">
                                                    {% endif %}
                                                    <i></i>Programa 3</label>


                                            </section>
                                            <section class="col col-md-4">
                                                <label class="checkbox">

                                                    {% if programa_4 == 1 %}
                                                        <input type="checkbox" name="programa_4" value="{{ programa_4 }}" id="programa_4" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="programa_4" value="{{ programa_4 }}" id="programa_4">
                                                    {% endif %}

                                                    <i></i>Programa 4

                                                </label>


                                            </section>
                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if programa_5 == 1 %}
                                                        <input type="checkbox" name="programa_5" value="{{ programa_5 }}" id="programa_5" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="programa_5" value="{{ programa_5 }}" id="programa_5">
                                                    {% endif %}
                                                    <i></i>Programa 5</label>


                                            </section>

                                            <section class="col col-md-4">
                                                <label class="checkbox">
                                                    {% if programa_6 == 1 %}
                                                        <input type="checkbox" name="programa_6" value="{{ programa_6 }}" id="programa_6" checked> 
                                                    {% else %}
                                                        <input type="checkbox" name="programa_6" value="{{ programa_6 }}" id="programa_6">
                                                    {% endif %}
                                                    <i></i>Programa 6

                                                </label>


                                            </section>

                                            <section class="col col-md-12">
                                                <div class="input input-file" style="margin-top: 26px;">
                                                    <label class="text-info">Agregar Imagen (600x400 px)</label>
                                                    <label class="input">
                                                        <input id="imagen_libro" type="file" name="imagen_libro"
                                                            onchange="this.parentNode.nextSibling.value = this.value">
                                                    </label>
                                                </div>
                                            </section>

                                            <section class="col col-md-12">

                                               
                                                <div class="input input-file" style="margin-bottom: 5px;">
                                                    <label class="text-info">Agregar Archivo</label>    
                                                    <input type="file" id="archivo_libro" name="archivo_libro">
                                           
                                                </div>


                                                {% if archivo !== "" %}
                                                <div class="alert alert-success fade in">
                                                    Click aqui para ver el archivo
                                                    <a class="btn btn-ribbon" target="_BLANK" role="button"
                                                        href="{{ url('adminpanel/archivos/libros/'~archivo) }}"> <i
                                                            class="fa-fw fa fa-eye"></i></a>
                                                </div>
                                                {% else %}

                                                <div class="alert alert-warning fade in">
                                                    <i class="fa-fw fa fa-warning"></i>
                                                    <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                </div>

                                                {% endif %}

                                            </section>




                                        </div> 
                                    </fieldset>




                                    <footer>
                                        <button id="publicar" type="button" class="btn btn-primary">
                                            {{ txt_buton }}
                                        </button>
                                        <a href="javascript:history.back()"  type="button" class="btn btn-default" >
                                            Volver
                                        </a>

                                    </footer>
                                    {{ endForm() }}
                                </div>      
                            </div>
                        </div>  
                    </article>  
                </div>
            </section>
        </div>          
    </div>

    {% if id_libro !== "" %}
    <div class="row">

        <div class="col-sm-1" style="margin-right: -5px;margin-left: 5px;">
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">								
                <header class="">
                    <center style="margin-top: -5px !important;">
                        <span class="widget-icon">Opciones</span>
                    </center>
                </header>
                <div>
                    <div class="jarviswidget-editbox">								

                    </div>
                    <div class="widget-body text-center">
                        <a href="javascript:void(0);"  onclick="agregarEjemplar();" class="btn btn-primary btn-block"><i class="fa fa-plus">
                            <input type="hidden" id="id_libro" name="id_libro" value="{{ id_libro }}">
                        </i></a>

                        <a href="javascript:void(0);" onclick="editarEjemplar();" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                            {# <a href="javascript:void(0);" onclick="ver()" class="btn btn-success btn-block"><i class="fa fa-eye"></i></a> #}
                        <a href="javascript:void(0);" onclick="eliminarEjemplar();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i></a>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-11" style="margin-bottom: -30px;">
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
                        <div class="jarviswidget" id="wid-id-0" 
                             data-widget-editbutton="false" 
                             data-widget-deletebutton="false"
                             data-widget-fullscreenbutton="false"
                             data-widget-colorbutton="false"	
                             data-widget-custombutton="false"
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Ejemplares</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">										
                                    <input class="form-control" type="text">	
                                </div>										
                                <div class="widget-body no-padding">										

                                    <table id="tbl_libros_ejemplares" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th>
                                        <center><i class="fa fa-check-circle"></i></center>
                                        </th>

                                        <th data-hide="expand">Numero</th>
                                        <th data-hide="phone,tablet">Adquisición</th>
                                        <th data-hide="phone,tablet">Precio</th>
                                        <th data-hide="phone,tablet">Observacion</th>
                                        <th data-hide="phone,tablet">Activo</th>
                                        <th data-hide="phone,tablet">Estado</th>

                                        </tr>
                                        </thead>
                                        <tbody>			
                                        </tbody>
                                    </table>
                                </div>		
                            </div>
                        </div>	
                    </article>	
                </div>
            </section>
        </div>
    </div>
    {% endif %}
    

</div>

{{ form('autores/save','method': 'post','id':'form_autores','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Nombre del Autor</label>
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" id="input-descripcion_autor" name="descripcion" placeholder="" >
                <input type="hidden" id="input-codigo_autor" name="codigo" value="">
            </label>
        </section>


        <section class="col col-md-12">
            <label class="text-info" >Nacionalidad</label>
            <label class="input"> <i class="icon-prepend fa fa-flag"></i>
                <input type="text" id="input-nacionalidad" name="nacionalidad" placeholder="" >

            </label>
        </section>

    </div>    
</fieldset>
{{ endForm() }}

{{ form('editoriales/save','method': 'post','id':'form_editoriales','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Nombre de la editorial</label>
            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" id="input-descripcion_editorial" name="descripcion" placeholder="" >
                <input type="hidden" id="input-id_editorial" name="id_editorial" value="">
            </label>
        </section>

    </div>    
</fieldset>
{{ endForm() }}

{{ form('registrolibros/saveEditarEjemplares','method': 'post','id':'form_libros_ejemplares','class':'smart-form','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-12">
            <label class="text-info" >Pedido</label>
            <label class="select">
                <select id="input-ejemplar-id_adquisicion"  name="id_adquisicion" >
                    <option value="" >SELECCIONE...</option>
                    {% for librospedidos_select in librospedidos %}

                        <option value="{{ librospedidos_select.id_adquisicion }}">{{librospedidos_select.fecha_adquisicion}} - {{ librospedidos_select.numero_oc }} - {{ librospedidos_select.descripcion }}</option>   

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
        


        <section class="col col-md-6">
            <label class="text-info" >Precio</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-ejemplar-precio" name="precio" placeholder="Precio" >
            </label>
        </section>
        <section class="col col-md-6" style="margin-top: 20px;">

            <label class="checkbox">

                <input type="checkbox" name="activo" value="" id="input-ejemplar-activo">

                <i></i>Activo
            </label>
        </section>

        <section class="col col-md-12">
            <label class="text-info" >Observaciones </label>
            <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                <textarea rows="3" id="input-ejemplar-observaciones" name="observaciones"></textarea>
                <input type="hidden" id="input-ejemplar-id_ejemplar" name="id_ejemplar" value="">
                <input type="hidden" id="input-ejemplar-id_libro" name="id_libro" value="{{ id_libro }}">
            </label>
        </section>
    </div>
</fieldset>
{{ endForm() }}

<div class="hidden">
    <div id="success">
        <p>
            Se grabo Libro correctamente...
        </p>
    </div>
</div>
<script type="text/javascript" >
    var idl = "";
    var publica = "si";

    {% if id is defined %}
        idl = {{ id }};
    {% endif %}



        //alert("Hola");
</script>
<script type="text/javascript" >
    var id_libro = {{ id_libro }};
</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>