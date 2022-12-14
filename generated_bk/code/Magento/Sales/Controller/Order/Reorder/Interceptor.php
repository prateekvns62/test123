<?php
namespace Magento\Sales\Controller\Order\Reorder;

/**
 * Interceptor class for @see \Magento\Sales\Controller\Order\Reorder
 */
class Interceptor extends \Magento\Sales\Controller\Order\Reorder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Sales\Controller\AbstractController\OrderLoaderInterface $orderLoader, \Magento\Framework\Registry $registry, \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator = null)
    {
        $this->___init();
        parent::__construct($context, $orderLoader, $registry, $formKeyValidator);
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
