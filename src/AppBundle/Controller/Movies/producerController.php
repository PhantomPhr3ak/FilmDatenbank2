<?php

namespace AppBundle\Controller\Movies;

use AppBundle\Entity\Movies\producer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Producer controller.
 *
 * @Route("admin/producer")
 */
class producerController extends Controller
{
    /**
     * Lists all producer entities.
     *
     * @Route("/", name="admin_producer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $producers = $em->getRepository('AppBundle:Movies\producer')->findAll();

        return $this->render('movies/producer/index.html.twig', array(
            'producers' => $producers,
        ));
    }

    /**
     * Creates a new producer entity.
     *
     * @Route("/new", name="admin_producer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $producer = new Producer();
        $form = $this->createForm('AppBundle\Form\Movies\producerType', $producer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($producer);
            $em->flush();

            return $this->redirectToRoute('admin_producer_show', array('id' => $producer->getId()));
        }

        return $this->render('movies/producer/new.html.twig', array(
            'producer' => $producer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a producer entity.
     *
     * @Route("/{id}", name="admin_producer_show")
     * @Method("GET")
     */
    public function showAction(producer $producer)
    {
        $deleteForm = $this->createDeleteForm($producer);

        return $this->render('movies/producer/show.html.twig', array(
            'producer' => $producer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing producer entity.
     *
     * @Route("/{id}/edit", name="admin_producer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, producer $producer)
    {
        $deleteForm = $this->createDeleteForm($producer);
        $editForm = $this->createForm('AppBundle\Form\Movies\producerType', $producer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_producer_edit', array('id' => $producer->getId()));
        }

        return $this->render('movies/producer/edit.html.twig', array(
            'producer' => $producer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a producer entity.
     *
     * @Route("/{id}", name="admin_producer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, producer $producer)
    {
        $form = $this->createDeleteForm($producer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($producer);
            $em->flush();
        }

        return $this->redirectToRoute('admin_producer_index');
    }

    /**
     * Creates a form to delete a producer entity.
     *
     * @param producer $producer The producer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(producer $producer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_producer_delete', array('id' => $producer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
