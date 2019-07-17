<?php

namespace App\Controller;

use App\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PersonneController
 * @package App\Controller
 * @Route("/personne")
 */
class PersonneController extends AbstractController
{
    /**
     * @Route("/add/{name}/{firstname}/{age<\d{1,2}>}/{cin}/{path}",
     *      name="personne"
     * )
     */
    public function index(Request $request, $name, $firstname, $age, $cin, $path)
    {
        $personne = new Personne();
        $personne->setName($name);
        $personne->setFirstname($firstname);
        $personne->setCin($cin);
        $personne->setAge($age);
        $personne->setPath($path);

        $em = $this->getDoctrine()->getManager();
        $em->persist($personne);
        $em->flush();
        return $this->render('personne/index.html.twig', [
            'personne' => $personne
        ]);
    }

    /**
     * @Route("/update/{id}/{name}/{firstname}/{age<\d{1,2}>}/{cin}/{path}",
     *      name="personne"
     * )
     */
    public function update(Request $request, Personne $personne=null, $name, $firstname, $age, $cin, $path)
    {

        if(!$personne) {
            $this->addFlash('error', 'Personne innexistante impossible de la mettre à jour');
            return $this->redirectToRoute('todo');
        }
        $personne->setName($name);
        $personne->setFirstname($firstname);
        $personne->setCin($cin);
        $personne->setAge($age);
        $personne->setPath($path);

        $em = $this->getDoctrine()->getManager();
        $em->persist($personne);
        $em->flush();
        return $this->render('personne/index.html.twig', [
            'personne' => $personne
        ]);
    }

    /**
     * @Route("/personne/cv")
     */
    public function test() {

    }
}
