<?php


namespace App\Controller;


use App\Form\CvType;
use App\Service\HelperService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{

    /**
     * @var HelperService
     */
    private $helper;

    public function __construct(HelperService $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function first()
    {
        $name = 'aymen';
        $reponse = new Response();
        $aleatoire = $this->helper->getRandomString(5);
        $content = "
                <html>
                <body>
                  Hello $name voici ta chaine aléatoitre $aleatoire
                </body>
                </html>
                 ";
    $reponse->setContent($content);
    $reponse->setStatusCode(200);
    return $reponse;
    }

    /**
     * @Route("/form", name="first.form")
     */
    public function firstForm(Request $request) {

        $form = $this->createForm(CvType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            dd($form->getData());
        }
        dump($form->createView());
        return $this->render('first/firstform.html.twig',
            array(
                'form' => $form->createView()
            )
            );

    }
}