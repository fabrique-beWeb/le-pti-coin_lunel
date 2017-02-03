<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Description of UserController
 * @Security("has_role('ROLE_USER')")
 * @author jonathan-gomez
 */
class UserController extends Controller {

    /**
     * @Route("/profil", name="profil")
     */
    public function getProfil() {//Fonction pour récuperer les informations du profil de l'utilisateur connecté
        $repository = $this->getDoctrine()->getManager()->getRepository('UserBundle:User');
        $monProfil = $repository->findBy(array('username' => $this->getUser()->getUsername()));

        return $this->render('admin/profil.html.twig', array('monProfil' => $monProfil));
    }
    
    /**
     * @Route("/mail/{mail}", name="mail")
     * @Template("accueil.html.twig")
     */
    public function sendMail() {
        $message = Swift_Message::newInstance()
                ->setFrom('lepetitcoin.beweb@gmail.com')
                ->setTo('paul.maillard34@gmail.com')
                ->setSubject("Hello")
                ->setBody("World");

        $this->get('mailer')->send($message);
    }
    
}
