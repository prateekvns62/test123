<?php
namespace Ninedotmedia\Theme\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use \Magento\Catalog\Model\Product;
use \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use \Magento\Catalog\Model\Product\Attribute\Source\Boolean;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Attribute prefix
     */
    const ATTR_PREFIX = 'ndm_';

    /**
     * product attribute group
     */
    const ATTR_GROUP = 'Characteristics';

    /**
     * UpgradeData constructor.
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.1.1') < 0) {
            $this->createProductAttributeGroup($setup);
            $this->createDemoProductAttributes($setup);
        }

        $setup->endSetup();
    }

    /**
     * @param ModuleDataSetupInterface $setup
     */
    private function createProductAttributeGroup(ModuleDataSetupInterface $setup)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $groupName = self::ATTR_GROUP;
        $entityTypeId = $eavSetup->getEntityTypeId(Product::ENTITY);
        $attributeSetIds = $eavSetup->getAllAttributeSetIds($entityTypeId);

        foreach ($attributeSetIds as $attributeSetId) {
            $eavSetup->addAttributeGroup($entityTypeId, $attributeSetId, $groupName, 19);
        }
    }

    /**
     * @param ModuleDataSetupInterface $setup
     */
    private function createDemoProductAttributes(ModuleDataSetupInterface $setup)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $attrs = [
            'capacity' => ['label'=>'Capacity','type'=>'text','order'=>100, 'visible_in_frontend'=>1],
            'spin_speed' => ['label'=>'Spin Speed','type'=>'text','order'=>110, 'visible_in_frontend'=>1],
            'number_programmes' => [
                'label'=>'Number Of Programmes','type'=>'text','order'=>115,'visible_in_frontend'=>0
            ],
            'dimensions' => ['label'=>'Dimensions','type'=>'text','order'=>120, 'visible_in_frontend'=>0],
            'pre_wash' => ['label'=>'Pre Wash','type'=>'bool','order'=>145,'visible_in_frontend'=>0],
            'child_lock' => ['label'=>'Child Lock','type'=>'bool','order'=>150,'visible_in_frontend'=>1],
            'energy_rating' => [
                'label'=>'Energy Rating','type'=>'dropdown','order'=>125,'visible_in_frontend'=>1,
                'option'=>['values'=>['A+++','A++','A+','A','B','C','D']]
            ],
            'guarantee' => [
                'label'=>'Guarantee','type'=>'dropdown','order'=>130,'visible_in_frontend'=>1,
                'option'=>['values'=>['One-year guarantee','Two-year guarantee','Three-years guarantee']]
            ],
            'quick_wash_time' => [
                'label'=>'Quick Wash Time','type'=>'dropdown','order'=>135,'visible_in_frontend'=>1,
                'option'=>['values'=>['30', '45', '60']]
            ],
            'colour' => [
                'label'=>'Colour','type'=>'dropdown','order'=>140,'visible_in_frontend'=>0,
                'option'=>['values'=>['white','black']]
            ],
        ];

        foreach ($attrs as $key => $attr) {
            $options = [];
            switch ($attr['type']) {
                case 'text':
                    $options = $this->getTextOptions($attr);
                    break;
                case 'bool':
                    $options = $this->getBoolOptions($attr);
                    break;
                case 'dropdown':
                    $options = $this->getDropDownOptions($attr);
                    break;
            }

            $this->createAttribute($eavSetup, $key, $options);
        }
    }

    /**
     * @param array $attr
     * @return array
     */
    private function getBoolOptions(array $attr)
    {
        return [
            'group' => self::ATTR_GROUP,
            'type' => 'int',
            'backend' => '',
            'frontend' => '',
            'label' => $attr['label'],
            'input' => 'boolean',
            'class' => '',
            'source' => Boolean::class,
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '0',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => $attr['visible_in_frontend'],
            'used_in_product_listing' => $attr['visible_in_frontend'],
            'sort_order'=>$attr['order']
        ];
    }

    /**
     * @param array $attr
     * @return array
     */
    private function getTextOptions(array $attr)
    {
        return [
            'group' => self::ATTR_GROUP,
            'type' => 'text',
            'backend' => '',
            'frontend' => '',
            'label' => $attr['label'],
            'input' => 'text',
            'class' => '',
            'source' => '',
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => $attr['visible_in_frontend'],
            'used_in_product_listing' => $attr['visible_in_frontend'],
            'unique' => false,
            'sort_order'=>$attr['order']
        ];
    }

    /**
     * @param array $attr
     * @return array
     */
    private function getDropDownOptions(array $attr)
    {
        return [
            'group' => self::ATTR_GROUP,
            'type' => 'varchar',
            'backend' => '',
            'frontend' => '',
            'label' => $attr['label'],
            'input' => 'select',
            'class' => '',
            'source' => '',
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => $attr['visible_in_frontend'],
            'used_in_product_listing' => $attr['visible_in_frontend'],
            'unique' => false,
            'sort_order'=>$attr['order'],
            'option' => $attr['option']
        ];
    }

    /**
     * @param EavSetupFactory $eavSetup
     * @param string $key
     * @param array $options
     * @return bool
     */
    private function createAttribute($eavSetup, $key, $options)
    {
        if (empty($options)) {
            return false;
        }
        $eavSetup->addAttribute(Product::ENTITY, self::ATTR_PREFIX.$key, $options);
        return true;
    }
}
