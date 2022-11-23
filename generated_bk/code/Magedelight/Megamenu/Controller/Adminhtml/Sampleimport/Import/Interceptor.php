<?php
namespace Magedelight\Megamenu\Controller\Adminhtml\Sampleimport\Import;

/**
 * Interceptor class for @see \Magedelight\Megamenu\Controller\Adminhtml\Sampleimport\Import
 */
class Interceptor extends \Magedelight\Megamenu\Controller\Adminhtml\Sampleimport\Import implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Xml\Parser $parser, \Magento\Cms\Api\BlockRepositoryInterface $blockRepository, \Magento\Cms\Model\BlockFactory $blockFactory, \Magento\Framework\App\ResourceConnection $resource, \Magedelight\Megamenu\Model\MenuFactory $menuFactory, \Magedelight\Megamenu\Model\MenuItemsFactory $menuItemFactory, \Magento\Framework\App\ProductMetadataInterface $productMetadata, \Magento\Framework\Module\Dir\Reader $moduleReader)
    {
        $this->___init();
        parent::__construct($context, $parser, $blockRepository, $blockFactory, $resource, $menuFactory, $menuItemFactory, $productMetadata, $moduleReader);
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
