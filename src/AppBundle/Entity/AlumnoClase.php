<?php


namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table (name="alumnoClase")
 */
class AlumnoClase
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** @ORM\Column(type="string", length=200) **/
    protected $observacion;
    
     /** @ORM\Column(type="string", columnDefinition="ENUM('ausente', 'presente','justificado')") */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity="Alumnos", inversedBy="clases")
     */
    protected $alumnos;

    /**
     * @ORM\ManyToOne(targetEntity="Clase", inversedBy="alumnos")
     */
    protected $clases;


    

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
     * Set observacion
     *
     * @param string $observacion
     * @return AlumnoClase
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;
    
        return $this;
    }

    /**
     * Get observacion
     *
     * @return string 
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return AlumnoClase
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
     * Set alumnos
     *
     * @param \AppBundle\Entity\Alumnos $alumnos
     * @return AlumnoClase
     */
    public function setAlumnos(\AppBundle\Entity\Alumnos $alumnos = null)
    {
        $this->alumnos = $alumnos;
    
        return $this;
    }

    /**
     * Get alumnos
     *
     * @return \AppBundle\Entity\Alumnos 
     */
    public function getAlumnos()
    {
        return $this->alumnos;
    }

    /**
     * Set clases
     *
     * @param \AppBundle\Entity\Clase $clases
     * @return AlumnoClase
     */
    public function setClases(\AppBundle\Entity\Clase $clases = null)
    {
        $this->clases = $clases;
    
        return $this;
    }

    /**
     * Get clases
     *
     * @return \AppBundle\Entity\Clase 
     */
    public function getClases()
    {
        return $this->clases;
    }
}
