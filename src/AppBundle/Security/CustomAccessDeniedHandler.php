<?php
/**
 * Created by PhpStorm.
 * User: kai
 * Date: 23.06.18
 * Time: 11:37
 */

namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class CustomAccessDeniedHandler implements AccessDeniedHandlerInterface
{
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        $content = "Access denied! You don't have enough rights for this area.";

        return new Response($content, 403);
    }
}