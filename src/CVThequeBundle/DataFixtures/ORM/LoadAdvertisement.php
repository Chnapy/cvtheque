<?php

namespace MG\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CVThequeBundle\Entity\Category;
use CVThequeBundle\Entity\Advertisement;

class LoadAdvertisement extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface{

    public function load(ObjectManager $manager){

        //Création des l'annonces
        for($i=0;$i<20;$i++)
        {    
        $advert = new Advertisement(); //setPublished=true

        $advert->setSociety($this->getReference("society"));
        
        $advert->setCategory($this->getReference("category01"));
        $advert->setCreatedValue();
        $advert->setUpdatedValue();

        $advert->setTitle("analyste java".strval($i));
        $advert->setAuthor("Entreprise SOGET SA".strval($i));

        $advert->setContent("
            SOGET est un éditeur de logiciel, leader mondial sur son marché. La société développe, commercialise et met en œuvre ses solutions informatiques pour faciliter le commerce international. SOGET évolue dans un environnement composé d'interlocuteurs de haut niveau et de partenaires prestigieux. Avec près de 130 employés, SOGET a réalisé 14,6 millions d'euros de CA en 2014.\n\nDans le cadre du développement de la société, nous recrutons un Analyste développeur Java/J2EE (F/H).\nLe poste et les missions principales :\nAu sein de la Direction Opérationnelle des Projets et sous la responsabilité d'un Team Leader, vous participez à l'analyse fonctionnelle et technique, aux développements, aux tests, à la documentation, à la livraison et à la maintenance d'un logiciel implémenté en Java/J2EE.\n\n Environnement technique : Weblogic, Oracle, Clearcase, Clearquest ;\nEnvironnement fonctionnel : logistique et douanier.\n\nConditions requises\nDiplôme : Bac +5 spécialisation informatique\nLangues : anglais technique de bon niveau (compréhension de documentations techniques et/ou missions à l'international) est un atout supplémentaire\nExpérience professionnelle : Débutant accepté\nCompétences : Connaissances des méthodes et normes de modélisation (UML, Merise) et de développement (design patterns)\nConnaissances en gestion de configuration\nConnaissances des standards J2EE (EJB, JMS, ...)\nConnaissances des langages Java/Javascript\nConnaissances de l'environnement Oracle (SQL, PL/SQL) \n\nQualités personnelles : Bonnes qualités relationnelles \nOuverture d'esprit \nRigueur \nMotivation \nAutonomie \nAdaptabilité
            ");
            $manager->persist($advert);
        }

        
        $manager->flush();

    }

    public function getOrder(){

        return 3;

    }





}