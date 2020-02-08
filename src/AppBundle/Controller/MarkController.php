<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mark;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MarkController extends Controller
{
    /**
     * @Route("/list_marks/{page}" , name="list_marks")
     */
    public function listAction($page = 0)
    {
        $hasMoreItems = false;
        $em = $this->getDoctrine()->getManager();
        $marks = $em->getRepository('AppBundle:Mark')->getMarksByPage($page);
        if (sizeof($marks) > 2) {
            $hasMoreItems = true;
            array_pop($marks);
        }

        return $this->render('dealership/list_marks_by_page.html.twig', [
            'marks' => $marks,
            'page' => $page,
            'hasMoreItems' => $hasMoreItems
        ]);
    }

    /**
     * @Route("/add_mark" , name="add_mark")
     */
    public function addMark(Request $request)
    {
        $newMark = new Mark();
        $form = $this->get('mark_form.form');
        $profileForm = $form->buildForm($this->createFormBuilder($newMark), []);
        $profileForm->handleRequest($request);

        if ($profileForm->isSubmitted() && $profileForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($newMark);
            $em->flush();
            return $this->redirectToRoute('list_marks');
        }

        return $this->render('dealership/mark_form.html.twig', [
            'myForm' => $profileForm->createView(),
        ]);
    }

    /**
     * @Route("/edit_mark/{id}" , name="edit_mark")
     */
    public function editMark(Request $request, int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $markToEdit = $em->getRepository('AppBundle:Mark')->find($id);

        $form = $this->get('mark_form.form');
        $markForm = $form->buildForm($this->createFormBuilder($markToEdit), []);

        $markForm->handleRequest($request);
        if ($markForm->isSubmitted() && $markForm->isValid()) {
            $em->persist($markToEdit);
            $em->flush();

            return $this->redirectToRoute('list_marks');

        }

        return $this->render('dealership/update_mark.html.twig', [
            'myForm' => $markForm->createView(),
        ]);
    }

    /**
     * @Route("/remove_mark/{id}" , name="remove_mark")
     */
    public function removeMark(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $markToRemove = $em->getRepository('AppBundle:Mark')->find($id);

        $em->remove($markToRemove);
        $em->flush();

        return $this->redirectToRoute('list_marks');
    }
}
