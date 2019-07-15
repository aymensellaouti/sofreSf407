<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function first()
    {
        $name = 'aymen';
        $reponse = new Response();
        $content = "
                <html>
                <body>
                  Hello $name
                </body>
                </html>
                 ";
    $reponse->setContent($content);
    $reponse->setStatusCode(200);
    return $reponse;
    }
}