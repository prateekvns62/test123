<?php
namespace Magento\Catalog\Model\ResourceModel\Product\Attribute\Collection;

/**
 * Interceptor class for @see \Magento\Catalog\Model\ResourceModel\Product\Attribute\Collection
 */
class Interceptor extends \Magento\Catalog\Model\ResourceModel\Product\Attribute\Collection implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Data\Collection\EntityFactory $entityFactory, \Psr\Log\LoggerInterface $logger, \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy, \Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Eav\Model\Config $eavConfig, \Magento\Eav\Model\EntityFactory $eavEntityFactory, \Magento\Framework\DB\Adapter\AdapterInterface $connection = null, \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null)
    {
        $this->___init();
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $eavConfig, $eavEntityFactory, $connection, $resource);
    }

    /**
     * {@inheritdoc}
     */
    public function getItemByColumnValue($column, $value)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getItemByColumnValue');
        if (!$pluginInfo) {
            return parent::getItemByColumnValue($column, $value);
        } else {
            return $this->___callPlugins('getItemByColumnValue', func_get_args(), $pluginInfo);
        }
    }
}
