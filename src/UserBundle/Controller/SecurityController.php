<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;


/**
 * Description of SecurityController
 *
 * @author jonathan-gomez
 */
class SecurityController extends Controller
{
  
  public function loginAction(Request $request)
  {
    // Si le visiteur est déjà identifié, on le redirige vers l'accueil
    if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
      return $this->redirectToRoute('accueil');
    }

    // Le service authentication_utils permet de récupérer le nom d'utilisateur
    // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
    // (mauvais mot de passe par exemple)
    $authenticationUtils = $this->get('security.authentication_utils');

    return $this->render('UserBundle:Security:login.html.twig', array(
      'last_username' => $authenticationUtils->getLastUsername(),
      'error'         => $authenticationUtils->getLastAuthenticationError(),
    ));
  }
  
  /**
  * @Route("/createuser", name="createuser")
  */
  
  //En tapant l'url createuser je créer un admin
  public function createUser() {
      $em = $this->getDoctrine()->getManager();
      
      $user_admin = new User();
      //Nouvel user et ci-dessous tous les réglages
      $user_admin->setRoles(array('ROLE_ADMIN'));
      $user_admin->setUsername("admin");
      $user_admin->setPrenom("");
      $user_admin->setNom("");
      $user_admin->setAvatar("");
      $user_admin->setEmail("");
      $user_admin->setTelephone("");
      $user_admin->setCodepostale("");
      $user_admin->setVille("");
      $user_admin->setPassword("admin");
      $user_admin->setSalt("");
      
      $em->persist($user_admin);

        $em->flush();
        return $this->redirectToRoute("login");
  }
  
  /**
     * @Route("/inscription", name="inscription")
     * 
     */
    public function getInscription(Request $request) {//Fonction qui permet de s'inscrire en tant que simple utilisateur
        $em = $this->getDoctrine()->getManager();
        $user = new User(); //Instance de l'entité User
        

        $user_form = $this->createForm(UserType::class, $user);
        if ($request->getMethod() == 'POST') {
            $user_form->handleRequest($request);
            $nomDuFichier = md5(uniqid()) . "." . $user->getAvatar()->getClientOriginalExtension();
            /* Récupère le nom de l'image et le hash, avant d'ajouter l'extension de l'image après le hash */
            $user->getAvatar()->move('uploads/img', $nomDuFichier);
            /* Je sauvegarde une copie de mon image hashée dans mon dossier web/uploads/img */
            $user->setAvatar($nomDuFichier);
            /* J'add mon image hashée à ma nouvelle annonce */
            $user->setSalt("");
            $user->setRoles(array('ROLE_USER'));

            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('accueil');
        }

        return $this->render('admin/inscription.html.twig', array('form' => $user_form->createView()));
    }
}
