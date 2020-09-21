<?php

namespace App\Controller;

use App\Entity\WeatherSearch;
use App\Form\CitySearchType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\WeatherService;

class WeatherController extends AbstractController
{
    
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var WeatherService
     */
    private $weatherService;

    public function __construct(WeatherService $weather, EntityManagerInterface $em)
    {
        $this->weatherService=$weather;
        $this->em=$em;
    }

    /**
     * @Route("/", name="home")
     * @param ObjectManager $manager
     * @param Request $request
     */
    public function index(Request $request): Response
    {
        $info = null;
        $search = new WeatherSearch();
        $form = $this->createForm(CitySearchType::class, $search);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $info=$this->weatherService->getWeather($search);
            if ($info['error'] == null){
                $info['content']->main->temp = round($info['content']->main->temp);
                $description = $info['content']->weather[0]->description;
            } else {
                $this->addFlash('error', 'Veuillez sélectionner un nom de ville valide');
            }
            /**
             * Dans le ou l'on souhaiterait créer un compte utilisateur avec création d'un historique de recherche
             */
//            $this->em->persist($search);
//            $this->em->flush();
//            return $this->redirectToRoute('weather/index.html.twig');
        }



        return $this->render('weather/index.html.twig', array(
            'infos' => $info,
            'form' => $form->createView(),
            'description' => $description
        ));
    }
}
