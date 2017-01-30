<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;


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
      $user_admin->setPassword("admin");
      $user_admin->setSalt("");
      
      $em->persist($user_admin);

        $em->flush();
        return $this->redirectToRoute("login");
  }
}
