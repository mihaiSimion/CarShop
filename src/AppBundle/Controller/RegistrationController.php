<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Profile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class RegistrationController extends Controller
{
    /**
     * @Route("/register" , name="register")
     */
    public function registerAction(Request $request)
    {
        $profile = new Profile();
        $form = $this->get('profile_form.form');
        $registerForm = $form->buildRegistrationForm($this->createFormBuilder($profile), []);
        $registerForm->handleRequest($request);
        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
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

            $token = new UsernamePasswordToken(
                $profile,
                $password,
                'main',
                $profile->getRoles()
            );
            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));

            $this->addFlash('success', 'You are now successfully registered!');

            return $this->redirectToRoute('show_statistics');
        }

        return $this->render('dealership/registration/register.html.twig', [
            'registration_form' => $registerForm->createView(),

        ]);
    }

    /**
     * @Route("/login" , name = "login")
     */
    public function loginAction()
    {
        return $this->render('dealership/security/login.html.twig');
    }

    /**
     * @Route("/logout")
     */
    public function logoutAction()
    {
        return $this->redirect('show_statistics');
    }

    /**
     * @Route("/wrong_password" , name="wrong_password")
     */
    public function wrongPasswordAction()
    {
        return $this->render('dealership/security/fail_login.html.twig');
    }
}
