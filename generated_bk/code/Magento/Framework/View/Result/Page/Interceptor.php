<?php
namespace Magento\Framework\View\Result\Page;

/**
 * Interceptor class for @see \Magento\Framework\View\Result\Page
 */
class Interceptor extends \Magento\Framework\View\Result\Page implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\View\LayoutFactory $layoutFactory, \Magento\Framework\View\Layout\ReaderPool $layoutReaderPool, \Magento\Framework\Translate\InlineInterface $translateInline, \Magento\Framework\View\Layout\BuilderFactory $layoutBuilderFactory, \Magento\Framework\View\Layout\GeneratorPool $generatorPool, \Magento\Framework\View\Page\Config\RendererFactory $pageConfigRendererFactory, \Magento\Framework\View\Page\Layout\Reader $pageLayoutReader, $template, $isIsolated = false, \Magento\Framework\View\EntitySpecificHandlesList $entitySpecificHandlesList = null)
    {
        $this->___init();
        parent::__construct($context, $layoutFactory, $layoutReaderPool, $translateInline, $layoutBuilderFactory, $generatorPool, $pageConfigRendererFactory, $pageLayoutReader, $template, $isIsolated, $entitySpecificHandlesList);
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getConfig');
        if (!$pluginInfo) {
            return parent::getConfig();
        } else {
            return $this->___callPlugins('getConfig', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function renderResult(\Magento\Framework\App\ResponseInterface $httpResponse)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'renderResult');
        if (!$pluginInfo) {
            return parent::renderResult($httpResponse);
        } else {
            return $this->___callPlugins('renderResult', func_get_args(), $pluginInfo);
        }
    }
}
