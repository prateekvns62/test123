<?php
namespace Wyomind\PointOfSale\Controller\Adminhtml\Attributes\Index;

/**
 * Interceptor class for @see \Wyomind\PointOfSale\Controller\Adminhtml\Attributes\Index
 */
class Interceptor extends \Wyomind\PointOfSale\Controller\Adminhtml\Attributes\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor, \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, \Magento\Framework\Registry $coreRegistry, \Magento\Ui\Component\MassAction\Filter $filter, \Wyomind\PointOfSale\Model\AttributesFactory $attributesModelFactory, \Wyomind\PointOfSale\Model\ResourceModel\Attributes\CollectionFactory $attributesCollectionFactory)
    {
        $this->___init();
        parent::__construct($context, $dataPersistor, $resultJsonFactory, $coreRegistry, $filter, $attributesModelFactory, $attributesCollectionFactory);
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
