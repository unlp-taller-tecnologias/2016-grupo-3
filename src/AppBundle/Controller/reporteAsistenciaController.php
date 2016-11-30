<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ReporteAsistencia;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
//use AppBundle\Form\ComisionesType;

/**
 * reporteAsistencia controller.
 *
 * @Route("/reporteAsistencia")
 */
class reporteAsistenciaController extends Controller
{
    /**
     * Lists all  entities.
     *
     * @Route("/", name="reporteAsistencia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
      $em = $this->getDoctrine()->getManager();
      if (isset($_GET['curso'])) {
        //BUSCA POR UN CURSO EN PARTICULAR
            $id=$_GET['curso'];

           
            $cursos = $em->getRepository('AppBundle:Cursos')->findOneById($_GET['curso']);
            $clases = $cursos->getClases();
            $cant_clases_tomadas="";
             foreach ($clases as $clas) {
                    if ($clas->getEstado() == "finalizada") {
                      if ($clas->getRequerida() == 1) {
                         $cant_clases_tomadas=$cant_clases_tomadas + 1;
                      }
                     
                    }
                  }
            $comisiones= $cursos->getComisiones();
 
            $asistencias = array();
            $alumnos_asistencia = array();

            foreach ($comisiones as $comi) {

             $comision = $em->getRepository('AppBundle:Comisiones')->findOneById($comi->getId());
             $alumnos = $comision->getAlumnos();

            foreach ($alumnos as $alumno) {
                $alumno = $alumno->getIdAlumno();
                foreach ($clases as $clas) {
                   $asistencia = encontrarUnaAsistenciaByAlumnoAndClase($em,$alumno->getId(),$clas->getId());
                    if ($asistencia == null) {
                    $asistencias[] = (array("clase"=>$clas,"asistencia"=>"n/a", "observacion"=> "asistencia no pasada todavia","id"=>"0" ));
                   } else { 
                    $asistencias[] = (array("clase"=>$clas,"asistencia"=>$asistencia[0]->getEstado(),"observacion"=>$asistencia[0]->getObservacion(),"id"=>$asistencia[0]->getId()));
                   }

                }
               
               $alumnos_asistencia[]=  (array("alumno"=>$alumno,"curso"=>$cursos,"comision"=>$comision,"asistencias"=>$asistencias));  
              $asistencias = "";
            }
           // var_dump($cursos->getNombre()); die();
           $titulo=$cursos->getNombre();

            }

          $miCurso=$cursos->getId();

   }elseif (isset($_GET['comision'])) {
            //BUSCA POR UNA COMISION EN PARTICULAR
            $id=$_GET['comision'];
            $comision = $em->getRepository('AppBundle:Comisiones')->findOneById($_GET['comision']);

            $curso = $comision->getIdcurso();
             $alumnos = $comision->getAlumnos();
           //   var_dump($id);die();
            $cursos = $em->getRepository('AppBundle:Cursos')->findOneById($curso);
            $clases = $cursos->getClases();
            $cant_clases_tomadas=0;
            foreach ($clases as $clas) {
                    if ($clas->getEstado() == "finalizada") {
                      if ($clas->getRequerida() == 1) {
                         $cant_clases_tomadas=$cant_clases_tomadas + 1;
                      }
                     
                    }
                  }

            $asistencias = array();
            $alumnos_asistencia = array();
            foreach ($alumnos as $alumno) {
                $alumno = $alumno->getIdAlumno();
                foreach ($clases as $clas) {
                   $asistencia = encontrarUnaAsistenciaByAlumnoAndClase($em,$alumno->getId(),$clas->getId());
                    if ($asistencia == null) {
                    $asistencias[] = (array("clase"=>$clas,"asistencia"=>"n/a", "observacion"=> "asistencia no pasada todavia","id"=>"0" ));
                   } else { 
                    $asistencias[] = (array("clase"=>$clas,"asistencia"=>$asistencia[0]->getEstado(),"observacion"=>$asistencia[0]->getObservacion(),"id"=>$asistencia[0]->getId()));
                   }

                }
               
               $alumnos_asistencia[]=  (array("alumno"=>$alumno,"curso"=>$cursos,"comision"=>$comision,"asistencias"=>$asistencias));  
              $asistencias = "";
            }

           // var_dump($comision->getNombre()); die();
           $titulo=$comision->getNombre();


           //Me guardo la comision a la que tengo que volver
           $miComision=$_GET['comision'];
         }

    //Este if evita que el sistema se rompa cuando esta en modo desarrollador, esto siempre tiene que estar antes del render, porque sino te tira un error de variable indefinida

    if (isset($miCurso)) {
      $miComision='';
    }else{
      $miCurso='';
    }

    return $this->render('reporteAsistencia/index.html.twig',array('alumnos_asistencia'=>$alumnos_asistencia,"clases"=>$clases,'cant_clases_tomadas'=>$cant_clases_tomadas,'titulo'=>$titulo, 'idCurso' => $miCurso,'idComision' => $miComision));
           // var_dump($alumnos_asistencia[0]); die();
         
  }

     /**
     * @Route("/exportar/excelAsistencias", name="exportarExcelAsistencias")
     * @Method("GET")
     */
  public function exportarExcelAsistencias(Request $request)
      {
          $em = $this->getDoctrine()->getManager();

   if (isset($_GET['comision']) or isset($_GET['curso'])) {
              // recuperamos los elementos de base de datos que queremos exportar
          $query = $em->getRepository('AppBundle:Alumnos')
              ->createQueryBuilder('e')
              ->getQuery();

          $result = $query->getResult();

          if(isset($_GET['comision'])){  
              $comision = $em->getRepository('AppBundle:Comisiones')->findOneById($_GET['comision']);

              $curso = $comision->getIdcurso();
               $alumnos = $comision->getAlumnos();
               $cursos = $em->getRepository('AppBundle:Cursos')->findOneById($curso);
          }elseif (isset($_GET['curso'])) {
              $alumnos = $em->getRepository('AppBundle:Inscriptos')->findByIdcurso($_GET['curso']);
              $cursos = $em->getRepository('AppBundle:Cursos')->findOneById($_GET['curso']);
              //$alumnos = $em->getRepository('AppBundle:Alumnos')->findBy($inscriptos/>getIdAlumno());
          }
           //   var_dump($id);die();
            
            $clases = $cursos->getClases();


          // solicitamos el servicio 'phpexcel' y creamos el objeto vacío...
          $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

          // ...y le asignamos una serie de propiedades
          $phpExcelObject->getProperties()
              ->setCreator("Grupo3")
              ->setLastModifiedBy("Grupo3")
              ->setTitle("Exportacion de asistencia por comision")
              ->setSubject("Asistencias")
              ->setDescription("Listado de Asistencias por comision.")
              ->setKeywords("vabadus exportar excel ejemplo");

          // establecemos como hoja activa la primera, y le asignamos un título
          $phpExcelObject->setActiveSheetIndex(0);
          $phpExcelObject->getActiveSheet()->setTitle('Asistencias');
          
          // escribimos en distintas celdas del documento el título de los campos que vamos a exportar

          $phpExcelObject->setActiveSheetIndex(0)
          ->setCellValue('B1', $cursos->getNombre())
          ->setCellValue('B2', 'Nombre y Apellido');
          if(isset($_GET['comision'])){
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('C1',  $comision->getNombre());
          }
              
              $address = 'B2';

                foreach ($clases as $clas) {
                  //$split = PHPExcel_Cell::coordinateFromString($address);
                    $first = $address[0];
                    $first = ++$first;
                    $address = $first.$address[1];
                   // echo $address; die();
                      $phpExcelObject->setActiveSheetIndex(0)->setCellValue($address, $clas->getNombre());

                 }
                   $first = $address[0];
                    $first = ++$first;
                    $address = $first.$address[1];
                  $phpExcelObject->setActiveSheetIndex(0)->setCellValue($address, 'Total de clases');
                    $first = $address[0];
                    $first = ++$first;
                    $address = $first.$address[1];
                  $phpExcelObject->setActiveSheetIndex(0)->setCellValue($address, 'Total requeridas');
                    $first = $address[0];
                    $first = ++$first;
                    $address = $first.$address[1];
                  $phpExcelObject->setActiveSheetIndex(0)->setCellValue($address, 'Porcentaje presente');
                  if (isset($_GET['curso'])) {
                    $first = $address[0];
                    $first = ++$first;
                    $address = $first.$address[1];
                  $phpExcelObject->setActiveSheetIndex(0)->setCellValue($address, 'Comision');
                  }
              

          // fijamos un ancho a las distintas columnas
          $phpExcelObject->setActiveSheetIndex(0)
              ->getColumnDimension('B')
              ->setWidth(30);
          $phpExcelObject->setActiveSheetIndex(0)
              ->getColumnDimension('C')
              ->setWidth(25);
          $phpExcelObject->setActiveSheetIndex(0)
              ->getColumnDimension('D')
              ->setWidth(15);
          $phpExcelObject->setActiveSheetIndex(0)
              ->getColumnDimension('E')
              ->setWidth(20);




          //clases por alumno
               $cant_clases_tomadas="0";
            foreach ($clases as $clas) {
                    if ($clas->getEstado() == "finalizada") {
                      if ($clas->getRequerida() == 1) {
                         $cant_clases_tomadas=$cant_clases_tomadas + 1;
                      }
                     
                    }
                  }

            $asistencias = array();
            $alumnos_asistencia = array();
            foreach ($alumnos as $alumno) {
              if (isset($_GET['curso'])) {
                    $comision = $alumno->getIdComision()->getNombre();
                  }
                $alumno = $alumno->getIdAlumno();
                foreach ($clases as $clas) {
                   $asistencia = encontrarUnaAsistenciaByAlumnoAndClase($em,$alumno->getId(),$clas->getId());
                    if ($asistencia == null) {
                    $asistencias[] = (array("clase"=>$clas,"asistencia"=>"n/a", "observacion"=> "asistencia no pasada todavia","id"=>"0" ));
                   } else { 
                    $asistencias[] = (array("clase"=>$clas,"asistencia"=>$asistencia[0]->getEstado(),"observacion"=>$asistencia[0]->getObservacion(),"id"=>$asistencia[0]->getId()));
                   }

                }
               
               $alumnos_asistencia[]=  (array("alumno"=>$alumno,"curso"=>$cursos,"comision"=>$comision,"asistencias"=>$asistencias));  
              $asistencias = "";
            }



          // recorremos los registros obtenidos de la consulta a base de datos escribiéndolos en las celdas correspondientes
          $row = 3;
          foreach ($alumnos_asistencia as $item) {
              $phpExcelObject->setActiveSheetIndex(0)
                  ->setCellValue('B'.$row, $item['alumno']->getApellido().', '.$item['alumno']->getNombre());
                  $address='C';
                  $cant=0;
                foreach ($item['asistencias'] as $item1) {
                      if ($item1['asistencia'] == 'presente') {
                        $cant=$cant + 1;
                      }
                       $phpExcelObject->setActiveSheetIndex(0)
                  ->setCellValue($address.$row, $item1['asistencia']);

                    $address++;
                   }
                    $phpExcelObject->setActiveSheetIndex(0)
                  ->setCellValue($address++.$row, count($clases));
                   $phpExcelObject->setActiveSheetIndex(0)
                  ->setCellValue($address++.$row, $cant_clases_tomadas);
                   $phpExcelObject->setActiveSheetIndex(0)
                  ->setCellValue($address++.$row, $cant.'/'.$cant_clases_tomadas);
                  if (isset($_GET['curso'])) {
                    $phpExcelObject->setActiveSheetIndex(0)
                  ->setCellValue($address++.$row, $item['comision']);
                   }

              $row++;
          }

          // se crea el writer
          $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
          // se crea el response
          $response = $this->get('phpexcel')->createStreamedResponse($writer);
          // y por último se añaden las cabeceras
          $dispositionHeader = $response->headers->makeDisposition(
              ResponseHeaderBag::DISPOSITION_ATTACHMENT,
              'reporteAsistencias.xls'
          );
          $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
          $response->headers->set('Pragma', 'public');
          $response->headers->set('Cache-Control', 'maxage=1');
          $response->headers->set('Content-Disposition', $dispositionHeader);

          return $response;
          }
      }
}