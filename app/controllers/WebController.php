<?php

use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class WebController extends ControllerBase
{

    public function initialize()
    {
        $this->tag->setTitle('Web');
        $this->view->setTemplateAfter('webindex');
        parent::initialize();
    }

    public function indexAction()
    {

        // echo "Hola MUndo";
        // exit();



        $sliders = $this->modelsManager->createBuilder()
            ->from('Sliders')
            ->columns('Sliders.id_slider,
                        Sliders.texto_principal,
                        Sliders.texto_1,
                        Sliders.texto_2,
                        Sliders.enlace,
                        Sliders.imagen,
                        Sliders.estado')
            ->where("Sliders.estado ='A'")
            //->limit(5)
            ->orderBy("Sliders.id_slider DESC")
            ->getQuery()
            ->execute();
        $this->view->sliders = $sliders;

        //Mostrar Noticias
        $noticias = $this->modelsManager->createBuilder()
            ->from('Noticias')
            ->columns('Noticias.id_noticia,
                        Noticias.titular,
                        Noticias.texto_muestra,
                        Noticias.texto_muestra,
                        Noticias.imagen,
                        Noticias.fecha_hora,
                        Noticias.estado')
            ->where("Noticias.estado ='A'")
            ->limit(3)
            ->groupBy("Noticias.id_noticia")
            ->orderBy("Noticias.fecha_hora DESC")
            ->getQuery()
            ->execute();
        $this->view->noticias = $noticias;

        //Mostrar Servicios
        $Servicios = $this->modelsManager->createBuilder()
            ->from('Servicios')
            ->columns('Servicios.id_servicio,
                        Servicios.titular,
                        Servicios.texto_muestra,
                        Servicios.texto_muestra,
                        Servicios.imagen,
                        Servicios.fecha_hora,
                        Servicios.estado')
            ->where("Servicios.estado ='A'")
            ->groupBy("Servicios.id_servicio")
            ->orderBy("Servicios.fecha_hora DESC")
            ->getQuery()
            ->execute();
        $this->view->servicios = $Servicios;

        //Mostrar ambientes
        $Ambientes = $this->modelsManager->createBuilder()
            ->from('Ambientes')
            ->columns('Ambientes.id_ambiente,
                        Ambientes.titular,
                        Ambientes.texto_muestra,
                        Ambientes.texto_muestra,
                        Ambientes.imagen,
                        Ambientes.fecha_hora,
                        Ambientes.estado')
            ->where("Ambientes.estado ='A'")
            ->groupBy("Ambientes.id_ambiente")
            ->orderBy("Ambientes.orden ASC")
            ->getQuery()
            ->execute();
        $this->view->ambientes = $Ambientes;

        //Mostrar Videos
        $videos = $this->modelsManager->createBuilder()
            ->from('Videos')
            ->columns('Videos.id_video,
                        Videos.titular,
                        Videos.youtube,
                        Videos.estado')
            ->where("Videos.estado ='A'")
            ->limit(4)
            ->groupBy("Videos.id_video")
            ->orderBy("Videos.id_video DESC")
            ->getQuery()
            ->execute();
        $this->view->videos = $videos;

        //Mostrar Enlaces
        $enlaces = $this->modelsManager->createBuilder()
            ->from('Enlaces')
            ->columns('Enlaces.id_enlace,
                        Enlaces.nombre,
                        Enlaces.imagen,
                        Enlaces.archivo,
                        Enlaces.url,
                        Enlaces.estado')
            ->where("Enlaces.estado ='A'")
            ->orderBy("Enlaces.orden")
            ->getQuery()
            ->execute();
        $this->view->enlaces = $enlaces;

        //Mostrar Eventos
        $eventos = $this->modelsManager->createBuilder()
            ->from('Eventos')
            ->columns('Eventos.id_evento,
                        Eventos.titular,
                        Eventos.texto_muestra,
                        Eventos.texto_muestra,
                        Eventos.imagen,
                        Eventos.fecha_hora,
                        Eventos.estado')
            ->where("Eventos.estado ='A'")
            ->limit(3)
            ->groupBy("Eventos.id_evento")
            ->orderBy("Eventos.fecha_hora DESC")
            ->getQuery()
            ->execute();
        $this->view->eventos = $eventos;

        //Mostrar Boletines
        $boletines = $this->modelsManager->createBuilder()
            ->from('Boletines')
            ->columns('Boletines.id_boletin,
                        Boletines.titular,
                        Boletines.texto_muestra,
                        Boletines.texto_muestra,
                        Boletines.imagen,
                        Boletines.archivo,
                        Boletines.fecha_hora,
                        Boletines.estado')
            ->where("Boletines.estado ='A'")
            ->limit(4)
            ->groupBy("Boletines.id_boletin")
            ->orderBy("Boletines.fecha_hora DESC")
            ->getQuery()
            ->execute();
        $this->view->boletines = $boletines;

        //Mostrar Convenios
        $convenios = $this->modelsManager->createBuilder()
            ->from('Convenios')
            ->columns('Convenios.id_convenio,
                        Convenios.titulo,
                        Convenios.vigencia,
                        Convenios.compromiso,
                        Convenios.imagen,
                        Convenios.referencia,
                        Convenios.referencia_enlace,
                        Convenios.suscriptores,
                        Convenios.estado')
            ->where("Convenios.estado ='A'")
            ->limit(6)
            ->orderBy("Convenios.id_convenio DESC")
            ->getQuery()
            ->execute();
        $this->view->convenios = $convenios;

        //Mostrar Galerias
        $galerias = $this->modelsManager->createBuilder()
            ->from('Galerias')
            ->columns('Galerias.id_galeria,
                        Galerias.titular,
                        Galerias.descripcion,
                        Galerias.enlace,
                        Galerias.imagen,
                        Galerias.archivo,
                        Galerias.fecha,
                        Galerias.estado')
            ->where("Galerias.estado ='A'")
            ->limit(3)
            ->groupBy("Galerias.id_galeria")
            ->orderBy("Galerias.fecha DESC")
            ->getQuery()
            ->execute();
        $this->view->galerias = $galerias;

        //Mostrar Proyectos
        $proyectosInvestigacion = $this->modelsManager->createBuilder()
            ->from('ProyectosInvestigacion')
            ->columns('ProyectosInvestigacion.id_proyecto,
            ProyectosInvestigacion.titulo,
            ProyectosInvestigacion.objetivo,
            ProyectosInvestigacion.investigador,
            ProyectosInvestigacion.lineas,
            ProyectosInvestigacion.tipo,
            ProyectosInvestigacion.objetivos,
            ProyectosInvestigacion.fecha_inicio,
            ProyectosInvestigacion.fecha_termino,
            ProyectosInvestigacion.vigencia,
            ProyectosInvestigacion.presupuesto,
            ProyectosInvestigacion.entidad_cooperante,
            ProyectosInvestigacion.compromiso_cooperante,
            ProyectosInvestigacion.local_proyecto,
            ProyectosInvestigacion.vigencia,
            ProyectosInvestigacion.imagen,
            ProyectosInvestigacion.etapa,
            ProyectosInvestigacion.estado')
            ->where("ProyectosInvestigacion.estado ='A' AND ProyectosInvestigacion.tipo_proyecto = 1")
            ->limit(1)
            ->orderBy("ProyectosInvestigacion.id_proyecto DESC")
            ->getQuery()
            ->execute();
        $this->view->proyectosInvestigacion = $proyectosInvestigacion;

        $proyectosInversion = $this->modelsManager->createBuilder()
            ->from('ProyectosInversion')
            ->columns('ProyectosInversion.id_proyecto,
        ProyectosInversion.titulo,
        ProyectosInversion.objetivo,
        ProyectosInversion.investigador,
        ProyectosInversion.lineas,
        ProyectosInversion.tipo,
        ProyectosInversion.objetivos,
        ProyectosInversion.fecha_inicio,
        ProyectosInversion.fecha_termino,
        ProyectosInversion.vigencia,
        ProyectosInversion.presupuesto,
        ProyectosInversion.entidad_cooperante,
        ProyectosInversion.compromiso_cooperante,
        ProyectosInversion.local_proyecto,
        ProyectosInversion.vigencia,
        ProyectosInversion.imagen,
        ProyectosInversion.estado')
            ->where("ProyectosInversion.estado ='A' AND ProyectosInversion.tipo_proyecto = 2")
            ->limit(6)
            ->orderBy("ProyectosInversion.id_proyecto DESC")
            ->getQuery()
            ->execute();
        $this->view->proyectosInversion = $proyectosInversion;

        //Mostrar Carreras
        $carreras = $this->modelsManager->createBuilder()
            ->from('Carreras')
            ->columns('Carreras.codigo,
                        Carreras.descripcion,
                        Carreras.grado,
                        Carreras.titulo,
                        Carreras.duracion,
                        Carreras.modalidad, Carreras.archivo,
                        Carreras.perfil, Carreras.enlace,
                        Carreras.estado')
            ->where("Carreras.estado ='A'")
            ->limit(6)
            ->orderBy("Carreras.codigo")
            ->getQuery()
            ->execute();
        $this->view->carreras = $carreras;

        //Mostrar ConvocatoriasCAS
        $convocatorias = $this->modelsManager->createBuilder()
            ->from('Convocatorias')
            ->columns('Convocatorias.id_convocatoria,
                        Convocatorias.titulo,
                        Convocatorias.texto_muestra,
                        Convocatorias.imagen,
                        Convocatorias.fecha_hora, Convocatorias.etapa,
                        Convocatorias.estado')
            ->where("Convocatorias.estado ='A' and Convocatorias.tipo = '1'")
            ->limit(2)
            ->orderBy("Convocatorias.fecha_hora DESC")
            ->getQuery()
            ->execute();
        $this->view->convocatorias = $convocatorias;

        //Mostrar ConvocatoriasD
        $convocatorias2 = $this->modelsManager->createBuilder()
            ->from('Convocatorias')
            ->columns('Convocatorias.id_convocatoria,
                        Convocatorias.titulo,
                        Convocatorias.texto_muestra,
                        Convocatorias.imagen,
                        Convocatorias.fecha_hora, Convocatorias.etapa,
                        Convocatorias.estado')
            ->where("Convocatorias.estado ='A' and Convocatorias.tipo = '2'")
            ->limit(2)
            ->orderBy("Convocatorias.fecha_hora DESC")
            ->getQuery()
            ->execute();
        $this->view->convocatorias2 = $convocatorias2;

        //Mostrar ConvocatoriasP
        $convocatorias3 = $this->modelsManager->createBuilder()
            ->from('Convocatorias')
            ->columns('Convocatorias.id_convocatoria,
                        Convocatorias.titulo,
                        Convocatorias.texto_muestra,
                        Convocatorias.imagen,
                        Convocatorias.fecha_hora, Convocatorias.etapa,
                        Convocatorias.estado')
            ->where("Convocatorias.estado ='A' and Convocatorias.tipo = '3'")
            ->limit(2)
            ->orderBy("Convocatorias.fecha_hora DESC")
            ->getQuery()
            ->execute();
        $this->view->convocatorias3 = $convocatorias3;

        //Mostrar ConvocatoriasB
        $convocatoriasbs1 = $this->modelsManager->createBuilder()
            ->from('ConvocatoriasBs')
            ->columns('ConvocatoriasBs.id_convocatoria_bs,
                        ConvocatoriasBs.titulo,
                        ConvocatoriasBs.texto_muestra,
                        ConvocatoriasBs.imagen,
                        ConvocatoriasBs.fecha_hora, ConvocatoriasBs.etapa,
                        ConvocatoriasBs.estado')
            ->where("ConvocatoriasBs.estado ='A' and ConvocatoriasBs.tipo = '1'")
            ->limit(2)
            ->orderBy("ConvocatoriasBs.fecha_hora DESC")
            ->getQuery()
            ->execute();
        $this->view->convocatoriasbs1 = $convocatoriasbs1;

        //Mostrar ConvocatoriasS
        $convocatoriasbs2 = $this->modelsManager->createBuilder()
            ->from('ConvocatoriasBs')
            ->columns('ConvocatoriasBs.id_convocatoria_bs,
                        ConvocatoriasBs.titulo,
                        ConvocatoriasBs.texto_muestra,
                        ConvocatoriasBs.imagen,
                        ConvocatoriasBs.fecha_hora, ConvocatoriasBs.etapa,
                        ConvocatoriasBs.estado')
            ->where("ConvocatoriasBs.estado ='A' and ConvocatoriasBs.tipo = '2'")
            ->limit(2)
            ->orderBy("ConvocatoriasBs.fecha_hora DESC")
            ->getQuery()
            ->execute();
        $this->view->convocatoriasbs2 = $convocatoriasbs2;

        //Mostrar modal index
        //$Modales = Modales::find("tipo = 1 AND estado = 'A'");

        $Modales = Modales::find(
            [
                "tipo = 1 AND estado ='A'",
                'order' => 'orden',
            ]
        );
        //    foreach ($Modales as $value) {
        //                echo "<pre>";
        //                print_r($value->titulo);
        //            }
        //            exit();

        $this->view->modales = $Modales;

        $Modalesultimo = Modales::findFirst(
            [
                "tipo = 1 AND estado ='A'",
                'order' => 'orden DESC',
                'limit' => 1,
            ]
        );

        //print($Modalesultimo->orden);
        //exit();

        $this->view->modal_ultimo = $Modalesultimo->orden;

        //index.js
        $this->assets->addJs("adminpanel/js/viewsweb/index.js?v=" . uniqid());
    }
    public function qr_validacionAction(){
        //$this->assets->addCss("adminpanel/vendor/datatables/css/jquery.dataTables.min.css.js?v=" . uniqid());
        //$this->assets->addJs("adminpanel/vendor/datatables/js/jquery.dataTables.min.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/vendor/qr_validation_arcjas/html5-qrcode.min.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/vendor/qr_validation_arcjas/sweetalert.min.js?v=" . uniqid());
        $this->assets->addJs("adminpanel/vendor/qr_validation_arcjas/script.js?v=" . uniqid());
    }
    public function getModalAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //$ano_eje = $this->request->getPost("ano_eje");
            $modal = Modales::find("tipo = 1 AND estado = 'A' ");
            $this->response->setJsonContent($modal->toArray());
            $this->response->send();
        }
    }

    public function web_noticiasAction()
    {

        $numberPage = $this->request->getQuery("page", "int");

        $noticias = $this->modelsManager->createBuilder()
            ->from('Noticias')
            ->columns('Noticias.id_noticia,
                        Noticias.titular,
                        Noticias.texto_muestra,
                        Noticias.imagen,
                        Noticias.fecha_hora,
                        Noticias.estado')
            ->where("Noticias.estado ='A'")
            ->orderBy('Noticias.fecha_hora DESC')
            ->getQuery()
            ->execute();
        $data = $noticias;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
    }

    public function web_conveniosAction()
    {

        $numberPage = $this->request->getQuery("page", "int");

        $convenios = $this->modelsManager->createBuilder()
            ->from('Convenios')
            ->columns('Convenios.id_convenio,
                        Convenios.titulo,
                        Convenios.objeto,
                        Convenios.vigencia,
                        Convenios.referencia,
                        Convenios.referencia_enlace,
                        Convenios.archivo,
                        Convenios.imagen,
                        Convenios.enlace,
                        Convenios.estado')
            ->where("Convenios.estado ='A'")
            ->orderBy('Convenios.id_convenio DESC')
            ->getQuery()
            ->execute();
        $data = $convenios;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
    }

    public function web_boletinesAction()
    {

        $numberPage = $this->request->getQuery("page", "int");

        $boletines = $this->modelsManager->createBuilder()
            ->from('Boletines')
            ->columns('Boletines.id_boletin,
                    Boletines.titular,
                    Boletines.texto_muestra,
                    Boletines.imagen,
                    Boletines.archivo,
                    Boletines.fecha_hora,
                    Boletines.estado')
            ->where("Boletines.estado ='A'")
            ->orderBy('Boletines.fecha_hora DESC')
            ->getQuery()
            ->execute();
        $data = $boletines;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
    }

    public function web_proyectos_investigacionAction()
    {

        $numberPage = $this->request->getQuery("page", "int");
        $proyectosInvestigacion = $this->modelsManager->createBuilder()
            ->from('ProyectosInvestigacion')
            ->columns('ProyectosInvestigacion.id_proyecto,
                        ProyectosInvestigacion.titulo,
                        ProyectosInvestigacion.objetivo,
                        ProyectosInvestigacion.investigador,
                        ProyectosInvestigacion.lineas,
                        ProyectosInvestigacion.tipo,
                        ProyectosInvestigacion.objetivos,
                        ProyectosInvestigacion.fecha_inicio,
                        ProyectosInvestigacion.fecha_termino,
                        ProyectosInvestigacion.vigencia,
                        ProyectosInvestigacion.presupuesto,
                        ProyectosInvestigacion.entidad_cooperante,
                        ProyectosInvestigacion.compromiso_cooperante,
                        ProyectosInvestigacion.local_proyecto,
                        ProyectosInvestigacion.etapa,
                        ProyectosInvestigacion.imagen,
                        ProyectosInvestigacion.estado')
            ->where("ProyectosInvestigacion.tipo_proyecto = 1 and ProyectosInvestigacion.estado ='A' and ProyectosInvestigacion.etapa > 0")
            ->orderBy('ProyectosInvestigacion.etapa ASC')
            ->getQuery()
            ->execute();
        $data = $proyectosInvestigacion;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
    }

    public function web_proyectos_inversionAction()
    {

        $numberPage = $this->request->getQuery("page", "int");
        $proyectosInversion = $this->modelsManager->createBuilder()
            ->from('ProyectosInversion')
            ->columns('ProyectosInversion.id_proyecto,
                        ProyectosInversion.titulo,
                        ProyectosInversion.resumen,
                        ProyectosInversion.enlace,
                        ProyectosInversion.etapa,
                        ProyectosInversion.monto,
                        ProyectosInversion.presupuesto,
                        ProyectosInversion.codigo_unico,
                        ProyectosInversion.archivo,
                        ProyectosInversion.imagen,
                        ProyectosInversion.estado')
            ->where("ProyectosInversion.tipo_proyecto = 2 and ProyectosInversion.estado ='A' and ProyectosInversion.etapa > 1 ")
            ->orderBy('ProyectosInversion.codigo_unico DESC')
            ->getQuery()
            ->execute();
        $data = $proyectosInversion;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
    }

    public function web_carrerasAction()
    {

        $numberPage = $this->request->getQuery("page", "int");

        $carreras = $this->modelsManager->createBuilder()
            ->from('Carreras')
            ->columns('Carreras.codigo,
                        Carreras.descripcion,
                        Carreras.grado,
                        Carreras.titulo,
                        Carreras.duracion,
                        Carreras.modalidad,
                        Carreras.perfil,
                        Carreras.estado')
            ->where("Carreras.estado ='A'")
            ->orderBy('Carreras.codigo')
            ->getQuery()
            ->execute();
        $data = $carreras;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
    }

    public function web_eventosAction()
    {

        $numberPage = $this->request->getQuery("page", "int");

        $eventos = $this->modelsManager->createBuilder()
            ->from('Eventos')
            ->columns('Eventos.id_evento,
                        Eventos.titular,
                        Eventos.texto_muestra,
                        Eventos.texto_complementario,
                        Eventos.fecha_hora,
                        Eventos.archivo,
                        Eventos.imagen,
                        Eventos.enlace,
                        Eventos.estado')
            ->where("Eventos.estado ='A'")
            ->orderBy('Eventos.fecha_hora DESC')
            ->getQuery()
            ->execute();
        $data = $eventos;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
    }

    public function web_convocatoriasAction($tipo)
    {

        //$params = $this->request->getQuery();
        //$this->view->pager = Convocatorias::getList($params, $tipo);

        $numberPage = $this->request->getQuery("page", "int");

        $convocatorias = $this->modelsManager->createBuilder()
            ->from('Convocatorias')
            ->columns('Convocatorias.id_convocatoria,
                        Convocatorias.tipo,
                        Convocatorias.titulo,
                        Convocatorias.texto_muestra,
                        Convocatorias.fecha_hora,
                        Convocatorias.archivo,
                        Convocatorias.imagen,
                        Convocatorias.enlace, Convocatorias.etapa,
                        Convocatorias.estado, EtapasConvocatorias.nombres AS etapa_nombre')
            ->join('EtapasConvocatorias', 'EtapasConvocatorias.codigo = Convocatorias.etapa')
            ->where("Convocatorias.estado ='A' AND Convocatorias.tipo = '{$tipo}' AND EtapasConvocatorias.numero =81")
            ->orderBy('Convocatorias.fecha_hora DESC')
            ->getQuery()
            ->execute();
        $data = $convocatorias;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
    }

    public function web_convocatoriasbsAction($tipo)
    {

        //$params = $this->request->getQuery();
        //$this->view->pager = Convocatorias::getList($params, $tipo);

        $numberPage = $this->request->getQuery("page", "int");

        $convocatoriasbs = $this->modelsManager->createBuilder()
            ->from('ConvocatoriasBs')
            ->columns('ConvocatoriasBs.id_convocatoria_bs,
                        ConvocatoriasBs.tipo,
                        ConvocatoriasBs.titulo,
                        ConvocatoriasBs.texto_muestra,
                        ConvocatoriasBs.fecha_hora,
                        ConvocatoriasBs.archivo,
                        ConvocatoriasBs.imagen,
                        ConvocatoriasBs.enlace, ConvocatoriasBs.etapa,
                        ConvocatoriasBs.estado, EtapasConvocatorias.nombres AS etapa_nombre')
            ->join('EtapasConvocatorias', 'EtapasConvocatorias.codigo = ConvocatoriasBs.etapa')
            ->where("ConvocatoriasBs.estado ='A'  AND ConvocatoriasBs.tipo = '{$tipo}' AND EtapasConvocatorias.numero =81")
            ->orderBy('ConvocatoriasBs.fecha_hora DESC')
            ->getQuery()
            ->execute();
        $data = $convocatoriasbs;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
    }

    public function web_detalle_noticiaAction($id)
    {

        //Cargamos el modelo de las noticias
        $noticia = Noticias::findFirstByid_noticia((int) $id);
        $this->view->noticia = $noticia;

        $noticiasDetalles = NoticiasDetalles::find("id_noticia = $id ");
        $this->view->noticias_imagenes = $noticiasDetalles;
        if (count($noticiasDetalles) >= 1) {
            $activa_imagenes = 1;
            //print($activa_imagenes);
            //exit();
        } else {
            $activa_imagenes = 0;
        }
        $this->view->activa_imagenes = $activa_imagenes;

        $noticia_imagen_active = NoticiasDetalles::findFirst([
            "id_noticia = $id",
            'order' => 'id_noticia_detalle ASC',
        ]);

        // print($noticia_imagen_active->imagen_detalle);
        // exit();

        $this->view->noticia_imagen_active = $noticia_imagen_active;
    }

    public function detalle_galeriaAction($id_galeria, $pagina = null)
    {

        //print($this->dispatcher->getParam('id')."-");
        //print($this->dispatcher->getParam('page'));
        //exit();

        $Galeria = Galerias::findFirstByid_galeria((int) $id_galeria);
        $this->view->galeria = $Galeria;

        $numberPage = $this->request->getQuery("page", "int");

        $galerias = $this->modelsManager->createBuilder()
            ->from('GaleriasDetalles')
            ->columns('GaleriasDetalles.id_galeria_detalle,
                        GaleriasDetalles.id_galeria,
                        GaleriasDetalles.titular_detalle,
                        GaleriasDetalles.fecha_hora_detalle,
                        GaleriasDetalles.archivo_detalle,
                        GaleriasDetalles.imagen_detalle,
                        GaleriasDetalles.enlace_detalle,
                        GaleriasDetalles.estado_detalle')
            ->where("GaleriasDetalles.estado_detalle ='A' AND GaleriasDetalles.id_galeria = {$id_galeria}")
            ->orderBy('GaleriasDetalles.fecha_hora_detalle DESC')
            ->getQuery()
            ->execute();
        $data = $galerias;

        /*
        foreach ($data as $value) {
        echo '<pre>';
        print_r($value->imagen_detalle);
        }
        exit();
         */

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 12,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
        $this->view->id_galeria = $id_galeria;
    }

    public function web_detalle_convenioAction($id)
    {
        //Cargamos el modelo de los convenio
        $convenio = Convenios::findFirstByid_convenio((int) $id);
        $this->view->convenio = $convenio;
        $resolucion = Resoluciones::findFirstByid_resolucion((int) $convenio->id_resolucion);
        // print($resolucion->titulo);
        // exit();
        $this->view->resolucion = $resolucion;
    }

    public function web_detalle_servicioAction($id)
    {
        //Cargamos el modelo de los servicios
        $servicio = Servicios::findFirstByid_servicio((int) $id);
        $this->view->servicio = $servicio;

        $ServiciosImagenes = ServiciosImagenes::find([
            "id_servicio = $id AND estado='A'",
        ]);
        $this->view->servicios_imagenes = $ServiciosImagenes;
        if (count($ServiciosImagenes) >= 1) {
            $activa_imagenes = 1;
        } else {
            $activa_imagenes = 0;
        }
        $this->view->activa_imagenes = $activa_imagenes;

        $servicio_imagen_active = ServiciosImagenes::findFirst([
            "id_servicio = $id AND estado='A'",
            'order' => 'id_servicio_imagen ASC',
        ]);
        $this->view->servicio_imagen_active = $servicio_imagen_active;

        $ServiciosArchivos = ServiciosArchivos::find("id_servicio = $id ");
        $this->view->servicios_archivos = $ServiciosArchivos;
        if (count($ServiciosArchivos) >= 1) {
            $activa_archivos = 1;
        } else {
            $activa_archivos = 0;
        }
        $this->view->activa_archivos = $activa_archivos;

        //$Eventos = Eventos::find("servicio = $id");
        $Eventos = Eventos::find(
            [
                "id_servicio = $id",
                'order' => 'fecha_hora DESC',
            ]
        );

        foreach ($Eventos as $valueEventos) {
            //            echo '<pre>';
            //            print_r("Eventos:".$valueEventos->id_evento);

            $EventosArchivos = EventosArchivos::find(
                [
                    "id_evento = {$valueEventos->id_evento} AND estado = 'A'",
                ]
            );

            foreach ($EventosArchivos as $valueEventosArchivos) {
                //echo '<pre>';
                //print_r("EventosArchivos:" . $valueEventosArchivos->titular);
                $this->view->eventos_archivo_titular = $valueEventosArchivos->titular;
            }
            //exit();
        }
        //exit();

        $this->view->eventos = $Eventos;
        if (count($Eventos) >= 1) {
            $activa_eventos = 1;
        } else {
            $activa_eventos = 0;
        }
        $this->view->activa_eventos = $activa_eventos;

        $EventosArchivos = EventosArchivos::find();
        $this->view->eventos_archivos = $EventosArchivos;
    }

    public function web_detalle_ambienteAction($id)
    {

        //Cargamos el modelo de las eventos
        //$evento = Eventos::findFirstByid_evento((int) $id);
        //$this->view->evento = $evento;
        //Cargamos el modelo de los servicios

        $Ambientes = Ambientes::findFirstByid_ambiente((int) $id);
        $this->view->ambiente = $Ambientes;

        $AmbientesImagenes = AmbientesImagenes::find("id_ambiente = $id ");
        $this->view->ambientes_imagenes = $AmbientesImagenes;
        if (count($AmbientesImagenes) >= 1) {
            $activa_imagenes = 1;
        } else {
            $activa_imagenes = 0;
        }
        $this->view->activa_imagenes = $activa_imagenes;

        $ambiente_imagen_active = AmbientesImagenes::findFirst([
            "id_ambiente = $id",
            'order' => 'id_ambiente_imagen ASC',
        ]);
        $this->view->ambiente_imagen_active = $ambiente_imagen_active;

        $AmbientesArchivos = AmbientesArchivos::find("id_ambiente = $id ");

        //echo '<pre>';
        //print_r("Titulo:".$AmbientesArchivos->titulo);
        //exit();

        $this->view->ambientes_archivos = $AmbientesArchivos;
        if (count($AmbientesArchivos) >= 1) {
            $activa_archivos = 1;
        } else {
            $activa_archivos = 0;
        }
        $this->view->activa_archivos = $activa_archivos;
    }

    public function web_detalle_proyecto_investigacionAction($id)
    {

        //Cargamos el modelo de las convenio
        $proyecto = Proyectos::findFirstByid_proyecto((int) $id);
        $this->view->proyecto = $proyecto;
    }

    public function web_detalle_carreraAction($id)
    {

        //Cargamos el modelo de las convenio
        $carrera = Carreras::findFirstBycodigo((string) $id);
        $this->view->carrera = $carrera;
    }

    public function web_detalle_eventoAction($id)
    {

        $Eventos = Eventos::findFirstByid_evento((int) $id);
        $this->view->evento = $Eventos;

        $EventosImagenes = EventosImagenes::find("id_evento = $id ");
        $this->view->eventos_imagenes = $EventosImagenes;
        if (count($EventosImagenes) >= 1) {
            $activa_imagenes = 1;
        } else {
            $activa_imagenes = 0;
        }
        $this->view->activa_imagenes = $activa_imagenes;

        $evento_imagen_active = EventosImagenes::findFirst([
            "id_evento = $id",
            'order' => 'id_evento_imagen ASC',
        ]);
        $this->view->evento_imagen_active = $evento_imagen_active;

        $EventosArchivos = EventosArchivos::find("id_evento = $id ");
        $this->view->eventos_archivos = $EventosArchivos;
        if (count($EventosArchivos) >= 1) {
            $activa_archivos = 1;
        } else {
            $activa_archivos = 0;
        }
        $this->view->activa_archivos = $activa_archivos;
    }

    public function web_detalle_convocatoriaAction($id)
    {

        //Cargamos el modelo de las convocatorias
        $convocatoria = Convocatorias::findFirstByid_convocatoria((int) $id);
        $this->view->convocatoria = $convocatoria;

        //detalle
        $convocatoria1 = $this->modelsManager->createBuilder()
            ->from('Convocatorias')
            ->columns('Convocatorias.id_convocatoria,
                            Convocatorias.tipo,
                            Convocatorias.titulo,
                            Convocatorias.texto_muestra,
                            Convocatorias.fecha_hora,
                            Convocatorias.archivo,
                            Convocatorias.imagen,
                            Convocatorias.enlace,
                            Convocatorias.estado, Convocatorias.etapa,
                            ConvocatoriasDetalles.titulo,
                            ConvocatoriasDetalles.archivo')
            ->join('ConvocatoriasDetalles', 'Convocatorias.id_convocatoria = ConvocatoriasDetalles.id_convocatoria')
            ->where("Convocatorias.estado='A' and ConvocatoriasDetalles.estado ='A' and Convocatorias.id_convocatoria= ($id) ")
            //->limit(6)
            ->orderBy('ConvocatoriasDetalles.id_convocatoria_detalle')
            ->getQuery()
            ->execute();
        $this->view->convocatorias1 = $convocatoria1;

        $fecha_actual = strtotime(date("Y-m-d H:i:s", time()));
        $fecha_boton_inicio = strtotime(date($convocatoria->fecha_boton_inicio));
        $fecha_boton_fin = strtotime(date($convocatoria->fecha_boton_fin));

        // print("fecha_actual: ".$fecha_actual);
        // print("fecha_boton_inicio: ".$fecha_boton_inicio);
        // print("fecha_boton_fin: ".$fecha_boton_fin);
        // exit();


        if ($fecha_actual >= $fecha_boton_inicio and $fecha_actual <= $fecha_boton_fin) {
            //print("si puede postular");
            //exit();
            $this->view->active_boton_postular = 1;
        } else {
            //print("no puede postular");
            //exit();
            $this->view->active_boton_postular = 0;
        }
    }

    public function web_detalle_convocatoriabsAction($id)
    {

        // print($id);
        // exit();

        //Cargamos el modelo de las convocatorias
        $convocatoriabs = ConvocatoriasBs::findFirstByid_convocatoria_bs((int) $id);
        $this->view->convocatoriabs = $convocatoriabs;

        //detalle
        $convocatoriabs1 = $this->modelsManager->createBuilder()
            ->from('ConvocatoriasBs')
            ->columns('ConvocatoriasBs.id_convocatoria_bs,
                            ConvocatoriasBs.tipo,
                            ConvocatoriasBs.titulo,
                            ConvocatoriasBs.texto_muestra,
                            ConvocatoriasBs.fecha_hora,
                            ConvocatoriasBs.archivo,
                            ConvocatoriasBs.imagen,
                            ConvocatoriasBs.enlace,
                            ConvocatoriasBs.estado, ConvocatoriasBs.etapa,
                            ConvocatoriasBsDetalles.titulo,
                            ConvocatoriasBsDetalles.archivo')
            ->join('ConvocatoriasBsDetalles', 'ConvocatoriasBs.id_convocatoria_bs = ConvocatoriasBsDetalles.id_convocatoria_bs')
            ->where("ConvocatoriasBs.estado='A' and ConvocatoriasBsDetalles.estado ='A' and ConvocatoriasBs.id_convocatoria_bs= ($id) ")
            //->limit(6)
            ->orderBy('ConvocatoriasBsDetalles.id_convocatoria_bs_detalle')
            ->getQuery()
            ->execute();
        $this->view->convocatoriasbs1 = $convocatoriabs1;

        // foreach ($convocatoriabs1 as $key => $value) {
        //     echo "<pre>";
        //     print_r($value->titulo);
        // }
        // exit();

        $fecha_actual = strtotime(date("Y-m-d H:i:s", time()));

        // print($convocatoriabs->fecha_boton_inicio);
        // exit();

        $fecha_boton_inicio = strtotime(date($convocatoriabs->fecha_boton_inicio));

        $fecha_boton_fin = strtotime(date($convocatoriabs->fecha_boton_fin));

        if ($fecha_actual >= $fecha_boton_inicio and $fecha_actual <= $fecha_boton_fin) {
            // print("si puede postular");
            // exit();
            $this->view->active_boton_postular = 1;
        } else {
            // print("no puede postular");
            // exit();
            $this->view->active_boton_postular = 0;
        }
    }

    public function web_documentosAction($enlace)
    {

        //Cargamos el modelo de las documentos
        $documento = Documentosgestion::findFirstByenlace((string) $enlace);

        // print("id_resolucion: ".$documento->id_resolucion);
        // exit();

        $this->view->documento = $documento;

        $resolucion = Resoluciones::findFirstByid_resolucion((int)$documento->id_resolucion);

        // print("archivo resolucion: ".$resolucion->archivo);
        // exit();

        $this->view->resolucion = $resolucion;

        $verificae = DocumentosEvaluaciones::find("id_documento = $documento->id_documento AND visible='1' AND estado='A'");

        if (count($verificae) >= 1) {

            // print(count($verificae));
            // exit();

            $this->view->verificae = count($verificae);

            $documentosEvaluaciones = DocumentosEvaluaciones::find(["id_documento = $documento->id_documento ", "order" => "orden DESC"]);


            $documentosEvaluacionesResoluciones = Resoluciones::find();
            $this->view->documentosEvaluacionesResoluciones = $documentosEvaluacionesResoluciones;



            $this->view->documentosEvaluaciones = $documentosEvaluaciones;
        } else {
            $this->view->verificae = count($verificae);
        }

        $verificaa = DocumentosArchivos::find("id_documento = $documento->id_documento AND visible='1' AND estado='A'");

        if (count($verificaa) >= 1) {

            // print(count($verificaa));
            // exit();

            $this->view->verificaa = count($verificaa);

            $documentosArchivos = DocumentosArchivos::find(["id_documento = $documento->id_documento ", "order" => "orden DESC"]);


            $documentosArchivosResoluciones = Resoluciones::find();
            $this->view->documentosArchivosResoluciones = $documentosArchivosResoluciones;



            $this->view->documentosArchivos = $documentosArchivos;
        } else {
            $this->view->verificaa = count($verificaa);
        }
    }

    public function web_documentos_archivosAction($enlace)
    {

        //Cargamos el modelo de las documentos
        $documento = DocumentosArchivos::findFirstByenlace((string) $enlace);

        // print("id_resolucion: ".$documento->id_resolucion);
        // exit();

        $this->view->documento = $documento;

        $resolucion = Resoluciones::findFirstByid_resolucion((int)$documento->id_resolucion);

        // print("archivo resolucion: ".$resolucion->archivo);
        // exit();

        $this->view->resolucion = $resolucion;
    }

    public function web_documentos_evaluacionesAction($enlace)
    {

        // print("Enlace: ".$enlace);
        // exit();

        //Cargamos el modelo de las documentos
        $documento = DocumentosEvaluaciones::findFirstByenlace((string) $enlace);

        // print("id_resolucion: ".$documento->id_resolucion);
        // exit();

        $this->view->documento = $documento;

        $resolucion = Resoluciones::findFirstByid_resolucion((int)$documento->id_resolucion);

        // print("archivo resolucion: ".$resolucion->archivo);
        // exit();

        $this->view->resolucion = $resolucion;
    }


    //procesos

    public function web_docprocesosAction($enlace)
    {

        //Cargamos el modelo de las documentos
        $docproceso = Docproceso::findFirstByenlace((string) $enlace);

        // print("id_resolucion: ".$documento->id_resolucion);
        // exit();

        $this->view->docproceso = $docproceso;

        $resolucion = Resoluciones::findFirstByid_resolucion((int)$docproceso->id_resolucion);

        // print("archivo resolucion: ".$resolucion->archivo);
        // exit();

        $this->view->resolucion = $resolucion;

        
        $verificaa = DocprocesosArchivos::find("id_docproceso = $docproceso->id_docproceso AND visible='1' AND estado='A'");

        if (count($verificaa) >= 1) {

            // print(count($verificaa));
            // exit();

            $this->view->verificaa = count($verificaa);

            $docprocesosArchivos = DocprocesosArchivos::find(["id_docproceso = $docproceso->id_docproceso ", "order" => "orden DESC"]);


            $docprocesosArchivosResoluciones = Resoluciones::find();
            $this->view->docprocesosArchivosResoluciones = $docprocesosArchivosResoluciones;



            $this->view->docprocesosArchivos = $docprocesosArchivos;
        } else {
            $this->view->verificaa = count($verificaa);
        }
    }

    public function web_docprocesos_archivosAction($enlace)
    {

        //Cargamos el modelo de las documentos
        $docproceso = DocprocesosArchivos::findFirstByenlace((string) $enlace);

        // print("id_resolucion: ".$documento->id_resolucion);
        // exit();

        $this->view->docproceso = $docproceso;

        $resolucion = Resoluciones::findFirstByid_resolucion((int)$docproceso->id_resolucion);

        // print("archivo resolucion: ".$resolucion->archivo);
        // exit();

        $this->view->resolucion = $resolucion;
    }

    //fin de procesos


    public function web_autoridadesAction($enlace)
    {

        //Relacionamos autoridad con personal

        $autoridad = VAutoridades::find("enlace ='{$enlace}' AND estado = 'A'");

        // foreach ($autoridad as $key => $value) {
        //     echo "<pre>";
        //     print_r("Apellidos y nombres:". $value->apellidop."-". $value->apellidom."-".$value->nombres);
        // }
        #print_r($autoridad);
        # exit();

        $this->view->autoridad = $autoridad;
    }

    public function web_areasAction($enlace)
    {

        //Relacionamos area con personal
        $area = Areas::findFirst("enlace='{$enlace}' AND estado = 'A' ");
        $this->view->area = $area;

        $personal = VPersonalArea::findFirst("id_area='{$area->codigo}' AND estado = 'A' AND estado_a = 'A' AND es_principal = 'A' ");
        $this->view->personal = $personal;

        $personales = $this->modelsManager->createBuilder()
            ->from('VPersonalArea')
            ->columns('VPersonalArea.id_personal,
                            VPersonalArea.orden,
                            VPersonalArea.nombres,
                            VPersonalArea.apellidop,
                            VPersonalArea.apellidom,
                            VPersonalArea.oficina,
                            VPersonalArea.cargo,
                            VPersonalArea.email,
                            VPersonalArea.email1,
                            VPersonalArea.email2,
                            VPersonalArea.color_detalle,
                            VPersonalArea.grado_abreviado,
                            VPersonalArea.concytec_enlace,
                            VPersonalArea.archivo,
                            VPersonalArea.imagen,
                            VPersonalArea.enlace,
                            VPersonalArea.estado,
                            VPersonalArea.enlace_a,
                            VPersonalArea.nombre_area,
                            VPersonalArea.descripcion_area,
                            VPersonalArea.unidad_enlace')
            //->join('Areas', 'Personal.id_personal = Areas.id_personal')
            ->where("VPersonalArea.estado='A' AND VPersonalArea.unidad_enlace= '{$enlace}'  AND VPersonalArea.estado_pa ='A' AND VPersonalArea.visible ='1' AND VPersonalArea.id_personal > 0 AND VPersonalArea.enlace_detalle <> 'X'")

            //->limit(6)
            ->orderBy('VPersonalArea.orden, VPersonalArea.orden_detalle ')
            ->getQuery()
            ->execute();
        $this->view->personales = $personales;
        //echo "<pre>";
        //print_r($personal->concytec_enalce);
        //exit();
    }

    public function web_areas_unidadesAction($enlace)
    {

        //Relacionamos area con personal
        $area = Areas::findFirst("enlace='{$enlace}' AND estado = 'A' ");
        $this->view->area = $area;

        $personales = $this->modelsManager->createBuilder()
            ->from('VPersonalArea')
            ->columns('VPersonalArea.id_personal,
                            VPersonalArea.orden,
                            VPersonalArea.nombres,
                            VPersonalArea.apellidop,
                            VPersonalArea.apellidom,
                            VPersonalArea.oficina,
                            VPersonalArea.cargo,
                            VPersonalArea.email,
                            VPersonalArea.email1,
                            VPersonalArea.email2,
                            VPersonalArea.color_detalle,
                            VPersonalArea.grado_abreviado,
                            VPersonalArea.concytec_enlace,
                            VPersonalArea.archivo,
                            VPersonalArea.imagen,
                            VPersonalArea.enlace,
                            VPersonalArea.estado,
                            VPersonalArea.enlace_a,
                            VPersonalArea.nombre_area,
                            VPersonalArea.descripcion_area,
                            VPersonalArea.unidad_enlace')
            //->join('Areas', 'Personal.id_personal = Areas.id_personal')
            ->where("VPersonalArea.estado='A' AND VPersonalArea.enlace_a= '{$enlace}'  AND VPersonalArea.estado_pa ='A' AND VPersonalArea.visible ='1' AND VPersonalArea.id_personal > 0  AND VPersonalArea.enlace_detalle <> 'X'")

            //->limit(6)
            ->orderBy('VPersonalArea.orden, VPersonalArea.orden_detalle ')
            ->getQuery()
            ->execute();
        $this->view->personales = $personales;
        //echo "<pre>";
        //print_r($personal->concytec_enalce);
        //exit();
    }

    public function web_videosAction()
    {
        $numberPage = $this->request->getQuery("page", "int");

        $videos = $this->modelsManager->createBuilder()
            ->from('Videos')
            ->columns('Videos.id_video,
                        Videos.titular,
                        Videos.youtube,
                        Videos.estado')
            ->where("Videos.estado ='A'")
            //->limit(4)
            ->groupBy("Videos.id_video")
            ->orderBy("Videos.id_video DESC")
            ->getQuery()
            ->execute();
        $data = $videos;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 12,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
    }

    public function presentacionAction()
    {
    }

    public function unca_presentacionAction()
    {
    }

    public function unaaa_presentacionAction()
    {
    }

    public function mdb_presentacionAction()
    {
    }

    public function asedeh_presentacionAction()
    {
    }

    public function aspefeen_presentacionAction()
    {
    }

    public function aspefeen_misionAction()
    {
    }

    public function aspefeen_visionAction()
    {
    }

    public function aspefeen_asociadosAction()
    {
    }

    public function aspefeen_enaeAction()
    {
    }

    public function aspefeen_concejo_directivoAction()
    {
    }

    public function aspefeen_contactenosAction()
    {
    }

    public function aspefeen_enae_contactenosAction()
    {
    }

    public function aspefeen_enae_tabla_especificacionesAction()
    {
    }

    public function aspefeen_enae_tasas_pagoAction()
    {
    }

    public function aspefeen_enae_lugar_pagoAction()
    {
    }

    public function aspefeen_enae_cronogramaAction()
    {
    }

    public function aspefeen_enae_reglamentoAction()
    {
    }

    public function aspefeen_enae_convocatoriaAction()
    {
    }

    public function achiote_patronato_culturalAction()
    {
    }

    public function achiote_directoAction()
    {
    }

    public function achiote_fines_objetivosAction()
    {
    }

    public function achiote_misionAction()
    {
    }

    public function achiote_actividad_rutaAction()
    {
    }

    public function achiote_actividad_eleccionAction()
    {
    }

    public function achiote_actividad_festival_danzaAction()
    {
    }

    public function achiote_actividad_festival_musicaAction()
    {
    }

    public function achiote_actividad_festival_arteAction()
    {
    }

    public function achiote_actividad_ritualAction()
    {
    }

    public function achiote_actividad_feriaAction()
    {
    }

    public function achiote_actividad_corsoAction()
    {
    }

    public function achiote_actividad_celebracionAction()
    {
    }

    public function achiote_presentacionAction()
    {
    }

    public function achiote_significadoAction()
    {
        //cambios subidos
    }

    public function achiote_impactoAction()
    {
    }

    public function achiote_actividadesAction()
    {
    }
    public function rlfm_presentacionAction()
    {
    }

    public function rlfm_francisco_mirandaAction()
    {
    }

    public function rlfm_historiaAction()
    {
    }

    public function rlfm_masoneria_medellinAction()
    {
    }

    public function rlfm_contactenosAction()
    {
    }

    public function vd_antecedentes_historicosAction()
    {
    }



    public function web_en_directo_fbAction()
    {
        $videosfb = Videosfb::findFirst(
            [
                'order' => 'id_video_fb DESC',
                'limit' => 1,
            ]
        );

        // print($robot->enlace);
        // exit();

        $this->view->videosfb = $videosfb;
    }

    public function web_en_directo_ytAction()
    {
        $videosyt = Videosyt::findFirst(
            [
                'order' => 'id_video_yt DESC',
                'limit' => 1,
            ]
        );

        // print($robot->enlace);
        // exit();

        $this->view->videosyt = $videosyt;
    }

    public function consultores_presentacionAction()
    {
    }

    public function cip_presentacionAction()
    {
    }

    public function centro_pagosAction()
    {
    }

    public function unca_centro_pagosAction()
    {
    }

    public function unaaaa_centro_pagosAction()
    {
    }

    public function unca_ambientesAction()
    {
    }

    public function unaaa_ambientesAction()
    {
    }

    public function asedeh_lineas_accionAction()
    {
    }

    public function direccionAction()
    {
    }

    public function unca_direccionAction()
    {
    }

    public function unaaa_direccionAction()
    {
    }

    public function asedeh_direccionAction()
    {
    }

    public function asedeh_accionesAction()
    {
    }

    public function asedeh_ejesAction()
    {
    }

    public function asedeh_finalidadAction()
    {
    }

    public function asedeh_material_educativoAction()
    {
    }

    public function asedeh_objetivosAction()
    {
    }

    public function asedeh_voluntariadoAction()
    {
    }
    public function unca_info_obrasAction()
    {
    }

    public function mision_visionAction()
    {
    }

    public function unca_control_internoAction()
    {
    }

    public function unca_mision_visionAction()
    {
    }

    public function unaaa_mision_visionAction()
    {
    }

    public function unaaa_registros_academicosAction()
    {
    }

    public function unaaa_atencion_estudiantesAction()
    {
    }

    public function unaaa_campus_virtualAction()
    {
    }

    public function mdb_mision_visionAction()
    {
    }

    public function ytas_mision_visionAction()
    {
    }

    public function asedeh_mision_visionAction()
    {
    }

    public function cip_mision_visionAction()
    {
    }

    public function consultores_mision_visionAction()
    {
    }

    public function consultores_direccionAction()
    {
    }

    public function consultores_laboratorio_asfaltoAction()
    {
    }

    public function consultores_laboratorio_concretoAction()
    {
    }

    public function consultores_laboratorio_suelosAction()
    {
    }

    public function consultores_mecanica_suelosAction()
    {
    }

    public function unca_gestion_ambientalAction()
    {
    }

    public function unca_gestion_conveniosAction()
    {
    }

    public function unaaa_gestion_ambientalAction()
    {
    }

    public function web_licenciamientoAction()
    {
    }

    public function web_licenciamiento1Action()
    {
    }

    public function estatutoAction()
    {
    }

    public function web_organigramaAction()
    {
    }

    public function unca_info_no_disponibleAction()
    {
    }

    public function web_visitasAction()
    {

        $fecha_visita = "";
        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $where = "";
        if ($this->request->isGet()) {

            if (isset($_GET["fecha_visita"])) {
                $fecha_visita = $this->request->getQuery("fecha_visita", "string");
                $where = $where . " AND TO_CHAR(fecha_visita, 'DD/MM/YYYY') = '$fecha_visita'";
            }
        }



        $numberPage = $this->request->getQuery("page", "int");
        $visitas = $this->modelsManager->createBuilder()
            ->from('Visitas')
            ->columns('Visitas.id_visita,
                to_char(Visitas.fecha_visita, "DD/MM/YYYY") AS fecha_visita,
                CONCAT(Publico.apellidop," ",Publico.apellidom," ",Publico.nombres) AS visitante,
                Publico.nro_doc AS documento,
                Empresas.razon_social,
                Motivos.nombres AS motivo,
                Sedes.nombres AS sede,
                CONCAT (Personal.apellidop," ", Personal.apellidom," ", Personal.nombres ) AS personal,
                Areas.nombres AS area,
                Lugares.descripcion AS lugar,
                TO_CHAR(Visitas.hora_ingreso, "HH12:MI AM") AS hora_ingreso,
                TO_CHAR(Visitas.hora_salida, "HH12:MI AM") AS hora_salida,
                Visitas.estado')
            ->where("Visitas.estado = 'A' AND Motivos.numero = 128  " . $where)
            ->join('Motivos', 'Motivos.codigo = Visitas.id_motivo')
            ->join('EmpresaPublico', 'EmpresaPublico.id_empresa_publico = Visitas.id_visitante')
            ->join('Publico', 'Publico.codigo = EmpresaPublico.id_publico')
            ->join('Empresas', 'Empresas.id_empresa = EmpresaPublico.id_empresa')
            ->join('Sedes', 'Sedes.id_sede = Visitas.id_sede')
            ->join('Personal', 'Personal.codigo = Visitas.id_personal')
            ->join('Areas', 'Areas.codigo = Visitas.id_area')
            ->join('Lugares', 'Lugares.id_lugar = Visitas.id_lugar')
            ->orderBy('Visitas.fecha_visita DESC, Visitas.hora_salida DESC')
            ->getQuery()
            ->execute();
        // foreach ($visitas as $khi) {
        //     echo "<pre>";
        //     print_r("Fecha:" . $khi->fecha_visita . '<br>');
        //     print_r("Visitante:" . $khi->visitante . '<br>');
        //     print_r("Documento:" . $khi->documento . '<br>');
        //     print_r("Entidad:" . $khi->razon_social . '<br>');
        //     print_r("Motivo:" . $khi->motivo . '<br>');
        //     print_r("Sede:" . $khi->sede . '<br>');
        //     print_r("Empleado Publico:" . $khi->personal . '<br>');
        //     print_r("Oficina:" . $khi->area . '<br>');
        //     print_r("Lugar:" . $khi->lugar . '<br>');
        //     print_r("Hora Ingreso:" . $khi->hora_ingreso . '<br>');
        //     print_r("Hora Salida:" . $khi->hora_salida . '<br>');

        // }
        // exit();

        $data = $visitas;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
        $this->view->fecha_visita = $fecha_visita;
        $this->view->full_url = $full_url;
    }

    public function web_estudiantesAction()
    {
    }

    public function web_docentesAction()
    {
    }

   
    public function unca_admisionAction()
    {
    }

    public function unaaa_admisionAction()
    {
    }

    public function cepreAction()
    {
    }

    public function unca_cepreAction()
    {
    }

    public function unaaa_cepreAction()
    {
    }

    public function unca_documentos_gestionAction()
    {
    }

    public function unaaa_documentos_gestionAction()
    {
    }

    public function ytas_documentos_gestionAction()
    {
    }

    public function asedeh_documentos_gestionAction()
    {
    }

    public function cv_presentacionAction()
    {
    }

    public function cv_objetivosAction()
    {
    }

    public function cv_modelo_negocioAction()
    {
    }

    public function cv_mision_visionAction()
    {
    }

    public function mallas_curricularesAction()
    {
    }

    public function unca_mallas_curricularesAction()
    {
    }

    public function unaaa_mallas_curricularesAction()
    {
    }

    public function transparencia_universitariaAction()
    {
    }
    public function unca_proceso_elecciones_sst_2022_1Action()
    {
    }

    public function unca_transparencia_universitariaAction()
    {
    }

    public function web_transparencia_estandarAction()
    {
    }

    public function unaaa_transparencia_universitariaAction()
    {
    }

    public function mdb_transparencia_municipalAction()
    {
    }

    public function cip_tramite_colegiaturaAction()
    {
    }

    public function cip_tramite_cambio_sedeAction()
    {
    }

    public function cip_tramite_certificado_habilidadAction()
    {
    }

    public function cip_busqueda_colegiadosAction()
    {


        $nombre_colegiado = "";
        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $where = "";
        if ($this->request->isGet()) {

            if (isset($_GET["nombre_colegiado"])) {
                $nombre_colegiado = strtoupper($this->request->getQuery("nombre_colegiado", "string"));
                $where = $where . " AND ( CAST(VColegiados.codigo AS TEXT)  LIKE '%" . $nombre_colegiado . "%' OR UPPER(VColegiados.apellidop)  LIKE UPPER('%" . $nombre_colegiado . "%') OR UPPER(VColegiados.apellidom)  LIKE UPPER('%" . $nombre_colegiado . "%') OR UPPER(VColegiados.nombres)  LIKE UPPER('%" . $nombre_colegiado . "%') OR UPPER(VColegiados.especialidad)  LIKE UPPER('%" . $nombre_colegiado . "%'))";
            }
        }


        $numberPage = $this->request->getQuery("page", "int");

        $VColegiados = $this->modelsManager->createBuilder()
            ->from('VColegiados')
            ->columns('VColegiados.codigo,
                        VColegiados.apellidop,
                        VColegiados.apellidom,
                        VColegiados.nombres,
                        VColegiados.capitulo, VColegiados.foto,
                        VColegiados.nro_doc,
                        VColegiados.telefono, VColegiados.consejo,
                        VColegiados.celular, VColegiados.especialidad,
                        VColegiados.direccion, VColegiados.email,
                        VColegiados.habilitado')
            ->where(" VColegiados.estado = 'A' AND VColegiados.vive = '1' " . $where)
            ->orderBy(" VColegiados.consejo, VColegiados.apellidop, VColegiados.apellidom, VColegiados.nombres")
            ->getQuery()
            ->execute();
        $data = $VColegiados;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
        $this->view->nombre_colegiado = $nombre_colegiado;
        $this->view->full_url = $full_url;
    }

    public function web_directorio_docentesAction()
    {

        $input_personal = "";
        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $input_personal = $this->request->getQuery("input_personal", "string");
        $where = "";
        if ($input_personal != "") {

            $where = $where . " AND ( UPPER(VDocentes.nombres) LIKE UPPER('%" . $input_personal . "%') "
                . "OR UPPER(VDocentes.apellidop)  LIKE UPPER('%" . $input_personal . "%') "
                . "OR UPPER(VDocentes.apellidom)  LIKE UPPER('%" . $input_personal . "%') )";
        }

        // print($where);
        // exit();

        $numberPage = $this->request->getQuery("page", "int");
        $personales = $this->modelsManager->createBuilder()
            ->from('VDocentes')
            ->columns('VDocentes.codigo,
                            VDocentes.investigacion_d,
                            VDocentes.nombres,
                            VDocentes.apellidop,
                            VDocentes.apellidom,
                            VDocentes.email1,
                            VDocentes.regimen_d,
                            VDocentes.nro_doc,
                            VDocentes.foto,
                            VDocentes.grado_d,
                            VDocentes.concytec_enlace,
                            VDocentes.grado_mencion_mayor,
                            VDocentes.categoria_d,
                            VDocentes.renacyt_d,
                            VDocentes.investigador_d, 
                            VDocentes.renacyt_nivel,
                            VDocentes.estado')
            //->join('Areas', 'Personal.id_personal = Areas.id_personal')
            ->where("VDocentes.estado='A' " . $where)

            //->limit(6)
            ->orderBy('VDocentes.apellidop,
                            VDocentes.apellidom,
                            VDocentes.nombres')
            ->getQuery()
            ->execute();
        // foreach ($personales as $khi) {

        //     echo "<pre>";
        //     print_r("Nombres:" . $khi->nombres . '<br>');
        // }
        // exit();
        $data = $personales;
        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 20,
                'page' => $numberPage,
            ]
        );
        $page = $paginator->getPaginate();
        $this->view->page = $page;
        $this->view->input_personal = $input_personal;
        $this->view->full_url = $full_url;
    }

    public function web_directorio_docentes_investigacionAction()
    {
        $personales = $this->modelsManager->createBuilder()
            ->from('VDocentes')
            ->columns('VDocentes.codigo,
                            VDocentes.investigacion_d,
                            VDocentes.nombres,
                            VDocentes.apellidop,
                            VDocentes.apellidom,
                            VDocentes.email1,
                            VDocentes.regimen_d,
                            VDocentes.nro_doc,
                            VDocentes.foto,
                            VDocentes.grado_d,
                            VDocentes.concytec_enlace,
                            VDocentes.grado_mencion_mayor,
                            VDocentes.categoria_d,
                            VDocentes.estado')
            //->join('Areas', 'Personal.id_personal = Areas.id_personal')
            ->where("VDocentes.estado='A' and VDocentes.investigacion_d = 'SI'")

            //->limit(6)
            ->orderBy('VDocentes.apellidop,
                            VDocentes.apellidom,
                            VDocentes.nombres')
            ->getQuery()
            ->execute();
        $this->view->personales = $personales;
    }

    public function web_directorio_administrativosAction()
    {
        //echo '<pre>';
        //print_r($_SESSION);
        //exit();
        //


        $input_personal = "";
        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $input_personal = $this->request->getQuery("input_personal", "string");
        $where = "";
        if ($input_personal != "") {

            $where = $where . " AND ( UPPER(VPersonalArea.nombres) LIKE UPPER('%" . $input_personal . "%') "
                . "OR UPPER(VPersonalArea.apellidop)  LIKE UPPER('%" . $input_personal . "%') "
                . "OR UPPER(VPersonalArea.apellidom)  LIKE UPPER('%" . $input_personal . "%') "
                . "OR UPPER(VPersonalArea.cargo)  LIKE UPPER('%" . $input_personal . "%') "
                . "OR UPPER(VPersonalArea.oficina)  LIKE UPPER('%" . $input_personal . "%'))";
        }


        $numberPage = $this->request->getQuery("page", "int");
        $VPersonalArea = $this->modelsManager->createBuilder()
            ->from('VPersonalArea')
            ->columns('VPersonalArea.id_personal,
                            VPersonalArea.orden,
                            VPersonalArea.nombres,
                            VPersonalArea.apellidop,
                            VPersonalArea.apellidom,
                            VPersonalArea.oficina,
                            VPersonalArea.cargo,
                            VPersonalArea.email,
                            VPersonalArea.email1,
                            VPersonalArea.email2,
                            VPersonalArea.color_detalle,
                            VPersonalArea.grado_abreviado,
                            VPersonalArea.concytec_enlace,
                            VPersonalArea.archivo,
                            VPersonalArea.imagen,
                            VPersonalArea.enlace,
                            VPersonalArea.estado')
            //->join('Areas', 'Areas.area_id = Funcionarios.area_id')
            ->where(" VPersonalArea.estado='A' AND VPersonalArea.estado_pa ='A' AND VPersonalArea.visible ='1' AND VPersonalArea.id_personal > 0  " . $where)
            //->orderBy('Areas.area_id')
            ->orderBy('VPersonalArea.orden, VPersonalArea.orden_detalle')
            ->getQuery()
            ->execute();
        //       foreach ($VPersonalArea as $khi) {
        //
        //           echo "<pre>";
        //            print_r("Nombres:".$khi->nombres . '<br>');
        //        }
        //
        //        exit();

        $data = $VPersonalArea;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 20,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
        $this->view->input_personal = $input_personal;
        $this->view->full_url = $full_url;
    }

    public function web_directorio_personalAction()
    {
        //echo '<pre>';
        //print_r($_SESSION);
        //exit();
        //
        $site_key = $this->config->recaptchav3->xWebsiteKey;
        $this->view->site_key = $site_key;
        $secret_key = $this->config->recaptchav3->XSecretKey;
        $this->view->secret_key = $secret_key;

        if (!$this->session->has('robot_2')) {

            if ($this->request->get('g-recaptcha-response')) {

                $SecretKey = $this->request->get('g-recaptcha-response', "string");

                $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response={$SecretKey}");
                $Return = json_decode($Response);

                //var_dump($Return);exit();

                if ($Return->success == true && $Return->score > 0.5) {

                    $this->session->set('robot_2', ['value' => 'no']);

                    //echo '<pre>';
                    //print_r('Succes');
                    //exit();
                    //where
                    $input_personal = $this->request->getQuery("input_personal", "string");
                    $where = "";
                    if ($input_personal != "") {

                        //$where = $where . " AND VPersonalArea.nombres  LIKE '%" . $nombre_personal . "%' OR VPersonalArea.apellidop  LIKE '%" . $nombre_personal . "%' ";
                        $where = $where . " AND ( UPPER(VPersonalArea.nombres) LIKE UPPER('%" . $input_personal . "%') "
                            . "OR UPPER(VPersonalArea.apellidop)  LIKE UPPER('%" . $input_personal . "%') "
                            . "OR UPPER(VPersonalArea.apellidom)  LIKE UPPER('%" . $input_personal . "%') "
                            . "OR UPPER(VPersonalArea.cargo)  LIKE UPPER('%" . $input_personal . "%') "
                            . "OR UPPER(VPersonalArea.oficina)  LIKE UPPER('%" . $input_personal . "%'))";
                    }

                    //echo '<pre>';
                    //print_r($where);
                    //exit();
                    //fin where
                } else {
                    $this->session->set('robot_2', ['value' => 'si']);
                    //echo '<pre>';
                    //print_r('You are a Robot!!');
                    //exit();
                    return $this->response->redirect("https://www.google.com/");
                }
            }
        } else {
            $robot = $this->session->get('robot_2');
            if ($robot["value"] === 'si') {
                //exit();
                return $this->response->redirect("https://www.google.com/");
            } else {
                //where
                $input_personal = $this->request->getQuery("input_personal", "string");
                $where = "";
                if ($input_personal != "") {

                    //$where = $where . " AND VPersonalArea.nombres  LIKE '%" . $nombre_personal . "%' OR VPersonalArea.apellidop  LIKE '%" . $nombre_personal . "%' ";
                    $where = $where . " AND ( UPPER(VPersonalArea.nombres) LIKE UPPER('%" . $input_personal . "%') "
                        . "OR UPPER(VPersonalArea.apellidop)  LIKE UPPER('%" . $input_personal . "%') "
                        . "OR UPPER(VPersonalArea.apellidom)  LIKE UPPER('%" . $input_personal . "%') "
                        . "OR UPPER(VPersonalArea.cargo)  LIKE UPPER('%" . $input_personal . "%') "
                        . "OR UPPER(VPersonalArea.oficina)  LIKE UPPER('%" . $input_personal . "%'))";
                }
            }
        }
        //fin validacion recaptchav3

        $numberPage = $this->request->getQuery("page", "int");
        $VPersonalArea = $this->modelsManager->createBuilder()
            ->from('VPersonalArea')
            ->columns('VPersonalArea.id_personal,
                            VPersonalArea.orden,
                            VPersonalArea.nombres,
                            VPersonalArea.apellidop,
                            VPersonalArea.apellidom,
                            VPersonalArea.oficina,
                            VPersonalArea.cargo,
                            VPersonalArea.email,
                            VPersonalArea.email1,
                            VPersonalArea.email2,
                            VPersonalArea.color_detalle,
                            VPersonalArea.grado_abreviado,
                            VPersonalArea.concytec_enlace,
                            VPersonalArea.archivo,
                            VPersonalArea.imagen,
                            VPersonalArea.enlace,
                            VPersonalArea.estado')
            ->where(" VPersonalArea.estado='A' AND VPersonalArea.estado_pa ='A' AND VPersonalArea.visible ='1' AND VPersonalArea.id_personal > 0  " . $where)
            //->orderBy('Areas.area_id')
            ->orderBy('VPersonalArea.orden, VPersonalArea.orden_detalle')
            ->getQuery()
            ->execute();

        $data = $VPersonalArea;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
        $this->view->input_personal = $input_personal;

        $this->assets->addJs("https://www.google.com/recaptcha/api.js?render=" . $site_key);
        $this->assets->addJs("adminpanel/js/viewsweb/directorio.administrativos.js?v=" . uniqid());
    }

    public function web_resolucionesAction()
    {

        //cerramos sesion si no la inicio
        //if (!$this->session->has('auth')) {
        //    return $this->response->redirect("");
        //}

        $nombre_resolucion = "";
        $tipo_resolucion = "";
        $anio_resolucion = "";
        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        //echo '<pre>';
        //print_r($full_url);
        //exit();
        //Cargamos el modelo de los distritos

        $where = " Resoluciones.estado = 'A' AND Resoluciones.visible = '1' ";

        if ($this->request->isGet()) {

            if (isset($_GET["nombre_resolucion"])) {
                $nombre_resolucion = $this->request->getQuery("nombre_resolucion", "string");
                $where = $where . " AND ( CAST(Resoluciones.numero AS TEXT)  ILIKE '%" . $nombre_resolucion . "%' OR Resoluciones.titulo  ILIKE '%" . $nombre_resolucion . "%' OR Resoluciones.resumen  ILIKE '%" . $nombre_resolucion . "%' OR Resoluciones.resuelve  ILIKE '%" . $nombre_resolucion . "%' OR Resoluciones.visto  ILIKE '%" . $nombre_resolucion . "%')";
            }

            if (isset($_GET["tipo_resolucion"]) && $_GET["tipo_resolucion"] != "") {
                $tipo_resolucion = $this->request->getQuery("tipo_resolucion", "int");
                $where = $where . " AND Resoluciones.tipo = " . $tipo_resolucion;
            }
            if (isset($_GET["anio_resolucion"]) && $_GET["anio_resolucion"] != "") {
                $anio_resolucion = $this->request->getQuery("anio_resolucion", "string");
                $where = $where . " AND Resoluciones.anio = '" . $anio_resolucion . "'";

                //echo '<pre>';
                //print_r($where);
                //exit();
            }
        }
        //
        if (isset($_GET["page"])) {
            $currentPage = (int) $_GET['page'];
        } else {
            $currentPage = 1;
        }

        //print $where ; exit();

        $Resoluciones = $this->modelsManager->createBuilder()
            ->from('Resoluciones')
            ->columns('Resoluciones.id_resolucion,
                        Resoluciones.anio,
                        Resoluciones.tipo,
                        Resoluciones.numero,
                        Resoluciones.titulo,
                        Resoluciones.resumen,
                        Resoluciones.visto,
                        Resoluciones.resuelve,
                        Resoluciones.fecha,
                        Resoluciones.visible,
                        Resoluciones.escaneado,
                        Resoluciones.archivo,
                        Resoluciones.imagen,
                        Resoluciones.enlace,
                        Resoluciones.estado')
            ->where($where)
            //->orderBy('Areas.area_id')
            ->orderBy('Resoluciones.fecha DESC,Resoluciones.tipo, Resoluciones.numero DESC')
            ->getQuery()
            ->execute();
        $data = $Resoluciones;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 15,
                'page' => $currentPage,
            ]
        );

        $page = $paginator->getPaginate();

        $this->view->page = $page;
        $anio_actual = AnioResoluciones::find([
            "numero = 40 ",
            "order" => "codigo DESC",
            "limit" => 1,
        ]);
        $this->view->anio_actual = $anio_actual[0]->codigo;
        $this->view->nombre_resolucion = $nombre_resolucion;
        $this->view->tipo_resolucion = $tipo_resolucion;
        $this->view->anio_resolucion = $anio_resolucion;
        $this->view->full_url = $full_url;

        $tipo_resoluciones = TipoResoluciones::find("estado = 'A' AND numero = 70 ");
        $this->view->tiporesoluciones = $tipo_resoluciones;

        //AnioResoluciones
        $anio_resoluciones = AnioResoluciones::find("estado = 'A' AND numero = 40 ORDER BY codigo DESC ");
        $this->view->anioresoluciones = $anio_resoluciones;

        $resoluciones2 = ResolucionesDetalles::find(
            [
                "estado = 'A'",
                'order' => 'id_resolucion_detalle ASC',
            ]
        );
        $this->view->resoluciones2 = $resoluciones2;


        $db = $this->db;
        $tipoNombresQuery = "SELECT PUBLIC
        .tbl_web_resoluciones_detalles.id_resolucion_detalle,
        PUBLIC.tbl_web_resoluciones_detalles.id_resolucion,
        PUBLIC.tbl_web_resoluciones_detalles.id_resolucion2,
        tipos.nombres AS tipo,
        tbl_web_resoluciones2.titulo,
        PUBLIC.tbl_web_resoluciones_detalles.estado 
    FROM
        PUBLIC.tbl_web_resoluciones
        INNER JOIN PUBLIC.tbl_web_resoluciones_detalles ON PUBLIC.tbl_web_resoluciones_detalles.id_resolucion = PUBLIC.tbl_web_resoluciones.id_resolucion
        INNER JOIN PUBLIC.a_codigos AS tipos ON tipos.codigo = PUBLIC.tbl_web_resoluciones_detalles.id_tipo
        INNER JOIN PUBLIC.tbl_web_resoluciones AS tbl_web_resoluciones2 ON PUBLIC.tbl_web_resoluciones_detalles.id_resolucion2 = tbl_web_resoluciones2.id_resolucion 
    WHERE
        tipos.numero = 140 
        AND PUBLIC.tbl_web_resoluciones_detalles.estado = 'A'";
        $resdetalle = $db->fetchAll($tipoNombresQuery, Phalcon\Db::FETCH_OBJ);

        // foreach ($resdetalle as $key => $value) {
        //     print_r($value->id_resolucion_detalle);
        // }
        // exit();

        $this->view->resdetalle = $resdetalle;
    }

    public function web_librosAction()
    {
        //recaptchav3
        $site_key = $this->config->recaptchav3->xWebsiteKey;
        $this->view->site_key = $site_key;

        $secret_key = $this->config->recaptchav3->XSecretKey;
        $this->view->secret_key = $secret_key;

        if (!$this->session->has('robot_3')) {

            if ($this->request->get('g-recaptcha-response')) {

                $SecretKey = $this->request->get('g-recaptcha-response', "string");

                $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response={$SecretKey}");
                $Return = json_decode($Response);

                //var_dump($Return);exit();

                if ($Return->success == true && $Return->score > 0.5) {

                    $this->session->set('robot_3', ['value' => 'no']);

                    //echo '<pre>';
                    //print_r('Succes');
                    //exit();
                    //where
                    $nombre_libro = strtoupper($this->request->getQuery("nombre_libro", "string"));
                    $where = "";
                    if ($nombre_libro != "") {

                        $where = " and Libros.id_libro  LIKE '%" . $nombre_libro . "%' OR Libros.titulo  LIKE '%" . $nombre_libro . "%'";
                    }
                    //fin where
                } else {
                    $this->session->set('robot_3', ['value' => 'si']);
                    //echo '<pre>';
                    //print_r('You are a Robot!!');
                    //exit();
                    return $this->response->redirect("https://www.google.com/");
                }
            }
        } else {
            $robot = $this->session->get('robot_3');
            if ($robot["value"] === 'si') {
                //exit();
                return $this->response->redirect("https://www.google.com/");
            } else {
                //where
                $nombre_libro = strtoupper($this->request->getQuery("nombre_libro", "string"));
                $where = "";
                if ($nombre_libro != "") {

                    $where = " and Libros.id_libro  LIKE '%" . $nombre_libro . "%' OR Libros.titulo  LIKE '%" . $nombre_libro . "%'";
                }
                //fin where
            }
        }

        $numberPage = $this->request->getQuery("page", "int");

        $Libros = $this->modelsManager->createBuilder()
            ->from('Libros')
            ->columns('Libros.titulo,
                        Libros.codigo,
                        Libros.fecha_lanzamiento AS fecha_lanzamiento,
                        Libros.paginas AS paginas,
                        Libros.cantidad_ejemplares AS cantidad_ejemplares,
                        Libros.isbn AS isbn,
                        Libros.autor_1 AS autor_1,
                        Libros.autor_2 AS autor_2,
                        Libros.autor_3 AS autor_3,
                        Libros.libro_id AS libro_id,
                        Autores.descripcion AS autores_1')
            ->join('Autores', 'Autores.autor_id = Libros.autor_1')
            ->where("Libros.estado='A'" . $where)
            ->orderBy("Libros.titulo")
            ->getQuery()
            ->execute();
        $data = $Libros;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;

        $this->view->nombre_libro = $nombre_libro;
        $this->assets->addJs("https://www.google.com/recaptcha/api.js?render=" . $site_key);
        $this->assets->addJs("adminpanel/js/viewsweb/libros.js?v=" . uniqid());
    }

    public function web_documentos_gestionAction()
    {

        $input_titulo_tipo = "";
        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $input_titulo_tipo = $this->request->getQuery("busqueda", "string");
        $whereTipo = "";
        if ($input_titulo_tipo != "") {

            $whereTipo = $whereTipo . " AND ( UPPER(public.tbl_web_documentos.titulo) LIKE UPPER('%" . $input_titulo_tipo . "%'))";
        }

        $db = $this->db;
        $tipoNombresQuery = "SELECT
        public.a_codigos.codigo,
        public.a_codigos.nombres,
        public.a_codigos.orden
        FROM
        public.tbl_web_documentos
        INNER JOIN public.a_codigos ON public.a_codigos.codigo = public.tbl_web_documentos.tipo
        WHERE
        public.a_codigos.numero = 90 AND
        public.tbl_web_documentos.visible = '1' AND
        public.tbl_web_documentos.estado = 'A' $whereTipo
        GROUP BY
        public.a_codigos.codigo,
        public.a_codigos.nombres,
        public.a_codigos.orden
        ORDER BY 
        public.a_codigos.orden,
        public.a_codigos.nombres";
        $tipoNombres = $db->fetchAll($tipoNombresQuery, Phalcon\Db::FETCH_OBJ);
        $this->view->tipoNombres = $tipoNombres;


        $input_titulo = "";
        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $input_titulo = $this->request->getQuery("busqueda", "string");
        $where = "";
        if ($input_titulo != "") {

            $where = $where . " AND ( UPPER(Documentosgestion.titulo) LIKE UPPER('%" . $input_titulo . "%'))";
        }

        $numberPage = $this->request->getQuery("page", "int");

        $Documentosgestion = $this->modelsManager->createBuilder()
            ->from('Documentosgestion')
            ->columns('Documentosgestion.id_documento,
                        Documentosgestion.titulo,
                        Documentosgestion.referencia,
                        Documentosgestion.referencia_enlace,
                        Documentosgestion.tipo,
                        Documentosgestion.enlace,
                        Documentosgestion.estado')
            //->join('Areas', 'Areas.area_id = Funcionarios.area_id')
            ->where(" Documentosgestion.estado='A' " . $where)
            //->orderBy('Areas.area_id')
            ->orderBy('Documentosgestion.orden')
            ->getQuery()
            ->execute();
        //   foreach ($Documentosgestion as $khi) {

        //       echo "<pre>";
        //        print_r("Nombres:".$khi->titulo . '<br>');
        //    }

        //    exit();

        $data = $Documentosgestion;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 1000,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
        $this->view->input_titulo = $input_titulo;
        $this->view->full_url = $full_url;





        // $documentos = Documentosgestion::find(["visible = '1' AND estado = 'A' ", "order" => "orden ASC"]);
        // $this->view->documentos = $documentos;

        // $documentosArchivos = DocumentosArchivos::find("estado = 'A' ");
        // $this->view->documentosArchivos = $documentosArchivos;

        // $documentosEvaluaciones = DocumentosEvaluaciones::find("estado = 'A' ");
        // $this->view->documentosEvaluaciones = $documentosEvaluaciones;
    }

    public function web_licenciamiento_cbcAction($enlace)
    {

        //Cargamos el modelo de las documentos
        $condicion = Condiciones::findFirstByid_condicion((string) $enlace);
        $this->view->condicion = $condicion;

        //Indicadores
        $indicadores = VIndicadores::find("id_condicion = '{$enlace}' AND estado = 'A'");

        $this->view->indicadores = $indicadores;

        //Indicadores
        $medios = VMedios::find("id_condicion = '{$enlace}' AND id_indicador = '1' AND estado = 'A'");
        $this->view->medios = $medios;

        //licenciamiento_cbc.js
        $this->assets->addJs("adminpanel/js/viewsweb/licenciamiento.cbc.js?v=" . uniqid());
    }

    public function web_licenciamiento1_cbcAction($enlace)
    {

        //Cargamos el modelo de las documentos
        $condicion1 = Condiciones1::findFirstByid_condicion1((string) $enlace);
        $this->view->condicion1 = $condicion1;

        //print($enlace);
        //exit();

        //Indicadores
        $indicadores1 = VIndicadores1::find("id_condicion1 = '{$enlace}' AND estado = 'A'");

        // foreach ($indicadores1 as $test) {

        //     echo "<pre>";
        //     print_r($test->indicador_a . '<br>');

        // }
        // exit();

        $this->view->indicadores1 = $indicadores1;

        //licenciamiento_cbc.js
        $this->assets->addJs("adminpanel/js/viewsweb/licenciamiento1.cbc.js?v=" . uniqid());
    }

    //verificacion
    public function verificarMediosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_condicion = $this->request->getPost('id_condicion');
            $id_indicador = $this->request->getPost('id_indicador');

            $Medios = VMedios::find('id_condicion="' . $id_condicion . '" AND id_indicador="' . $id_indicador . '" AND estado = "A" ');

            if ($Medios) {
                $this->response->setJsonContent($Medios->toArray());
                $this->response->send();
            } else {
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function verificarMedios1Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $id_condicion1 = $this->request->getPost('id_condicion1');
            $id_indicador1 = $this->request->getPost('id_indicador1');

            // echo"<pre>";
            // print_r($_POST);
            // exit();

            $Medios1 = VMedios1::find('id_condicion1="' . $id_condicion1 . '" AND id_indicador1="' . $id_indicador1 . '" AND estado = "A" ');

            if ($Medios1) {
                $this->response->setJsonContent($Medios1->toArray());
                $this->response->send();
            } else {
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function web_concejo_municipalAction()
    {

        $autoridades = $this->modelsManager->createBuilder()
            ->from('VAutoridades')
            ->columns('VAutoridades.nombres,
                            VAutoridades.apellidop,
                            VAutoridades.apellidom,
                            VAutoridades.cargo,
                            VAutoridades.grado_abreviado,
                            VAutoridades.concytec_enlace, VAutoridades.peru_enlace,
                            VAutoridades.archivo,
                            VAutoridades.imagen,
                            VAutoridades.enlace,
                            VAutoridades.estado, VAutoridades.enlace_detalle_pa,
                            VAutoridades.descripcion')
            ->where("VAutoridades.estado='A'")
            ->orderBy('VAutoridades.enlace')
            ->getQuery()
            ->execute();
        $this->view->autoridades = $autoridades;
    }

    public function web_comision_organizadoraAction()
    {

        $autoridades = $this->modelsManager->createBuilder()
            ->from('VAutoridades')
            ->columns('VAutoridades.nombres,
                            VAutoridades.apellidop,
                            VAutoridades.apellidom,
                            VAutoridades.cargo,
                            VAutoridades.grado_abreviado,
                            VAutoridades.concytec_enlace,  VAutoridades.peru_enlace,
                            VAutoridades.archivo,
                            VAutoridades.imagen,
                            VAutoridades.enlace,
                            VAutoridades.estado, VAutoridades.enlace_detalle_pa,
                            VAutoridades.descripcion,
                            VAutoridades.imagen_vertical')
            ->where("VAutoridades.estado='A'")
            ->orderBy('VAutoridades.enlace')
            ->getQuery()
            ->execute();
        $this->view->autoridades = $autoridades;
    }

    //galerias.html
    public function web_galeriasAction()
    {

        $numberPage = $this->request->getQuery("page", "int");

        $galerias = $this->modelsManager->createBuilder()
            ->from('Galerias')
            ->columns('Galerias.id_galeria,
                        Galerias.titular,
                        Galerias.descripcion,
                        Galerias.enlace,
                        Galerias.archivo,
                        Galerias.imagen,
                        Galerias.fecha,
                        Galerias.estado')
            ->where("Galerias.estado ='A'")
            ->orderBy('Galerias.fecha DESC')
            ->getQuery()
            ->execute();
        $data = $galerias;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
    }

    //ambientes.html
    public function web_ambientesAction()
    {

        $numberPage = $this->request->getQuery("page", "int");

        $ambientes = $this->modelsManager->createBuilder()
            ->from('Ambientes')
            ->columns('Ambientes.id_ambiente,
                        Ambientes.titular,
                        Ambientes.texto_muestra,
                        Ambientes.texto_muestra,
                        Ambientes.imagen,
                        Ambientes.fecha_hora,
                        Ambientes.estado')
            ->where("Ambientes.estado ='A'")
            ->orderBy('Ambientes.fecha_hora DESC')
            ->getQuery()
            ->execute();
        $data = $ambientes;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
    }

    //servicios.html
    public function web_serviciosAction()
    {

        $numberPage = $this->request->getQuery("page", "int");

        $servicios = $this->modelsManager->createBuilder()
            ->from('Servicios')
            ->columns('Servicios.id_servicio,
                        Servicios.titular,
                        Servicios.texto_muestra,
                        Servicios.texto_muestra,
                        Servicios.imagen,
                        Servicios.fecha_hora,
                        Servicios.estado')
            ->where("Servicios.estado ='A'")
            ->orderBy('Servicios.fecha_hora DESC')
            ->getQuery()
            ->execute();
        $data = $servicios;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 10,
                'page' => $numberPage,
            ]
        );

        $page = $paginator->getPaginate();
        $this->view->page = $page;
    }

    //getProvincias
    public function getProvinciasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            // print_r($_POST);
            // exit();
            $region_id = $this->request->getPost("pk");
            $Distritos = Provincias::find('region="' . $region_id . '"');
            // foreach ($Distritos as $value) {
            //     echo"<pre>";
            //     print($value->descripcion);
            // }
            // exit();
            $this->response->setJsonContent($Distritos->toArray());
            $this->response->send();
        }
    }

    //getDistritos
    public function getDistritosAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $region_id = $this->request->getPost("pk");
            $prov_id = $this->request->getPost("idprov");
            $Distritos = Distritos::find('region="' . $region_id . '" AND provincia="' . $prov_id . '"');
            $this->response->setJsonContent($Distritos->toArray());
            $this->response->send();
        }
    }

    //-----------------------Registro y save------------------------------------
    public function web_registro_publicoAction()
    {

        //tipo de documentos(a_codigos)
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        //sexo(a_codigos)
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        $publico = Publico::count();
        $nuevo_usuario = $publico + 1;
        $this->view->codigo_nuevo_postulante = $nuevo_usuario;

        //Modelo seguro(a_codigos)
        $seguros = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguro = $seguros;

        //Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //registrar.publico.js
        $this->assets->addJs("adminpanel/js/viewsweb/registro.publico.js?v=" . uniqid());
    }

    public function savepublicoAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //inicio
                //print_r($_POST);exit();
                $Publico = new Publico();
                $Publico->codigo = $this->request->getPost("codigo");
                $Publico->tipo = 0;
                $Publico->apellidop = strtoupper($this->request->getPost("apellidop"));
                $Publico->apellidom = strtoupper($this->request->getPost("apellidom"));
                $Publico->nombres = strtoupper($this->request->getPost("nombres"));

                if ($this->request->getPost("sexo", "int") == "") {
                    $Publico->sexo = null;
                } else {
                    $Publico->sexo = $this->request->getPost("sexo", "int");
                }

                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $Publico->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("documento", "int") == "") {
                    $Publico->documento = null;
                } else {
                    $Publico->documento = $this->request->getPost("documento", "int");
                }

                $Publico->nro_doc = $this->request->getPost("nro_doc", "string");
                $Publico->seguro = $this->request->getPost("seguro", "string");
                $Publico->telefono = $this->request->getPost("telefono", "string");
                $Publico->celular = $this->request->getPost("celular", "string");
                $Publico->email = $this->request->getPost("email", "string");
                $Publico->direccion = strtoupper($this->request->getPost("direccion", "string"));
                $Publico->ciudad = strtoupper($this->request->getPost("ciudad", "string"));
                $Publico->observaciones = strtoupper($this->request->getPost("observaciones", "string"));

                //Ubigeo
                $Publico->region = $this->request->getPost("region", "string");
                $Publico->provincia = $this->request->getPost("provincia", "string");
                $Publico->distrito = $this->request->getPost("distrito", "string");
                $Publico->ubigeo = $this->request->getPost("ubigeo", "string");

                //$Publico->password = $this->request->getPost("password", "string");

                $password_postulantes = $this->request->getPost("password", "string");
                $Publico->password = $this->security->hash($password_postulantes);

                $Publico->estado = "A";
                //fin

                if ($Publico->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Publico->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //imagen
                            if ($file->getKey() == "foto") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {
                                    $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $Publico->codigo . '.jpg';
                                    $Publico->foto = 'IMG' . '-' . $Publico->codigo . ".jpg";

                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Publico->imagen = $Publico->codigo . "-" . $file->getName();
                                        //$Publico->imagen = 'IMG' . '-' . $Publico->codigo . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {
                                    $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $Publico->codigo . '.png';
                                    $Publico->foto = 'IMG' . '-' . $Publico->codigo . ".png";

                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$Publico->imagen = $Publico->codigo . "-" . $file->getName();
                                        //$Publico->imagen = 'IMG' . '-' . $Publico->codigo . ".jpg";
                                    }
                                }
                            }

                            //archivo
                        }

                        $Publico->save();
                    }

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    //gurdar colegiados
    public function savecolegiadosAction()
    {

        //echo "<pre>";
        //print_r($_FILES);
        //print_r($_FILES['foto']['name']);
        //exit();
        //echo '<pre>';
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //print_r($_POST);exit();
                $colegiados = new Colegiados();
                $colegiados->codigo = $this->request->getPost("codigo", "int");
                $colegiados->apellidop = strtoupper($this->request->getPost("apellidop"));
                $colegiados->apellidom = strtoupper($this->request->getPost("apellidom"));
                $colegiados->nombres = strtoupper($this->request->getPost("nombres"));
                $colegiados->documento = $this->request->getPost("documento", "int");
                $colegiados->nro_doc = $this->request->getPost("nro_doc", "string");

                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $colegiados->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                $colegiados->especialidad = strtoupper($this->request->getPost("especialidad", "string"));
                $colegiados->referencia = strtoupper($this->request->getPost("referencia", "string"));

                //Ubigeo
                $colegiados->region = $this->request->getPost("region", "string");
                $colegiados->provincia = $this->request->getPost("provincia", "string");
                $colegiados->distrito = $this->request->getPost("distrito", "string");
                $colegiados->ubigeo = $this->request->getPost("ubigeo", "string");

                $colegiados->direccion = strtoupper($this->request->getPost("direccion", "string"));
                $colegiados->ciudad = strtoupper($this->request->getPost("ciudad", "string"));
                $colegiados->telefono = $this->request->getPost("telefono", "string");
                $colegiados->celular = $this->request->getPost("celular", "string");

                $colegiados->sexo = $this->request->getPost("sexo", "int");
                $colegiados->seguro = $this->request->getPost("seguro", "int");

                $colegiados->consejo = $this->request->getPost("consejo", "int");
                $colegiados->capitulo = $this->request->getPost("capitulo", "int");

                $colegiados->email = $this->request->getPost("email", "string");
                $colegiados->facebook = $this->request->getPost("facebook", "string");
                $colegiados->twitter = $this->request->getPost("twitter", "string");
                $colegiados->red_social_otra = $this->request->getPost("red_social_otra", "string");
                $colegiados->entidad1 = strtoupper($this->request->getPost("entidad1", "string"));
                $colegiados->entidad2 = strtoupper($this->request->getPost("entidad2", "string"));
                $colegiados->entidad3 = strtoupper($this->request->getPost("entidad3", "string"));

                if ($this->request->getPost("fecha_cip", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_cip", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];
                    $colegiados->fecha_cip = date('Y-m-d', strtotime($fecha_new));
                }

                $colegiados->observaciones = strtoupper($this->request->getPost("observaciones", "string"));
                //$colegiados->password = $this->request->getPost("password", "string");

                $password_colegiados = $this->request->getPost("password", "string");

                $colegiados->password = $this->security->hash($password_colegiados);

                //fecha guardar
                $fecha_modificacion = date('Y-m-d');
                $colegiados->fecha_mod = $fecha_modificacion;

                $colegiados->estado = "A";

                if ($colegiados->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($colegiados->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //foto
                            //validamos si foto esta vacio
                            if ($_FILES['foto']['name'] != "") {
                                if ($file->getKey() == "foto") {

                                    $filex = new SplFileInfo($file->getName());

                                    if ($filex->getExtension() == 'jpg') {
                                        $url_destino = 'adminpanel/imagenes/colegiados/' . 'IMG' . '-' . $colegiados->codigo . '.jpg';
                                        $colegiados->foto = 'IMG' . '-' . $colegiados->codigo . ".jpg";

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    } elseif ($filex->getExtension() == 'png') {
                                        $url_destino = 'adminpanel/imagenes/colegiados/' . 'IMG' . '-' . $colegiados->codigo . '.png';
                                        $colegiados->foto = 'IMG' . '-' . $colegiados->codigo . ".png";

                                        if (!$file->moveTo($url_destino)) {
                                        }
                                    }
                                }
                            } else {
                                if ($this->request->getPost("sexo", "int") == 1) {
                                    $colegiados->foto = "IMG-MALE.jpg";
                                } elseif ($this->request->getPost("sexo", "int") == 2) {
                                    $colegiados->foto = "IMG-FEMALE.jpg";
                                }
                            }
                            //fin foto
                            //archivo
                            if ($_FILES['cv']['name'] != "") {
                                if ($file->getKey() == "cv") {

                                    $url_destino = 'adminpanel/archivos/cv/' . 'FILE' . '-' . $colegiados->codigo . '.pdf';

                                    $colegiados->cv = 'FILE' . '-' . $colegiados->codigo . '.pdf';

                                    if (!$file->moveTo($url_destino)) {
                                    }
                                }
                            }
                        }

                        $colegiados->save();
                    }

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    //preinscripcion
    public function web_preinscripcionAction()
    {

        //tipo de documentos(a_codigos)
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        //sexo(a_codigos)
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        $postulante = Publico::count();
        $nuevo_postulante = $postulante + 1;
        //echo '<pre>';
        //print_r($nuevo_postulante);
        //exit();
        $this->view->codigo_nuevo_postulante = $nuevo_postulante;

        //Modelo seguro(a_codigos)
        $seguros = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguro = $seguros;

        //Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //admision.registro.js
        $this->assets->addJs("adminpanel/js/viewsweb/preinscripcion.js?v=" . uniqid());
    }

    public function web_registrar_publicoAction()
    {

        //tipo de documentos(a_codigos)
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        //sexo(a_codigos)
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        $publico = Publico::count();
        $nuevo_usuario = $publico + 1;
        $this->view->codigo_nuevo_postulante = $nuevo_usuario;

        //Modelo seguro(a_codigos)
        $seguros = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguro = $seguros;

        //Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //registrar.publico.js
        $this->assets->addJs("adminpanel/js/viewsweb/registrar.publico.js?v=" . uniqid());
    }

    //save_preinscripcion
    public function savePostulanteAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //inicio
                //print_r($_POST);exit();
                $postulantes = new Postulantes();
                $postulantes->codigo = $this->request->getPost("codigo");
                $postulantes->tipo = 0;
                $postulantes->apellidop = strtoupper($this->request->getPost("apellidop"));
                $postulantes->apellidom = strtoupper($this->request->getPost("apellidom"));
                $postulantes->nombres = strtoupper($this->request->getPost("nombres"));
                $postulantes->categoria = 1;

                if ($this->request->getPost("sexo", "int") == "") {
                    $postulantes->sexo = null;
                } else {
                    $postulantes->sexo = $this->request->getPost("sexo", "int");
                }

                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $postulantes->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("documento", "int") == "") {
                    $postulantes->documento = null;
                } else {
                    $postulantes->documento = $this->request->getPost("documento", "int");
                }

                $postulantes->nro_doc = $this->request->getPost("nro_doc", "string");
                $postulantes->seguro = $this->request->getPost("seguro", "string");
                $postulantes->telefono = $this->request->getPost("telefono", "string");
                $postulantes->celular = $this->request->getPost("celular", "string");
                $postulantes->email = $this->request->getPost("email", "string");
                $postulantes->direccion = strtoupper($this->request->getPost("direccion", "string"));
                $postulantes->ciudad = strtoupper($this->request->getPost("ciudad", "string"));
                $postulantes->observaciones = strtoupper($this->request->getPost("observaciones", "string"));

                $colegio_publico = $this->request->getPost("colegio_publico", "string");
                if (isset($colegio_publico)) {

                    $postulantes->colegio_publico = 1;
                } else {

                    $postulantes->colegio_publico = 0;
                }

                $postulantes->colegio_nombre = strtoupper($this->request->getPost("colegio_nombre", "string"));

                $sitrabaja = $this->request->getPost("sitrabaja", "string");
                if (isset($sitrabaja)) {

                    $postulantes->sitrabaja = 1;
                } else {

                    $postulantes->sitrabaja = 0;
                }

                $postulantes->sitrabaja_nombre = strtoupper($this->request->getPost("sitrabaja_nombre", "string"));

                $sidepende = $this->request->getPost("sidepende", "string");
                if (isset($sidepende)) {

                    $postulantes->sidepende = 1;
                } else {

                    $postulantes->sidepende = 0;
                }

                $postulantes->sidepende_nombre = strtoupper($this->request->getPost("sidepende_nombre", "string"));

                //Ubigeo
                $postulantes->region = $this->request->getPost("region", "string");
                $postulantes->provincia = $this->request->getPost("provincia", "string");
                $postulantes->distrito = $this->request->getPost("distrito", "string");
                $postulantes->ubigeo = $this->request->getPost("ubigeo", "string");

                //lugar de procedencia
                $postulantes->region1 = $this->request->getPost("region1", "string");
                $postulantes->provincia1 = $this->request->getPost("provincia1", "string");
                $postulantes->distrito1 = $this->request->getPost("distrito1", "string");
                $postulantes->ubigeo1 = $this->request->getPost("ubigeo1", "string");

                $postulantes->localidad = $this->request->getPost("localidad", "string");

                $discapacitado = $this->request->getPost("discapacitado", "string");
                if (isset($discapacitado)) {

                    $postulantes->discapacitado = 1;
                } else {

                    $postulantes->discapacitado = 0;
                }

                $postulantes->discapacitado_nombre = strtoupper($this->request->getPost("discapacitado_nombre", "string"));

                //$postulantes->password = $this->request->getPost("password", "string");

                $password_postulantes = $this->request->getPost("password", "string");
                $postulantes->password = $this->security->hash($password_postulantes);

                $postulantes->estado = "A";
                //fin
                $resp = $postulantes->save();

                if ($resp != 1) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($postulantes->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //imagen
                            if ($file->getKey() == "foto") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {
                                    $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $postulantes->codigo . '.jpg';
                                    $postulantes->foto = 'IMG' . '-' . $postulantes->codigo . ".jpg";

                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$postulantes->imagen = $postulantes->codigo . "-" . $file->getName();
                                        //$postulantes->imagen = 'IMG' . '-' . $postulantes->codigo . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {
                                    $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $postulantes->codigo . '.png';
                                    $postulantes->foto = 'IMG' . '-' . $postulantes->codigo . ".png";

                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$postulantes->imagen = $postulantes->codigo . "-" . $file->getName();
                                        //$postulantes->imagen = 'IMG' . '-' . $postulantes->codigo . ".jpg";
                                    }
                                }
                            }

                            //archivo
                        }

                        $postulantes->save();
                    }

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage() . " LINE :" . $ex->getLine());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }
    public function saveNewPostulanteAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //inicio
                //print_r($_POST);exit();
                $postulantes = new Postulantes();
                //$postulantes->codigo = $this->request->getPost("codigo");
                $postulantes->tipo = 5; //tipo: POSTULANTE tabla acodigos numero=50
                $postulantes->apellidop = strtoupper($this->request->getPost("apellidop"));
                $postulantes->apellidom = strtoupper($this->request->getPost("apellidom"));
                $postulantes->nombres = strtoupper($this->request->getPost("nombres"));
                $postulantes->estado_civil = $this->request->getPost("estado_civil", "int");
                $postulantes->categoria = 1;

                if ($this->request->getPost("sexo", "int") == "") {
                    $postulantes->sexo = null;
                } else {
                    $postulantes->sexo = $this->request->getPost("sexo", "int");
                }

                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $postulantes->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                if ($this->request->getPost("documento", "int") == "") {
                    $postulantes->documento = null;
                } else {
                    $postulantes->documento = $this->request->getPost("documento", "int");
                }

                $postulantes->nro_doc = $this->request->getPost("nro_doc", "string");
                $postulantes->seguro = $this->request->getPost("seguro", "string");
                $postulantes->telefono = $this->request->getPost("telefono", "string");
                $postulantes->celular = $this->request->getPost("celular", "string");
                $postulantes->email = $this->request->getPost("email", "string");
                $postulantes->direccion = strtoupper($this->request->getPost("direccion", "string"));
                $postulantes->ciudad = strtoupper($this->request->getPost("ciudad", "string"));
                $postulantes->observaciones = strtoupper($this->request->getPost("observaciones", "string"));

                $colegio_publico = $this->request->getPost("colegio_publico", "string");
                if (isset($colegio_publico)) {

                    $postulantes->colegio_publico = 1;
                } else {

                    $postulantes->colegio_publico = 0;
                }

                $postulantes->colegio_nombre = strtoupper($this->request->getPost("colegio_nombre", "string"));

                /* ya no
                $sitrabaja = $this->request->getPost("sitrabaja", "string");
                if (isset($sitrabaja)) {

                    $postulantes->sitrabaja = 1;
                } else {

                    $postulantes->sitrabaja = 0;
                }

                $postulantes->sitrabaja_nombre = strtoupper($this->request->getPost("sitrabaja_nombre", "string"));

                $sidepende = $this->request->getPost("sidepende", "string");
                if (isset($sidepende)) {

                    $postulantes->sidepende = 1;
                } else {

                    $postulantes->sidepende = 0;
                }

                $postulantes->sidepende_nombre = strtoupper($this->request->getPost("sidepende_nombre", "string"));
                */


                //Ubigeo
                $postulantes->region = $this->request->getPost("region", "string");
                $postulantes->provincia = $this->request->getPost("provincia", "string");
                $postulantes->distrito = $this->request->getPost("distrito", "string");
                $postulantes->ubigeo = $this->request->getPost("ubigeo", "string");

                //lugar de procedencia
                $postulantes->region1 = $this->request->getPost("region1", "string");
                $postulantes->provincia1 = $this->request->getPost("provincia1", "string");
                $postulantes->distrito1 = $this->request->getPost("distrito1", "string");
                $postulantes->ubigeo1 = $this->request->getPost("ubigeo1", "string");

                $postulantes->localidad = $this->request->getPost("localidad", "string");

                $discapacitado = $this->request->getPost("discapacitado", "string");
                if (isset($discapacitado)) {

                    $postulantes->discapacitado = 1;
                } else {

                    $postulantes->discapacitado = 0;
                }

                $postulantes->discapacitado_nombre = strtoupper($this->request->getPost("discapacitado_nombre", "string"));

                //$postulantes->password = $this->request->getPost("password", "string");

                $password_postulantes = $this->request->getPost("password", "string");
                $postulantes->password = $this->security->hash($password_postulantes);

                $postulantes->estado = "A";
                //fin
                $resp = $postulantes->save();

                if ($resp != 1) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($postulantes->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            //echo "<pre>";print_r($file);exit();
                            //imagen
                            if ($file->getKey() == "foto") {

                                $filex = new SplFileInfo($file->getName());

                                if ($filex->getExtension() == 'jpg') {
                                    $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $postulantes->codigo . '.jpg';
                                    $postulantes->foto = 'IMG' . '-' . $postulantes->codigo . ".jpg";

                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$postulantes->imagen = $postulantes->codigo . "-" . $file->getName();
                                        //$postulantes->imagen = 'IMG' . '-' . $postulantes->codigo . ".jpg";
                                    }
                                } elseif ($filex->getExtension() == 'png') {
                                    $url_destino = 'adminpanel/imagenes/publico/' . 'IMG' . '-' . $postulantes->codigo . '.png';
                                    $postulantes->foto = 'IMG' . '-' . $postulantes->codigo . ".png";

                                    if (!$file->moveTo($url_destino)) {
                                    } else {
                                        //$postulantes->imagen = $postulantes->codigo . "-" . $file->getName();
                                        //$postulantes->imagen = 'IMG' . '-' . $postulantes->codigo . ".jpg";
                                    }
                                }
                            }

                            //archivo
                        }

                        $postulantes->save();
                    }

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage() . " LINE :" . $ex->getLine());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }
    //--------------------------fin registro y save-----------------------------
    //-------------------------validacion---------------------------------------
    //validacion de nro_doc postulante y de publico
    public function postulanteRegistradoAction()
    {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $postulante = Publico::findFirstBynro_doc((string) $this->request->getPost("nro_doc", "string"));

            if ($postulante) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si"));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //valdia colegiado
    public function colegiadoRegistradoAction()
    {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $colegiado = Colegiados::findFirstBycodigo((int) $this->request->getPost("codigo", "int"));

            if ($colegiado) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si"));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //valiar email
    public function postulanteEmailRegistradoAction()
    {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $postulante = Publico::findFirstByemail((string) $this->request->getPost("pk_email", "string"));

            if ($postulante) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si"));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //valida email registrado colegiados
    public function colegiadoEmailRegistradoAction()
    {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $colegiado = Colegiados::findFirstByemail((string) $this->request->getPost("email", "string"));

            if ($colegiado) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "si"));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    //---------------------------validacion fin---------------------------------
    //recuperar clave colegiados
    //cerrar sesion
    public function endAction()
    {
        $this->session->remove('auth');

        return $this->response->redirect("login.html");
    }

    //recuperar contraseña login postulantes
    public function recuperarcontrasenhaweb5Action()
    {
        //recuperarcontrasenha3.js
        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenhaweb5.js?v=" . uniqid());
    }

    public function recuperarcontrasenhalogin5Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //recojemos el campo email del post
            $email = $this->request->getPost('email');

            //echo '<pre>';
            //print_r($email);
            //exit();
            //5 Publico y 6 Postulantes

            $publico = Publico::findFirst(
                [
                    "email = :email: AND estado = :estado: ",
                    'bind' => [
                        'email' => $email,
                        'estado' => "A",
                    ],
                ]
            );

            //Envio de mensaje
            if ($publico !== false) {

                $text = "" . $publico->codigo;
                $encrypt = base64_encode($text);
                //$encrypt = $text;

                $length = 7;
                $temporal_rand = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);

                $link = $this->url->getBaseUri() . "web/recuperarc5/" . $encrypt . $temporal_rand;

                //print $link."<br>";
                // print base64_decode($encrypt);
                // exit();

                $text_body = " Para recuperar su clave ingrese al siguiente enlace " . $link;

                $mailer = new mailer($this->di);
                $mailer->setSubject("Recuperar Clave " . $this->config->global->xAbrevIns);
                $mailer->setTo($email, $email);
                $mailer->setBody($text_body);
                if ($mailer->send()) {
                    //return true;
                } else {
                    echo $mailer->getError();
                    echo "error";
                }

                //$msg = "En enlace para recuperar su clava fue enviada a su correo " . $email . " , si "
                //        . "no encuentra el mensaje porfavor revise en la seccion 'SPAM o Correo No Deseado' ";
                $msg = "si";
            } else {
                //$msg = "No existe ningun Usuario registrado con este Email";
                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //recuperar contraseña login colegiados
    public function recuperarcontrasenhaweb6Action()
    {
        //recuperarcontrasenha3.js
        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenhaweb6.js?v=" . uniqid());
    }

    public function recuperarcontrasenhalogin6Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //recojemos el campo email del post
            $email = $this->request->getPost('email');

            //echo '<pre>';
            //print_r($email);
            //exit();
            //5 Publico y 6 Postulantes

            $colegiado = Colegiados::findFirst(
                [
                    "email = :email: AND estado = :estado: ",
                    'bind' => [
                        'email' => $email,
                        'estado' => "A",
                    ],
                ]
            );

            //Envio de mensaje
            if ($colegiado !== false) {

                $text = "" . $colegiado->nro_doc;
                $encrypt = base64_encode($text);
                //$encrypt = $text;

                $length = 7;
                $temporal_rand = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);

                $link = $this->url->getBaseUri() . "recuperarc6/" . $encrypt . $temporal_rand;
                //print $link."<br>";
                // print base64_decode($encrypt);
                // exit();
                $text_body = " Para recuperar su clave ingrese al siguiente enlace " . $link;

                $mailer = new mailer($this->di);
                $mailer->setSubject(" Recuperar Clave ({$this->config->global->xAbrevIns})");
                $mailer->setTo($email, $email);
                $mailer->setBody($text_body);
                if ($mailer->send()) {
                    //return true;
                } else {
                    echo $mailer->getError();
                    echo "error";
                }

                //$msg = "En enlace para recuperar su clava fue enviada a su correo " . $email . " , si "
                //        . "no encuentra el mensaje porfavor revise en la seccion 'SPAM o Correo No Deseado' ";
                $msg = "si";
            } else {
                //$msg = "No existe ningun Usuario registrado con este Email";
                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //-------------------------login.html---------------------------------------
    public function loginAction()
    {

        $this->assets->addJs("adminpanel/js/viewsweb/login.js?v=" . uniqid());
    }

    public function loginperfilesAction()
    {
        //$secret_key = $this->config->recaptchav3->XSecretKey;
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {


                if (1 == 1) {


                    $email = strtolower($this->request->getPost('email')) . $this->config->global->xEmailIns;
                    //Tipo de usuario
                    $tipousuario = $this->request->getPost('tipousuario', 'string');
                    //password
                    $password = $this->request->getPost('password');

                    if ($tipousuario == 1) {
                        $where = " estado = 'A' AND email1 = '" . $email . "'";
                        $user = Alumnos::findFirst($where);
                        $pass = $user->password;

                        /* Desencryptar */
                        if ($this->security->checkHash($password, $pass)) {
                            $this->session->set('auth', [
                                'codigo' => $user->codigo,
                                'nombres' => $user->nombres,
                                'email' => $user->email1,
                                'perfil' => 3,
                                'tipo' => 1,
                            ]);

                            $this->response->setStatusCode(200, "OK");
                            $this->response->setJsonContent(array("say" => "yes"));
                        } else {

                            $this->response->setStatusCode(200, "OK");
                            $this->response->setJsonContent(array("say" => "no"));
                        }
                    } else if ($tipousuario == 2) {
                        //login docentes
                        $where = " estado = 'A' AND email1 = '" . $email . "'";
                        $user = Docentes::findFirst($where);
                        $pass = $user->password;

                        /* Desencryptar */
                        if ($this->security->checkHash($password, $pass)) {
                            $this->session->set('auth', [
                                'codigo' => $user->codigo,
                                'nombres' => $user->nombres,
                                'full_name' => $user->apellidop . " " . $user->apellidom . " " . $user->nombres,
                                'perfil' => 4,
                                'tipo' => 2,
                            ]);

                            $this->response->setStatusCode(200, "OK");
                            $this->response->setJsonContent(array("say" => "yes"));
                        } else {

                            $this->response->setStatusCode(200, "OK");
                            $this->response->setJsonContent(array("say" => "no"));
                        }
                    } else {
                        $this->response->setJsonContent(array("say" => "no_existe"));
                    }
                    $this->response->send();
                    //echo '<pre>';
                    //print_r($user->password);
                    //exit();
                    //fin where
                } else {
                    //$this->session->set('robot_3', ['value' => 'si']);
                    //echo '<pre>';
                    //print_r('You are a Robot!!');
                    //exit();
                    //return $this->response->redirect("https://www.google.com/");
                }
            } else {

                //echo '<pre>';
                //print_r('Error usuario');
                //exit();
                $this->response->setStatusCode(404);
                //$this->response->setJsonContent(array("say" => "no_existe"));
                //$this->response->send();
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //recuperar contrseña
    public function recuperarcontrasenhawebAction()
    {

        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenhaweb.js?v=" . uniqid());
    }

    public function recuperarContrasenhaLoginAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //recojemos el campo email del post
            $email = strtolower($this->request->getPost('email')) . $this->config->global->xEmailIns;

            //Alumnos
            $alumno = Alumnos::findFirst(
                [
                    "email1 = :email1: AND estado = :estado: ",
                    'bind' => [
                        'email1' => $email,
                        'estado' => "A",
                    ],
                ]
            );

            //Docentes
            $docente = Docentes::findFirst(
                [
                    "email1 = :email1: AND estado = :estado: ",
                    'bind' => [
                        'email1' => $email,
                        'estado' => "A",
                    ],
                ]
            );

            //Envio de mensaje

            if ($alumno !== false) {

                $text = "" . $alumno->email1;
                $encrypt = base64_encode($text);

                $length = 7;
                $temporal_rand = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);

                $link = $this->url->getBaseUri() . "recuperarc1/" . $encrypt . $temporal_rand;
                //print $link."<br>";
                // print base64_decode($encrypt);
                // exit();
                $text_body = " Para recuperar su clave ingrese al siguiente enlace " . $link;

                $mailer = new mailer($this->di);
                $mailer->setSubject(" Recuperar Clave ({$this->config->global->xAbrevIns}) ");
                $mailer->setTo($email, $email);
                $mailer->setBody($text_body);
                if ($mailer->send()) {
                    //return true;
                } else {
                    echo $mailer->getError();
                    echo "error";
                }

                //$msg = "En enlace para recuperar su clava fue enviada a su correo " . $email . " , si "
                //        . "no encuentra el mensaje porfavor revise en la seccion 'SPAM o Correo No Deseado' ";
                $msg = "si";
            } elseif ($docente !== false) {

                $text = "" . $docente->email1;
                $encrypt = base64_encode($text);
                //$encrypt = $text;

                $length = 7;
                $temporal_rand = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);

                $link = $this->url->getBaseUri() . "recuperarc2/" . $encrypt . $temporal_rand;
                //print $link."<br>";
                // print base64_decode($encrypt);
                // exit();
                $text_body = " Para recuperar su clave ingrese al siguiente enlace " . $link;

                $mailer = new mailer($this->di);
                $mailer->setSubject(" Recuperar Clave ({$this->config->global->xAbrevIns})");
                $mailer->setTo($email, $email);
                $mailer->setBody($text_body);
                if ($mailer->send()) {
                    //return true;
                } else {
                    echo $mailer->getError();
                    echo "error";
                }

                //$msg = "En enlace para recuperar su clava fue enviada a su correo " . $email . " , si "
                //        . "no encuentra el mensaje porfavor revise en la seccion 'SPAM o Correo No Deseado' ";

                $msg = "si";
            } else {
                //$msg = "No existe ningun Usuario registrado con este Email";
                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //estudiante
    public function recuperarc1Action($secret_id)
    {

        $secret_id_0 = explode("=", $secret_id);
        $secret_id_nuevo = $secret_id_0[0];

        //print("Codigo Base64:".$secret_id_nuevo);
        //exit();
        //$personal_email1 = base64_decode($secret_id);

        $email1 = $secret_id_nuevo;
        $this->view->secret_id = $email1;

        //recuperarcontrasenha.js
        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenhalogin.js?v=" . uniqid());
    }

    public function recuperarc1enlaceAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //Capturamos la url encryptada
            $secret_id = $this->request->getPost('secret_id');
            $email = base64_decode($secret_id);

            $pass = $this->request->getPost('password');
            $pass_repeat = $this->request->getPost('password_repeat');

            if ($pass == $pass_repeat) {
                $alumno = Alumnos::findFirstByemail1($email);

                $pass_bcrypt = $this->request->getPost("password_repeat");
                $alumno->password = $this->security->hash($pass_bcrypt);

                if ($alumno->save() == false) {

                    $msg = "Error Al intentar Recuperar su contraseña";
                } else {
                    //$msg = "Su contraseña fue cambiada con éxito <br>"
                    //. ' <a class="btn btn-md btn-block u-btn-success g-py-13" href="' . $this->url->getBaseUri() . "web/sesiones" . '"  >Ir al Login</a> ';
                    $msg = "si";
                }
            } else {
                //$msg = "La contraseña enviada es distinta a la de confirmacion , intentelo uevamente";
                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //docente
    public function recuperarc2Action($secret_id)
    {

        $secret_id_0 = explode("=", $secret_id);
        $secret_id_nuevo = $secret_id_0[0];

        //print("Codigo Base64:".$secret_id_nuevo);
        //exit();
        //$personal_email1 = base64_decode($secret_id);

        $email1 = $secret_id_nuevo;
        $this->view->secret_id = $email1;

        //recuperarcontrasenha.js
        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenhalogin.js?v=" . uniqid());
    }

    public function recuperarc2enlaceAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //Capturamos la url encryptada
            $secret_id = $this->request->getPost('secret_id');
            $email = base64_decode($secret_id);

            $pass = $this->request->getPost('password');
            $pass_repeat = $this->request->getPost('password_repeat');

            if ($pass == $pass_repeat) {
                $docente = Docentes::findFirstByemail1($email);

                $pass_bcrypt = $this->request->getPost("password_repeat");
                $docente->password = $this->security->hash($pass_bcrypt);

                if ($docente->save() == false) {

                    $msg = "Error Al intentar Recuperar su contraseña";
                } else {
                    //$msg = "Su contraseña fue cambiada con éxito <br>"
                    //. ' <a class="btn btn-md btn-block u-btn-success g-py-13" href="' . $this->url->getBaseUri() . "web/sesiones" . '"  >Ir al Login</a> ';
                    $msg = "si";
                }
            } else {
                //$msg = "La contraseña enviada es distinta a la de confirmacion , intentelo uevamente";
                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //-----------------------------------fin login.html-------------------------
    //-----------------------login-interno.html---------------------------------
    public function login_internoAction()
    {
        //recaptchav3
        //$site_key = $this->config->recaptchav3->xWebsiteKey;
        //$site_key = $this->config->recaptchav3->xWebsiteKeyLocalhost;
        //$this->view->site_key = $site_key;
        //recaptchav3
        //$this->assets->addJs("https://www.google.com/recaptcha/api.js?render=" . $site_key);
        //$this->assets->addJs("adminpanel/js/viewsweb/login.interno.recaptchav3.js?v=" . uniqid());
        //login.html
        $this->assets->addJs("adminpanel/js/viewsweb/login.interno.js?v=" . uniqid());
    }

    public function loginInternoAction()
    {
        //$secret_key = $this->config->recaptchav3->XSecretKey;
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //echo '<pre>';
            //print_r($_POST);
            //exit();

            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                /*
                $SecretKey = $this->request->getPost('g-recaptcha-response', 'string');
                $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response={$SecretKey}");
                $Return = json_decode($Response);
                if ($Return->success == true && $Return->score > 0.5) { */
                if (1 == 1) {
                    //$this->session->set('robot_3', ['value' => 'no']);
                    //echo '<pre>';
                    //print_r('Succes');
                    //exit();
                    //where
                    //$nro_doc_login = $this->request->getPost('nro_doc_login', 'string');
                    //$password = $this->request->getPost('password_login', 'string');
                    //$email = strtolower($this->request->getPost('email')) . $this->config->global->xEmailIns;
                    //nro_doc
                    $nro_doc = $this->request->getPost('nro_doc', 'string');
                    //Tipo de usuario
                    $tipousuario = $this->request->getPost('tipousuario', 'string');
                    //password
                    $password = $this->request->getPost('password');

                    if ($tipousuario == 3) {
                        //login administrativos
                        $where = " estado = 'A' AND nro_doc = '{$nro_doc}'";
                        $user = Personal::findFirst($where);
                        $pass = $user->password;

                        //nombre del perfil
                        $nombre_perfil = 'ADMINISTRATIVOS';
                        $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                        $codigo_perfil = $Perfil->id;

                        /* Desencryptar */
                        if ($this->security->checkHash($password, $pass)) {
                            $this->session->set('auth', [
                                'codigo' => $user->codigo,
                                'nombres' => $user->nombres,
                                'nombre_perfil' => 'ADMINISTRATIVOS',
                                'perfil' => $codigo_perfil,
                                'nro_doc' => $user->nro_doc,
                                'tipo' => 3,

                            ]);


                            $this->response->setStatusCode(200, "OK");
                            $this->response->setJsonContent(array("msg" => "yes", "say" => "yes", "success" => true));
                        } else {

                            $this->response->setStatusCode(200, "OK");
                            $this->response->setJsonContent(array("msg" => "no", "say" => "no", "success" => false));
                        }
                    } else {
                        $this->response->setJsonContent(array("msg" => "no_existe", "say" => "no_existe", "success" => false));
                    }
                    $this->response->send();
                    //echo '<pre>';
                    //print_r($user->password);
                    //exit();
                    //fin where
                } else {
                    //$this->session->set('robot_3', ['value' => 'si']);
                    //echo '<pre>';
                    //print_r('You are a Robot!!');
                    //exit();
                    //return $this->response->redirect("https://www.google.com/");
                }
            } else {

                //echo '<pre>';
                //print_r('Error usuario');
                //exit();
                $this->response->setStatusCode(404);
                $this->response->setJsonContent(array("say" => "no_existe"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function recuperarcontrasenhawebinternoAction()
    {

        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenhawebinterno.js?v=" . uniqid());
    }

    public function recuperarContrasenhaInternoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //recojemos el campo email del post
            $email = strtolower($this->request->getPost('email'));

            //Personal
            $personal = Personal::findFirst(
                [
                    "email = :email: AND estado = :estado: ",
                    'bind' => [
                        'email' => $email,
                        'estado' => "A",
                    ],
                ]
            );

            //Envio de mensaje

            if ($personal !== false) {

                $text = "" . $personal->nro_doc;
                $encrypt = base64_encode($text);
                //$encrypt = $text;

                $length = 7;
                $temporal_rand = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);

                $link = $this->url->getBaseUri() . "recuperarc3/" . $encrypt . $temporal_rand;
                //print $link."<br>";
                // print base64_decode($encrypt);
                // exit();
                $from = $this->config->mail->from;
                $text_body = " Para recuperar su clave ingrese al siguiente enlace " . $link;

                $mailer = new mailer($this->di);
                $mailer->setSubject(" Recuperar Clave ({$this->config->global->xAbrevIns})");
                $mailer->setFrom($from);
                $mailer->setTo($email, $from);
                $mailer->setBody($text_body);
                if ($mailer->send()) {
                    $myfile = fopen("mail.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, $text_body);
                    fclose($myfile);
                } else {
                    echo $mailer->getError();
                    echo "error";
                    $myfile = fopen("mail.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, $mailer->getError());
                    fclose($myfile);
                }

                //$msg = "En enlace para recuperar su clava fue enviada a su correo " . $email . " , si "
                //        . "no encuentra el mensaje porfavor revise en la seccion 'SPAM o Correo No Deseado' ";

                $msg = "si";
            } else {
                //$msg = "No existe ningun Usuario registrado con este Email";
                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //personal
    public function recuperarc3Action($secret_id)
    {

        $secret_id_0 = explode("=", $secret_id);
        $secret_id_nuevo = $secret_id_0[0];

        //print("Codigo Base64:".$secret_id_nuevo);
        //exit();
        //$personal_email1 = base64_decode($secret_id);

        $email1 = $secret_id_nuevo;
        $this->view->secret_id = $email1;

        //recuperarcontrasenha.js
        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenhainterno.js?v=" . uniqid());
    }

    public function recuperarc3enlaceAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //Capturamos la url encryptada
            $secret_id = $this->request->getPost('secret_id');
            $nro_doc = base64_decode($secret_id);

            //print("NRO DOC:" . $nro_doc);
            //exit();

            $pass = $this->request->getPost('password');
            $pass_repeat = $this->request->getPost('password_repeat');

            if ($pass == $pass_repeat) {

                $personal = Personal::findFirstBynro_doc($nro_doc);

                //print("clave:".$personal->password);
                //exit();

                $pass_bcrypt = $this->request->getPost("password_repeat");
                $personal->password = $this->security->hash($pass_bcrypt);

                if ($personal->save() == false) {

                    $msg = "Error Al intentar Recuperar su contraseña";
                } else {
                    //$msg = "Su contraseña fue cambiada con éxito <br>"
                    //. ' <a class="btn btn-md btn-block u-btn-success g-py-13" href="' . $this->url->getBaseUri() . "web/sesiones" . '"  >Ir al Login</a> ';
                    $msg = "si";
                }
            } else {
                //$msg = "La contraseña enviada es distinta a la de confirmacion , intentelo uevamente";
                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //---------------------------fin login-interno.html-------------------------
    //---------------------------login-externo.html-----------------------------
    public function login_externoAction()
    {
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        //sexo(a_codigos)
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        //Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //modalidad
        $tipo_persona = TipoPersona::find("estado = 'A' AND numero = 2");
        $this->view->tipo_persona = $tipo_persona;

        $this->assets->addJs("adminpanel/js/viewsweb/login.externo.js?v=" . uniqid());
    }

    public function loginExternoAction()
    {
        //$secret_key = $this->config->recaptchav3->XSecretKey;
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                /*
                $SecretKey = $this->request->getPost('g-recaptcha-response', 'string');
                $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response={$SecretKey}");
                $Return = json_decode($Response);
                if ($Return->success == true && $Return->score > 0.5) { */
                if (1 == 1) {

                    //echo '<pre>';
                    //print_r($_POST);
                    //exit();
                    //Tipo de usuario
                    $tipousuario = $this->request->getPost('tipousuario', 'string');
                    //persona natural
                    $nro_doc = $this->request->getPost('nro_doc', 'string');
                    //persona juridica
                    $ruc = $this->request->getPost('ruc');

                    //password
                    $password = $this->request->getPost('password');

                    if ($tipousuario == 1) {
                        $where = " estado = 'A' AND nro_doc = '{$nro_doc}'";
                        $user = Publico::findFirst($where);
                        if ($user) {
                            $pass = $user->password;

                            //perfil
                            $nombre_perfil = 'PUBLICO';
                            $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                            $codigo_perfil = $Perfil->id;

                            /* Desencryptar */
                            if ($this->security->checkHash($password, $pass)) {
                                $this->session->set('auth', [
                                    'codigo' => $user->codigo,
                                    'nombres' => $user->nombres,
                                    'nombre_perfil' => $nombre_perfil,
                                    'perfil' => $codigo_perfil,
                                    'nro_doc' => $user->nro_doc,
                                    'nro_doc_remitente' => $user->nro_doc,
                                    'tipo' => 5,
                                ]);

                                $this->response->setStatusCode(200, "OK");
                                $this->response->setJsonContent(array("say" => "yes"));
                            } else {

                                $this->response->setStatusCode(200, "OK");
                                $this->response->setJsonContent(array("say" => "no"));
                            }
                        } else {

                            $this->response->setStatusCode(200, "OK");
                            $this->response->setJsonContent(array("say" => "no_existe"));
                        }
                    } else if ($tipousuario == 2) {

                        $where = " estado = 'A' AND ruc = '{$ruc}'";
                        $user = Empresas::findFirst($where);
                        if ($user) {

                            $pass = $user->password;

                            //print($pass);
                            //exit();

                            //perfil
                            $nombre_perfil = 'EMPRESAS';
                            $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                            $codigo_perfil = $Perfil->id;

                            /* Desencryptar */
                            if ($this->security->checkHash($password, $pass)) {
                                $this->session->set('auth', [
                                    'codigo' => $user->id_empresa,
                                    'nombres' => $user->razon_social,
                                    'ruc' => $user->ruc,
                                    'nro_doc_remitente' => $user->ruc,
                                    'nombre_perfil' => $nombre_perfil,
                                    'perfil' => $codigo_perfil,
                                    'tipo' => 4,
                                ]);

                                // print("Testing");
                                // exit();

                                $this->response->setStatusCode(200, "OK");
                                $this->response->setJsonContent(array("say" => "yes"));
                            } else {
                                $this->response->setJsonContent(array("say" => "no"));
                            }
                        } else {

                            $this->response->setStatusCode(200, "OK");
                            $this->response->setJsonContent(array("say" => "no_existe"));
                        }
                    }
                    $this->response->send();
                    //echo '<pre>';
                    //print_r($user->password);
                    //exit();
                    //fin where
                } else {
                    //$this->session->set('robot_3', ['value' => 'si']);
                    //echo '<pre>';
                    //print_r('You are a Robot!!');
                    //exit();
                    //return $this->response->redirect("https://www.google.com/");
                }
            } else {

                //echo '<pre>';
                //print_r('Error usuario');
                //exit();
                $this->response->setStatusCode(404);
                //$this->response->setJsonContent(array("say" => "no_existe"));
                //$this->response->send();
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function savePublicoLoginExternoAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //inicio
                //print_r($_POST);exit();
                $PublicoExterno = new PublicoExterno();

                $PublicoExterno->tipo = 1;
                $PublicoExterno->apellidop = strtoupper($this->request->getPost("apellidop"));
                $PublicoExterno->apellidom = strtoupper($this->request->getPost("apellidom"));
                $PublicoExterno->nombres = strtoupper($this->request->getPost("nombres"));
                $PublicoExterno->documento = $this->request->getPost("documento", "int");
                $PublicoExterno->nro_doc = $this->request->getPost("nro_doc_registro_publico", "string");
                $PublicoExterno->celular = $this->request->getPost("celular", "string");
                $PublicoExterno->email = $this->request->getPost("email_publico_registro", "string");
                $PublicoExterno->direccion = strtoupper($this->request->getPost("direccion", "string"));
                $PublicoExterno->sexo = $this->request->getPost("sexo", "int");

                $password_publico_externo = $this->request->getPost("password", "string");
                if ($password_publico_externo != "") {
                    $PublicoExterno->password = $this->security->hash($password_publico_externo);
                } else {
                    $PublicoExterno->password = '';
                }

                $PublicoExterno->estado = "A";
                $PublicoExterno->ciudad = strtoupper($this->request->getPost("ciudad", "string"));

                if ($PublicoExterno->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoExterno->getMessages());
                } else {
                    //Cuando va bien
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function publicoExternoNroDocAction()
    {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //echo '<pre>';
            //print_r($_POST);
            //exit();

            $PublicoExterno = PublicoExterno::findFirstBynro_doc((string) $this->request->getPost("nro_doc", "string"));

            if ($PublicoExterno) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "yes"));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function publicoExternoEmailAction()
    {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PublicoExterno = PublicoExterno::findFirstByemail((string) $this->request->getPost("email", "string"));

            if ($PublicoExterno) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "yes"));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function saveEmpresaLoginExternoAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $Empresas = new EmpresasExterno();
                $Empresas->razon_social = strtoupper($this->request->getPost("razon_social", "string"));
                $Empresas->ruc = $this->request->getPost("ruc", "string");
                $Empresas->rubro = $this->request->getPost("rubro", "string");
                $Empresas->telefono = $this->request->getPost("telefono", "string");
                $Empresas->direccion = $this->request->getPost("direccion", "string");
                $Empresas->email = $this->request->getPost("email_empresa_registro", "string");

                $password_empresa_externo = $this->request->getPost("password", "string");

                //print($password_empresa_externo);
                //exit();

                if ($password_empresa_externo !== "") {
                    $Empresas->password = $this->security->hash($password_empresa_externo);
                } else {
                    //print("@Kenmack");
                    //exit();
                    $Empresas->password = '';
                }

                $Empresas->representante = $this->request->getPost("representante", "string");
                $Empresas->estado = "A";

                //
                $Empresas->giro = $this->request->getPost("giro", "string");
                $Empresas->fecha_registro = date("Y-m-d H:i:s");
                $Empresas->cta_cte_detraccion = $this->request->getPost("cta_cte_detraccion", "string");
                $Empresas->cci = $this->request->getPost("cci", "string");
                $Empresas->cargo = $this->request->getPost("cargo", "string");
                $Empresas->nro_doc = $this->request->getPost("nro_doc", "string");
                $Empresas->fax = $this->request->getPost("fax", "string");
                $Empresas->celular = $this->request->getPost("celular", "string");
                $Empresas->pais = $this->request->getPost("pais", "string");
                $Empresas->region = $this->request->getPost("region", "string");
                $Empresas->provincia = $this->request->getPost("provincia", "string");
                $Empresas->distrito = $this->request->getPost("distrito", "string");
                $Empresas->ubigeo = $this->request->getPost("ubigeo", "string");
                $Empresas->referencia = $this->request->getPost("referencia", "string");

                if ($this->request->getPost("tipo", "int") == "") {
                    $Empresas->tipo = null;
                } else {
                    $Empresas->tipo = $this->request->getPost("tipo", "int");
                }

                $boleta = $this->request->getPost("boleta", "string");
                if (isset($boleta)) {
                    $Empresas->boleta = "1";
                } else {
                    $Empresas->boleta = "0";
                }

                $factura = $this->request->getPost("factura", "string");
                if (isset($factura)) {
                    $Empresas->factura = "1";
                } else {
                    $Empresas->factura = "0";
                }

                $rnp = $this->request->getPost("rnp", "string");
                if (isset($rnp)) {
                    $Empresas->rnp = "1";
                } else {
                    $Empresas->rnp = "0";
                }

                $mype = $this->request->getPost("mype", "string");
                if (isset($mype)) {
                    $Empresas->mype = "1";
                } else {
                    $Empresas->mype = "0";
                }

                $entidad_publica = $this->request->getPost("entidad_publica", "string");
                if (isset($entidad_publica)) {
                    $Empresas->entidad_publica = "1";
                } else {
                    $Empresas->entidad_publica = "0";
                }

                //archivo_ruc
                $archivo_ruc = $_FILES['archivo_ruc']['name'];
                if ($archivo_ruc !== "") {
                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');
                    $file_archivo = $_FILES['archivo_ruc']['name'];
                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                    if (in_array($extension, $formatos_archivo)) {
                        //$id_empresa = EmpresasExterno::count();
                        $Empresas->archivo_ruc = "archivo_ruc." . $extension;
                    } else {
                        $this->response->setJsonContent(array("say" => "error_archivo_ruc"));
                        $this->response->send();
                        exit();
                    }
                }

                //archivo_rnp
                $archivo_rnp = $_FILES['archivo_rnp']['name'];
                if ($archivo_rnp !== "") {

                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');
                    $file_archivo = $_FILES['archivo_rnp']['name'];
                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                    if (in_array($extension, $formatos_archivo)) {
                        //$id_empresa = EmpresasExterno::count();
                        $Empresas->archivo_rnp = "archivo_rnp." . $extension;
                    } else {
                        $this->response->setJsonContent(array("say" => "error_archivo_rnp"));
                        $this->response->send();
                        exit();
                    }
                }
                //

                if ($Empresas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Empresas->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo_ruc
                            if ($file->getKey() == "archivo_ruc") {

                                if ($_FILES['archivo_ruc']['name'] !== "") {
                                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_ruc']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Empresas->archivo_ruc)) {
                                            $url_destino = 'adminpanel/archivos/empresas/' . $Empresas->archivo_ruc;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                            $Empresas->archivo_ruc = 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                            $Empresas->archivo_ruc = 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_ruc"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo_rnp
                            if ($file->getKey() == "archivo_rnp") {

                                if ($_FILES['archivo_rnp']['name'] !== "") {
                                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_rnp']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Empresas->archivo_rnp)) {
                                            $url_destino = 'adminpanel/archivos/empresas/' . $Empresas->archivo_rnp;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                            $Empresas->archivo_rnp = 'FILE' . '-' . $Empresas->id_empresa . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                            $Empresas->archivo_rnp = 'FILE' . '-' . $Empresas->id_empresa . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_rnp"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $Empresas->save();
                    }
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function empresaExternoRucAction()
    {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $EmpresasExterno = EmpresasExterno::findFirstByruc((string) $this->request->getPost("ruc", "string"));

            if ($EmpresasExterno) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "yes"));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function empresaExternoEmailAction()
    {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $EmpresasExterno = EmpresasExterno::findFirstByemail((string) $this->request->getPost("email", "string"));

            if ($EmpresasExterno) {
                //$this->response->setJsonContent($AlumnosEncuestas->toArray());
                $this->response->setJsonContent(array("say" => "yes"));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function recuperarcontrasenhawebexternoAction()
    {

        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenhawebexterno.js?v=" . uniqid());
    }

    public function recuperarcontrasenhawebexterno2Action()
    {

        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenhawebexterno2.js?v=" . uniqid());
    }

    public function recuperarContrasenhaExternoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //recojemos el campo email del post
            $email = $this->request->getPost('email');

            //Publico
            $publico = Publico::findFirst(
                [
                    "email = :email: AND estado = :estado: ",
                    'bind' => [
                        'email' => $email,
                        'estado' => "A",
                    ],
                ]
            );

            if ($publico !== false) {

                // print("Llega cuando es publico");
                // exit();

                $text = "" . $publico->nro_doc;
                $encrypt = base64_encode($text);
                //$encrypt = $text;
                //$temporal_rand = mt_rand(1000000, 9999999);

                $length = 16;
                $temporal_rand = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);

                $link = $this->url->getBaseUri() . "recuperarc5/" . $encrypt . "=" . $temporal_rand;
                // print $link."<br>";
                // print base64_decode($encrypt);
                // exit();
                $from = $this->config->mail->from;
                $text_body = " Para recuperar su clave ingrese al siguiente enlace " . $link;

                $mailer = new mailer($this->di);
                $mailer->setSubject(" Recuperar Clave ({$this->config->global->xAbrevIns})");
                $mailer->setFrom($from);
                $mailer->setTo($email, $from);
                $mailer->setBody($text_body);
                if ($mailer->send()) {
                    //return true;
                } else {
                    echo $mailer->getError();
                    echo "error";
                }

                //$msg = "En enlace para recuperar su clava fue enviada a su correo " . $email . " , si "
                //        . "no encuentra el mensaje porfavor revise en la seccion 'SPAM o Correo No Deseado' ";
                $msg = "si";
            } else {
                //$msg = "No existe ningun Usuario registrado con este Email";
                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function recuperarc4Action($secret_id)
    {

        $secret_id_0 = explode("=", $secret_id);
        $secret_id_nuevo = $secret_id_0[0];

        //print("Codigo Base64:" . $secret_id_nuevo);
        //exit();

        //$personal_email1 = base64_decode($secret_id);

        $ruc = $secret_id_nuevo;
        $this->view->secret_id = $ruc;

        //recuperarcontrasenha.js
        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenhaexterno.js?v=" . uniqid());
    }

    public function recuperarc4enlaceAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            //Capturamos la url encryptada
            $secret_id = $this->request->getPost('secret_id');
            $ruc = base64_decode($secret_id);

            $pass = $this->request->getPost('password');
            $pass_repeat = $this->request->getPost('password_repeat');

            if ($pass == $pass_repeat) {
                $Empresas = Empresas::findFirstByruc($ruc);

                $pass_bcrypt = $this->request->getPost("password_repeat");
                $Empresas->password = $this->security->hash($pass_bcrypt);

                if ($Empresas->save() == false) {

                    $msg = "Error Al intentar Recuperar su contraseña";
                } else {
                    //$msg = "Su contraseña fue cambiada con éxito <br>"
                    //. ' <a class="btn btn-md btn-block u-btn-success g-py-13" href="' . $this->url->getBaseUri() . "web/sesiones" . '"  >Ir al Login</a> ';
                    $msg = "si";
                }
            } else {
                //$msg = "La contraseña enviada es distinta a la de confirmacion , intentelo uevamente";
                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function recuperarc5Action($secret_id)
    {

        //echo"<pre>";        print_r("Entro");exit();
        //date_default_timezone_set('America/Lima');
        //echo date("H:m:s");exit();
        //print("Codigo Base64:".$secret_id);
        //exit();

        $secret_id_0 = explode("=", $secret_id);
        $secret_id_nuevo = $secret_id_0[0];

        //print("Codigo Base64:".$secret_id_nuevo);
        //exit();
        //$personal_email1 = base64_decode($secret_id);

        $nro_doc = $secret_id_nuevo;
        $this->view->secret_id = $nro_doc;

        //recuperarcontrasenha.js
        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenha5.js?v=" . uniqid());
    }

    public function recuperarc5enlaceAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            //Capturamos la url encryptada
            $secret_id = $this->request->getPost('secret_id');
            $nroDOc = base64_decode($secret_id);

            // print($nroDOc);
            // exit();

            $pass = $this->request->getPost('password');
            $pass_repeat = $this->request->getPost('password_repeat');

            if ($pass == $pass_repeat) {
                $Publico = Ciudadano::findFirstBynro_doc($nroDOc);

                $pass_bcrypt = $this->request->getPost("password_repeat");
                $Publico->password = $this->security->hash($pass_bcrypt);

                //print($Publico->password);
                //exit();

                if ($Publico->save() == false) {

                    //                    print("@Kenmack");
                    //                    exit();

                    $msg = "Error Al intentar Recuperar su contraseña";
                } else {
                    //$msg = "Su contraseña fue cambiada con éxito <br>"
                    //. ' <a class="btn btn-md btn-block u-btn-success g-py-13" href="' . $this->url->getBaseUri() . "web/sesiones" . '"  >Ir al Login</a> ';
                    $msg = "si";
                }
            } else {
                //$msg = "La contraseña enviada es distinta a la de confirmacion , intentelo uevamente";
                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //---------------------------fin login-externo.html-------------------------
    //---------------------------login-admision---------------------------------
    public function login_admisionAction()
    {

        //recaptchav3
        //$site_key = $this->config->recaptchav3->xWebsiteKey;
        //$site_key = $this->config->recaptchav3->xWebsiteKeyLocalhost;
        //$this->view->site_key = $site_key;
        //$secret_key = $this->config->recaptchav3->XSecretKey;
        //$secret_key = $this->config->recaptchav3->XSecretKeyLocalhost;
        //$this->view->secret_key = $secret_key;
        //tipo de documentos(a_codigos)
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        //sexo(a_codigos)
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        $postulante = Publico::count();
        $nuevo_postulante = $postulante + 1;
        //echo '<pre>';
        //print_r($nuevo_postulante);
        //exit();
        $this->view->codigo_nuevo_postulante = $nuevo_postulante;

        //Modelo seguro(a_codigos)
        $seguros = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguro = $seguros;

        //Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //login.postulantes.registro.js
        $this->assets->addJs("adminpanel/js/viewsweb/login.postulantes.registro.js?v=" . uniqid());

        //recaptchav3
        //$this->assets->addJs("https://www.google.com/recaptcha/api.js?render=" . $site_key);
        //$this->assets->addJs("adminpanel/js/viewsweb/login.postulantes.recaptchav3.js?v=" . uniqid());
    }

    //login postulantes
    public function loginAdmisionAction()
    {

        //echo '<pre>';
        //print_r('Testing');
        //exit();
        //$secret_key = $this->config->recaptchav3->XSecretKey;
        //$secret_key = $this->config->recaptchav3->XSecretKeyLocalhost;
        //$this->view->secret_key = $secret_key;

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                /*
                $SecretKey = $this->request->getPost('g-recaptcha-response', 'string');
                $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response={$SecretKey}");
                $Return = json_decode($Response);
                if ($Return->success == true && $Return->score > 0.5) { */
                if (1 == 1) {

                    // echo '<pre>';
                    // print_r($_POST);
                    // exit();
                    //where
                    $nro_doc_login = $this->request->getPost('nro_doc_login', 'string');
                    $password = $this->request->getPost('password_login', 'string');

                    $where = " estado = 'A' AND nro_doc = '{$nro_doc_login}'";
                    $user = Publico::findFirst($where);

                    // print("id_publico: ".$user->codigo);
                    // exit();

                    if ($user) {
                        // echo '<pre>';
                        // print_r($user->nombres);
                        // exit();
                        //$this->response->setJsonContent($user->toArray());
                        //$this->response->send();

                        $pass = $user->password;
                        /* Desencryptar */
                        if ($this->security->checkHash($password, $pass)) {
                            $this->session->set('auth', [
                                'codigo' => $user->codigo,
                                'nombres' => $user->nombres,
                                'perfil' => 21,
                                'tipo' => 5,
                            ]);

                            $this->response->setStatusCode(200, "OK");
                            $this->response->setJsonContent(array("say" => "yes"));
                        } else {

                            $this->response->setStatusCode(200, "OK");
                            $this->response->setJsonContent(array("say" => "no"));
                        }
                        $this->response->send();
                    } else {
                        //echo '<pre>';
                        //print_r('No existe');
                        //exit();
                        $this->response->setJsonContent(array("say" => "no_existe"));
                        $this->response->send();
                        //$this->response->setContent("No existe registro");
                        //$this->response->setStatusCode(500);
                    }

                    //echo '<pre>';
                    //print_r($user->password);
                    //exit();
                    //fin where
                } else {
                    //$this->session->set('robot_3', ['value' => 'si']);
                    //echo '<pre>';
                    //print_r('You are a Robot!!');
                    //exit();
                    //return $this->response->redirect("https://www.google.com/");
                }
            } else {

                //echo '<pre>';
                //print_r('Error usuario');
                //exit();
                $this->response->setStatusCode(404);
                //$this->response->setJsonContent(array("say" => "no_existe"));
                //$this->response->send();
            }
        } else {
            $this->response->setStatusCode(404);
        }

        //recaptchav3
        //$this->assets->addJs("https://www.google.com/recaptcha/api.js?render=" . $site_key);
        //$this->assets->addJs("adminpanel/js/viewsweb/login.postulantes.recaptchav3.js?v=" . uniqid());
    }

    //--------------------------fin login-admision------------------------------
    //--------------------------------login-colegiados--------------------------
    public function login_colegiadosAction()
    {
        //tipo de documentos(a_codigos)
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        //sexo(a_codigos)
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        $colegiado = Colegiados::count();
        $nuevo_colegiado = $colegiado + 1;
        //echo '<pre>';
        //print_r($nuevo_postulante);
        //exit();
        $this->view->codigo_nuevo_colegiado = $nuevo_colegiado;

        //Modelo seguro(a_codigos)
        $seguros = Seguro::find("estado = 'A' AND numero = 4");
        $this->view->seguro = $seguros;

        //Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //Modelo Consejos (consejos)
        $consejo = Consejos::find("estado = 'A' ORDER BY codigo");
        $this->view->consejos = $consejo;

        //Modelo Capitulos (capitulos)
        $capitulo = Capitulos::find("estado = 'A'");
        $this->view->capitulos = $capitulo;

        //login.colegiados.js
        $this->assets->addJs("adminpanel/js/viewsweb/login.colegiados.js?v=" . uniqid());
    }

    public function logincolegiadosAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                $codigo_login = $this->request->getPost('codigo_login', 'string');
                $password = $this->request->getPost('password_login', 'string');

                //$where = " estado = 'X' AND email = '" . $email_login . "'";
                $where = " estado = 'A' AND codigo = $codigo_login";
                $user = Colegiados::findFirst($where);

                if ($user) {
                    $pass = $user->password;
                    if ($this->security->checkHash($password, $pass)) {
                        $this->session->set('auth', [
                            'codigo' => $user->codigo,
                            'nombres' => $user->nombres,
                            'perfil' => 22,
                        ]);

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "yes"));
                    } else {

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "no"));
                    }
                    $this->response->send();
                } else {
                    $this->response->setJsonContent(array("say" => "no_existe"));
                    $this->response->send();
                }
            } else {

                //echo '<pre>';
                //print_r('Error usuario');
                //exit();
                //$this->response->setStatusCode(404);
                $this->response->setJsonContent(array("say" => "error_csrf"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function recuperarc6Action($secret_id)
    {

        $secret_id_0 = explode("=", $secret_id);
        $secret_id_nuevo = $secret_id_0[0];

        //print("Codigo Base64:".$secret_id_nuevo);
        //exit();
        //$personal_email1 = base64_decode($secret_id);

        $nro_documento = $secret_id_nuevo;
        $this->view->secret_id = $nro_documento;

        //recuperarcontrasenha.js
        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenha6.js?v=" . uniqid());
    }

    public function recuperarc6enlaceAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //Capturamos la url encryptada
            $secret_id = $this->request->getPost('secret_id');
            $nro_documento = base64_decode($secret_id);

            $pass = $this->request->getPost('password');
            $pass_repeat = $this->request->getPost('password_repeat');

            if ($pass == $pass_repeat) {

                //print($nro_documento);
                //exit();

                $colegiados = Colegiados::findFirstBynro_doc($nro_documento);

                $pass_bcrypt = $this->request->getPost("password_repeat");
                $colegiados->password = $this->security->hash($pass_bcrypt);

                if ($colegiados->save() == false) {

                    print("Error");
                    exit();

                    $msg = "Error Al intentar Recuperar su contraseña";
                } else {
                    //$msg = "Su contraseña fue cambiada con éxito <br>"
                    //. ' <a class="btn btn-md btn-block u-btn-success g-py-13" href="' . $this->url->getBaseUri() . "web/sesiones" . '"  >Ir al Login</a> ';
                    $msg = "si";
                }
            } else {
                //$msg = "La contraseña enviada es distinta a la de confirmacion , intentelo uevamente";
                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //----------------------------------fin login-colegiados--------------------
    //----------------------------------login-convocatorias---------------------
    public function login_convocatoriasAction()
    {
        //recaptchav3
        //$site_key = $this->config->recaptchav3->xWebsiteKey;
        //$site_key = $this->config->recaptchav3->xWebsiteKeyLocalhost;
        //$this->view->site_key = $site_key;
        //$secret_key = $this->config->recaptchav3->XSecretKey;
        //$secret_key = $this->config->recaptchav3->XSecretKeyLocalhost;
        //$this->view->secret_key = $secret_key;
        //tipo de documentos(a_codigos)
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        //        $postulante = Publico::count();
        //        $nuevo_postulante = $postulante + 1;
        //$this->view->codigo_nuevo_publico = $nuevo_postulante;
        //colegio_profesional
        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85 ORDER BY orden");
        $this->view->colegioprofesional = $ColegioProfesional;

        //estado_civil
        $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
        $this->view->estadocivil = $estado_civil;

        //sexo(a_codigos)
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        //Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //login.postulantes.registro.js
        $this->assets->addJs("adminpanel/js/viewsweb/login.publico.convocatorias.js?v=" . uniqid());

        //recaptchav3
        //$this->assets->addJs("https://www.google.com/recaptcha/api.js?render=" . $site_key);
        //$this->assets->addJs("adminpanel/js/viewsweb/login.publico.convocatorias.recaptchav3.js?v=" . uniqid());
    }

    public function loginConvocatoriasAction()
    {

        //echo '<pre>';
        //print_r('Testing');
        //exit();
        //$secret_key = $this->config->recaptchav3->XSecretKey;
        //$secret_key = $this->config->recaptchav3->XSecretKeyLocalhost;
        //$this->view->secret_key = $secret_key;

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                /*
                $SecretKey = $this->request->getPost('g-recaptcha-response', 'string');
                $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response={$SecretKey}");
                $Return = json_decode($Response);
                if ($Return->success == true && $Return->score > 0.5) { */
                if (1 == 1) {
                    //$this->session->set('robot_3', ['value' => 'no']);
                    //echo '<pre>';
                    //print_r('Succes');
                    //exit();
                    //where
                    $nro_doc_login = $this->request->getPost('nro_doc_login', 'string');
                    $password = $this->request->getPost('password_login', 'string');

                    $where = " estado = 'A' AND nro_doc = '" . $nro_doc_login . "'";
                    $user = Publico::findFirst($where);

                    //print("Valor del estado ConvocatoriasPublico:" . $ConvocatoriasPublico->estado);
                    //exit();
                    //user inicio
                    if ($user) {
                        //echo '<pre>';
                        //print_r('Si existe');
                        //exit();
                        //$this->response->setJsonContent($user->toArray());
                        //$this->response->send();

                        $pass = $user->password;
                        /* Desencryptar */
                        $nombre_perfil = 'PUBLICO CONVOCATORIAS';
                        $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                        $codigo_perfil = $Perfil->id;
                     
                        if ($this->security->checkHash($password, $pass)) {

                            $this->session->set('auth', [
                                'codigo' => $user->codigo,
                                'nombres' => $user->nombres,
                                'nombre_perfil' => 'PUBLICO CONVOCATORIAS',
                                'perfil' => $codigo_perfil,
                                'nro_doc' => $user->nro_doc,
                                'tipo' => 5,
                            ]);

                            $ConvocatoriasPublico = ConvocatoriasPublico::findFirst("estado ='1' AND publico = {$user->codigo}");

                            if ($ConvocatoriasPublico) {
                                $this->response->setStatusCode(200, "OK");
                                $this->response->setJsonContent(array("msg" => "yes", "say" => "evaluado", "success" => true));
                            } else {

                                $this->response->setStatusCode(200, "OK");
                                $this->response->setJsonContent(array("msg" => "yes", "say" => "yes", "success" => true));
                            }
                        } else {

                            $this->response->setStatusCode(200, "OK");
                            $this->response->setJsonContent(array("msg" => "no", "say" => "no", "success" => false));
                        }
                        $this->response->send();
                    } else {
                        //echo '<pre>';
                        //print_r('No existe');
                        //exit();
                        $this->response->setJsonContent(array("msg" => "no_existe", "say" => "no_existe", "success" => false));

                        $this->response->send();
                        //$this->response->setContent("No existe registro");
                        //$this->response->setStatusCode(500);
                    }
                    //fin
                    //echo '<pre>';
                    //print_r($user->password);
                    //exit();
                    //fin where
                } else {
                    //$this->session->set('robot_3', ['value' => 'si']);
                    //echo '<pre>';
                    //print_r('You are a Robot!!');
                    //exit();
                    //return $this->response->redirect("https://www.google.com/");
                }
            } else {

                //echo '<pre>';
                //print_r('Error usuario');
                //exit();
                $this->response->setStatusCode(404);
                //$this->response->setJsonContent(array("say" => "no_existe"));
                //$this->response->send();
            }
        } else {
            $this->response->setStatusCode(404);
        }

        //recaptchav3
        //$this->assets->addJs("https://www.google.com/recaptcha/api.js?render=" . $site_key);
        //$this->assets->addJs("adminpanel/js/viewsweb/login.postulantes.recaptchav3.js?v=" . uniqid());
    }

    //
    public function savePublicoConvocatoriasAction()
    {

        //    echo "<pre>";
        //    print_r($_POST);
        //    exit();

        // echo "<pre>";
        // print_r($_FILES);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //inicio
                //print_r($_POST);exit();
                $PublicoConvocatorias = new PublicoConvocatorias();

                $PublicoConvocatorias->tipo = 4;
                $PublicoConvocatorias->apellidop = strtoupper($this->request->getPost("apellidop"));
                $PublicoConvocatorias->apellidom = strtoupper($this->request->getPost("apellidom"));
                $PublicoConvocatorias->nombres = strtoupper($this->request->getPost("nombres"));

                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $PublicoConvocatorias->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                $PublicoConvocatorias->documento = $this->request->getPost("documento", "int");
                $PublicoConvocatorias->nro_doc = $this->request->getPost("nro_doc", "string");
                $PublicoConvocatorias->nro_ruc = $this->request->getPost("nro_ruc", "string");
                $PublicoConvocatorias->celular = $this->request->getPost("celular", "string");
                $PublicoConvocatorias->email = $this->request->getPost("email", "string");
                $PublicoConvocatorias->direccion = strtoupper($this->request->getPost("direccion", "string"));

                $discapacitado = $this->request->getPost("discapacitado", "string");
                if (isset($discapacitado)) {

                    $PublicoConvocatorias->discapacitado = 1;
                } else {

                    $PublicoConvocatorias->discapacitado = 0;
                }

                $PublicoConvocatorias->discapacitado_nombre = strtoupper($this->request->getPost("discapacitado_nombre", "string"));

                //$PublicoConvocatorias->password = $this->request->getPost("password", "string");

                
                if ($this->request->getPost("colegio_profesional", "int") == "") {
                    $PublicoConvocatorias->colegio_profesional = null;
                } else {
                    $PublicoConvocatorias->colegio_profesional = $this->request->getPost("colegio_profesional", "int");
                }
                
                $PublicoConvocatorias->colegio_profesional_nro = $this->request->getPost("colegio_profesional_nro", "string");


                $passwordPostulante = $this->request->getPost("password", "string");
                if ($passwordPostulante === "") {
                    $this->response->setJsonContent(array("say" => "password_vacio"));
                    $this->response->send();
                    exit();
                } else {
                    $PublicoConvocatorias->password = $this->security->hash($passwordPostulante);
                }

                $PublicoConvocatorias->estado = "A";

                $PublicoConvocatorias->sexo = $this->request->getPost("sexo", "int");
                $PublicoConvocatorias->estado_civil = $this->request->getPost("estado_civil", "int");
                $PublicoConvocatorias->ciudad = strtoupper($this->request->getPost("ciudad", "string"));

                $PublicoConvocatorias->region = $this->request->getPost("region", "string");
                $PublicoConvocatorias->provincia = $this->request->getPost("provincia", "string");
                $PublicoConvocatorias->distrito = $this->request->getPost("distrito", "string");
                $PublicoConvocatorias->ubigeo = $this->request->getPost("ubigeo", "string");

                $PublicoConvocatorias->seguro = 9;
                $PublicoConvocatorias->nacionalidad = $this->request->getPost("nacionalidad", "string");

                if ($this->request->getPost("id_bonificacion", "int") == "") {
                    $PublicoConvocatorias->id_bonificacion = null;
                } else {
                    $PublicoConvocatorias->id_bonificacion = $this->request->getPost("id_bonificacion", "int");
                }


                if ($PublicoConvocatorias->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoConvocatorias->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {


                            if ($file->getKey() == "archivo_discapacitado") {

                                if ($_FILES['archivo_discapacitado']['name'] !== "") {
                                    $formatos_archivo = array('PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_discapacitado']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-DISCAPACITADO' . '-' . $PublicoConvocatorias->codigo . "." . $extension;
                                        $PublicoConvocatorias->archivo_discapacitado = 'FILE-DISCAPACITADO' . '-' . $PublicoConvocatorias->codigo . "." . $extension;

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_discapacitado"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "archivo_dar") {

                                if ($_FILES['archivo_dar']['name'] !== "") {
                                    $formatos_archivo = array('PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_dar']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-DAR' . '-' . $PublicoConvocatorias->codigo . "." . $extension;
                                        $PublicoConvocatorias->archivo_dar = 'FILE-DAR' . '-' . $PublicoConvocatorias->codigo . "." . $extension;

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_dar"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "archivo_fa") {

                                if ($_FILES['archivo_fa']['name'] !== "") {
                                    $formatos_archivo = array('PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_fa']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-FA' . '-' . $PublicoConvocatorias->codigo . "." . $extension;
                                        $PublicoConvocatorias->archivo_fa = 'FILE-FA' . '-' . $PublicoConvocatorias->codigo . "." . $extension;

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_fa"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "archivo_renacyt") {

                                if ($_FILES['archivo_renacyt']['name'] !== "") {
                                    $formatos_archivo = array('PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_renacyt']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-RENACYT' . '-' . $PublicoConvocatorias->codigo . "." . $extension;
                                        $PublicoConvocatorias->archivo_renacyt = 'FILE-RENACYT' . '-' . $PublicoConvocatorias->codigo . "." . $extension;

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_renacyt"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $PublicoConvocatorias->save();
                    }
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    //----------------------------------login-voluntariado----------------------
    public function login_voluntariadoAction()
    {
        //recaptchav3
        $site_key = $this->config->recaptchav3->xWebsiteKey;
        //$site_key = $this->config->recaptchav3->xWebsiteKeyLocalhost;
        $this->view->site_key = $site_key;

        //$secret_key = $this->config->recaptchav3->XSecretKey;
        //$secret_key = $this->config->recaptchav3->XSecretKeyLocalhost;
        //$this->view->secret_key = $secret_key;
        //tipo de documentos(a_codigos)
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        $postulante = Publico::count();
        $nuevo_postulante = $postulante + 1;
        //        echo '<pre>';
        //        print_r($nuevo_postulante);
        //        exit();
        $this->view->codigo_nuevo_publico = $nuevo_postulante;

        //colegio_profesional
        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85");
        $this->view->colegioprofesional = $ColegioProfesional;

        //estado_civil
        $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
        $this->view->estadocivil = $estado_civil;

        //sexo(a_codigos)
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        //Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //login.postulantes.registro.js
        $this->assets->addJs("adminpanel/js/viewsweb/login.publico.voluntariado.js?v=" . uniqid());

        //recaptchav3
        $this->assets->addJs("https://www.google.com/recaptcha/api.js?render=" . $site_key);
        $this->assets->addJs("adminpanel/js/viewsweb/login.publico.voluntariado.recaptchav3.js?v=" . uniqid());
    }

    public function loginVoluntariadoAction()
    {

        //echo '<pre>';
        //print_r('Testing');
        //exit();

        $secret_key = $this->config->recaptchav3->XSecretKey;
        //$secret_key = $this->config->recaptchav3->XSecretKeyLocalhost;
        //$this->view->secret_key = $secret_key;

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                //
                $SecretKey = $this->request->getPost('g-recaptcha-response', 'string');

                $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response={$SecretKey}");
                $Return = json_decode($Response);

                if ($Return->success == true && $Return->score > 0.5) {

                    //$this->session->set('robot_3', ['value' => 'no']);
                    //echo '<pre>';
                    //print_r('Succes');
                    //exit();
                    //where
                    $nro_doc_login = $this->request->getPost('nro_doc_login', 'string');
                    $password = $this->request->getPost('password_login', 'string');

                    $where = " estado = 'A' AND nro_doc = '" . $nro_doc_login . "'";
                    $user = Publico::findFirst($where);

                    if ($user) {
                        //echo '<pre>';
                        //print_r('Si existe');
                        //exit();
                        //$this->response->setJsonContent($user->toArray());
                        //$this->response->send();

                        $pass = $user->password;
                        /* Desencryptar */
                        $nombre_perfil = 'PUBLICO VOLUNTARIADO';
                        $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                        $codigo_perfil = $Perfil->id;

                        if ($this->security->checkHash($password, $pass)) {
                            $this->session->set('auth', [
                                'codigo' => $user->codigo,
                                'nombres' => $user->nombres,
                                'nombre_perfil' => 'PUBLICO VOLUNTARIADO',
                                'perfil' => $codigo_perfil,
                                'nro_doc' => $user->nro_doc,
                                'tipo' => 5,
                            ]);

                            $this->response->setStatusCode(200, "OK");
                            $this->response->setJsonContent(array("say" => "yes"));
                        } else {

                            $this->response->setStatusCode(200, "OK");
                            $this->response->setJsonContent(array("say" => "no"));
                        }
                        $this->response->send();
                    } else {
                        //echo '<pre>';
                        //print_r('No existe');
                        //exit();
                        $this->response->setJsonContent(array("say" => "no_existe"));
                        $this->response->send();
                        //$this->response->setContent("No existe registro");
                        //$this->response->setStatusCode(500);
                    }

                    //echo '<pre>';
                    //print_r($user->password);
                    //exit();
                    //fin where
                } else {
                    //$this->session->set('robot_3', ['value' => 'si']);
                    //echo '<pre>';
                    //print_r('You are a Robot!!');
                    //exit();
                    return $this->response->redirect("https://www.google.com/");
                }
            } else {

                //echo '<pre>';
                //print_r('Error usuario');
                //exit();
                $this->response->setStatusCode(404);
                //$this->response->setJsonContent(array("say" => "no_existe"));
                //$this->response->send();
            }
        } else {
            $this->response->setStatusCode(404);
        }

        //recaptchav3
        //$this->assets->addJs("https://www.google.com/recaptcha/api.js?render=" . $site_key);
        //$this->assets->addJs("adminpanel/js/viewsweb/login.postulantes.recaptchav3.js?v=" . uniqid());
    }

    public function savePublicoVoluntariadoAction()
    {

        //        echo "<pre>";
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //inicio
                //print_r($_POST);exit();
                $PublicoVoluntariado = new PublicoVoluntariado();
                $PublicoVoluntariado->codigo = $this->request->getPost("codigo");
                $PublicoVoluntariado->tipo = 3;
                $PublicoVoluntariado->apellidop = strtoupper($this->request->getPost("apellidop"));
                $PublicoVoluntariado->apellidom = strtoupper($this->request->getPost("apellidom"));
                $PublicoVoluntariado->nombres = strtoupper($this->request->getPost("nombres"));

                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $PublicoVoluntariado->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                $PublicoVoluntariado->documento = $this->request->getPost("documento", "int");
                $PublicoVoluntariado->nro_doc = $this->request->getPost("nro_doc", "string");
                $PublicoVoluntariado->celular = $this->request->getPost("celular", "string");
                $PublicoVoluntariado->email = $this->request->getPost("email", "string");
                $PublicoVoluntariado->direccion = strtoupper($this->request->getPost("direccion", "string"));

                $voluntariado = $this->request->getPost("voluntariado", "string");
                if (isset($voluntariado)) {

                    $PublicoVoluntariado->voluntariado = 1;
                } else {

                    $PublicoVoluntariado->voluntariado = "";
                }

                //$PublicoVoluntariado->password = $this->request->getPost("password", "string");

                $password_postulantes = $this->request->getPost("password", "string");
                $PublicoVoluntariado->password = $this->security->hash($password_postulantes);

                $PublicoVoluntariado->estado = "A";

                $PublicoVoluntariado->sexo = $this->request->getPost("sexo", "int");

                $PublicoVoluntariado->expectativas = $this->request->getPost("expectativas", "string");
                $PublicoVoluntariado->sobre_ti = $this->request->getPost("sobre_ti", "string");

                if ($PublicoVoluntariado->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoVoluntariado->getMessages());
                } else {
                    //Cuando va bien
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    //----------------------------------login-empresas--------------------------
    public function login_empresasAction()
    {
        $this->assets->addJs("adminpanel/js/viewsweb/login.empresas.js?v=" . uniqid());
    }

    public function loginEmpresasAction()
    {
        //$secret_key = $this->config->recaptchav3->XSecretKey;
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                //Tipo de usuario
                $tipousuario = 2;

                //persona juridica
                $ruc = $this->request->getPost('nro_ruc');

                //password
                $password = $this->request->getPost('password');

                if ($tipousuario == 2) {
                    //login docentes
                    $where = " estado = 'A' AND ruc = '{$ruc}'";

                    // print($where);
                    // exit();

                    $user = Empresas::findFirst($where);
                    $pass = $user->password;

                    $nombre_perfil = 'EMPRESAS';
                    $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                    $codigo_perfil = $Perfil->id;

                    /* Desencryptar */
                    if ($this->security->checkHash($password, $pass)) {
                        $this->session->set('auth', [
                            'id_empresa' => $user->id_empresa,
                            'nombres' => $user->razon_social,
                            'ruc' => $user->ruc,
                            'nombre_perfil' => 'EMPRESAS',
                            'perfil' => $codigo_perfil,
                            'tipo' => 4,
                        ]);

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "yes"));
                    } else {

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "no"));
                    }
                } else {
                    $this->response->setJsonContent(array("say" => "no_existe"));
                }
                $this->response->send();
            } else {

                //echo '<pre>';
                //print_r('Error usuario');
                //exit();
                $this->response->setStatusCode(404);
                //$this->response->setJsonContent(array("say" => "no_existe"));
                //$this->response->send();
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }

    //---------------------------fin login-empresas.html------------------------
    //----------------------------login-proveedores.html------------------------
    public function login_proveedoresAction()
    {
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        //sexo(a_codigos)
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        //Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //modalidad
        $tipo_persona = TipoPersona::find("estado = 'A' AND numero = 2");
        $this->view->tipo_persona = $tipo_persona;

        //recaptchav3
        //$site_key = $this->config->recaptchav3->xWebsiteKey;
        //$site_key = $this->config->recaptchav3->xWebsiteKeyLocalhost;
        //$this->view->site_key = $site_key;
        //recaptchav3
        //$this->assets->addJs("https://www.google.com/recaptcha/api.js?render=" . $site_key);
        //$this->assets->addJs("adminpanel/js/viewsweb/login.externo.recaptchav3.js?v=" . uniqid());
        //login.html
        $this->assets->addJs("adminpanel/js/viewsweb/login.proveedores.js?v=" . uniqid());
    }

    public function loginProveedoresAction()
    {
        //$secret_key = $this->config->recaptchav3->XSecretKey;
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                /*
                $SecretKey = $this->request->getPost('g-recaptcha-response', 'string');
                $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response={$SecretKey}");
                $Return = json_decode($Response);
                if ($Return->success == true && $Return->score > 0.5) { */
                if (1 == 1) {

                    //Tipo de usuario
                    //echo '<pre>';
                    //print_r($_POST);
                    //exit();

                    $tipousuario = 2;
                    $ruc = $this->request->getPost('ruc');

                    //password
                    $password = $this->request->getPost('password');

                    if ($tipousuario == 2) {
                        //login docentes
                        $where = " estado = 'A' AND ruc = '{$ruc}'";
                        $user = Empresas::findFirst($where);
                        if ($user) {
                            $pass = $user->password;

                            //perfil
                            $nombre_perfil = 'EMPRESAS';
                            $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                            $codigo_perfil = $Perfil->id;

                            /* Desencryptar */
                            if ($this->security->checkHash($password, $pass)) {
                                $this->session->set('auth', [
                                    'codigo' => $user->id_empresa,
                                    'nombres' => $user->razon_social,
                                    'ruc' => $user->ruc,
                                    'perfil' => $codigo_perfil,
                                    'tipo' => 4,
                                ]);

                                $this->response->setStatusCode(200, "OK");
                                $this->response->setJsonContent(array("say" => "yes"));
                            } else {

                                $this->response->setStatusCode(200, "OK");
                                $this->response->setJsonContent(array("say" => "no"));
                            }
                        } else {
                            $this->response->setJsonContent(array("say" => "no_existe"));
                        }
                    }
                    $this->response->send();
                    //echo '<pre>';
                    //print_r($user->password);
                    //exit();
                    //fin where
                } else {
                    //$this->session->set('robot_3', ['value' => 'si']);
                    //echo '<pre>';
                    //print_r('You are a Robot!!');
                    //exit();
                    //return $this->response->redirect("https://www.google.com/");
                }
            } else {

                //echo '<pre>';
                //print_r('Error usuario');
                //exit();
                $this->response->setStatusCode(404);
                //$this->response->setJsonContent(array("say" => "no_existe"));
                //$this->response->send();
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function saveProveedorLoginAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $Proveedores = new Proveedores();
                $Proveedores->razon_social = strtoupper($this->request->getPost("razon_social", "string"));
                $Proveedores->ruc = $this->request->getPost("ruc", "string");
                $Proveedores->rubro = $this->request->getPost("rubro", "string");
                $Proveedores->telefono = $this->request->getPost("telefono", "string");
                $Proveedores->direccion = $this->request->getPost("direccion", "string");
                $Proveedores->email = $this->request->getPost("email_empresa_registro", "string");
                $Proveedores->fecha_registro = date("Y-m-d H:i:s");

                $password_empresa_externo = $this->request->getPost("password", "string");

                //print($password_empresa_externo);
                //exit();

                if ($password_empresa_externo !== "") {
                    $Proveedores->password = $this->security->hash($password_empresa_externo);
                } else {
                    //print("@Kenmack");
                    //exit();
                    $Proveedores->password = '';
                }

                $Proveedores->representante = $this->request->getPost("representante", "string");
                $Proveedores->estado = "A";

                //
                $Proveedores->giro = $this->request->getPost("giro", "string");
                $Proveedores->fecha_registro = date("Y-m-d H:i:s");
                $Proveedores->cta_cte_detraccion = $this->request->getPost("cta_cte_detraccion", "string");
                $Proveedores->cci = $this->request->getPost("cci", "string");
                $Proveedores->cargo = $this->request->getPost("cargo", "string");
                $Proveedores->nro_doc = $this->request->getPost("nro_doc", "string");
                $Proveedores->fax = $this->request->getPost("fax", "string");
                $Proveedores->celular = $this->request->getPost("celular", "string");
                $Proveedores->pais = $this->request->getPost("pais", "string");
                $Proveedores->region = $this->request->getPost("region", "string");
                $Proveedores->provincia = $this->request->getPost("provincia", "string");
                $Proveedores->distrito = $this->request->getPost("distrito", "string");
                $Proveedores->ubigeo = $this->request->getPost("ubigeo", "string");
                $Proveedores->referencia = $this->request->getPost("referencia", "string");

                $extrae_primer_dig_ruc = $this->request->getPost("ruc", "string");
                $tipo = $extrae_primer_dig_ruc[0];
                $Proveedores->tipo = $tipo;

                $boleta = $this->request->getPost("boleta", "string");
                if (isset($boleta)) {
                    $Proveedores->boleta = "1";
                } else {
                    $Proveedores->boleta = "0";
                }

                $factura = $this->request->getPost("factura", "string");
                if (isset($factura)) {
                    $Proveedores->factura = "1";
                } else {
                    $Proveedores->factura = "0";
                }

                $rnp = $this->request->getPost("rnp", "string");
                if (isset($rnp)) {
                    $Proveedores->rnp = "1";
                } else {
                    $Proveedores->rnp = "0";
                }

                $mype = $this->request->getPost("mype", "string");
                if (isset($mype)) {
                    $Proveedores->mype = "1";
                } else {
                    $Proveedores->mype = "0";
                }

                $entidad_publica = $this->request->getPost("entidad_publica", "string");
                if (isset($entidad_publica)) {
                    $Proveedores->entidad_publica = "1";
                } else {
                    $Proveedores->entidad_publica = "0";
                }

                //archivo_ruc
                $archivo_ruc = $_FILES['archivo_ruc']['name'];
                if ($archivo_ruc !== "") {
                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');
                    $file_archivo = $_FILES['archivo_ruc']['name'];
                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                    if (in_array($extension, $formatos_archivo)) {
                        //$id_empresa = EmpresasExterno::count();
                        $Proveedores->archivo_ruc = "archivo_ruc." . $extension;
                    } else {
                        $this->response->setJsonContent(array("say" => "error_archivo_ruc"));
                        $this->response->send();
                        exit();
                    }
                }

                //archivo_rnp
                $archivo_rnp = $_FILES['archivo_rnp']['name'];
                if ($archivo_rnp !== "") {

                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');
                    $file_archivo = $_FILES['archivo_rnp']['name'];
                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                    if (in_array($extension, $formatos_archivo)) {
                        //$id_empresa = EmpresasExterno::count();
                        $Proveedores->archivo_rnp = "archivo_rnp." . $extension;
                    } else {
                        $this->response->setJsonContent(array("say" => "error_archivo_rnp"));
                        $this->response->send();
                        exit();
                    }
                }

                //archivo_brochure
                $archivo_brochure = $_FILES['archivo_brochure']['name'];
                if ($archivo_brochure !== "") {

                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');
                    $file_archivo = $_FILES['archivo_brochure']['name'];
                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                    if (in_array($extension, $formatos_archivo)) {
                        //$id_empresa = EmpresasExterno::count();
                        $Proveedores->archivo_brochure = "archivo_brochure." . $extension;
                    } else {
                        $this->response->setJsonContent(array("say" => "error_archivo_brochure"));
                        $this->response->send();
                        exit();
                    }
                }
                //

                if ($Proveedores->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Proveedores->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo_ruc
                            if ($file->getKey() == "archivo_ruc") {

                                if ($_FILES['archivo_ruc']['name'] !== "") {
                                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_ruc']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Proveedores->archivo_ruc)) {
                                            $url_destino = 'adminpanel/archivos/empresas/' . $Proveedores->archivo_ruc;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Proveedores->id_empresa . '-' . $temporal_rand . "." . $extension;
                                            $Proveedores->archivo_ruc = 'FILE' . '-' . $Proveedores->id_empresa . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Proveedores->id_empresa . "." . $extension;
                                            $Proveedores->archivo_ruc = 'FILE' . '-' . $Proveedores->id_empresa . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_ruc"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo_rnp
                            if ($file->getKey() == "archivo_rnp") {

                                if ($_FILES['archivo_rnp']['name'] !== "") {
                                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_rnp']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Proveedores->archivo_rnp)) {
                                            $url_destino = 'adminpanel/archivos/empresas/' . $Proveedores->archivo_rnp;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Proveedores->id_empresa . '-' . $temporal_rand . "." . $extension;
                                            $Proveedores->archivo_rnp = 'FILE' . '-' . $Proveedores->id_empresa . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Proveedores->id_empresa . "." . $extension;
                                            $Proveedores->archivo_rnp = 'FILE' . '-' . $Proveedores->id_empresa . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_rnp"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo_brochure
                            if ($file->getKey() == "archivo_brochure") {

                                if ($_FILES['archivo_brochure']['name'] !== "") {
                                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_brochure']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Proveedores->archivo_rnp)) {
                                            $url_destino = 'adminpanel/archivos/empresas/' . $Proveedores->archivo_brochure;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'BROC' . '-' . $Proveedores->ruc . '-' . $temporal_rand . "." . $extension;
                                            $Proveedores->archivo_brochure = 'BROC' . '-' . $Proveedores->ruc . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'BROC' . '-' . $Proveedores->ruc . "." . $extension;
                                            $Proveedores->archivo_brochure = 'BROC' . '-' . $Proveedores->ruc . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_brochure"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $Proveedores->save();
                    }
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //-------------------------------libro-reclamaciones.html-----------------------
    public function web_libro_reclamacionesAction()
    {
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        //sexo(a_codigos)
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        //Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //modalidad
        $tipo_persona = TipoPersona::find("estado = 'A' AND numero = 2");
        $this->view->tipo_persona = $tipo_persona;

        $this->assets->addJs("adminpanel/js/viewsweb/libro.reclamaciones.js?v=" . uniqid());
    }

    public function saveLibroReclamacionesAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $LibroReclamaciones = new LibroReclamaciones();

                $LibroReclamaciones->tipo = $this->request->getPost("tipo", "string");
                $LibroReclamaciones->codigo = $this->request->getPost("codigo", "int");
                $LibroReclamaciones->reclamo = $this->request->getPost("reclamo", "string");
                $LibroReclamaciones->fecha_registro = date('Y-m-d H:i:s');

                $LibroReclamaciones->estado = "A";

                if ($LibroReclamaciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($LibroReclamaciones->getMessages());
                } else {
                    //Cuando va bien

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function getAjaxCiudadanoAction()
    {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $CiudadanoLibroReclamaciones = CiudadanoLibroReclamaciones::findFirstBynro_doc((string) $this->request->getPost("nro_doc", "string"));

            if ($CiudadanoLibroReclamaciones) {
                //$this->response->setJsonContent($PersonaNatural->toArray());
                //$this->response->setJsonContent(array("say" => "yes"));
                $this->response->setJsonContent(array("say" => "yes", "persona_natural" => $CiudadanoLibroReclamaciones));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function saveCiudadanoLibroReclamacionesAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //inicio
                //print_r($_POST);exit();
                $CiudadanoLibroReclamaciones = new CiudadanoLibroReclamaciones();

                $CiudadanoLibroReclamaciones->tipo = 1;

                $CiudadanoLibroReclamaciones->documento = $this->request->getPost("documento", "int");
                $CiudadanoLibroReclamaciones->nro_doc = $this->request->getPost("nro_doc", "string");
                $CiudadanoLibroReclamaciones->sexo = $this->request->getPost("sexo", "int");
                $CiudadanoLibroReclamaciones->apellidop = strtoupper($this->request->getPost("apellidop"));
                $CiudadanoLibroReclamaciones->apellidom = strtoupper($this->request->getPost("apellidom"));
                $CiudadanoLibroReclamaciones->nombres = strtoupper($this->request->getPost("nombres"));
                $CiudadanoLibroReclamaciones->email = $this->request->getPost("email", "string");
                $CiudadanoLibroReclamaciones->celular = $this->request->getPost("celular", "string");
                $CiudadanoLibroReclamaciones->ciudad = strtoupper($this->request->getPost("ciudad", "string"));
                $CiudadanoLibroReclamaciones->direccion = strtoupper($this->request->getPost("direccion", "string"));
                $CiudadanoLibroReclamaciones->region = $this->request->getPost("region", "string");
                $CiudadanoLibroReclamaciones->provincia = $this->request->getPost("provincia", "string");
                $CiudadanoLibroReclamaciones->distrito = $this->request->getPost("distrito", "string");
                $CiudadanoLibroReclamaciones->ubigeo = $this->request->getPost("ubigeo", "string");

                $password_publico_externo = $this->request->getPost("password_1", "string");
                if ($password_publico_externo != "") {
                    $CiudadanoLibroReclamaciones->password = $this->security->hash($password_publico_externo);
                } else {
                    $CiudadanoLibroReclamaciones->password = '';
                }
                $CiudadanoLibroReclamaciones->estado = "A";

                if ($CiudadanoLibroReclamaciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($CiudadanoLibroReclamaciones->getMessages());
                } else {
                    //Cuando va bien
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function getAjaxPersonaJuridicaAction()
    {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PersonaJuridica = PersonaJuridica::findFirstByruc((string) $this->request->getPost("ruc", "string"));

            if ($PersonaJuridica) {
                //$this->response->setJsonContent($PersonaNatural->toArray());
                //$this->response->setJsonContent(array("say" => "yes"));
                $this->response->setJsonContent(array("say" => "yes", "persona_juridica" => $PersonaJuridica));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function savePersonaJuridicaLibroReclamacionesAction()
    {

        //        echo "<pre>";
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $PersonaJuridica = new PersonaJuridica();
                $PersonaJuridica->razon_social = strtoupper($this->request->getPost("razon_social", "string"));
                $PersonaJuridica->ruc = $this->request->getPost("ruc", "string");
                $PersonaJuridica->rubro = $this->request->getPost("rubro", "string");
                $PersonaJuridica->telefono = $this->request->getPost("telefono", "string");
                $PersonaJuridica->direccion = $this->request->getPost("direccion", "string");
                $PersonaJuridica->email = $this->request->getPost("email", "string");

                $password_empresa_externo = $this->request->getPost("password_1", "string");

                //print($password_empresa_externo);
                //exit();

                if ($password_empresa_externo !== "") {
                    $PersonaJuridica->password = $this->security->hash($password_empresa_externo);
                } else {
                    //print("@Kenmack");
                    //exit();
                    $PersonaJuridica->password = '';
                }

                $PersonaJuridica->representante = $this->request->getPost("representante", "string");
                $PersonaJuridica->estado = "A";

                //
                $PersonaJuridica->region = $this->request->getPost("region", "string");
                $PersonaJuridica->provincia = $this->request->getPost("provincia", "string");
                $PersonaJuridica->distrito = $this->request->getPost("distrito", "string");
                $PersonaJuridica->ubigeo = $this->request->getPost("ubigeo", "string");

                if ($PersonaJuridica->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PersonaJuridica->getMessages());
                } else {
                    //Cuando va bien
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function getAjaxPersonaNaturalAction()
    {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $PersonaNatural = PersonaNatural::findFirstByruc((string) $this->request->getPost("ruc", "string"));

            if ($PersonaNatural) {
                //$this->response->setJsonContent($PersonaNatural->toArray());
                //$this->response->setJsonContent(array("say" => "yes"));
                $this->response->setJsonContent(array("say" => "yes", "persona_natural" => $PersonaNatural));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function savePersonaNaturalLibroReclamacionesAction()
    {

        //        echo "<pre>";
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $PersonaNatural = new PersonaNatural();
                $PersonaNatural->razon_social = strtoupper($this->request->getPost("razon_social", "string"));
                $PersonaNatural->ruc = $this->request->getPost("ruc", "string");
                $PersonaNatural->rubro = $this->request->getPost("rubro", "string");
                $PersonaNatural->telefono = $this->request->getPost("telefono", "string");
                $PersonaNatural->direccion = $this->request->getPost("direccion", "string");
                $PersonaNatural->email = $this->request->getPost("email", "string");

                $password_empresa_externo = $this->request->getPost("password_1", "string");

                //print($password_empresa_externo);
                //exit();

                if ($password_empresa_externo !== "") {
                    $PersonaNatural->password = $this->security->hash($password_empresa_externo);
                } else {
                    //print("@Kenmack");
                    //exit();
                    $PersonaNatural->password = '';
                }

                $PersonaNatural->representante = $this->request->getPost("representante", "string");
                $PersonaNatural->estado = "A";

                //
                $PersonaNatural->region = $this->request->getPost("region", "string");
                $PersonaNatural->provincia = $this->request->getPost("provincia", "string");
                $PersonaNatural->distrito = $this->request->getPost("distrito", "string");
                $PersonaNatural->ubigeo = $this->request->getPost("ubigeo", "string");

                if ($PersonaNatural->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PersonaNatural->getMessages());
                } else {
                    //Cuando va bien
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    //------------------------------acceso-informacion.html-------------------------
    public function web_acceso_informacionAction()
    {
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        //sexo(a_codigos)
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        //Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //modalidad
        $tipo_persona = TipoPersona::find("estado = 'A' AND numero = 2");
        $this->view->tipo_persona = $tipo_persona;

        //Region - (Ubigeo)
        $Areas = Areas::find("estado = 'A' ");
        $this->view->areas = $Areas;

        //modalidad
        $MedioEntrega = MedioEntrega::find("estado = 'A' AND numero = 93");
        $this->view->medio_entrega = $MedioEntrega;

        $this->assets->addJs("adminpanel/js/viewsweb/acceso.informacion.js?v=" . uniqid());
    }

    public function saveAccesoInformacionAction()
    {

        //        echo "<pre>";
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $AccesoInformacion = new AccesoInformacion();

                $AccesoInformacion->tipo = $this->request->getPost("tipo", "string");
                $AccesoInformacion->codigo = $this->request->getPost("codigo", "int");
                $AccesoInformacion->informacion = $this->request->getPost("informacion", "string");
                $AccesoInformacion->area = $this->request->getPost("area", "int");
                $AccesoInformacion->medio = $this->request->getPost("medio", "int");
                $AccesoInformacion->fecha_registro = date('Y-m-d H:i:s');

                $AccesoInformacion->estado = "A";

                if ($AccesoInformacion->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($AccesoInformacion->getMessages());
                } else {
                    //Cuando va bien

                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function saveCiudadanoAccesoInformacionAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //inicio
                //print_r($_POST);exit();
                $CiudadanoLibroReclamaciones = new CiudadanoLibroReclamaciones();

                $CiudadanoLibroReclamaciones->tipo = 1;

                $CiudadanoLibroReclamaciones->documento = $this->request->getPost("documento", "int");
                $CiudadanoLibroReclamaciones->nro_doc = $this->request->getPost("nro_doc", "string");
                $CiudadanoLibroReclamaciones->sexo = $this->request->getPost("sexo", "int");
                $CiudadanoLibroReclamaciones->apellidop = strtoupper($this->request->getPost("apellidop"));
                $CiudadanoLibroReclamaciones->apellidom = strtoupper($this->request->getPost("apellidom"));
                $CiudadanoLibroReclamaciones->nombres = strtoupper($this->request->getPost("nombres"));
                $CiudadanoLibroReclamaciones->email = $this->request->getPost("email", "string");
                $CiudadanoLibroReclamaciones->celular = $this->request->getPost("celular", "string");
                $CiudadanoLibroReclamaciones->ciudad = strtoupper($this->request->getPost("ciudad", "string"));
                $CiudadanoLibroReclamaciones->direccion = strtoupper($this->request->getPost("direccion", "string"));
                $CiudadanoLibroReclamaciones->region = $this->request->getPost("region", "string");
                $CiudadanoLibroReclamaciones->provincia = $this->request->getPost("provincia", "string");
                $CiudadanoLibroReclamaciones->distrito = $this->request->getPost("distrito", "string");
                $CiudadanoLibroReclamaciones->ubigeo = $this->request->getPost("ubigeo", "string");

                $password_publico_externo = $this->request->getPost("password_1", "string");
                if ($password_publico_externo != "") {
                    $CiudadanoLibroReclamaciones->password = $this->security->hash($password_publico_externo);
                } else {
                    $CiudadanoLibroReclamaciones->password = '';
                }

                $CiudadanoLibroReclamaciones->estado = "A";

                if ($CiudadanoLibroReclamaciones->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($CiudadanoLibroReclamaciones->getMessages());
                } else {
                    //Cuando va bien
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function savePersonaNaturalAccesoInformacionAction()
    {

        //        echo "<pre>";
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $PersonaNatural = new PersonaNatural();
                $PersonaNatural->razon_social = strtoupper($this->request->getPost("razon_social", "string"));
                $PersonaNatural->ruc = $this->request->getPost("ruc", "string");
                $PersonaNatural->rubro = $this->request->getPost("rubro", "string");
                $PersonaNatural->telefono = $this->request->getPost("telefono", "string");
                $PersonaNatural->direccion = $this->request->getPost("direccion", "string");
                $PersonaNatural->email = $this->request->getPost("email", "string");

                $password_empresa_externo = $this->request->getPost("password_1", "string");

                //print($password_empresa_externo);
                //exit();

                if ($password_empresa_externo !== "") {
                    $PersonaNatural->password = $this->security->hash($password_empresa_externo);
                } else {
                    //print("@Kenmack");
                    //exit();
                    $PersonaNatural->password = '';
                }

                $PersonaNatural->representante = $this->request->getPost("representante", "string");
                $PersonaNatural->estado = "A";

                //
                $PersonaNatural->region = $this->request->getPost("region", "string");
                $PersonaNatural->provincia = $this->request->getPost("provincia", "string");
                $PersonaNatural->distrito = $this->request->getPost("distrito", "string");
                $PersonaNatural->ubigeo = $this->request->getPost("ubigeo", "string");

                if ($PersonaNatural->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PersonaNatural->getMessages());
                } else {
                    //Cuando va bien
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function savePersonaJuridicaAccesoInformacionAction()
    {

        //        echo "<pre>";
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $PersonaJuridica = new PersonaJuridica();
                $PersonaJuridica->razon_social = strtoupper($this->request->getPost("razon_social", "string"));
                $PersonaJuridica->ruc = $this->request->getPost("ruc", "string");
                $PersonaJuridica->rubro = $this->request->getPost("rubro", "string");
                $PersonaJuridica->telefono = $this->request->getPost("telefono", "string");
                $PersonaJuridica->direccion = $this->request->getPost("direccion", "string");
                $PersonaJuridica->email = $this->request->getPost("email", "string");

                $password_empresa_externo = $this->request->getPost("password_1", "string");

                //print($password_empresa_externo);
                //exit();

                if ($password_empresa_externo !== "") {
                    $PersonaJuridica->password = $this->security->hash($password_empresa_externo);
                } else {
                    //print("@Kenmack");
                    //exit();
                    $PersonaJuridica->password = '';
                }

                $PersonaJuridica->representante = $this->request->getPost("representante", "string");
                $PersonaJuridica->estado = "A";

                //
                $PersonaJuridica->region = $this->request->getPost("region", "string");
                $PersonaJuridica->provincia = $this->request->getPost("provincia", "string");
                $PersonaJuridica->distrito = $this->request->getPost("distrito", "string");
                $PersonaJuridica->ubigeo = $this->request->getPost("ubigeo", "string");

                if ($PersonaJuridica->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PersonaJuridica->getMessages());
                } else {
                    //Cuando va bien
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    #--------------------------------login-egresados.html----------------------

    public function login_egresadosAction()
    {
        //recaptchav3
        //$site_key = $this->config->recaptchav3->xWebsiteKey;
        //$site_key = $this->config->recaptchav3->xWebsiteKeyLocalhost;
        //$this->view->site_key = $site_key;
        //recaptchav3
        //$this->assets->addJs("https://www.google.com/recaptcha/api.js?render=" . $site_key);
        //$this->assets->addJs("adminpanel/js/viewsweb/login.recaptchav3.js?v=" . uniqid());
        //login.html
        $this->assets->addJs("adminpanel/js/viewsweb/loginegresados.js?v=" . uniqid());
    }

    public function loginEgresadosAction()
    {

        //        echo '<pre>';
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                $email = strtolower($this->request->getPost('email')) . $this->config->global->xEmailIns;
                $password = $this->request->getPost('password');

                $where = " estado = 'A' AND email1 = '" . $email . "' AND tipo > 1";

                //print($where);
                //exit();

                $user = Alumnos::findFirst($where);

                //print($user->password);
                //exit();

                //perfil
                $nombrePerfil = 'EGRESADOS';
                $perfil = Perfil::findFirstByper_descripcion($nombrePerfil);
                $codigoPerfil = $perfil->id;

                if ($user) {
                    /* Desencryptar */
                    $pass = $user->password;
                    if ($this->security->checkHash($password, $pass)) {
                        $this->session->set('auth', [
                            'codigo' => $user->codigo,
                            'nombres' => $user->nombres,
                            'email' => $user->email1,
                            'perfil' => $codigoPerfil,
                            'tipo' => 1,
                        ]);

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "yes"));
                    } else {

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "no"));
                    }
                } else {
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "no_existe"));
                }
            } else {

                $this->response->setStatusCode(404);
                //$this->response->setJsonContent(array("say" => "no_existe"));
                //$this->response->send();
            }
        } else {
            $this->response->setStatusCode(404);
        }

        $this->response->send();
    }

    public function login_cvAction()
    {
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85 ORDER BY orden");
        $this->view->colegioprofesional = $ColegioProfesional;

        $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
        $this->view->estadocivil = $estado_civil;

        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        $this->assets->addJs("adminpanel/js/viewsweb/logincv.js?v=" . uniqid());
    }

    public function loginCvAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                $nro_doc_login = $this->request->getPost('nro_doc_login', 'string');
                $password = $this->request->getPost('password_login', 'string');

                $where = " estado = 'A' AND nro_doc = '" . $nro_doc_login . "'";
                $user = Publico::findFirst($where);

                if ($user) {

                    $pass = $user->password;
                    /* Desencryptar */
                    $nombre_perfil = 'CURRICULUM';
                    $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);

                    // print($Perfil->per_descripcion);
                    // exit();

                    $codigoPerfil = $Perfil->id;

                    if ($this->security->checkHash($password, $pass)) {
                        $this->session->set('auth', [
                            'codigo' => $user->codigo,
                            'nombres' => $user->nombres,
                            'nombre_perfil' => 'CURRICULUM',
                            'perfil' => $codigoPerfil,
                            'nro_doc' => $user->nro_doc,
                            'tipo' => 5,
                        ]);

                        $ConvocatoriasPublico = ConvocatoriasPublico::findFirst("estado ='1' AND publico = {$user->codigo}");

                        if ($ConvocatoriasPublico) {
                            $this->response->setStatusCode(200, "OK");
                            $this->response->setJsonContent(array("say" => "evaluado"));
                        } else {

                            $this->response->setStatusCode(200, "OK");
                            $this->response->setJsonContent(array("say" => "yes"));
                        }
                    } else {

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "no"));
                    }
                    $this->response->send();
                } else {
                    $this->response->setJsonContent(array("say" => "no_existe"));
                    $this->response->send();
                    //$this->response->setContent("No existe registro");
                    //$this->response->setStatusCode(500);
                }
            } else {
                $this->response->setStatusCode(404);
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function savePublicoCVAction()
    {

        //        echo "<pre>";
        //        print_r($_POST);
        //        exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //inicio
                //print_r($_POST);exit();
                $PublicoConvocatorias = new PublicoCV();

                $PublicoConvocatorias->tipo = 1;
                $PublicoConvocatorias->apellidop = strtoupper($this->request->getPost("apellidop"));
                $PublicoConvocatorias->apellidom = strtoupper($this->request->getPost("apellidom"));
                $PublicoConvocatorias->nombres = strtoupper($this->request->getPost("nombres"));

                if ($this->request->getPost("fecha_nacimiento", "string") != "") {
                    $fecha_ex = explode("/", $this->request->getPost("fecha_nacimiento", "string"));
                    $fecha_new = $fecha_ex[2] . "-" . $fecha_ex[1] . "-" . $fecha_ex[0];

                    $PublicoConvocatorias->fecha_nacimiento = date('Y-m-d', strtotime($fecha_new));
                }

                $PublicoConvocatorias->documento = $this->request->getPost("documento", "int");
                $PublicoConvocatorias->colegio_profesional = $this->request->getPost("colegio_profesional", "int");
                $PublicoConvocatorias->colegio_profesional_nro = $this->request->getPost("colegio_profesional_nro", "string");
                $PublicoConvocatorias->nro_doc = $this->request->getPost("nro_doc", "string");
                $PublicoConvocatorias->nro_ruc = $this->request->getPost("nro_ruc", "string");
                $PublicoConvocatorias->celular = $this->request->getPost("celular", "string");
                $PublicoConvocatorias->email = $this->request->getPost("email", "string");
                $PublicoConvocatorias->direccion = strtoupper($this->request->getPost("direccion", "string"));

                $discapacitado = $this->request->getPost("discapacitado", "string");
                if (isset($discapacitado)) {

                    $PublicoConvocatorias->discapacitado = 1;
                } else {

                    $PublicoConvocatorias->discapacitado = 0;
                }

                $PublicoConvocatorias->discapacitado_nombre = strtoupper($this->request->getPost("discapacitado_nombre", "string"));

                //$PublicoConvocatorias->password = $this->request->getPost("password", "string");

                $password_postulantes = $this->request->getPost("password", "string");
                $PublicoConvocatorias->password = $this->security->hash($password_postulantes);

                $PublicoConvocatorias->estado = "A";

                $PublicoConvocatorias->sexo = $this->request->getPost("sexo", "int");
                $PublicoConvocatorias->estado_civil = $this->request->getPost("estado_civil", "int");
                $PublicoConvocatorias->ciudad = strtoupper($this->request->getPost("ciudad", "string"));

                $PublicoConvocatorias->region = $this->request->getPost("region", "string");
                $PublicoConvocatorias->provincia = $this->request->getPost("provincia", "string");
                $PublicoConvocatorias->distrito = $this->request->getPost("distrito", "string");
                $PublicoConvocatorias->ubigeo = $this->request->getPost("ubigeo", "string");

                $PublicoConvocatorias->seguro = 9;

                if ($PublicoConvocatorias->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoConvocatorias->getMessages());
                } else {
                    //Cuando va bien
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function login_convocatoriasbsAction()
    {
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        //sexo(a_codigos)
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        //Region - (Ubigeo)
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //modalidad
        $tipo_persona = TipoPersona::find("estado = 'A' AND numero = 2");
        $this->view->tipo_persona = $tipo_persona;

        $this->assets->addJs("adminpanel/js/viewsweb/login.convocatoriasbs.js?v=" . uniqid());
    }

    public function loginConvocatoriasbsAction()
    {
        //$secret_key = $this->config->recaptchav3->XSecretKey;
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                /*
                $SecretKey = $this->request->getPost('g-recaptcha-response', 'string');
                $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response={$SecretKey}");
                $Return = json_decode($Response);
                if ($Return->success == true && $Return->score > 0.5) { */
                if (1 == 1) {

                    //Tipo de usuario
                    //echo '<pre>';
                    //print_r($_POST);
                    //exit();

                    $tipousuario = 2;
                    $ruc = $this->request->getPost('ruc');

                    //password
                    $password = $this->request->getPost('password');

                    if ($tipousuario == 2) {
                        //login docentes
                        $where = " estado = 'A' AND ruc = '{$ruc}'";
                        $user = Empresas::findFirst($where);
                        if ($user) {
                            $pass = $user->password;

                            //perfil
                            $nombre_perfil = 'EMPRESAS';
                            $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                            $codigo_perfil = $Perfil->id;

                            /* Desencryptar */
                            if ($this->security->checkHash($password, $pass)) {
                                $this->session->set('auth', [
                                    'id_empresa' => $user->id_empresa,
                                    'nombres' => $user->razon_social,
                                    'ruc' => $user->ruc,
                                    'perfil' => $codigo_perfil,
                                    'tipo' => 4,
                                ]);

                                $this->response->setStatusCode(200, "OK");
                                $this->response->setJsonContent(array("say" => "yes"));
                            } else {

                                $this->response->setStatusCode(200, "OK");
                                $this->response->setJsonContent(array("say" => "no"));
                            }
                        } else {
                            $this->response->setJsonContent(array("say" => "no_existe"));
                        }
                    }
                    $this->response->send();
                    //echo '<pre>';
                    //print_r($user->password);
                    //exit();
                    //fin where
                }
            } else {
                $this->response->setStatusCode(404);
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function saveProveedoresLoginAction()
    {

        //echo "<pre>";
        //print_r($_POST);
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $Proveedores = new Proveedores();
                $Proveedores->razon_social = strtoupper($this->request->getPost("razon_social", "string"));
                $Proveedores->ruc = $this->request->getPost("ruc", "string");
                $Proveedores->rubro = $this->request->getPost("rubro", "string");
                $Proveedores->telefono = $this->request->getPost("telefono", "string");
                $Proveedores->direccion = $this->request->getPost("direccion", "string");
                $Proveedores->email = $this->request->getPost("email_empresa_registro", "string");
                $Proveedores->fecha_registro = date("Y-m-d H:i:s");

                $password_empresa_externo = $this->request->getPost("password", "string");

                //print($password_empresa_externo);
                //exit();

                if ($password_empresa_externo !== "") {
                    $Proveedores->password = $this->security->hash($password_empresa_externo);
                } else {
                    //print("@Kenmack");
                    //exit();
                    $Proveedores->password = '';
                }

                $Proveedores->representante = $this->request->getPost("representante", "string");
                $Proveedores->estado = "A";

                //
                $Proveedores->giro = $this->request->getPost("giro", "string");
                $Proveedores->fecha_registro = date("Y-m-d H:i:s");
                $Proveedores->cta_cte_detraccion = $this->request->getPost("cta_cte_detraccion", "string");
                $Proveedores->cci = $this->request->getPost("cci", "string");
                $Proveedores->cargo = $this->request->getPost("cargo", "string");
                $Proveedores->nro_doc = $this->request->getPost("nro_doc", "string");
                $Proveedores->fax = $this->request->getPost("fax", "string");
                $Proveedores->celular = $this->request->getPost("celular", "string");
                $Proveedores->pais = $this->request->getPost("pais", "string");
                $Proveedores->region = $this->request->getPost("region", "string");
                $Proveedores->provincia = $this->request->getPost("provincia", "string");
                $Proveedores->distrito = $this->request->getPost("distrito", "string");
                $Proveedores->ubigeo = $this->request->getPost("ubigeo", "string");
                $Proveedores->referencia = $this->request->getPost("referencia", "string");

                $extrae_primer_dig_ruc = $this->request->getPost("ruc", "string");
                $tipo = $extrae_primer_dig_ruc[0];
                $Proveedores->tipo = $tipo;

                $boleta = $this->request->getPost("boleta", "string");
                if (isset($boleta)) {
                    $Proveedores->boleta = "1";
                } else {
                    $Proveedores->boleta = "0";
                }

                $factura = $this->request->getPost("factura", "string");
                if (isset($factura)) {
                    $Proveedores->factura = "1";
                } else {
                    $Proveedores->factura = "0";
                }

                $rnp = $this->request->getPost("rnp", "string");
                if (isset($rnp)) {
                    $Proveedores->rnp = "1";
                } else {
                    $Proveedores->rnp = "0";
                }

                $mype = $this->request->getPost("mype", "string");
                if (isset($mype)) {
                    $Proveedores->mype = "1";
                } else {
                    $Proveedores->mype = "0";
                }

                $entidad_publica = $this->request->getPost("entidad_publica", "string");
                if (isset($entidad_publica)) {
                    $Proveedores->entidad_publica = "1";
                } else {
                    $Proveedores->entidad_publica = "0";
                }

                //archivo_ruc
                $archivo_ruc = $_FILES['archivo_ruc']['name'];
                if ($archivo_ruc !== "") {
                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');
                    $file_archivo = $_FILES['archivo_ruc']['name'];
                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                    if (in_array($extension, $formatos_archivo)) {
                        //$id_empresa = EmpresasExterno::count();
                        $Proveedores->archivo_ruc = "archivo_ruc." . $extension;
                    } else {
                        $this->response->setJsonContent(array("say" => "error_archivo_ruc"));
                        $this->response->send();
                        exit();
                    }
                }

                //archivo_rnp
                $archivo_rnp = $_FILES['archivo_rnp']['name'];
                if ($archivo_rnp !== "") {

                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');
                    $file_archivo = $_FILES['archivo_rnp']['name'];
                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                    if (in_array($extension, $formatos_archivo)) {
                        //$id_empresa = EmpresasExterno::count();
                        $Proveedores->archivo_rnp = "archivo_rnp." . $extension;
                    } else {
                        $this->response->setJsonContent(array("say" => "error_archivo_rnp"));
                        $this->response->send();
                        exit();
                    }
                }

                //archivo_brochure
                $archivo_brochure = $_FILES['archivo_brochure']['name'];
                if ($archivo_brochure !== "") {

                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');
                    $file_archivo = $_FILES['archivo_brochure']['name'];
                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                    if (in_array($extension, $formatos_archivo)) {
                        //$id_empresa = EmpresasExterno::count();
                        $Proveedores->archivo_brochure = "archivo_brochure." . $extension;
                    } else {
                        $this->response->setJsonContent(array("say" => "error_archivo_brochure"));
                        $this->response->send();
                        exit();
                    }
                }
                //

                if ($Proveedores->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Proveedores->getMessages());
                } else {
                    //Cuando va bien
                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {
                            $temporal_rand = mt_rand(100000, 999999);

                            //archivo_ruc
                            if ($file->getKey() == "archivo_ruc") {

                                if ($_FILES['archivo_ruc']['name'] !== "") {
                                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_ruc']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Proveedores->archivo_ruc)) {
                                            $url_destino = 'adminpanel/archivos/empresas/' . $Proveedores->archivo_ruc;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Proveedores->id_empresa . '-' . $temporal_rand . "." . $extension;
                                            $Proveedores->archivo_ruc = 'FILE' . '-' . $Proveedores->id_empresa . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Proveedores->id_empresa . "." . $extension;
                                            $Proveedores->archivo_ruc = 'FILE' . '-' . $Proveedores->id_empresa . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_ruc"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo_rnp
                            if ($file->getKey() == "archivo_rnp") {

                                if ($_FILES['archivo_rnp']['name'] !== "") {
                                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_rnp']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Proveedores->archivo_rnp)) {
                                            $url_destino = 'adminpanel/archivos/empresas/' . $Proveedores->archivo_rnp;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Proveedores->id_empresa . '-' . $temporal_rand . "." . $extension;
                                            $Proveedores->archivo_rnp = 'FILE' . '-' . $Proveedores->id_empresa . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'FILE' . '-' . $Proveedores->id_empresa . "." . $extension;
                                            $Proveedores->archivo_rnp = 'FILE' . '-' . $Proveedores->id_empresa . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_rnp"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            //archivo_brochure
                            if ($file->getKey() == "archivo_brochure") {

                                if ($_FILES['archivo_brochure']['name'] !== "") {
                                    $formatos_archivo = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_brochure']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        if (isset($Proveedores->archivo_rnp)) {
                                            $url_destino = 'adminpanel/archivos/empresas/' . $Proveedores->archivo_brochure;
                                            if (file_exists($url_destino)) {
                                                unlink($url_destino);
                                            }
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'BROC' . '-' . $Proveedores->ruc . '-' . $temporal_rand . "." . $extension;
                                            $Proveedores->archivo_brochure = 'BROC' . '-' . $Proveedores->ruc . '-' . $temporal_rand . "." . $extension;
                                        } else {
                                            $url_destino = 'adminpanel/archivos/empresas/' . 'BROC' . '-' . $Proveedores->ruc . "." . $extension;
                                            $Proveedores->archivo_brochure = 'BROC' . '-' . $Proveedores->ruc . "." . $extension;
                                        }

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_brochure"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $Proveedores->save();
                    }
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function login_tramite_documentarioAction()
    {
        $this->assets->addJs("adminpanel/js/viewsweb/login.tramite.documentario.js?v=" . uniqid());
    }

    public function loginTramiteDocumentarioAction()
    {
        //$secret_key = $this->config->recaptchav3->XSecretKey;
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                $email = $this->request->getPost('email');

                $password = $this->request->getPost('password');

                $where = " estado = 'A' AND email = '$email'";
                $user = EmpresaPublico::findFirst($where);

                // print($publico->nombres);
                // exit();

                if ($user) {

                    $pass = $user->password;

                    $publico = Publico::findFirstBycodigo($user->id_publico);

                    //perfil
                    $nombre_perfil = 'TRAMITE DOCUMENTARIO WEB';
                    $perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                    $codigoPerfil = $perfil->id;

                    /* Desencryptar */
                    if ($this->security->checkHash($password, $pass)) {
                        $this->session->set('auth', [
                            'codigo' => $user->id_empresa_publico,
                            'nombres' => $publico->nombres,
                            'email' => $user->email,
                            'perfil' => $codigoPerfil,

                        ]);

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "yes"));
                    } else {

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "no"));
                    }
                } else {
                    $this->response->setJsonContent(array("say" => "no_existe"));
                }
                $this->response->send();
            } else {

                $this->response->setStatusCode(404);
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function web_registro_tramite_documentarioAction()
    {
        //tipo de documentos(a_codigos)
        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        $cargos = Cargos::find("estado = 'A' AND numero = 45");
        $this->view->cargos = $cargos;

        $this->assets->addJs("adminpanel/js/viewsweb/registro.tramite.documentario.js?v=" . uniqid());
    }

    public function getAjaxEmpresaAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $empresas = Empresas::findFirstByruc((string) $this->request->getPost("ruc", "string"));

            if ($empresas) {

                $this->response->setJsonContent(array("say" => "yes", "razon_social" => $empresas->razon_social, "id_empresa" => $empresas->id_empresa));
                $this->response->send();
            } else {

                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function getAjaxPublicoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            $publico = Publico::findFirstBynro_doc((string) $this->request->getPost("nro_doc", "string"));

            if ($publico) {

                $nombres = $publico->apellidop . " " . $publico->apellidom . " " . $publico->nombres;
                $id_publico = $publico->codigo;
                $this->response->setJsonContent(array("say" => "yes", "nombres" => $nombres, "id_publico" => $id_publico));
                $this->response->send();
            } else {

                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function saveEmpresaTramiteDocumentarioAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $Empresas = new EmpresaTramite();
                $Empresas->ruc = $this->request->getPost("ruc", "string");
                $Empresas->razon_social = strtoupper($this->request->getPost("razon_social", "string"));
                $Empresas->email = $this->request->getPost("email", "string");
                $Empresas->representante = $this->request->getPost("representante", "string");
                $Empresas->estado = "A";

                if ($Empresas->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($Empresas->getMessages());
                } else {
                    //Cuando va bien
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function savePublicoTramiteDocumentarioAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //inicio
                //print_r($_POST);exit();
                $PublicoExterno = new PublicoTramite();

                $PublicoExterno->documento = $this->request->getPost("documento", "int");
                $PublicoExterno->nro_doc = $this->request->getPost("nro_doc_registro_publico", "string");
                $PublicoExterno->sexo = $this->request->getPost("sexo", "int");
                $PublicoExterno->apellidop = strtoupper($this->request->getPost("apellidop"));
                $PublicoExterno->apellidom = strtoupper($this->request->getPost("apellidom"));
                $PublicoExterno->nombres = strtoupper($this->request->getPost("nombres"));
                $PublicoExterno->email = $this->request->getPost("email_publico_registro", "string");
                $PublicoExterno->celular = $this->request->getPost("celular", "string");
                $PublicoExterno->ciudad = strtoupper($this->request->getPost("ciudad", "string"));
                $PublicoExterno->direccion = strtoupper($this->request->getPost("direccion", "string"));
                $PublicoExterno->estado = "A";

                if ($PublicoExterno->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($PublicoExterno->getMessages());
                } else {
                    //Cuando va bien
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function envioEmailPublicoAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            $email = $this->request->getPost('email');

            $empresaPublico = EmpresaPublico::findFirst(
                [
                    "email = :email: AND estado = :estado: ",
                    'bind' => [
                        'email' => $email,
                        'estado' => "A",
                    ],
                ]
            );

            if ($empresaPublico !== false) {
                $msg = "si";
            } else {

                //$msg = "No existe ningun Usuario registrado con este Email";

                $link = $this->url->getBaseUri() . "web-registro-tramite-documentario.html";

                //print $link."<br>";
                // print base64_decode($encrypt);
                // exit();

                $emailTramite = $this->config->mail->destEmailTramite;
                $text_body .= "" . '<br>';
                $text_body .= "Gracias por realizar la validación de su cuenta de correo electrónico." . '<br>';
                $text_body .= "" . '<br>';
                $text_body .= "Para poder continuar con el registro de su documento en la Mesa de Partes Virtual de la Universidad Nacional Ciro Alegría" . '<br>';
                $text_body .= "" . '<br>';
                $text_body .= "deberá validar su cuenta de correo a través del siguiente enlace: " . $link . '<br>';
                $text_body .= "" . '<br>';

                $mailer = new mailer($this->di);
                $mailer->setSubject("{$this->config->global->xAbrevIns} - Mesa de Partes Virtual - Validación de correo electrónico");
                $mailer->setFrom($emailTramite);
                $mailer->setTo($email, $destEmail);
                $mailer->setBody($text_body);
                if ($mailer->send()) {
                    //return true;
                } else {
                    echo $mailer->getError();
                    echo "error";
                }

                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function saveEmpresaPublicoAction()
    {

        // echo "<pre>";
        // print_r($_POST);
        // exit();


        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                $empresaPublico = new EmpresaPublico();

                if ($this->request->getPost("documento", "string") == '1') {
                    $empresaPublico->id_empresa = 0;
                } else {

                    $empresaPublico->id_empresa = $this->request->getPost("id_empresa", "int");
                }

                $empresaPublico->id_publico = $this->request->getPost("id_publico", "int");
                $empresaPublico->cargo = $this->request->getPost("cargo", "string");
                $empresaPublico->email = $this->request->getPost("email", "string");
                $empresaPublico->password = $this->security->hash($this->request->getPost("password"));
                $empresaPublico->fecha_registro = date("Y-m-d H:i:s");
                $empresaPublico->area = $this->request->getPost("area", "string");
                $empresaPublico->estado = "A";

                if ($empresaPublico->save() == false) {
                    // Cuando hay error
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($empresaPublico->getMessages());
                } else {
                    //Cuando va bien
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function web_consulta_tramite_documentarioAction()
    {

        //cerramos sesion si no la inicio
        // if (!$this->session->has('auth')) {
        //    return $this->response->redirect("");
        // }

        $tipo_resolucion = "";
        $anio_tramite = "";
        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        // echo '<pre>';
        // print_r($full_url);
        // exit();

        //         echo '<pre>';
        // print_r($_GET["codigo_tramite"]);
        // exit();

        //Cargamos el modelo de los distritos

        $where = "";
        if ($this->request->isGet()) {

            if (isset($_GET["codigo_tramite"]) && $_GET["codigo_tramite"] != "") {
                $codigo_tramite = $this->request->getQuery("codigo_tramite", "int");
                $where = $where . " public.tbl_doc_documentos.id_doc = " . $codigo_tramite;
            }

            if (isset($_GET["anio_tramite"]) && $_GET["anio_tramite"] != "") {
                $anio_tramite = $this->request->getQuery("anio_tramite", "string");

                $where = $where . " AND public.tbl_doc_documentos.anio = " . $anio_tramite . "";

                $where = $where . " AND public.tbl_doc_documentos.estado = 'A'";
                //echo '<pre>';
                //print_r($where);
                //exit();
            }
        }
        //
        if (isset($_GET["page"])) {
            $currentPage = (int) $_GET['page'];
        } else {
            $currentPage = 1;
        }

        //print $where ; exit();

        $db = $this->db;
        $sql_query = "SELECT
        public.tbl_doc_documentos.id_doc,
        to_char( PUBLIC.tbl_doc_documentos.fecha_envio, 'DD/MM/YYYY' ) AS fecha_envio,
        to_char( PUBLIC.tbl_doc_documentos.fecha_cargo, 'DD/MM/YYYY' ) AS fecha_cargo,
        tipo_documentos.nombres AS tipo_documento_nombre,
        public.tbl_doc_documentos.nro_documento,
        public.tbl_doc_documentos.destinatario_personal,
        public.tbl_doc_documentos.remitente_nombres,
        public.tbl_doc_documentos.anio, public.tbl_doc_documentos.observaciones,
        proceso_tramite.nombres AS proceso_tramite_nombre
        FROM
        public.tbl_doc_documentos
        INNER JOIN public.a_codigos AS tipo_documentos ON public.tbl_doc_documentos.id_tipo_doc = tipo_documentos.codigo
        INNER JOIN public.a_codigos AS proceso_tramite ON public.tbl_doc_documentos.proceso = proceso_tramite.codigo
        WHERE
        tipo_documentos.numero = 102 AND proceso_tramite.numero = 145 AND $where";

        // print_r($sql_query);
        // exit();

        $documentos = "";
        $mensaje = "";
        // print_r($documentos->id_doc);
        // exit();

        if ($this->request->isGet()) {

            if (isset($_GET["anio_tramite"]) && $_GET["anio_tramite"] != "") {
                $documentos = $db->fetchOne($sql_query, Phalcon\Db::FETCH_OBJ);

                // print(count($documentos));
                // exit();

                if ($documentos) {
                    // print("Se envia resultado");
                    // exit();
                    $this->view->documentos = $documentos;
                } else {
                    //             print("No se envia resultado");
                    // exit();
                    $mensaje = "No se encontraron documentos ... Verifique el N° de su Registro.";
                }
            }
        }

        $this->view->documentos = $documentos;
        $this->view->mensaje = $mensaje;
        $this->view->codigo_tramite = $codigo_tramite;
        $this->view->anio_tramite = $anio_tramite;
        $this->view->full_url = $full_url;

        $this->assets->addJs("adminpanel/js/viewsweb/consulta.tramite.documentario.js?v=" . uniqid());
    }

    public function getAjaxDocumentosDetallesAction()
    {

        //echo '<pre>';
        //print_r("Entro Aqui");
        //exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo '<pre>';
            // print_r($_POST);
            // exit();

            $idDoc = (int) $this->request->getPost("id_doc", "int");

            $db = $this->db;
            $sql_query = "SELECT
            public.tbl_doc_documentos_detalles.id_doc_detalle,
            public.tbl_doc_documentos_detalles.id_doc,
            public.tbl_doc_documentos_detalles.fecha,
            public.tbl_doc_documentos_detalles.id_proveido,
            public.tbl_doc_documentos_detalles.estado,
            proveido.nombres AS proveido_nombre,
                    CONCAT (
                                    PUBLIC.tbl_web_areas.nombres,
                                    ' - ',
                                    PUBLIC.tbl_web_personal.apellidop,
                                    ' ',
                                    PUBLIC.tbl_web_personal.apellidom,
                                    ' ',
                                    PUBLIC.tbl_web_personal.nombres
                                ) AS destinatario
            FROM
            public.tbl_doc_documentos_detalles
            INNER JOIN public.a_codigos AS proveido ON proveido.codigo = public.tbl_doc_documentos_detalles.id_proveido
            INNER JOIN public.tbl_web_personal ON public.tbl_web_personal.codigo = public.tbl_doc_documentos_detalles.id_personal
                    INNER JOIN public.tbl_web_areas ON public.tbl_web_areas.codigo = public.tbl_doc_documentos_detalles.id_area

            WHERE
            public.tbl_doc_documentos_detalles.id_doc = $idDoc AND
            proveido.numero = 66";

            // print($sql_query);
            // exit();

            $documentosDetalles = $db->fetchAll($sql_query, Phalcon\Db::FETCH_OBJ);

            if ($documentosDetalles) {
                //$this->response->setJsonContent($PersonaNatural->toArray());
                //$this->response->setJsonContent(array("say" => "yes"));
                $this->response->setJsonContent(array("say" => "yes", "documentos_detalles" => $documentosDetalles));
                $this->response->send();
            } else {
                //$this->response->setContent("No existe registro");
                //$this->response->setStatusCode(500);
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function web_actasAction()
    {
        $nombre_acta = "";
        $tipo_actas = "";
        $anio_acta = "";
        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $where = " Actas.estado = 'A' AND Actas.visible = '1' ";

        if ($this->request->isGet()) {

            if (isset($_GET["nombre_acta"])) {
                $nombre_acta = $this->request->getQuery("nombre_acta", "string");
                $where = $where . " AND ( CAST(Actas.numero AS TEXT)  ILIKE '%" . $nombre_acta . "%' OR Actas.titulo  ILIKE '%" . $nombre_acta . "%' OR Actas.resumen  ILIKE '%" . $nombre_acta . "%' OR Actas.resuelve  ILIKE '%" . $nombre_acta . "%' OR Actas.visto  ILIKE '%" . $nombre_acta . "%')";
            }

            if (isset($_GET["tipo_actas"]) && $_GET["tipo_actas"] != "") {
                $tipo_actas = $this->request->getQuery("tipo_actas", "int");
                $where = $where . " AND Actas.tipo = " . $tipo_actas;
            }
            if (isset($_GET["anio_acta"]) && $_GET["anio_acta"] != "") {
                $anio_acta = $this->request->getQuery("anio_acta", "string");
                $where = $where . " AND Actas.anio = '" . $anio_acta . "'";

                //echo '<pre>';
                //print_r($where);
                //exit();
            }
        }

        //
        if (isset($_GET["page"])) {
            $currentPage = (int) $_GET['page'];
        } else {
            $currentPage = 1;
        }

        //print $where ; exit();

        $Actas = $this->modelsManager->createBuilder()
            ->from('Actas')
            ->columns('Actas.id_acta,
                        Actas.anio,
                        Actas.tipo,
                        Actas.numero,
                        Actas.titulo,
                        Actas.resumen,
                        Actas.visto,
                        Actas.resuelve,
                        Actas.fecha,
                        Actas.visible,
                        Actas.escaneado,
                        Actas.archivo,
                        Actas.imagen,
                        Actas.enlace,
                        Actas.estado')
            ->where($where)
            //->orderBy('Areas.area_id')
            ->orderBy('Actas.fecha DESC,Actas.tipo, Actas.numero DESC')
            ->getQuery()
            ->execute();
        $data = $Actas;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 15,
                'page' => $currentPage,
            ]
        );

        $page = $paginator->getPaginate();

        $this->view->page = $page;
        $this->view->nombre_acta = $nombre_acta;
        $this->view->tipo_actas = $tipo_actas;
        $this->view->anio_acta = $anio_acta;
        $this->view->full_url = $full_url;

        $tipoactas = TipoActas::find("estado = 'A' AND numero = 103");
        $this->view->tipoactas = $tipoactas;


        $anios = Acodigos::find("estado = 'A' AND numero = 40 ORDER BY codigo DESC ");
        $this->view->anios = $anios;
    }



/*-------------------grupo procesos -------------------------------*/

    public function web_procesos_grupoAction()
    {
        ini_set('display_errors', 1);
        $db = $this->db;

        $tipo_arr = array(1, 2, 3);
        $data_ordinario = [];
        $data_extraordinario = [];
        $data_extraordinario1 = [];
        foreach ($tipo_arr as $tipo) {            
            $sql_anio_acta = "select distinct a.codigo, a.nombres as anio, p.tipod from tbl_web_docprocesos p  INNER JOIN a_codigos a on p.tipod=a.codigo where tipo='" . $tipo . "' and a.numero='148' ORDER BY a.nombres ASC; ";
            
            $anios_tipo = $db->fetchAll($sql_anio_acta, Phalcon\Db::FETCH_OBJ);

            if ($tipo == 1) {
                foreach ($anios_tipo as $anio_t) {
                    /*$sql = "SELECT TO_CHAR(fecha, 'DD/MM/YYYY') as fecha_parse,* FROM tbl_web_actas as tba WHERE tba.anio='" . $anio_t->anio . "' AND tba.tipo='" . $tipo . "' ORDER BY numero DESC;";*/
                    $sql = "select TO_CHAR(p.fecha_hora, 'DD/MM/YYYY') as fecha_parse, ad.abreviatura, ap.nombres as nombre_proceso, p.tipod, ac.nombres as nombre_tipo, p.titulo, * FROM tbl_web_docprocesos p  INNER JOIN a_codigos ac on p.tipo=ac.codigo INNER JOIN a_codigos ap on p.tipop=ap.codigo INNER JOIN a_codigos ad on p.tipod=ad.codigo WHERE p.tipod ='" . $anio_t->tipod . "' AND p.tipo='" . $tipo . "' and ac.numero=146 and ap.numero=147 and ad.numero=148 ORDER BY p.orden asc;";
                    $actas = $db->fetchAll($sql, Phalcon\Db::FETCH_OBJ);                    
                    $data_ordinario["anio"][] = $anio_t->anio;
                    $data_ordinario["data"][$anio_t->anio] = $actas;
                }
            } else if ($tipo == 2) {
                foreach ($anios_tipo as $anio_t) {
                    $sql = "select TO_CHAR(p.fecha_hora, 'DD/MM/YYYY') as fecha_parse, ad.abreviatura, ap.nombres as nombre_proceso, p.tipod, ac.nombres as nombre_tipo, p.titulo, * FROM tbl_web_docprocesos p  INNER JOIN a_codigos ac on p.tipo=ac.codigo INNER JOIN a_codigos ap on p.tipop=ap.codigo INNER JOIN a_codigos ad on p.tipod=ad.codigo WHERE p.tipod ='" . $anio_t->tipod . "' AND p.tipo='" . $tipo . "' and ac.numero=146 and ap.numero=147 and ad.numero=148 ORDER BY p.orden asc;";
                    $actas = $db->fetchAll($sql, Phalcon\Db::FETCH_OBJ);                   
                    $data_extraordinario["anio"][] = $anio_t->anio;
                    $data_extraordinario["data"][$anio_t->anio] = $actas;
                }
            } else if ($tipo == 3) {
                foreach ($anios_tipo as $anio_t) {
                    $sql = "select TO_CHAR(p.fecha_hora, 'DD/MM/YYYY') as fecha_parse, ad.abreviatura, ap.nombres as nombre_proceso, p.tipod, ac.nombres as nombre_tipo, p.titulo, * FROM tbl_web_docprocesos p  INNER JOIN a_codigos ac on p.tipo=ac.codigo INNER JOIN a_codigos ap on p.tipop=ap.codigo INNER JOIN a_codigos ad on p.tipod=ad.codigo WHERE p.tipod ='" . $anio_t->tipod . "' AND p.tipo='" . $tipo . "' and ac.numero=146 and ap.numero=147 and ad.numero=148 ORDER BY p.orden asc;";
                    $actas = $db->fetchAll($sql, Phalcon\Db::FETCH_OBJ);                   
                    $data_extraordinario1["anio"][] = $anio_t->anio;
                    $data_extraordinario1["data"][$anio_t->anio] = $actas;
                }
            }
        }
        $this->view->data_ordinario_anio = $data_ordinario["anio"];
        $this->view->data_ordinario = $data_ordinario["data"];
        $this->view->data_extraordinario_anio  = $data_extraordinario["anio"];
        $this->view->data_extraordinario = $data_extraordinario["data"];
        $this->view->data_extraordinario1_anio  = $data_extraordinario1["anio"];
        $this->view->data_extraordinario1 = $data_extraordinario1["data"];
        $nombre_acta = "";
        $tipo_actas = "";
        $anio_acta = "";
        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $where = " tbl_web_docprocesos.estado = 'A' ";

        
        

    }



    public function web_procesosAction($enlace)
    {

        //Cargamos el modelo de las documentos
        $documento = Docproceso::findFirstByenlace((string) $enlace);

        // print("id_resolucion: ".$documento->id_resolucion);
        // exit();

        $this->view->documento = $documento;

        $resolucion = Resoluciones::findFirstByid_resolucion((int)$documento->id_resolucion);

        // print("archivo resolucion: ".$resolucion->archivo);
        // exit();

        $this->view->resolucion = $resolucion;

        $verificaa = DocprocesosArchivos::find("id_docproceso = $documento->id_docproceso AND visible='1' AND estado='A'");

        if (count($verificaa) >= 1) {

            // print(count($verificaa));
            // exit();

            $this->view->verificaa = count($verificaa);

            $documentosArchivos = DocprocesosArchivos::find(["id_docproceso = $documento->id_docproceso ", "order" => "orden DESC"]);


            $documentosArchivosResoluciones = Resoluciones::find();
            $this->view->documentosArchivosResoluciones = $documentosArchivosResoluciones;



            $this->view->documentosArchivos = $documentosArchivos;
        } else {
            $this->view->verificaa = count($verificaa);
        }
    }



    public function web_procesos_archivosAction($enlace)
    {

        //Cargamos el modelo de las documentos
        $documento = DocprocesosArchivos::findFirstByenlace((string) $enlace);

        // print("id_resolucion: ".$documento->id_resolucion);
        // exit();

        $this->view->documento = $documento;

        $resolucion = Resoluciones::findFirstByid_resolucion((int)$documento->id_resolucion);

        // print("archivo resolucion: ".$resolucion->archivo);
        // exit();

        $this->view->resolucion = $resolucion;
    }


/*----------------- grupo actas -------------*/

    
public function web_actas_grupoAction()
{
    ini_set('display_errors', 1);
    $db = $this->db;

    $tipo_arr = array(1, 2);
    $data_ordinario = [];
    $data_extraordinario = [];
    foreach ($tipo_arr as $tipo) {
        $sql_anio_acta = "SELECT DISTINCT anio FROM tbl_web_actas as tba WHERE tba.tipo='" . $tipo . "' ORDER BY anio DESC; ";
        $anios_tipo = $db->fetchAll($sql_anio_acta, Phalcon\Db::FETCH_OBJ);

        if ($tipo == 2) {
            foreach ($anios_tipo as $anio_t) {
                $sql = "SELECT TO_CHAR(fecha, 'DD/MM/YYYY') as fecha_parse,* FROM tbl_web_actas as tba WHERE tba.anio='" . $anio_t->anio . "' AND tba.tipo='" . $tipo . "' ORDER BY numero DESC;";
                $actas = $db->fetchAll($sql, Phalcon\Db::FETCH_OBJ);
                $data_ordinario["anio"][] = $anio_t->anio;
                $data_ordinario["data"][$anio_t->anio] = $actas;
            }
        } else {
            foreach ($anios_tipo as $anio_t) {
                $sql = "SELECT TO_CHAR(fecha, 'DD/MM/YYYY') as fecha_parse,* FROM tbl_web_actas as tba WHERE tba.anio='" . $anio_t->anio . "' AND tba.tipo='" . $tipo . "' ORDER BY numero DESC;";
                $actas = $db->fetchAll($sql, Phalcon\Db::FETCH_OBJ);
                $data_extraordinario["anio"][] = $anio_t->anio;
                $data_extraordinario["data"][$anio_t->anio] = $actas;
            }
        }
    }
    $this->view->data_ordinario_anio = $data_ordinario["anio"];
    $this->view->data_ordinario = $data_ordinario["data"];
    $this->view->data_extraordinario_anio  = $data_extraordinario["anio"];
    $this->view->data_extraordinario = $data_extraordinario["data"];
    $nombre_acta = "";
    $tipo_actas = "";
    $anio_acta = "";
    $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $where = " Actas.estado = 'A' AND Actas.visible = '1' ";

    if ($this->request->isGet()) {

        if (isset($_GET["nombre_acta"])) {
            $nombre_acta = $this->request->getQuery("nombre_acta", "string");
            $where = $where . " AND ( CAST(Actas.numero AS TEXT)  ILIKE '%" . $nombre_acta . "%' OR Actas.titulo  ILIKE '%" . $nombre_acta . "%' OR Actas.resumen  ILIKE '%" . $nombre_acta . "%' OR Actas.resuelve  ILIKE '%" . $nombre_acta . "%' OR Actas.visto  ILIKE '%" . $nombre_acta . "%')";
        }

        if (isset($_GET["tipo_actas"]) && $_GET["tipo_actas"] != "") {
            $tipo_actas = $this->request->getQuery("tipo_actas", "int");
            $where = $where . " AND Actas.tipo = " . $tipo_actas;
        }
        if (isset($_GET["anio_acta"]) && $_GET["anio_acta"] != "") {
            $anio_acta = $this->request->getQuery("anio_acta", "string");
            $where = $where . " AND Actas.anio = '" . $anio_acta . "'";

            //echo '<pre>';
            //print_r($where);
            //exit();
        }
    }

    //
    if (isset($_GET["page"])) {
        $currentPage = (int) $_GET['page'];
    } else {
        $currentPage = 1;
    }

    //print $where ; exit();

    $Actas = $this->modelsManager->createBuilder()
        ->from('Actas')
        ->columns('Actas.id_acta,
                    Actas.anio,
                    Actas.tipo,
                    Actas.numero,
                    Actas.titulo,
                    Actas.resumen,
                    Actas.visto,
                    Actas.resuelve,
                    Actas.fecha,
                    Actas.visible,
                    Actas.escaneado,
                    Actas.archivo,
                    Actas.imagen,
                    Actas.enlace,
                    Actas.estado')
        ->where($where)
        //->orderBy('Areas.area_id')
        ->orderBy('Actas.fecha DESC,Actas.tipo, Actas.numero DESC')
        ->getQuery()
        ->execute();
    $data = $Actas;

    $paginator = new PaginatorModel(
        [
            'data' => $data,
            'limit' => 15,
            'page' => $currentPage,
        ]
    );

    $page = $paginator->getPaginate();

    $this->view->page = $page;
    $this->view->nombre_acta = $nombre_acta;
    $this->view->tipo_actas = $tipo_actas;
    $this->view->anio_acta = $anio_acta;
    $this->view->full_url = $full_url;

    $tipoactas = TipoActas::find("estado = 'A' AND numero = 103");
    $this->view->tipoactas = $tipoactas;


    $anios = Acodigos::find("estado = 'A' AND numero = 40 ORDER BY codigo DESC ");
    $this->view->anios = $anios;
}



    /*----------------- grupo resoluciones -------------*/

    
    public function web_resoluciones_grupoAction()
    {
        ini_set('display_errors', 1);
        $db = $this->db;

        $tipo_arr = array(1, 2, 3);
        $data_presidencial = [];
        $data_comision = [];
        $data_administracion = [];
        foreach ($tipo_arr as $tipo) {
            $sql_anio_resolucion = "SELECT DISTINCT anio FROM tbl_web_resoluciones as tba WHERE tba.tipo='" . $tipo . "' ORDER BY anio DESC; ";
            $anios_tipo = $db->fetchAll($sql_anio_resolucion, Phalcon\Db::FETCH_OBJ);

            if ($tipo == 1) {
                foreach ($anios_tipo as $anio_t) {
                    $sql = "SELECT TO_CHAR(fecha, 'DD/MM/YYYY') as fecha_parse,* FROM tbl_web_resoluciones as tba WHERE tba.anio='" . $anio_t->anio . "' AND tba.tipo='" . $tipo . "' ORDER BY numero DESC;";
                    $actas = $db->fetchAll($sql, Phalcon\Db::FETCH_OBJ);
                    $data_comision["anio"][] = $anio_t->anio;
                    $data_comision["data"][$anio_t->anio] = $actas;
                }
            }else if ($tipo == 2) {
                foreach ($anios_tipo as $anio_t) {
                    $sql = "SELECT TO_CHAR(fecha, 'DD/MM/YYYY') as fecha_parse,* FROM tbl_web_resoluciones as tba WHERE tba.anio='" . $anio_t->anio . "' AND tba.tipo='" . $tipo . "' ORDER BY numero DESC;";
                    $actas = $db->fetchAll($sql, Phalcon\Db::FETCH_OBJ);
                    $data_presidencial["anio"][] = $anio_t->anio;
                    $data_presidencial["data"][$anio_t->anio] = $actas;
                }
            }else if ($tipo == 3) {
                foreach ($anios_tipo as $anio_t) {
                    $sql = "SELECT TO_CHAR(fecha, 'DD/MM/YYYY') as fecha_parse,* FROM tbl_web_resoluciones as tba WHERE tba.anio='" . $anio_t->anio . "' AND tba.tipo='" . $tipo . "' ORDER BY numero DESC;";
                    $actas = $db->fetchAll($sql, Phalcon\Db::FETCH_OBJ);
                    $data_administracion["anio"][] = $anio_t->anio;
                    $data_administracion["data"][$anio_t->anio] = $actas;
                }
            }
        }
        $this->view->data_presidencial_anio = $data_presidencial["anio"];
        $this->view->data_presidencial = $data_presidencial["data"];
        $this->view->data_comision_anio  = $data_comision["anio"];
        $this->view->data_comision = $data_comision["data"];
        $this->view->data_administracion_anio  = $data_administracion["anio"];
        $this->view->data_administracion = $data_administracion["data"];
        $nombre_acta = "";
        $tipo_actas = "";
        $anio_acta = "";
        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $where = " Resoluciones.estado = 'A' AND Resoluciones.visible = '1' ";

        if ($this->request->isGet()) {

            if (isset($_GET["nombre_resolucion"])) {
                $nombre_resolucion = $this->request->getQuery("nombre_resolucion", "string");
                $where = $where . " AND ( CAST(Resoluciones.numero AS TEXT)  ILIKE '%" . $nombre_resolucion . "%' OR Resoluciones.titulo  ILIKE '%" . $nombre_resolucion . "%' OR Resoluciones.resumen  ILIKE '%" . $nombre_resolucion . "%' OR Resoluciones.resuelve  ILIKE '%" . $nombre_resolucion . "%' OR Resoluciones.visto  ILIKE '%" . $nombre_resolucion . "%')";
            }

            if (isset($_GET["tipo_resoluciones"]) && $_GET["tipo_resoluciones"] != "") {
                $tipo_resoluciones = $this->request->getQuery("tipo_resoluciones", "int");
                $where = $where . " AND Resoluciones.tipo = " . $tipo_resoluciones;
            }
            if (isset($_GET["anio_resolucion"]) && $_GET["anio_resolucion"] != "") {
                $anio_acta = $this->request->getQuery("anio_resolucion", "string");
                $where = $where . " AND Resoluciones.anio = '" . $anio_resolucion . "'";

                //echo '<pre>';
                //print_r($where);
                //exit();
            }
        }

        //
        if (isset($_GET["page"])) {
            $currentPage = (int) $_GET['page'];
        } else {
            $currentPage = 1;
        }

        //print $where ; exit();

        $Actas = $this->modelsManager->createBuilder()
            ->from('Resoluciones')
            ->columns('Resoluciones.id_resolucion,
            Resoluciones.anio,
            Resoluciones.tipo,
            Resoluciones.numero,
            Resoluciones.titulo,
            Resoluciones.resumen,
            Resoluciones.visto,
            Resoluciones.resuelve,
            Resoluciones.fecha,
            Resoluciones.visible,
            Resoluciones.escaneado,
            Resoluciones.archivo,
            Resoluciones.imagen,
            Resoluciones.enlace,
            Resoluciones.estado')
            ->where($where)
            //->orderBy('Areas.area_id')
            ->orderBy('Resoluciones.fecha DESC,Resoluciones.tipo, Resoluciones.numero DESC')
            ->getQuery()
            ->execute();
        $data = $Actas;

        $paginator = new PaginatorModel(
            [
                'data' => $data,
                'limit' => 15,
                'page' => $currentPage,
            ]
        );

        $page = $paginator->getPaginate();

        $this->view->page = $page;
        $this->view->nombre_acta = $nombre_acta;
        $this->view->tipo_actas = $tipo_actas;
        $this->view->anio_acta = $anio_acta;
        $this->view->full_url = $full_url;

        $tiporesoluciones = TipoResoluciones::find("estado = 'A' AND numero = 70");
        $this->view->tiporesoluciones = $tiporesoluciones;


        $anios = Acodigos::find("estado = 'A' AND numero = 40 ORDER BY codigo DESC ");
        $this->view->anios = $anios;
    }


    //----------------------------------login-enae.html----------------------------------
    public function login_enaeAction()
    {

        $tipoDocumentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        //         foreach ($tipo_documentos as $value) {
        //             echo"<pre>";
        //     print_r($value->nombres);
        // }
        // exit();
        $this->view->tipodocumentos = $tipoDocumentos;

        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        $categoriaPostulante = CategoriaPostulante::find(
            [
                "estado = 'A' AND numero = 104",
                'order' => 'codigo ASC',
            ]
        );
        $this->view->categoriapostulante = $categoriaPostulante;

        $tipoinstitucion = TipoInstitucion::find("estado = 'A' AND numero = 105");
        $this->view->tipoinstitucion = $tipoinstitucion;

        $universidades = Universidades::find("estado = 'A' ORDER BY universidad ASC");
        $this->view->universidades = $universidades;

        $admision = Admision::findFirst("activo = 'M'");
        $this->view->admision = $admision;



        $this->assets->addJs("adminpanel/js/viewsweb/login.enae.js?v=" . uniqid());
    }

    public function loginEnaeAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                $nro_doc_login = $this->request->getPost('nro_doc_login', 'string');
                $password = $this->request->getPost('password_login', 'string');

                $where = " estado = 'A' AND nro_doc = '{$nro_doc_login}'";

                // print("llega: ".$where);
                // exit();

                $user = Publico::findFirst($where);



                if ($user) {

                    $pass = $user->password;

                    $nombre_perfil = 'PUBLICO A';
                    $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                    $codigo_perfil = $Perfil->id;

                    /* Desencryptar */
                    if ($this->security->checkHash($password, $pass)) {
                        $this->session->set('auth', [
                            'codigo' => $user->codigo,
                            'nombres' => $user->nombres,
                            'nombre_perfil' => $nombre_perfil,
                            'perfil' => $codigo_perfil,
                            'nro_doc' => $user->nro_doc,
                            'tipo' => 5,
                        ]);

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "yes"));
                    } else {

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "no"));
                    }
                    $this->response->send();
                } else {
                    $this->response->setJsonContent(array("say" => "no_existe"));
                    $this->response->send();
                }
            } else {

                $this->response->setStatusCode(404);
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function savePostulanteEnaeAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {
            try {

                //                 echo "<pre>";
                // print_r($_POST);
                // exit();

                $publicoEnae = new PublicoAspefeen();
                $publicoEnae->tipo = 0;

                if ($this->request->getPost("documento", "int") == "") {
                    $publicoEnae->documento = null;
                } else {
                    $publicoEnae->documento = $this->request->getPost("documento", "int");
                }

                $publicoEnae->nro_doc = $this->request->getPost("nro_doc", "string");
                $publicoEnae->email = $this->request->getPost("email", "string");
                $publicoEnae->apellidop = strtoupper($this->request->getPost("apellidop"));
                $publicoEnae->apellidom = strtoupper($this->request->getPost("apellidom"));
                $publicoEnae->nombres = strtoupper($this->request->getPost("nombres"));


                if ($this->request->getPost("sexo", "int") == "") {
                    $publicoEnae->sexo = null;
                } else {
                    $publicoEnae->sexo = $this->request->getPost("sexo", "int");
                }


                if ($this->request->getPost("id_universidad", "int") == "") {
                    $publicoEnae->id_universidad = null;
                } else {
                    $publicoEnae->id_universidad = $this->request->getPost("id_universidad", "int");
                }
                // $publicoEnae->institucion = $this->request->getPost("institucion", "string");

                if ($this->request->getPost("categoria", "int") == "") {
                    $publicoEnae->categoria = null;
                } else {
                    $publicoEnae->categoria = $this->request->getPost("categoria", "int");
                }
                $publicoEnae->escuela = $this->request->getPost("escuela", "string");

                $passwordPostulante = $this->request->getPost("password", "string");
                if ($passwordPostulante === "") {
                    $this->response->setJsonContent(array("say" => "password_vacio"));
                    $this->response->send();
                    exit();
                } else {
                    $publicoEnae->password = $this->security->hash($passwordPostulante);
                }

                $publicoEnae->estado = "A";

                $publicoEnae->celular = $this->request->getPost("celular", "string");
                $publicoEnae->ciudad = $this->request->getPost("ciudad", "string");
                $publicoEnae->colegio_profesional_nro = $this->request->getPost("colegio_profesional_nro", "string");

                $foto = $_FILES['foto']['name'];
                $formatosFoto = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                $fileFoto = $foto;

                $extension = pathinfo($fileFoto, PATHINFO_EXTENSION);

                if (in_array($extension, $formatosFoto)) {
                    $publicoEnae->foto = $this->request->getPost("foto", "string");
                } else {

                    $this->response->setJsonContent(array("say" => "error_foto"));
                    $this->response->send();
                    exit();
                }

                $archivo = $_FILES['archivo']['name'];
                $formatos_archivo = array('pdf', 'PDF');
                $fileArchivo = $archivo;

                $extension = pathinfo($fileArchivo, PATHINFO_EXTENSION);

                if (in_array($extension, $formatos_archivo)) {
                    $publicoEnae->archivo = $this->request->getPost("archivo", "string");
                } else {
                    $this->response->setJsonContent(array("say" => "error_archivo"));
                    $this->response->send();
                    exit();
                }

                $archivoEscuela = $_FILES['archivo_escuela']['name'];
                $formatosArchivoEscuela = array('pdf', 'PDF');
                $fileArchivoEscuela = $archivoEscuela;

                $extension = pathinfo($fileArchivoEscuela, PATHINFO_EXTENSION);

                if (in_array($extension, $formatosArchivoEscuela)) {
                    $publicoEnae->archivo_escuela = $this->request->getPost("archivo_escuela", "string");
                } else {
                    $this->response->setJsonContent(array("say" => "error_archivo_escuela"));
                    $this->response->send();
                    exit();
                }

                $publicoEnae->fecha_reg = date('Y-m-d H:i:s');

                if ($publicoEnae->save() == false) {
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent($publicoEnae->getMessages());
                } else {

                    if ($this->request->hasFiles() == true) {
                        // Print the real file names and sizes
                        foreach ($this->request->getUploadedFiles() as $file) {

                            if ($file->getKey() == "archivo") {

                                if ($_FILES['archivo']['name'] !== "") {
                                    $formatos_archivo = array('PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-DNI' . '-' . $publicoEnae->codigo . "." . $extension;
                                        $publicoEnae->archivo = 'FILE-DNI' . '-' . $publicoEnae->codigo . "." . $extension;

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_nro_doc"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "archivo_escuela") {

                                if ($_FILES['archivo_escuela']['name'] !== "") {
                                    $formatos_archivo = array('PDF', 'pdf');

                                    $file_archivo = $_FILES['archivo_escuela']['name'];

                                    $extension = pathinfo($file_archivo, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_archivo)) {

                                        $url_destino = 'adminpanel/archivos/publico/personales/' . 'FILE-CGT' . '-' . $publicoEnae->codigo . "." . $extension;
                                        $publicoEnae->archivo_escuela = 'FILE-CGT' . '-' . $publicoEnae->codigo . "." . $extension;

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_archivo_escuela"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }

                            if ($file->getKey() == "foto") {

                                if ($_FILES['foto']['name'] !== "") {
                                    $formatos_imagenes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                                    $file_imagen = $_FILES['foto']['name'];

                                    $extension = pathinfo($file_imagen, PATHINFO_EXTENSION);

                                    if (in_array($extension, $formatos_imagenes)) {

                                        $url_destino = 'adminpanel/imagenes/publico/personales/' . 'IMG' . '-' . $publicoEnae->codigo . '.' . $extension;
                                        $publicoEnae->foto = 'IMG' . '-' . $publicoEnae->codigo . '.' . $extension;

                                        $file->moveTo($url_destino);
                                    } else {

                                        $this->response->setJsonContent(array("say" => "error_image"));
                                        $this->response->send();
                                        exit();
                                    }
                                }
                            }
                        }

                        $publicoEnae->save();
                    }
                    $this->response->setStatusCode(200, "OK");
                    $this->response->setJsonContent(array("say" => "yes"));
                }
            } catch (Exception $ex) {
                $this->response->setContent($ex->getMessage());
                $this->response->setStatusCode(500);
            }
        } else {
            $this->response->setStatusCode(404);
        }
        $this->response->send();
    }

    public function web_consulta_admisionAction()
    {

        $tipo_resolucion = "";
        $anio_tramite = "";
        $full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


        $where = "";
        if ($this->request->isGet()) {

            if (isset($_GET["nro_doc"]) && $_GET["nro_doc"] != "") {
                $nroDoc = $this->request->getQuery("nro_doc", "int");
                $where = $where . " public.publico.nro_doc = '$nroDoc'";
            }
        }

        if (isset($_GET["page"])) {
            $currentPage = (int) $_GET['page'];
        } else {
            $currentPage = 1;
        }

        //print $where ; exit();

        $db = $this->db;
        $sql_query = "SELECT
        public.admision_supervisores.link_simulacro,
        public.admision_supervisores.link_examen,
        public.admision_supervisores.link_plataforma_lms,
        public.admision_postulantes.password,
        public.admision_postulantes.grupo,
        public.publico.apellidop,
        public.publico.apellidom,
        public.publico.nombres,
        public.publico.nro_doc,
        public.publico.codigo,
        public.admision_postulantes.proceso,
        public.admision_postulantes.observaciones
        FROM
        public.admision_postulantes
        INNER JOIN public.admision_supervisores ON public.admision_supervisores.id_supervisor = public.admision_postulantes.supervisor AND public.admision_supervisores.grupo = public.admision_postulantes.grupo
        INNER JOIN public.publico ON public.publico.codigo = public.admision_postulantes.postulante
        WHERE
        $where";

        // print_r($sql_query);
        // exit();

        $result = "";
        $mensaje = "";
        // print_r($documentos->id_doc);
        // exit();

        if ($this->request->isGet()) {

            if (isset($_GET["nro_doc"]) && $_GET["nro_doc"] != "") {
                $result = $db->fetchOne($sql_query, Phalcon\Db::FETCH_OBJ);

                // print(count($documentos));
                // exit();

                if ($result) {
                    // print("Se envia resultado");
                    // exit();
                    $this->view->result = $result;
                } else {
                    //             print("No se envia resultado");
                    // exit();
                    $mensaje = "Ud. no esta apto para el ENAE...";
                }
            }
        }

        $this->view->result = $result;
        $this->view->mensaje = $mensaje;
        $this->view->nroDoc = $nroDoc;
        $this->view->full_url = $full_url;

        $procesosPostulantes = ProcesosPostulantes::find(
            [
                "estado = 'A' AND numero = 106",
                'order' => 'codigo ASC',
            ]
        );
        $this->view->procesosPostulantes = $procesosPostulantes;
        $this->assets->addJs("adminpanel/js/viewsweb/consulta.admision.js?v=" . uniqid());
    }


    public function login_supervisoresAction()
    {

        $tipoDocumentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");

        $this->view->tipodocumentos = $tipoDocumentos;

        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        $categoriaPostulante = CategoriaPostulante::find(
            [
                "estado = 'A' AND numero = 104",
                'order' => 'codigo ASC',
            ]
        );
        $this->view->categoriapostulante = $categoriaPostulante;

        $tipoinstitucion = TipoInstitucion::find("estado = 'A' AND numero = 105");
        $this->view->tipoinstitucion = $tipoinstitucion;

        $this->assets->addJs("adminpanel/js/viewsweb/login.supervisores.js?v=" . uniqid());
    }

    public function loginSupervisoresAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                $nro_doc_login = $this->request->getPost('nro_doc_login', 'string');
                $password = $this->request->getPost('password_login', 'string');

                $where = " estado = 'A' AND nro_doc = '{$nro_doc_login}'";
                $user = Supervisores::findFirst($where);

                if ($user) {

                    $pass = $user->password;

                    $nombre_perfil = 'SUPERVISORES A';
                    $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                    $codigo_perfil = $Perfil->id;

                    /* Desencryptar */
                    if ($this->security->checkHash($password, $pass)) {
                        $this->session->set('auth', [
                            'id' => $user->id_supervisor,
                            'nombres' => $user->nombres,
                            'nombre_perfil' => $nombre_perfil,
                            'perfil' => $codigo_perfil,
                            'nro_doc' => $user->nro_doc,
                            'tipo' => 5,
                        ]);

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "yes"));
                    } else {

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "no"));
                    }
                    $this->response->send();
                } else {
                    $this->response->setJsonContent(array("say" => "no_existe"));
                    $this->response->send();
                }
            } else {

                $this->response->setStatusCode(404);
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }


    //-----login-fiscalia.html--------------------------------------
    public function login_fiscaliaAction()
    {



        $this->assets->addJs("adminpanel/js/viewsweb/login.fiscalia.js?v=" . uniqid());
    }

    public function loginFiscaliaAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                $nro_doc_login = $this->request->getPost('nro_doc_login', 'string');
                $password = $this->request->getPost('password_login', 'string');

                $where = " estado = 'A' AND nro_doc = '{$nro_doc_login}'";
                $user = FscFiscales::findFirst($where);

                if ($user) {

                    $pass = $user->password;

                    $nombre_perfil = 'PUBLICO F';
                    $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                    $codigo_perfil = $Perfil->id;

                    /* Desencryptar */
                    if ($this->security->checkHash($password, $pass)) {
                        $this->session->set('auth', [
                            'codigo' => $user->id_fiscal,
                            'nombres' => $user->nombres,
                            'nombre_perfil' => $nombre_perfil,
                            'perfil' => $codigo_perfil,
                            'nro_doc' => $user->nro_doc,
                            'tipo' => 8,
                        ]);

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "yes"));
                    } else {

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "no"));
                    }
                    $this->response->send();
                } else {
                    $this->response->setJsonContent(array("say" => "no_existe"));
                    $this->response->send();
                }
            } else {

                $this->response->setStatusCode(404);
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function recuperarcontrasenhaweb8Action()
    {
        //recuperarcontrasenha3.js
        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenhaweb8.js?v=" . uniqid());
    }

    public function recuperarcontrasenhalogin8Action()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //recojemos el campo email del post
            $email = $this->request->getPost('email');

            // echo '<pre>';
            // print_r($email);
            // exit();
            //5 Publico y 6 Postulantes

            $model = FscFiscales::findFirst(
                [
                    "email = :email: AND estado = :estado: ",
                    'bind' => [
                        'email' => $email,
                        'estado' => "A",
                    ],
                ]
            );

            // echo '<pre>';
            // print_r($model->email);
            // exit();

            //Envio de mensaje
            if ($model !== false) {

                $text = "" . $model->nro_doc;
                $encrypt = base64_encode($text);
                //$encrypt = $text;

                $length = 7;
                $temporal_rand = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);

                $link = $this->url->getBaseUri() . "recuperarc8/" . $encrypt . $temporal_rand;
                //print $link."<br>";
                // print base64_decode($encrypt);
                // exit();
                $from = $this->config->mail->from;
                $text_body = " Para recuperar su clave ingrese al siguiente enlace " . $link;

                $mailer = new mailer($this->di);
                $mailer->setSubject(" Recuperar Clave ({$this->config->global->xAbrevIns})");
                $mailer->setFrom($from);
                $mailer->setTo($email, $from);
                $mailer->setBody($text_body);
                if ($mailer->send()) {
                    //return true;
                } else {
                    echo $mailer->getError();
                    echo "error";
                }

                //$msg = "En enlace para recuperar su clava fue enviada a su correo " . $email . " , si "
                //        . "no encuentra el mensaje porfavor revise en la seccion 'SPAM o Correo No Deseado' ";
                $msg = "si";
            } else {
                //$msg = "No existe ningun Usuario registrado con este Email";
                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function recuperarc8Action($secret_id)
    {

        $secret_id_0 = explode("=", $secret_id);
        $secret_id_nuevo = $secret_id_0[0];

        //print("Codigo Base64:".$secret_id_nuevo);
        //exit();
        //$personal_email1 = base64_decode($secret_id);

        $nro_documento = $secret_id_nuevo;
        $this->view->secret_id = $nro_documento;

        //recuperarcontrasenha.js
        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenha8.js?v=" . uniqid());
    }

    public function recuperarc8enlaceAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //Capturamos la url encryptada
            $secret_id = $this->request->getPost('secret_id');
            $nro_documento = base64_decode($secret_id);

            $pass = $this->request->getPost('password');
            $pass_repeat = $this->request->getPost('password_repeat');

            if ($pass == $pass_repeat) {

                //print($nro_documento);
                //exit();

                $model = FscFiscales::findFirstBynro_doc($nro_documento);

                $pass_bcrypt = $this->request->getPost("password_repeat");
                $model->password = $this->security->hash($pass_bcrypt);

                if ($model->save() == false) {

                    print("Error");
                    exit();

                    $msg = "Error Al intentar Recuperar su contraseña";
                } else {
                    //$msg = "Su contraseña fue cambiada con éxito <br>"
                    //. ' <a class="btn btn-md btn-block u-btn-success g-py-13" href="' . $this->url->getBaseUri() . "web/sesiones" . '"  >Ir al Login</a> ';
                    $msg = "si";
                }
            } else {
                //$msg = "La contraseña enviada es distinta a la de confirmacion , intentelo uevamente";
                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function login_convocatorias_docentesAction()
    {

        $tipo_documentos = TipoDocumento::find("estado = 'A' AND numero = 1 ");
        $this->view->tipodocumentos = $tipo_documentos;

        $ColegioProfesional = ColegioProfesional::find("estado = 'A' AND numero = 85 ORDER BY orden");
        $this->view->colegioprofesional = $ColegioProfesional;

        //estado_civil
        $estado_civil = EstadoCivil::find("estado = 'A' AND numero = 26 ");
        $this->view->estadocivil = $estado_civil;

        //sexo
        $sexo = Sexo::find("estado = 'A' AND numero = 3 ");
        $this->view->sexo = $sexo;

        //Region
        $regiones = Regiones::find("estado = 'A' ");
        $this->view->regiones = $regiones;

        //tipobonificacion
        $tipobonificaciones = TipoBonificaciones::find("estado = 'A' AND numero = 134 ORDER BY orden ASC");

        // foreach ($tipobonificaciones as $key => $value) {
        //     echo "<pre>";
        //     print_r($value->codigo);
        //     print_r($value->nombres);
        // }
        // exit();

        $this->view->tipobonificaciones = $tipobonificaciones;

        $this->assets->addJs("adminpanel/js/viewsweb/login.convocatorias.docentes.js?v=" . uniqid());
    }


    public function loginConvocatoriasDocentesAction()
    {
        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {



            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                $nro_doc_login = $this->request->getPost('nro_doc_login', 'string');
                $password = $this->request->getPost('password_login', 'string');

                $where = " estado = 'A' AND nro_doc = '" . $nro_doc_login . "'";
                $user = Publico::findFirst($where);



                if ($user) {

                    $pass = $user->password;
                    /* Desencryptar */
                    $nombre_perfil = 'DOCENTES CONVOCATORIAS';
                    $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                    $codigo_perfil = $Perfil->id;

                    if ($this->security->checkHash($password, $pass)) {

                        $this->session->set('auth', [
                            'codigo' => $user->codigo,
                            'nombres' => $user->nombres,
                            'nombre_perfil' => $nombre_perfil,
                            'perfil' => $codigo_perfil,
                            'nro_doc' => $user->nro_doc,
                            'tipo' => 2,
                        ]);

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("msg" => "yes", "say" => "yes", "success" => true));
                    } else {

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "no", "msg" => "Contraseña incorrecta, intentelo nuevamente", "success" => false));
                    }
                    $this->response->send();
                } else {
                    $this->response->setJsonContent(array("say" => "no", "msg" => "Credenciales no registradas , intentelo uevamente", "success" => false));
                    $this->response->send();
                }
            } else {


                $this->response->setStatusCode(404);
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function login_concursos_easAction()
    {
        $this->assets->addJs("adminpanel/js/viewsweb/login.concursos.rsu.js?v=" . uniqid());
    }
    public function login_concursos_ibaAction()
    {
        $this->assets->addJs("adminpanel/js/viewsweb/login.concursos.rsu.js?v=" . uniqid());
    }
    public function login_concursos_ihAction()
    {
        $this->assets->addJs("adminpanel/js/viewsweb/login.concursos.rsu.js?v=" . uniqid());
    }
    public function login_concursos_itAction()
    {
        $this->assets->addJs("adminpanel/js/viewsweb/login.concursos.rsu.js?v=" . uniqid());
    }
    public function login_concursos_seAction()
    {
        $this->assets->addJs("adminpanel/js/viewsweb/login.concursos.rsu.js?v=" . uniqid());
    }

    public function login_concursos_rsuAction()
    {
        $this->assets->addJs("adminpanel/js/viewsweb/login.concursos.rsu.js?v=" . uniqid());
    }


    public function loginConcursosRsuAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                $nro_doc_login = $this->request->getPost('nro_doc_login', 'string');
                $password = $this->request->getPost('password_login', 'string');

                $where = " estado = 'A' AND nro_doc = '" . $nro_doc_login . "'";
                $user = Docentes::findFirst($where);

                if ($user) {

                    $pass = $user->password;
                    /* Desencryptar */
                    $nombre_perfil = 'DOCENTES CONCURSOS RSU';
                    $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                    $codigo_perfil = $Perfil->id;

                    if ($this->security->checkHash($password, $pass)) {

                        $this->session->set('auth', [
                            'codigo' => $user->codigo,
                            'nombres' => $user->nombres,
                            'nombre_perfil' => $nombre_perfil,
                            'perfil' => $codigo_perfil,
                            'nro_doc' => $user->nro_doc,
                            /*'tipo' => 2,*/
                        ]);

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "yes"));
                    } else {

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "no"));
                    }
                    $this->response->send();
                } else {

                    $this->response->setJsonContent(array("say" => "no_existe"));
                    $this->response->send();
                }
            } else {


                $this->response->setStatusCode(404);
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }


    public function login_ratificacion_docentesAction()
    {

        $this->assets->addJs("adminpanel/js/viewsweb/login.ratificacion.docentes.js?v=" . uniqid());
    }

    public function loginRatificacionDocentesAction()
    {
        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {



            if ($this->security->checkToken("csrf", $this->request->getPost('csrf'))) {

                $nro_doc_login = $this->request->getPost('nro_doc_login', 'string');
                $password = $this->request->getPost('password_login', 'string');
                $token = $this->request->getPost('token', 'string');
                $action = $this->request->getPost('action', 'string');



                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => '6LetFsokAAAAACVECLCM1m6gyOJjUaevM-FeIhed', 'response' => $token)));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                $arrResponse = json_decode($response, true);

                $where = " estado = 'A' AND nro_doc = '" . $nro_doc_login . "'";
                $user = Publico::findFirst($where);


                if ($user) {

                    $pass = $user->password;
                    /* Desencryptar */
                    $nombre_perfil = 'DOCENTES RATIFICACION';
                    $Perfil = Perfil::findFirstByper_descripcion($nombre_perfil);
                    $codigo_perfil = $Perfil->id;

                    if ($this->security->checkHash($password, $pass)) {

                        $this->session->set('auth', [
                            'codigo' => $user->codigo,
                            'nombres' => $user->nombres,
                            'nombre_perfil' => $nombre_perfil,
                            'perfil' => $codigo_perfil,
                            'nro_doc' => $user->nro_doc,
                            'tipo' => 2,
                        ]);

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("msg" => "yes", "say" => "yes", "success" => true));
                    } else {

                        $this->response->setStatusCode(200, "OK");
                        $this->response->setJsonContent(array("say" => "no", "msg" => "Contraseña incorrecta, intentelo nuevamente", "success" => false));
                    }
                    $this->response->send();
                } else {
                    $this->response->setJsonContent(array("say" => "no", "msg" => "Credenciales no registradas , intentelo uevamente", "success" => false));
                    $this->response->send();
                }
            } else {
                $this->response->setStatusCode(404);
            }
        } else {
            $this->response->setStatusCode(404);
        }
    }

    public function web_mallas_curricularesAction()
    {

        $carreras = Carreras::find("estado = 'A'");
        $this->view->carreras = $carreras;

        $this->assets->addJs("adminpanel/js/viewsweb/mallas.curriculares.js?v=" . uniqid());
    }

    public function listarCurriculasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $carrera = $this->request->getPost('carrera');

            $curriculas = Curriculas::find("carrera = '$carrera' AND estado = 'A'");

            if ($curriculas) {
                $this->response->setJsonContent($curriculas->toArray());
                $this->response->send();
            } else {
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }


    public function listarAsignaturasAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            $curricula = $this->request->getPost('curricula');
            $numberPage = $this->request->getQuery("page", "int", 1);

            $where = "curricula = '$curricula'";
            $asignaturas = $this->modelsManager->createBuilder()
                ->from('Asignaturas')
                ->columns('Asignaturas.codigo,
        Asignaturas.curricula,
        Asignaturas.nivel,
        Asignaturas.ciclo,
        Asignaturas.tipo,
        Asignaturas.nombre,
        Asignaturas.creditos,
        Asignaturas.pr1,
        Asignaturas.pr2,
        Asignaturas.pr3,
        Asignaturas.prhm,
        Asignaturas.ht,
        Asignaturas.hp,
        Asignaturas.observaciones,
        Asignaturas.tipoe,
        Asignaturas.estado')
                ->where($where)
                ->orderBy('Asignaturas.nombre ASC')
                ->getQuery()
                ->execute();
            $data = $asignaturas;


            // foreach ($data as $key => $value) {
            //     print_r($value->nombre."<br>");
            // }
            // exit();


            $paginator = new PaginatorModel(
                [
                    'data' => $data,
                    'limit' => 5,
                    'page' => $numberPage,
                ]
            );


            $page = $paginator->getPaginate();

            if ($page) {
                $this->response->setJsonContent($page->toArray());
                $this->response->send();
            } else {
                $this->response->setJsonContent(array("say" => "no"));
                $this->response->send();
            }
        } else {
            $this->response->setStatusCode(500);
        }
    }

    public function datatableAsignaturasAction($curricula)
    {
        $this->view->disable();
        if ($this->request->isPOST() && $this->request->isAjax()) {
            $datatable = new Datatables($this->di);
            $datatable->setColumnaId("a.codigo");
            $datatable->setSelect("a.codigo, a.nombre, cu.descripcion as curricula,"
                . " a.ciclo, a.ht, a.hp, a.tipo, a.creditos, "
                . "a.estado,t_a.nombres AS tipo_asignatura");
            //$datatable->setFrom("asignaturas a INNER JOIN curriculas cu ON a.curricula = cu.codigo");
            $datatable->setFrom("asignaturas a
                INNER JOIN curriculas cu ON a.curricula = cu.codigo
                INNER JOIN a_codigos t_a ON t_a.codigo = a.tipo
                ");
            //$datatable->setWhere(" (a.estado = 'A') AND (a.codigo > 0) ");
            $datatable->setWhere("(a.estado = 'A') AND (a.nivel > 0) AND t_a.numero = 71 AND a.curricula = '$curricula'");
            $datatable->setOrderby("cu.descripcion, a.ciclo, a.codigo ASC");
            $datatable->setParams($_POST);
            $datatable->getJson();
        }
    }


    public function recuperarcontrasenhawebtramitedocumentarioAction()
    {

        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenhawebexterno.js?v=" . uniqid());
    }

    public function recuperarContrasenhaTramiteDocumentarioAction()
    {
        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            //recojemos el campo email del post
            $email = $this->request->getPost('email');

            //Publico
            $publico = EmpresaPublico::findFirst(
                [
                    "email = :email: AND estado = :estado: ",
                    'bind' => [
                        'email' => $email,
                        'estado' => "A",
                    ],
                ]
            );

            if ($publico !== false) {

                // print("Llega cuando es publico");
                // exit();

                $text = "" . $publico->email;
                $encrypt = base64_encode($text);
                //$encrypt = $text;
                //$temporal_rand = mt_rand(1000000, 9999999);

                $length = 16;
                $temporal_rand = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);

                $link = $this->url->getBaseUri() . "recuperarc9/" . $encrypt . "=" . $temporal_rand;
                // print $link."<br>";
                // print base64_decode($encrypt);
                // exit();
                $from = $this->config->mail->from;
                $text_body = " Para recuperar su clave ingrese al siguiente enlace " . $link;

                $mailer = new mailer($this->di);
                $mailer->setSubject(" Recuperar Clave ({$this->config->global->xAbrevIns})");
                $mailer->setFrom($from);
                $mailer->setTo($email, $from);
                $mailer->setBody($text_body);
                if ($mailer->send()) {
                    //return true;
                } else {
                    echo $mailer->getError();
                    echo "error";
                }

                //$msg = "En enlace para recuperar su clava fue enviada a su correo " . $email . " , si "
                //        . "no encuentra el mensaje porfavor revise en la seccion 'SPAM o Correo No Deseado' ";
                $msg = "si";
            } else {
                //$msg = "No existe ningun Usuario registrado con este Email";
                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }


    public function recuperarc9Action($secret_id)
    {

        //echo"<pre>";        print_r("Entro");exit();
        //date_default_timezone_set('America/Lima');
        //echo date("H:m:s");exit();
        //print("Codigo Base64:".$secret_id);
        //exit();

        $secret_id_0 = explode("=", $secret_id);
        $secret_id_nuevo = $secret_id_0[0];

        //print("Codigo Base64:".$secret_id_nuevo);
        //exit();
        //$personal_email1 = base64_decode($secret_id);

        $email = $secret_id_nuevo;
        $this->view->secret_id = $email;

        //recuperarcontrasenha.js
        $this->assets->addJs("adminpanel/js/viewsweb/recuperarcontrasenha9.js?v=" . uniqid());
    }

    public function recuperarc9enlaceAction()
    {

        $this->view->disable();
        if ($this->request->isPost() && $this->request->isAjax()) {

            // echo "<pre>";
            // print_r($_POST);
            // exit();

            //Capturamos la url encryptada
            $secret_id = $this->request->getPost('secret_id');
            $nroDOc = base64_decode($secret_id);

            // print($nroDOc);
            // exit();

            $pass = $this->request->getPost('password');
            $pass_repeat = $this->request->getPost('password_repeat');

            if ($pass == $pass_repeat) {
                $EmpresaPublico = EmpresaPublico::findFirstByemail($nroDOc);

                $pass_bcrypt = $this->request->getPost("password_repeat");
                $EmpresaPublico->password = $this->security->hash($pass_bcrypt);

                //print($EmpresaPublico->password);
                //exit();

                if ($EmpresaPublico->save() == false) {

                    //                    print("@Kenmack");
                    //                    exit();

                    $msg = "Error Al intentar Recuperar su contraseña";
                } else {
                    //$msg = "Su contraseña fue cambiada con éxito <br>"
                    //. ' <a class="btn btn-md btn-block u-btn-success g-py-13" href="' . $this->url->getBaseUri() . "web/sesiones" . '"  >Ir al Login</a> ';
                    $msg = "si";
                }
            } else {
                //$msg = "La contraseña enviada es distinta a la de confirmacion , intentelo uevamente";
                $msg = "no";
            }

            $this->response->setStatusCode(200, "OK");
            $this->response->setJsonContent(array("mensaje_envio" => $msg));
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
        }
    }
    public function politica_privacidadAction()
    {
        $this->view->test = "hola";
    }
}
