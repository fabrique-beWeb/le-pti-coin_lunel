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
        
         //ici je récupère toutes les demandes si je suis admin
        if ($this->getUser()->getRoles() == array('ROLE_ADMIN')) {
            $repository = $this->getDoctrine()->getManager()->getRepository('AdminBundle:Demande');
            $demandes = $repository->findBy(array(), array('dateparution' => 'desc'), null, null);
        }
          //ici je récupère uniquement MES demandes si je suis user
        if ($this->getUser()->getRoles() == array('ROLE_USER')) {
            $repository = $this->getDoctrine()->getManager()->getRepository('AdminBundle:Demande');
            $demandes = $repository->findBy(array('demandeur' => $this->getUser()->getUsername()), array('dateparution' => 'desc'), null, null);
        }
        
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
        /* Je crée une fonction nouvelle demande */ 
        $form = $this->createForm('AdminBundle\Form\DemandeType', $demande);
        /* Je récupère le formulaire stocké dans DemandeType */
        $form->handleRequest($request);
        /* Je lie mon formulaire avec mes champs */

        if ($form->isSubmitted() && $form->isValid()) {
            /* si mon formulaire est envoyé et qu'il est valide */
            $nomDuFichier = md5(uniqid()) . "." . $demande->getImg()->getClientOriginalExtension();
            /* Récupère le nom de l'image et le hash, avant d'ajouter l'extension de l'image après le hash */
            $demande->getImg()->move('uploads/img', $nomDuFichier);
            /* Je sauvegarde une copie de mon image hashée dans mon dossier web/uploads/img */
            $demande->setImg($nomDuFichier);
            /* J'add mon image hashée à ma nouvelle annonce */
            $em = $this->getDoctrine()->getManager();
            /* J'initialise ma variable Entity Manager */
            $demande->setDemandeur($this->getUser()->getUsername());
            /* Je régle le nom du demandeur sur l'username de l'utilisateur enregistré */
            $demande->setDateparution(new DateTime()); 
            /* Règle la date sur la date actuelle */
            $em->persist($demande);
            /* J'enregistre mon formulaire */
            $em->flush($demande);
            /* J'envoie mon formulaire dans la base de données */

            return $this->redirectToRoute('showdemande', array('id' => $demande->getId()));
            /* Je me redirige sur la page de ma demande nouvellement créée grace à l'id */
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
