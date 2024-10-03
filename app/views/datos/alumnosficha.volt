<!------------------------------Tabla alumnos---------------------------->
{% set codigo = "" %}
{% set txt_buton = "Registrar" %}
{% if alumnos.codigo is defined %}
    {% set codigo = alumnos.codigo %}
    {% set txt_buton = "Actualizar" %}
{% endif %}

{% set tipo_alumnos = "" %}
{% if alumnos.tipo is defined %}
    {% set tipo_alumnos = alumnos.tipo %}
{% endif %}

{% set semestre_alumnos = "" %}
{% if alumnos.semestre is defined %}
    {% set semestre_alumnos = alumnos.semestre %}
{% endif %}

{% set semestre_egreso = "" %}
{% if alumnos.semestre_egreso is defined %}
    {% set semestre_egreso = alumnos.semestre_egreso %}
{% endif %}

{% if alumnos.carrera is defined %}
    {% set programa_alumnos = alumnos.carrera %}
{% endif %}

{% set apellidop = "" %}
{% if alumnos.apellidop is defined %}
    {% set apellidop = alumnos.apellidop %}
{% endif %}

{% set apellidom = "" %}
{% if alumnos.apellidom is defined %}
    {% set apellidom = alumnos.apellidom %}
{% endif %}

{% set nombres = "" %}
{% if alumnos.nombres is defined %}
    {% set nombres = alumnos.nombres %}
{% endif %}

{% set sexo_alumnos = "" %}
{% if alumnos.sexo is defined %}
    {% set sexo_alumnos = alumnos.sexo %}
{% endif %}

{% set cv = "" %}
{% if alumnos.cv is defined %}
    {% set cv = alumnos.cv %}
{% endif %}

{% set region = "" %}
{% if alumnos.region is defined %}
    {% set region = alumnos.region %}
{% endif %}

{% set provincia = "" %}
{% if alumnos.provincia is defined %}
    {% set provincia = alumnos.provincia %}
{% endif %}

{% set distrito = "" %}
{% if alumnos.distrito is defined %}
    {% set distrito = alumnos.distrito %}
{% endif %}

{% set ubigeo = "" %}
{% if alumnos.ubigeo is defined %}
    {% set ubigeo = alumnos.ubigeo %}
{% endif %}

{% set fecha_nacimiento = "" %}
{% if alumnos.fecha_nacimiento is defined %}
    {% set fecha_nacimiento = utilidades.fechita(alumnos.fecha_nacimiento,'d/m/Y') %}
{% endif %}

{% set documento_alumnos = "" %}
{% if alumnos.documento is defined %}
    {% set documento_alumnos = alumnos.documento %}
{% endif %}

{% set nro_doc = "" %}
{% if alumnos.nro_doc is defined %}
    {% set nro_doc = alumnos.nro_doc %}
{% endif %}

{% set fecha_ingreso = "" %}
{% if alumnos.fecha_ingreso is defined %}
    {% set fecha_ingreso = utilidades.fechita(alumnos.fecha_ingreso,'d/m/Y') %}
{% endif %}

{% set seguro_alumnos = "" %}
{% if alumnos.seguro is defined %}
    {% set seguro_alumnos = alumnos.seguro %}
{% endif %}

{% set telefono = "" %}
{% if alumnos.telefono is defined %}
    {% set telefono = alumnos.telefono %}
{% endif %}

{% set celular = "" %}
{% if alumnos.celular is defined %}
    {% set celular = alumnos.celular %}
{% endif %}

{% set email = "" %}
{% if alumnos.email is defined %}
    {% set email = alumnos.email %}
{% endif %}

{% set email1 = "" %}
{% if alumnos.email1 is defined %}
    {% set email1 = alumnos.email1 %}
{% endif %}

{% set direccion = "" %}
{% if alumnos.direccion is defined %}
    {% set direccion = alumnos.direccion %}
{% endif %}

{% set ciudad = "" %}
{% if alumnos.ciudad is defined %}
    {% set ciudad = alumnos.ciudad %}
{% endif %}

{% set observaciones = "" %}
{% if alumnos.observaciones is defined %}
    {% set observaciones = alumnos.observaciones %}
{% endif %}

{% set foto = "" %}
{% if alumnos.foto is defined %}
    {% set foto = alumnos.foto %}
{% endif %}

{% set traslado_unap = "" %}
{% if alumnos.traslado_unap is defined %}
    {% set traslado_unap = alumnos.traslado_unap %}
{% endif %}

{% set certificado_u = "" %}
{% if alumnos.certificado_u is defined %}
    {% set certificado_u = alumnos.certificado_u %}
{% endif %}

{% set constancia_i = "" %}
{% if alumnos.constancia_i is defined %}
    {% set constancia_i = alumnos.constancia_i %}
{% endif %}

{% set certificado_c = "" %}
{% if alumnos.certificado_c is defined %}
    {% set certificado_c = alumnos.certificado_c %}
{% endif %}

{% set dni_c = "" %}
{% if alumnos.dni_c is defined %}
    {% set dni_c = alumnos.dni_c %}
{% endif %}

{% set partida_n = "" %}
{% if alumnos.partida_n is defined %}
    {% set partida_n = alumnos.partida_n %}
{% endif %}

{% set colegio_publico = "" %}
{% if alumnos.colegio_publico is defined %}
    {% set colegio_publico = alumnos.colegio_publico %}
{% endif %}

{% set colegio_nombre = "" %}
{% if alumnos.colegio_nombre is defined %}
    {% set colegio_nombre = alumnos.colegio_nombre %}
{% endif %}

{% set colegio_anio = "" %}
{% if alumnos.colegio_anio is defined %}
    {% set colegio_anio = alumnos.colegio_anio %}
{% endif %}

{% set sitrabaja = "" %}
{% if alumnos.sitrabaja is defined %}
    {% set sitrabaja = alumnos.sitrabaja %}
{% endif %}

{% set sitrabaja_nombre = "" %}
{% if alumnos.sitrabaja_nombre is defined %}
    {% set sitrabaja_nombre = alumnos.sitrabaja_nombre %}
{% endif %}

{% set sidepende = "" %}
{% if alumnos.sidepende is defined %}
    {% set sidepende = alumnos.sidepende %}
{% endif %}

{% set sidepende_nombre = "" %}
{% if alumnos.sidepende_nombre is defined %}
    {% set sidepende_nombre = alumnos.sidepende_nombre %}
{% endif %}

{% set graduado = "" %}
{% if alumnos.graduado is defined %}
    {% set graduado = alumnos.graduado %}
{% endif %}

{% set titulado = "" %}
{% if alumnos.titulado is defined %}
    {% set titulado = alumnos.titulado %}
{% endif %}

{% set discapacitado = "" %}
{% if alumnos.discapacitado is defined %}
    {% set discapacitado = alumnos.discapacitado %}
{% endif %}

{% set envio = "" %}
{% if alumnos.envio is defined %}
    {% set envio = alumnos.envio %}
{% endif %}

{% set activo = "" %}
{% if alumnos.activo is defined %}
    {% set activo = alumnos.activo %}
{% endif %}

{% set discapacitado_nombre = "" %}
{% if alumnos.discapacitado_nombre is defined %}
    {% set discapacitado_nombre = alumnos.discapacitado_nombre %}
{% endif %}

{% set region1 = "" %}
{% if alumnos.region1 is defined %}
    {% set region1 = alumnos.region1 %}
{% endif %}

{% set provincia1 = "" %}
{% if alumnos.provincia1 is defined %}
    {% set provincia1 = alumnos.provincia1 %}
{% endif %}

{% set distrito1 = "" %}
{% if alumnos.distrito1 is defined %}
    {% set distrito1 = alumnos.distrito1 %}
{% endif %}

{% set ubigeo1 = "" %}
{% if alumnos.ubigeo1 is defined %}
    {% set ubigeo1 = alumnos.ubigeo1 %}
{% endif %}

{% set localidad = "" %}
{% if alumnos.localidad is defined %}
    {% set localidad = alumnos.localidad %}
{% endif %}

{% set idioma_alumnos = "" %}
{% if alumnos.idioma is defined %}
    {% set idioma_alumnos = alumnos.idioma %}
{% endif %}

{% set nro_seguro = "" %}
{% if alumnos.nro_seguro is defined %}
    {% set nro_seguro = alumnos.nro_seguro %}
{% endif %}

{% set archivo = "" %}
{% if alumnos.archivo is defined %}
    {% set archivo = alumnos.archivo %}
{% endif %}

{% set ubigeo1 = "" %}
{% if alumnos.ubigeo1 is defined %}
    {% set ubigeo1 = alumnos.ubigeo1 %}
{% endif %}

{% set identidad_etnica = "" %}
{% if alumnos.identidad_etnica is defined %}
    {% set identidad_etnica = alumnos.identidad_etnica %}
{% endif %}

{% set tipo_discapacidad = "" %}
{% if alumnos.tipo_discapacidad is defined %}
    {% set tipo_discapacidad = alumnos.tipo_discapacidad %}
{% endif %}

{% set fecha_egreso = "" %}
{% if alumnos.fecha_egreso is defined %}
    {% set fecha_egreso = utilidades.fechita(alumnos.fecha_egreso,'d/m/Y') %}
{% endif %}

{% set modalidad_ingreso = "" %}
{% if alumnos.modalidad_ingreso is defined %}
    {% set modalidad_ingreso = alumnos.modalidad_ingreso %}
{% endif %}

{% set sitrabaja_actividad = "" %}
{% if alumnos.sitrabaja_actividad is defined %}
    {% set sitrabaja_actividad = alumnos.sitrabaja_actividad %}
{% endif %}

{% set violencia_sociopolitica = "" %}
{% if alumnos.violencia_sociopolitica is defined %}
    {% set violencia_sociopolitica = alumnos.violencia_sociopolitica %}
{% endif %}

{% set violencia_sociopolitica_registro = "" %}
{% if alumnos.violencia_sociopolitica_registro is defined %}
    {% set violencia_sociopolitica_registro = alumnos.violencia_sociopolitica_registro %}
{% endif %}

{% set estado_civil = "" %}
{% if alumnos.estado_civil is defined %}
    {% set estado_civil = alumnos.estado_civil %}
{% endif %}
<!------------------------------fin tabla alumno------------------------------->

<!------------------------------Tabla alumnos_ficha---------------------------->
{% set alumno = "" %}
{% if alumnos_ficha.alumno is defined %}
    {% set alumno = alumnos_ficha.alumno %}
{% endif %}

{% set semestre = "" %}
{% if alumnos_ficha.semestre is defined %}
    {% set semestre = alumnos_ficha.semestre %}
{% endif %}

{% set nro_ficha = "" %}
{% if alumnos_ficha.nro_ficha is defined %}
    {% set nro_ficha = alumnos_ficha.nro_ficha %}
{% endif %}

{% set fecha_ficha = "" %}
{% if alumnos_ficha.fecha_ficha is defined %}
    {% set fecha_ficha = alumnos_ficha.fecha_ficha %}
{% endif %}

{% set peso = "" %}
{% if alumnos_ficha.peso is defined %}
    {% set peso = alumnos_ficha.peso %}
{% endif %}

{% set talla = "" %}
{% if alumnos_ficha.talla is defined %}
    {% set talla = alumnos_ficha.talla %}
{% endif %}

{% set edad = "" %}
{% if alumnos_ficha.edad is defined %}
    {% set edad = alumnos_ficha.edad %}
{% endif %}

{% set nro_hijos = "" %}
{% if alumnos_ficha.nro_hijos is defined %}
    {% set nro_hijos = alumnos_ficha.nro_hijos %}
{% endif %}

{% set ingresos_papa = "" %}
{% if alumnos_ficha.ingresos_papa is defined %}
    {% set ingresos_papa = alumnos_ficha.ingresos_papa %}
{% endif %}

{% set ingresos_mama = "" %}
{% if alumnos_ficha.ingresos_mama is defined %}
    {% set ingresos_mama = alumnos_ficha.ingresos_mama %}
{% endif %}

{% set ingresos_hnos = "" %}
{% if alumnos_ficha.ingresos_hnos is defined %}
    {% set ingresos_hnos = alumnos_ficha.ingresos_hnos %}
{% endif %}

{% set ingresos_personal = "" %}
{% if alumnos_ficha.ingresos_personal is defined %}
    {% set ingresos_personal = alumnos_ficha.ingresos_personal %}
{% endif %}

{% set egresos_vivienda = "" %}
{% if alumnos_ficha.egresos_vivienda is defined %}
    {% set egresos_vivienda = alumnos_ficha.egresos_vivienda %}
{% endif %}

{% set egresos_alimentacion = "" %}
{% if alumnos_ficha.egresos_alimentacion is defined %}
    {% set egresos_alimentacion = alumnos_ficha.egresos_alimentacion %}
{% endif %}

{% set egresos_luz = "" %}
{% if alumnos_ficha.egresos_luz is defined %}
    {% set egresos_luz = alumnos_ficha.egresos_luz %}
{% endif %}

{% set egresos_agua = "" %}
{% if alumnos_ficha.egresos_agua is defined %}
    {% set egresos_agua = alumnos_ficha.egresos_agua %}
{% endif %}

{% set egresos_gas = "" %}
{% if alumnos_ficha.egresos_gas is defined %}
    {% set egresos_gas = alumnos_ficha.egresos_gas %}
{% endif %}

{% set egresos_materiales_estudio = "" %}
{% if alumnos_ficha.egresos_materiales_estudio is defined %}
    {% set egresos_materiales_estudio = alumnos_ficha.egresos_materiales_estudio %}
{% endif %}

{% set egresos_materiales_aseo = "" %}
{% if alumnos_ficha.egresos_materiales_aseo is defined %}
    {% set egresos_materiales_aseo = alumnos_ficha.egresos_materiales_aseo %}
{% endif %}

{% set egresos_internet = "" %}
{% if alumnos_ficha.egresos_internet is defined %}
    {% set egresos_internet = alumnos_ficha.egresos_internet %}
{% endif %}

{% set egresos_pasajes = "" %}
{% if alumnos_ficha.egresos_pasajes is defined %}
    {% set egresos_pasajes = alumnos_ficha.egresos_pasajes %}
{% endif %}

{% set egresos_cable_tv = "" %}
{% if alumnos_ficha.egresos_cable_tv is defined %}
    {% set egresos_cable_tv = alumnos_ficha.egresos_cable_tv %}
{% endif %}

{% set egresos_prestamos = "" %}
{% if alumnos_ficha.egresos_prestamos is defined %}
    {% set egresos_prestamos = alumnos_ficha.egresos_prestamos %}
{% endif %}

{% set egresos_ocio_recreacion = "" %}
{% if alumnos_ficha.egresos_ocio_recreacion is defined %}
    {% set egresos_ocio_recreacion = alumnos_ficha.egresos_ocio_recreacion %}
{% endif %}

{% set estudios_ayuda = "" %}
{% if alumnos_ficha.estudios_ayuda is defined %}
    {% set estudios_ayuda = alumnos_ficha.estudios_ayuda %}
{% endif %}

{% set estudios_ayuda_nombre = "" %}
{% if alumnos_ficha.estudios_ayuda_nombre is defined %}
    {% set estudios_ayuda_nombre = alumnos_ficha.estudios_ayuda_nombre %}
{% endif %}

{% set estudios_horas = "" %}
{% if alumnos_ficha.estudios_horas is defined %}
    {% set estudios_horas = alumnos_ficha.estudios_horas %}
{% endif %}

{% set estudios_lugar = "" %}
{% if alumnos_ficha.estudios_lugar is defined %}
    {% set estudios_lugar = alumnos_ficha.estudios_lugar %}
{% endif %}

{% set horas_ocio_recreacion = "" %}
{% if alumnos_ficha.horas_ocio_recreacion is defined %}
    {% set horas_ocio_recreacion = alumnos_ficha.horas_ocio_recreacion %}
{% endif %}

{% set observaciones_ficha = "" %}
{% if alumnos_ficha.observaciones is defined %}
    {% set observaciones_ficha = alumnos_ficha.observaciones %}
{% endif %}

{% set moto = "" %}
{% if alumnos_ficha.moto is defined %}
    {% set moto = alumnos_ficha.moto %}
{% endif %}

{% set laptop = "" %}
{% if alumnos_ficha.laptop is defined %}
    {% set laptop = alumnos_ficha.laptop %}
{% endif %}

{% set cocina = "" %}
{% if alumnos_ficha.cocina is defined %}
    {% set cocina = alumnos_ficha.cocina %}
{% endif %}

{% set hervidora = "" %}
{% if alumnos_ficha.hervidora is defined %}
    {% set hervidora = alumnos_ficha.hervidora %}
{% endif %}

{% set mesa = "" %}
{% if alumnos_ficha.mesa is defined %}
    {% set mesa = alumnos_ficha.mesa %}
{% endif %}

{% set silla = "" %}
{% if alumnos_ficha.silla is defined %}
    {% set silla = alumnos_ficha.silla %}
{% endif %}

{% set nro_cuartos = "" %}
{% if alumnos_ficha.nro_cuartos is defined %}
    {% set nro_cuartos = alumnos_ficha.nro_cuartos %}
{% endif %}

{% set nro_personas_cuarto = "" %}
{% if alumnos_ficha.nro_personas_cuarto is defined %}
    {% set nro_personas_cuarto = alumnos_ficha.nro_personas_cuarto %}
{% endif %}

{% set vivienda = "" %}
{% if alumnos_ficha.vivienda is defined %}
    {% set vivienda = alumnos_ficha.vivienda %}
{% endif %}

{% set vivienda_tipo = "" %}
{% if alumnos_ficha.vivienda_tipo is defined %}
    {% set vivienda_tipo = alumnos_ficha.vivienda_tipo %}
{% endif %}

{% set vivienda_material = "" %}
{% if alumnos_ficha.vivienda_material is defined %}
    {% set vivienda_material = alumnos_ficha.vivienda_material %}
{% endif %}

{% set vivienda_material_techo = "" %}
{% if alumnos_ficha.vivienda_material_techo is defined %}
    {% set vivienda_material_techo = alumnos_ficha.vivienda_material_techo %}
{% endif %}

{% set luz_ficha = "" %}
{% if alumnos_ficha.luz is defined %}
    {% set luz_ficha = alumnos_ficha.luz %}
{% endif %}

{% set agua_ficha = "" %}
{% if alumnos_ficha.agua is defined %}
    {% set agua_ficha = alumnos_ficha.agua %}
{% endif %}

{% set desague_ficha = "" %}
{% if alumnos_ficha.desague is defined %}
    {% set desague_ficha = alumnos_ficha.desague %}
{% endif %}

{% set telefono_ficha = "" %}
{% if alumnos_ficha.telefono is defined %}
    {% set telefono_ficha = alumnos_ficha.telefono %}
{% endif %}

{% set cable_tv_ficha = "" %}
{% if alumnos_ficha.cable_tv is defined %}
    {% set cable_tv_ficha = alumnos_ficha.cable_tv %}
{% endif %}

{% set internet_ficha = "" %}
{% if alumnos_ficha.internet is defined %}
    {% set internet_ficha = alumnos_ficha.internet %}
{% endif %}

{% set composicion = "" %}
{% if alumnos_ficha.composicion is defined %}
    {% set composicion = alumnos_ficha.composicion %}
{% endif %}
<!-----------------nuevos------------------------------------------------------>
{% set estado = "" %}
{% if alumnos_ficha.estado is defined %}
    {% set estado = alumnos_ficha.estado %}
{% endif %}

{% set modalidad_estudios = "" %}
{% if alumnos_ficha.modalidad_estudios is defined %}
    {% set modalidad_estudios = alumnos_ficha.modalidad_estudios %}
{% endif %}

{% set local = "" %}
{% if alumnos_ficha.local is defined %}
    {% set local = alumnos_ficha.local %}
{% endif %}

{% set celular_apoderado1 = "" %}
{% if alumnos_ficha.celular_apoderado1 is defined %}
    {% set celular_apoderado1 = alumnos_ficha.celular_apoderado1 %}
{% endif %}

{% set celular_apoderado2 = "" %}
{% if alumnos_ficha.celular_apoderado2 is defined %}
    {% set celular_apoderado2 = alumnos_ficha.celular_apoderado2 %}
{% endif %}

{% set es_padre_familia = "" %}
{% if alumnos_ficha.es_padre_familia is defined %}
    {% set es_padre_familia = alumnos_ficha.es_padre_familia %}
{% endif %}

{% set hijos_con_quien_viven = "" %}
{% if alumnos_ficha.hijos_con_quien_viven is defined %}
    {% set hijos_con_quien_viven = alumnos_ficha.hijos_con_quien_viven %}
{% endif %}

{% set egresos_otros = "" %}
{% if alumnos_ficha.hijos_con_quien_viven is defined %}
    {% set hijos_con_quien_viven = alumnos_ficha.hijos_con_quien_viven %}
{% endif %}

{% set cama = "" %}
{% if alumnos_ficha.cama is defined %}
    {% set cama = alumnos_ficha.cama %}
{% endif %}

{% set tv = "" %}
{% if alumnos_ficha.tv is defined %}
    {% set tv = alumnos_ficha.tv %}
{% endif %}

{% set pc = "" %}
{% if alumnos_ficha.pc is defined %}
    {% set pc = alumnos_ficha.pc %}
{% endif %}

{% set nro_ambientes = "" %}
{% if alumnos_ficha.nro_ambientes is defined %}
    {% set nro_ambientes = alumnos_ficha.nro_ambientes %}
{% endif %}

{% set otros_servicios = "" %}
{% if alumnos_ficha.otros is defined %}
    {% set otros_servicios = alumnos_ficha.otros_servicios %}
{% endif %}

{% set celular_ficha = "" %}
{% if alumnos_ficha.celular is defined %}
    {% set celular_ficha = alumnos_ficha.celular %}
{% endif %}

{% set beca_permanencia = "" %}
{% if alumnos_ficha.beca_permanencia is defined %}
    {% set beca_permanencia = alumnos_ficha.beca_permanencia %}
{% endif %}

{% set beca_completa_alimentacion = "" %}
{% if alumnos_ficha.beca_completa_alimentacion is defined %}
    {% set beca_completa_alimentacion = alumnos_ficha.beca_completa_alimentacion %}
{% endif %}

{% set subvencionada_alimentacion = "" %}
{% if alumnos_ficha.subvencionada_alimentacion is defined %}
    {% set subvencionada_alimentacion = alumnos_ficha.subvencionada_alimentacion %}
{% endif %}

{% set acceso_internet_celular = "" %}
{% if alumnos_ficha.acceso_internet_celular is defined %}
    {% set acceso_internet_celular = alumnos_ficha.acceso_internet_celular %}
{% endif %}

{% set acceso_internet_vivienda = "" %}
{% if alumnos_ficha.acceso_internet_vivienda is defined %}
    {% set acceso_internet_vivienda = alumnos_ficha.acceso_internet_vivienda %}
{% endif %}

{% set acceso_internet_cabina = "" %}
{% if alumnos_ficha.acceso_internet_cabina is defined %}
    {% set acceso_internet_cabina = alumnos_ficha.acceso_internet_cabina %}
{% endif %}

{% set acceso_internet_universidad = "" %}
{% if alumnos_ficha.acceso_internet_universidad is defined %}
    {% set acceso_internet_universidad = alumnos_ficha.acceso_internet_universidad %}
{% endif %}

{% set acceso_internet_otros = "" %}
{% if alumnos_ficha.acceso_internet_otros is defined %}
    {% set acceso_internet_otros = alumnos_ficha.acceso_internet_otros %}
{% endif %}

{% set uso_internet_laptop_propia = "" %}
{% if alumnos_ficha.uuso_internet_laptop_propia is defined %}
    {% set uso_internet_laptop_propia = alumnos_ficha.uso_internet_laptop_propia %}
{% endif %}

{% set uso_internet_laptop_prestada = "" %}
{% if alumnos_ficha.uso_internet_laptop_prestada is defined %}
    {% set uso_internet_laptop_prestada = alumnos_ficha.uso_internet_laptop_prestada %}
{% endif %}

{% set uso_internet_pc = "" %}
{% if alumnos_ficha.uso_internet_pc is defined %}
    {% set uso_internet_pc = alumnos_ficha.uso_internet_pc %}
{% endif %}

{% set uso_internet_celular_plan = "" %}
{% if alumnos_ficha.uso_internet_celular_plan is defined %}
    {% set uso_internet_celular_plan = alumnos_ficha.uso_internet_celular_plan %}
{% endif %}

{% set uso_internet_celular_recarga = "" %}
{% if alumnos_ficha.uso_internet_celular_recarga is defined %}
    {% set uso_internet_celular_recarga = alumnos_ficha.uso_internet_celular_recarga %}
{% endif %}

{% set uso_internet_celular_prestado = "" %}
{% if alumnos_ficha.uso_internet_celular_prestado is defined %}
    {% set uso_internet_celular_prestado = alumnos_ficha.uso_internet_celular_prestado %}
{% endif %}

{% set uso_internet_tablet = "" %}
{% if alumnos_ficha.uso_internet_tablet is defined %}
    {% set uso_internet_tablet = alumnos_ficha.uso_internet_tablet %}
{% endif %}

{% set uso_internet_otros = "" %}
{% if alumnos_ficha.uso_internet_otros is defined %}
    {% set uso_internet_otros = alumnos_ficha.uso_internet_otros %}
{% endif %}

{% set descripcion_lugar_origen = "" %}
{% if alumnos_ficha.descripcion_lugar_origen is defined %}
    {% set descripcion_lugar_origen = alumnos_ficha.descripcion_lugar_origen %}
{% endif %}

{% set descripcion_lugar_actual = "" %}
{% if alumnos_ficha.descripcion_lugar_actual is defined %}
    {% set descripcion_lugar_actual = alumnos_ficha.descripcion_lugar_actual %}
{% endif %}

{% set apreciacion = "" %}
{% if alumnos_ficha.apreciacion is defined %}
    {% set apreciacion = alumnos_ficha.apreciacion %}
{% endif %}

{% set auto = "" %}
{% if alumnos_ficha.auto is defined %}
    {% set auto = alumnos_ficha.auto %}
{% endif %}

{% set vivienda_material_piso = "" %}
{% if alumnos_ficha.vivienda_material_piso is defined %}
    {% set vivienda_material_piso = alumnos_ficha.vivienda_material_piso %}
{% endif %}

{% set vivienda_material_pared = "" %}
{% if alumnos_ficha.vivienda_material_pared is defined %}
    {% set vivienda_material_pared = alumnos_ficha.vivienda_material_pared %}
{% endif %}

{% set otros_servicios_descripcion = "" %}
{% if alumnos_ficha.otros_servicios_descripcion is defined %}
    {% set otros_servicios_descripcion = alumnos_ficha.otros_servicios_descripcion %}
{% endif %}

{% set acceso_internet_otros_descripcion = "" %}
{% if alumnos_ficha.acceso_internet_otros_descripcion is defined %}
    {% set acceso_internet_otros_descripcion = alumnos_ficha.acceso_internet_otros_descripcion %}
{% endif %}
<!-----------------fin tabla alaumnos_ficha------------------------------------>
<div id="ribbon">
    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Panel</li><li>Registro de Ficha Socioéconomica</li>
    </ol>
</div>

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
                             data-widget-sortable="false"
                             data-widget-togglebutton="false"
                             >

                            <header>
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Registro de Ficha Socioéconomica</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">                                      
                                    <input class="form-control" type="text">    
                                </div>                                      
                                <div class="widget-body no-padding">
                                    {{ form('datos/saveAlumnosficha','method': 'post','id':'form_alumnos','class':'smart-form','enctype':'multipart/form-data')  }}

                                    <div class="row" >
                                        <div class="col col-md-12" >
                                            <!-- widget content -->
                                            <div class="widget-body" >
                                                <ul id="myTab1" class="nav nav-tabs bordered">
                                                    <li class="active">
                                                        <a href="#s1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i>Informacion del Estudiante</a>
                                                    </li>

                                                    <li>
                                                        <a href="#s2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i> Información Académica</a>
                                                    </li>

                                                    <li>
                                                        <a href="#s3" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i>Procedencia</a>
                                                    </li>

                                                    <li>
                                                        <a href="#s4" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i>Ficha Socio Económica</a>
                                                    </li>

                                                    <li>
                                                        <a href="#s5" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i>Acceso a internet</a>
                                                    </li>

                                                    <li>
                                                        <a href="#s6" data-toggle="tab"><i class="fa fa-fw fa-lg fa-edit"></i>Composición Familiar</a>
                                                    </li>

                                                </ul>

                                                <div id="myTabContent1" class="tab-content">
                                                    <div class="tab-pane  active" id="s1">
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Código de Estudiante</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-codigo" name="codigo" placeholder="" value="{{ codigo }}" readonly="">
                                                                        <input type="hidden" id="input-semestre_select" name="semestre_select" value="{{ semestrea }}">
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Tipo de Estudiante</label>
                                                                    <label class="select">
                                                                        <select id="input-tipo"  name="tipo" disabled>
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for tipoalumno in tipoalumnos %}
                                                                                {% if tipoalumno.codigo == tipo_alumnos %}
                                                                                    <option selected="selected" value="{{ tipoalumno.codigo }}">{{ tipoalumno.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ tipoalumno.codigo }}">{{ tipoalumno.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">

                                                                    <label class="text-info" >Modalidad Ingreso
                                                                    </label>
                                                                    <label class="select">
                                                                        <select id="input_modalidad_ingreso"  name="modalidad_ingreso" disabled>
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for modalidad_select in modalidad %}
                                                                                {% if modalidad_select.codigo == modalidad_ingreso %}
                                                                                    <option selected="selected" value="{{ modalidad_select.codigo }}">{{ modalidad_select.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ modalidad_select.codigo }}">{{ modalidad_select.nombres }}</option>   
                                                                                {% endif %}
                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>
                                                            </div>
                                                            <div class="row">
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Imagen del Alumnos</label>
                                                                    <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_alumno"><i class="fa fa-hand-o-up"></i> Click Aquí para mostrar Imagen</button>

                                                                    <div id="imagen_alumno" class="collapse">

                                                                        {% if foto !== ""   %}
                                                                            <img class="img-responsive" src="{{ url('adminpanel/imagenes/alumnos/'~foto) }}" error="this.onerror=null;this.src='';"></img>
                                                                        {% else %}

                                                                            <div class="alert alert-warning fade in">                                                       
                                                                                <i class="fa-fw fa fa-warning"></i>
                                                                                <strong>Pendiente</strong> Aun no ha subido una imagen.
                                                                            </div>

                                                                        {% endif %}
                                                                    </div>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Documento</label>
                                                                    <label class="select">
                                                                        <select id="input-documento"  name="documento" disabled>
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for documentoalumno in documentoalumnos %}
                                                                                {% if documentoalumno.codigo == documento_alumnos %}
                                                                                    <option selected="selected" value="{{ documentoalumno.codigo }}">{{ documentoalumno.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ documentoalumno.codigo }}">{{ documentoalumno.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>   

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Número de Documento</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-nro_doc" name="nro_doc" placeholder="Nro. Documento" value="{{ nro_doc }}" readonly>

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Apellido paterno</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-apellidop" name="apellidop" placeholder="Apellido paterno" value="{{ apellidop }}" readonly>

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Apellido materno</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-apellidom" name="apellidom" placeholder="Apellido materno" value="{{ apellidom }}" readonly>

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Nombres</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-nombres" name="nombres" placeholder="Nombres" value="{{ nombres }}" readonly>

                                                                    </label>
                                                                </section>


                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Fecha de Nacimiento (DD/MM/AAAA)</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                                        <input type="text" id="input-fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha de Nacimiento" class="" data-dateformat='dd/mm/yy' value="{{ fecha_nacimiento }}" readonly>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Sexo</label>
                                                                    <label class="select">
                                                                        <select id="input-sexo"  name="sexo" disabled>
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for sexoalumno in sexoalumnos %}
                                                                                {% if sexoalumno.codigo == sexo_alumnos %}
                                                                                    <option selected="selected" value="{{ sexoalumno.codigo }}">{{ sexoalumno.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ sexoalumno.codigo }}">{{ sexoalumno.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section> 

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Idioma</label>
                                                                    <label class="select">
                                                                        <select id="input-idioma"  name="idioma" disabled>
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for ia in idiomaalumnos %}
                                                                                {% if ia.codigo == idioma_alumnos %}
                                                                                    <option selected="selected" value="{{ ia.codigo }}">{{ ia.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ ia.codigo }}">{{ ia.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-8">
                                                                    <label class="text-info" >Dirección</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-direccion" name="direccion" placeholder="Dirección" value="{{ direccion }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Ciudad</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-ciudad" name="ciudad" placeholder="Ciudad" value="{{ ciudad }}" >

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Correo personal</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-at"></i>
                                                                        <input type="text" id="input-email" name="email" placeholder="Correo personal" value="{{ email }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Correo Institucional</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-at"></i>
                                                                        <input type="text" id="input-email1" name="email1" placeholder="Correo UNAAA" value="{{ email1 }}" readonly>

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Seguro</label>
                                                                    <label class="select">
                                                                        <select id="input-seguro"  name="seguro" >
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for seguroalumno in seguroalumnos %}
                                                                                {% if seguroalumno.codigo == seguro_alumnos %}
                                                                                    <option selected="selected" value="{{ seguroalumno.codigo }}">{{ seguroalumno.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ seguroalumno.codigo }}">{{ seguroalumno.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section> 



                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Teléfono</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-telefono" name="telefono" placeholder="Teléfono" value="{{ telefono }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Celular</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-celular" name="celular" placeholder="Celular" value="{{ celular }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info">Estado Civil</label>
                                                                    <label class="select">
                                                                        <select id="input-estado_civil"  name="estado_civil">
                                                                            <option value="">SELECCIONE...</option>
                                                                            {% for i_e in estadocivil %}
                                                                                {% if i_e.codigo == estado_civil %}
                                                                                    <option selected="selected" value="{{i_e.codigo }}">{{ i_e.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ i_e.codigo }}">{{ i_e.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>


                                                                <section class="col col-md-3">

                                                                    <label class="checkbox">

                                                                        {% if discapacitado == 1 %}
                                                                            <input type="checkbox" name="discapacitado" value="{{ discapacitado }}" id="discapacitado" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="discapacitado" value="{{ discapacitado }}" id="discapacitado">
                                                                        {% endif %}

                                                                        <i></i>Discapacitado - Nombre discapacidad

                                                                    </label>

                                                                    <label class="input" > <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-discapacitado_nombre" name="discapacitado_nombre" placeholder="Nombre Discapacidad" value="{{ discapacitado_nombre }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info" style="margin-bottom: 10px;">Tipo de Discapacidad</label>
                                                                    <label class="select">
                                                                        <select id="input-tipo_discapacidad"  name="tipo_discapacidad">
                                                                            <option value="">SELECCIONE...</option>
                                                                            {% for i_e in tipodiscapacidad %}
                                                                                {% if i_e.codigo == tipo_discapacidad %}
                                                                                    <option selected="selected" value="{{i_e.codigo }}">{{ i_e.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ i_e.codigo }}">{{ i_e.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">

                                                                    <label class="checkbox">

                                                                        {% if violencia_sociopolitica == 1 %}
                                                                            <input type="checkbox" name="violencia_sociopolitica" value="{{ violencia_sociopolitica }}" id="violencia_sociopolitica" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="violencia_sociopolitica" value="{{ violencia_sociopolitica }}" id="violencia_sociopolitica">
                                                                        {% endif %}

                                                                        <i></i>Violencia Sociopolitica - Registro

                                                                    </label>

                                                                    <label class="input" > <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-violencia_sociopolitica_registro" name="violencia_sociopolitica_registro" placeholder="Registro Violencia Sociopolitica" value="{{ violencia_sociopolitica_registro }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info" style="margin-bottom: 10px;">Identidad Étnica</label>
                                                                    <label class="select">
                                                                        <select id="input_identidad_etnica"  name="identidad_etnica">
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for i_e in identidadetnica %}
                                                                                {% if i_e.codigo == identidad_etnica %}
                                                                                    <option selected="selected" value="{{i_e.codigo }}">{{ i_e.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ i_e.codigo }}">{{ i_e.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-6" style="float: right;">

                                                                    <label class="text-info" >Agregar Archivo</label>
                                                                    <div class="input input-file">

                                                                        {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                                        <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                                        <span class="button"><input id="archivo" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file" name="input-file"  placeholder="Agregar Archivo" readonly="">

                                                                    </div>

                                                                    {% if archivo !== ""   %}

                                                                        <div class="alert alert-success fade in">                                                        

                                                                            Click aqui para ver el archivo 
                                                                            <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/alumnos/'~archivo) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                                        </div>


                                                                    {% else %}

                                                                        <div class="alert alert-warning fade in">                                                       
                                                                            <i class="fa-fw fa fa-warning"></i>
                                                                            <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                                        </div>

                                                                    {% endif %}

                                                                </section>

                                                                <section class="col col-md-6" style="float: right;">

                                                                    <label class="text-info" >Agregar Imagen (600 x 400 px)</label>
                                                                    <div class="input input-file">

                                                                        {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                                        <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                                        <label class="input">

                                                                            <span class="button"><input id="imagen" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-image" name="input-file"  placeholder="Agregar Imagen" readonly="">

                                                                        </label>
                                                                    </div>

                                                                    {% if foto !== ""   %}

                                                                        <div class="alert alert-success fade in">                                                        

                                                                            Click aqui para ver la imagen 
                                                                            <a  href="javascript:void(0);" class="btn btn-ribbon" role="button" onclick="imagen_registro();">  <i class="fa-fw fa fa-image"></i></a>
                                                                        </div>


                                                                    {% else %}

                                                                        <div class="alert alert-warning fade in">                                                       
                                                                            <i class="fa-fw fa fa-warning"></i>
                                                                            <strong>Pendiente</strong> Aun no ha subido una imagen.
                                                                        </div>

                                                                    {% endif %}

                                                                </section>

                                                                <section class="col col-md-6">

                                                                    <label class="text-info" >Agregar CV</label>
                                                                    <div class="input input-file">

                                                                        {#<input type="file" id="archivo_personal" name="archivo_personal" >
                                                                        <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                                                                        <span class="button"><input id="cv" type="file" name="cv" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');"><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file_cv" name="input-file"  placeholder="Agregar CV" readonly="">

                                                                    </div>

                                                                    {% if cv !== ""   %}

                                                                        <div class="alert alert-success fade in">                                                        

                                                                            Click aqui para ver el archivo 
                                                                            <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/cv/'~cv) }}" >  <i class="fa-fw fa fa-book"></i></a>
                                                                        </div>


                                                                    {% else %}

                                                                        <div class="alert alert-warning fade in">                                                       
                                                                            <i class="fa-fw fa fa-warning"></i>
                                                                            <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                                        </div>

                                                                    {% endif %}

                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if envio == 1 %}
                                                                            <input type="checkbox" name="envio" value="{{ envio }}" id="envio" checked disabled> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="envio" value="{{ envio }}" id="envio" disabled>
                                                                        {% endif %}

                                                                        <i></i>Envio e-mail</label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">

                                                                        {% if activo == 1 %}
                                                                            <input type="checkbox" name="activo" value="{{ activo }}" id="activo" checked disabled> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="activo" value="{{ activo }}" id="activo" disabled>
                                                                        {% endif %}

                                                                        <i></i>Activo</label>
                                                                </section>

                                                            </div> 
                                                        </fieldset>
                                                    </div>
                                                    <div class="tab-pane fade" id="s2">
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-6">
                                                                    <label class="text-info" >Programa de estudios</label>
                                                                    <label class="select">
                                                                        <select id="input-carrera"  name="carrera" disabled>
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for programa in programas %}
                                                                                {% if programa.codigo == programa_alumnos %}
                                                                                    <option selected="selected" value="{{ programa.codigo }}">{{ programa.descripcion }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ programa.codigo }}">{{ programa.descripcion }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">
                                                                        {% if graduado == 1 %}
                                                                            <input type="checkbox" name="graduado" value="{{ graduado }}" id="input-graduado" checked disabled>
                                                                        {% else %}
                                                                            <input type="checkbox" name="graduado" value="{{ graduado }}" id="input-graduado" disabled>
                                                                        {% endif %}
                                                                        <i></i>Graduado</label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info" ></label>
                                                                    <label class="checkbox">
                                                                        {% if titulado == 1 %}
                                                                            <input type="checkbox" name="titulado" value="{{ titulado }}" id="input-titulado" checked disabled>
                                                                        {% else %}
                                                                            <input type="checkbox" name="titulado" value="{{ titulado }}" id="input-titulado" disabled>
                                                                        {% endif %}
                                                                        <i></i>Titulado</label>
                                                                </section>

                                                            </div>

                                                            <div class="row"> 

                                                                <section class="col col-md-3">

                                                                    <label class="text-info" >Semestre de Ingreso</label>
                                                                    <label class="select">
                                                                        <select id="input-semestre"  name="semestre" disabled>
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for semestre in semestres %}
                                                                                {% if semestre.codigo == semestre_alumnos %}
                                                                                    <option selected="selected" value="{{ semestre.codigo }}">{{ semestre.descripcion }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ semestre.codigo }}">{{ semestre.descripcion }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info" >Fecha de Ingreso (DD/MM/AAAA)</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                                        <input type="text" id="input-fecha_ingreso" name="fecha_ingreso" placeholder="Fecha de Ingreso" class="" data-dateformat='dd/mm/yy' value="{{ fecha_ingreso }}" readonly>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">

                                                                    <label class="text-info" >Semestre de Egreso</label>
                                                                    <label class="select">
                                                                        <select id="input-semestre_egreso"  name="semestre_egreso" disabled>
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for semestre in semestres %}
                                                                                {% if semestre.codigo == semestre_egreso %}
                                                                                    <option selected="selected" value="{{ semestre.codigo }}">{{ semestre.descripcion }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ semestre.codigo }}">{{ semestre.descripcion }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i>
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info" >Fecha de Egreso (DD/MM/AAAA)</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-calendar"></i>
                                                                        <input type="text" id="input-fecha_egreso" name="fecha_egreso" placeholder="Fecha de Egreso" class="" data-dateformat='dd/mm/yy' value="{{ fecha_egreso }}">
                                                                    </label>
                                                                </section>

                                                            </div>

                                                            <div class="row">                                                                
                                                                <section class="col col-md-6">
                                                                    <label class="text-info" >Modalidad de Estudios</label>
                                                                    <label class="select">
                                                                        <select id="input-modalidad_estudios"  name="modalidad_estudios" disabled>
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for m_e in modalidadestudios %}
                                                                                {% if m_e.codigo == modalidad_estudios %}
                                                                                    <option selected="selected" value="{{ m_e.codigo }}">{{ m_e.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ m_e.codigo }}">{{ m_e.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-6">
                                                                    <label class="text-info" >Local</label>
                                                                    <label class="select">
                                                                        <select id="input-local"  name="local" disabled>
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for local_m in locales %}
                                                                                {% if local_m.codigo == local %}
                                                                                    <option selected="selected" value="{{ local_m.codigo }}">{{ local_m.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ local_m.codigo }}">{{ local_m.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-12">
                                                                    <label class="text-info" >Observaciones</label>
                                                                    <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                                        <textarea rows="2" id="input-observaciones" name="observaciones" >{{ observaciones }}</textarea> 
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">

                                                                    <label class="text-info" >Partida de nacimiento</label>
                                                                    <div class="input input-file" style="margin-bottom: 5px;">

                                                                        <span class="button"><input type="file" id="partida_nacimiento" name="partida_nacimiento" onchange="this.parentNode.nextSibling.value = this.value">...</span><input type="text" placeholder="Subir archivo" readonly="">
                                                                        <input type="hidden" id="input-partida_n" name="partida_n" value="{{ partida_n }}">
                                                                    </div>


                                                                    {% if partida_n == 1   %}

                                                                        <div class="alert alert-success fade in">                                                        

                                                                            Click aqui para ver el archivo 
                                                                            <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/partidas_nacimiento/FILE-'~codigo~'.pdf') }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                                                        </div>

                                                                    {% else %}

                                                                        <div class="alert alert-warning fade in">                                                       
                                                                            <i class="fa-fw fa fa-warning"></i>
                                                                            <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                                        </div>

                                                                    {% endif %}

                                                                </section>

                                                                <section class="col col-md-4" >

                                                                    <label class="text-info" >DNI</label>
                                                                    <div class="input input-file" style="margin-bottom: 5px;">

                                                                        <span class="button"><input type="file" id="dni_alumno" name="dni_alumno" onchange="this.parentNode.nextSibling.value = this.value">...</span><input type="text"  placeholder="Subir archivo" readonly="">
                                                                        <input type="hidden" id="input-dni_c" name="dni_c" value="{{ dni_c }}">

                                                                    </div>


                                                                    {% if dni_c == 1  %}

                                                                        <div class="alert alert-success fade in">                                                        

                                                                            Click aqui para ver el archivo 
                                                                            <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/dni/FILE-'~codigo~'.pdf') }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                                                        </div>

                                                                    {% else %}

                                                                        <div class="alert alert-warning fade in">                                                       
                                                                            <i class="fa-fw fa fa-warning"></i>
                                                                            <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                                        </div>

                                                                    {% endif %}


                                                                </section>

                                                                <section class="col col-md-4" >

                                                                    <label class="text-info" >Certificado de Estudios Colegio</label>
                                                                    <div class="input input-file" style="margin-bottom: 5px;">
                                                                        <span class="button"><input type="file" id="certificado_c_alumno" name="certificado_c_alumno" onchange="this.parentNode.nextSibling.value = this.value">...</span><input type="text" placeholder="Subir archivo" readonly="">
                                                                        <input type="hidden" id="input-certificado_c" name="certificado_c" value="{{ certificado_c }}">
                                                                    </div>

                                                                    {% if certificado_c == 1  %}
                                                                        <div class="alert alert-success fade in">                                                        

                                                                            Click aqui para ver el archivo 
                                                                            <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/certificados_estudios_colegio/FILE-'~codigo~'.pdf') }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                                                        </div>

                                                                    {% else %}

                                                                        <div class="alert alert-warning fade in">                                                       
                                                                            <i class="fa-fw fa fa-warning"></i>
                                                                            <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                                        </div>

                                                                    {% endif %}

                                                                </section>


                                                                <section class="col col-md-4">

                                                                    <label class="text-info" >Constancia de ingreso</label>
                                                                    <div class="input input-file" style="margin-bottom: 5px;">
                                                                        <span class="button"><input type="file" id="constancia_i_alumno" name="constancia_i_alumno" onchange="this.parentNode.nextSibling.value = this.value">...</span><input type="text" placeholder="Subir archivo" readonly="">
                                                                        <input type="hidden" id="input-constancia_i" name="constancia_i" value="{{ constancia_i }}">
                                                                    </div>

                                                                    {% if constancia_i == 1  %}
                                                                        <div class="alert alert-success fade in">                                                        

                                                                            Click aqui para ver el archivo 
                                                                            <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/constancias_ingreso/FILE-'~codigo~'.pdf') }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                                                        </div>

                                                                    {% else %}

                                                                        <div class="alert alert-warning fade in">                                                       
                                                                            <i class="fa-fw fa fa-warning"></i>
                                                                            <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                                        </div>

                                                                    {% endif %}

                                                                </section>

                                                                <section class="col col-md-4">

                                                                    <label class="text-info" >Certificado de estudios</label>
                                                                    <div class="input input-file" style="margin-bottom: 5px;">
                                                                        <span class="button"><input type="file" id="certificado_u_alumno" name="certificado_u_alumno" onchange="this.parentNode.nextSibling.value = this.value">...</span><input type="text"  placeholder="Subir archivo" readonly="">

                                                                        <input type="hidden" id="input-certificado_u" name="certificado_u" value="{{ certificado_u }}">

                                                                    </div>


                                                                    {% if certificado_u == 1  %}
                                                                        <div class="alert alert-success fade in">                                                        

                                                                            Click aqui para ver el archivo 
                                                                            <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/certificados_estudios/FILE-'~codigo~'.pdf') }}" >  <i class="fa-fw fa fa-eye"></i></a>
                                                                        </div>

                                                                    {% else %}

                                                                        <div class="alert alert-warning fade in">                                                       
                                                                            <i class="fa-fw fa fa-warning"></i>
                                                                            <strong>Pendiente</strong> Aun no ha subido un archivo.
                                                                        </div>

                                                                    {% endif %}


                                                                </section>

                                                                <section class="col col-md-4">

                                                                    <label class="text-info" >Traslado</label>
                                                                    <div class="input input-file" style="margin-bottom: 5px;">
                                                                        <span class="button"><input type="file" id="traslado_alumno" name="traslado_alumno" onchange="this.parentNode.nextSibling.value = this.value">...</span><input type="text" placeholder="Subir archivo" readonly="">
                                                                        <input type="hidden" id="input-traslado" name="traslado" value="{{ traslado }}">
                                                                    </div>

                                                                    {% if traslado == 1  %}
                                                                        <div class="alert alert-success fade in">                                                        

                                                                            Click aqui para ver el archivo 
                                                                            <a class="btn btn-ribbon" target="_BLANK" role="button" href="{{ url('adminpanel/archivos/traslados/FILE-'~codigo~'.pdf') }}" >  <i class="fa-fw fa fa-eye"></i></a>
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
                                                    </div>
                                                    <div class="tab-pane fade" id="s3">


                                                        <header style="margin-top: 10px;">
                                                            Ubigeo
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">

                                                                <section class="col col-md-3">
                                                                    <label class="text-info" >Region</label>
                                                                    <label class="select">
                                                                        <select id="input-region"  name="region" >
                                                                            <option value="" >Region</option>
                                                                            {% for reg in regiones %}
                                                                                {% if reg.region == alumnos.region %}
                                                                                    <option selected="selected" value="{{ reg.region }}">{{ reg.descripcion }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ reg.region }}">{{ reg.descripcion }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info" >Provincia</label>
                                                                    <label class="select">
                                                                        <select id="input-provincia"  name="provincia">
                                                                            <option value="" >Provincia</option>

                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info" >Distrito</label>
                                                                    <label class="select">
                                                                        <select id="input-distrito"  name="distrito">
                                                                            <option value="" >Distrito</option>

                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info" >Cod. Ubigeo</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-map-pin"></i>
                                                                        <input type="text" id="input-ubigeo" name="ubigeo" placeholder="ubigeo" value="{{ ubigeo }}" readonly>                                              
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-12">
                                                                    <label class="text-info" >Descripción del lugar actual</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-map-pin"></i>
                                                                        <input type="text" id="input-descripcion_lugar_actual" name="descripcion_lugar_actual" placeholder="Descripción del lugar actual" value="{{ descripcion_lugar_actual }}">                                              
                                                                    </label>
                                                                </section>
                                                            </div>
                                                        </fieldset>

                                                        <header style="margin-top: -10px;">
                                                            Lugar de Procedencia
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">

                                                                <section class="col col-md-3">
                                                                    <label class="text-info" >Region</label>
                                                                    <label class="select">
                                                                        <select id="input-region1"  name="region1" >
                                                                            <option value="" >Region</option>
                                                                            {% for reg in regiones %}
                                                                                {% if reg.region == alumnos.region1 %}
                                                                                    <option selected="selected" value="{{ reg.region }}">{{ reg.descripcion }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ reg.region }}">{{ reg.descripcion }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-3">
                                                                    <label class="text-info" >Provincia</label>
                                                                    <label class="select">
                                                                        <select id="input-provincia1"  name="provincia1">
                                                                            <option value="" >Provincia</option>

                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info" >Distrito</label>
                                                                    <label class="select">
                                                                        <select id="input-distrito1"  name="distrito1">
                                                                            <option value="" >Distrito</option>

                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>


                                                                <section class="col col-md-3">
                                                                    <label class="text-info" >Cod. Ubigeo Procedencia</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-map-pin"></i>
                                                                        <input type="text" id="input-ubigeo1" name="ubigeo1" placeholder="ubigeo de Procedencia" value="{{ ubigeo1 }}" readonly>                                              
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-12">
                                                                    <label class="text-info" >Localidad</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-localidad" name="localidad" placeholder="Localidad" value="{{ localidad }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-12">
                                                                    <label class="text-info" >Descripción del lugar origen</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-map-pin"></i>
                                                                        <input type="text" id="input-descripcion_lugar_origen" name="descripcion_lugar_origen" placeholder="Descripción del lugar origen" value="{{ descripcion_lugar_origen }}">                                              
                                                                    </label>
                                                                </section>
                                                            </div>
                                                        </fieldset>
                                                        <header style="margin-top: -10px;">
                                                            Colegio de Procedencia
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">

                                                                <section class="col col-md-9">

                                                                    <label class="checkbox">

                                                                        {% if colegio_publico == 1 %}
                                                                            <input type="checkbox" name="colegio_publico" value="{{ colegio_publico }}" id="colegio_publico" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="colegio_publico" value="{{ colegio_publico }}" id="colegio_publico">
                                                                        {% endif %}

                                                                        <i></i>Colegio Público



                                                                    </label>

                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-colegio_nombre" name="colegio_nombre" placeholder="Colegio Público" value="{{ colegio_nombre }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="text-info" style="margin-bottom: 10px;">Colegio año</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-colegio_anio" name="colegio_anio" placeholder="Año termino colegio" value="{{ colegio_anio }}" >

                                                                    </label>
                                                                </section>
                                                            </div> 
                                                        </fieldset>

                                                    </div>

                                                    <div class="tab-pane fade" id="s4">
                                                        <header style="margin-top: 10px;">
                                                            Datos Generales
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-2">
                                                                    <label class="text-info">Peso</label>
                                                                    <label class="input" style="margin-top: 10px;"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-peso" name="peso" placeholder="Peso" value="{{ peso }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info">Talla</label>
                                                                    <label class="input" style="margin-top: 10px;"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-talla" name="talla" placeholder="Talla" value="{{ talla }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Edad</label>
                                                                    <label class="input" style="margin-top: 10px;"> <i class="icon-prepend fa fa-user"></i>
                                                                        <input type="text" id="input-edad" name="edad" placeholder="Edad" value="{{ edad }}" readonly="">

                                                                    </label>
                                                                </section>      




                                                                <section class="col col-md-2">

                                                                    <label class="checkbox">

                                                                        {% if es_padre_familia == 1 %}
                                                                            <input type="checkbox" name="es_padre_familia" value="{{ es_padre_familia }}" id="input-es_padre_familia" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="es_padre_familia" value="{{ es_padre_familia }}" id="input-es_padre_familia">
                                                                        {% endif %}

                                                                        <i></i>Es Padre

                                                                    </label>



                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-nro_hijos" name="nro_hijos" placeholder="Numero de hijos" value="{{ nro_hijos }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Con quién vive tu hijo/a:</label>
                                                                    <label class="input"style="margin-top: 10px;"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-hijos_con_quien_viven" name="hijos_con_quien_viven" placeholder="Con quién vive tu hijo/a:" value="{{ hijos_con_quien_viven }}" >

                                                                    </label>
                                                                </section>

                                                            </div> 
                                                        </fieldset>
                                                        <header style="margin-top: 10px;">
                                                            Contacto
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" style="margin-bottom: 10px;">Celular Apoderado 1</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-celular_apoderado1" name="celular_apoderado1" placeholder="Celular Apoderado 1" value="{{ celular_apoderado1 }}">
                                                                    </label>
                                                                </section>      
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" style="margin-bottom: 10px;">Celular Apoderado 2</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-celular_apoderado2" name="celular_apoderado2" placeholder="Celular Apoderado 2" value="{{ celular_apoderado2 }}">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">

                                                                    <label class="checkbox">

                                                                        {% if estudios_ayuda == 1 %}
                                                                            <input type="checkbox" name="estudios_ayuda" value="{{ estudios_ayuda }}" id="estudios_ayuda" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="estudios_ayuda" value="{{ estudios_ayuda }}" id="estudios_ayuda">
                                                                        {% endif %}

                                                                        <i></i> Recibe ayuda en estudios

                                                                    </label>

                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-estudios_ayuda_nombre" name="estudios_ayuda_nombre" placeholder="Persona que ayuda en estudios" value="{{ estudios_ayuda_nombre }}" >

                                                                    </label>
                                                                </section>


                                                            </div> 
                                                        </fieldset>  
                                                        <header style="margin-top: -10px;">
                                                            Condición Económica 
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">

                                                                <section class="col col-md-6">

                                                                    <label class="checkbox">

                                                                        {% if sitrabaja == 1 %}
                                                                            <input type="checkbox" name="sitrabaja" value="{{ sitrabaja }}" id="sitrabaja" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="sitrabaja" value="{{ sitrabaja }}" id="sitrabaja">
                                                                        {% endif %}

                                                                        <i></i>Trabaja

                                                                    </label>

                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="sitrabaja_nombre" name="sitrabaja_nombre" placeholder="Lugar / Institución donde labora" value="{{ sitrabaja_nombre }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-6" style="">
                                                                    <label class="text-info">Actividad laboral</label>
                                                                    <label class="input" style="margin-top: 10px;"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-sitrabaja_actividad" name="sitrabaja_actividad" placeholder="Actividad laboral" value="{{ sitrabaja_actividad }}" >

                                                                    </label>
                                                                </section>
                                                            </div>
                                                            <div class="row">
                                                                <section class="col col-md-6">

                                                                    <label class="checkbox">

                                                                        {% if sidepende == 1 %}
                                                                            <input type="checkbox" name="sidepende" value="{{ sidepende }}" id="sidepende" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="sidepende" value="{{ sidepende }}" id="sidepende">
                                                                        {% endif %}

                                                                        <i></i>Depende de ...

                                                                    </label>

                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="sidepende_nombre" name="sidepende_nombre" placeholder="Depende de ..." value="{{ sidepende_nombre }}" >

                                                                    </label>
                                                                </section>

                                                            </div> 
                                                        </fieldset>
                                                        <header style="margin-top: -10px;">
                                                            Ingresos del Estudiante
                                                        </header>

                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Papá</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-ingresos_papa" name="ingresos_papa" placeholder="Ingresos papa" value="{{ ingresos_papa }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Mamá</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-ingresos_mama" name="ingresos_mama" placeholder="Ingresos mama" value="{{ ingresos_mama }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Hermanos</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-ingresos_hnos" name="ingresos_hnos" placeholder="Ingresos hermanos" value="{{ ingresos_hnos }}" >

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Personal</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-ingresos_personal" name="ingresos_personal" placeholder="Ingresos Personal" value="{{ ingresos_personal }}" >

                                                                    </label>
                                                                </section>


                                                            </div> 
                                                        </fieldset>

                                                        <header style="margin-top: -10px;">
                                                            Egresos del Estudiante
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Vivienda</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-egresos_vivienda" name="egresos_vivienda" placeholder="Egresos Vivienda" value="{{ egresos_vivienda }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Alimentacíon</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-egresos_alimentacion" name="egresos_alimentacion" placeholder="Egresos Alimentacion" value="{{ egresos_alimentacion }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Luz</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-egresos_luz" name="egresos_luz" placeholder="Egresos Luz" value="{{ egresos_luz }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Agua</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-egresos_agua" name="egresos_agua" placeholder="Egresos Agua" value="{{ egresos_agua }}" >

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Cable</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-egresos_cable_tv" name="egresos_cable_tv" placeholder="Egresos de Cable" value="{{ egresos_cable_tv }}" >

                                                                    </label>
                                                                </section>    
                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Internet</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-egresos_internet" name="egresos_internet" placeholder="Egresos de Internet" value="{{ egresos_internet }}" >

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Pasajes</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-egresos_pasajes" name="egresos_pasajes" placeholder="Egresos de Pasajes" value="{{ egresos_pasajes }}" >

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Gas</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-egresos_gas" name="egresos_gas" placeholder="Egresos Gas" value="{{ egresos_gas }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Materiales de Estudio</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-egresos_materiales_estudio" name="egresos_materiales_estudio" placeholder="Egresos de Materiales" value="{{ egresos_materiales_estudio }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Materiales de Aseo</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-egresos_materiales_aseo" name="egresos_materiales_aseo" placeholder="Egresos de Aseo" value="{{ egresos_materiales_aseo }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Prestamos</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-egresos_prestamos" name="egresos_prestamos" placeholder="Prestamos" value="{{ egresos_prestamos }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Recreación y ocio</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-egresos_ocio_recreacion" name="egresos_ocio_recreacion" placeholder="Prestamos" value="{{ egresos_ocio_recreacion }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="text-info" >Egresos Otros</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-dollar"></i>
                                                                        <input type="text" id="input-egresos_otros" name="egresos_otros" placeholder="Egresos Otros" value="{{ egresos_otros }}" >
                                                                    </label>
                                                                </section>

                                                            </div>
                                                        </fieldset>

                                                        <header style="margin-top: -10px;">
                                                            Otros Aspectos
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">


                                                                <section class="col col-md-2">
                                                                    <label class="text-info">Horas de estudio</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-clock-o"></i>
                                                                        <input type="text" id="input-estudios_horas" name="estudios_horas" placeholder="Horas de Estudio" value="{{ estudios_horas }}" >

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-8">
                                                                    <label class="text-info">Lugar de estudios</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-home"></i>
                                                                        <input type="text" id="input-estudios_lugar" name="estudios_lugar" placeholder="Horas de Estudio" value="{{ estudios_lugar }}" >

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="text-info">Horas Recreación</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-clock-o"></i>
                                                                        <input type="text" id="input-horas_ocio_recreacion" name="horas_ocio_recreacion" placeholder="Horas Recreación" value="{{ horas_ocio_recreacion }}" >
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-12">
                                                                    <label class="text-info" >Observaciones</label>
                                                                    <label class="textarea"> <i class="icon-append fa fa-comment"></i>                                      
                                                                        <textarea rows="5" id="input-observaciones_ficha" name="observaciones_ficha" >{{ observaciones_ficha }}</textarea> 
                                                                    </label>
                                                                </section>
                                                            </div>

                                                        </fieldset>

                                                        <header style="margin-top: -10px;">
                                                            Tenencia del Estudiante
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if auto == 1 %}
                                                                            <input type="checkbox" name="auto" value="{{ auto }}" id="input-auto" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="auto" value="{{ auto }}" id="input-auto">
                                                                        {% endif %}

                                                                        <i></i>Auto
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if moto == 1 %}
                                                                            <input type="checkbox" name="moto" value="{{ moto }}" id="input-moto" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="moto" value="{{ moto }}" id="input-moto">
                                                                        {% endif %}

                                                                        <i></i>Moto
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if laptop == 1 %}
                                                                            <input type="checkbox" name="laptop" value="{{ laptop }}" id="input-laptop" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="laptop" value="{{ laptop }}" id="input-laptop">
                                                                        {% endif %}

                                                                        <i></i>Laptop
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if tv == 1 %}
                                                                            <input type="checkbox" name="tv" value="{{ tv }}" id="input-tv" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="tv" value="{{ tv }}" id="input-tv">
                                                                        {% endif %}

                                                                        <i></i>TV
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if pc == 1 %}
                                                                            <input type="checkbox" name="pc" value="{{ pc }}" id="input-pc" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="pc" value="{{ pc }}" id="input-pc">
                                                                        {% endif %}

                                                                        <i></i>Computadora
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if celular_ficha == 1 %}
                                                                            <input type="checkbox" name="celular_ficha" value="{{ celular_ficha }}" id="input-celular_ficha" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="celular_ficha" value="{{ celular_ficha }}" id="input-celular_ficha">
                                                                        {% endif %}

                                                                        <i></i>Celular
                                                                    </label>
                                                                </section>


                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if cocina == 1 %}
                                                                            <input type="checkbox" name="cocina" value="{{ cocina }}" id="input-cocina" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="cocina" value="{{ cocina }}" id="input-cocina">
                                                                        {% endif %}

                                                                        <i></i>Cocina
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if hervidora == 1 %}
                                                                            <input type="checkbox" name="hervidora" value="{{ hervidora }}" id="input-hervidora" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="hervidora" value="{{ hervidora }}" id="input-hervidora">
                                                                        {% endif %}

                                                                        <i></i>Hervidora
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if mesa == 1 %}
                                                                            <input type="checkbox" name="mesa" value="{{ mesa }}" id="input-mesa" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="mesa" value="{{ mesa }}" id="input-mesa">
                                                                        {% endif %}

                                                                        <i></i>Mesa
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if silla == 1 %}
                                                                            <input type="checkbox" name="silla" value="{{ silla }}" id="input-silla" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="silla" value="{{ silla }}" id="input-silla">
                                                                        {% endif %}

                                                                        <i></i>Silla
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if cama == 1 %}
                                                                            <input type="checkbox" name="cama" value="{{ cama }}" id="input-cama" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="cama" value="{{ cama }}" id="input-cama">
                                                                        {% endif %}

                                                                        <i></i>Cama
                                                                    </label>
                                                                </section>

                                                            </div>
                                                        </fieldset>

                                                        <header style="margin-top: -10px;">
                                                            Condición de Vivienda del Estudiante
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Número de Cuartos</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-nro_cuartos" name="nro_cuartos" placeholder="Número de Cuartos" value="{{ nro_cuartos }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Número de Personas</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-nro_personas_cuarto" name="nro_personas_cuarto" placeholder="Número de Personas" value="{{ nro_personas_cuarto }}" >

                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Vivienda</label>
                                                                    <label class="select">
                                                                        <select id="input-vivienda"  name="vivienda" >
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for v in viviendas %}
                                                                                {% if v.codigo == vivienda %}
                                                                                    <option selected="selected" value="{{ v.codigo }}">{{ v.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ v.codigo }}">{{ v.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Tipo de Vivienda</label>
                                                                    <label class="select">
                                                                        <select id="input-vivienda_tipo"  name="vivienda_tipo" >
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for tv in tipoviviendas %}
                                                                                {% if tv.codigo == vivienda_tipo %}
                                                                                    <option selected="selected" value="{{ tv.codigo }}">{{ tv.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ tv.codigo }}">{{ tv.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Material de Vivienda</label>
                                                                    <label class="select">
                                                                        <select id="input-vivienda_material"  name="vivienda_material" >
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for mv in materialviviendas %}
                                                                                {% if mv.codigo == vivienda_material %}
                                                                                    <option selected="selected" value="{{ mv.codigo }}">{{ mv.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ mv.codigo }}">{{ mv.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Material Techo Vivienda</label>
                                                                    <label class="select">
                                                                        <select id="input-vivienda_material_techo"  name="vivienda_material_techo" >
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for mtv in materialtechoviviendas %}
                                                                                {% if mtv.codigo == vivienda_material_techo %}
                                                                                    <option selected="selected" value="{{ mtv.codigo }}">{{ mtv.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ mtv.codigo }}">{{ mtv.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Vivienda Mterial Piso</label>
                                                                    <label class="select">
                                                                        <select id="input-vivienda_material_piso"  name="vivienda_material_piso">
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for v_m_p in viviendamaterialpiso %}
                                                                                {% if v_m_p.codigo == vivienda_material_piso %}
                                                                                    <option selected="selected" value="{{ v_m_p.codigo }}">{{ v_m_p.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ v_m_p.codigo }}">{{ v_m_p.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>


                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Vivienda Mterial Pared</label>
                                                                    <label class="select">
                                                                        <select id="input-vivienda_material_pared"  name="vivienda_material_pared">
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for v_m_pa in viviendamaterialpared %}
                                                                                {% if v_m_pa.codigo == vivienda_material_pared %}
                                                                                    <option selected="selected" value="{{ v_m_pa.codigo }}">{{ v_m_pa.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ v_m_pa.codigo }}">{{ v_m_pa.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Número de Ambientes</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-hashtag"></i>
                                                                        <input type="text" id="input-nro_ambientes" name="nro_ambientes" placeholder="Número de Ambientes" value="{{ nro_ambientes }}" >

                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">

                                                                    <label class="checkbox">

                                                                        {% if otros_servicios == 1 %}
                                                                            <input type="checkbox" name="otros_servicios" value="{{ otros_servicios }}" id="input-otros_servicios" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="otros_servicios" value="{{ otros_servicios }}" id="input-otros_servicios">
                                                                        {% endif %}

                                                                        <i></i>Otros

                                                                    </label>

                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-otros_servicios_descripcion" name="otros_servicios_descripcion" placeholder="Otros Servicios" value="{{ otros_servicios_descripcion }}" >

                                                                    </label>
                                                                </section>
                                                            </div>
                                                        </fieldset>

                                                        <header style="margin-top: -10px;">
                                                            Servicio de la vivienda
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if luz_ficha == 1 %}
                                                                            <input type="checkbox" name="luz_ficha" value="{{ luz_ficha }}" id="luz" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="luz_ficha" value="{{ luz_ficha }}" id="luz">
                                                                        {% endif %}

                                                                        <i></i>Luz
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if agua_ficha == 1 %}
                                                                            <input type="checkbox" name="agua_ficha" value="{{ agua_ficha }}" id="agua" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="agua_ficha" value="{{ agua_ficha }}" id="agua">
                                                                        {% endif %}

                                                                        <i></i>Agua
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if desague_ficha == 1 %}
                                                                            <input type="checkbox" name="desague_ficha" value="{{ desague_ficha }}" id="desague" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="desague_ficha" value="{{ desague_ficha }}" id="desague">
                                                                        {% endif %}

                                                                        <i></i>Desague
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if telefono_ficha == 1 %}
                                                                            <input type="checkbox" name="telefono_ficha" value="{{ telefono_ficha }}" id="telefono" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="telefono_ficha" value="{{ telefono_ficha }}" id="telefono">
                                                                        {% endif %}

                                                                        <i></i>Teléfono
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if cable_tv_ficha == 1 %}
                                                                            <input type="checkbox" name="cable_tv_ficha" value="{{ cable_tv_ficha }}" id="cable_tv" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="cable_tv_ficha" value="{{ cable_tv_ficha }}" id="cable_tv">
                                                                        {% endif %}

                                                                        <i></i>Cable tv
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if internet_ficha == 1 %}
                                                                            <input type="checkbox" name="internet_ficha" value="{{ internet_ficha }}" id="internet" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="internet_ficha" value="{{ internet_ficha }}" id="internet">
                                                                        {% endif %}

                                                                        <i></i>Internet
                                                                    </label>
                                                                </section>


                                                            </div>
                                                        </fieldset>
                                                        <header style="margin-top: -10px;">
                                                            Becas
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if beca_permanencia == 1 %}
                                                                            <input type="checkbox" name="beca_permanencia" value="{{ beca_permanencia }}" id="input-beca_permanencia" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="beca_permanencia" value="{{ beca_permanencia }}" id="inpu-beca_permanencia">
                                                                        {% endif %}

                                                                        <i></i>Beca permanencia
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if beca_completa_alimentacion == 1 %}
                                                                            <input type="checkbox" name="beca_completa_alimentacion" value="{{ beca_completa_alimentacion }}" id="input-beca_completa_alimentacion" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="beca_completa_alimentacion" value="{{ beca_completa_alimentacion }}" id="inpu-beca_completa_alimentacion">
                                                                        {% endif %}

                                                                        <i></i>Modalidad Beca Completa
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-2">
                                                                    <label class="checkbox">
                                                                        {% if subvencionada_alimentacion == 1 %}
                                                                            <input type="checkbox" name="subvencionada_alimentacion" value="{{ subvencionada_alimentacion }}" id="input-subvencionada_alimentacion" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="subvencionada_alimentacion" value="{{ subvencionada_alimentacion }}" id="inpu-subvencionada_alimentacion">
                                                                        {% endif %}

                                                                        <i></i>Modalidad Suvencionada
                                                                    </label>
                                                                </section>
                                                            </div>
                                                        </fieldset>
                                                        <header style="margin-top: -10px;">
                                                            Apreciación
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-12">
                                                                    <label class="text-info" >Apreciación</label>
                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-apreciacion" name="apreciacion" placeholder="Apreciación" value="{{ apreciacion }}" >

                                                                    </label>
                                                                </section>
                                                            </div>
                                                        </fieldset>
                                                    </div>


                                                    <div class="tab-pane fade" id="s5">

                                                        <header style="margin-top: 10px;">
                                                            Lugar de acceso a internet
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-4">
                                                                    <label class="checkbox">
                                                                        {% if acceso_internet_celular == 1 %}
                                                                            <input type="checkbox" name="acceso_internet_celular" value="{{ acceso_internet_celular }}" id="input-acceso_internet_celular" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="acceso_internet_celular" value="{{ acceso_internet_celular }}" id="input-acceso_internet_celular">
                                                                        {% endif %}

                                                                        <i></i>Celular
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="checkbox">
                                                                        {% if acceso_internet_vivienda == 1 %}
                                                                            <input type="checkbox" name="acceso_internet_vivienda" value="{{ acceso_internet_vivienda }}" id="input-acceso_internet_vivienda" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="acceso_internet_vivienda" value="{{ acceso_internet_vivienda }}" id="input-acceso_internet_vivienda">
                                                                        {% endif %}

                                                                        <i></i>Vivienda
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="checkbox">
                                                                        {% if acceso_internet_cabina == 1 %}
                                                                            <input type="checkbox" name="acceso_internet_cabina" value="{{ acceso_internet_cabina }}" id="input-acceso_internet_cabina" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="acceso_internet_cabina" value="{{ acceso_internet_cabina }}" id="input-acceso_internet_cabina">
                                                                        {% endif %}

                                                                        <i></i>Cabina
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="checkbox">
                                                                        {% if acceso_internet_universidad == 1 %}
                                                                            <input type="checkbox" name="acceso_internet_universidad" value="{{ acceso_internet_universidad }}" id="input-acceso_internet_universidad" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="acceso_internet_universidad" value="{{ acceso_internet_universidad }}" id="input-acceso_internet_universidad">
                                                                        {% endif %}

                                                                        <i></i>Universidad
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">

                                                                    <label class="checkbox">

                                                                        {% if acceso_internet_otros == 1 %}
                                                                            <input type="checkbox" name="acceso_internet_otros" value="{{ acceso_internet_otros }}" id="input-acceso_internet_otros" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="acceso_internet_otros" value="{{ acceso_internet_otros }}" id="input-acceso_internet_otros">
                                                                        {% endif %}

                                                                        <i></i>Otros

                                                                    </label>

                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-acceso_internet_otros_descripcion" name="acceso_internet_otros_descripcion" placeholder="Acceso internet otros" value="{{ acceso_internet_otros_descripcion }}" >

                                                                    </label>
                                                                </section>
                                                            </div>
                                                        </fieldset>

                                                        <header style="margin-top: 10px;">
                                                            Uso de Servicio de Internet
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-4">
                                                                    <label class="checkbox">
                                                                        {% if uso_internet_laptop_propia == 1 %}
                                                                            <input type="checkbox" name="uso_internet_laptop_propia" value="{{ uso_internet_laptop_propia }}" id="input-uso_internet_laptop_propia" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="uso_internet_laptop_propia" value="{{ uso_internet_laptop_propia }}" id="input-uso_internet_laptop_propia">
                                                                        {% endif %}

                                                                        <i></i>Laptop Propia
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="checkbox">
                                                                        {% if uso_internet_laptop_prestada == 1 %}
                                                                            <input type="checkbox" name="uso_internet_laptop_prestada" value="{{ uso_internet_laptop_prestada }}" id="input-uso_internet_laptop_prestada" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="uso_internet_laptop_prestada" value="{{ uso_internet_laptop_prestada }}" id="input-uso_internet_laptop_prestada">
                                                                        {% endif %}

                                                                        <i></i>Laptop Prestada
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="checkbox">
                                                                        {% if uso_internet_pc == 1 %}
                                                                            <input type="checkbox" name="uso_internet_pc" value="{{ uso_internet_pc }}" id="input-uso_internet_pc" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="uso_internet_pc" value="{{ uso_internet_pc }}" id="input-uso_internet_pc">
                                                                        {% endif %}

                                                                        <i></i>Computadora
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="checkbox">
                                                                        {% if uso_internet_celular_plan == 1 %}
                                                                            <input type="checkbox" name="uso_internet_celular_plan" value="{{ uso_internet_celular_plan }}" id="input-uso_internet_celular_plan" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="uso_internet_celular_plan" value="{{ uso_internet_celular_plan }}" id="input-uso_internet_celular_plan">
                                                                        {% endif %}

                                                                        <i></i>Celular con plan
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-4">
                                                                    <label class="checkbox">
                                                                        {% if uso_internet_celular_recarga == 1 %}
                                                                            <input type="checkbox" name="uso_internet_celular_recarga" value="{{ uso_internet_celular_recarga }}" id="input-uso_internet_celular_recarga" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="uso_internet_celular_recarga" value="{{ uso_internet_celular_recarga }}" id="input-uso_internet_celular_recarga">
                                                                        {% endif %}

                                                                        <i></i>Celular con recarga
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="checkbox">
                                                                        {% if uso_internet_celular_prestado == 1 %}
                                                                            <input type="checkbox" name="uso_internet_celular_prestado" value="{{ uso_internet_celular_prestado }}" id="input-uso_internet_celular_prestado" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="uso_internet_celular_prestado" value="{{ uso_internet_celular_prestado }}" id="input-uso_internet_celular_prestado">
                                                                        {% endif %}

                                                                        <i></i>Celular prestado
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">
                                                                    <label class="checkbox">
                                                                        {% if uso_internet_tablet == 1 %}
                                                                            <input type="checkbox" name="uso_internet_tablet" value="{{ uso_internet_tablet }}" id="input-uso_internet_tablet" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="uso_internet_tablet" value="{{ uso_internet_tablet }}" id="input-uso_internet_tablet">
                                                                        {% endif %}

                                                                        <i></i>Tablet
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-4">

                                                                    <label class="checkbox">

                                                                        {% if uso_internet_otros == 1 %}
                                                                            <input type="checkbox" name="uso_internet_otros" value="{{ uso_internet_otros }}" id="input-uso_internet_otros" checked> 
                                                                        {% else %}
                                                                            <input type="checkbox" name="uso_internet_otros" value="{{ uso_internet_otros }}" id="input-uso_internet_otros">
                                                                        {% endif %}

                                                                        <i></i>Otros

                                                                    </label>

                                                                    <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                                                                        <input type="text" id="input-uso_internet_otros_descripcion" name="uso_internet_otros_descripcion" placeholder="Uso internet otros" value="{{ uso_internet_otros_descripcion }}" >

                                                                    </label>
                                                                </section>
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="tab-pane fade" id="s6">

                                                        <header style="margin-top: 10px;">
                                                            Composición Familiar
                                                        </header>
                                                        <fieldset>
                                                            <div class="row">
                                                                <section class="col col-md-4">
                                                                    <label class="text-info" >Tipo de familia</label>
                                                                    <label class="select">
                                                                        <select id="input-composicion"  name="composicion" >
                                                                            <option value="" >SELECCIONE...</option>
                                                                            {% for cf in composiciones %}
                                                                                {% if cf.codigo == composicion %}
                                                                                    <option selected="selected" value="{{ cf.codigo }}">{{ cf.nombres }}</option>   
                                                                                {% else %}
                                                                                    <option value="{{ cf.codigo }}">{{ cf.nombres }}</option>   
                                                                                {% endif %}

                                                                            {% endfor %}
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-1">
                                                                    <a style="margin-top: 18px; height: 33px;" href="javascript:void(0);" onclick="agregar()" class="btn btn-primary btn-block"><i style="margin-top: 10px" class="fa fa-plus fa-lg"></i></a>
                                                                </section>

                                                                <section class="col col-md-1">
                                                                    <a  style="margin-top: 18px; height: 33px;" href="javascript:void(0);" onclick="editar()" class="btn btn-warning btn-block"><i  style="margin-top: 10px" class="fa fa-edit fa-lg"></i></a>
                                                                </section>

                                                                <section class="col col-md-1">
                                                                    <a style="margin-top: 18px; height: 33px;" href="javascript:void(0);" onclick="eliminar()" class="btn btn-danger btn-block"><i  style="margin-top: 10px" class="fa fa-trash fa-lg"></i></a>
                                                                </section>

                                                                <section class="col col-md-12">
                                                                    <table id="tbl_alumnos_familiares" class="table tablecuriosity table-striped table-hover" width="100%">
                                                                        <thead>			                
                                                                            <tr>
                                                                                <th>
                                                                        <center><i class="fa fa-check-circle"></i></center>
                                                                        </th>

                                                                        <th data-class="expand">Parentesco</th>
                                                                        <th>Apellido Paterno</th>
                                                                        <th data-hide="phone,tablet">Apellido Materno</th>
                                                                        <th data-hide="phone,tablet">Nombres</th>
                                                                        <th data-hide="phone,tablet">Edad</th>
                                                                        <th data-hide="phone,tablet">Estado Civil</th>
                                                                        <th data-hide="phone,tablet">Grado de Instrucción</th>
                                                                        <th data-hide="phone,tablet">Ocupación</th>

                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>				
                                                                        </tbody>
                                                                    </table>	
                                                                </section>

                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <footer>


                                        <button id="publicar" type="button" class="btn btn-primary">
                                            {{ txt_buton }}
                                        </button>
                                        <a href="javascript:history.back()"  type="button" class="btn btn-default" >
                                            Volver
                                        </a>


                                        <!--<a role="button" href="{{ url("alumnos/imprime/"~codigo~'/'~sem) }}"  target="_BLANK" class="btn btn-info  btn-md"><i class="fa fa-download"></i>  DESCARGAR FICHA</a>-->


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
</div>


<!--Formulario de registro de padres-->
{{ form('alumnosficha/saveFamiliares','method': 'post','id':'form_alumnos_familiares','class':'smart-form','enctype':'multipart/form-data','style':'display:none;') }}
<fieldset>
    <div class="row">
        <section class="col col-md-3">
            <label class="text-info" >Imagen Padres (600 x 400 px)</label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#imagen_familiar"><i class="fa fa-hand-o-up"></i> Click Aquí para mostrar Imagen</button>
            <div id="imagen_familiar" class="collapse">
                <img id="imagen_familiar_collapse" class="img-responsive" src="" error="this.onerror=null;this.src='';"></img>
            </div>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Documento</label>
            <label class="select">
                <select id="input-documento_familiares"  name="documento_familiares" >
                    <option value="" >SELECCIONE...</option>
                    {% for df in documentofamiliares %}

                        <option value="{{ df.codigo }}">{{ df.nombres }}</option>   

                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Nº de Documento</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-nro_doc_familiares" name="nro_doc_familiares" placeholder="Nº doc.">

            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Orden</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-orden_familiares" name="orden_familiares" placeholder="Orden">

            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Apellido Paterno</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-apellido_paterno_familiares" name="apellido_paterno_familiares" placeholder="Apellido Paterno">

            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Apellido Materno</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-apellido_materno_familiares" name="apellido_materno_familiares" placeholder="Apellido Materno">

            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Nombres</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-nombres_familiares" name="nombres_familiares" placeholder="Nombres" >
                <input type="hidden" id="input-codigo_familiar" name="codigo_familiares" value="">
                <input type="hidden" id="input-codigo_alumno" name="codigo_alumno" value="{{ codigo }}">
            </label>
        </section>


        <section class="col col-md-3">
            <label class="text-info" >Parentesco</label>
            <label class="select">
                <select id="input-parentesco_familiares"  name="parentesco_familiares" >
                    <option value="" >SELECCIONE...</option>
                    {% for p in parentescos %}

                        <option value="{{ p.codigo }}">{{ p.nombres }}</option>   


                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Grado de Instruccion</label>
            <label class="select">
                <select id="input-grado_instruccion_familiares"  name="grado_instruccion_familiares" >
                    <option value="" >SELECCIONE...</option>
                    {% for gif in gradoinstruccionfamiliares %}
                        <option value="{{ gif.codigo }}">{{ gif.nombres }}</option>   
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Lugar centro de estudios / labora</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-lugar_centro_estudios_familiares" name="lugar_centro_estudios_familiares" placeholder="Lugar centro de estudios / labora">
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Ocupacion</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-ocupacion_familiares" name="ocupacion_familiares" placeholder="Ocupacion">
            </label>
        </section>

        <section class="col col-md-3">
            <label class="text-info" >Ingresos</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-ingresos_familiares" name="ingresos_familiares" placeholder="ingresos">

            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Edad</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-edad_familiares" name="edad_familiares" placeholder="Edad">
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Sexo</label>
            <label class="select">
                <select id="input-sexo_familiares"  name="sexo_familiares" >
                    <option value="" >SELECCIONE...</option>
                    {% for sf in sexofamiliares %}
                        <option value="{{ sf.codigo }}">{{ sf.nombres }}</option>   
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >fecha de nacimiento (DD/MM/AAAA)</label>
            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" id="input-fecha_nacimiento_familiares" name="fecha_nacimiento_familiares" placeholder="Fecha Nac." class="datepicker" data-dateformat='dd/mm/yy' value="">
            </label>
        </section>
        <section class="col col-md-3">
            <label class="text-info" >Estado civil</label>
            <label class="select">
                <select id="input-estado_civil_familiares"  name="estado_civil_familiares" >
                    <option value="" >SELECCIONE...</option>
                    {% for ecf in estado_civil_familiares %}
                        <option value="{{ ecf.codigo }}">{{ ecf.nombres }}</option>   
                    {% endfor %}
                </select> <i></i>
            </label>
        </section>



        <section class="col col-md-12">
            <label class="text-info" >Observaciones</label>
            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-observaciones_familiares" name="observaciones_familiares" placeholder="Observaciones">
            </label>
        </section>
        <section class="col col-md-6">

            <label class="text-info" >Agregar Archivo</label>
            <div class="input input-file" id="archivo_alumno_familiares_modal">

                {#<input type="file" id="archivo_personal" name="archivo_personal" >
                <input type="hidden" id="input-archivo" name="archivo" value="{{ archivo }}">#}

                <span class="button"><input id="archivo_personal_familiares" type="file" name="archivo" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');" disabled><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-file_personal_familiares" name="input-file"  placeholder="Agregar Archivo" readonly="">

            </div>

        </section>

        <section class="col col-md-6">

            <label class="text-info" >Agregar Imagen (600 x 400 px)</label>
            <div class="input input-file" id="imagen_alumno_familiares_modal">

                <label class="input">

                    <span class="button"><input id="imagen_personal_familiares" type="file" name="imagen" onchange="this.parentNode.nextSibling.value = this.value.replace('C:\\fakepath\\', '');" disabled><i class="fa fa-search"></i> Buscar</span><input type="text" id="input-image_personal_familiares" name="input-file"  placeholder="Agregar Imagen" readonly="">
                </label>
            </div>

        </section>

        <section class="col col-md-3">

            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="enfermedad_familiares"  id="enfermedad_familiares">
                <i></i>Enfermedad - Nombre
            </label>

            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-enfermedad_nombre_familiares" name="enfermedad_nombre_familiares" placeholder="Nombre Enfermedad" >

            </label>
        </section>


        <section class="col col-md-3">
            <label class="text-info" style="color: #346597;" >Tiempo Enfermedad</label>
            <label class="input" style="margin-top: 10px;"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-enfermedad_tiempo_familiares" name="enfermedad_tiempo_familiares" placeholder="Tiempo Enfermedad">
            </label>
        </section>


        <section class="col col-md-3">

            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="tratamiento_familiares"  id="tratamiento_familiares">
                <i></i>Tratamiento - Lugar
            </label>

            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-tratamiento_lugar_familiares" name="tratamiento_lugar_familiares" placeholder="Lugar Tratamiento" >

            </label>
        </section>


        <section class="col col-md-3">

            <label class="checkbox" style="color: #346597;">

                <input type="checkbox" name="discapacidad_familiares"  id="discapacidad_familiares">

                <i></i>Discapacidad - Nombre
            </label>

            <label class="input"> <i class="icon-prepend fa fa-edit"></i>
                <input type="text" id="input-discapacidad_nombre_familiares" name="discapacidad_nombre_familiares" placeholder="Nombre discapacidad" >

            </label>
        </section>



        <section class="col col-md-2">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="casa_familiares" value="" id="casa_familiares">
                <i></i>Casa
            </label>
        </section>

        <section class="col col-md-2">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="camion_familiares" value="" id="camion_familiares">
                <i></i>Camion
            </label>
        </section>

        <section class="col col-md-2">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="auto_familiares" value="" id="auto_familiares">
                <i></i>Auto
            </label>
        </section>
        <section class="col col-md-2">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="mototaxi_familiares" value="" id="mototaxi_familiares">
                <i></i>Mototaxi
            </label>
        </section>
        <section class="col col-md-2">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="predios_familiares" value="" id="predios_familiares">
                <i></i>Predios
            </label>
        </section>

        <section class="col col-md-2">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="tv_familiares" value="" id="tv_familiares">
                <i></i>Tv
            </label>
        </section>

        <section class="col col-md-2">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="equipo_familiares" value="" id="equipo_familiares">
                <i></i>Equipo
            </label>
        </section>
        <section class="col col-md-2">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="animales_familiares" value="" id="animales_familiares">
                <i></i>Animales
            </label>
        </section>
        <section class="col col-md-2">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="sillas_familiares" value="" id="sillas_familiares">
                <i></i>Sillas
            </label>
        </section>
        <section class="col col-md-2">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="mesas_familiares" value="" id="mesas_familiares">
                <i></i>Mesas
            </label>
        </section>

        <section class="col col-md-2">
            <label class="checkbox" style="color: #346597;">
                <input type="checkbox" name="es_principal_familiares" value="" id="es_principal_familiares">
                <i></i>Es principal
            </label>
        </section>

    </div>
</fieldset>
{{ endForm() }}
<!-- Modal Registro Imagen -->
<div class="modal fade" id="modal_registro_imagen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">Imagen</h4>
            </div>
            <div class="modal-body">
                <img class="img-responsive" src="{{ url('adminpanel/imagenes/alumnos_familiares/'~foto) }}" error="this.onerror=null;this.src='';"></img>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
                {#<button type="button" class="btn btn-primary">
                    Post Article
                </button>#}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" >
    var codigo_alumno = '{{ codigo }}';
</script>
<script type="text/javascript" >


    var publica = "si";

    //Ubigeo
    var region_id = '{{ region }}';
    var provincia_id = '{{ provincia }}';
    var distrito_id = '{{ distrito }}';

    //Lugar de procedencia
    var region1_id = '{{ region1 }}';
    var provincia1_id = '{{ provincia1 }}';
    var distrito1_id = '{{ distrito1 }}';


    //Ficha por semestre
    {% if sem is defined %}
        var semestreax = "{{ sem }}";
        console.log("Carga semestre seleccionado: " + semestreax);
    {% else %}

        var semestreax = "{{ semestrea }}";
        console.log("Carga semestre por defecto: " + semestreax);
    {% endif %}

</script>
<script type="text/javascript" > var perfil = "{{ perfil }}";</script>