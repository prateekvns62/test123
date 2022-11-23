<?php
namespace Ess\M2ePro\Controller\Adminhtml\Ebay\Settings\Motors\ImportMotorsData;

/**
 * Interceptor class for @see \Ess\M2ePro\Controller\Adminhtml\Ebay\Settings\Motors\ImportMotorsData
 */
class Interceptor extends \Ess\M2ePro\Controller\Adminhtml\Ebay\Settings\Motors\ImportMotorsData implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\File\Csv $fileCsv, \Magento\Framework\HTTP\PhpEnvironment\Request $phpEnvironmentRequest, \Ess\M2ePro\Model\ActiveRecord\Component\Parent\Ebay\Factory $ebayFactory, \Ess\M2ePro\Controller\Adminhtml\Context $context)
    {
        $this->___init();
        parent::__construct($fileCsv, $phpEnvironmentRequest, $ebayFactory, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }
}
