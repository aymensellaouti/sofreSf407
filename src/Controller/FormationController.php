<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/formation")
 */
class FormationController extends AbstractController
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/edit/{id?0}")
     */
    public function index(Request $request, Formation $formation=null)
    {
        if(!$formation)
            $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->remove('createdAt');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();
        }
        return $this->render('formation/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
