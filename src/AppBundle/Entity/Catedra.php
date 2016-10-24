<?php


namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table (name="catedra")
 */
class Catedra
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
     * @ORM\OneToMany(targetEntity="Cursada", mappedBy="catedra")
     */
    protected $cursadas;

    /**
     * @ORM\OneToOne(targetEntity="Secretario")
     */
    protected $secretario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cursadas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Catedra
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
     * Add cursadas
     *
     * @param \AppBundle\Entity\Cursada $cursadas
     * @return Catedra
     */
    public function addCursada(\AppBundle\Entity\Cursada $cursadas)
    {
        $this->cursadas[] = $cursadas;
    
        return $this;
    }

    /**
     * Remove cursadas
     *
     * @param \AppBundle\Entity\Cursada $cursadas
     */
    public function removeCursada(\AppBundle\Entity\Cursada $cursadas)
    {
        $this->cursadas->removeElement($cursadas);
    }

    /**
     * Get cursadas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCursadas()
    {
        return $this->cursadas;
    }

    /**
     * Set secretario
     *
     * @param \AppBundle\Entity\Secretario $secretario
     * @return Catedra
     */
    public function setSecretario(\AppBundle\Entity\Secretario $secretario = null)
    {
        $this->secretario = $secretario;
    
        return $this;
    }

    /**
     * Get secretario
     *
     * @return \AppBundle\Entity\Secretario 
     */
    public function getSecretario()
    {
        return $this->secretario;
    }
}
