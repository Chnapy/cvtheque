<?php

namespace MG\UserBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity(fields = "username", targetClass = "MG\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "MG\UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class Applicant extends User
{
        /**
     * @var bool
     */
    protected $validate;

    /**
     * @var string
     * @Assert\Length(min=2, max=32)
     */
    private $firstname;

    /**
     * @var string
     * @Assert\Length(min=2, max=32)
     */
    private $lastname;

    /**
     * @var string
     * @Assert\Length(min=1, max=1)
     */
    private $gender;

    /**
     * @var \DateTime
     * @Assert\Date
     */
    private $birthday;

    /**
     * @var string
     * @Assert\Length(min=8, max=128)
     */
    private $titleProfile;
    
    /**
     * @var CVFile
     */
     private $cvFile;
    
    /**
     * @var logBookFile
     */
     private $logBookFile;
          
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $educations;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $workExperiences;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $skills;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $hobbies;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $applications;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $advertisements;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->validate = false; // Un administrateur doit valider un compte applicant
        $this->educations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->workExperiences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->skills = new \Doctrine\Common\Collections\ArrayCollection();
        $this->hobbies = new \Doctrine\Common\Collections\ArrayCollection();
        $this->application = new \Doctrine\Common\Collections\ArrayCollection();
        $this->addRole("ROLE_APPLICANT");
    }
    
    public function isValidate()
    {
        return $this->validate;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setValidate($boolean)
    {
        $this->validate = (bool) $boolean;

        return $this;
    }
    /**
     * permute validate
     *
     * @return bool
     */
    public function permuteValidation() 
    {
        if($this->validate) { $this->validate = false; }
        else { $this->validate = true; }
        return $this->validate;
    }
    
    /**
     * Get age
     *
     * @return int
     */
    public function getAge() {
        $year = $this->birthday->format('Y');
        $month = $this->birthday->format('m'); 
        $day = $this->birthday->format('d');
        if(date('m')-(int)$month>= 0){
            if(date("d")-(int)$day>= 0 ||date('m')>$month){
                return date('Y')-(int)($year);
            }
        }
        return date('Y')-(int)($year)-1;
    }
    
    /**
     * Set username
     *
     * @param string $username
     *
     */
    public function setUsername($username) {
        parent::setUsername($username);
        $this->setSlug($username);
    }
    
    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Applicant
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Applicant
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Applicant
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Applicant
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set titleProfile
     *
     * @param string $titleProfile
     *
     * @return Applicant
     */
    public function setTitleProfile($titleProfile)
    {
        $this->titleProfile = $titleProfile;

        return $this;
    }

    /**
     * Get titleProfile
     *
     * @return string
     */
    public function getTitleProfile()
    {
        return $this->titleProfile;
    }

    
    /**
     * Set cvFile
     *
     * @param \MG\UserBundle\Entity\CVFile $cvFile
     *
     * @return CVFile
     */
    public function setCvFile(\MG\UserBundle\Entity\CVFile $cvFile = null)
    {
        $this->cvFile = $cvFile;

        return $this;
    }

    /**
     * Get cvFile
     *
     * @return \MG\UserBundle\Entity\CVFile
     */
    public function getCvFile()
    {
        return $this->cvFile;
    }
    
    
    /**
     * Set logBookFile
     *
     * @param \MG\UserBundle\Entity\LogBookFile $logBookFile
     *
     * @return LogBookFile
     */
    public function setLogBookFile(\MG\UserBundle\Entity\LogBookFile $logBookFile = null)
    {
        $this->logBookFile = $logBookFile;

        return $this;
    }

    /**
     * Get logBookFile
     *
     * @return \MG\UserBundle\Entity\LogBookFile
     */
    public function getLogBookFile()
    {
        return $this->logBookFile;
    }
    
    /**
     * Add education
     *
     * @param \MG\UserBundle\Entity\Education $education
     *
     * @return Applicant
     */
    public function addEducation(\MG\UserBundle\Entity\Education $education)
    {
        $education->setApplicant($this);
        $this->educations[] = $education;

        return $this;
    }

    /**
     * Remove education
     *
     * @param \MG\UserBundle\Entity\Education $education
     */
    public function removeEducation(\MG\UserBundle\Entity\Education $education)
    {
        $this->educations->removeElement($education);
    }

    /**
     * Get educations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEducations()
    {
        return $this->educations;
    }

    /**
     * Add workExperience
     *
     * @param \MG\UserBundle\Entity\WorkExperience $workExperience
     *
     * @return Applicant
     */
    public function addWorkExperience(\MG\UserBundle\Entity\WorkExperience $workExperience)
    {
        $workExperience->setApplicant($this);
        $this->workExperiences[] = $workExperience;

        return $this;
    }

    /**
     * Remove workExperience
     *
     * @param \MG\UserBundle\Entity\WorkExperience $workExperience
     */
    public function removeWorkExperience(\MG\UserBundle\Entity\WorkExperience $workExperience)
    {
        $this->workExperiences->removeElement($workExperience);
    }

    /**
     * Get workExperiences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkExperiences()
    {
        return $this->workExperiences;
    }

    /**
     * Add skill
     *
     * @param \MG\UserBundle\Entity\Skill $skill
     *
     * @return Applicant
     */
    public function addSkill(\MG\UserBundle\Entity\Skill $skill)
    {
        $skill->setApplicant($this);
        $this->skills[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \MG\UserBundle\Entity\Skill $skill
     */
    public function removeSkill(\MG\UserBundle\Entity\Skill $skill)
    {
        $this->skills->removeElement($skill);
    }

    /**
     * Get skills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Add hobby
     *
     * @param \MG\UserBundle\Entity\Hobby $hobby
     *
     * @return Applicant
     */
    public function addHobby(\MG\UserBundle\Entity\Hobby $hobby)
    {
        $hobby->setApplicant($this);
        $this->hobbies[] = $hobby;

        return $this;
    }

    /**
     * Remove hobby
     *
     * @param \MG\UserBundle\Entity\Hobby $hobby
     */
    public function removeHobby(\MG\UserBundle\Entity\Hobby $hobby)
    {
        $this->hobbies->removeElement($hobby);
    }

    /**
     * Get hobbies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHobbies()
    {
        return $this->hobbies;
    }

    /**
     * Add application
     *
     * @param \MG\UserBundle\Entity\Application $application
     *
     * @return Applicant
     */
    public function addApplication(\MG\UserBundle\Entity\Application $application)
    {
        $application->setApplicant($this);
        $this->applications[] = $application;

        return $this;
    }

    /**
     * Remove application
     *
     * @param \MG\UserBundle\Entity\Application $application
     */
    public function removeApplication(\MG\UserBundle\Entity\Application $application)
    {
        $this->applications->removeElement($application);
    }

    /**
     * Get applications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApplications()
    {
        return $this->applications;
    }
    
    /**
     * Add advertisement
     *
     * @param \CVThequeBundle\Entity\Advertisement $advertisement
     *
     * @return Applicant
     */
    public function addAdvertisement(\CVThequeBundle\Entity\Advertisement $advertisement)
    {
        $this->advertisements[] = $advertisement;

        return $this;
    }

    /**
     * Remove advertisement
     *
     * @param \CVThequeBundle\Entity\Advertisement $advertisement
     */
    public function removeAdvertisement(\CVThequeBundle\Entity\Advertisement $advertisement)
    {
        $this->advertisements->removeElement($advertisement);
    }

    /**
     * Get advertisements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdvertisements()
    {
        return $this->advertisements;
    }
}
