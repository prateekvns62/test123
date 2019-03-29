<?php

/**
 * Copyright © 2019 Wyomind. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Wyomind\PickupAtStore\Block;

/**
 * Block defining the first step of the shipping step in the checkout
 * Allow to choice if the customer wants to pickup in store his order or not
 */
class Choice extends \Magento\Framework\View\Element\Template
{


    protected $_template = 'Wyomind_PickupAtStore::choice.phtml';

    protected $_config = null;

    /**
     * Block constructor
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Wyomind\PickupAtStore\Helper\Config $config Stores > Config > Shipping methods > Pickup At Store
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Wyomind\PickupAtStore\Helper\Config $config,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_config = $config;
        $this->setTemplate($this->_template);
    }

    /**
     * Get the title of the block (displayed on the frontend)
     * @return string the title of the block
     */
    public function getTitle()
    {
        return $this->_config->getChoiceTitle();
    }

    public function getStorePickupActivatedDefault()
    {
        return $this->_config->getStorePickupActivatedDefault();
    }

}
