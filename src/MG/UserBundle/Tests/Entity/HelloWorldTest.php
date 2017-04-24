<?php

namespace MG\UserBundle\Tests\Entity;
use MG\UserBundle\Entity\User;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase {

	public function testSlugify(){

		$user = new User();

		$this->assertEquals('hello-world', $user->slugify('Hello World'));

	}
}


?>