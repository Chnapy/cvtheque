<?php
// src/MG/BlogBundle/Entity/Image.php

namespace MG\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * 
 */
class LogBookFile
{
    
  /**
   * 
   */
  private $id;

  /**
   * 
   */
  private $extension;
  
  /**
   * @Assert\File(maxSize="10M")
   */
  private $file;

  private $filename;
  
  /**
   * PrePersist & PreUpdate
   */
  public function preUpload()
  {   
    if (null === $this->file) {
      return;
    }
    
    $this->extension = $this->file->guessExtension();
    
  }

  /**
   * PostPersist & PostUpdate
   */
  public function upload()
  {
    if (null === $this->file) {
      return;
    }

    // Si il y a un ancien fichier 
    if (null !== $this->filename) {
      $oldFile = $this->getPhpDir().'/'.$this->id.'.'.$this->filename;
      if (file_exists($oldFile)) {
        unlink($oldFile);
      }
    }

    $this->file->move(
      $this->getPhpDir(), 
      $this->id.'.'.$this->extension   
    );
  }

  /**
   * PreRemove
   */
  public function preRemoveUpload()
  {
    // Sauvegarde temporaire du nom de fichier car il dépend de l'id
    $this->filename = $this->getPhpDir().'/'.$this->id.'.'.$this->extension;
  }

  /**
   * PostRemove
   */
  public function removeUpload()
  {
    if (file_exists($this->filename)) {
      unlink($this->filename);
    }
  }

  public function getWebDir()
  {
    return 'uploads/logbook';
  }

  public function getPhpDir()
  {
    return __DIR__.'/../../../../web/'.$this->getWebDir();
  }

  public function getWebPath()
  {
    return '/cvtheque/web/'.$this->getWebDir().'/'.$this->getId().'.'.$this->getExtension();
  }

  /**
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param string $extension
   * @return Image
   */
  public function setExtension($extension)
  {
    $this->extension = $extension;
    return $this;
  }

  /**
   * @return string
   */
  public function getExtension()
  {
    return $this->extension;
  }


  public function setFile($file)
  {
    $this->file = $file;

    // Si il y avait déjà un fichier pour cette entité
    if (null !== $this->extension) {
      // sauvegarde de l'extension du fichier pour le supprimer
      $this->filename = $this->extension;

      
      // Réinitialisation de la valeur de l'attribut extension
      $this->extension = null;
    }
    return $this;
  }

  public function getFile()
  {
    return $this->file;
  }
}