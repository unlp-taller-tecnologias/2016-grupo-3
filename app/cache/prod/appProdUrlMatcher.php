<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/a')) {
            if (0 === strpos($pathinfo, '/asistencias')) {
                // alumnoclase_index
                if (rtrim($pathinfo, '/') === '/asistencias') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_alumnoclase_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'alumnoclase_index');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\AlumnoClaseController::indexAction',  '_route' => 'alumnoclase_index',);
                }
                not_alumnoclase_index:

                // alumnoclase_update
                if ($pathinfo === '/asistencias/update') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_alumnoclase_update;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\AlumnoClaseController::updateAction',  '_route' => 'alumnoclase_update',);
                }
                not_alumnoclase_update:

                // alumnoclase_new
                if ($pathinfo === '/asistencias/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_alumnoclase_new;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\AlumnoClaseController::newAction',  '_route' => 'alumnoclase_new',);
                }
                not_alumnoclase_new:

                // alumnoclase_show
                if (preg_match('#^/asistencias/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_alumnoclase_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'alumnoclase_show')), array (  '_controller' => 'AppBundle\\Controller\\AlumnoClaseController::showAction',));
                }
                not_alumnoclase_show:

                // alumnoclase_edit
                if (preg_match('#^/asistencias/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_alumnoclase_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'alumnoclase_edit')), array (  '_controller' => 'AppBundle\\Controller\\AlumnoClaseController::editAction',));
                }
                not_alumnoclase_edit:

                // alumnoclase_delete
                if (preg_match('#^/asistencias/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_alumnoclase_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'alumnoclase_delete')), array (  '_controller' => 'AppBundle\\Controller\\AlumnoClaseController::deleteAction',));
                }
                not_alumnoclase_delete:

            }

            if (0 === strpos($pathinfo, '/alumnos')) {
                // alumnos_index
                if (rtrim($pathinfo, '/') === '/alumnos') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_alumnos_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'alumnos_index');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\AlumnosController::indexAction',  '_route' => 'alumnos_index',);
                }
                not_alumnos_index:

                // alumnos_new
                if ($pathinfo === '/alumnos/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_alumnos_new;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\AlumnosController::newAction',  '_route' => 'alumnos_new',);
                }
                not_alumnos_new:

                // alumnos_show
                if (preg_match('#^/alumnos/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_alumnos_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'alumnos_show')), array (  '_controller' => 'AppBundle\\Controller\\AlumnosController::showAction',));
                }
                not_alumnos_show:

                // alumnos_edit
                if (preg_match('#^/alumnos/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_alumnos_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'alumnos_edit')), array (  '_controller' => 'AppBundle\\Controller\\AlumnosController::editAction',));
                }
                not_alumnos_edit:

                // alumnos_delete
                if (preg_match('#^/alumnos/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_alumnos_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'alumnos_delete')), array (  '_controller' => 'AppBundle\\Controller\\AlumnosController::deleteAction',));
                }
                not_alumnos_delete:

            }

        }

        if (0 === strpos($pathinfo, '/c')) {
            if (0 === strpos($pathinfo, '/catedras')) {
                // catedras_index
                if (rtrim($pathinfo, '/') === '/catedras') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_catedras_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'catedras_index');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\CatedrasController::indexAction',  '_route' => 'catedras_index',);
                }
                not_catedras_index:

                // catedras_new
                if ($pathinfo === '/catedras/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_catedras_new;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\CatedrasController::newAction',  '_route' => 'catedras_new',);
                }
                not_catedras_new:

                // catedras_show
                if (preg_match('#^/catedras/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_catedras_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'catedras_show')), array (  '_controller' => 'AppBundle\\Controller\\CatedrasController::showAction',));
                }
                not_catedras_show:

                // catedras_edit
                if (preg_match('#^/catedras/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_catedras_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'catedras_edit')), array (  '_controller' => 'AppBundle\\Controller\\CatedrasController::editAction',));
                }
                not_catedras_edit:

                // catedras_delete
                if (preg_match('#^/catedras/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_catedras_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'catedras_delete')), array (  '_controller' => 'AppBundle\\Controller\\CatedrasController::deleteAction',));
                }
                not_catedras_delete:

            }

            if (0 === strpos($pathinfo, '/clase')) {
                // clase_index
                if (rtrim($pathinfo, '/') === '/clase') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_clase_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'clase_index');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\ClaseController::indexAction',  '_route' => 'clase_index',);
                }
                not_clase_index:

                // clase_new
                if ($pathinfo === '/clase/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_clase_new;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\ClaseController::newAction',  '_route' => 'clase_new',);
                }
                not_clase_new:

                // clase_show
                if (preg_match('#^/clase/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_clase_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'clase_show')), array (  '_controller' => 'AppBundle\\Controller\\ClaseController::showAction',));
                }
                not_clase_show:

                // clase_edit
                if (preg_match('#^/clase/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_clase_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'clase_edit')), array (  '_controller' => 'AppBundle\\Controller\\ClaseController::editAction',));
                }
                not_clase_edit:

                // clase_delete
                if (preg_match('#^/clase/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_clase_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'clase_delete')), array (  '_controller' => 'AppBundle\\Controller\\ClaseController::deleteAction',));
                }
                not_clase_delete:

            }

            if (0 === strpos($pathinfo, '/comisiones')) {
                // comisiones_index
                if (rtrim($pathinfo, '/') === '/comisiones') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_comisiones_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'comisiones_index');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\ComisionesController::indexAction',  '_route' => 'comisiones_index',);
                }
                not_comisiones_index:

                // comisiones_new
                if ($pathinfo === '/comisiones/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_comisiones_new;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\ComisionesController::newAction',  '_route' => 'comisiones_new',);
                }
                not_comisiones_new:

                // comisiones_show
                if (preg_match('#^/comisiones/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_comisiones_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'comisiones_show')), array (  '_controller' => 'AppBundle\\Controller\\ComisionesController::showAction',));
                }
                not_comisiones_show:

                // comisiones_edit
                if (preg_match('#^/comisiones/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_comisiones_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'comisiones_edit')), array (  '_controller' => 'AppBundle\\Controller\\ComisionesController::editAction',));
                }
                not_comisiones_edit:

                // comisiones_delete
                if (preg_match('#^/comisiones/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_comisiones_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'comisiones_delete')), array (  '_controller' => 'AppBundle\\Controller\\ComisionesController::deleteAction',));
                }
                not_comisiones_delete:

            }

            if (0 === strpos($pathinfo, '/cursos')) {
                // cursos_index
                if (rtrim($pathinfo, '/') === '/cursos') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_cursos_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'cursos_index');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\CursosController::indexAction',  '_route' => 'cursos_index',);
                }
                not_cursos_index:

                // cursos_new
                if ($pathinfo === '/cursos/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_cursos_new;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\CursosController::newAction',  '_route' => 'cursos_new',);
                }
                not_cursos_new:

                // cursos_show
                if (preg_match('#^/cursos/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_cursos_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'cursos_show')), array (  '_controller' => 'AppBundle\\Controller\\CursosController::showAction',));
                }
                not_cursos_show:

                // cursos_edit
                if (preg_match('#^/cursos/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_cursos_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'cursos_edit')), array (  '_controller' => 'AppBundle\\Controller\\CursosController::editAction',));
                }
                not_cursos_edit:

                // cursos_delete
                if (preg_match('#^/cursos/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_cursos_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'cursos_delete')), array (  '_controller' => 'AppBundle\\Controller\\CursosController::deleteAction',));
                }
                not_cursos_delete:

            }

        }

        // homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'homepage');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
        }

        // app_default_admin
        if ($pathinfo === '/admin') {
            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::adminAction',  '_route' => 'app_default_admin',);
        }

        if (0 === strpos($pathinfo, '/instanciaparcial')) {
            // instanciaparcial_index
            if (rtrim($pathinfo, '/') === '/instanciaparcial') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_instanciaparcial_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'instanciaparcial_index');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\InstanciaParcialController::indexAction',  '_route' => 'instanciaparcial_index',);
            }
            not_instanciaparcial_index:

            // instanciaparcial_new
            if ($pathinfo === '/instanciaparcial/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_instanciaparcial_new;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\InstanciaParcialController::newAction',  '_route' => 'instanciaparcial_new',);
            }
            not_instanciaparcial_new:

            // instanciaparcial_show
            if (preg_match('#^/instanciaparcial/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_instanciaparcial_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'instanciaparcial_show')), array (  '_controller' => 'AppBundle\\Controller\\InstanciaParcialController::showAction',));
            }
            not_instanciaparcial_show:

            // instanciaparcial_edit
            if (preg_match('#^/instanciaparcial/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_instanciaparcial_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'instanciaparcial_edit')), array (  '_controller' => 'AppBundle\\Controller\\InstanciaParcialController::editAction',));
            }
            not_instanciaparcial_edit:

            // instanciaparcial_delete
            if (preg_match('#^/instanciaparcial/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_instanciaparcial_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'instanciaparcial_delete')), array (  '_controller' => 'AppBundle\\Controller\\InstanciaParcialController::deleteAction',));
            }
            not_instanciaparcial_delete:

        }

        if (0 === strpos($pathinfo, '/parcial')) {
            // parcial_index
            if (rtrim($pathinfo, '/') === '/parcial') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_parcial_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'parcial_index');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\ParcialController::indexAction',  '_route' => 'parcial_index',);
            }
            not_parcial_index:

            // parcial_new
            if ($pathinfo === '/parcial/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_parcial_new;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\ParcialController::newAction',  '_route' => 'parcial_new',);
            }
            not_parcial_new:

            // parcial_show
            if (preg_match('#^/parcial/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_parcial_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'parcial_show')), array (  '_controller' => 'AppBundle\\Controller\\ParcialController::showAction',));
            }
            not_parcial_show:

            // parcial_edit
            if (preg_match('#^/parcial/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_parcial_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'parcial_edit')), array (  '_controller' => 'AppBundle\\Controller\\ParcialController::editAction',));
            }
            not_parcial_edit:

            // parcial_delete
            if (preg_match('#^/parcial/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_parcial_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'parcial_delete')), array (  '_controller' => 'AppBundle\\Controller\\ParcialController::deleteAction',));
            }
            not_parcial_delete:

        }

        if (0 === strpos($pathinfo, '/user')) {
            // user_index
            if (rtrim($pathinfo, '/') === '/user') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_user_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'user_index');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\UserController::indexAction',  '_route' => 'user_index',);
            }
            not_user_index:

            // user_new
            if ($pathinfo === '/user/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_user_new;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\UserController::newAction',  '_route' => 'user_new',);
            }
            not_user_new:

            // user_show
            if (preg_match('#^/user/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_user_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_show')), array (  '_controller' => 'AppBundle\\Controller\\UserController::showAction',));
            }
            not_user_show:

            // user_edit
            if (preg_match('#^/user/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_user_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_edit')), array (  '_controller' => 'AppBundle\\Controller\\UserController::editAction',));
            }
            not_user_edit:

            // user_delete
            if (preg_match('#^/user/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_user_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_delete')), array (  '_controller' => 'AppBundle\\Controller\\UserController::deleteAction',));
            }
            not_user_delete:

        }

        if (0 === strpos($pathinfo, '/reporte')) {
            // reporteAsistencia_index
            if (rtrim($pathinfo, '/') === '/reporteAsistencia') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_reporteAsistencia_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'reporteAsistencia_index');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\reporteAsistenciaController::indexAction',  '_route' => 'reporteAsistencia_index',);
            }
            not_reporteAsistencia_index:

            // reporteNotas_index
            if (rtrim($pathinfo, '/') === '/reporteNotas') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_reporteNotas_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'reporteNotas_index');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\reporteNotasController::indexAction',  '_route' => 'reporteNotas_index',);
            }
            not_reporteNotas_index:

        }

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // fos_user_security_login
                if ($pathinfo === '/login') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_security_login;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'fos_user_security_login',);
                }
                not_fos_user_security_login:

                // fos_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_security_check;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_route' => 'fos_user_security_check',);
                }
                not_fos_user_security_check:

            }

            // fos_user_security_logout
            if ($pathinfo === '/logout') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_security_logout;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_route' => 'fos_user_security_logout',);
            }
            not_fos_user_security_logout:

        }

        if (0 === strpos($pathinfo, '/profile')) {
            // fos_user_profile_show
            if (rtrim($pathinfo, '/') === '/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_profile_show');
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::showAction',  '_route' => 'fos_user_profile_show',);
            }
            not_fos_user_profile_show:

            // fos_user_profile_edit
            if ($pathinfo === '/profile/edit') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_fos_user_profile_edit;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::editAction',  '_route' => 'fos_user_profile_edit',);
            }
            not_fos_user_profile_edit:

        }

        if (0 === strpos($pathinfo, '/re')) {
            if (0 === strpos($pathinfo, '/register')) {
                // fos_user_registration_register
                if (rtrim($pathinfo, '/') === '/register') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_registration_register;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'fos_user_registration_register');
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::registerAction',  '_route' => 'fos_user_registration_register',);
                }
                not_fos_user_registration_register:

                if (0 === strpos($pathinfo, '/register/c')) {
                    // fos_user_registration_check_email
                    if ($pathinfo === '/register/check-email') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_fos_user_registration_check_email;
                        }

                        return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
                    }
                    not_fos_user_registration_check_email:

                    if (0 === strpos($pathinfo, '/register/confirm')) {
                        // fos_user_registration_confirm
                        if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_fos_user_registration_confirm;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_confirm')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmAction',));
                        }
                        not_fos_user_registration_confirm:

                        // fos_user_registration_confirmed
                        if ($pathinfo === '/register/confirmed') {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_fos_user_registration_confirmed;
                            }

                            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
                        }
                        not_fos_user_registration_confirmed:

                    }

                }

            }

            if (0 === strpos($pathinfo, '/resetting')) {
                // fos_user_resetting_request
                if ($pathinfo === '/resetting/request') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_resetting_request;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_route' => 'fos_user_resetting_request',);
                }
                not_fos_user_resetting_request:

                // fos_user_resetting_send_email
                if ($pathinfo === '/resetting/send-email') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_resetting_send_email;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
                }
                not_fos_user_resetting_send_email:

                // fos_user_resetting_check_email
                if ($pathinfo === '/resetting/check-email') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_resetting_check_email;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
                }
                not_fos_user_resetting_check_email:

                // fos_user_resetting_reset
                if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_resetting_reset;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',));
                }
                not_fos_user_resetting_reset:

            }

        }

        // fos_user_change_password
        if ($pathinfo === '/profile/change-password') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_user_change_password;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_route' => 'fos_user_change_password',);
        }
        not_fos_user_change_password:

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
