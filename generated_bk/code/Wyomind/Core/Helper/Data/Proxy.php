<?php
namespace Wyomind\Core\Helper\Data;

/**
 * Proxy class for @see \Wyomind\Core\Helper\Data
 */
class Proxy extends \Wyomind\Core\Helper\Data implements \Magento\Framework\ObjectManager\NoninterceptableInterface
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Proxied instance name
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Proxied instance
     *
     * @var \Wyomind\Core\Helper\Data
     */
    protected $_subject = null;

    /**
     * Instance shareability flag
     *
     * @var bool
     */
    protected $_isShared = null;

    /**
     * Proxy constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     * @param bool $shared
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Wyomind\\Core\\Helper\\Data', $shared = true)
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
        $this->_isShared = $shared;
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['_subject', '_isShared', '_instanceName'];
    }

    /**
     * Retrieve ObjectManager from global scope
     */
    public function __wakeup()
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }

    /**
     * Clone proxied instance
     */
    public function __clone()
    {
        $this->_subject = clone $this->_getSubject();
    }

    /**
     * Get proxied instance
     *
     * @return \Wyomind\Core\Helper\Data
     */
    protected function _getSubject()
    {
        if (!$this->_subject) {
            $this->_subject = true === $this->_isShared
                ? $this->_objectManager->get($this->_instanceName)
                : $this->_objectManager->create($this->_instanceName);
        }
        return $this->_subject;
    }

    /**
     * {@inheritdoc}
     */
    public function copyFilesByMagentoVersion($xf7, $xf8)
    {
        return $this->_getSubject()->copyFilesByMagentoVersion($xf7, $xf8);
    }

    /**
     * {@inheritdoc}
     */
    public function getMagentoVersion()
    {
        return $this->_getSubject()->getMagentoVersion();
    }

    /**
     * {@inheritdoc}
     */
    public function camelize($x14f)
    {
        return $this->_getSubject()->camelize($x14f);
    }

    /**
     * {@inheritdoc}
     */
    public function getStoreConfig($x162, $x169 = null)
    {
        return $this->_getSubject()->getStoreConfig($x162, $x169);
    }

    /**
     * {@inheritdoc}
     */
    public function setStoreConfig($x180, $x183, $x18a = 0)
    {
        return $this->_getSubject()->setStoreConfig($x180, $x183, $x18a);
    }

    /**
     * {@inheritdoc}
     */
    public function cleanCache()
    {
        return $this->_getSubject()->cleanCache();
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultConfig($x195)
    {
        return $this->_getSubject()->getDefaultConfig($x195);
    }

    /**
     * {@inheritdoc}
     */
    public function getStoreConfigUncrypted($x19e)
    {
        return $this->_getSubject()->getStoreConfigUncrypted($x19e);
    }

    /**
     * {@inheritdoc}
     */
    public function setStoreConfigCrypted($x1a9, $x1ae, $x1b0 = 0)
    {
        return $this->_getSubject()->setStoreConfigCrypted($x1a9, $x1ae, $x1b0);
    }

    /**
     * {@inheritdoc}
     */
    public function isLogEnabled()
    {
        return $this->_getSubject()->isLogEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultConfig($x1c3, $x1c7)
    {
        return $this->_getSubject()->setDefaultConfig($x1c3, $x1c7);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultConfigUncrypted($x1cf)
    {
        return $this->_getSubject()->getDefaultConfigUncrypted($x1cf);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultConfigCrypted($x1db, $x1dc)
    {
        return $this->_getSubject()->setDefaultConfigCrypted($x1db, $x1dc);
    }

    /**
     * {@inheritdoc}
     */
    public function checkHeartbeat()
    {
        return $this->_getSubject()->checkHeartbeat();
    }

    /**
     * {@inheritdoc}
     */
    public function getLastHeartbeat()
    {
        return $this->_getSubject()->getLastHeartbeat();
    }

    /**
     * {@inheritdoc}
     */
    public function dateDiff($x23f, $x23c = null)
    {
        return $this->_getSubject()->dateDiff($x23f, $x23c);
    }

    /**
     * {@inheritdoc}
     */
    public function getDuration($x260)
    {
        return $this->_getSubject()->getDuration($x260);
    }

    /**
     * {@inheritdoc}
     */
    public function moduleIsEnabled($x264)
    {
        return $this->_getSubject()->moduleIsEnabled($x264);
    }

    /**
     * {@inheritdoc}
     */
    public function getFilePath($x270, $x283 = '/etc/module.xml')
    {
        return $this->_getSubject()->getFilePath($x270, $x283);
    }

    /**
     * {@inheritdoc}
     */
    public function getPrefix($x28c)
    {
        return $this->_getSubject()->getPrefix($x28c);
    }

    /**
     * {@inheritdoc}
     */
    public function constructor($x913, $x91f, $x2f9 = false)
    {
        return $this->_getSubject()->constructor($x913, $x91f, $x2f9);
    }

    /**
     * {@inheritdoc}
     */
    public function isAdmin()
    {
        return $this->_getSubject()->isAdmin();
    }

    /**
     * {@inheritdoc}
     */
    public function sendUploadResponse($x94f, $x959, $x94e = 'application/octet-stream')
    {
        return $this->_getSubject()->sendUploadResponse($x94f, $x959, $x94e);
    }

    /**
     * {@inheritdoc}
     */
    public function notice($x963)
    {
        return $this->_getSubject()->notice($x963);
    }

    /**
     * {@inheritdoc}
     */
    public function isModuleOutputEnabled($moduleName = null)
    {
        return $this->_getSubject()->isModuleOutputEnabled($moduleName);
    }
}
