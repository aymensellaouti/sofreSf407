<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    /**
     * @Route("/todos", name="todo")
     */
    public function index(Request $request)
    {
        // récupérer la session
        $session = $request->getSession();
        dump($session->has('todos'));
        // verifier si les todos existe dans la session
        if(! $session->has('todos')) {
            // si non
            // j initialise mes todos
            $todos = array(
                'lundi' => 'debut formation Symfo',
                'Jeudi' => 'Fin formation Symfo',
                'Samedi' => 'plage',
            );
            $session->set('todos', $todos);
            // message pour informer sur l init
            $this->addFlash('info', 'todos initialisés avec succès');
        }
        //Affichage de la liste des todos
        return $this->render('todo/index.html.twig');
    }
}
