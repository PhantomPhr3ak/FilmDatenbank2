<?php
/**
 * Created by PhpStorm.
 * User: kai
 * Date: 27.02.18
 * Time: 15:38
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Movies\Movie;
use AppBundle\Entity\Movies\Regisseur;
use AppBundle\Entity\Movies\producer;


use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;


class MovieController extends Controller
{
    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

    /**
     * @Route("/", name="movie_home")
     */
    public function indexAction(){
        $movies = $this->getDoctrine()->getRepository('AppBundle:Movies\Movie')->findAll();

        return $this->render('movies/index.html.twig', array(
            'status' => 'Ok',
            'movies' => $movies
        ));
    }

    /**
     * @Route("/create/movie", name="movie_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function createAction(Request $request){
        $movie = new Movie();

        $form = $this->createFormBuilder($movie)
            ->add('name', TextType::class, array('attr' => array('style' => 'max-width: 50%','class' => 'm-2 form-control')))
            ->add('date', DateType::class, array('attr' => array('style' => 'max-width: 50%','class' => 'm-2 form-control')))
            ->add('description', TextareaType::class, array('attr' => array('style' => 'max-width: 50%','class' => 'm-2 form-control')))
            ->add('regisseur', EntityType::class, array('class' => Regisseur::class,'required' => false,'attr' => array('style' => 'max-width: 50%','class' => 'm-2 form-control')))
            ->add('producer', EntityType::class, array('class' => producer::class,'required' => false,'attr' => array('style' => 'max-width: 50%','class' => 'm-2 form-control')))
            ->add('submit', SubmitType::class, array('label' => 'Insert', 'attr' => array('style' => 'margin-top: 1rem;', 'class' => 'btn btn-primary')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $movie = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();

            return $this->redirectToRoute('movie_home');
        }

        return $this->render('movies/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/create/producer", name="producer_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function createProducerAction(Request $request){
        $producer = new producer();

        $form = $this->createFormBuilder($producer)
            ->add('name', TextType::class, array('attr' => array('style' => 'max-width: 50%', 'class' => 'form-control m-3')))
            ->add('website', TextType::class, array('required' => false,'attr' => array('style'=>'max-width: 50%', 'class' => 'form-control m-3')))
            ->add('submit', SubmitType::class, array('attr' => array('class' => 'btn btn-success m-3')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($producer);
            $em->flush();

            return $this->redirectToRoute('movie_home');
        }

        return $this->render('movies/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("create/regisseur", name="regisseur_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function createRegisseurAction(Request $request){
        $regisseur = new Regisseur();

        $form = $this->createFormBuilder($regisseur)
            ->add('fullName', TextType::class, array('attr' => array('style' => 'max-width: 50%', 'class' => 'form-control m-3')))
            ->add('birthday', DateType::class, array('required' => false,'attr' => array('style'=>'max-width: 50%', 'class' => 'form-control m-3')))
            ->add('submit', SubmitType::class, array('attr' => array('class' => 'btn btn-success m-3')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($regisseur);
            $em->flush();

            return $this->redirectToRoute('movie_home');
        }

        return $this->render('movies/create.html.twig', array(
            'form' => $form->createView()
        ));
    }
}