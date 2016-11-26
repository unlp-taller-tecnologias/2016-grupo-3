<?php


namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table (name="clase")
 */
class Clase
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
     *              minMessage = "El nombre de la clase debe tener 10 letras por lo menos.",
     *              maxMessage = "El nombre de la clase no puede tener mas de 40 letras."
     *)
    **/
    protected $nombre;

    /** @ORM\Column(type="string", length=200) 
     * @Assert\NotNull(message = "El campo no puede estar en blanco")
     * @Assert\Length(
     *              min = "5",
     *              max = "60",
     *              minMessage = "La descripcion de la clase debe tener 10 letras por lo menos.",
     *              maxMessage = "La descripcion de la clase no puede tener mas de 60 letras."
     *)
    **/
    protected $descripcion;

    /** @ORM\Column(type="boolean") **/
    protected $requerida=true;

    /** @ORM\Column(type="date") 
     * @Assert\Date(message = "El valor ingresado no es una fecha")
    **/
    protected $fechaInicio;

    /** @ORM\Column(type="date") 
     * @Assert\Date(message = "El valor ingresado no es una fecha")
    **/
    protected $fechaFin;
    
     /** @ORM\Column(type="string", columnDefinition="ENUM('pendiente', 'suspendida','finalizada')") */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity="AlumnoClase", mappedBy="clases")
     */
    protected $alumnos;

    /**
     * @ORM\ManyToOne(targetEntity="Cursos", inversedBy="clases")
     */
    protected $cursada;

    public function __toString() {
        return $this->nombre;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alumnos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Clase
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
     * @return Clase
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
     * Set requerida
     *
     * @param boolean $requerida
     * @return Clase
     */
    public function setRequerida($requerida)
    {
        $this->requerida = $requerida;
    
        return $this;
    }

    /**
     * Get requerida
     *
     * @return boolean 
     */
    public function getRequerida()
    {
        return $this->requerida;
    }

    /**
     * Set fechaInicio
     *
     * @param \Date $fechaInicio
     * @return Clase
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
     * @return Clase
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
     * @return Clase
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
     * @param \AppBundle\Entity\AlumnoClase $alumnos
     * @return Clase
     */
    public function addAlumno(\AppBundle\Entity\AlumnoClase $alumnos)
    {
        $this->alumnos[] = $alumnos;
    
        return $this;
    }

    /**
     * Remove alumnos
     *
     * @param \AppBundle\Entity\AlumnoClase $alumnos
     */
    public function removeAlumno(\AppBundle\Entity\AlumnoClase $alumnos)
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
     * Set cursada
     *
     * @param \AppBundle\Entity\Cursos $cursada
     * @return Clase
     */
    public function setCursada(\AppBundle\Entity\Cursos $cursada = null)
    {
        $this->cursada = $cursada;
    
        return $this;
    }

    /**
     * Get cursada
     *
     * @return \AppBundle\Entity\Cursos 
     */
    public function getCursada()
    {
        return $this->cursada;
    }
}
