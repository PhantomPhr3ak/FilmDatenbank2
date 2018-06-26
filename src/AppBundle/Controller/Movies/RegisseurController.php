<?php

namespace AppBundle\Controller\Movies;

use AppBundle\Entity\Movies\Regisseur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Regisseur controller.
 *
 * @Route("admin/regisseur")
 */
class RegisseurController extends Controller
{
    /**
     * Lists all regisseur entities.
     *
     * @Route("/", name="admin_regisseur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $regisseurs = $em->getRepository('AppBundle:Movies\Regisseur')->findAll();

        return $this->render('movies/regisseur/index.html.twig', array(
            'regisseurs' => $regisseurs,
        ));
    }

    /**
     * Creates a new regisseur entity.
     *
     * @Route("/new", name="admin_regisseur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $regisseur = new Regisseur();
        $form = $this->createForm('AppBundle\Form\Movies\RegisseurType', $regisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($regisseur);
            $em->flush();

            return $this->redirectToRoute('admin_regisseur_show', array('id' => $regisseur->getId()));
        }

        return $this->render('movies/regisseur/new.html.twig', array(
            'regisseur' => $regisseur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a regisseur entity.
     *
     * @Route("/{id}", name="admin_regisseur_show")
     * @Method("GET")
     */
    public function showAction(Regisseur $regisseur)
    {
        $deleteForm = $this->createDeleteForm($regisseur);

        return $this->render('movies/regisseur/show.html.twig', array(
            'regisseur' => $regisseur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing regisseur entity.
     *
     * @Route("/{id}/edit", name="admin_regisseur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Regisseur $regisseur)
    {
        $deleteForm = $this->createDeleteForm($regisseur);
        $editForm = $this->createForm('AppBundle\Form\Movies\RegisseurType', $regisseur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_regisseur_edit', array('id' => $regisseur->getId()));
        }

        return $this->render('movies/regisseur/edit.html.twig', array(
            'regisseur' => $regisseur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a regisseur entity.
     *
     * @Route("/{id}", name="admin_regisseur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Regisseur $regisseur)
    {
        $form = $this->createDeleteForm($regisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($regisseur);
            $em->flush();
        }

        return $this->redirectToRoute('admin_regisseur_index');
    }

    /**
     * Creates a form to delete a regisseur entity.
     *
     * @param Regisseur $regisseur The regisseur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Regisseur $regisseur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_regisseur_delete', array('id' => $regisseur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
