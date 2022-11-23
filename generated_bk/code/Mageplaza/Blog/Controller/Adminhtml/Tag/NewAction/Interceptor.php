<?php
namespace Mageplaza\Blog\Controller\Adminhtml\Tag\NewAction;

/**
 * Interceptor class for @see \Mageplaza\Blog\Controller\Adminhtml\Tag\NewAction
 */
class Interceptor extends \Mageplaza\Blog\Controller\Adminhtml\Tag\NewAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($resultForwardFactory, $context);
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
