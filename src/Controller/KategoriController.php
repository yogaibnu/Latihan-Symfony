<?php

namespace App\Controller;

use App\Entity\Kategori;
use App\Form\KategoriType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KategoriController extends AbstractController
{
    /**
     * @Route("/kategori", name="kategori")
     */
    public function index(): Response
    {
        $kategori = $this->getDoctrine()->getRepository
        (Kategori::class)->findAll();

        return $this->render('kategori/index.html.twig', [
            'kategoris' => $kategori,
        ]);
    }

    /**
     * @Route("/kategori/create", name="kategori_create", methods={"GET", "POST"})
     */
    public function create(Request $request)
    {
        $kategori = new Kategori();
        $form = $this->createForm(KategoriType::class, $kategori);

        $kategori = $this->prosesForm($request, $form);
        if($kategori){
            return $this->redirectToRoute('kategori');
        }
        return $this->render('kategori/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/kategori/edit/{id}", name="kategori_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Kategori $kategori)
    {
        $form = $this->createForm(KategoriType::class, $kategori);

        $kategori = $this->prosesForm($request, $form);
        if($kategori){
            return $this->redirectToRoute('kategori');
        }
        return $this->render('kategori/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //fungsi melakukan proses form
    protected function prosesForm(Request $request, FormInterface $form)
    {
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $kategori = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kategori);
            $entityManager->flush();

            return $kategori;
        }
        return null;
    }
    /**
     * @Route("/kategori/delete/{id}", name="kategori_delete", methods={"GET"})
     */
    public function delete(Kategori $kategori)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($kategori);
        $entityManager->flush();

        return $this->redirectToRoute('kategori');
    }

}
