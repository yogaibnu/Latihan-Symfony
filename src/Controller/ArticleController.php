<?php 
    namespace App\Controller;

    use App\Entity\Article;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;

    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    use Symfony\Component\Security\Core\Exception\AccessDeniedException;
    
    class ArticleController extends AbstractController {
        /**
         * @Route("article", name="article_list")
         */
        public function article(): Response {
            $article = $this->getDoctrine()->getRepository
            (Article::class)->findAll();
            
            if (!$this->isGranted('ROLE_USER')) {
                throw new AccessDeniedException();
            }

            return $this->render('article/article.html.twig', array
                ('article' => $article)
            );
        }

        /**
         * @Route("/article/new", name="new_article")
         * @Method({"GET", "POST"})
         */
        public function new(Request $request) {
            $article = new Article();

            $form = $this->createFormBuilder($article)
            ->add('title', TextType::class, array('attr' =>
            array('class' => 'form-control')))
            ->add('body', TextareaType::class, array(
                'required' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Create',
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();
            
            $form -> handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {
                $article = $form->getData();

                $entitiyManager = $this->getDoctrine()->getManager();
                $entitiyManager->persist($article);
                $entitiyManager->flush();

                return $this->redirectToRoute('article_list');
            }

            return $this->render('article/new.html.twig', array(
                'form' => $form->createView()
            ));
        }

        /**
         * @Route("/article/edit/{id}", name="edit_article")
         * @Method({"GET", "POST"})
         */
        public function edit(Request $request, $id) {
            $article = new Article();
            $article = $this->getDoctrine()->getRepository
            (Article::class)->find($id);

            $form = $this->createFormBuilder($article)
            ->add('title', TextType::class, array('attr' =>
            array('class' => 'form-control')))
            ->add('body', TextareaType::class, array(
                'required' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Update',
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();
            
            $form -> handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {

                $entitiyManager = $this->getDoctrine()->getManager();
                $entitiyManager->flush();

                return $this->redirectToRoute('article_list');
            }

            return $this->render('article/edit.html.twig', array(
                'form' => $form->createView()
            ));
        }

        /**
         * @Route("/article/{id}", name="article_show")
         */
        public function show($id) {
            $article = $this->getDoctrine()->getRepository
            (Article::class)->find($id);

            return $this->render('article/show.html.twig', array
                ('article' => $article)
            );
        }

        /**
         * @Route("/article/delete/{id}")
         * @Method({"DELETE"})
         */
        public function delete(Request $request, $id) {
            $article = $this->getDoctrine()->getRepository
            (Article::class)->find($id);

            $entitiyManager = $this->getDoctrine()->getManager();
            $entitiyManager->remove($article);
            $entitiyManager->flush();

            // $response = new Response();
            // $response->send();

            return $this->redirectToRoute('article_list');
        }



        // /**
        //  * @Route("/article/save")
        //  */
        // public function save() : Response {
        //     $entitiyManager = $this->getDoctrine()->getManager();

        //     $article = new Article();
        //     $article->setTitle('Article Satu');
        //     $article->setBody('isi dari artikel satu');

        //     $entitiyManager->persist($article);

        //     $entitiyManager->flush();

        //     return new Response ('Menyimpan artikel id '
        //     .$article->getId());
        // }
    }
?>