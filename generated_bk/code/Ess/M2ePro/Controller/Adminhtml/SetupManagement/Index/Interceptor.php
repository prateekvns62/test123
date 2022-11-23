<?php
namespace Ess\M2ePro\Controller\Adminhtml\SetupManagement\Index;

/**
 * Interceptor class for @see \Ess\M2ePro\Controller\Adminhtml\SetupManagement\Index
 */
class Interceptor extends \Ess\M2ePro\Controller\Adminhtml\SetupManagement\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Module\ModuleListInterface $moduleList, \Magento\Framework\Model\ResourceModel\Db\Context $dbContext, \Magento\Framework\Module\PackageInfo $packageInfo, \Magento\Framework\View\Design\Theme\ResolverInterface $themeResolver, \Magento\Framework\App\Filesystem\DirectoryList $directoryList, \Magento\Framework\App\CacheInterface $appCache, \Magento\Framework\App\Cache\State $cacheState, \Magento\Framework\App\State $appState, \Magento\Framework\Filesystem $filesystem, \Magento\Framework\App\DeploymentConfig $deploymentConfig, \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager, \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory, \Magento\Backend\App\Action\Context $context, \Ess\M2ePro\Helper\Factory $helperFactory)
    {
        $this->___init();
        parent::__construct($moduleList, $dbContext, $packageInfo, $themeResolver, $directoryList, $appCache, $cacheState, $appState, $filesystem, $deploymentConfig, $cookieManager, $cookieMetadataFactory, $context, $helperFactory);
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
