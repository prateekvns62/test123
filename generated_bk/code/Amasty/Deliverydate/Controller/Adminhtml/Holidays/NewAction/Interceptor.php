<?php
namespace Amasty\Deliverydate\Controller\Adminhtml\Holidays\NewAction;

/**
 * Interceptor class for @see \Amasty\Deliverydate\Controller\Adminhtml\Holidays\NewAction
 */
class Interceptor extends \Amasty\Deliverydate\Controller\Adminhtml\Holidays\NewAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Registry $coreRegistry, \Psr\Log\LoggerInterface $logInterface, \Amasty\Deliverydate\Model\HolidaysFactory $model, \Amasty\Deliverydate\Model\ResourceModel\Holidays $resourceModel, \Amasty\Deliverydate\Model\ResourceModel\Holidays\Collection $collection, \Magento\Ui\Component\MassAction\Filter $filter)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $coreRegistry, $logInterface, $model, $resourceModel, $collection, $filter);
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
