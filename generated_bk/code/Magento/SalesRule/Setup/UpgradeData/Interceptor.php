<?php
namespace Magento\SalesRule\Setup\UpgradeData;

/**
 * Interceptor class for @see \Magento\SalesRule\Setup\UpgradeData
 */
class Interceptor extends \Magento\SalesRule\Setup\UpgradeData implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\DB\AggregatedFieldDataConverter $aggregatedFieldConverter, \Magento\Framework\EntityManager\MetadataPool $metadataPool, \Magento\SalesRule\Model\ResourceModel\Rule $resourceModelRule, \Magento\Framework\Serialize\SerializerInterface $serializer, \Magento\Framework\App\State $state, \Magento\SalesRule\Model\ResourceModel\Rule\CollectionFactory $ruleColletionFactory)
    {
        $this->___init();
        parent::__construct($aggregatedFieldConverter, $metadataPool, $resourceModelRule, $serializer, $state, $ruleColletionFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function convertSerializedDataToJson($setup)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'convertSerializedDataToJson');
        if (!$pluginInfo) {
            return parent::convertSerializedDataToJson($setup);
        } else {
            return $this->___callPlugins('convertSerializedDataToJson', func_get_args(), $pluginInfo);
        }
    }
}
