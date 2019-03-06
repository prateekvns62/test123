<?php
namespace Ninedotmedia\HomeCategoryTabs\Helper;

use Magento\Framework\App\Helper\Context;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    /*****
     * Config constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /*****
     * @return mixed
     */
    public function getHomepageCategoryTab()
    {
        return $this->getConfig('homepage/category');
    }

    /****
     * @return mixed
     */
    public function getPerProduct()
    {
        return $this->getConfig('homepage/limit');
    }

    /*****
     * @param $groupKey
     * @return mixed
     */
    private function getConfig($groupKey)
    {
        return $this->scopeConfig->getValue(
            'theme_settings/'.$groupKey,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}