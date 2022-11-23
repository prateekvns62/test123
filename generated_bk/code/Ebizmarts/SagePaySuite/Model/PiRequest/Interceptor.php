<?php
namespace Ebizmarts\SagePaySuite\Model\PiRequest;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Model\PiRequest
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Model\PiRequest implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Ebizmarts\SagePaySuite\Helper\Request $requestHelper, \Ebizmarts\SagePaySuite\Model\Config $sagepayConfig)
    {
        $this->___init();
        parent::__construct($requestHelper, $sagepayConfig);
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestData()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRequestData');
        if (!$pluginInfo) {
            return parent::getRequestData();
        } else {
            return $this->___callPlugins('getRequestData', func_get_args(), $pluginInfo);
        }
    }
}
