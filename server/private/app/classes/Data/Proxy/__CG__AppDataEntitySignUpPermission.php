<?php

namespace App\Data\Proxy\__CG__\App\Data\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class SignUpPermission extends \App\Data\Entity\SignUpPermission implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'creationDateTime', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'creator', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'emailAddress', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'id', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'keyStretchingIterations', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'passwordHash', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'salt', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'userRole');
        }

        return array('__isInitialized__', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'creationDateTime', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'creator', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'emailAddress', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'id', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'keyStretchingIterations', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'passwordHash', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'salt', '' . "\0" . 'App\\Data\\Entity\\SignUpPermission' . "\0" . 'userRole');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (SignUpPermission $proxy) {
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
    public function getCreator()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreator', array());

        return parent::getCreator();
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getKeyStretchingIterations()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getKeyStretchingIterations', array());

        return parent::getKeyStretchingIterations();
    }

    /**
     * {@inheritDoc}
     */
    public function getPasswordHash()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPasswordHash', array());

        return parent::getPasswordHash();
    }

    /**
     * {@inheritDoc}
     */
    public function getSalt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSalt', array());

        return parent::getSalt();
    }

    /**
     * {@inheritDoc}
     */
    public function getUserRole()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUserRole', array());

        return parent::getUserRole();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreationDateTime()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreationDateTime', array());

        return parent::setCreationDateTime();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreator($user)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreator', array($user));

        return parent::setCreator($user);
    }

    /**
     * {@inheritDoc}
     */
    public function setEmailAddress($emailAddress)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmailAddress', array($emailAddress));

        return parent::setEmailAddress($emailAddress);
    }

    /**
     * {@inheritDoc}
     */
    public function setKeyStretchingIterations($iterations)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setKeyStretchingIterations', array($iterations));

        return parent::setKeyStretchingIterations($iterations);
    }

    /**
     * {@inheritDoc}
     */
    public function setPasswordHash($hash)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPasswordHash', array($hash));

        return parent::setPasswordHash($hash);
    }

    /**
     * {@inheritDoc}
     */
    public function setSalt($salt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSalt', array($salt));

        return parent::setSalt($salt);
    }

    /**
     * {@inheritDoc}
     */
    public function setUserRole($userRole)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUserRole', array($userRole));

        return parent::setUserRole($userRole);
    }

}
