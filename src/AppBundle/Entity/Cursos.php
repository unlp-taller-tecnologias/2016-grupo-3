<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cursos
 *
 * @ORM\Table(name="cursos", indexes={@ORM\Index(name="IDX_B2785A189CEB5673", columns={"idCatedra"})})
 * @ORM\Entity
 */
class Cursos
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
     * @ORM\Column(name="borrado", type="integer", nullable=false)
     */
    private $borrado;

    /**
     * @var \Catedras
     *
     * @ORM\ManyToOne(targetEntity="Catedras")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCatedra", referencedColumnName="id")
     * })
     */
    private $idcatedra;
        /**
     * @ORM\OneToMany(targetEntity="Comisiones", mappedBy="idcurso")
     */
    protected $comisiones;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="cursadas")
     */
    private $docentes;
    /**
     * @ORM\OneToMany(targetEntity="Parcial", mappedBy="cursada")
     */
    protected $parciales;

    /**
     * @ORM\OneToMany(targetEntity="Clase", mappedBy="cursada")
     */
    protected $clases;

    public function __construct() {
        $this->clases = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comisiones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->docentes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parciales = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Cursos
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
     * Set borrado
     *
     * @param integer $borrado
     * @return Cursos
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
     * Set idcatedra
     *
     * @param \AppBundle\Entity\Catedras $idcatedra
     * @return Cursos
     */
    public function setIdcatedra(\AppBundle\Entity\Catedras $idcatedra = null)
    {
        $this->idcatedra = $idcatedra;
    
        return $this;
    }

    /**
     * Get idcatedra
     *
     * @return \AppBundle\Entity\Catedras 
     */
    public function getIdcatedra()
    {
        return $this->idcatedra;
    }

    /**
     * Add comisiones
     *
     * @param \AppBundle\Entity\Comisiones $comisiones
     * @return Cursos
     */
    public function addComisione(\AppBundle\Entity\Comisiones $comisiones)
    {
        $this->comisiones[] = $comisiones;
    
        return $this;
    }

    /**
     * Remove comisiones
     *
     * @param \AppBundle\Entity\Comisiones $comisiones
     */
    public function removeComisione(\AppBundle\Entity\Comisiones $comisiones)
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
     * Add docentes
     *
     * @param \AppBundle\Entity\FosUser $docentes
     * @return Cursos
     */
    public function addDocente(\AppBundle\Entity\User $docentes)
    {
        $this->docentes[] = $docentes;
    
        return $this;
    }

    /**
     * Remove docentes
     *
     * @param \AppBundle\Entity\FosUser $docentes
     */
    public function removeDocente(\AppBundle\Entity\User $docentes)
    {
        $this->docentes->removeElement($docentes);
    }

    /**
     * Get docentes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocentes()
    {
        return $this->docentes;
    }

    /**
     * Add parciales
     *
     * @param \AppBundle\Entity\Parcial $parciales
     * @return Cursos
     */
    public function addParciale(\AppBundle\Entity\Parcial $parciales)
    {
        $this->parciales[] = $parciales;
    
        return $this;
    }

    /**
     * Remove parciales
     *
     * @param \AppBundle\Entity\Parcial $parciales
     */
    public function removeParciale(\AppBundle\Entity\Parcial $parciales)
    {
        $this->parciales->removeElement($parciales);
    }

    /**
     * Get parciales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParciales()
    {
        return $this->parciales;
    }

    /**
     * Add clases
     *
     * @param \AppBundle\Entity\Clase $clases
     * @return Cursos
     */
    public function addClase(\AppBundle\Entity\Clase $clases)
    {
        $this->clases[] = $clases;
    
        return $this;
    }

    /**
     * Remove clases
     *
     * @param \AppBundle\Entity\Clase $clases
     */
    public function removeClase(\AppBundle\Entity\Clase $clases)
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

    public function __toString() {
    return $this->nombre;
}
}
