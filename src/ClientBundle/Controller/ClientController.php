<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ClientBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of ClientController
 *
 * @author jonathan-gomez
 */
class ClientController extends Controller
{  
     /**
     * Lists all annonce entities.
     *
     * @Route("/", name="client")
     * @Method("GET")
     */
    public function getAnnonces() 
    {
        $em = $this->getDoctrine()->getManager();
        /* J'initialise ma variable Entity Manager */

        $annonces = $em->getRepository('AdminBundle:Annonce')->findBy(array(), array('dateparution' => 'desc'), null, null);;
        /* L'entity manager va récuperer toutes les annonces dans le repository annonce */

        return $this->render('ClientBundle:Default:index.html.twig', array(
            'annonces' => $annonces,
        /* Les annonces sont stockées dans un tableau et affichées dans index.html.twig */ 
        ));
    }
    
}