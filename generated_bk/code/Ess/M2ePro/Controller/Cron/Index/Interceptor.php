<?php
namespace Ess\M2ePro\Controller\Cron\Index;

/**
 * Interceptor class for @see \Ess\M2ePro\Controller\Cron\Index
 */
class Interceptor extends \Ess\M2ePro\Controller\Cron\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Ess\M2ePro\Model\Cron\Runner\Service $serviceCronRunner, \Ess\M2ePro\Model\Magento\Framework\Http\NotCacheableResponseFactory $responseFactory)
    {
        $this->___init();
        parent::__construct($context, $serviceCronRunner, $responseFactory);
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
