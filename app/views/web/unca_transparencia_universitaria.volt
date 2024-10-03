{% block content %}
<div class="ms-hero-page mb-6 ms-hero-bg-primary ms-hero-img-coffee" style="height: 70px !important;">
    <div class="container">
        <div class="text-left">
            <h2 style="color: #757575; margin-top: -15px !important;">
                {{ config.global.xSeparadorIns }} 
                Portal de Transparencia Universitaria
            </h2>
        </div>
    </div>
</div>
<div class="container container-full" style ="margin-top: -50px;">
    <div class="ms-paper">
        <div class="row">
            <?php $this->partial('shared/menu1'); ?>
            <!-- CENTER -->
            <div class="col-lg-9 col-md-9 col-sm-9 order-sm-2 order-md-2 order-lg-2" style ="margin-top: 20px;">		
                <div class="card card-primary">
                    <div class="card-header">
                           <h3 class="card-title"><span>Portal de Transparencia Universitaria - Ley Universitaria N° 30220 - Articulo 11°</span></h4>
                    </div>
                    <div class="card-body">
                        

                        <div class="container-fluid">
                            <h3>GOBIERNO Y GESTIÓN</h3>
                            <div>
                                <button class="btn-arcjas" id="btn-informacion" data-target="#informacion">
                                    <span>
                                        <div class="icono">
                                            <i class="fa fa-bank fa-3x pt-3" aria-hidden="true"></i>
                                        </div>
                                        <span>Información General</span>
                                    </span>
                                </button>

                                <button class="btn-arcjas" id="btn-documentos" data-target="#documentos">
                                    <span>
                                        <div class="icono">
                                            <i class="fa fa-files-o fa-3x pt-3" aria-hidden="true"></i>
                                        <div>
                                        Documentos de Gestión
                                    </span>
                                </button>

                                <button class="btn-arcjas" id="btn-actas" data-target="#actas">
                                    <span>
                                        <div class="icono">
                                            <i class="fa fa-file-text fa-3x pt-3" aria-hidden="true"></i>
                                        <div>
                                        Registro de Actas
                                    </span>
                                </button>


                                <button class="btn-arcjas" id="btn-resoluciones" data-target="#resoluciones">
                                    <span>
                                        <div class="icono">
                                            <i class="fa fa-file-text-o fa-3x pt-3" aria-hidden="true"></i>
                                        <div>
                                        Registro de Resoluciones
                                    </span>
                                </button>

                               
                            </div>

                            <!--informacion general-->
                            <div class="accordion " id="informacion">
                              
                                    <div class="accordion-item">
                                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_mision" data-target="#panel_mision">Misión y Visión</div>
                                        <div class="accordion-content collapse" id="panel_mision">
                                            <div class="table-responsive">
                                                <table id="table" width="100%">
                                                    <thead>
                                                        <tr style="background: #135bbb; color: white;">
                                                           
                                                            <th style="width: 50%;">Misión</th>
                                                            <th style="width: 5%;""></th>                                                            
                                                            <th style="width: 50%;">Visión</th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>                                                           
                                                            <th style="font-weight:normal; font-size: 12px; text-align: justify;">“Formar profesionales de alta calidad, generando conocimiento a través de la investigación, desarrollo e innovación tecnológica, con enfoque ético y responsabilidad social para enfrentar los retos del desarrollo sostenible del país”</th>
                                                            <th style="font-weight:normal; font-size: 12px; text-align: justify;"></th>
                                                            <th style="font-weight:normal; font-size: 12px; text-align: justify;">“Todos los peruanos acceden a una educación que les permite desarrollar su potencial desde la primera infancia y convertirse en ciudadanos que valoran su cultura, conocen sus derechos y responsabilidades, desarrollan sus talentos y participan de manera innovadora, competitiva y comprometida en las dinámicas sociales, contribuyendo al desarrollo de sus comunidades y del país en su conjunto”</th>                                                            
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="accordion-item">
                                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_directorio" data-target="#panel_directorio">Directorio</div>
                                        <div class="accordion-content collapse" id="panel_directorio">
                                            <div class="table-responsive">
                                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Directorio - UNCA</th>
                                                            <th>Ingresar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</th>
                                                            <td>Comisión Organizadora</td>
                                                            <td>
                                                                <a href="{{ url('web-comision-organizadora.html') }}" target="_blank">
                                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                                </a>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>2</th>
                                                            <td>Docentes</td>
                                                            <td>
                                                                <a href="{{ url('web-directorio-docentes.html') }}" target="_blank">
                                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                                </a>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>3</td>
                                                            <td>Administrativos</td>
                                                            <td>
                                                                <a href="{{ url('web-directorio-administrativos.html') }}" target="_blank">
                                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                                </a>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="accordion-item">
                                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_marco" data-target="#panel_marco">Marco Legal</div>
                                        <div class="accordion-content collapse" id="panel_marco">
                                            <div class="table-responsive">
                                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Documento</th>
                                                            <th>Ingresar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</th>
                                                            <td>CONSTITUCIÓN POLÍTICA DEL PERÚ</td>
                                                            <td>
                                                                <a href="{{ url('https://cdn.www.gob.pe/uploads/document/file/198518/Constitucion_Politica_del_Peru_1993.pdf?v=1594239946') }}" target="_blank">
                                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                                </a>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>2</th>
                                                            <td>LEY UNIVERSITARIA Nº 30220</td>
                                                            <td>
                                                                <a href="{{ url('https://www.unca.edu.pe/web-documentos/ley-universitaria-30220.html') }}" target="_blank">
                                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                                </a>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>3</th>
                                                            <td>LEY Nº 27806 - TRANSPARENCIA Y ACCESO A LA INFORMACIÓN PÚBLICA</td>
                                                            <td>
                                                                <a href="{{ url('https://transparencia.utea.edu.pe/download/EJE-GOBIERNO-Y-GESTION/INFORMACION-GENERAL/MARCO-LEGAL/LEY_27806.pdf') }}" target="_blank">
                                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                                </a>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>4</td>
                                                            <td>LEY 29756 - CREACIÓN DE LA UNIVERSIDAD NACIONAL CIRO ALEGRÍA N°</td>
                                                            <td>
                                                                <a href="{{ url('https://www.unca.edu.pe/web-documentos/ley-29756-que-crea-la-universidad-nacional-ciro-alegria-unca.html') }}" target="_blank">
                                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                                </a>
                                                            </td>
                                                        </tr>

                                                       


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>





                                    <div class="accordion-item">
                                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_convenios" data-target="#panel_convenios">Convenios Interinstitucionales</div>
                                        <div class="accordion-content collapse" id="panel_convenios">
                                            <div class="table-responsive">
                                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Convenios</th>
                                                            <th>Ingresar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</th>
                                                            <td>Convenios de la Universidad Nacional Ciro Alegría</td>
                                                            <td>
                                                                <a href="{{ url('web-convenios.html') }}" target="_blank">
                                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                                </a>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>



                            </div>


                            <!--documentos de gestion-->

                            <div class="accordion" id="documentos">
                              
                                <div class="accordion-item">
                                    <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_estatuto" data-target="#panel_estatuto">Estatuto</div>
                                    <div class="accordion-content collapse" id="panel_estatuto">
                                        <div class="table-responsive">
                                            <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Documento</th>
                                                        <th>Ingresar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</th>
                                                        <td>Estatuto de la Universidad Nacional Ciro Alegría</td>
                                                        <td>
                                                            <a href="{{ url('web-documentos/estatuto.html') }}" target="_blank">
                                                                <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item">
                                    <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_organigrama" data-target="#panel_organigrama">Organigrama Institucional</div>
                                    <div class="accordion-content collapse" id="panel_organigrama">
                                        <div class="table-responsive">
                                            <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Documento</th>
                                                        <th>Ingresar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</th>
                                                        <td>Organigrama Institucional</td>
                                                        <td>
                                                            <a href="{{ url('web-organigrama.html') }}" target="_blank">
                                                                <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item">
                                    <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_documentos" data-target="#panel_documentos">Documentos de Gestión</div>
                                    <div class="accordion-content collapse" id="panel_documentos">
                                        <div class="table-responsive">
                                            <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Documento</th>
                                                        <th>Ingresar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</th>
                                                        <td>Documentos de Gestión</td>
                                                        <td>
                                                            <a href="{{ url('web-documentos-gestion.html') }}" target="_blank">
                                                                <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item">
                                    <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_tupa" data-target="#panel_tupa">Texto Único de Procedimientos Administrativos (TUPA)</div>
                                    <div class="accordion-content collapse" id="panel_tupa">
                                        <div class="table-responsive">
                                            <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Documento</th>
                                                        <th>Ingresar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</th>
                                                        <td>Texto Único de Procedimientos Administrativos (TUPA)</td>
                                                        <td>
                                                            <a href="{{ url('web-documentos/tupa.html') }}" target="_blank">
                                                                <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item">
                                    <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_pei" data-target="#panel_pei">Plan Estratégico Institucional (PEI)</div>
                                    <div class="accordion-content collapse" id="panel_pei">
                                        <div class="table-responsive">
                                            <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Documento</th>
                                                        <th>Ingresar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</th>
                                                        <td>Plan Estratégico Institucional (PEI)</td>
                                                        <td>
                                                            <a href="{{ url('web-documentos/pei.html') }}" target="_blank">
                                                                <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item">
                                    <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_reglamento" data-target="#panel_reglamento">Reglamento General de la Universidad</div>
                                    <div class="accordion-content collapse" id="panel_reglamento">
                                        <div class="table-responsive">
                                            <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Documento</th>
                                                        <th>Ingresar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</th>
                                                        <td>Reglamento General de la Universidad</td>
                                                        <td>
                                                            <a href="{{ url('web-documentos/reglamento-general-unca.html') }}" target="_blank">
                                                                <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                        </div>

                        <!--actas-->

                        <div class="accordion" id="actas">
                              
                            <div class="accordion-item">
                                <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_actas" data-target="#panel_actas">Actas Ordinarias y Extraordinarias</div>
                                <div class="accordion-content collapse" id="panel_actas">
                                    <div class="table-responsive">
                                        <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Documento</th>
                                                    <th>Ingresar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</th>
                                                    <td>Actas Ordinarias y Extraordinarias</td>
                                                    <td>
                                                        <a href="{{ url('web-actas-grupo.html') }}" target="_blank">
                                                            <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                        </a>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                    </div>


                    <!--resoluciones-->

                    <div class="accordion" id="resoluciones">
                              
                        <div class="accordion-item">
                            <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_resoluciones" data-target="#panel_resoluciones">Resoluciones</div>
                            <div class="accordion-content collapse" id="panel_resoluciones">
                                <div class="table-responsive">
                                    <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Documento</th>
                                                <th>Ingresar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</th>
                                                <td>Resoluciones de Presidencia, Comisión Organizadora y Administración</td>
                                                <td>
                                                    <a href="{{ url('web-resoluciones.html') }}" target="_blank">
                                                        <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                    </a>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                </div>


               </div>
               <!--fin de gobierno-->


               <div class="container-fluid">
                 <h3>ACADÉMICO</h3>



                 <div>
                    <button class="btn-arcjas" id="btn-admision" data-target="#admision">
                        <span>
                            <div class="icono">
                                <i class="fa fa-building-o fa-3x pt-3" aria-hidden="true"></i>
                            </div>
                            Registro de Admisión
                        </span>
                    </button>

                    <button class="btn-arcjas" id="btn-docacademicos" data-target="#docacademicos">
                        <span>
                            <div class="icono">
                                <i class="fa fa-book fa-3x pt-3" aria-hidden="true"></i>
                            <div>
                            Documentos Académicos
                        </span>
                    </button>

                    <button class="btn-arcjas" id="btn-postulantes" data-target="#postulantes">
                        <span>
                            <div class="icono">
                                <i class="fa fa-users fa-3x pt-3" aria-hidden="true"></i>
                            <div>
                            Postul., Ingres. y Estudiantes
                        </span>
                    </button>

                    <button class="btn-arcjas" id="btn-docentes" data-target="#docentes">
                        <span>
                            <div class="icono">
                                <i class="fa fa-user-plus fa-3x pt-3" aria-hidden="true"></i>
                            <div>
                            Registro de Docentes
                        </span>
                    </button>

                    <button class="btn-arcjas" id="btn-becas" data-target="#becas">
                        <span>
                            <div class="icono">
                                <i class="fa fa-mortar-board fa-3x pt-3" aria-hidden="true"></i>
                            <div>
                            Registro de Becas
                        </span>
                    </button>

                    <button class="btn-arcjas" id="btn-ambientes" data-target="#ambientes">
                        <span>
                            <div class="icono">
                                <i class="fa fa-cubes fa-3x pt-3" aria-hidden="true"></i>
                            <div>
                            Ambient. Social, Depor y Cultur
                        </span>
                    </button>

                    <button class="btn-arcjas" id="btn-silabus" data-target="#silabus">
                        <span>
                            <div class="icono">
                                <i class="fa  fa-map-o fa-3x pt-3" aria-hidden="true"></i>
                            <div>
                            Registro de Silabus
                        </span>
                    </button>

                </div>



                <!--ADMISION-->
                <div class="accordion" id="admision">
                              
                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_proyectos" data-target="#panel_proyectos">La Información estará disponible cuando inicien los periodos académicos.</div>
                        <div class="accordion-content collapse" id="panel_proyectos">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Proyectos de Investigación</td>
                                            <td>
                                                <a href="{{ url('web-proyectos-investigacion.html') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <!--DOC ACADE-->
                <div class="accordion" id="docacademicos">
                              
                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_proyectos" data-target="#panel_proyectos">La Información estará disponible cuando inicien los periodos académicos.</div>
                        <div class="accordion-content collapse" id="panel_proyectos">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Proyectos de Investigación</td>
                                            <td>
                                                <a href="{{ url('web-proyectos-investigacion.html') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <!--POSTULA INGRES ESTUDIA-->
                <div class="accordion" id="postulantes">
                              
                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_proyectos" data-target="#panel_proyectos">La Información estará disponible cuando inicien los periodos académicos.</div>
                        <div class="accordion-content collapse" id="panel_proyectos">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Proyectos de Investigación</td>
                                            <td>
                                                <a href="{{ url('web-proyectos-investigacion.html') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <!--DOCENTES-->
                <div class="accordion" id="docentes">
                              
                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_proyectos" data-target="#panel_proyectos">La Información estará disponible cuando inicien los periodos académicos.</div>
                        <div class="accordion-content collapse" id="panel_proyectos">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Proyectos de Investigación</td>
                                            <td>
                                                <a href="{{ url('web-proyectos-investigacion.html') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <!--BECAS-->
                <div class="accordion" id="becas">
                              
                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_proyectos" data-target="#panel_proyectos">La Información estará disponible cuando inicien los periodos académicos.</div>
                        <div class="accordion-content collapse" id="panel_proyectos">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Proyectos de Investigación</td>
                                            <td>
                                                <a href="{{ url('web-proyectos-investigacion.html') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <!--AMBIENTES-->
                <div class="accordion" id="ambientes">
                              
                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_proyectos" data-target="#panel_proyectos">La Información estará disponible cuando inicien los periodos académicos.</div>
                        <div class="accordion-content collapse" id="panel_proyectos">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Proyectos de Investigación</td>
                                            <td>
                                                <a href="{{ url('web-proyectos-investigacion.html') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <!--SILABUS-->
                <div class="accordion" id="silabus">
                              
                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_proyectos" data-target="#panel_proyectos">La Información estará disponible cuando inicien los periodos académicos.</div>
                        <div class="accordion-content collapse" id="panel_proyectos">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Proyectos de Investigación</td>
                                            <td>
                                                <a href="{{ url('web-proyectos-investigacion.html') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                 
               </div>




                <div class="container-fluid">
                  <h3>INVESTIGACIÓN</h3>

                  <div>
                    <button class="btn-arcjas" id="btn-proyectos" data-target="#proyectos">
                        <span>
                            <div class="icono">
                                <i class="fa fa-archive fa-3x pt-3" aria-hidden="true"></i>
                            </div>
                            Proyectos de Investigación
                        </span>
                    </button>

                    <button class="btn-arcjas" id="btn-repositorio" data-target="#repositorio">
                        <span>
                            <div class="icono">
                                <i class="fa fa-database fa-3x pt-3" aria-hidden="true"></i>
                            <div>
                            Repositorio Institucional
                        </span>
                    </button>

                </div>


                <div class="accordion" id="proyectos">
                              
                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_proyectosi" data-target="#panel_proyectosi">Proyectos de Investigación</div>
                        <div class="accordion-content collapse" id="panel_proyectosi">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Proyectos de Investigación</td>
                                            <td>
                                                <a href="{{ url('web-proyectos-investigacion.html') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_docentesi" data-target="#panel_docentesi">Docentes de Investigación</div>
                        <div class="accordion-content collapse" id="panel_docentesi">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Docentes que realizan Investigación</td>
                                            <td>
                                               
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                               
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="accordion" id="repositorio">

                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_repositorio" data-target="#panel_repositorio">Repositorio</div>
                        <div class="accordion-content collapse" id="panel_repositorio">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Repositorio Institucional</td>
                                            <td>
                                                <a href="{{ url('https://repositorio.unca.edu.pe/') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    

                </div>
            </div>
              

                <div class="container-fluid">
                  <h3>PRESUPUESTAL</h3>
                

                <div>
                    <button class="btn-arcjas" id="btn-financiera" data-target="#financiera">
                        <span>
                            <div class="icono">
                                <i class="fa fa-bar-chart fa-3x pt-3" aria-hidden="true"></i>
                            </div>
                            Información Financiera
                        </span>
                    </button>

                    <button class="btn-arcjas" id="btn-remuneraciones" data-target="#remuneraciones">
                        <span>
                            <div class="icono">
                                <i class="fa fa-folder-open fa-3x pt-3" aria-hidden="true"></i>
                            <div>
                            Remuneraciones
                        </span>
                    </button>

                </div>


                <div class="accordion" id="financiera">
                              
                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_financiera" data-target="#panel_financiera">Estados Financieros</div>
                        <div class="accordion-content collapse" id="panel_financiera">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Estados Financieros</td>
                                            <td>
                                                <a href="{{ url('web-documentos/eeff.html') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_pia" data-target="#panel_pia">Presupuesto Institucional Modificado</div>
                        <div class="accordion-content collapse" id="panel_pia">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Presupuesto Institucional Modificado</td>
                                            <td>
                                                <a href="{{ url('https://www.transparencia.gob.pe/reportes_directos/pte_transparencia_info_finan.aspx?id_entidad=18813&id_tema=19&ver=D') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    

                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_ejecpres" data-target="#panel_ejecpres">Ejecución Presupuestal</div>
                        <div class="accordion-content collapse" id="panel_ejecpres">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Ejecución Presupuestal</td>
                                            <td>
                                                <a href="{{ url('https://www.transparencia.gob.pe/reportes_directos/pte_transparencia_info_finan.aspx?id_entidad=18813&id_tema=19&ver=D') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_balances" data-target="#panel_balances">Balances</div>
                        <div class="accordion-content collapse" id="panel_balances">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Balances</td>
                                            <td>
                                                <a href="{{ url('web-documentos/conciliacion-del-marco-legal-y-ejecucion-del-presupuesto.html') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_inversion" data-target="#panel_inversion">Inversiones, reinversiones, donaciones, obras de infraestructura, recursos de diversa fuente, entre otros.</div>
                        <div class="accordion-content collapse" id="panel_inversion">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Proyectos de Inversión</td>
                                            <td>
                                                <a href="{{ url('web-proyectos-inversion.html') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>2</th>
                                            <td>Inversiones y Reinversiones</td>
                                            <td>
                                                <a href="{{ url('https://www.transparencia.gob.pe/reportes_directos/pte_transparencia_pro_inv.aspx?id_entidad=18813&id_tema=26&ver=1#.YgUrbJTMKMo') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>3</th>
                                            <td>Obras de Infraestructura</td>
                                            <td>
                                                <a href="{{ url('https://www.transparencia.gob.pe/reportes_directos/pep_transparencia_infoObras.aspx?id_entidad=18813&ver=1&id_tema=200#.YgYWdJTMKMo') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                   
                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_tarifa" data-target="#panel_tarifa">Tarifario de Servicios</div>
                        <div class="accordion-content collapse" id="panel_tarifa">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Relación de pagos exigidos a los estudiantes</td>
                                            <td>
                                                <a href="{{ url('web-documentos/procedimientos-administrativos-para-estudiantes.html') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="accordion" id="remuneraciones">

                    <div class="accordion-item">
                        <div class="accordion-title" data-toggle="collapse-arcjas" id="title-panel_remuneraciones" data-target="#panel_remuneraciones">Remuneraciones</div>
                        <div class="accordion-content collapse" id="panel_remuneraciones">
                            <div class="table-responsive">
                                <table id="tbl_resoluciones" class="table tablecuriosity table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Documento</th>
                                            <th>Ingresar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</th>
                                            <td>Remuneraciones, bonificaciones y demás estímulos que se pagan a las autoridades y docentes.</td>
                                            <td>
                                                <a href="{{ url('https://www.transparencia.gob.pe/personal/pte_transparencia_personal.aspx?id_entidad=18813&id_tema=32&ver=D') }}" target="_blank">
                                                    <button class="btn-ingresar"><i class="fa fa-arrow-circle-right"></i></button>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                    

                </div>



                </div>
               
            </div>		
        </div>
    </div>
</div>
</div>
{% endblock %}
