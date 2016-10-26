<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Habilitados
 *
 * @ORM\Table(name="habilitados", indexes={@ORM\Index(name="IDX_8A162115DDFF03F1", columns={"idCurso"})})
 * @ORM\Entity
 */
class Habilitados
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
     * @ORM\Column(name="apellido", type="string", length=255, nullable=true)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=15, nullable=false)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="legajo", type="string", length=8, nullable=true)
     */
    private $legajo;

    /**
     * @var \Cursos
     *
     * @ORM\ManyToOne(targetEntity="Cursos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCurso", referencedColumnName="id")
     * })
     */
    private $idcurso;



   

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
     * Set apellido
     *
     * @param string $apellido
     * @return Habilitados
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
     * Set dni
     *
     * @param string $dni
     * @return Habilitados
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
     * Set legajo
     *
     * @param string $legajo
     * @return Habilitados
     */
    public function setLegajo($legajo)
    {
        $this->legajo = $legajo;
    
        return $this;
    }

    /**
     * Get legajo
     *
     * @return string 
     */
    public function getLegajo()
    {
        return $this->legajo;
    }

    /**
     * Set idcurso
     *
     * @param \AppBundle\Entity\Cursos $idcurso
     * @return Habilitados
     */
    public function setIdcurso(\AppBundle\Entity\Cursos $idcurso = null)
    {
        $this->idcurso = $idcurso;
    
        return $this;
    }

    /**
     * Get idcurso
     *
     * @return \AppBundle\Entity\Cursos 
     */
    public function getIdcurso()
    {
        return $this->idcurso;
    }
}
