<?php

namespace MG\UserBundle\Tests\Entity;
use MG\UserBundle\Entity\Applicant;
use PHPUnit\Framework\TestCase;

/**
 * Classe de test pour l'objet Applicant
 */
final class ApplicantTest extends TestCase {

	/**
	 * Test du rôle pour l'applicant
	 */
	public function testRole(){

		$applicant = new Applicant();
		$r = $applicant->getRoles();
		$this->assertEquals($r, "ROLE_APPLICANT");

	}

	/**
	 * Vérifie le bon fonctionnement de la validation
	 */
	public function testValidation(){

		//Test si validate = false lors de la création
		$applicant = new Applicant();
		$v = $applicant->isValidate();
		$this->assertEquals($v, false);

		//Test si validate = true après son changement
		$applicant->setValidate(true);
		$v = $applicant->isValidate();
		$this->assertEquals($v, true);

		//Test si validate = false après exécution de la méthode permuteValidation
		$applicant->permuteValidation();
		$v = $applicant->isValidate();
		$this->assertEquals($v, false);

	}
}


?>