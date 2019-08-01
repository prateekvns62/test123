<?php
namespace Ninedotmedia\Mobilegrimode\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    public function isMobileview()
    {
        return $this->scopeConfig->getValue('catalog/frontend/grid_mode_mobile',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}