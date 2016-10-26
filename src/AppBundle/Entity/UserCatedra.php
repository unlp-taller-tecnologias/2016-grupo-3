<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserCatedra
 *
 * @ORM\Table(name="user_catedra", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class UserCatedra
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
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var integer
     *
     * @ORM\Column(name="idCatedra", type="integer", nullable=false)
     */
    private $idcatedra;



    

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
     * Set iduser
     *
     * @param integer $iduser
     * @return UserCatedra
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    
        return $this;
    }

    /**
     * Get iduser
     *
     * @return integer 
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set idcatedra
     *
     * @param integer $idcatedra
     * @return UserCatedra
     */
    public function setIdcatedra($idcatedra)
    {
        $this->idcatedra = $idcatedra;
    
        return $this;
    }

    /**
     * Get idcatedra
     *
     * @return integer 
     */
    public function getIdcatedra()
    {
        return $this->idcatedra;
    }
}
