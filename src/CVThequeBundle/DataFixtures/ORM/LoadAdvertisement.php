<?php

namespace MG\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CVThequeBundle\Entity\Category;
use CVThequeBundle\Entity\Advertisement;
use MG\UserBundle\Entity\Skill;

class LoadAdvertisement extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface{

    public function load(ObjectManager $manager){

        //Création des annonces
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
            $manager->flush();
            sleep(5);
        }
        
        
        $advert = new Advertisement(); //setPublished=true
        $skill = new Skill();
        $skill->setName("PHP");
        $advert->addAdvertSkill($skill);
        $skill = new Skill();
        $skill->setName("HTML");
        $advert->addAdvertSkill($skill);
        $skill = new Skill();
        $skill->setName("XML");
        $advert->addAdvertSkill($skill);
        $advert->setSociety($this->getReference("society"));
        $advert->setCategory($this->getReference("category01"));
        $advert->setTitle("Stage développeur web/php h:f issy les moulineaux");
        $advert->setAuthor("SAS KALLISTE");

        $advert->setContent("Notre start-up (entreprise d'insertion spécialisée dans la conception web & logicielle à partir des logiciels libres) propose des stages de développement WEB-PHP-(MY)SQL (types de projet : intranets type GED, portails collaboratifs, web-scraping & text-mining...etc).
 Vous travaillerez au sein d'une équipe de développeurs dans notre bureau d'Issy les Moulineaux en gestion de projet agile et sous l'encadrement quotidien du directeur.
 Un bon niveau d'autonomie est nécessaire.

 Voici les détails du stage :
 Contrat : stage conventionné de 2 mois max (ou plus pour les stagiaires déjà rémunérés)
 Nombre de postes ouverts : 1 à 2 (binômes appréciés).
 Temps de travail : temps complet (ou temps partiel min 28h/ semaine), horaires adaptables
 Lieu de travail : Issy les Moulineaux (possibilité de télétravail partiel)
 Études : min. bac +1 en informatique");
        $manager->persist($advert);
        $manager->flush();
        sleep(5);
        $advert = new Advertisement(); //setPublished=true
        $skill = new Skill();
        $skill->setName("J2EE");
        $advert->addAdvertSkill($skill);
        $skill = new Skill();
        $skill->setName("EJB");
        $advert->addAdvertSkill($skill);
        $skill = new Skill();
        $skill->setName("Tomcat");
        $advert->addAdvertSkill($skill);
        $advert->setSociety($this->getReference("society"));
        $advert->setCategory($this->getReference("category01"));
        

        $advert->setTitle("Stage / assistant commercial formation (h/f) clichy");
        $advert->setAuthor("Sensiolabs");

        $advert->setContent("SensioLabs est un éditeur de logiciel Open Source & SaaS connu pour repousser sans cesse les limites un langage PHP à l'échelle mondiale et en tant que créateur de Symfony, le framework PHP pour les entreprises et de TWIG, le moteur de templating. 
 Sensiolabs est également organisme de formation certifié. 

 Après avoir levé 5 M€, SensioLabs  accélère sa croissance à travers le déploiement de ses solutions professionnelles en mode SaaS, regroupées au sein du département Blackfire. Ces solutions,  disponibles en ligne, s’adressent à un public de développeurs professionnels et de CTO, dans le monde entier.
 Après les ouvertures réussies de six bureaux en France, Allemagne et Royaume-Uni, la société développe aujourd’hui ses activités en Europe et aux Etats-Unis. Entreprise reconnue et très innovante sur son marché, SensioLabs compte près de 80 collaborateurs en Europe et a réalisé un chiffre d’affaires de 5 millions d’euros en 2014.

 VOS MISSIONS

 Au sein du département Formation, vous assisterez notre Chargé du développement commercial-Formation et interviendrez sur les missions suivantes : 
 o Rédaction des conventions de formation
 o Saisie des informations dans les différentes bases (BO Training, Sugar)
 o Traitement des dossiers et des courriers OPCA
 o Gestion des demandes client, traitement des documents (feuilles de présence, factures…)
o Organisation des déplacements des formateurs
 o Recherche coordonnées clients pour prospection

 VOTRE PROFIL

 De formation Bac +2/3, vous cherchez une 1ère expérience dans le domaine de l’administration et de la gestion notamment des formations, vous avez une bonne expression orale et écrite, une aisance téléphonique et relationnelle. Vous savez faire preuve de rigueur, de réactivité et de patience sans vous départir de votre bonne humeur
 Vous avez une véritable attirance pour les nouvelles technologies, le monde de l’internet et avez envie de participer au développement d’une entreprise de type start-up au rayonnement international, alors venez vite nous rejoindre !");
        $manager->persist($advert);
        $manager->flush();
        sleep(5);
        $advert = new Advertisement(); //setPublished=true
        $skill = new Skill();
        $skill->setName("Symfony");
        $advert->addAdvertSkill($skill);
        $skill = new Skill();
        $skill->setName("ElasticSearch");
        $advert->addAdvertSkill($skill);
        $skill = new Skill();
        $skill->setName("Python");
        $advert->addAdvertSkill($skill);
        $advert->setSociety($this->getReference("society"));
        $advert->setCategory($this->getReference("category01"));
        

        $advert->setTitle("Stage intégrateur / full-stack (h/f) - lyon");
        $advert->setAuthor("Netime");

        $advert->setContent("Pour assister l'équipe dans son pôle création, l'agence web NETiME est à la recherche d'un(e) stagiaire webdesigner/intégrateur passionné(e).

 Environnement de travail : Symfony 2 ou 3, Twig, Bootstrap 3 (4 bientôt), Sass est un plus, JQuery, Ajax

 Votre mission si vous l'acceptez :
- Intégration et mise en page de supports Web
- Création et retouche de logos
- Création de visuels pour la communication interne et externe
 - Mise en place de chartes graphiques ou de maquettes pour des projets de nouveaux sites Internet ou d'applications Web
- Création et connexion d'interface utilisateur en JavaScript

 Votre profil : 
- Vous êtes créatif, capable de faire preuve d'autonomie.
 - Vous vous adaptez vite. 
 - Vous voulez apprendre ou progresser sur Bootstrap, Twig, Jquery (eventuellement VueJS).
- Vous vous intéressez à l'intégration sous Symfony

 Vous naviguez régulièrement sur les sites dédiés au design et à la création en général. 
 Alors votre candidature est susceptible de correspondre à notre recherche.

 Bonus :
 Vous n'avez pas peur de varier les plaisirs, vous vous destinez à un profil Full-Stack et vous voulez progresser sur Symfony nous avons également du travail en back-end.

 Si vous êtes désireux d'apprendre vous pourrez toucher à tous les secteurs et profiter des conseils et de l'encadrement de l'équipe.

 Convention de stage de 4 mois minimum. Merci de faire parvenir vos candidatures (CV, lettre de motivation et liens vers vos projets) par mail ci dessous  
Télétravail : Possible  
Compétences :symfonyintegrateurdesignerfrontendbackendjavascript");
        $manager->persist($advert);
        $manager->flush();
        sleep(5);
        $advert = new Advertisement(); //setPublished=true
        $skill = new Skill();
        $skill->setName("Bootstrap");
        $advert->addAdvertSkill($skill);
        $skill = new Skill();
        $skill->setName("MySQL");
        $advert->addAdvertSkill($skill);
        $skill = new Skill();
        $skill->setName("XML");
        $advert->addAdvertSkill($skill);
        $advert->setSociety($this->getReference("society"));
        $advert->setCategory($this->getReference("category01"));
        $advert->setCreatedValue();
        $advert->setUpdatedValue();

        $advert->setTitle("Le meilleur stage du monde 1000 Euros/mois");
        $advert->setAuthor("Entreprise");

        $advert->setContent("Pour assister l'équipe dans son pôle création, l'agence web NETiME est à la recherche d'un(e) stagiaire webdesigner/intégrateur passionné(e).

 Environnement de travail : Symfony 2 ou 3, Twig, Bootstrap 3 (4 bientôt), Sass est un plus, JQuery, Ajax

 Votre mission si vous l'acceptez :
- Intégration et mise en page de supports Web
- Création et retouche de logos
- Création de visuels pour la communication interne et externe
 - Mise en place de chartes graphiques ou de maquettes pour des projets de nouveaux sites Internet ou d'applications Web
- Création et connexion d'interface utilisateur en JavaScript

 Votre profil : 
- Vous êtes créatif, capable de faire preuve d'autonomie.
 - Vous vous adaptez vite. 
 - Vous voulez apprendre ou progresser sur Bootstrap, Twig, Jquery (eventuellement VueJS).
- Vous vous intéressez à l'intégration sous Symfony

 Vous naviguez régulièrement sur les sites dédiés au design et à la création en général. 
 Alors votre candidature est susceptible de correspondre à notre recherche.

 Bonus :
 Vous n'avez pas peur de varier les plaisirs, vous vous destinez à un profil Full-Stack et vous voulez progresser sur Symfony nous avons également du travail en back-end.

 Si vous êtes désireux d'apprendre vous pourrez toucher à tous les secteurs et profiter des conseils et de l'encadrement de l'équipe.

 Convention de stage de 4 mois minimum. Merci de faire parvenir vos candidatures (CV, lettre de motivation et liens vers vos projets) par mail ci dessous  
Télétravail : Possible  
Compétences :symfonyintegrateurdesignerfrontendbackendjavascript");
        $manager->persist($advert);
        $manager->flush();
    }

    public function getOrder(){

        return 3;

    }





}