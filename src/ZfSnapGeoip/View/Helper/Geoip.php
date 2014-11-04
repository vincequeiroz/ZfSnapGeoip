<?php

namespace ZfSnapGeoip\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Geoip view helper
 *
 * @author Witold Wasiczko <witold@wasiczko.pl>
 */
class Geoip extends AbstractHelper implements ServiceLocatorAwareInterface
{
    /**
     * @var \ZfSnapGeoip\Service\Geoip
     */
    private $geoip;

    /**
     * @var \Zend\View\HelperPluginManager
     */
    private $serviceLocator;

    /**
     * @param string $ipAddress
     * @return \ZfSnapGeoip\Service\Geoip
     */
    public function __invoke($ipAddress = null)
    {
        return $this->getGeoip()->getRecord($ipAddress);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getGeoip()->getRecord();
    }

    /**
     * @return \ZfSnapGeoip\Service\Geoip
     */
    private function getGeoip()
    {
        if (!$this->geoip) {
            $this->geoip = $this->getServiceLocator()->getServiceLocator()->get('Geoip');
        }
        return $this->geoip;
    }

    /**
     * @return \Zend\View\HelperPluginManager
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

}
