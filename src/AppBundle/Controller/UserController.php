<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;

/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * Lists all User entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        if (esSecretario($this)) {

            $em = $this->getDoctrine()->getManager();

            $users = $em->getRepository('AppBundle:User')->findAll();

            return $this->render('user/index.html.twig', array(
                'users' => $users,
            ));
        }else{
            return $this->redirect($this->generateUrl('cursos_index'));
        }
    }

    /**
     * Creates a new User entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        if( esSecretario($this)){
            $userManager = $this->get('fos_user.user_manager');
            $user = $userManager->createUser();
            $form = $this->createForm('AppBundle\Form\UserType', $user);
            $form->handleRequest($request);
            

            if ($form->isSubmitted() && $form->isValid()) {
                $user->setPlainPassword($user->getPassword());
                $user->setEnabled(1);
                $em = $this->getDoctrine()->getManager();
                $user->setCatedra($em->getRepository('AppBundle:Catedras')->findOneById(
                    $em->getRepository('AppBundle:UserCatedra')->findOneByIduser($this->getUser())));
                //todo lo de ariba te trae la catedra solo si es secretario.
                $userManager->updateUser($user);
                return $this->redirectToRoute('user_show', array('id' => $user->getId()));
            }

            return $this->render('user/new.html.twig', array(
                'user' => $user,
                'form' => $form->createView(),
            ));
        }else{
            return $this->redirect($this->generateUrl('cursos_index'));
        }
    }

    /**
     * Finds and displays a User entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        if( esSecretario($this)){    
            $deleteForm = $this->createDeleteForm($user);

            return $this->render('user/show.html.twig', array(
                'user' => $user,
                'delete_form' => $deleteForm->createView(),
            ));
        }else{
            return $this->redirect($this->generateUrl('cursos_index'));
        }
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        if (esSecretario($this)){
            $deleteForm = $this->createDeleteForm($user);
            $editForm = $this->createForm('AppBundle\Form\UserType', $user);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
            }

            return $this->render('user/edit.html.twig', array(
                'user' => $user,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        }else{
            return $this->redirect($this->generateUrl('cursos_index'));
        }
    }

    /**
     * Deletes a User entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, User $user)
    {
        if(esSecretario($this)){
            $form = $this->createDeleteForm($user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($user);
                $em->flush();
            }
            return $this->redirectToRoute('user_index');
        }else{
            return $this->redirect($this->generateUrl('cursos_index'));
        }
    }

    /**
     * Creates a form to delete a User entity.
     *
     * @param User $user The User entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
