<?php
namespace Ninedotmedia\HomeCategoryTabs\Helper;

use Magento\Framework\App\Helper\Context;
use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    /**
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function getHomepageCategoryTab()
    {
        return $this->getConfig('homepage/category');
    }

    /**
     * @return mixed
     */
    public function getPerProduct()
    {
        return $this->getConfig('homepage/limit');
    }

    /**
     * @param string $groupKey
     * @return mixed
     */
    private function getConfig($groupKey)
    {
        return $this->scopeConfig->getValue(
            'theme_settings/'.$groupKey,
            ScopeInterface::SCOPE_STORE
        );
    }
}
