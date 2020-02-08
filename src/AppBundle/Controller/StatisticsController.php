<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class StatisticsController extends Controller
{
    /**
     * @Route("/statistics_list" , name="show_count")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $carsList = $em->getRepository('AppBundle:Car')->getCarsWithCounter();
        $carStatisticsResources = $this->get('car_statistics.resource_factory')->createList($carsList);
        dump($carStatisticsResources);
        die();
    }

    /**
     * @Route("/generate" , name="generate_users_for_car")
     */
    public function generateAction()
    {
        $em = $this->getDoctrine()->getManager();
        $carRepository = $em->getRepository('AppBundle:Car');

        $carsList = $carRepository->getCarsWithCounter();
        $carStatisticsResources = $this->get('car_statistics.resource_factory')->createList($carsList);
        $carWithMostProfiles = $this->get('car_statitiscs.calculator')
            ->getCarWithMostProfiles($carStatisticsResources);
        $this->get('car_statistics.persistance')
            ->persistData($carStatisticsResources, $carWithMostProfiles);

        return $this->redirectToRoute('show_count');
    }

    /**
     * @Route("/show_statistics" , name="show_statistics")
     */
    public function showStatisticsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository("AppBundle:Profile")->findAll();
        $cars = $em->getRepository("AppBundle:Car")->findAll();
        $marks = $em->getRepository("AppBundle:Mark")->findAll();
        $dealers = $em->getRepository("AppBundle:Dealership")->findAll();

        return $this->render('dealership/homepage.html.twig', [

            'users' => $users,
            'cars' => $cars,
            'marks' => $marks,
            'dealers' => $dealers
        ]);
    }

}
