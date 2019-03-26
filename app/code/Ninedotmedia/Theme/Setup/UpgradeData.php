<?php
namespace Ninedotmedia\Theme\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use \Magento\Catalog\Model\Product;
use \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use \Magento\Catalog\Model\Product\Attribute\Source\Boolean;
use \Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Cms\Api\Data\BlockInterface;
use Magento\Cms\Api\Data\BlockInterfaceFactory;
use Magento\Cms\Api\Data\PageInterface;
use Magento\Cms\Api\Data\PageInterfaceFactory;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Store\Model\Store;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Widget\Model\Widget\InstanceFactory as WidgetInstance;
use Magento\Catalog\Block\Widget\RecentlyViewed;
use Magento\Backend\App\Area\FrontNameResolver;
use Magento\Framework\App\State;
use Magento\Cms\Block\Widget\Block as CMSBlock;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var BlockInterfaceFactory
     */
    private $blockInterfaceFactory;

    /**
     * @var BlockRepositoryInterface
     */
    private $blockRepository;

    /**
     * @var PageRepositoryInterface
     */
    private $pageRepository;
    /**
     * @var PageInterfaceFactory
     */
    private $pageInterfaceFactory;

    /**
     * @var WriterInterface
     */
    private $writerInterface;

    /**
     * @var WidgetInstance
     */
    private $widgetFactory;

    /**
     * @var State
     */
    private $appState;

    private $scopeConfig;

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
     * @param BlockRepositoryInterface $blockRepository
     * @param BlockInterfaceFactory $blockInterfaceFactory
     * @param PageRepositoryInterface $pageRepository
     * @param PageInterfaceFactory $pageInterfaceFactory
     * @param WriterInterface $writerInterface
     * @param WidgetInstance $widgetFactory
     * @param State $appState
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        BlockRepositoryInterface $blockRepository,
        BlockInterfaceFactory $blockInterfaceFactory,
        PageRepositoryInterface $pageRepository,
        PageInterfaceFactory $pageInterfaceFactory,
        WriterInterface $writerInterface,
        WidgetInstance $widgetFactory,
        State $appState,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->blockRepository = $blockRepository;
        $this->blockInterfaceFactory = $blockInterfaceFactory;
        $this->pageRepository = $pageRepository;
        $this->pageInterfaceFactory = $pageInterfaceFactory;
        $this->writerInterface = $writerInterface;
        $this->widgetFactory = $widgetFactory;
        $this->appState = $appState;
        $this->scopeConfig = $scopeConfig;
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

        if (version_compare($context->getVersion(), '0.1.2') < 0) {
            $this->createAdvantagesAttribute($setup);
        }

        if (version_compare($context->getVersion(), '0.1.3') < 0) {
            $this->createConditionAttribute($setup);
        }

        if (version_compare($context->getVersion(), '0.1.4') < 0) {
            $this->createCmsBlocks();
            $this->createCmsPages();
        }

        if (version_compare($context->getVersion(), '0.1.5') < 0) {
            $this->createProductLinkBlockRecentlyWidget();
        }

        if (version_compare($context->getVersion(), '0.1.6') < 0) {
            $this->createContactPageBlockAndWidgets();
        }

        if (version_compare($context->getVersion(), '0.1.7') < 0) {
            $this->repairContactPageMapBlock();
        }

        if (version_compare($context->getVersion(), '0.1.8') < 0) {
            $this->updateHomepageAndCopy();
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
     * @param ModuleDataSetupInterface $setup
     */
    private function createAdvantagesAttribute(ModuleDataSetupInterface $setup)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $key = 'advantages';
        $attr = [
            $key => [
                'label'=>'Advantages','type'=>'multiselect','order'=>145, 'visible_in_frontend'=>1,
                'option'=>['values'=>['Free, Fast delivery', 'Collect in store']]
            ]
        ];

        $options = $this->getDropDownOptions($attr[$key]);
        $options['group'] = 'Additional';
        $options['backend'] = ArrayBackend::class;
        $options['input'] = 'multiselect';

        $this->createAttribute($eavSetup, $key, $options);
    }

    /**
     * @param ModuleDataSetupInterface $setup
     */
    public function createConditionAttribute(ModuleDataSetupInterface $setup)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $attrs = [
            'condition' => ['label'=>'Condition','type'=>'dropdown','order'=>150,'visible_in_frontend'=>1,
                'option'=>['values'=>['Brand new', 'Rated(A)', 'Rated(B)', 'Rated(C)', 'Rated(D)']]]
        ];

        foreach ($attrs as $key => $attr) {
            $options = $this->getDropDownOptions($attr);
            $options['group'] = 'Additional';
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

    /**
     * Cms Blocks Creations
     */
    private function createCmsBlocks()
    {
        $headerLinkPhone = <<<EOD
        <ul>
            <li class="header-links-phone">Call <strong>0116 271 0320</strong> or <strong>07982 134 105</strong></li>
        </ul>
EOD;
        $headerLinkVisit = <<<EOD
        <ul>
            <li class="header-links-visit"><a href="#">Visit our showroom</a></li>
        </ul>
EOD;
        $headerContentInfo = '<div class="header-content-info">Making happy customers, one smile at a time.</div>';
        $homepageBlockReviews = <<<EOD
        <div class="homepage-block reviews">
            <a href="#">
                <div class="holder-img"><img src="{{media url="wysiwyg/homepage-block-reviews.png"}}" alt="" /></div>
                <div class="holder-text">
                    <strong class="title"> Trusted on Google Reviews </strong>
                    <div class="holder-img bottom"><img src="{{media url="wysiwyg/star.png"}}" alt="" /></div>
                </div>
            </a>
        </div>
EOD;
        $homepageBlockInterest = <<<EOD
        <div class="homepage-block interest">
            <a href="#">
                <div class="holder-img"><img src="{{media url="wysiwyg/homepage-block-interest.png"}}" alt="" /></div>
                <div class="holder-text">
                    <strong class="title"> Interest free credit avaialble </strong>
                    <div class="text">Apply online</div>
                    <div class="holder-img bottom"><img src="{{media url="wysiwyg/interest.png"}}" alt="" /></div>
                </div>
            </a>
        </div>
EOD;
        $homepageBlockDelivery = <<<EOD
        <div class="homepage-block delivery">
            <a href="#">
                <div class="holder-img"><img src="{{media url="wysiwyg/homepage-block-delivery.png"}}" alt="" /></div>
                <div class="holder-text">
                    <strong class="title"> Delivery options to suit you </strong>
                    <div class="text">More info</div>
                    <div class="holder-img bottom"><img src="{{media url="wysiwyg/delivery.png"}}" alt="" /></div>
                </div>
            </a>
        </div>
EOD;
        $homepageBlockLeading = <<<EOD
        <div class="homepage-block leading">
            <a href="#">
                <div class="holder-img"><img src="{{media url="wysiwyg/homepage-block-leading.png"}}" alt="" /></div>
                <div class="holder-text"><strong class="title"> Leading Brands </strong>
                    <div class="text">From <strong>AEG</strong> to <strong>Zanussi</strong> we’ve got them all.</div>
                    <div class="holder-img bottom"><img src="{{media url="wysiwyg/leading.png"}}" alt="" /></div>
                </div>
            </a>
        </div>
EOD;
        $footerContact = <<<EOD
        <div class="footer-contact">
            <div class="wrap-list"><strong class="title">Get In touch</strong>
                <ul>
                    <li class="fax"><a href="tel:0116 271 0320">0116 271 0320</a></li>
                    <li class="tel"><a href="tel:0798 213 4105">0798 213 4105</a></li>
                    <li class="email"><a href="mailto:sales@bargainbuyz.co.uk">sales@bargainbuyz.co.uk</a></li>
                </ul>
            </div>
            <div class="wrap-list"><strong class="title">Visit our showroom</strong>
                <ul>
                    <li class="address">47 London Road Oadby Leicester LE2 5DN</li>
                </ul>
            </div>
        </div>
EOD;
        $footerMap = <<<EOD
        <div class="footer-map">
            <div class="wrap-img"><img src="{{media url="wysiwyg/footer-map.png"}}" alt="" /></div>
        </div>
EOD;
        $footerLinks = <<<EOD
        <div class="footer-links">
            <div class="list"><strong class="title">Your Account</strong>
                <ul>
                    <li><a href="#">Your Account</a></li>
                    <li><a href="#">Order History</a></li>
                    <li><a href="#">Your Transactions</a></li>
                    <li><a href="#">Login / Sign Out</a></li>
                </ul>
            </div>
            <div class="list"><strong class="title">Help &amp; Support</strong>
                <ul>
                    <li><a href="#">Delivery Information</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms &amp; Conditions</a></li>
                </ul>
            </div>
            <div class="list"><strong class="title">Top Brands</strong>
                <ul>
                    <li><a href="#">Hotpoint</a></li>
                    <li><a href="#">Samsung</a></li>
                    <li><a href="#">Indesit</a></li>
                    <li><a href="#">Beko</a></li>
                </ul>
            </div>
            <div class="list"><strong class="title">Product Categories</strong>
                <ul>
                    <li><a href="#">Laundry</a></li>
                    <li><a href="#">Dishwashers</a></li>
                    <li><a href="#">Cooking</a></li>
                    <li><a href="#">Refridgeration</a></li>
                </ul>
            </div>
            <div class="list"><strong class="title">Smile. Social.</strong>
                <ul>
                    <li class="facebook"><a href="#">Facebook</a></li>
                    <li class="instagram"><a href="#">Instagram</a></li>
                    <li class="google-reviews"><a href="#">Google Reviews</a></li>
                </ul>
            </div>
            <div class="list"><strong class="title">Quick links</strong>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
        </div>
EOD;
        $greyBlockInfo = <<<EOD
<ul>
    <li class="manufacturers">
        <span class="title"> MANUFACTURER’S GUARANTEE </span> <span class="text"> Included on all products </span></li>
    <li class="delivery">
        <span class="title"> FREE, FAST DELIVERY </span> <span class="text"> Within 20 mile radius </span>
        </li>
    <li class="instant">
<span class="title"> INSTANT CLICK &amp; COLLECT </span> <span class="text"> Available from our Leicester store </span>
    </li>
    <li class="new">
<span class="title"> NEW, GRADED &amp; EX-DISPLAY </span> <span class="text"> Wide range of quaility products </span>
    </li>
</ul>        
EOD;
        $copyrightText = '<p>Website design and ecommerce by <a href="#">Nine Dot Media</a></p>';

        $blocks = [
            'header-links-phone' => ['title' => 'Header links phone', 'content' => $headerLinkPhone],
            'header-links-visit' => ['title' => 'Header Links Visit', 'content' => $headerLinkVisit],
            'header-content-info' => ['title' => 'Header Content Info', 'content' => $headerContentInfo],
            'homepage-block-reviews' => ['title' => 'Homepage Block Reviews', 'content' => $homepageBlockReviews],
            'homepage-block-interest' => ['title' => 'Homepage Block Interest', 'content' => $homepageBlockInterest],
            'homepage-block-delivery' => ['title' => 'Homepage Block Delivery', 'content' => $homepageBlockDelivery],
            'homepage-block-leading' => ['title' => 'Homepage Block Leading', 'content' => $homepageBlockLeading],
            'footer-contact' => ['title' => 'Footer Contact', 'content' => $footerContact],
            'footer-map' => ['title' => 'Footer Map', 'content' => $footerMap],
            'footer-links' => ['title' => 'Footer Links', 'content' => $footerLinks],
            'grey-block-info' => ['title' => 'Grey Block Info', 'content' => $greyBlockInfo],
            'copyright-text' => ['title' => 'Copyright Text', 'content' => $copyrightText]
        ];

        foreach ($blocks as $key => $block) {
            $this->checkAndCreateBlock($key, $block);
        }
    }

    /**
     * CMS Pages Creation
     */
    private function createCmsPages()
    {
        $home = <<<EOD
<section class="homepage-slider">
    <div class="homepage-holder-slider">
        <div class="holder-nav">
        <ul class="owl-carousel-navigation">
<li><a class="button url" href="#1"> <strong>Tab Heading</strong> <span>Tab content / call to action</span> </a></li>
<li><a class="button url" href="#2"> <strong>Tab Heading</strong> <span>Tab content / call to action</span> </a></li>
<li><a class="button url" href="#3"> <strong>Tab Heading</strong> <span>Tab content / call to action</span> </a></li>
<li><a class="button url" href="#4"> <strong>Tab Heading</strong> <span>Tab content / call to action</span> </a></li>
<li><a class="button url" href="#5"> <strong>Tab Heading</strong> <span>Tab content / call to action</span> </a></li>
<li><a class="button url" href="#6"> <strong>Tab Heading</strong> <span>Tab content / call to action</span> </a></li>
        </ul>
        </div>
        <div class="holder-slider">
            <div class="owl-carousel owl-theme">
                <div class="item" data-hash="1">
                    <div class="wrap-img"><img src="{{media url="wysiwyg/slider_image.png"}}" alt="" />
                        <div class="holder-text">
                            <h1>Slide heading</h1>
                            <h3>Slide call to action text</h3>
                            <a class="action primary" href="#">Button</a></div>
                    </div>
                </div>
                <div class="item" data-hash="2">
                    <div class="wrap-img"><img src="{{media url="wysiwyg/slider_image.png"}}" alt="" />
                        <div class="holder-text">
                            <h1>Slide heading</h1>
                            <h3>Slide call to action text</h3>
                            <a class="action primary" href="#">Button</a></div>
                    </div>
                </div>
                <div class="item" data-hash="3">
                    <div class="wrap-img"><img src="{{media url="wysiwyg/slider_image.png"}}" alt="" />
                        <div class="holder-text">
                            <h1>Slide heading</h1>
                            <h3>Slide call to action text</h3>
                            <a class="action primary" href="#">Button</a></div>
                    </div>
                </div>
                <div class="item" data-hash="4">
                    <div class="wrap-img"><img src="{{media url="wysiwyg/slider_image.png"}}" alt="" />
                        <div class="holder-text">
                            <h1>Slide heading</h1>
                            <h3>Slide call to action text</h3>
                            <a class="action primary" href="#">Button</a></div>
                    </div>
                </div>
                <div class="item" data-hash="5">
                    <div class="wrap-img"><img src="{{media url="wysiwyg/slider_image.png"}}" alt="" />
                        <div class="holder-text">
                            <h1>Slide heading</h1>
                            <h3>Slide call to action text</h3>
                            <a class="action primary" href="#">Button</a></div>
                    </div>
                </div>
                <div class="item" data-hash="6">
                    <div class="wrap-img"><img src="{{media url="wysiwyg/slider_image.png"}}" alt="" />
                        <div class="holder-text">
                            <h1>Slide heading</h1>
                            <h3>Slide call to action text</h3>
                            <a class="action primary" href="#">Button</a></div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" xml="space">// <![CDATA[
            (function  () {
                require([
                    'jquery',
                    'owlcarousel'
                ], function ($) {
                    $(document).ready(function() {
                        $('.owl-carousel').owlCarousel({
                            items: 1,
                            loop: false,
                            center: true,
                            margin: 0,
                            callbacks: true,
                            URLhashListener: true,
                            checkVisible: false,
                            animateOut: 'fadeOut',
                            animateIn: 'fadeIn'
                        });
                    })
                });
            })();
            // ]]></script>
        </div>
    </div>
</section>

<section class="homepage-our-bargains">
    <strong class="title">View our bargains</strong>
    <ul>
        <li>
            <a href="#">
                <div>Laundry</div>
                <div class="wrap-img">
                    <img src="{{media url="wysiwyg/laundry.png"}}" alt="" />
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <div>Dishwashers</div>
                <div class="wrap-img">
                    <img src="{{media url="wysiwyg/dishwashers.png"}}" alt="" />
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <div>Cooking</div>
                <div class="wrap-img">
                    <img src="{{media url="wysiwyg/cooking.png"}}" alt="" />
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <div>Refridgeration</div>
                <div class="wrap-img">
                    <img src="{{media url="wysiwyg/refridgeration.png"}}" alt="" />
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <div>Built-in</div>
                <div class="wrap-img">
                    <img src="{{media url="wysiwyg/built-in.png"}}" alt="" />
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <div>Small Appliances</div>
                <div class="wrap-img">
                    <img src="{{media url="wysiwyg/small-appliances.png"}}" alt="" />
                </div>
            </a>
        </li>
    </ul>
</section>
EOD;

        $pages = [
            'home' => ['title' => '', 'content' => $home]
        ];

        foreach ($pages as $key => $page) {
            $this->checkAndCreatePage($key, $page);
        }
    }

    /**
     * Product Links - CMS Block
     * Recently viewed products - Widget
     */
    public function createProductLinkBlockRecentlyWidget()
    {
        $content = <<<EOD
<a href="#">This item is graded and may have cosmetic marks. Please see all pictures before purchasing. 
For further information please call us on 0116 2710320 or 07982 134105.</a>
EOD;
        $themeSettingHead = <<<EOT
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c910d0328c024a8" async="async">
</script>
EOT;

        $this->checkAndCreateBlock('product-links', ['title' => 'Product Links', 'content' => $content]);
        $this->writerInterface->save('design/head/includes', $themeSettingHead, ScopeInterface::SCOPE_STORES, 1);

        $widgetParams = [
            'uiComponent'       => 'widget_recently_viewed',
            'page_size'         => '5',
            'show_attributes'   => ['name','image','price','learn_more'],
            'show_buttons'      => ['add_to_cart','add_to_wishlist']
        ];

        $recentlyViewWidget = [
            'instance_type' => RecentlyViewed::class,
            'title' => 'Recently viewed products',
            'store_ids' => '0',
            'widget_parameters' => json_encode($widgetParams),
            'sort_order' => 0,
            'page_groups' => [[
                'page_group' => 'all_products',
                'all_products' => [
                    'page_id' => null,
                    'layout_handle' => 'catalog_product_view',
                    'block' => 'content',
                    'for' => 'all',
                    'template' => 'product/widget/viewed/grid.phtml'
                ]
            ]]
        ];

        $this->createWidget($recentlyViewWidget);
    }

    /**
     * Contact us info - Block
     * Contact Page Map - Block
     */
    public function createContactPageBlockAndWidgets()
    {
        $contactUsInfo = <<<EOT
<div class="wrap-list">
<strong class="title">Help and support links</strong>
<ul>
<li class="delivery"><a href="#">Delivery Information</a></li>
<li class="returns"><a href="#">Returns</a></li>
<li class="terms"><a href="#">Terms & Conditions</a></li>
</ul>
</div>
<div class="wrap-list">
<strong class="title">Get In touch</strong>
<ul>
<li class="fax"><a href="tel:0116 271 0320">0116 271 0320</a></li>
<li class="tel"><a href="tel:0798 213 4105">0798 213 4105</a></li>
<li class="email"><a href="mailto:sales@bargainbuyz.co.uk">sales@bargainbuyz.co.uk</a></li>
</ul>
</div>
EOT;
        $contactPageMap = <<<EOT
<div class="wrap-map-block">
<div class="wrap-list">
<strong class="title">Visit our showroom</strong>
<ul>
<li class="address">47 London Road Oadby Leicester LE2 5DN</li>
</ul>
</div>
<div class="map-block"><img src="media url="wysiwyg/map-contact-page.png"" alt="" /></div>
<ul class="text">
<li>Ikstar Limited T/a Bargain Buyz. Company Number: 9820690.</li>
<li>Regisitered Office Address: 47 London Road, Oadby, Leicester LE2 5DN.</li>
</ul>
</div>
EOT;

        $blocks = [
            'contact-us-info' => ['title' => 'Contact us info', 'content' => $contactUsInfo],
            'contact-page-map' => ['title' => 'Contact Page Map', 'content' => $contactPageMap]
        ];

        foreach ($blocks as $key => $block) {
            $this->checkAndCreateBlock($key, $block);
        }

        $pageGroups = [[
            'page_group' => 'pages',
            'pages' => [
                'page_id' => null,
                'layout_handle' => 'contact_index_index',
                'block' => 'content',
                'for' => 'all',
                'template' => 'widget/static_block/default.phtml'
            ]
        ]];

        $instanceTypeCms = CMSBlock::class;
        $storesIds = '0';
        $widgets = [
            'contactUsInfo' => [
                'instance_type' => $instanceTypeCms,
                'title' => 'Contact Us Info',
                'store_ids' => $storesIds,
                'widget_parameters' => json_encode(['block_id'=>'14']),
                'sort_order' => 0,
                'page_groups' => $pageGroups
            ],
            'contactUsInfoMap' => [
                'instance_type' => $instanceTypeCms,
                'title' => 'Contact Page Map',
                'store_ids' => $storesIds,
                'widget_parameters' => json_encode(['block_id'=>'15']),
                'sort_order' => 1,
                'page_groups' => $pageGroups
            ]
        ];

        foreach ($widgets as $widget) {
            $this->createWidget($widget);
        }
    }

    /**
     * Repair
     */
    private function repairContactPageMapBlock()
    {
        $content = <<<EOT
<div class="wrap-map-block">
<div class="wrap-list">
<strong class="title">Visit our showroom</strong>
<ul>
<li class="address">47 London Road Oadby Leicester LE2 5DN</li>
</ul>
</div>
<div class="map-block"><img src="{{media url="wysiwyg/map-contact-page.png"}}" alt="" /></div>
<ul class="text">
<li>Ikstar Limited T/a Bargain Buyz. Company Number: 9820690.</li>
<li>Regisitered Office Address: 47 London Road, Oadby, Leicester LE2 5DN.</li>
</ul>
</div>
EOT;
        $this->checkAndCreateBlock('contact-page-map', ['content' => $content]);
    }

    /**
     * Update Homepage
     * Update Copyright
     */
    private function updateHomepageAndCopy()
    {
        $home = <<<EOT
<section class="homepage-slider">
    <div class="homepage-holder-slider">
        <div class="holder-nav">
            <ul class="owl-carousel-navigation">
<li><a class="button url" href="#1"> <strong>Tab Heading</strong> <span>Tab content / call to action</span> </a></li>
<li><a class="button url" href="#2"> <strong>Tab Heading</strong> <span>Tab content / call to action</span> </a></li>
<li><a class="button url" href="#3"> <strong>Tab Heading</strong> <span>Tab content / call to action</span> </a></li>
<li><a class="button url" href="#4"> <strong>Tab Heading</strong> <span>Tab content / call to action</span> </a></li>
<li><a class="button url" href="#5"> <strong>Tab Heading</strong> <span>Tab content / call to action</span> </a></li>
<li><a class="button url" href="#6"> <strong>Tab Heading</strong> <span>Tab content / call to action</span> </a></li>
            </ul>
        </div>
        <div class="holder-slider">
            <div class="owl-carousel owl-theme">
                <div class="item" data-hash="1">
                    <div class="wrap-img"><img src="{{media url="wysiwyg/slider_image.png"}}" alt="" />
                        <div class="holder-text">
                            <h1>Slide heading</h1>
                            <h3>Slide call to action text</h3>
                            <a class="action primary" href="#">Button</a></div>
                    </div>
                </div>
                <div class="item" data-hash="2">
                    <div class="wrap-img"><img src="{{media url="wysiwyg/slider_image.png"}}" alt="" />
                        <div class="holder-text">
                            <h1>Slide heading</h1>
                            <h3>Slide call to action text</h3>
                            <a class="action primary" href="#">Button</a></div>
                    </div>
                </div>
                <div class="item" data-hash="3">
                    <div class="wrap-img"><img src="{{media url="wysiwyg/slider_image.png"}}" alt="" />
                        <div class="holder-text">
                            <h1>Slide heading</h1>
                            <h3>Slide call to action text</h3>
                            <a class="action primary" href="#">Button</a></div>
                    </div>
                </div>
                <div class="item" data-hash="4">
                    <div class="wrap-img"><img src="{{media url="wysiwyg/slider_image.png"}}" alt="" />
                        <div class="holder-text">
                            <h1>Slide heading</h1>
                            <h3>Slide call to action text</h3>
                            <a class="action primary" href="#">Button</a></div>
                    </div>
                </div>
                <div class="item" data-hash="5">
                    <div class="wrap-img"><img src="{{media url="wysiwyg/slider_image.png"}}" alt="" />
                        <div class="holder-text">
                            <h1>Slide heading</h1>
                            <h3>Slide call to action text</h3>
                            <a class="action primary" href="#">Button</a></div>
                    </div>
                </div>
                <div class="item" data-hash="6">
                    <div class="wrap-img"><img src="{{media url="wysiwyg/slider_image.png"}}" alt="" />
                        <div class="holder-text">
                            <h1>Slide heading</h1>
                            <h3>Slide call to action text</h3>
                            <a class="action primary" href="#">Button</a></div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
            (function  () {
                require([
                    'jquery',
                    'owlcarousel'
                ], function ($) {
                    $(document).ready(function() {
                        $('.owl-carousel').owlCarousel({
                            items: 1,
                            loop: true,
                            center: true,
                            margin: 0,
                            autoplay:true,
                            autoplayTimeout:7000,
                            autoplayHoverPause:true,
                            callbacks: true,
                            dotsContainer:".owl-carousel-navigation",
                            URLhashListener: true,
                            checkVisible: false,
                            animateOut: 'fadeOut',
                            animateIn: 'fadeIn'
                        });
                    })
                });
            })();
            </script>
        </div>
    </div>
</section>

<section class="homepage-our-bargains">
    <strong class="title">View our bargains</strong>
    <ul>
        <li>
            <a href="#">
                <div>Laundry</div>
                <div class="wrap-img">
                    <img src="{{media url="wysiwyg/laundry.png"}}" alt="" />
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <div>Dishwashers</div>
                <div class="wrap-img">
                    <img src="{{media url="wysiwyg/dishwashers.png"}}" alt="" />
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <div>Cooking</div>
                <div class="wrap-img">
                    <img src="{{media url="wysiwyg/cooking.png"}}" alt="" />
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <div>Refridgeration</div>
                <div class="wrap-img">
                    <img src="{{media url="wysiwyg/refridgeration.png"}}" alt="" />
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <div>Built-in</div>
                <div class="wrap-img">
                    <img src="{{media url="wysiwyg/built-in.png"}}" alt="" />
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <div>Small Appliances</div>
                <div class="wrap-img">
                    <img src="{{media url="wysiwyg/small-appliances.png"}}" alt="" />
                </div>
            </a>
        </li>
    </ul>
</section>
EOT;
        $copy = '© 2019 Ikstar Limited t/a Bargain Buyz';

        $this->checkAndCreatePage('home', ['title' => '', 'content' => $home]);
        $this->writerInterface->save('design/footer/copyright', $copy, ScopeInterface::SCOPE_STORES, 1);
    }

    /**
     * @param string $identifier
     * @param array $data
     */
    private function checkAndCreateBlock($identifier, array $data)
    {
        try {
            $block = $this->blockRepository->getById($identifier);
            if ($block->getId()) {
                $block->setContent($data['content'])->save();
            }
        } catch (NoSuchEntityException $e) {
            $cmsBlock = $this->blockInterfaceFactory->create();
            $cmsBlock->setIdentifier($identifier);
            $cmsBlock->setTitle($data['title']);
            $cmsBlock->setContent($data['content']);
            $cmsBlock->setData('stores', [Store::DEFAULT_STORE_ID]);
            $this->blockRepository->save($cmsBlock);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param array $params
     */
    private function createWidget(array $params)
    {
        $themeId = $this->scopeConfig->getValue(
            'design/theme/theme_id',
            ScopeInterface::SCOPE_WEBSITES
        );

        if (is_numeric($themeId)) {
            $params['theme_id'] = $themeId;
            try {
                $this->appState->emulateAreaCode(
                    FrontNameResolver::AREA_CODE,
                    function () use ($params) {
                        $this->widgetFactory->create()->setData($params)->save();
                    }
                );
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    /**
     * @param string $identifier
     * @param array $data
     */
    private function checkAndCreatePage($identifier, array $data)
    {
        try {
            $page = $this->pageRepository->getById($identifier);
            if ($page->getId()) {
                $page->setContent($data['content'])->save();
            }
        } catch (NoSuchEntityException $e) {
            $cmsPage = $this->blockInterfaceFactory->create();
            $cmsPage->setIdentifier($identifier);
            $cmsPage->setTitle($data['title']);
            $cmsPage->setContentHeading($data['title']);
            $cmsPage->setContent($data['content']);
            $cmsPage->setData('stores', [Store::DEFAULT_STORE_ID]);
            $this->pageRepository->save($cmsPage);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
