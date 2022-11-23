<?php
namespace Ess\M2ePro\Controller\Adminhtml\Wizard\InstallationAmazon\ListingGeneral;

/**
 * Interceptor class for @see \Ess\M2ePro\Controller\Adminhtml\Wizard\InstallationAmazon\ListingGeneral
 */
class Interceptor extends \Ess\M2ePro\Controller\Adminhtml\Wizard\InstallationAmazon\ListingGeneral implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Ess\M2ePro\Model\ActiveRecord\Component\Parent\Amazon\Factory $amazonFactory, \Magento\Framework\Code\NameBuilder $nameBuilder, \Ess\M2ePro\Controller\Adminhtml\Context $context)
    {
        $this->___init();
        parent::__construct($amazonFactory, $nameBuilder, $context);
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
