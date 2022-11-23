<?php
namespace Magedelight\Megamenu\Controller\Adminhtml\Sampleimport\Export;

/**
 * Interceptor class for @see \Magedelight\Megamenu\Controller\Adminhtml\Sampleimport\Export
 */
class Interceptor extends \Magedelight\Megamenu\Controller\Adminhtml\Sampleimport\Export implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Ui\Component\MassAction\Filter $filter, \Magento\Ui\Model\Export\SearchResultIteratorFactory $iteratorFactory, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Framework\Filesystem $filesystem, \Magedelight\Megamenu\Model\MenuItemsFactory $menuItems, \Magento\Cms\Model\BlockFactory $blockFactory)
    {
        $this->___init();
        parent::__construct($context, $filter, $iteratorFactory, $fileFactory, $filesystem, $menuItems, $blockFactory);
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
