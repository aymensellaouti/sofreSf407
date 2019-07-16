<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
    /**
     * @Route("/personne/{name}/{age<\d{1,2}>}/{section<gl|rt>}/{langue<fr|en>}/{_format?html}",
     *      name="personne"
     * )
     */
    public function index(Request $request, $name, $age, $section, $langue, $_format)
    {
        dump($_format);
        dump($langue);
        return $this->render('personne/index.html.twig', [
            'controller_name' => 'PersonneController',
            'name' => $name,
            'age' => $age,
            'section' => $section
        ]);
    }

    /**
     * @Route("/personne/cv")
     */
    public function test() {

    }
}
