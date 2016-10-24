<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table (name="alumno")
 */
class Alumno Extends Usuario
{

    /** @ORM\Column(type="string", length=8, unique=true) **/
    protected $legajo=-1;

	/** @ORM\Column(type="boolean") **/
	protected $habilitado=true;

    /** @ORM\Column(type="string",length=30, nullable=true) **/
    protected $origen=null;
	/**
     * @ORM\ManyToMany(targetEntity="Comision", inversedBy="alumnos")
     * @ORM\JoinTable(name="alumnos_comisiones")
     */
    protected $comisiones;

    /**
     * @ORM\OneToMany(targetEntity="AlumnoClase", mappedBy="alumnos")
     */
    protected $clases;

    /**
     * @ORM\OneToMany(targetEntity="AlumnosParcial", mappedBy="alumnos")
     */
    protected $instanciasParciales;

    public function __construct() {
        $this->comisiones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clases = new \Doctrine\Common\Collections\ArrayCollection();
        $this->instanciasParciales = new \Doctrine\Common\Collections\ArrayCollection();
    }

    

    /**
     * Set legajo
     *
     * @param string $legajo
     * @return Alumno
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
     * Set habilitado
     *
     * @param boolean $habilitado
     * @return Alumno
     */
    public function setHabilitado($habilitado)
    {
        $this->habilitado = $habilitado;
    
        return $this;
    }

    /**
     * Get habilitado
     *
     * @return boolean 
     */
    public function getHabilitado()
    {
        return $this->habilitado;
    }

    /**
     * Set origen
     *
     * @param string $origen
     * @return Alumno
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
     * @return Alumno
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
     * Set nombre
     *
     * @param string $nombre
     * @return Alumno
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
     * Set apellido
     *
     * @param string $apellido
     * @return Alumno
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
     * Set documento
     *
     * @param string $documento
     * @return Alumno
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    
        return $this;
    }

    /**
     * Get documento
     *
     * @return string 
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Alumno
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Alumno
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
     * @return Alumno
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
     * Add comisiones
     *
     * @param \AppBundle\Entity\Comision $comisiones
     * @return Alumno
     */
    public function addComisione(\AppBundle\Entity\Comision $comisiones)
    {
        $this->comisiones[] = $comisiones;
    
        return $this;
    }

    /**
     * Remove comisiones
     *
     * @param \AppBundle\Entity\Comision $comisiones
     */
    public function removeComisione(\AppBundle\Entity\Comision $comisiones)
    {
        $this->comisiones->removeElement($comisiones);
    }

    /**
     * Get comisiones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComisiones()
    {
        return $this->comisiones;
    }

    /**
     * Add clases
     *
     * @param \AppBundle\Entity\AlumnoClase $clases
     * @return Alumno
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
     * @return Alumno
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
