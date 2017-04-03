<?php

namespace MG\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CVThequeBundle\Entity\Category;

class LoadCategory extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface{

	public function load(ObjectManager $manager){

		//Création de la catégorie
		$category = new Category();
		$category->setName("Informatique");
		
		$category1 = new Category();
		$category1->setName("Gestion");
		
		$category2 = new Category();
		$category2->setName("Comptabilité");
		
        $this->addReference('Informatique', $category);
        $this->addReference('Gestion', $category1);
        $this->addReference('Comptabilité', $category2);


		$manager->persist($category);
		$manager->persist($category1);
		$manager->persist($category2);
		$manager->flush();

	}

	public function getOrder(){

		return 1;

	}





}