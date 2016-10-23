<?php

namespace MyCompany\ArticleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use MyCompany\ArticleBundle\Entity\Article;
use MyCompany\ArticleBundle\Form\ArticleType;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Article controller.
 *
 */
class ArticleController extends Controller
{
    /**
     * @Route("/", name="news_index")
     * @Template()
     * Lists all Article entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('MyCompanyArticleBundle:Article')->getUpcomingArticles();

        return array('articles' => $articles,);
    }

    /**
     * Creates a new Article entity.
     *
     */
    public function newAction(Request $request)
    {
        $this->enforceUserSecurity();

        $article = new Article();
        $this->enforceOwnerSecurity($article);

        $form = $this->createForm('MyCompany\ArticleBundle\Form\ArticleType', $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $article->setOwner($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('news_show', array('id' => $article->getId()));
        }

        return $this->render('MyCompanyArticleBundle:Article:new.html.twig', array(
            'article' => $article,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Article entity.
     *
     */
    public function showAction(Article $article)
    {
        $deleteForm = $this->createDeleteForm($article);

        return $this->render('MyCompanyArticleBundle:Article:show.html.twig', array(
            'article' => $article,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     */
    public function editAction(Request $request, Article $article)
    {
        $this->enforceUserSecurity();
        $this->enforceOwnerSecurity($article);

        $deleteForm = $this->createDeleteForm($article);
        $editForm = $this->createForm('MyCompany\ArticleBundle\Form\ArticleType', $article);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('news_edit', array('id' => $article->getId()));
        }

        return $this->render('MyCompanyArticleBundle:Article:edit.html.twig', array(
            'article' => $article,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Article entity.
     *
     */
    public function deleteAction(Request $request, Article $article)
    {
        $this->enforceUserSecurity();

        $form = $this->createDeleteForm($article);

        $this->enforceOwnerSecurity($article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('news_index');
    }

    /**
     * Creates a form to delete a Article entity.
     *
     * @param Article $article The Article entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Article $article)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('news_delete', array('id' => $article->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     *
     */
    private function enforceUserSecurity(){

        $securityContext = $this->container->get('security.context');
        if (!$securityContext->isGranted('ROLE_USER')) {
            throw new AccessDeniedException('Need ROLE_USER!');
        }
    }

    /**
     * @param Article $article
     */
    private function enforceOwnerSecurity(Article $article){
        $user = $this->getUser();

        if ($user != $article->getOwner()) {
            throw new AccessDeniedException('you are not owner of this article and you cann`t change it');
        }
    }

    /**
     * @param $id
     */
    public function attendAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        /**
         * @var $article \MyCompany\ArticleBundle\Entity\Article
         */
        $article = $em->getRepository('MyCompanyArticleBundle:Event')->find($id);

        if (!$article) {
            throw $this->createNotFoundException('No article found for id '.$id);
        }
        $article->getWriters()->add($this->getUser());

        $em->persist($article);
        $em->flush();
        // array('slug' => 'my-blog-post')
        $url = $this->generateUrl('news_show', ["attend" => $article->getId()] );

        return $this->redirect($url);
    }

    public function unattendAction($id)
    {

    }
}
