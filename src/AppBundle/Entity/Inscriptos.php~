<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscriptos
 *
 * @ORM\Table(name="inscriptos", indexes={@ORM\Index(name="IDX_33E53F9DDFF03F1", columns={"idCurso"}), @ORM\Index(name="IDX_33E53F943B0A334", columns={"idComision"}), @ORM\Index(name="IDX_33E53F977247DB7", columns={"idAlumno"})})
 * @ORM\Entity
 */
class Inscriptos
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
     * @var \Comisiones
     *
     * @ORM\ManyToOne(targetEntity="Comisiones", inversedBy="alumnos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idComision", referencedColumnName="id")
     * })
     */
    private $idcomision;

    /**
     * @var \Alumnos
     *
     * @ORM\ManyToOne(targetEntity="Alumnos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAlumno", referencedColumnName="id")
     * })
     */
    private $idalumno;

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
     * Set idcomision
     *
     * @param \AppBundle\Entity\Comisiones $idcomision
     * @return Inscriptos
     */
    public function setIdcomision(\AppBundle\Entity\Comisiones $idcomision = null)
    {
        $this->idcomision = $idcomision;
    
        return $this;
    }

    /**
     * Get idcomision
     *
     * @return \AppBundle\Entity\Comisiones 
     */
    public function getIdcomision()
    {
        return $this->idcomision;
    }

    /**
     * Set idalumno
     *
     * @param \AppBundle\Entity\Alumnos $idalumno
     * @return Inscriptos
     */
    public function setIdalumno(\AppBundle\Entity\Alumnos $idalumno = null)
    {
        $this->idalumno = $idalumno;
    
        return $this;
    }

    /**
     * Get idalumno
     *
     * @return \AppBundle\Entity\Alumnos 
     */
    public function getIdalumno()
    {
        return $this->idalumno;
    }

    /**
     * Set idcurso
     *
     * @param \AppBundle\Entity\Cursos $idcurso
     * @return Inscriptos
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
