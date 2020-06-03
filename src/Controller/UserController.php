<?php

namespace App\Controller;

use App\Form\UserType;
use App\Form\UserEditType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/inscription", name="app_inscription")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $user->setRoles(['ROLE_USER']);

            $plainPassword = $user->getPassword();
            $encodedPassword = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encodedPassword);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/register.html.twig', [
            'registerForm' => $form->createView(),
        ]);
    }


    /**
     * @Route("/espace-personnel", name="app_account")
     */
    public function account(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request); 
         
        if ($form->isSubmitted() && $form->isValid()) {
        
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        
            $this->addFlash(
                'info',
                'Les informations de votre profil ont été mises à jour.' 
            );
            
            return $this->redirectToRoute('app_account');
        }

        return $this->render('partials/account.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
