<?php

namespace MG\UserBundle\Tests\Entity;
use MG\UserBundle\Entity\Society;
use PHPUnit\Framework\TestCase;

/**
 * Classe de test pour Society
 */
final class SocietyTest extends TestCase {

	/**
	 * Test du rôle pour un objet Society
	 */
	public function testRole(){

		$society = new Society();
		$this->assertEquals($society->getRoles(), "ROLE_SOCIETY");

	}
}


?>