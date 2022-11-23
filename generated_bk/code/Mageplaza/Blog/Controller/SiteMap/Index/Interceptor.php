<?php
namespace Mageplaza\Blog\Controller\SiteMap\Index;

/**
 * Interceptor class for @see \Mageplaza\Blog\Controller\SiteMap\Index
 */
class Interceptor extends \Mageplaza\Blog\Controller\SiteMap\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Mageplaza\Blog\Helper\Data $helperData)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $helperData);
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
