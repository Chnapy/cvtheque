<?php

namespace MG\UserBundle\Tests\Entity;
use MG\UserBundle\Entity\User;

final class UserTest extends \PHPUnit_Framework_TestCase {

	public function testSlugify(){

		$user = new User();

		$this->assertEquals('hello-world', $user->slugify('Hello World'));

	}
}


?>