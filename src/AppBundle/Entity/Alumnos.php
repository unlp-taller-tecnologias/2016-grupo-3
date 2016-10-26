<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alumnos
 *
 * @ORM\Table(name="alumnos")
 * @ORM\Entity
 */
class Alumnos
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
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

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
     * @ORM\Column(name="legajo", type="string", length=8, nullable=true)
     */
    private $legajo;

    /**
     * @var string
     *
     * @ORM\Column(name="origen", type="string", length=30, nullable=true)
     */
    private $origen;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=30, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=30, nullable=true)
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=100, nullable=true)
     */
    private $mail;

     /**
     * @ORM\OneToMany(targetEntity="AlumnoClase", mappedBy="alumnos")
     */
    protected $clases;

    /**
     * @ORM\OneToMany(targetEntity="AlumnosParcial", mappedBy="parciales")
     */
    protected $instanciasParciales;

    public function __construct() {
        $this->clases = new \Doctrine\Common\Collections\ArrayCollection();
        $this->instanciasParciales = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set password
     *
     * @param string $password
     * @return Alumnos
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return Alumnos
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
     * @return Alumnos
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
     * @return Alumnos
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
     * @return Alumnos
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
     * Set origen
     *
     * @param string $origen
     * @return Alumnos
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;
    
        return $this;
    }

    /**
     * Get origen
     *
     * @return string 
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Alumnos
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set celular
     *
     * @param string $celular
     * @return Alumnos
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    
        return $this;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Alumnos
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    
        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Add clases
     *
     * @param \AppBundle\Entity\AlumnoClase $clases
     * @return Alumnos
     */
    public function addClase(\AppBundle\Entity\AlumnoClase $clases)
    {
        $this->clases[] = $clases;
    
        return $this;
    }

    /**
     * Remove clases
     *
     * @param \AppBundle\Entity\AlumnoClase $clases
     */
    public function removeClase(\AppBundle\Entity\AlumnoClase $clases)
    {
        $this->clases->removeElement($clases);
    }

    /**
     * Get clases
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClases()
    {
        return $this->clases;
    }

    /**
     * Add instanciasParciales
     *
     * @param \AppBundle\Entity\AlumnosParcial $instanciasParciales
     * @return Alumnos
     */
    public function addInstanciasParciale(\AppBundle\Entity\AlumnosParcial $instanciasParciales)
    {
        $this->instanciasParciales[] = $instanciasParciales;
    
        return $this;
    }

    /**
     * Remove instanciasParciales
     *
     * @param \AppBundle\Entity\AlumnosParcial $instanciasParciales
     */
    public function removeInstanciasParciale(\AppBundle\Entity\AlumnosParcial $instanciasParciales)
    {
        $this->instanciasParciales->removeElement($instanciasParciales);
    }

    /**
     * Get instanciasParciales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInstanciasParciales()
    {
        return $this->instanciasParciales;
    }
}
