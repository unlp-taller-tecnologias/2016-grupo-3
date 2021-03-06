<?php


namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table (name="parcial")
 */
class Parcial
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
     *              minMessage = "El nombre del parcial debe tener 10 letras por lo menos.",
     *              maxMessage = "El nombre del parcial no puede tener mas de 40 letras."
     *)
    **/
    protected $nombre;

    /** @ORM\Column(type="string", length=200) 
     * @Assert\NotNull(message = "El campo no puede estar en blanco")
     * @Assert\Length(
     *              min = "5",
     *              max = "60",
     *              minMessage = "La descripcion debe tener 10 letras por lo menos.",
     *              maxMessage = "La descripcion no puede tener mas de 60 letras."
     *)
    **/
    protected $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="InstanciaParcial", mappedBy="parcial")
     */
    protected $instancias;

    /**
     * @ORM\ManyToOne(targetEntity="Cursos", inversedBy="parciales")
     */
    protected $cursada;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->instancias = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Parcial
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
     * @return Parcial
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
     * Add instancias
     *
     * @param \AppBundle\Entity\InstanciaParcial $instancias
     * @return Parcial
     */
    public function addInstancia(\AppBundle\Entity\InstanciaParcial $instancias)
    {
        $this->instancias[] = $instancias;
    
        return $this;
    }

    /**
     * Remove instancias
     *
     * @param \AppBundle\Entity\InstanciaParcial $instancias
     */
    public function removeInstancia(\AppBundle\Entity\InstanciaParcial $instancias)
    {
        $this->instancias->removeElement($instancias);
    }

    /**
     * Get instancias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInstancias()
    {
        return $this->instancias;
    }

    /**
     * Set cursada
     *
     * @param \AppBundle\Entity\Cursos $cursada
     * @return Parcial
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
