<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comisiones
 *
 * @ORM\Table(name="comisiones", indexes={@ORM\Index(name="IDX_E65EF164DDFF03F1", columns={"idCurso"})})
 * @ORM\Entity
 */
class Comisiones
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
     * @ORM\Column(name="limVisible", type="integer", nullable=false)
     */
    private $limvisible;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo;

    /**
     * @var integer
     *
     * @ORM\Column(name="inscriptos", type="integer", nullable=false)
     */
    private $inscriptos;

    /**
     * @var integer
     *
     * @ORM\Column(name="borrado", type="integer", nullable=false)
     */
    private $borrado;

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
     * @ORM\OneToMany(targetEntity="Inscriptos", mappedBy="idcomision")
     */
    protected $alumnos;

    public function __construct() {
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
     * @return Comisiones
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
     * Set limvisible
     *
     * @param integer $limvisible
     * @return Comisiones
     */
    public function setLimvisible($limvisible)
    {
        $this->limvisible = $limvisible;
    
        return $this;
    }

    /**
     * Get limvisible
     *
     * @return integer 
     */
    public function getLimvisible()
    {
        return $this->limvisible;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Comisiones
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
     * Set activo
     *
     * @param boolean $activo
     * @return Comisiones
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
     * Set inscriptos
     *
     * @param integer $inscriptos
     * @return Comisiones
     */
    public function setInscriptos($inscriptos)
    {
        $this->inscriptos = $inscriptos;
    
        return $this;
    }

    /**
     * Get inscriptos
     *
     * @return integer 
     */
    public function getInscriptos()
    {
        return $this->inscriptos;
    }

    /**
     * Set borrado
     *
     * @param integer $borrado
     * @return Comisiones
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
     * Set idcurso
     *
     * @param \AppBundle\Entity\Cursos $idcurso
     * @return Comisiones
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

    /**
     * Add alumnos
     *
     * @param \AppBundle\Entity\Inscriptos $alumnos
     * @return Comisiones
     */
    public function addAlumno(\AppBundle\Entity\Inscriptos $alumnos)
    {
        $this->alumnos[] = $alumnos;
    
        return $this;
    }

    /**
     * Remove alumnos
     *
     * @param \AppBundle\Entity\Inscriptos $alumnos
     */
    public function removeAlumno(\AppBundle\Entity\Inscriptos $alumnos)
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
}
