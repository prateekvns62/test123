<?php
namespace Amasty\Extrafee\Controller\Adminhtml\Index\NewConditionHtml;

/**
 * Interceptor class for @see \Amasty\Extrafee\Controller\Adminhtml\Index\NewConditionHtml
 */
class Interceptor extends \Amasty\Extrafee\Controller\Adminhtml\Index\NewConditionHtml implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Registry $coreRegistry, \Amasty\Extrafee\Model\FeeRepository $feeRepository, \Amasty\Extrafee\Model\FeeFactory $feeFactory, \Magento\Ui\Component\MassAction\Filter $filter, \Amasty\Extrafee\Model\ResourceModel\Fee\CollectionFactory $feeCollectionFactory, \Amasty\Base\Model\Serializer $serializer)
    {
        $this->___init();
        parent::__construct($context, $resultForwardFactory, $resultPageFactory, $coreRegistry, $feeRepository, $feeFactory, $filter, $feeCollectionFactory, $serializer);
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
