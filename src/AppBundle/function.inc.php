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
