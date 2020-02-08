<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Dealership;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DealershipController extends Controller
{
    /**
     * @Route("/list_dealership/{page}", name="list_dealership")
     */
    public function listAction($page = 0)
    {
        $hasMoreItems = false;
        $em = $this->getDoctrine()->getManager();
        $dealearships = $em->getRepository('AppBundle:Dealership')->getDealershipsByPage($page);
        if (sizeof($dealearships) > 5) {
            $hasMoreItems = true;
            array_pop($dealearships);
        }

        return $this->render('dealership/list_dealership.html.twig', [
            'dealerships' => $dealearships,
            'page' => $page,
            'hasMoreItems' => $hasMoreItems
        ]);
    }

    /**
     * @Route("/add_dealership" , name="add_dealership")
     */
    public function addDealershipAction(Request $request)
    {
        $newDealership = new Dealership();
        $form = $this->get('dealership_form.form');

        $profileForm = $form->buildForm($this->createFormBuilder($newDealership), []);
        $profileForm->handleRequest($request);

        if ($profileForm->isSubmitted() && $profileForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newDealership);
            $em->flush();

            return $this->redirectToRoute('list_dealership');
        }

        return $this->render('dealership/dealership_form.html.twig', [
            'myDealershipForm' => $profileForm->createView(),
            'dealershipObject' => $newDealership
        ]);
    }

    /**
     * @Route("/edit_dealership/{id}" , name="edit_dealership")
     */
    public function editDealeshipAction(Request $request, int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $dealershipToEdit = $em->getRepository('AppBundle:Dealership')->find($id);

        $form = $this->get('dealership_form.form');
        $profileForm = $form->buildEditForm($this->createFormBuilder($dealershipToEdit), []);

        $profileForm->handleRequest($request);
        if ($profileForm->isSubmitted() && $profileForm->isValid()) {
            $em->persist($dealershipToEdit);
            $em->flush();
            return $this->redirectToRoute('list_dealership');
        }

        return $this->render('dealership/update_dealership.html.twig', [
            'myDealershipForm' => $profileForm->createView(),
        ]);
    }

    /**
     * @Route("/remove_dealership/{id}" , name="remove_dealership")
     */
    public function removeMarkAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $dealershipToRemove = $em->getRepository('AppBundle:Dealership')->find($id);

        if (!$dealershipToRemove) {
            $this->render('dealership/error_remove_dealership.html.twig');
        }

        $em->remove($dealershipToRemove);
        $em->flush();

        return $this->redirectToRoute('list_dealership');
    }
}