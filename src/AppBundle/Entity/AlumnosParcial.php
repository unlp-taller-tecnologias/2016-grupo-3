<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table (name="alumnosParcial")
 */
class AlumnosParcial
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** @ORM\Column(type="string", length=200) **/
    protected $observacion;

    /** @ORM\Column(type="string", length=50, nullable = true) **/
    protected $nota;
    
     /** @ORM\Column(type="string", columnDefinition="ENUM('ausente', 'presente','justificado')") */
    private $estado;

    /** @ORM\Column(type="string", columnDefinition="ENUM('aprobado', 'desaprobado', 'no aplica')") */
    private $condicion;

    /**
     * @ORM\ManyToOne(targetEntity="Alumnos", inversedBy="instanciasParciales")
     */
    protected $alumnos;

    /**
     * @ORM\ManyToOne(targetEntity="InstanciaParcial", inversedBy="alumnos")
     */
    protected $parciales;


   

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
     * @return AlumnosParcial
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
     * Set nota
     *
     * @param string $nota
     * @return AlumnosParcial
     */
    public function setNota($nota)
    {
        $this->nota = $nota;
    
        return $this;
    }

    /**
     * Get nota
     *
     * @return string 
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return AlumnosParcial
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
     * @return AlumnosParcial
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
     * Set parciales
     *
     * @param \AppBundle\Entity\InstanciaParcial $parciales
     * @return AlumnosParcial
     */
    public function setParciales(\AppBundle\Entity\InstanciaParcial $parciales = null)
    {
        $this->parciales = $parciales;
    
        return $this;
    }

    /**
     * Get parciales
     *
     * @return \AppBundle\Entity\InstanciaParcial 
     */
    public function getParciales()
    {
        return $this->parciales;
    }

    /**
     * Set condicion
     *
     * @param string $condicion
     * @return AlumnosParcial
     */
    public function setCondicion($condicion)
    {
        $this->condicion = $condicion;
    
        return $this;
    }

    /**
     * Get condicion
     *
     * @return string 
     */
    public function getCondicion()
    {
        return $this->condicion;
    }
}
