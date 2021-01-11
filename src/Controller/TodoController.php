<?php

namespace App\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use App\Entity\Todo;
use App\Form\TodoType;
use App\Repository\TodoRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    /**
     * @Route("/todo", name="todo")
     */
    public function todo(): Response
    {
        $todo = $this->getDoctrine()->getRepository
        (Todo::class)->findAll();

        return $this->render('todo/list.html.twig', [
            'todo' => $todo,
        ]);
    }

    /**
     * @Route("/todo/done/{id}", name="todo_done", methods={"GET"})
     */
    public function done(Todo $todo)
    {
        $todo->setIsDone(true);
        $todo->setDoneAt(new \DateTime());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($todo);
        $entityManager->flush();

        return $this->redirectToRoute('todo');
    }

    /**
     * @Route("/todo/form/{id}", defaults={"id"=null}, name="todo_form", methods={"POST", "GET"})
     */
    public function form(Request $request, ?string $id=null, TodoRepository $repository)
    {
        if ($id){
            $todo = $repository->find($id);
        }else{
            $todo = new Todo();
        }

        if (!$todo) {
            throw new NotFoundHttpException();
        }            

        $form = $this->createForm(TodoType::class, $todo);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $todo = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($todo);
            $entityManager->flush();

            return $this->redirectToRoute('todo');
        }
        return $this->render('todo/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/todo/delete/{id}", name="todo_delete", methods={"GET"})
     */
    public function delete(Todo $todo)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($todo);
        $entityManager->flush();

        return $this->redirectToRoute('todo');
    }
}
