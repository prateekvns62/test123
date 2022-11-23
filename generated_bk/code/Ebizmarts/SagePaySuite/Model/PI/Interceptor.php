<?php
namespace Ebizmarts\SagePaySuite\Model\PI;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Model\PI
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Model\PI implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory, \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory, \Magento\Payment\Helper\Data $paymentData, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Payment\Model\Method\Logger $logger, \Magento\Framework\Module\ModuleListInterface $moduleList, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate, \Ebizmarts\SagePaySuite\Model\Config $config, \Ebizmarts\SagePaySuite\Model\Api\PIRest $pirestapi, \Ebizmarts\SagePaySuite\Model\Payment $paymentOps, \Ebizmarts\SagePaySuite\Model\Api\Pi $piApi, \Ebizmarts\SagePaySuite\Helper\Data $suiteHelper, \Ebizmarts\SagePaySuite\Model\Api\Reporting $reportingApi, \Ebizmarts\SagePaySuite\Model\PiRequestManagement\TransactionAmountFactory $transactionAmountFactory, \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null, \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $extensionFactory, $customAttributeFactory, $paymentData, $scopeConfig, $logger, $moduleList, $localeDate, $config, $pirestapi, $paymentOps, $piApi, $suiteHelper, $reportingApi, $transactionAmountFactory, $resource, $resourceCollection, $data);
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
