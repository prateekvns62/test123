<?php
namespace Ninedotmedia\ThemeConfiguration\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Store\Model\ScopeInterface;

class Configuration extends AbstractHelper
{
    /**
     * Homepage section
     */
    const HOMEPAGE_SECTION = 'homepage/';

    /**
     * Homepage section
     */
    const PRODUCT_SECTION = 'product/';

    /**
     * Header section
     */
    const HEADER_SECTION = 'header/';

    /**
     * @return mixed
     */
    public function getHomepageCategoryTab()
    {
        return $this->getConfig(self::HOMEPAGE_SECTION.'category');
    }

    /**
     * @return mixed
     */
    public function getProductPerTab()
    {
        return $this->getConfig(self::HOMEPAGE_SECTION.'limit');
    }

    /**
     * @return mixed
     */
    public function getAttributesQty()
    {
        return $this->getConfig(self::PRODUCT_SECTION.'attr_qty');
    }

    /**
     * @return array
     */
    public function getVisitOption()
    {
        return [
            'label'  => $this->getConfig(self::HEADER_SECTION.'visit_label'),
            'url'   => $this->getConfig(self::HEADER_SECTION.'visit_url')
        ];
    }

    /**
     * @return mixed
     */
    public function getContactMessage()
    {
        return $this->getConfig(self::HEADER_SECTION.'contact_message');
    }

    /**
     * @param string $groupKey
     * @return mixed
     */
    public function getConfig($groupKey)
    {
        return $this->scopeConfig->getValue(
            'theme_settings/'.$groupKey,
            ScopeInterface::SCOPE_STORE
        );
    }
}
