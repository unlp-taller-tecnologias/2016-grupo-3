<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Catedras
 *
 * @ORM\Table(name="catedras")
 * @ORM\Entity
 */
class Catedras
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="borrado", type="integer", nullable=false)
     */
    private $borrado;
    
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="catedra")
     */
    protected $usuarios;

    public function __toString() {
        return $this->nombre;
    }
    
    public function __construct() {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
        
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Catedras
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
     * Set borrado
     *
     * @param integer $borrado
     * @return Catedras
     */
    public function setBorrado($borrado)
    {
        $this->borrado = $borrado;
    
        return $this;
    }

    /**
     * Get borrado
     *
     * @return integer 
     */
    public function getBorrado()
    {
        return $this->borrado;
    }

    /**
     * Set secretario
     *
     * @param \AppBundle\Entity\User $secretario
     * @return Catedras
     */
    public function setSecretario(\AppBundle\Entity\User  $secretario)
    {
        $this->secretario = $secretario;
    
        return $this;
    }

    /**
     * Get secretario
     *
     * @return \AppBundle\Entity\User 
     */
    public function getSecretario()
    {
        return $this->secretario;
    }

    /**
     * Add usuarios
     *
     * @param \AppBundle\Entity\User $usuarios
     * @return Catedras
     */
    public function addUsuario(\AppBundle\Entity\User $usuarios)
    {
        $this->usuarios[] = $usuarios;
    
        return $this;
    }

    /**
     * Remove usuarios
     *
     * @param \AppBundle\Entity\User $usuarios
     */
    public function removeUsuario(\AppBundle\Entity\User $usuarios)
    {
        $this->usuarios->removeElement($usuarios);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }
}
