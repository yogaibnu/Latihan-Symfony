<?php

namespace App\Controller;

use App\Entity\Produk;
use App\Form\ProdukType;
use App\Repository\ProdukRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProdukController extends AbstractController
{
    /**
     * @Route("/produk", name="produk")
     */
    public function index(): Response
    {
        $produk = $this->getDoctrine()->getRepository
        (Produk::class)->findAll();

        return $this->render('produk/index.html.twig', [
            'produks' => $produk,
        ]);
    }

    /**
     * @Route("/produk/create", name="produk_create", methods={"GET", "POST"})
     */
    public function create(Request $request)
    {
        $produk = new Produk();
        $form = $this->createForm(ProdukType::class, $produk);

        $produk = $this->prosesForm($request, $form);
        if($produk){
            return $this->redirectToRoute('produk');
        }
        return $this->render('produk/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/produk/edit/{id}", name="produk_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Produk $produk)
    {
        $form = $this->createForm(ProdukType::class, $produk);

        $produk = $this->prosesForm($request, $form);
        if($produk){
            return $this->redirectToRoute('produk');
        }
        return $this->render('produk/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("produk/delete/{id}", name="produk_delete", methods={"GET"})
     */
    public function delete(Produk $produk)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($produk);
        $entityManager->flush();

        return $this->redirectToRoute('produk');
    }

    //fungsi create form
    public function prosesForm(Request $request, FormInterface $form)
    {
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $produk = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produk);
            $entityManager->flush();

            return $produk;
        }
        return null;
    }
}
