<?php

namespace App\Controller;

use App\Entity\Person;
use App\Repository\PersonRepository;
use App\Form\PersonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;

use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{
    /**
     * @Route("/person", name="person")
     */
    public function index(): Response
    {
        $person = $this->getDoctrine()->getRepository
        (Person::class)->findAll();

        return $this->render('person/index.html.twig', [
            'persons' => $person,
        ]);
    }

    /**
     * @Route("/person/create", name="person_create", methods={"GET", "POST"})
     */
    public function create(Request $request){
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);

        $person = $this->prosesForm($request, $form);
        if($person){
            return $this->redirectToRoute('person');
        }
        return $this->render('person/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/person/edit/{id}", name="person_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Person $person){
        // dump($person); exit;
        $form = $this->createForm(PersonType::class, $person);
        
        $person = $this->prosesForm($request, $form);
        if($person){
            return $this->redirectToRoute('person');
        }
        return $this->render('person/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    protected function prosesForm(Request $request, FormInterface $form){
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $person = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($person);
            $entityManager->flush();

            return $person;

        }
        return null;
    }


    /**
     * @Route("/person/delete/{id}", name="person_delete", methods={"GET"})
     */
    public function delete(Person $person)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($person);
        $entityManager->flush();

        return $this->redirectToRoute('person');
    }
}
