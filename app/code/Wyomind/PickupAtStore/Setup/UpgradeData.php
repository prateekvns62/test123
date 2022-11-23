<?php
/**
 * Copyright © 2019 Wyomind. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Wyomind\PickupAtStore\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var \Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\Collection
     */
    private $_posCollection;

    /**
     * @var \Magento\Framework\App\State
     */
    private $_state;

    /** @var EavSetupFactory $eavSetupFactory */
    private $_eavSetupFactory;

    /**
     * @param \Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\Collection $posCollection
     */
    public function __construct(
        \Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\Collection $posCollection,
        \Magento\Framework\App\State $state,
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
    )
    {
        $this->_posCollection = $posCollection;
        $this->_state = $state;
        $this->_eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '3.3.0', '<')) {
            try {
                $this->_state->setAreaCode(\Magento\Framework\App\Area::AREA_ADMINHTML);
            } catch (\Exception $e) {

            }

            foreach ($this->_posCollection as $pos) {
                $fee = $pos->getPickupFee();

                if ($fee) {
                    $pos->setPosHandlingFee(1);
                    $pos->save();
                }
            }
        }


        if (version_compare($context->getVersion(), '3.5.1') < 0) {


            $eavSetup = $this->_eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'disallow_pickupatstore',
                [
                    'group' => "General",
                    'type' => 'int',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Disallow store pickup?',
                    'input' => 'boolean',
                    'class' => '',
                    'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'visible' => true,
                    'required' => true,
                    'user_defined' => false,
                    'default' => '0',
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                    'visible_on_front' => false,
                    'used_in_product_listing' => false,
                    'unique' => false,
                    'apply_to' => ''
                ]
            );


        }
        $setup->endSetup();
    }
}