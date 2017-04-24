<?php

namespace MG\UserBundle\Tests\Entity;
use MG\UserBundle\Entity\Admin;

/**
 * Classe de test pour l'objet Admin
 */
final class AdminTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Test du rôle pour l'admin
	 */
	public function testRole(){

		$admin = new Admin();
		$this->assertEquals($admin->getRoles(), "ROLE_ADMIN");
		
	}
}

?>