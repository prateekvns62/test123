<?php
namespace Amasty\PageSpeedOptimizer\Block\Adminhtml\Settings\ForceButton;

/**
 * Interceptor class for @see \Amasty\PageSpeedOptimizer\Block\Adminhtml\Settings\ForceButton
 */
class Interceptor extends \Amasty\PageSpeedOptimizer\Block\Adminhtml\Settings\ForceButton implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Amasty\PageSpeedOptimizer\Api\QueueRepositoryInterface $queueRepository, \Magento\Backend\Block\Template\Context $context, array $data = array())
    {
        $this->___init();
        parent::__construct($queueRepository, $context, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'render');
        if (!$pluginInfo) {
            return parent::render($element);
        } else {
            return $this->___callPlugins('render', func_get_args(), $pluginInfo);
        }
    }
}
