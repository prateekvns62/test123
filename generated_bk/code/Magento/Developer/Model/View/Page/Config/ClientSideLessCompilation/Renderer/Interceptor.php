<?php
namespace Magento\Developer\Model\View\Page\Config\ClientSideLessCompilation\Renderer;

/**
 * Interceptor class for @see \Magento\Developer\Model\View\Page\Config\ClientSideLessCompilation\Renderer
 */
class Interceptor extends \Magento\Developer\Model\View\Page\Config\ClientSideLessCompilation\Renderer implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Page\Config $pageConfig, \Magento\Framework\View\Asset\MergeService $assetMergeService, \Magento\Framework\UrlInterface $urlBuilder, \Magento\Framework\Escaper $escaper, \Magento\Framework\Stdlib\StringUtils $string, \Psr\Log\LoggerInterface $logger, \Magento\Framework\View\Asset\Repository $assetRepo)
    {
        $this->___init();
        parent::__construct($pageConfig, $assetMergeService, $urlBuilder, $escaper, $string, $logger, $assetRepo);
    }

    /**
     * {@inheritdoc}
     */
    public function renderAssets($resultGroups = array())
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'renderAssets');
        if (!$pluginInfo) {
            return parent::renderAssets($resultGroups);
        } else {
            return $this->___callPlugins('renderAssets', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function renderHeadContent()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'renderHeadContent');
        if (!$pluginInfo) {
            return parent::renderHeadContent();
        } else {
            return $this->___callPlugins('renderHeadContent', func_get_args(), $pluginInfo);
        }
    }
}
