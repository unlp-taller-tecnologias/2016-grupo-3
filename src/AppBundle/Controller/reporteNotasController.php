<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ReporteNotas;
//use AppBundle\Form\ComisionesType;

/**
 * reporteAsistencia controller.
 *
 * @Route("/reporteNotas")
 */
class reporteNotasController extends Controller
{
    /**
     * Lists all  entities.
     *
     * @Route("/", name="reporteNotas_index")
     * @Method("GET")
     */
    public function indexAction()
    {
      if (isset($_GET['catedra'])) {
         $id=$_GET['catedra'];
      }elseif (isset($_GET['curso'])) {
         $id=$_GET['curso'];
      }elseif (isset($_GET['comision'])) {
          $id=$_GET['comision'];
      }
        return $this->render('reporteAsistencia/index.html.twig',array('id'=>$id)
            );
    }

 
}
