<?php
namespace Ess\M2ePro\Controller\Adminhtml\Ebay\Listing\Settings\Motors\ViewItemGrid;

/**
 * Interceptor class for @see \Ess\M2ePro\Controller\Adminhtml\Ebay\Listing\Settings\Motors\ViewItemGrid
 */
class Interceptor extends \Ess\M2ePro\Controller\Adminhtml\Ebay\Listing\Settings\Motors\ViewItemGrid implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Ess\M2ePro\Model\ActiveRecord\Component\Parent\Ebay\Factory $ebayFactory, \Ess\M2ePro\Controller\Adminhtml\Context $context)
    {
        $this->___init();
        parent::__construct($ebayFactory, $context);
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