<?php
namespace Ess\M2ePro\Controller\Adminhtml\ControlPanel\Database\TruncateTables;

/**
 * Interceptor class for @see \Ess\M2ePro\Controller\Adminhtml\ControlPanel\Database\TruncateTables
 */
class Interceptor extends \Ess\M2ePro\Controller\Adminhtml\ControlPanel\Database\TruncateTables implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Ess\M2ePro\Controller\Adminhtml\Context $context, \Ess\M2ePro\Model\ControlPanel\Database\TableModelFactory $databaseTableFactory)
    {
        $this->___init();
        parent::__construct($context, $databaseTableFactory);
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
