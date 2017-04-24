<?php

namespace CVThequeBundle\Tests\Entity;
use CVThequeBundle\Entity\Advertisement;
use PHPUnit\Framework\TestCase;

/**
 * Classe de test pour Advertisement
 */
final class AdvertisementTest extends TestCase {

	/**
	 * Test la mise à jour de dateTime lors de la création et de la modification de l'objet Advertisement
	 */
	public function testDateTime(){

		$advertisement = new Advertisement();
		$advertisement->setCreatedValue();
		$createdTime = $advertisement->getCreated();
		$advertisement->setUpdatedTime();
		$updatedTime = $advertisement->getUpdated();
		$this->assertNotEquals($createdTime, $updatedTime);

	}

	/**
	 * Test de la mise à jour de l'attribut published lors de la création d'un objet Advertisement
	 */
	public function testPublished(){

		$advertisement = new Advertisement();
		$this->assertEquals($advertisement->isPublished(), true);

	}

	/**
	 * Test du contenu d'une annonce
	 */
	public function testContent(){

		//Test pour length = null
		$advertisement = new Advertisement();
		$advertisement->setContent("ABCDEFGHIJKLMNOPQRSTUVWXYZ");
		$content = $advertisement->getContent(); // length = null
		$this->assertEquals($content, "ABCDEFGHIJKLMNOPQRSTUVWXYZ");

		//Test pour length initialisé à une valeur (ici length = 20)
		$content = $advertisement->getContent(20);
		$this->assertEquals($content, "ABCDEFGHIJKLMNOPQRST");

	}
}


?>