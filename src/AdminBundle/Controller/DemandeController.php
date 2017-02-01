<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Demande;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Demande controller.
 * @Security("has_role('ROLE_USER')")
 * @Route("demande")
 */
class DemandeController extends Controller
{
    /**
     * Lists all demande entities.
     *
     * @Route("/mesdemandes", name="mesdemandes")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $demandes = $em->getRepository('AdminBundle:Demande')->findBy(array(), array('dateparution' => 'desc'), null, null);

        return $this->render('demande/mesdemandes.html.twig', array(
            'demandes' => $demandes,
        ));
    }

    /**
     * Creates a new demande entity.
     *
     * @Route("/newdemande", name="newdemande")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $demande = new Demande();
        $form = $this->createForm('AdminBundle\Form\DemandeType', $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nomDuFichier = md5(uniqid()) . "." . $demande->getImg()->getClientOriginalExtension();
            /* Récupère le nom de l'image et le hash, avant d'ajouter l'extension de l'image après le hash */
            $demande->getImg()->move('uploads/img', $nomDuFichier);
            /* Je sauvegarde une copie de mon image hashée dans mon dossier web/uploads/img */
            $demande->setImg($nomDuFichier);
            /* J'add mon image hashée à ma nouvelle annonce */
            $em = $this->getDoctrine()->getManager();
            $demande->setDemandeur($this->getUser()->getUsername());
            /* Je régle le nom du vendeur sur l'username de l'utilisateur enregistré */
            $demande->setDateparution(new DateTime()); //Règle la date sur la date actuelle
            $em->persist($demande);
            $em->flush($demande);

            return $this->redirectToRoute('showdemande', array('id' => $demande->getId()));
        }

        return $this->render('demande/newdemande.html.twig', array(
            'demande' => $demande,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a demande entity.
     *
     * @Route("/{id}", name="showdemande")
     * @Method("GET")
     */
    public function showAction(Demande $demande)
    {
        $deleteForm = $this->createDeleteForm($demande);

        return $this->render('demande/showdemande.html.twig', array(
            'demande' => $demande,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing demande entity.
     *
     * @Route("/{id}/edit", name="editdemande")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Demande $demande)
    {
        $deleteForm = $this->createDeleteForm($demande);
        $editForm = $this->createForm('AdminBundle\Form\DemandeType', $demande);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $nomDuFichier = md5(uniqid()) . "." . $demande->getImg()->getClientOriginalExtension();
            /* Récupère le nom de l'image et le hash, avant d'ajouter l'extension de l'image après le hash */
            $demande->getImg()->move('uploads/img', $nomDuFichier);
            /* Je sauvegarde une copie de mon image hashée dans mon dossier web/uploads/img */
            $demande->setImg($nomDuFichier);
            /* J'add mon image hashée à ma nouvelle annonce */
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('editdemande', array('id' => $demande->getId()));
        }

        return $this->render('demande/editdemande.html.twig', array(
            'demande' => $demande,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a demande entity.
     *
     * @Route("/{id}", name="demande_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Demande $demande)
    {
        $form = $this->createDeleteForm($demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($demande);
            $em->flush($demande);
        }

        return $this->redirectToRoute('mesdemandes');
    }

    /**
     * Creates a form to delete a demande entity.
     *
     * @param Demande $demande The demande entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Demande $demande)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demande_delete', array('id' => $demande->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
