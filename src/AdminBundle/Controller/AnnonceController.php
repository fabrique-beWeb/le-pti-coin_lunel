<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Annonce controller.
 *
 * @Route("admin")
 */
class AnnonceController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function getAccueil()
    {
        return $this->render('base.html.twig');
                
    }
    
    /**
     * Lists all annonce entities.
     *
     * @Route("/mesannonces", name="mesannonces")
     * @Method("GET")
     */
    public function getMesannonces() 
    {
        $em = $this->getDoctrine()->getManager();
        /* J'initialise ma variable Entity Manager */

        $annonces = $em->getRepository('AdminBundle:Annonce')->findAll();
        /* L'entity manager va récuperer toutes les annonces dans le repository annonce */

        return $this->render('admin/mesannonces.html.twig', array(
            'annonces' => $annonces,
        /* Les annonces sont stockées dans un tableau et affichées dans index.html.twig */ 
        ));
    }

    /**
     * Creates a new annonce entity.
     *
     * @Route("/new", name="new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $annonce = new Annonce();
        /* Je crée une fonction nouvelle annonce */
        $form = $this->createForm('AdminBundle\Form\AnnonceType', $annonce);
        /* Je récupère le formulaire stocké dans AnnonceType */
        $form->handleRequest($request);
        /* Je lie mon formulaire avec mes champs */

        if ($form->isSubmitted() && $form->isValid()) {
            /* si mon formulaire est envoyé et qu'il est valide */
            $em = $this->getDoctrine()->getManager();
            /* J'initialise ma variable Entity Manager */
            $em->persist($annonce);
            /* J'enregistre mon formulaire */
            $em->flush($annonce);
            /* J'envoie mon formulaire dans la base de données */
            

            return $this->redirectToRoute('show', array('id' => $annonce->getId()));
            /* Je me redirige sur la page de mon annonce nouvellement créée grace à l'id */
        }

        return $this->render('admin/new.html.twig', array(
            /* si mon formulaire n'est pas valide (tous les champs pas remplis), message d'erreur */
            'annonce' => $annonce,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a annonce entity.
     *
     * @Route("/{id}", name="show")
     * @Method("GET")
     */
    public function showAction(Annonce $annonce)
    {
        $deleteForm = $this->createDeleteForm($annonce);
        /* crée un bouton delete */

        return $this->render('admin/show.html.twig', array(
            'annonce' => $annonce,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing annonce entity.
     *
     * @Route("/{id}/edit", name="edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Annonce $annonce)
    {
        $deleteForm = $this->createDeleteForm($annonce);
        /* bouton delete */
        $editForm = $this->createForm('AdminBundle\Form\AnnonceType', $annonce);
        /* bouton edit */
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            /* verification que le formulaire est valide et sauvegarde sur la database */

            return $this->redirectToRoute('edit', array('id' => $annonce->getId()));
            /* redirige sur la page d'edition */
        }

        return $this->render('admin/edit.html.twig', array(
            'annonce' => $annonce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            /* si le formulaire est invalide, reset et reste sur la page */
        ));
    }

    /**
     * Deletes a annonce entity.
     *
     * @Route("/{id}", name="delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Annonce $annonce)
    {
        $form = $this->createDeleteForm($annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($annonce);
            $em->flush($annonce);
            /* vérifie que le formulaire est valide, appelle l'entity manager, supprime et envoie la suppression dans la database */
        }

        return $this->redirectToRoute('mesannonces');
    }

    /**
     * Creates a form to delete a annonce entity.
     *
     * @param Annonce $annonce The annonce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Annonce $annonce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete', array('id' => $annonce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
