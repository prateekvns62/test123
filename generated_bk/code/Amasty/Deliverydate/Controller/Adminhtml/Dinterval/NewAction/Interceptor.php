<?php
namespace Amasty\Deliverydate\Controller\Adminhtml\Dinterval\NewAction;

/**
 * Interceptor class for @see \Amasty\Deliverydate\Controller\Adminhtml\Dinterval\NewAction
 */
class Interceptor extends \Amasty\Deliverydate\Controller\Adminhtml\Dinterval\NewAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Registry $coreRegistry, \Psr\Log\LoggerInterface $logInterface, \Amasty\Deliverydate\Model\DintervalFactory $model, \Amasty\Deliverydate\Model\ResourceModel\Dinterval $resourceModel, \Amasty\Deliverydate\Model\ResourceModel\Dinterval\Collection $collection, \Magento\Ui\Component\MassAction\Filter $filter, \Magento\Framework\Stdlib\DateTime\DateTime $date)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $coreRegistry, $logInterface, $model, $resourceModel, $collection, $filter, $date);
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
