<?php
/**
 * Created by PhpStorm.
 * User: kai
 * Date: 02.03.18
 * Time: 11:19
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends Controller
{
    /**
     * @param Request $request
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request){

    }
}