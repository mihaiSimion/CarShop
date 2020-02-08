<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Profile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends Controller
{
    /**
     * @Route("/list_profile/{page}", name="list_profile")
     */
    public function listProfileAction($page = 0)
    {
        $hasMoreItems = false;
        $profiles = $this->getDoctrine()->getRepository(Profile::class)->getProfilesByPage($page);
        if (sizeof($profiles) > 3) {
            $hasMoreItems = true;
            array_pop($profiles);
        }

        return $this->render('dealership/list_users.html.twig', [
            'profiles' => $profiles,
            'page' => $page,
            'hasMoreItems' => $hasMoreItems
        ]);
    }

    /**
     * @Route("/add_profile", name="add_profile")
     */
    public function addProfileAction(Request $request)
    {
        $profile = new Profile();
        $form = $this->get('profile_form.form');
        $profileForm = $form->buildForm($this->createFormBuilder($profile), []);
        $profileForm->handleRequest($request);

        if ($profileForm->isSubmitted() && $profileForm->isValid()) {

            $password = $this
                ->get('security.password_encoder')
                ->encodePassword(
                    $profile,
                    $profile->getPassword()
                );
            $profile->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $profile->setRoles(["ROLE_USER"]);
            $em->persist($profile);
            $em->flush();

            return $this->redirectToRoute('list_profile');
        }

        return $this->render('dealership/add_profile.html.twig', array(
            'myForm' => $profileForm->createView(),
        ));
    }

    /**
     * @Route("/edit_user/{id}", name="edit_user")
     */
    public function editUserAction(Request $request, int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppBundle:Profile')->find($id);
        $getCars = $data->getCars();

        $form = $this->get('profile_form.form');
        $profileForm = $form->buildEditProfileForm($this->createFormBuilder($data), []);
        $profileForm->handleRequest($request);

        if ($profileForm->isSubmitted() && $profileForm->isValid()) {
            $em->persist($data);
            $em->flush();

            return $this->redirectToRoute('list_profile');
        }

        return $this->render('dealership/update_user.html.twig', array(
            'myForm' => $profileForm->createView(),
            'carsArray' => $getCars,
            'userId' => $id
        ));
    }

    /**
     * @Route("/remove_profile/{id}", name="remove_profile")
     */
    public function removeProfileAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppBundle:Profile')->find($id);


        $em->remove($data);
        $em->flush();
        return $this->redirectToRoute('list_profile');
    }

    /**
     * @Route("/promote/{id}", name="promote")
     */
    public function promoteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $promote = $em->getRepository('AppBundle:Profile')->find($id);
        $roles = $promote->getRoles();
        array_push($roles, "ROLE_ADMIN");
        $promote->setRoles($roles);
        $em->persist($promote);
        $em->flush();
        return $this->redirectToRoute('list_profile');
    }

    /**
     * @Route("/reduction/{id}", name="reduction")
     */
    public function reductionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $reduction = $em->getRepository('AppBundle:Profile')->find($id);
        $roles = $reduction->getRoles();
        array_pop($roles);
        $reduction->setRoles($roles);
        $em->persist($reduction);
        $em->flush();
        return $this->redirectToRoute('list_profile');
    }

}
