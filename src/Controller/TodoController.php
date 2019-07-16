<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TodoController
 * @package App\Controller
 * @Route("/todo")
 */
class TodoController extends AbstractController
{
    /**
     * @Route("/", name="todo")
     */
    public function index(Request $request, SessionInterface $session)
    {
        // récupérer la session
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

    /**
     * @Route("/add/{name}/{content}", name="todo.add")
     */
    public function addTodo(Request $request, $name, $content) {
        $session = $request->getSession();
        if(! $session->has('todos')) {
            $this->addFlash('error', 'Liste non encore initialisée');
        } else {
            $todos = $session->get('todos');
            if(isset($todos[$name])){
                $this->addFlash('error', "le todo $name existe déjà");
            } else {
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash('success', "$name ajouté avec succès");
            }
        }
        return $this->redirectToRoute('todo');
    }

    /**
     * @Route("/delete/{name}", name="todo.delete")
     */
    public function deleteTodo(Request $request, $name) {
        $session = $request->getSession();
        if(! $session->has('todos')) {
            $this->addFlash('error', 'Liste non encore initialisée');
        } else {
            $todos = $session->get('todos');
            if(! isset($todos[$name])){
                $this->addFlash('error', "le todo $name n'existe pas");
            } else {
                unset($todos[$name]);
                $session->set('todos', $todos);
                $this->addFlash('success', "$name supprimé avec succès");
            }
        }
        return $this->redirectToRoute('todo');
    }

    /**
     * @Route("/update/{name}/{content}", name="todo.update")
     */
    public function updateTodo(Request $request, $name, $content) {
        $session = $request->getSession();
        if(! $session->has('todos')) {
            $this->addFlash('error', 'Liste non encore initialisée');
        } else {
            $todos = $session->get('todos');
            if(! isset($todos[$name])){
                $this->addFlash('error', "le todo $name n'existe pas");
            } else {
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash('success', "$name mis à jour avec succès");
            }
        }
        return $this->redirectToRoute('todo');
    }

    /**
     * @Route("/reset", name="todo.reset")
     */
    public function resetTodo(Request $request) {
        $session = $request->getSession();
        $session->clear();
        $this->addFlash('success', "Les todos ont été réinitialisés avec succès");
        return $this->redirectToRoute('todo');
    }

}
