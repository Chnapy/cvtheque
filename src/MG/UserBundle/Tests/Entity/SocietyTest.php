<?php

namespace MG\UserBundle\Tests\Entity;
use MG\UserBundle\Entity\Society;

final class SocietyTest extends \PHPUnit_Framework_TestCase {

	public function testRole(){

		$society = new Society();

		$this->assertEquals($society->getRoles(), "ROLE_SOCIETY");

	}
}


?>