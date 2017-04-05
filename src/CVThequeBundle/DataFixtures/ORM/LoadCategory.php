<?php

namespace MG\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CVThequeBundle\Entity\Category;

class LoadCategory extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface{

    public function load(ObjectManager $manager){

        // Création de catégories
        $category01 = new Category();
        $category01->setName("Informatique");
        $category02 = new Category();
        $category02->setName("Gestion");
        $category03 = new Category();
        $category03->setName("Journalisme");
        
        $manager->persist($category01);
        $manager->persist($category02);
           $manager->persist($category03);
        
        $manager->flush();
        
        $this->addReference('category01', $category01);
        $this->addReference('category02', $category02);
        $this->addReference('category03', $category03);
    }

    public function getOrder(){

        return 1;

    }
}