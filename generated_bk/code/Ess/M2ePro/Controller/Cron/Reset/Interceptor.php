<?php
namespace Ess\M2ePro\Controller\Cron\Reset;

/**
 * Interceptor class for @see \Ess\M2ePro\Controller\Cron\Reset
 */
class Interceptor extends \Ess\M2ePro\Controller\Cron\Reset implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Ess\M2ePro\Model\Cron\Runner\Service $serviceCronRunner)
    {
        $this->___init();
        parent::__construct($context, $serviceCronRunner);
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
