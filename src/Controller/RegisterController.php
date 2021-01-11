<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        
        $form = $this->createForm(UserType::class, $user);

        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));

            $entitiyManager = $this->getDoctrine()->getManager();
            $entitiyManager->persist($user);
            $entitiyManager->flush();

            return $this->redirectToRoute('login');
        }
        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
