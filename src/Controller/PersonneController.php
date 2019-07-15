<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
    /**
     * @Route("/personne/{name}", name="personne")
     */
    public function index(Request $request, $name)
    {
        dump($request);
        return $this->render('personne/index.html.twig', [
            'controller_name' => 'PersonneController',
            'name' => $name,
        ]);
    }

    /**
     * @Route("/personne/cv")
     */
    public function test() {

    }
}
