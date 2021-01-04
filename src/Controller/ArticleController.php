<?php 
    namespace App\Controller;

    use App\Entity\Article;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class ArticleController extends AbstractController {
        /**
         * @Route("article")
         */

        public function article(): Response {
            $article = $this->getDoctrine()->getRepository;
            (Article::class)->findAll();

            return $this->render('article/article.html.twig', array
                ('article' => $article)
            );
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