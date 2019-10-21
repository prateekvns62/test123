<?php

namespace Ninedotmedia\Mobilegridmode\Block\Product;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Framework\Data\Helper\PostHelper;
use Magento\Framework\Url\Helper\Data;


class ListProduct extends \Magento\Catalog\Block\Product\ListProduct {

    protected $_helper;

    public function __construct(
        Context $context,
        PostHelper $postDataHelper,
        Resolver $layerResolver,
        CategoryRepositoryInterface $categoryRepository,
        Data $urlHelper,
        \Ninedotmedia\Mobilegridmode\Helper\Data $helper,
        array $data = []
    ) {
        $this->_helper = $helper;

        parent::__construct(
            $context,
            $postDataHelper,
            $layerResolver,
            $categoryRepository,
            $urlHelper,
            $data
        );
    }


    public function getMode()
    {
        if ($this->_helper->isMobileview()) {
            return $this->_helper->getMobileMode();
        }
        else {
            if ($this->getChildBlock('toolbar')) {
                return $this->getChildBlock('toolbar')->getCurrentMode();
            }
            return $this->getDefaultListingMode();
        }
    }
}