<?php
namespace Wyomind\PointOfSale\Controller\Store\Index;

/**
 * Interceptor class for @see \Wyomind\PointOfSale\Controller\Store\Index
 */
class Interceptor extends \Wyomind\PointOfSale\Controller\Store\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Wyomind\PointOfSale\Model\PointOfSale $posModel)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $posModel);
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
