<?php
namespace Ess\M2ePro\Controller\Adminhtml\ControlPanel\Module\Integration\Ebay;

/**
 * Interceptor class for @see \Ess\M2ePro\Controller\Adminhtml\ControlPanel\Module\Integration\Ebay
 */
class Interceptor extends \Ess\M2ePro\Controller\Adminhtml\ControlPanel\Module\Integration\Ebay implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Ess\M2ePro\Model\Config\Manager\Synchronization $synchConfig, \Magento\Framework\Data\Form\FormKey $formKey, \Magento\Framework\File\Csv $csvParser, \Magento\Framework\HTTP\PhpEnvironment\Request $phpEnvironmentRequest, \Magento\Catalog\Model\ProductFactory $productFactory, \Ess\M2ePro\Controller\Adminhtml\Context $context)
    {
        $this->___init();
        parent::__construct($synchConfig, $formKey, $csvParser, $phpEnvironmentRequest, $productFactory, $context);
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
