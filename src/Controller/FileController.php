<?php

namespace App\Controller;

use App\Entity\File;
use App\Form\FilesType;
use App\Repository\FileRepository;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FileController extends AbstractController
{
    /**
     * @Route("/file", name="file")
     */
    public function index(): Response
    {
        $file = $this->getDoctrine()->getRepository
        (File::class)->findAll();

        return $this->render('file/list.html.twig', [
            'file' => $file,
        ]);
    }

    /**
     * @Route("/file/form/{id}", defaults={"id"=null}, name="file_form", methods={"POST", "GET"})
     */
    public function form(Request $request, ?string $id=null, FileRepository $repository)
    {
        if ($id){
            $berkas = $repository->find($id);
        }else{
            $berkas = new File();
        }

        if (!$berkas) {
            throw new NotFoundHttpException();
        }            

        $form = $this->createForm(FilesType::class, $berkas);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            // $file = $form->getData();
            $file = $request->files->get('form')['files'];

            $uploads_directory = $this->getParameter('uploads_directory');

            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $berkas->setFiles($filename);

            $file->move(
                $uploads_directory,
                $filename
            ); 
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($file);
            $entityManager->flush();

            return $this->redirectToRoute('file');
        }
        return $this->render('file/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
