<?php
namespace Ebizmarts\SagePaySuite\Model\Repeat;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Model\Repeat
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Model\Repeat implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory, \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory, \Ebizmarts\SagePaySuite\Model\Payment $paymentOps, \Magento\Payment\Helper\Data $paymentData, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Payment\Model\Method\Logger $logger, \Ebizmarts\SagePaySuite\Model\Api\Shared $sharedApi, \Ebizmarts\SagePaySuite\Helper\Data $suiteHelper, \Ebizmarts\SagePaySuite\Model\Config $config, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger, \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null, \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $extensionFactory, $customAttributeFactory, $paymentOps, $paymentData, $scopeConfig, $logger, $sharedApi, $suiteHelper, $config, $suiteLogger, $resource, $resourceCollection, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function denyPayment(\Magento\Payment\Model\InfoInterface $payment)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'denyPayment');
        if (!$pluginInfo) {
            return parent::denyPayment($payment);
        } else {
            return $this->___callPlugins('denyPayment', func_get_args(), $pluginInfo);
        }
    }
}
