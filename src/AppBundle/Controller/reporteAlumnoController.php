<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ReporteAlumno;
//use AppBundle\Form\ComisionesType;

/**
 * reporteAlumno controller.
 *
 * @Route("/reporteAlumno")
 */
class reporteAlumnoController extends Controller
{
    /**
     * Lists all  entities.
     *
     * @Route("/", name="reporteAlumno_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        


        return $this->render('reporteAlumno/index.html.twig');
    }

 
}
