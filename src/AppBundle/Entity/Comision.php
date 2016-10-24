<?php


namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table (name="comision")
 */
class Comision
{

	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** @ORM\Column(type="boolean") **/
    protected $activo=true;

    /** @ORM\Column(type="string", length=50) **/
    protected $nombre;

    /** @ORM\Column(type="string", length=200) **/
    protected $descripcion;

    /** @ORM\Column(type="integer") **/
    protected $cantInscriptos;

	/**
     * @ORM\ManyToMany(targetEntity="Alumno", mappedBy="comisiones")
     */
    protected $alumnos;

    /**
     * @ORM\ManyToOne(targetEntity="Cursada", inversedBy="comisiones")
     */
    protected $cursada;

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
     * Set activo
     *
     * @param boolean $activo
     * @return Comision
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    
        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Comision
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
     * @return Comision
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
     * Set cantInscriptos
     *
     * @param integer $cantInscriptos
     * @return Comision
     */
    public function setCantInscriptos($cantInscriptos)
    {
        $this->cantInscriptos = $cantInscriptos;
    
        return $this;
    }

    /**
     * Get cantInscriptos
     *
     * @return integer 
     */
    public function getCantInscriptos()
    {
        return $this->cantInscriptos;
    }

    /**
     * Add alumnos
     *
     * @param \AppBundle\Entity\Alumno $alumnos
     * @return Comision
     */
    public function addAlumno(\AppBundle\Entity\Alumno $alumnos)
    {
        $this->alumnos[] = $alumnos;
    
        return $this;
    }

    /**
     * Remove alumnos
     *
     * @param \AppBundle\Entity\Alumno $alumnos
     */
    public function removeAlumno(\AppBundle\Entity\Alumno $alumnos)
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
     * @param \AppBundle\Entity\Cursada $cursada
     * @return Comision
     */
    public function setCursada(\AppBundle\Entity\Cursada $cursada = null)
    {
        $this->cursada = $cursada;
    
        return $this;
    }

    /**
     * Get cursada
     *
     * @return \AppBundle\Entity\Cursada 
     */
    public function getCursada()
    {
        return $this->cursada;
    }
}
