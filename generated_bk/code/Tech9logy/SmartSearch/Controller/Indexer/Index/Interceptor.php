<?php
namespace Tech9logy\SmartSearch\Controller\Indexer\Index;

/**
 * Interceptor class for @see \Tech9logy\SmartSearch\Controller\Indexer\Index
 */
class Interceptor extends \Tech9logy\SmartSearch\Controller\Indexer\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Indexer\Model\IndexerFactory $indexFactory, \Magento\Indexer\Model\Indexer\CollectionFactory $indexCollection)
    {
        $this->___init();
        parent::__construct($indexFactory, $indexCollection);
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
