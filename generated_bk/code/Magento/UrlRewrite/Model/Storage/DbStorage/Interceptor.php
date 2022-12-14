<?php
namespace Magento\UrlRewrite\Model\Storage\DbStorage;

/**
 * Interceptor class for @see \Magento\UrlRewrite\Model\Storage\DbStorage
 */
class Interceptor extends \Magento\UrlRewrite\Model\Storage\DbStorage implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\UrlRewrite\Service\V1\Data\UrlRewriteFactory $urlRewriteFactory, \Magento\Framework\Api\DataObjectHelper $dataObjectHelper, \Magento\Framework\App\ResourceConnection $resource, \Psr\Log\LoggerInterface $logger = null)
    {
        $this->___init();
        parent::__construct($urlRewriteFactory, $dataObjectHelper, $resource, $logger);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteByData(array $data)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'deleteByData');
        if (!$pluginInfo) {
            return parent::deleteByData($data);
        } else {
            return $this->___callPlugins('deleteByData', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByData(array $data)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'findOneByData');
        if (!$pluginInfo) {
            return parent::findOneByData($data);
        } else {
            return $this->___callPlugins('findOneByData', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function replace(array $urls)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'replace');
        if (!$pluginInfo) {
            return parent::replace($urls);
        } else {
            return $this->___callPlugins('replace', func_get_args(), $pluginInfo);
        }
    }
}
