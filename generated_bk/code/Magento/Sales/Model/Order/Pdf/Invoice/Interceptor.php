<?php
namespace Magento\Sales\Model\Order\Pdf\Invoice;

/**
 * Interceptor class for @see \Magento\Sales\Model\Order\Pdf\Invoice
 */
class Interceptor extends \Magento\Sales\Model\Order\Pdf\Invoice implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Payment\Helper\Data $paymentData, \Magento\Framework\Stdlib\StringUtils $string, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Framework\Filesystem $filesystem, \Magento\Sales\Model\Order\Pdf\Config $pdfConfig, \Magento\Sales\Model\Order\Pdf\Total\Factory $pdfTotalFactory, \Magento\Sales\Model\Order\Pdf\ItemsFactory $pdfItemsFactory, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate, \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation, \Magento\Sales\Model\Order\Address\Renderer $addressRenderer, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\Locale\ResolverInterface $localeResolver, array $data = array())
    {
        $this->___init();
        parent::__construct($paymentData, $string, $scopeConfig, $filesystem, $pdfConfig, $pdfTotalFactory, $pdfItemsFactory, $localeDate, $inlineTranslation, $addressRenderer, $storeManager, $localeResolver, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getPdf($invoices = array())
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPdf');
        if (!$pluginInfo) {
            return parent::getPdf($invoices);
        } else {
            return $this->___callPlugins('getPdf', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function insertDocumentNumber(\Zend_Pdf_Page $page, $text)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'insertDocumentNumber');
        if (!$pluginInfo) {
            return parent::insertDocumentNumber($page, $text);
        } else {
            return $this->___callPlugins('insertDocumentNumber', func_get_args(), $pluginInfo);
        }
    }
}
