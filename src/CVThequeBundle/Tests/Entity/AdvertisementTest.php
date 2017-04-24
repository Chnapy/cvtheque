<?php

namespace CVThequeBundle\Tests\Entity;
use CVThequeBundle\Entity\Advertisement;

class AdvertisementTest extends \PHPUnit_Framework_TestCase {

	public function testDateTime(){

		$advertisement = new Advertisement();
		$advertisement->setCreatedValue();
		$createdTime = $advertisement->getCreated();
		$advertisement->setUpdatedTime();
		$updatedTime = $advertisement->getUpdated();
		$this->assertNotEquals($createdTime, $updatedTime);

	}

	public function testPublished(){

		$advertisement = new Advertisement();
		$this->assertEquals($advertisement->isPublished(), true);

	}

	public function testContent(){

		//Test pour length = null
		$advertisement = new Advertisement();
		$advertisement->setContent("ABCDEFGHIJKLMNOPQRSTUVWXYZ");
		$content = $advertisement->getContent(); // length = null
		$this->assertEquals($content, "ABCDEFGHIJKLMNOPQRSTUVWXYZ");

		//Test pour length initialisé à une valeur (ici length = 20)
		$content = $advertisement->getContent(20);
		$this->assertEquals($content, "ABCDEFGHIJKLMNOPQRST")

	}
}


?>