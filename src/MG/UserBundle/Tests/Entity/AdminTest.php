<?php

namespace MG\UserBundle\Tests\Entity;
use MG\UserBundle\Entity\Admin;
use PHPUnit\Framework\TestCase;

/**
 * Classe de test pour l'objet Admin
 */
final class AdminTest extends TestCase {

	/**
	 * Test du rôle pour l'admin
	 */
	public function testRole(){

		$admin = new Admin();
		$this->assertEquals($admin->getRoles()[0], "ROLE_ADMIN");
		
	}
}

?>