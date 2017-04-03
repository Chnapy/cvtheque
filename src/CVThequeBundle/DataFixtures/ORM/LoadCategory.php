<?php

namespace MG\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CVThequeBundle\Entity\Category;

class LoadCategory extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface{

	public function load(ObjectManager $manager){

		//Création des catégories
		$cateAdvert = new Category();
		$cateAdvert->setName("Informatique");
		$cateAdvert1 = new Category();
		$cateAdvert1->setName("Gestion");
		$cateAdvert2 = new Category();
		$cateAdvert2->setName("Comptabilité");
        $this->addReference('Informatique', $cateAdvert);
        $this->addReference('Gestion', $cateAdvert1);
        $this->addReference('Comptabilité', $cateAdvert2);

		$cateAdmin = new Category();
		$cateAdmin->setName("Admin");
		$this->addReference('Admin', $cateAdmin);
		
		$cateApplicant = new Category();
		$cateApplicant->setName("Applicant");
		$this->addReference('Applicant', $cateApplicant);
		
		$cateSociety = new Category();
		$cateSociety->setName("Society");
		$this->addReference('Society', $cateSociety);

		$manager->persist($cateAdvert);
		$manager->persist($cateAdvert1);
		$manager->persist($cateAdvert2);
		$manager->persist($cateAdmin);
		$manager->persist($cateApplicant);
		$manager->persist($cateSociety);
		
		$manager->flush();
	}

	public function getOrder(){

		return 1;

	}





}