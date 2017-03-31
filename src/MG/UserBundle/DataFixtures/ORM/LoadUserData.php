<?php
namespace MG\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use MG\UserBundle\Entity\Applicant;
use MG\UserBundle\Entity\Society;
use MG\UserBundle\Entity\Admin;
use MG\UserBundle\Entity\Address;

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface 
{
    /**
     * @var ContainerInterface
     */
    private $container;
    
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
        $discriminator->setClass('MG\UserBundle\Entity\Admin');
        $userManager = $this->container->get('pugx_user_manager');
        $address = new Address();
        $address->setStreet('31 Boulevard Jourdan');
        $address->setTown('Paris');
        $address->setZipCode('75014');
        $address->setCountry('FR');
        $admin = $userManager->createUser();
        $admin->setUsername('admin');
        $admin->setFirstname('Martin');
        $admin->setLastname('Gilbert');
        $admin->setPlainPassword('12345');
        $admin->setEmail('martin3129@gmail.com');
        $admin->setPhoneNumber('06 13 74 45 79');
        $admin->setAddress($address);
        $admin->setEnabled(true);
        $userManager->updateUser($admin, true);
        $discriminator->setClass('MG\UserBundle\Entity\Applicant');
        $address = new Address();
        $address->setStreet('31 Boulevard Jourdan');
        $address->setTown('Paris');
        $address->setZipCode('75014');
        $address->setCountry('FR');
        $applicant = $userManager->createUser();
        $applicant->setUsername('applicant');
        $applicant->setFirstname('Martin');
        $applicant->setLastname('Gilbert');
        $applicant->setPlainPassword('12345');
        $applicant->setEmail('martin.gilbert1@uqac.ca');
        $applicant->setPhoneNumber('06 13 74 45 79');
        $applicant->setAddress($address);
        $applicant->setBirthday(new \DateTime('1912-12-12'));
        $applicant->setGender('m');
        $applicant->setTitleProfile('Recherche de stage développement Web : À partir de mai 2017 (4 mois)');
        $applicant->setDescription("Passionné par l'informatique, animé du désir d'apprendre, doté d'un fort esprit d'analyse et d'une concentration à toute épreuve, j'ai la capacité de développer des applications de qualité, maintenables, accessibles et ergonomiques sur des environnements variés grâce à un large éventail de connaissances acquises avec mes formations, mes projets et mes aptitudes autodidactes. Initié à plusieurs langages de programmation, je suis surtout fervent de Java, PHP et Python. J'éprouve particulièrement de l'intérêt pour les bases de données, les applications web et l'accessibilité des nouvelles technologies. La rigueur, le travail d'équipe et les applications bien modélisées sont pour moi des critères permettant à un projet d'être couronné de succès. Présentement, je cherche une entreprise dans laquelle je vais pouvoir mettre à profit mes compétences et les renforcer afin qu'elles soient plus spécifique.");
        $applicant->setEnabled(true);
        $userManager->updateUser($applicant, true);
        $discriminator->setClass('MG\UserBundle\Entity\Society');
        $address = new Address();
        $address->setStreet('31 Boulevard Jourdan');
        $address->setTown('Paris');
        $address->setZipCode('75014');
        $address->setCountry('FR');
        $society = $userManager->createUser();
        $society->setSocietyName('society');
        $society->setPlainPassword('12345');
        $society->setEmail('society@capgemini.com');
        $society->setPhoneNumber('06 13 74 45 79');
        $society->setAddress($address);
        $society->setDescription("Fort de plus de 180 000 collaborateurs et présent dans plus de 40 pays, Capgemini est l'un des leaders mondiaux du conseil, des services informatiques et de l'infogérance. Le Groupe a réalisé en 2014 un chiffre d'affaires de 10,573 milliards d'euros. Avec ses clients, Capgemini conçoit et met en oeuvre les solutions business, technologiques et digitales qui correspondent à leurs besoins et leur permettent d'encourager l'innovation tout en gagnant en compétitivité.");
        $society->setEnabled(true);
        $userManager->updateUser($society, true);
        $this->addReference('admin', $admin);
        $this->addReference('applicant', $applicant);
        $this->addReference('society', $society);
    }
    
    public function getOrder()
    {
        return 1; // number in which order to load fixtures
    }
}