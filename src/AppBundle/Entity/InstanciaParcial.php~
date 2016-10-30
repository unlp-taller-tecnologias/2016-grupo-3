<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

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

    /** @ORM\Column(type="string", length=50) **/
    protected $nombre;

    /** @ORM\Column(type="string", length=200) **/
    protected $descripcion;

    /** @ORM\Column(type="datetime") **/
    protected $fecha;
    
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return InstanciaParcial
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
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
