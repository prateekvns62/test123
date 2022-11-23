<?php
namespace Ess\M2ePro\Controller\Adminhtml\ControlPanel\Tools\M2ePro\Install;

/**
 * Interceptor class for @see \Ess\M2ePro\Controller\Adminhtml\ControlPanel\Tools\M2ePro\Install
 */
class Interceptor extends \Ess\M2ePro\Controller\Adminhtml\ControlPanel\Tools\M2ePro\Install implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Filesystem\Driver\File $filesystemDriver, \Magento\Framework\Filesystem $filesystem, \Magento\Framework\Filesystem\File\ReadFactory $fileReaderFactory, \Magento\Framework\App\Filesystem\DirectoryList $directoryList, \Magento\Framework\Component\ComponentRegistrar $componentRegistrar, \Ess\M2ePro\Controller\Adminhtml\Context $context)
    {
        $this->___init();
        parent::__construct($filesystemDriver, $filesystem, $fileReaderFactory, $directoryList, $componentRegistrar, $context);
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
