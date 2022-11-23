<?php
namespace Amasty\Deliverydate\Controller\Deliverydate\Edit;

/**
 * Interceptor class for @see \Amasty\Deliverydate\Controller\Deliverydate\Edit
 */
class Interceptor extends \Amasty\Deliverydate\Controller\Deliverydate\Edit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Amasty\Deliverydate\Model\DeliverydateRepository $deliverydateRepository, \Magento\Framework\Registry $coreRegistry, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Sales\Controller\AbstractController\OrderViewAuthorization $orderAuthorization, \Magento\Sales\Model\OrderRepository $orderRepository, \Amasty\Deliverydate\Helper\Data $deliveryHelper)
    {
        $this->___init();
        parent::__construct($context, $deliverydateRepository, $coreRegistry, $resultPageFactory, $orderAuthorization, $orderRepository, $deliveryHelper);
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
