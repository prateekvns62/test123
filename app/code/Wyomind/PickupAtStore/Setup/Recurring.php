<?php

/**
 * Copyright © 2019 Wyomind. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Wyomind\PickupAtStore\Setup;

class Recurring implements \Magento\Framework\Setup\InstallSchemaInterface
{

    
    private $_coreHelper = null;

    public function __construct(
    \Wyomind\Core\Helper\Data $coreHelper
    )
    {
        $this->_coreHelper = $coreHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context)
    {

        $files = [
            "Model/Carrier/PickupAtStore.php"
        ];
        $this->_coreHelper->copyFilesByMagentoVersion(__FILE__, $files);
    }

}
