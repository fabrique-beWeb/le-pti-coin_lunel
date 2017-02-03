<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ClientBundle\Controller;

use AdminBundle\Entity\Annonce;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ClientController
 *
 * @author jonathan-gomez
 */
class ClientController extends Controller {

    /**
     * Lists all annonce entities.
     *
     * @Route("/", name="client")
     * @Method("GET")
     */
    public function getAnnonces() {
        $em = $this->getDoctrine()->getManager();
        /* J'initialise ma variable Entity Manager */

        $annonces = $em->getRepository('AdminBundle:Annonce')->findBy(array(), array('dateparution' => 'desc'), null, null);
        ;
        /* L'entity manager va récuperer toutes les annonces dans le repository annonce */

        return $this->render('ClientBundle:Default:index.html.twig', array(
                    'annonces' => $annonces,
                        /* Les annonces sont stockées dans un tableau et affichées dans index.html.twig */
        ));
    }

    /**
     * Vue qui affiche les détails des annonces côté client
     *
     * @Route("/showdetail/{id}", name="showdetail")
     * @Method("GET")
     */
    public function showDetail(Annonce $annonce) {

        return $this->render('ClientBundle:Default:detailannonce.html.twig', array(
                    'annonce' => $annonce,
                        )
        );
    }

//    /**
//     * @Route("/mail/{mail}", name="mail")
//     * @Security("has_role('ROLE_USER')")
//     * @Template("accueil.html.twig")
//     */
//    public function sendMail($mail) {
//        
//    }

    /**
     * 
     * @Route("/mailform/{mail}", name="mailform")
     * @Security("has_role('ROLE_USER')")
     *
     */
    public function getMailform(Request $request, $mail) {

        $form = $this->createFormBuilder()
                ->add('body', TextareaType::class)
                ->add('submit', SubmitType::class, array('label' => 'Envoyer'))
                ->getForm();
        $mailBody = $request->get('form')['body'];
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            

            $usr = $this->get('security.token_storage')->getToken()->getUser();
            $usr->getUsername();
            
            $message = Swift_Message::newInstance()
                    ->setFrom("lepetitcoin.beweb@gmail.com")
                    ->setTo($mail)
                    ->setSubject("Le Petit Coin : " . $usr . " a répondu à votre annonce!")
                    ->setBody($mailBody)
                    ;

            $this->get('mailer')->send($message);
        }

            return $this->render('ClientBundle:Default:mail.html.twig', array(
                        'form' => $form->createView()
                            )
            );
        }
    }