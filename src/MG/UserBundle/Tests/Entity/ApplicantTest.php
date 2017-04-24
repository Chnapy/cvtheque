<?php

namespace MG\UserBundle\Tests\Entity;
use MG\UserBundle\Entity\Applicant;

/**
 * Classe de test pour l'objet Applicant
 */
final class ApplicantTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Test du rôle pour l'applicant
	 */
	public function testRole(){

		$applicant = new Applicant();
		$r = applicant->getRoles();
		$this->assertEquals($r, "ROLE_APPLICANT");

	}

	/**
	 * Vérifie le bon fonctionnement de la validation
	 */
	public function testValidation(){

		$applicant = new Applicant();
		$v = $applicant->isValidate();
		$this->assertEquals($v, false);

		$applicant->setValidate(true);
		$v = $applicant->isValidate();
		$this->assertEquals($v, true);

		$applicant->permuteValidation();
		$v = $applicant->isValidate();
		$this->assertEquals($v, false);

	}
}


?>