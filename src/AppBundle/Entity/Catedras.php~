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
     * @ORM\OneToOne(targetEntity="FosUser")
     */
    protected $secretario;




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
     * @param \AppBundle\Entity\FosUser $secretario
     * @return Catedras
     */
    public function setSecretario(\AppBundle\Entity\FosUser $secretario = null)
    {
        $this->secretario = $secretario;
    
        return $this;
    }

    /**
     * Get secretario
     *
     * @return \AppBundle\Entity\FosUser 
     */
    public function getSecretario()
    {
        return $this->secretario;
    }
}
