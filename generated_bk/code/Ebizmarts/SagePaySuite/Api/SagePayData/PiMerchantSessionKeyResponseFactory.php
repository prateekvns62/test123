<?php
namespace Ebizmarts\SagePaySuite\Api\SagePayData;

/**
 * Factory class for @see \Ebizmarts\SagePaySuite\Api\SagePayData\PiMerchantSessionKeyResponse
 */
class PiMerchantSessionKeyResponseFactory
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Instance name to create
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Factory constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Ebizmarts\\SagePaySuite\\Api\\SagePayData\\PiMerchantSessionKeyResponse')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \Ebizmarts\SagePaySuite\Api\SagePayData\PiMerchantSessionKeyResponse
     */
    public function create(array $data = array())
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}