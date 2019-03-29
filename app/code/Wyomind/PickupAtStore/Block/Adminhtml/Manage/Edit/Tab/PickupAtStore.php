<?php
/**
 * Copyright © 2019 Wyomind. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Wyomind\PickupAtStore\Block\Adminhtml\Manage\Edit\Tab;

class PickupAtStore extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /** 
     * @var \Magento\Customer\Model\Group 
     */
    protected $_groupModel = null;
    
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Customer\Model\Group $groupModel
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Customer\Model\Group $groupModel,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_groupModel = $groupModel;
    }
    
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('pointofsale');
        $form = $this->_formFactory->create();
        $fieldset = $form->addFieldset('pickupatstore', ['legend' => __('Pickup At Store')]);
        
        $fieldset->addField('pos_handling_fee', 'select', [
            'label' => __('Handling fee'),
            'name' => 'pos_handling_fee',
            'options' => [
                0 => __('Use the global handling fee'),
                1 => __('Use this POS/WH handling fee')
            ]
        ]);

        $fieldset->addField('pickup_fee', 'text', [
            'name' => 'pickup_fee',
            'label' => __('Fee amount'),
            'title' => __('Fee amount'),
            'required' => false
        ]);

        $fieldset->addField('pos_minimal_delay', 'select', [
            'label' => __('Minimum time required to handle an order'),
            'name' => 'pos_minimal_delay',
            'options' => [
                0 => __('Use the global minimal delay for an order'),
                1 => __('Use this POS/WH minimal delay for an order')
            ]
        ]);

        $fieldset->addField('minimal_delay', 'text', [
            'name' => 'minimal_delay',
            'note' => __('In minutes'),
            'label' => __('Minimal delay for an order'),
            'title' => __('Minimal delay for an order'),
            'required' => false
        ]);

        $fieldset->addField('pos_minimal_delay_backorder', 'select', [
            'label' => __('Minimum time required to handle a backorder'),
            'name' => 'pos_minimal_delay_backorder',
            'options' => [
                0 => __('Use the global minimal delay for a backorder'),
                1 => __('Use this POS/WH minimal delay for a backorder')
            ]
        ]);

        $fieldset->addField('minimal_delay_backorder', 'text', [
            'name' => 'minimal_delay_backorder',
            'note' => __('In minutes'),
            'label' => __('Minimal delay for a backorder'),
            'title' => __('Minimal delay for a backorder'),
            'required' => false
        ]);
        
        $this->setChild(
            'form_after', 
            $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Form\Element\Dependence')
                ->addFieldMap('pos_handling_fee', 'pos_handling_fee')
                ->addFieldMap('pickup_fee', 'pickup_fee')
                ->addFieldMap('pos_minimal_delay', 'pos_minimal_delay')
                ->addFieldMap('minimal_delay', 'minimal_delay')
                ->addFieldMap('pos_minimal_delay_backorder', 'pos_minimal_delay_backorder')
                ->addFieldMap('minimal_delay_backorder', 'minimal_delay_backorder')
                ->addFieldDependence('pickup_fee', 'pos_handling_fee', 1)
                ->addFieldDependence('minimal_delay', 'pos_minimal_delay', 1)
                ->addFieldDependence('minimal_delay_backorder', 'pos_minimal_delay_backorder', 1)
        );
        
        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return __('Pickup At Store');
    }

    public function getTabTitle()
    {
        return __('Pickup At Store');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}