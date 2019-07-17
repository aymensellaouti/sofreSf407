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
     * @Route("/detail/{id}", name="personne.detail")
     */
    public function findPersonne(Personne $personne=null) {
        if($personne)
            return $this->render('personne/index.html.twig',
                array(
                'personne' => $personne
            ));
        $this->addFlash('error', 'personne innexistante');
        return $this->forward('App\Controller\PersonneController::list');
    }

    /**
     * @Route("/list", name="personne.list")
     */
    public function list(){
        $personnes = $this->getDoctrine()->getRepository(Personne::class)->findAll();
        return $this->render('personne/list.html.twig', array(
            'personnes' => $personnes
        ));
    }

    /**
     * @Route("/find/{name}", name="personne.find.name")
     */
    public function findName($name) {
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        $personnes = $repository->findByNameOrdredFirstname($name);
        return $this->render('personne/list.html.twig', array(
            'personnes' => $personnes
        ));
    }
}
