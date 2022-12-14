<?php
namespace Magento\Newsletter\Controller\Adminhtml\Subscriber\MassUnsubscribe;

/**
 * Interceptor class for @see \Magento\Newsletter\Controller\Adminhtml\Subscriber\MassUnsubscribe
 */
class Interceptor extends \Magento\Newsletter\Controller\Adminhtml\Subscriber\MassUnsubscribe implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory = null)
    {
        $this->___init();
        parent::__construct($context, $fileFactory, $subscriberFactory);
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
