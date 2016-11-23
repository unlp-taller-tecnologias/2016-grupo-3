<?php
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

function encontrarUnaNotaByAlumnoAndInstancia($em, $idAlumno, $idClase)
{
    $q = $em->createQuery(
        "SELECT ac 
        FROM AppBundle:AlumnoClase ac 
        WHERE ac.alumnos = :idAlumno AND ac.clases = :idClase");

    $q->setParameter("idAlumno",$idAlumno);
    $q->setParameter("idClase",$idClase);
    return $q->getResult();
}