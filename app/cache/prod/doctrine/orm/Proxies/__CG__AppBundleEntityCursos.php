<?php

namespace Proxies\__CG__\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Cursos extends \AppBundle\Entity\Cursos implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\Cursos' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\Cursos' . "\0" . 'nombre', '' . "\0" . 'AppBundle\\Entity\\Cursos' . "\0" . 'borrado', '' . "\0" . 'AppBundle\\Entity\\Cursos' . "\0" . 'idcatedra', 'comisiones', '' . "\0" . 'AppBundle\\Entity\\Cursos' . "\0" . 'docentes', 'parciales', 'clases');
        }

        return array('__isInitialized__', '' . "\0" . 'AppBundle\\Entity\\Cursos' . "\0" . 'id', '' . "\0" . 'AppBundle\\Entity\\Cursos' . "\0" . 'nombre', '' . "\0" . 'AppBundle\\Entity\\Cursos' . "\0" . 'borrado', '' . "\0" . 'AppBundle\\Entity\\Cursos' . "\0" . 'idcatedra', 'comisiones', '' . "\0" . 'AppBundle\\Entity\\Cursos' . "\0" . 'docentes', 'parciales', 'clases');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Cursos $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setNombre($nombre)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNombre', array($nombre));

        return parent::setNombre($nombre);
    }

    /**
     * {@inheritDoc}
     */
    public function getNombre()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNombre', array());

        return parent::getNombre();
    }

    /**
     * {@inheritDoc}
     */
    public function setBorrado($borrado)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBorrado', array($borrado));

        return parent::setBorrado($borrado);
    }

    /**
     * {@inheritDoc}
     */
    public function getBorrado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBorrado', array());

        return parent::getBorrado();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdcatedra(\AppBundle\Entity\Catedras $idcatedra = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdcatedra', array($idcatedra));

        return parent::setIdcatedra($idcatedra);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdcatedra()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdcatedra', array());

        return parent::getIdcatedra();
    }

    /**
     * {@inheritDoc}
     */
    public function addComisione(\AppBundle\Entity\Comisiones $comisiones)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addComisione', array($comisiones));

        return parent::addComisione($comisiones);
    }

    /**
     * {@inheritDoc}
     */
    public function removeComisione(\AppBundle\Entity\Comisiones $comisiones)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeComisione', array($comisiones));

        return parent::removeComisione($comisiones);
    }

    /**
     * {@inheritDoc}
     */
    public function getComisiones()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getComisiones', array());

        return parent::getComisiones();
    }

    /**
     * {@inheritDoc}
     */
    public function addDocente(\AppBundle\Entity\User $docentes)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addDocente', array($docentes));

        return parent::addDocente($docentes);
    }

    /**
     * {@inheritDoc}
     */
    public function removeDocente(\AppBundle\Entity\User $docentes)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeDocente', array($docentes));

        return parent::removeDocente($docentes);
    }

    /**
     * {@inheritDoc}
     */
    public function getDocentes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDocentes', array());

        return parent::getDocentes();
    }

    /**
     * {@inheritDoc}
     */
    public function addParciale(\AppBundle\Entity\Parcial $parciales)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addParciale', array($parciales));

        return parent::addParciale($parciales);
    }

    /**
     * {@inheritDoc}
     */
    public function removeParciale(\AppBundle\Entity\Parcial $parciales)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeParciale', array($parciales));

        return parent::removeParciale($parciales);
    }

    /**
     * {@inheritDoc}
     */
    public function getParciales()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getParciales', array());

        return parent::getParciales();
    }

    /**
     * {@inheritDoc}
     */
    public function addClase(\AppBundle\Entity\Clase $clases)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addClase', array($clases));

        return parent::addClase($clases);
    }

    /**
     * {@inheritDoc}
     */
    public function removeClase(\AppBundle\Entity\Clase $clases)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeClase', array($clases));

        return parent::removeClase($clases);
    }

    /**
     * {@inheritDoc}
     */
    public function getClases()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getClases', array());

        return parent::getClases();
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', array());

        return parent::__toString();
    }

}
