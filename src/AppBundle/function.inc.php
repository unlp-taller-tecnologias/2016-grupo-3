<?php
use AppBundle\Entity\UserCatedra;

function getIdCatedra($controller,$em) {
        $catedra = $controller->getUser()->getCatedra();
        if (null != $catedra) $catedra = $catedra->getId();
        else {
            $userCatedra = $em->getRepository('AppBundle:UserCatedra')->findOneByIduser($controller->getUser()->getId());
            if (null != $userCatedra) {
                $catedra = $userCatedra->getIdcatedra();
            }
        }
        return $catedra;
}

function asignarPrivilegios($controller,$em,$idCatedra) {
        $userCatedra = $em->getRepository('AppBundle:UserCatedra')->findOneByIduser($controller->getUser()->getId());
        if (null != $userCatedra) {
            $catedra = $userCatedra->setIdcatedra($idCatedra);
        } else {
            $userCatedra = new UserCatedra();
            $userCatedra->setIduser($controller->getUser()->getId());
            $userCatedra->setIdcatedra($idCatedra);
        }
        $em->persist($userCatedra);
        $em->flush();
}


function esSecretario($controller){
	$catedra = $controller->getUser()->getCatedra();
	if(null != $catedra){
		return false;
	}else{
		return true;
	}
}

function encontrarUnaAsistenciaByAlumnoAndClase($em, $idAlumno, $idClase)
{
    $q = $em->createQuery(
        "SELECT ac 
        FROM AppBundle:AlumnoClase ac 
        WHERE ac.alumnos = :idAlumno AND ac.clases = :idClase");

    $q->setParameter("idAlumno",$idAlumno);
    $q->setParameter("idClase",$idClase);
    return $q->getResult();
}

function encontrarUnInscriptoByAlumnoAndClase($em, $idAlumno, $idCurso)
{
    $q = $em->createQuery(
        "SELECT i
        FROM AppBundle:Inscriptos i 
        WHERE i.idalumno = :idAlumno AND i.idcurso = :idCurso");

    $q->setParameter("idAlumno",$idAlumno);
    $q->setParameter("idCurso",$idCurso);
    return $q->getResult();
}

function encontrarUnaNotaByAlumnoAndInstancia($em, $idAlumno, $idInstancia)
{
    $q = $em->createQuery(
        "SELECT ap 
        FROM AppBundle:AlumnosParcial ap 
        WHERE ap.alumnos = :idAlumno AND ap.parciales = :idInstancia");

    $q->setParameter("idAlumno",$idAlumno);
    $q->setParameter("idInstancia",$idInstancia);
    return $q->getResult();
}

function encontrarAlumnos($em,$nom,$id_curso)
{

//var_dump($em);die();
 //$em = $this->getDoctrine()->getManager();  
     $nom='%'.$nom.'%';
     $sql = "SELECT * FROM alumnos 
        LEFT JOIN inscriptos ON (inscriptos.idAlumno = alumnos.id )
        WHERE (alumnos.nombre LIKE :nom OR alumnos.apellido LIKE :nom ) AND inscriptos.idCurso = :id_curso ";
   $params=array('nom'=>$nom, 'id_curso'=>$id_curso);
    $stmt = $em->getConnection()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
    
}
function encontrarAlumnoEnCursosAnteriores($em,$id_alumno,$id_curso)
{

//var_dump($em);die();
 //$em = $this->getDoctrine()->getManager();  
     $sql = "SELECT * FROM inscriptos 
        LEFT JOIN cursos ON (inscriptos.idCurso = cursos.id )
        WHERE inscriptos.idAlumno = :id_alumno AND inscriptos.idCurso != :id_curso ";
   $params=array('id_alumno'=>$id_alumno, 'id_curso'=>$id_curso);
    $stmt = $em->getConnection()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
    
}