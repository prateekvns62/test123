<?php
namespace Ess\M2ePro\Controller\Adminhtml\Ebay\Template\Description\Preview;

/**
 * Interceptor class for @see \Ess\M2ePro\Controller\Adminhtml\Ebay\Template\Description\Preview
 */
class Interceptor extends \Ess\M2ePro\Controller\Adminhtml\Ebay\Template\Description\Preview implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\HTTP\PhpEnvironment\Request $phpEnvironmentRequest, \Magento\Catalog\Model\Product $productModel, \Ess\M2ePro\Model\Ebay\Template\Manager $templateManager, \Ess\M2ePro\Model\ActiveRecord\Component\Parent\Ebay\Factory $ebayFactory, \Ess\M2ePro\Controller\Adminhtml\Context $context)
    {
        $this->___init();
        parent::__construct($phpEnvironmentRequest, $productModel, $templateManager, $ebayFactory, $context);
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
