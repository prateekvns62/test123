<?php
namespace Amasty\ShopbySeo\Helper\Url;

/**
 * Proxy class for @see \Amasty\ShopbySeo\Helper\Url
 */
class Proxy extends \Amasty\ShopbySeo\Helper\Url implements \Magento\Framework\ObjectManager\NoninterceptableInterface
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
     * @var \Amasty\ShopbySeo\Helper\Url
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
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Amasty\\ShopbySeo\\Helper\\Url', $shared = true)
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
     * @return \Amasty\ShopbySeo\Helper\Url
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
    public function getRequest()
    {
        return $this->_getSubject()->getRequest();
    }

    /**
     * {@inheritdoc}
     */
    public function seofyUrl($url)
    {
        return $this->_getSubject()->seofyUrl($url);
    }

    /**
     * {@inheritdoc}
     */
    public function getCategoryRouteUrl()
    {
        return $this->_getSubject()->getCategoryRouteUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function addCategorySuffix($url)
    {
        return $this->_getSubject()->addCategorySuffix($url);
    }

    /**
     * {@inheritdoc}
     */
    public function removeCategorySuffix($url)
    {
        return $this->_getSubject()->removeCategorySuffix($url);
    }

    /**
     * {@inheritdoc}
     */
    public function isSeoUrlEnabled()
    {
        return $this->_getSubject()->isSeoUrlEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function isAddSuffixToShopby()
    {
        return $this->_getSubject()->isAddSuffixToShopby();
    }

    /**
     * {@inheritdoc}
     */
    public function getSeoSuffix()
    {
        return $this->_getSubject()->getSeoSuffix();
    }

    /**
     * {@inheritdoc}
     */
    public function isModuleOutputEnabled($moduleName = null)
    {
        return $this->_getSubject()->isModuleOutputEnabled($moduleName);
    }
}
