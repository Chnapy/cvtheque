<?php

namespace CVThequeBundle\Tests\Entity;
use CVThequeBundle\Entity\AdvertSkill;
use CVThequeBundle\Entity\Advertisement;

class AdvertSkillTest extends \PHPUnit_Framework_TestCase {

	public function testAdvertisement(){

		//Test pour $advertisement = null
		$advertSkill = new AdvertSkill();
		$advertSkill->setAdvertisement();
		$this->assertEquals($advertSkill->getAdvertisement());

		//Test pour un $advertisement initialisé
		$advertisement = new Advertisement();
		$advertisement->setTitle("foo");
		$advertSkill->setAdvertisement($advertisement);
		$this->assertEquals($advertSkill->getAdvertisement->getTitle(), "foo");

	}
}


?>