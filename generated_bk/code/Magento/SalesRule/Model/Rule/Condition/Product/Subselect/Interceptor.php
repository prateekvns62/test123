<?php
namespace Magento\SalesRule\Model\Rule\Condition\Product\Subselect;

/**
 * Interceptor class for @see \Magento\SalesRule\Model\Rule\Condition\Product\Subselect
 */
class Interceptor extends \Magento\SalesRule\Model\Rule\Condition\Product\Subselect implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Rule\Model\Condition\Context $context, \Magento\SalesRule\Model\Rule\Condition\Product $ruleConditionProduct, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $ruleConditionProduct, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function validate(\Magento\Framework\Model\AbstractModel $model)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'validate');
        if (!$pluginInfo) {
            return parent::validate($model);
        } else {
            return $this->___callPlugins('validate', func_get_args(), $pluginInfo);
        }
    }
}
