<?php

use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class WebadmisionController extends ControllerBase
{

    public function initialize()
    {

        $this->tag->setTitle('Yurimaguas');
        //$this->view->setTemplateAfter('webbolsatrabajo');
        parent::initialize();

        //echo "<pre>";
        //print_r($_SESSION); exit();
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
            ->where("Sliders.estado ='B'")
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

    }

    public function admisionAction()
    {
    }

    public function presentacion_admisionAction()
    {
    }

    public function comision_admisionAction()
    {
    }

    public function perfil_estudianteAction()
    {
    }

    public function modalidad_ordinarioAction()
    {
    }

    public function modalidad_extraordinarioAction()
    {
    }

    public function resultadosAction()
    {
    }

    public function vacantesAction()
    {
    }
 
    public function cronogramaAction()
    {
    }

   
    public function proceso_admisionAction()
    {
    }

    public function costosAction()
    {
    }
   
    public function temarioAction()
    {
    }

    public function prospectoAction()
    {
    }

    public function examen_ordinarioAction()
    {
    }
   
    public function examen_extraordinarioAction()
    {
    }
   
    public function recomendaciones_examenAction()
    {
    }
   
    public function preguntas_frecuentesAction()
    {
    }
    

    /*
    public function documentos_admisionAction()
    {
    }
    */

    public function documentos_admisionAction()
    {
        
        //Cargamos el modelo de las convocatorias
        //$convocatoria = Convocatorias::findFirstByid_convocatoria((int) $id);
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
            ->where("Convocatorias.estado='A' and ConvocatoriasDetalles.estado ='A' and Convocatorias.id_convocatoria= (76) ")
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
  

}
