<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table (name="instanciaParcial")
 */
class InstanciaParcial
{

	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** @ORM\Column(type="string", length=50) 
     * @Assert\NotNull(message = "El campo no puede estar en blanco")
     * @Assert\Length(
     *              min = "5",
     *              max = "40",
     *              minMessage = "El nombre de la instancia debe tener 10 letras por lo menos.",
     *              maxMessage = "El nombre de la instancia no puede tener mas de 40 letras."
     *)
    **/
    protected $nombre;

    /** @ORM\Column(type="string", length=200) 
     * @Assert\NotNull(message = "El campo no puede estar en blanco")
     * @Assert\Length(
     *              min = "5",
     *              max = "60",
     *              minMessage = "El descripcion de la instancia debe tener 10 letras por lo menos.",
     *              maxMessage = "El descripcion de la instancia no puede tener mas de 60 letras."
     *)
    **/
    protected $descripcion;

    /** @ORM\Column(type="date") 
     * @Assert\Date(message = "El valor ingresado no es una fecha")
    **/
    protected $fechaInicio;

    /** @ORM\Column(type="date") 
     * @Assert\Date(message = "El valor ingresado no es una fecha")
    **/
    protected $fechaFin;
    
     /** @ORM\Column(type="string", columnDefinition="ENUM('pendiente', 'suspendido','finalizado')") */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity="AlumnosParcial", mappedBy="parciales")
     */
    protected $alumnos;

    /**
     * @ORM\ManyToOne(targetEntity="Parcial", inversedBy="instancias")
     */
    protected $parcial;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alumnos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return $this->nombre;
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
     * @return InstanciaParcial
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return InstanciaParcial
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechaInicio
     *
     * @param \Date $fechaInicio
     * @return InstanciaParcial
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    
        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \Date 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaInicio
     *
     * @param \Date $fechaFin
     * @return InstanciaParcial
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    
        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \Date 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return InstanciaParcial
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Add alumnos
     *
     * @param \AppBundle\Entity\AlumnosParcial $alumnos
     * @return InstanciaParcial
     */
    public function addAlumno(\AppBundle\Entity\AlumnosParcial $alumnos)
    {
        $this->alumnos[] = $alumnos;
    
        return $this;
    }

    /**
     * Remove alumnos
     *
     * @param \AppBundle\Entity\AlumnosParcial $alumnos
     */
    public function removeAlumno(\AppBundle\Entity\AlumnosParcial $alumnos)
    {
        $this->alumnos->removeElement($alumnos);
    }

    /**
     * Get alumnos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAlumnos()
    {
        return $this->alumnos;
    }

    /**
     * Set parcial
     *
     * @param \AppBundle\Entity\Parcial $parcial
     * @return InstanciaParcial
     */
    public function setParcial(\AppBundle\Entity\Parcial $parcial = null)
    {
        $this->parcial = $parcial;
    
        return $this;
    }

    /**
     * Get parcial
     *
     * @return \AppBundle\Entity\Parcial 
     */
    public function getParcial()
    {
        return $this->parcial;
    }
}
