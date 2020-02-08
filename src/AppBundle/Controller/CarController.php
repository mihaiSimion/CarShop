<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends Controller
{
    /**
     * @Route("/list_cars/{page}", name="list_cars")
     */
    public function listCarsAction($page = 0)
    {
        $hasMoreItems = false;
        $profiles = $this->getDoctrine()->getRepository(Car::class)->getCarsByPage($page);
        if (sizeof($profiles) > 2) {
            $hasMoreItems = true;
            array_pop($profiles);
        }

        return $this->render('dealership/list_cars_by_page.html.twig', [
            'cars' => $profiles,
            'page' => $page,
            'hasMoreItems' => $hasMoreItems
        ]);
    }

    /**
     * @Route("/add_car", name="add_car")
     */
    public function addCarAction(Request $request)
    {
        $newCar = new Car();
        $form = $this->get('car_form.form');
        $carForm = $form->buildForm($this->createFormBuilder($newCar), []);

        $carForm->handleRequest($request);
        if ($carForm->isSubmitted() && $carForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newCar);
            $em->flush();
            return $this->redirectToRoute('list_cars');
        }

        return $this->render('dealership/add_car.html.twig', [
            'myForm' => $carForm->createView()
        ]);
    }

    /**
     * @Route("/edit_car/{id}", name="edit_car")
     */
    public function editCarAction(Request $request, int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $carToEdit = $em->getRepository('AppBundle:Car')->find($id);
        $form = $this->get('car_form.form');
        $carForm = $form->buildForm($this->createFormBuilder($carToEdit), []);

        $carForm->handleRequest($request);
        if ($carForm->isSubmitted() && $carForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carToEdit);
            $em->flush();

            return $this->redirectToRoute('list_cars');
        }

        return $this->render('dealership/add_car.html.twig', [
            'myForm' => $carForm->createView()
        ]);
    }

    /**
     * @Route("/remove_car/{id}", name="remove_car")
     */
    public function removeCarAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppBundle:Car')->find($id);
        $em->remove($data);
        $em->flush();

        return $this->redirectToRoute('list_cars');
    }
}
