<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Catedras", inversedBy="usuarios")
     */
    protected $catedra;

    public function __construct() {
        parent::__construct();
        // your own logic
        $this->cursadas = new \Doctrine\Common\Collections\ArrayCollection();

    }


    /**
     * Set catedra
     *
     * @param \AppBundle\Entity\Catedras $catedra
     * @return User
     */
    public function setCatedra(\AppBundle\Entity\Catedras $catedra = null)
    {
        $this->catedra = $catedra;
    
        return $this;
    }

    /**
     * Get catedra
     *
     * @return \AppBundle\Entity\Catedras 
     */
    public function getCatedra()
    {
        return $this->catedra;
    }

    /**
     * Add cursadas
     *
     * @param \AppBundle\Entity\Cursos $cursadas
     * @return User
     */
    public function addCursada(\AppBundle\Entity\Cursos $cursadas)
    {
        $this->cursadas[] = $cursadas;
    
        return $this;
    }

    /**
     * Remove cursadas
     *
     * @param \AppBundle\Entity\Cursos $cursadas
     */
    public function removeCursada(\AppBundle\Entity\Cursos $cursadas)
    {
        $this->cursadas->removeElement($cursadas);
    }

    /**
     * Get cursadas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCursadas()
    {
        return $this->cursadas;
    }
}
