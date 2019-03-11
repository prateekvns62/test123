<?php
namespace Ninedotmedia\ProductAttributes\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    /**
     * @return mixed
     */
    public function getAttributesQty()
    {
        return $this->getConfig('product/attr_qty');
    }

    /**
     * @param string $groupKey
     * @return mixed
     */
    private function getConfig($groupKey)
    {
        //TODO::Move this to simple module
        return $this->scopeConfig->getValue(
            'theme_settings/'.$groupKey,
            ScopeInterface::SCOPE_STORE
        );
    }
}
