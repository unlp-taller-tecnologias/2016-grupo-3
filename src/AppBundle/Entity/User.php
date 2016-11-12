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

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255, nullable=true)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=15, nullable=true)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=50, nullable=true)
     */
    private $cargo;


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

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return User
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    
        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return User
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set dni
     *
     * @param string $dni
     * @return User
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    
        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set cargo
     *
     * @param string $cargo
     * @return User
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    
        return $this;
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargo()
    {
        return $this->cargo;
    }
}
