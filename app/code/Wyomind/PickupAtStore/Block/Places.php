<?php

/**
 * Copyright © 2019 Wyomind. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Wyomind\PickupAtStore\Block;

/**
 * Places block
 * This block allows the customer to select a store in a dropdown/map/list
 */
class Places extends \Magento\Framework\View\Element\Template
{

    const TEMPLATE = 'Wyomind_PickupAtStore::places.phtml';

    protected $_configHelper = null;
    protected $_posCollectionFactory = null;
    protected $_posModelFactory = null;
    public $_posHelper = null;
    protected $_pasHelper = null;
    protected $_storeManager = null;
    protected $_coreHelper = null;
    protected $_cookieManager = null;

    /**
     * Constructor
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Wyomind\PickupAtStore\Helper\Config $configHelper
     * @param \Wyomind\PointOfSale\Model\PointOfSaleFactory $posModelFactory
     * @param \Wyomind\PointOfSale\Helper\Data $posHelper
     * @param \Wyomind\PickupAtStore\Helper\Data $pasHelper
     * @param \Wyomind\Core\Helper\Data $coreHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Wyomind\PickupAtStore\Helper\Config $configHelper,
        \Wyomind\PointOfSale\Model\PointOfSaleFactory $posModelFactory,
        \Wyomind\PointOfSale\Helper\Data $posHelper,
        \Wyomind\PickupAtStore\Helper\Data $pasHelper,
        \Wyomind\Core\Helper\Data $coreHelper,
        \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
        array $data = []
    )
    {

        parent::__construct($context, $data);
        $this->setTemplate(self::TEMPLATE);
        $this->_configHelper = $configHelper;
        $this->_posModelFactory = $posModelFactory;
        $this->_posHelper = $posHelper;
        $this->_pasHelper = $pasHelper;
        $this->_storeManager = $context->getStoreManager();
        $this->_coreHelper = $coreHelper;
        $this->_cookieManager = $cookieManager;
    }

    /**
     * Should the customer select the store in a dropdown ?
     * @param type $storeId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function useDropdown($storeId = null)
    {
        return $this->_configHelper->getDropdown($storeId);
    }

    /**
     * Get the title of the block on the frontend
     * @param type $storeId
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getTitle($storeId = null)
    {
        return $this->_configHelper->getPickupatstoreTitle($storeId);
    }

    /**
     * Should we display the description of the stores in the list (only in list mode)
     * @param type $storeId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getDisplayDescription($storeId = null)
    {
        return $this->_configHelper->getDisplayDescription($storeId);
    }

    public function getDisplayListAndGMapClass($storeId = null)
    {
        $class = $this->_configHelper->getDisplayList($storeId)?"_list":"";
        $class .= $this->_configHelper->getDisplayGmap($storeId)?"_gmap":"";
        if ($class == "") {
            $class = "_none";
        }
        return $class;
    }

    /**
     * @param null $storeId
     * @return \Wyomind\Core\Helper\type
     */
    public function getNbStoresToDisplay($storeId = null)
    {
        return $this->_configHelper->getNbStoresToDisplay($storeId);
    }

    /**
     * Get the places available for pickup (filtered by Advanced Inventory if needed)
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getPlaces()
    {
        $storeId = $this->_storeManager->getStore()->getId();

        $places = $this->_posModelFactory->create()->getPlacesByStoreId($storeId, true);

        if ($this->_coreHelper->moduleIsEnabled("Wyomind_AdvancedInventory")) {
            $places = $this->_pasHelper->getPickupPlaces($places);
        }

        $preferredStore = $this->_cookieManager->getCookie('preferred_store');
        if (!empty($preferredStore)) {
            $preferredStore = json_decode($preferredStore);
            $preferredStoreId = $preferredStore->id;
        } else {
            $preferredStoreId = -1;
        }

        $storesDistance = $this->_cookieManager->getCookie('pos-places');
        if (!empty($storesDistance)) {
            $storesDistance = json_decode($storesDistance);
        } else {
            $storesDistance = [];
        }

        if (!empty($storesDistance)) {
            $newPlaces = [];
            $counter = 0;
            foreach ($storesDistance as $distance) {
                foreach ($places as $place) {
                    if ($place->getId() == $distance->id) {
                        if (isset($distance->distance)) {
                            $place->setData('distance.text', $distance->distance->text);
                        }
                        if ($counter < $this->getNbStoresToDisplay() || $place->getId() == $preferredStoreId) {
                            $place->setData('displayed', true);
                        }

                        if ($place->getId() == $preferredStoreId) {
                            $place->setData('preferred.store', true);
                            array_unshift($newPlaces, $place);
                        } else {
                            $newPlaces[] = $place;
                        }
                        $counter++;
                    }
                }
            }
            return $newPlaces;
        }


        return $places;
    }

}
