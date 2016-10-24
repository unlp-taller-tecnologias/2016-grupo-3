<?php


namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table (name="cursada")
 */
class Cursada
{

	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** @ORM\Column(type="string", length=50) **/
    protected $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Comision", mappedBy="cursada")
     */
    protected $comisiones;

    /**
     * @ORM\ManyToOne(targetEntity="Catedra", inversedBy="cursadas")
     */
    protected $catedra;

    /**
     * @ORM\OneToMany(targetEntity="Docente", mappedBy="cursadas")
     */
    protected $docentes;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comisiones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->docentes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Cursada
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
     * Add comisiones
     *
     * @param \AppBundle\Entity\Comision $comisiones
     * @return Cursada
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
     * Set catedra
     *
     * @param \AppBundle\Entity\Catedra $catedra
     * @return Cursada
     */
    public function setCatedra(\AppBundle\Entity\Catedra $catedra = null)
    {
        $this->catedra = $catedra;
    
        return $this;
    }

    /**
     * Get catedra
     *
     * @return \AppBundle\Entity\Catedra 
     */
    public function getCatedra()
    {
        return $this->catedra;
    }

    /**
     * Add docentes
     *
     * @param \AppBundle\Entity\Docente $docentes
     * @return Cursada
     */
    public function addDocente(\AppBundle\Entity\Docente $docentes)
    {
        $this->docentes[] = $docentes;
    
        return $this;
    }

    /**
     * Remove docentes
     *
     * @param \AppBundle\Entity\Docente $docentes
     */
    public function removeDocente(\AppBundle\Entity\Docente $docentes)
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
}
