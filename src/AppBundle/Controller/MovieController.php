<?php
/**
 * Created by PhpStorm.
 * User: kai
 * Date: 27.02.18
 * Time: 15:38
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Movies;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;


class MovieController extends Controller
{
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
     * @Route("/create", name="movie_create")
     */
    public function createAction(){
        $movie = new Movies\Movie();
        $movie->setDate(new \DateTime('11-11-2009'));
        $movie->setDescription('Hey there');
        $movie->setName('Lucy');
        $movie->setRegisseur('1');

        $em = $this->getDoctrine()->getManager();
        $em->persist($movie);
        $em->flush();

        $status = 'All done';

        return $this->render('movies/index.html.twig', array(
            'status' => $status
        ));
    }
}