<?php
$router->add('/test', array(
    'controller' => 'test',
    'action' => 'index'
));
$router->add('/testemail/{email}', array(
    'controller' => 'test',
    'action' => 'testemail',
    'params' => 1
));
$router->add('/test_unca', array(
    'controller' => 'test',
    'action' => 'testunca'
));
$router->add('/test-web', array(
    'controller' => 'test',
    'action' => 'web'
));
$router->add('/login-convocatorias', array(
    'controller' => 'seguridad',
    'action' => 'loginConvocatorias'
));
$router->add('/login-convocatorias-docentes', array(
    'controller' => 'seguridad',
    'action' => 'loginConvocatoriasDocentes'
));
$router->add('/login-ratificacion-docentes', array(
    'controller' => 'seguridad',
    'action' => 'loginRatificacionDocentes'
));
$router->add('/login-perfil', array(
    'controller' => 'seguridad',
    'action' => 'loginPerfil'
));
$router->add('/google-verify', array(
    'controller' => 'seguridad',
    'action' => 'googleVerify'
));
$router->add('/admin', array(
    'controller' => 'seguridad',
    'action' => 'index'
));
$router->add('/login-inventory', array(
    'controller' => 'logininventory',
    'action' => 'index'
));
$router->add('/panel', array(
    'controller' => 'panel',
    'action' => 'index'
));



$router->add('/', array(
    'controller' => 'web',
    'action' => 'index'
));



//admision

$router->add('/admision', array(
    'controller' => 'webadmision',
    'action' => 'index'
));


$router->add('/presentacion-admision.html', array(
    'controller' => 'webadmision',
    'action' => 'presentacion_admision'
));

$router->add('/comision-admision.html', array(
    'controller' => 'webadmision',
    'action' => 'comision_admision'
));

$router->add('/perfil-estudiante.html', array(
    'controller' => 'webadmision',
    'action' => 'perfil_estudiante'
));

$router->add('/modalidad-ordinario.html', array(
    'controller' => 'webadmision',
    'action' => 'modalidad_ordinario'
));

$router->add('/modalidad-extraordinario.html', array(
    'controller' => 'webadmision',
    'action' => 'modalidad_extraordinario'
));

$router->add('/resultados.html', array(
    'controller' => 'webadmision',
    'action' => 'resultados'
));

$router->add('/vacantes.html', array(
    'controller' => 'webadmision',
    'action' => 'vacantes'
));

$router->add('/cronograma.html', array(
    'controller' => 'webadmision',
    'action' => 'cronograma'
));

$router->add('/documentos-admision.html', array(
    'controller' => 'webadmision',
    'action' => 'documentos_admision'
));

$router->add('/proceso-admision.html', array(
    'controller' => 'webadmision',
    'action' => 'proceso_admision'
));

$router->add('/costos.html', array(
    'controller' => 'webadmision',
    'action' => 'costos'
));

$router->add('/temario.html', array(
    'controller' => 'webadmision',
    'action' => 'temario'
));

$router->add('/prospecto.html', array(
    'controller' => 'webadmision',
    'action' => 'prospecto'
));

$router->add('/examen-ordinario.html', array(
    'controller' => 'webadmision',
    'action' => 'examen_ordinario'
));

$router->add('/examen-extraordinario.html', array(
    'controller' => 'webadmision',
    'action' => 'examen_extraordinario'
));

$router->add('/recomendaciones-examen.html', array(
    'controller' => 'webadmision',
    'action' => 'recomendaciones_examen'
));

$router->add('/preguntas-frecuentes.html', array(
    'controller' => 'webadmision',
    'action' => 'preguntas_frecuentes'
));




//cepre

$router->add('/cepre', array(
    'controller' => 'webcepre',
    'action' => 'index'
));


$router->add('/cepre-presentacion.html', array(
    'controller' => 'webcepre',
    'action' => 'cepre_presentacion'
));

$router->add('/cepre-mision-vision.html', array(
    'controller' => 'webcepre',
    'action' => 'cepre_mision_vision'
));

$router->add('/cepre-direccion.html', array(
    'controller' => 'webcepre',
    'action' => 'cepre_direccion'
));

$router->add('/cepre-ciclo-intensivo.html', array(
    'controller' => 'webcepre',
    'action' => 'cepre_ciclo_intensivo'
));

$router->add('/cepre-documentos-inscripcion.html', array(
    'controller' => 'webcepre',
    'action' => 'cepre_documentos_inscripcion'
));

$router->add('/cepre-proceso-inscripcion.html', array(
    'controller' => 'webcepre',
    'action' => 'cepre_proceso_inscripcion'
));

$router->add('/cepre-cuenta.html', array(
    'controller' => 'webcepre',
    'action' => 'cepre_cuenta'
));


//web


$router->add('/cepre.html', array(
    'controller' => 'web',
    'action' => 'cepre'
));

$router->add('/unca-cepre.html', array(
    'controller' => 'web',
    'action' => 'unca_cepre'
));

$router->add('/unaaa-cepre.html', array(
    'controller' => 'web',
    'action' => 'unaaa_cepre'
));

$router->add('/unaaa-registros-academicos.html', array(
    'controller' => 'web',
    'action' => 'unaaa_registros_academicos'
));

$router->add('/unaaa-atencion-estudiantes.html', array(
    'controller' => 'web',
    'action' => 'unaaa_atencion_estudiantes'
));

$router->add('/unaaa-campus-virtual.html', array(
    'controller' => 'web',
    'action' => 'unaaa_campus_virtual'
));


$router->add('/qr_validacion', array(
    'controller' => 'web',
    'action' => 'qr_validacion'
));
$router->add('/qr_validacion/doc/{id}', array(
    'controller' => 'qrvalidation',
    'action' => 'qr_validacion_doc',
    'params' => 1
));
$router->add('/qr_validacion_process/doc', array(
    'controller' => 'qrvalidation',
    'action' => 'qr_validacion_process',
    'params' => 1
));
$router->add('/unca-admision.html', array(
    'controller' => 'web',
    'action' => 'unca_admision'
));

$router->add('/unaaa-admision.html', array(
    'controller' => 'web',
    'action' => 'unaaa_admision'
));

$router->add('/unca-info-obras.html', array(
    'controller' => 'web',
    'action' => 'unca_info_obras'
));

$router->add('/vd-antecedentes-historicos.html', array(
    'controller' => 'web',
    'action' => 'vd_antecedentes_historicos'
));

$router->add('/rlfm-presentacion.html', array(
    'controller' => 'web',
    'action' => 'rlfm_presentacion'
));

$router->add('/rlfm-historia.html', array(
    'controller' => 'web',
    'action' => 'rlfm_historia'
));

$router->add('/rlfm-masoneria-medellin.html', array(
    'controller' => 'web',
    'action' => 'rlfm_masoneria_medellin'
));

$router->add('/rlfm-contactenos.html', array(
    'controller' => 'web',
    'action' => 'rlfm_contactenos'
));

$router->add('/rlfm-francisco-miranda.html', array(
    'controller' => 'web',
    'action' => 'rlfm_francisco_miranda'
));

$router->add('/mision-vision.html', array(
    'controller' => 'web',
    'action' => 'mision_vision'
));

$router->add('/unca-control-interno.html', array(
    'controller' => 'web',
    'action' => 'unca_control_interno'
));

$router->add('/unca-mision-vision.html', array(
    'controller' => 'web',
    'action' => 'unca_mision_vision'
));

$router->add('/unaaa-mision-vision.html', array(
    'controller' => 'web',
    'action' => 'unaaa_mision_vision'
));

$router->add('/mdb-mision-vision.html', array(
    'controller' => 'web',
    'action' => 'mdb_mision_vision'
));

$router->add('/ytas-mision-vision.html', array(
    'controller' => 'web',
    'action' => 'unaaa_mision_vision'
));

$router->add('/asedeh-mision-vision.html', array(
    'controller' => 'web',
    'action' => 'asedeh_mision_vision'
));

$router->add('/cip-mision-vision.html', array(
    'controller' => 'web',
    'action' => 'cip_mision_vision'
));

$router->add('/consultores-mision-vision.html', array(
    'controller' => 'web',
    'action' => 'consultores_mision_vision'
));

$router->add('/cv-mision-vision.html', array(
    'controller' => 'web',
    'action' => 'cv_mision_vision'
));

$router->add('/cv-presentacion.html', array(
    'controller' => 'web',
    'action' => 'cv_presentacion'
));

$router->add('/achiote-presentacion.html', array(
    'controller' => 'web',
    'action' => 'achiote_presentacion'
));

$router->add('/achiote-patronato-cultural.html', array(
    'controller' => 'web',
    'action' => 'achiote_patronato_cultural'
));

$router->add('/achiote-mision.html', array(
    'controller' => 'web',
    'action' => 'achiote_mision'
));

$router->add('/achiote-directo.html', array(
    'controller' => 'web',
    'action' => 'achiote_directo'
));

$router->add('/achiote-fines-objetivos.html', array(
    'controller' => 'web',
    'action' => 'achiote_fines_objetivos'
));

$router->add('/achiote-impacto.html', array(
    'controller' => 'web',
    'action' => 'achiote_impacto'
));

$router->add('/achiote-significado.html', array(
    'controller' => 'web',
    'action' => 'achiote_significado'
));

$router->add('/achiote-actividad-ruta.html', array(
    'controller' => 'web',
    'action' => 'achiote_actividad_ruta'
));

$router->add('/achiote-actividad-eleccion.html', array(
    'controller' => 'web',
    'action' => 'achiote_actividad_eleccion'
));

$router->add('/achiote-actividad-feria.html', array(
    'controller' => 'web',
    'action' => 'achiote_actividad_feria'
));

$router->add('/achiote-actividad-ritual.html', array(
    'controller' => 'web',
    'action' => 'achiote_actividad_ritual'
));

$router->add('/achiote-actividad-corso.html', array(
    'controller' => 'web',
    'action' => 'achiote_actividad_corso'
));

$router->add('/achiote-actividad-celebracion.html', array(
    'controller' => 'web',
    'action' => 'achiote_actividad_celebracion'
));

$router->add('/achiote-actividad-festival-danza.html', array(
    'controller' => 'web',
    'action' => 'achiote_actividad_festival_danza'
));

$router->add('/achiote-actividad-festival-arte.html', array(
    'controller' => 'web',
    'action' => 'achiote_actividad_festival_arte'
));

$router->add('/achiote-actividad-festival-musica.html', array(
    'controller' => 'web',
    'action' => 'achiote_actividad_festival_musica'
));

$router->add('/web-en-directo-fb.html', array(
    'controller' => 'web',
    'action' => 'web_en_directo_fb'
));

$router->add('/web-en-directo-yt.html', array(
    'controller' => 'web',
    'action' => 'web_en_directo_yt'
));

$router->add('/cv-objetivos.html', array(
    'controller' => 'web',
    'action' => 'cv_objetivos'
));

$router->add('/cv-objetivos.html', array(
    'controller' => 'web',
    'action' => 'cv_objetivos'
));

$router->add('/cv-tips.html', array(
    'controller' => 'web',
    'action' => 'cv_tips'
));

$router->add('/cv-novedades.html', array(
    'controller' => 'web',
    'action' => 'cv_novedades'
));

$router->add('/cv-testimonios.html', array(
    'controller' => 'web',
    'action' => 'cv_testimonios'
));

$router->add('/cv-direccion.html', array(
    'controller' => 'web',
    'action' => 'cv_direccion'
));

$router->add('/cv-modelo-negocio.html', array(
    'controller' => 'web',
    'action' => 'cv_modelo_negocio'
));

$router->add('/asedeh-lineas-accion.html', array(
    'controller' => 'web',
    'action' => 'asedeh_lineas_accion'
));

$router->add('/asedeh-finalidad.html', array(
    'controller' => 'web',
    'action' => 'asedeh_finalidad'
));

$router->add('/unca-gestion-convenios.html', array(
    'controller' => 'web',
    'action' => 'unca_gestion_convenios'
));

$router->add('/gestion-ambiental.html', array(
    'controller' => 'web',
    'action' => 'gestion_ambiental'
));

$router->add('/unaaa-gestion-ambiental.html', array(
    'controller' => 'web',
    'action' => 'unaaa_gestion_ambiental'
));

$router->add('/unca-gestion-ambiental.html', array(
    'controller' => 'web',
    'action' => 'unca_gestion_ambiental'
));

$router->add('/web-ambientes.html', array(
    'controller' => 'web',
    'action' => 'web_ambientes'
));

$router->add('/unca-ambientes.html', array(
    'controller' => 'web',
    'action' => 'unca_ambientes'
));

$router->add('/unaaa-ambientes.html', array(
    'controller' => 'web',
    'action' => 'unaaa_ambientes'
));

$router->add('/web-noticias.html', array(
    'controller' => 'web',
    'action' => 'web_noticias'
));

$router->add('/web-boletines.html', array(
    'controller' => 'web',
    'action' => 'web_boletines'
));

$router->add('/web-convenios.html', array(
    'controller' => 'web',
    'action' => 'web_convenios'
));

$router->add('/web-proyectos-investigacion.html', array(
    'controller' => 'web',
    'action' => 'web_proyectos_investigacion'
));

$router->add('/web-proyectos-inversion.html', array(
    'controller' => 'web',
    'action' => 'web_proyectos_inversion'
));

$router->add('/web-carreras.html', array(
    'controller' => 'web',
    'action' => 'web_carreras'
));

$router->add('/web-eventos.html', array(
    'controller' => 'web',
    'action' => 'web_eventos'
));

$router->add('/web-convocatorias/{tipo}.html', array(
    'controller' => 'web',
    'action' => 'web_convocatorias'
));


$router->add('/web-convocatoriasbs/{tipo}.html', array(
    'controller' => 'web',
    'action' => 'web_convocatoriasbs'
));

$router->add('/web-detalle-noticia/{id}.html', array(
    'controller' => 'web',
    'action' => 'web_detalle_noticia',
    'params' => 1
));

$router->add('/web-detalle-galeria/{id}.html', array(
    'controller' => 'web',
    'action' => 'web_detalle_galeria',
    'params' => 1
));

//
//$router->add('/web/detalle-galeria/id-{id}/page={pagina}', array(
//    'controller' => 'web',
//    'action' => 'detalle_galeria',
//    'id' => 1,
//    'page'=>2
//));






$router->add('/web-detalle-convenio/{id}.html', array(
    'controller' => 'web',
    'action' => 'web_detalle_convenio',
    'params' => 1
));

$router->add('/web-detalle-servicio/{id}.html', array(
    'controller' => 'web',
    'action' => 'web_detalle_servicio',
    'params' => 1
));

$router->add('/web-detalle-ambiente/{id}.html', array(
    'controller' => 'web',
    'action' => 'web_detalle_ambiente',
    'params' => 1
));

$router->add('/web-detalle-proyecto-investigacion/{id}.html', array(
    'controller' => 'web',
    'action' => 'web_detalle_proyecto_investigacion',
    'params' => 1
));

$router->add('/web-detalle-carrera/{id}.html', array(
    'controller' => 'web',
    'action' => 'web_detalle_carrera',
    'params' => 1
));

$router->add('/web-detalle-evento/{id}.html', array(
    'controller' => 'web',
    'action' => 'web_detalle_evento',
    'params' => 1
));

$router->add('/web-detalle-convocatoria/{id}.html', array(
    'controller' => 'web',
    'action' => 'web_detalle_convocatoria',
    'params' => 1
));

$router->add('/web-detalle-convocatoriabs/{id}.html', array(
    'controller' => 'web',
    'action' => 'web_detalle_convocatoriabs',
    'params' => 1
));

$router->add('/presentacion.html', array(
    'controller' => 'web',
    'action' => 'presentacion'
));

$router->add('/unca-presentacion.html', array(
    'controller' => 'web',
    'action' => 'unca_presentacion'
));

$router->add('/unaaa-presentacion.html', array(
    'controller' => 'web',
    'action' => 'unaaa_presentacion'
));

$router->add('/mdb-presentacion.html', array(
    'controller' => 'web',
    'action' => 'mdb_presentacion'
));

$router->add('/ytas-presentacion.html', array(
    'controller' => 'web',
    'action' => 'ytas_presentacion'
));

$router->add('/consultores-presentacion.html', array(
    'controller' => 'web',
    'action' => 'consultores_presentacion'
));

$router->add('/cip-presentacion.html', array(
    'controller' => 'web',
    'action' => 'cip_presentacion'
));

$router->add('/cip-busqueda-colegiados.html', array(
    'controller' => 'web',
    'action' => 'cip_busqueda_colegiados'
));

$router->add('/cip-tramite-colegiatura.html', array(
    'controller' => 'web',
    'action' => 'cip_tramite_colegiatura'
));

$router->add('/cip-tramite-certificado-habilidad.html', array(
    'controller' => 'web',
    'action' => 'cip_tramite_certificado_habilidad'
));

$router->add('/cip-tramite-cambio-sede.html', array(
    'controller' => 'web',
    'action' => 'cip_tramite_cambio_sede'
));

$router->add('/consultores-direccion.html', array(
    'controller' => 'web',
    'action' => 'consultores_direccion'
));

$router->add('/consultores-laboratorio-asfalto.html', array(
    'controller' => 'web',
    'action' => 'consultores_laboratorio_asfalto'
));

$router->add('/consultores-laboratorio-concreto.html', array(
    'controller' => 'web',
    'action' => 'consultores_laboratorio_concreto'
));

$router->add('/consultores-laboratorio-suelos.html', array(
    'controller' => 'web',
    'action' => 'consultores_laboratorio_suelos'
));

$router->add('/consultores-mecanica-suelos.html', array(
    'controller' => 'web',
    'action' => 'consultores_mecanica_suelos'
));

$router->add('/web-estudiantes.html', array(
    'controller' => 'web',
    'action' => 'web_estudiantes'
));

$router->add('/web-docentes.html', array(
    'controller' => 'web',
    'action' => 'web_docentes'
));

$router->add('/web-resoluciones.html', array(
    'controller' => 'web',
    'action' => 'web_resoluciones'
));

$router->add('/web-libros.html', array(
    'controller' => 'web',
    'action' => 'web_libros'
));

$router->add('/web-organigrama.html', array(
    'controller' => 'web',
    'action' => 'web_organigrama'
));

$router->add('/carreras.html', array(
    'controller' => 'web',
    'action' => 'carreras'
));


$router->add('/unaaa-documentos-gestion.html', array(
    'controller' => 'web',
    'action' => 'unaaa_documentos_gestion'
));

$router->add('/unca-documentos-gestion.html', array(
    'controller' => 'web',
    'action' => 'unca_documentos_gestion'
));

$router->add('/web-licenciamiento1.html', array(
    'controller' => 'web',
    'action' => 'web_licenciamiento1'
));

$router->add('/web-licenciamiento.html', array(
    'controller' => 'web',
    'action' => 'web_licenciamiento'
));

$router->add('/unca-proceso-elecciones-sst-2022-1.html', array(
    'controller' => 'web',
    'action' => 'unca_proceso_elecciones_sst_2022_1'
));

$router->add('/unca-transparencia-universitaria.html', array(
    'controller' => 'web',
    'action' => 'unca_transparencia_universitaria'
));

$router->add('/web-transparencia-estandar.html', array(
    'controller' => 'web',
    'action' => 'web_transparencia_estandar'
));

$router->add('/unaaa-transparencia-universitaria.html', array(
    'controller' => 'web',
    'action' => 'unaaa_transparencia_universitaria'
));

$router->add('/web-documentos/{enlace}.html', array(
    'controller' => 'web',
    'action' => 'web_documentos',
    'params' => 1
));

$router->add('/web-documentos-archivos/{enlace}.html', array(
    'controller' => 'web',
    'action' => 'web_documentos_archivos',
    'params' => 1
));

$router->add('/web-documentos-evaluaciones/{enlace}.html', array(
    'controller' => 'web',
    'action' => 'web_documentos_evaluaciones',
    'params' => 1
));

$router->add('/web-documentos-generales/{enlace}.html', array(
    'controller' => 'web',
    'action' => 'web_documentos_generales',
    'params' => 1
));

$router->add('/web-documentos-gestion.html', array(
    'controller' => 'web',
    'action' => 'web_documentos_gestion'
));

//procesos
$router->add('/web-docprocesos/{enlace}.html', array(
    'controller' => 'web',
    'action' => 'web_docprocesos',
    'params' => 1
));

$router->add('/web-docprocesos-archivos/{enlace}.html', array(
    'controller' => 'web',
    'action' => 'web_docprocesos_archivos',
    'params' => 1
));


$router->add('/web-autoridades/{enlace}.html', array(
    'controller' => 'web',
    'action' => 'web_autoridades',
    'params' => 1
));

$router->add('/web-areas/{enlace}.html', array(
    'controller' => 'web',
    'action' => 'web_areas',
    'params' => 1
));

$router->add('/web-areas-unidades/{enlace}.html', array(
    'controller' => 'web',
    'action' => 'web_areas_unidades',
    'params' => 1
));

$router->add('/web-visitas.html', array(
    'controller' => 'web',
    'action' => 'web_visitas'
));

$router->add('/web-comision-organizadora.html', array(
    'controller' => 'web',
    'action' => 'web_comision_organizadora'
));

$router->add('/web-concejo-municipal.html', array(
    'controller' => 'web',
    'action' => 'web_concejo_municipal'
));

$router->add('/autoridades.html', array(
    'controller' => 'web',
    'action' => 'autoridades'
));

$router->add('/centro-pagos.html', array(
    'controller' => 'web',
    'action' => 'centro_pagos'
));

$router->add('/unca-centro-pagos.html', array(
    'controller' => 'web',
    'action' => 'unca_centro_pagos'
));

$router->add('/unaaa-centro-pagos.html', array(
    'controller' => 'web',
    'action' => 'unaaa_centro_pagos'
));

$router->add('/direccion.html', array(
    'controller' => 'web',
    'action' => 'direccion'
));

$router->add('/unca-direccion.html', array(
    'controller' => 'web',
    'action' => 'unca_direccion'
));

$router->add('/unaaa-direccion.html', array(
    'controller' => 'web',
    'action' => 'unaaa_direccion'
));

$router->add('/asedeh-direccion.html', array(
    'controller' => 'web',
    'action' => 'asedeh_direccion'
));

$router->add('/asedeh-ejes.html', array(
    'controller' => 'web',
    'action' => 'asedeh_ejes'
));

$router->add('/asedeh-acciones.html', array(
    'controller' => 'web',
    'action' => 'asedeh_acciones'
));

$router->add('/asedeh-material-educativo.html', array(
    'controller' => 'web',
    'action' => 'asedeh_material_educativo'
));

$router->add('/asedeh-objetivos.html', array(
    'controller' => 'web',
    'action' => 'asedeh_objetivos'
));

$router->add('/asedeh-presentacion.html', array(
    'controller' => 'web',
    'action' => 'asedeh_presentacion'
));

$router->add('/asedeh-ejes.html', array(
    'controller' => 'web',
    'action' => 'asedeh_ejes'
));

$router->add('/asedeh-voluntariado.html', array(
    'controller' => 'web',
    'action' => 'asedeh_voluntariado'
));

$router->add('/aspefeen-mision.html', array(
    'controller' => 'web',
    'action' => 'aspefeen_mision'
));

$router->add('/aspefeen-vision.html', array(
    'controller' => 'web',
    'action' => 'aspefeen_vision'
));

$router->add('/aspefeen-presentacion.html', array(
    'controller' => 'web',
    'action' => 'aspefeen_presentacion'
));

$router->add('/aspefeen-consejo-directivo.html', array(
    'controller' => 'web',
    'action' => 'aspefeen_consejo_directivo'
));

$router->add('/aspefeen-contactenos.html', array(
    'controller' => 'web',
    'action' => 'aspefeen_contactenos'
));

$router->add('/aspefeen-asociados.html', array(
    'controller' => 'web',
    'action' => 'aspefeen_asociados'
));

$router->add('/aspefeen-enae.html', array(
    'controller' => 'web',
    'action' => 'aspefeen_enae'
));

$router->add('/aspefeen-enae-tasas-pago.html', array(
    'controller' => 'web',
    'action' => 'aspefeen_enae_tasas_pago'
));

$router->add('/aspefeen-enae-tabla-especificaciones.html', array(
    'controller' => 'web',
    'action' => 'aspefeen_enae_tabla_especificaciones'
));

$router->add('/aspefeen-enae-lugar-pago.html', array(
    'controller' => 'web',
    'action' => 'aspefeen_enae_lugar_pago'
));

$router->add('/aspefeen-enae-cronograma.html', array(
    'controller' => 'web',
    'action' => 'aspefeen_enae_cronograma'
));

$router->add('/aspefeen-enae-reglamento.html', array(
    'controller' => 'web',
    'action' => 'aspefeen_enae_reglamento'
));

$router->add('/aspefeen-enae-convocatoria.html', array(
    'controller' => 'web',
    'action' => 'aspefeen_enae_convocatoria'
));

$router->add('/aspefeen-enae-contactenos.html', array(
    'controller' => 'web',
    'action' => 'aspefeen_enae_contactenos'
));

$router->add('/web-directorio-docentes.html', array(
    'controller' => 'web',
    'action' => 'web_directorio_docentes'
));

$router->add('/directorio-docentes-investigacion.html', array(
    'controller' => 'web',
    'action' => 'web_directorio_docentes_investigacion'
));

$router->add('/web-directorio-administrativos.html', array(
    'controller' => 'web',
    'action' => 'web_directorio_administrativos'
));

$router->add('/web-directorio-personal.html', array(
    'controller' => 'web',
    'action' => 'web_directorio_personal'
));

$router->add('/mallas-curriculares.html', array(
    'controller' => 'web',
    'action' => 'mallas_curriculares'
));

$router->add('/unca-mallas-curriculares.html', array(
    'controller' => 'web',
    'action' => 'unca_mallas_curriculares'
));

$router->add('/unaaa-mallas-curriculares.html', array(
    'controller' => 'web',
    'action' => 'unaaa_mallas_curriculares'
));

$router->add('/web-licenciamiento1-cbc/{enlace}.html', array(
    'controller' => 'web',
    'action' => 'web_licenciamiento1_cbc'
));

$router->add('/web-licenciamiento-cbc/{enlace}.html', array(
    'controller' => 'web',
    'action' => 'web_licenciamiento_cbc'
));

//preinscripcion
$router->add('/web-preinscripcion.html', array(
    'controller' => 'web',
    'action' => 'web_preinscripcion'
));



//login-colegiados.html
$router->add('/login-colegiados.html', array(
    'controller' => 'web',
    'action' => 'login_colegiados'
));

//servicios.hmtl
$router->add('/web-servicios.html', array(
    'controller' => 'web',
    'action' => 'web_servicios'
));

//videos.hmtl
$router->add('/web-videos.html', array(
    'controller' => 'web',
    'action' => 'web_videos'
));

//galerias.hmtl
$router->add('/web-galerias.html', array(
    'controller' => 'web',
    'action' => 'web_galerias'
));

//----------------------------------login.html----------------------------------
//alumnos y docentes
$router->add('/login.html', array(
    'controller' => 'seguridad',
    'action' => 'loginPerfil'
));
 
$router->add('/recuperar-contrasenha-web.html', array(
    'controller' => 'web',
    'action' => 'recuperarcontrasenhaweb'
));
//recupear contraseña estudiante
$router->add('/recuperarc1/{enlace}', array(
    'controller' => 'web',
    'action' => 'recuperarc1',
    'params' => 1
));
//recupear contraseña docente
$router->add('/recuperarc2/{enlace}', array(
    'controller' => 'web',
    'action' => 'recuperarc2',
    'params' => 1
));

//------------------------------login-interno.html------------------------------
//personal
/*$router->add('/login-interno.html', array(
    'controller' => 'web',
    'action' => 'login_interno'
));*/
$router->add('/login-interno.html', array(
    'controller' => 'seguridad',
    'action' => 'loginInterno'
));
$router->add('/recuperar-contrasenha-web-interno.html', array(
    'controller' => 'web',
    'action' => 'recuperarcontrasenhawebinterno'
));
//recupear contraseña personal
$router->add('/recuperarc3/{enlace}', array(
    'controller' => 'web',
    'action' => 'recuperarc3',
    'params' => 1
));
//------------------------------login-externo.html------------------------------
//publico y empresas
$router->add('/login-externo.html', array(
    'controller' => 'web',
    'action' => 'login_externo'
));

$router->add('/recuperar-contrasenha-web-externo.html', array(
    'controller' => 'web',
    'action' => 'recuperarcontrasenhawebexterno'
));

$router->add('/recuperar-contrasenha-web-externo2.html', array(
    'controller' => 'web',
    'action' => 'recuperarcontrasenhawebexterno2'
));

//recuperar contraseña persona natural
$router->add('/recuperarc4/{enlace}', array(
    'controller' => 'web',
    'action' => 'recuperarc4',
    'params' => 1
));

//recuperar contraseña persona juridica
$router->add('/recuperarc5/{enlace}', array(
    'controller' => 'web',
    'action' => 'recuperarc5',
    'params' => 1
));

//------------------------------login-admision----------------------------------
//admision-registro.html
$router->add('/login-admision.html', array(
    'controller' => 'seguridad',
    'action' => 'loginAdmision'
));
//------------------------------fin---------------------------------------------
$router->add('/recuperar-contrasenha-publico-web.html', array(
    'controller' => 'web',
    'action' => 'recuperarcontrasenhaweb5'
));

$router->add('/recuperar-contrasenha-colegiados-web.html', array(
    'controller' => 'web',
    'action' => 'recuperarcontrasenhaweb6'
));


$router->add('/web-registrar-publico.html', array(
    'controller' => 'web',
    'action' => 'web_registrar_publico'
));

$router->add('/web-registro-publico.html', array(
    'controller' => 'web',
    'action' => 'web_registro_publico'
));
//------------------------------login-colegiaos---------------------------------
//recuperar contraseña persona juridica
$router->add('/recuperarc6/{enlace}', array(
    'controller' => 'web',
    'action' => 'recuperarc6',
    'params' => 1
));
//------------------------------login-convocatorias-----------------------------
//login-convocatorias.html
/*$router->add('/login-convocatorias.html', array(
    'controller' => 'web',
    'action' => 'login_convocatorias'
));*/
$router->add('/login-convocatorias.html', array(
    'controller' => 'seguridad',
    'action' => 'loginConvocatorias'
));
//----------------------------------login-voluntariado----------------------
//login-voluntariado.html
$router->add('/login-voluntariado.html', array(
    'controller' => 'web',
    'action' => 'login_voluntariado'
));

//------------------------------login-emrpesas-----------------------------
//login-empresas.html
$router->add('/login-empresas.html', array(
    'controller' => 'web',
    'action' => 'login_empresas'
));
//-----------------------------login-proveedores--------------------------------
$router->add('/login-proveedores.html', array(
    'controller' => 'web',
    'action' => 'login_proveedores'
));

//-----------------------------login-convocatoriasbs--------------------------------

$router->add('/login-convocatoriasbs.html', array(
    'controller' => 'web',
    'action' => 'login_convocatoriasbs'
));


//********************************web-biblioteca.html***************************
$router->add('/web-biblioteca', array(
    'controller' => 'webbiblioteca',
    'action' => 'index'
));

$router->add('/web-biblioteca/listado.html', array(
    'controller' => 'webbiblioteca',
    'action' => 'listado'
));

$router->add('/web-biblioteca/detalle-libro/{id}/{id_ejemplar}.html', array(
    'controller' => 'webbiblioteca',
    'action' => 'detalle',
    'params' => 2
));

//$router->add('/web/detalle-galeria/id-{id}/page={pagina}', array(
//    'controller' => 'web',
//    'action' => 'detalle_galeria',
//    'id' => 1,
//    'page'=>2
//));

//********************************web-bolsatrabajo.html***************************
$router->add('/web-bolsatrabajo', array(
    'controller' => 'webbolsatrabajo',
    'action' => 'index'
));

$router->add('/web-bolsatrabajo/listado.html', array(
    'controller' => 'webbolsatrabajo',
    'action' => 'listado'
));

$router->add('/web-bolsatrabajo/detalle-empleo/{id}.html', array(
    'controller' => 'webbolsatrabajo',
    'action' => 'detalle',
    'params' => 1
));

$router->notFound(array(
    "controller" => "web",
    "action" => "index"
));

//********************************ReportesController***************************


//------------------------libro-reclamaciones.html------------------------------
$router->add('/web-libro-reclamaciones.html', array(
    'controller' => 'web',
    'action' => 'web_libro_reclamaciones'
));

//------------------------libro-reclamaciones.html------------------------------
$router->add('/web-acceso-informacion.html', array(
    'controller' => 'web',
    'action' => 'web_acceso_informacion'
));

//------------------------login-egresados.html-----------------------------
$router->add('/login-egresados.html', array(
    'controller' => 'web',
    'action' => 'login_egresados'
));

//login-cv.html
$router->add('/login-cv.html', array(
    'controller' => 'web',
    'action' => 'login_cv'
));

//----------------------------------login-tramite-documentario-----------------
$router->add('/login-tramite-documentario.html', array(
    'controller' => 'web',
    'action' => 'login_tramite_documentario'
));

$router->add('/web-registro-tramite-documentario.html', array(
    'controller' => 'web',
    'action' => 'web_registro_tramite_documentario'
));

$router->add('/web-consulta-tramite-documentario.html', array(
    'controller' => 'web',
    'action' => 'web_consulta_tramite_documentario'
));

$router->add('/web-consulta-tramite-documentario-detalle/{id}.html', array(
    'controller' => 'web',
    'action' => 'web_consulta_tramite_documentario_detalle',
    'params' => 1
));

//-------------------------------actas.html--------------------------------------
$router->add('/web-actas.html', array(
    'controller' => 'web',
    'action' => 'web_actas'
));

//-------------------------------actas-grupo.html--------------------------------------
$router->add('/web-actas-grupo.html', array(
    'controller' => 'web',
    'action' => 'web_actas_grupo'
));

//-------------------------------resoluciones-grupo.html--------------------------------------
$router->add('/web-resoluciones-grupo.html', array(
    'controller' => 'web',
    'action' => 'web_resoluciones_grupo'
));

//-------------------------------procesos.html--------------------------------------


$router->add('/web-procesos/{enlace}.html', array(
    'controller' => 'web',
    'action' => 'web_procesos',
    'params' => 1
));

$router->add('/web-procesos-archivos/{enlace}.html', array(
    'controller' => 'web',
    'action' => 'web_procesos_archivos',
    'params' => 1
));



//-------------------------------proceso-grupo.html--------------------------------------
$router->add('/web-procesos-grupo.html', array(
    'controller' => 'web',
    'action' => 'web_procesos_grupo'
));




//--------------------------------login-enae.html--------------------------------
$router->add('/login-enae.html', array(
    'controller' => 'web',
    'action' => 'login_enae'
));


$router->add('/web-consulta-admision.html', array(
    'controller' => 'web',
    'action' => 'web_consulta_admision'
));

$router->add('/login-supervisores.html', array(
    'controller' => 'web',
    'action' => 'login_supervisores'
));
//--------------------------------login-fiscalia.html--------------------------------
$router->add('/login-fiscalia.html', array(
    'controller' => 'web',
    'action' => 'login_fiscalia'
));

$router->add('/recuperar-contrasenha-fiscales-web.html', array(
    'controller' => 'web',
    'action' => 'recuperarcontrasenhaweb8'
));

$router->add('/recuperarc8/{enlace}', array(
    'controller' => 'web',
    'action' => 'recuperarc8',
    'params' => 1
));

//------------------------------login-convocatorias-docentes.html-----------------------------
//login-convocatorias-docentes.html
/*$router->add('/login-convocatorias-docentes.html', array(
    'controller' => 'web',
    'action' => 'login_convocatorias_docentes'
));*/
$router->add('/login-convocatorias-docentes.html', array(
    'controller' => 'seguridad',
    'action' => 'loginConvocatoriasDocentes'
));
//------------------------------login-convocatorias-docentes.html-----------------------------

//login-convocatorias-eas.html
$router->add('/login-concursos-eas.html', array(
    'controller' => 'web',
    'action' => 'login_concursos_eas'
));

//login-convocatorias-iba.html
$router->add('/login-concursos-iba.html', array(
    'controller' => 'web',
    'action' => 'login_concursos_iba'
));

//login-convocatorias-ih.html
$router->add('/login-concursos-ih.html', array(
    'controller' => 'web',
    'action' => 'login_concursos_ih'
));

//login-convocatorias-it.html
$router->add('/login-concursos-it.html', array(
    'controller' => 'web',
    'action' => 'login_concursos_it'
));

//login-convocatorias-se.html
$router->add('/login-concursos-se.html', array(
    'controller' => 'web',
    'action' => 'login_concursos_se'
));

//login-convocatorias-rsu.html
$router->add('/login-concursos-rsu.html', array(
    'controller' => 'seguridad',
    'action' => 'login_concursos_rsu'
));

//********************************web-bienestar.html***************************
$router->add('/web-bienestar', array(
    'controller' => 'webbienestar',
    'action' => 'index'
));

//********************************web-seguimiento.html***************************
$router->add('/web-seguimiento', array(
    'controller' => 'webseguimiento',
    'action' => 'index'
));

//------------------------------login-ratificacion-docentes.html-----------------------------
/*$router->add('/login-ratificacion-docentes.html', array(
    'controller' => 'web',
    'action' => 'login_ratificacion_docentes'
));*/
$router->add('/login-ratificacion-docentes.html', array(
    'controller' => 'seguridad',
    'action' => 'loginRatificacionDocentes'
));

$router->add('/unca-info-no-disponible.html', array(
    'controller' => 'web',
    'action' => 'unca_info_no_disponible'
));

$router->add('/web-mallas-curriculares.html', array(
    'controller' => 'web',
    'action' => 'web_mallas_curriculares'
));

//recuperar pass tramite documentario
$router->add('/recuperar-contrasenha-tramite-documentario.html', array(
    'controller' => 'web',
    'action' => 'recuperarcontrasenhawebtramitedocumentario'
));

$router->add('/recuperarc9/{enlace}', array(
    'controller' => 'web',
    'action' => 'recuperarc9',
    'params' => 1
));


$router->add('/politica-privacidad.html', array(
    'controller' => 'web',
    'action' => 'politica_privacidad'
));