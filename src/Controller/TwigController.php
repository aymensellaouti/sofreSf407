<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TwigController extends AbstractController
{
    /**
     * @Route("/tab/{nb?5}", name="twig")
     */
    public function index($nb)
    {
        $tab = [];
        for($i=0;$i<$nb;$i++) {
            $tab[] = rand(0,20);
        }
        return $this->render('twig/index.html.twig', [
            'tab' => $tab,
        ]);
    }
}
