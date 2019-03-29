<?php
/**
 * Copyright © 2019 Wyomind. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Wyomind\PickupAtStore\Block\Adminhtml\Sales\Order\Create\Shipping\Method;

use Wyomind\PickupAtStore\Helper\Config as Config;

class Form extends \Magento\Sales\Block\Adminhtml\Order\Create\Shipping\Method\Form
{
    /**
     * @var array
     */
    protected $_config = [];

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_dateTime;

    /**
     * @var \Wyomind\Core\Helper\Data
     */
    protected $_coreHelper;

    /**
     * @var \Wyomind\PickupAtStore\Helper\Data
     */
    protected $_pasHelper;

    /**
     * @var \Wyomind\PointOfSale\Model\PointOfSaleFactory
     */
    private $_posModelFactory;

    /**
     * @var array
     */
    private $_places = [];

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Model\Session\Quote $sessionQuote
     * @param \Magento\Sales\Model\AdminOrder\Create $orderCreate
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     * @param \Magento\Tax\Helper\Data $taxData
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
     * @param \Wyomind\Core\Helper\Data $coreHelper
     * @param Config $configHelper
     * @param \Wyomind\PickupAtStore\Helper\Data $pasHelper
     * @param \Wyomind\PointOfSale\Model\PointOfSaleFactory $posModelFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Model\Session\Quote $sessionQuote,
        \Magento\Sales\Model\AdminOrder\Create $orderCreate,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \Magento\Tax\Helper\Data $taxData,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        \Wyomind\Core\Helper\Data $coreHelper,
        Config $configHelper,
        \Wyomind\PickupAtStore\Helper\Data $pasHelper,
        \Wyomind\PointOfSale\Model\PointOfSaleFactory $posModelFactory,
        array $data = []
    )
    {
        parent::__construct($context, $sessionQuote, $orderCreate, $priceCurrency, $taxData, $data);
        $this->_dateTime = $dateTime;
        $this->_coreHelper = $coreHelper;
        $this->_config = $configHelper->getAll($this->getStoreId());
        $this->_pasHelper = $pasHelper;
        $this->_posModelFactory = $posModelFactory;
    }

    /**
     * Get the dates/hours for all stores
     * @return array
     */
    public function getDateTimes()
    {
        $dateTimes = [];
        $collection = $this->getPickupPlaces();

        foreach ($collection as $pos) {
            $dateTimes[$pos->getPlaceId()] = $this->createDates($pos);
        }

        return $dateTimes;
    }

    /**
     * Get the stores available, depending of the module Advanced Inventory if needed
     * @return array
     */
    public function getPickupPlaces()
    {
        if ($this->_places == null) {
            $storeId = $this->getStoreId();
            $this->_places = $this->_posModelFactory->create()->getPlacesByStoreId($storeId, true);
            if ($this->_coreHelper->moduleIsEnabled('Wyomind_AdvancedInventory')) {
                $this->_places = $this->_pasHelper->getPickupPlaces($this->_places);
            }
        }
        return $this->_places;
    }

    /**
     * Create the list of dates/hours available for pick up for a store
     * @param \Wyomind\PointOfSale\Model\PointOfSale\Interceptor $pos
     * @return array
     */
    public function createDates($pos)
    {
        $maxDays = $this->_config[Config::SCHEDULE_AHEAD];
        $minimumDelay = (int) $this->_config[Config::MINIMAL_DELAY] * 60;

        $dateFormat = $this->_config[Config::DATE_FORMAT];
        $timeFormat = $this->_config[Config::TIME_FORMAT];

        $currentTime = $this->_dateTime->gmtTimestamp() + $this->_dateTime->getGmtOffset('seconds');
        $firstTime = $currentTime + $minimumDelay;

        if ($pos->getHours() == null) {
            return ['dates'=> [], 'hours' => []];
        }

        $availableDays = array_keys(json_decode($pos->getHours(), true));
        $availableHours = json_decode($pos->getHours(), true);

        $dates = [];
        $hours = [];
        $value = $this->_dateTime->date('Y-m-d', $firstTime);
        $minimumDay = $this->_dateTime->date('l', $firstTime);

        if (in_array($minimumDay, $availableDays)) {
            if ($value <= $this->_dateTime->date('Y-m-d', $currentTime)) {
                $dates[$value] = __('Today') . ' - ' . $this->_dateTime->date($dateFormat, $firstTime);
                $checkHour = true;
            } else {
                $dates[$value] = __($minimumDay) . ' - ' . $this->_dateTime->date($dateFormat, $firstTime);
                $checkHour = false;
            }

            $start = explode(':', $availableHours[$minimumDay]['from']);
            $end = explode(':', $availableHours[$minimumDay]['to']);
            $ls = 0;
            $le = 0;
            if (isset($availableHours[$minimumDay]['lunch_from']) && isset($availableHours[$minimumDay]['lunch_to'])) {
                $lstart = explode(':', $availableHours[$minimumDay]['lunch_from']);
                $lend = explode(':', $availableHours[$minimumDay]['lunch_to']);
                $ls = $lstart[0] * 60 * 60 + $lstart[1] * 60;
                $le = $lend[0] * 60 * 60 + $lend[1] * 60;
            }
            $s = $start[0] * 60 * 60 + $start[1] * 60;
            $e = $end[0] * 60 * 60 + $end[1] * 60;
            while ($s < $e) {
                if (!$checkHour || ($checkHour && date('H:i', $s) >= date('H:i', $firstTime))) {
                    if ($ls == 0 || ($s < $ls || $le <= $s)) {
                        $hours[$value][date('H:i', $s)] = [date($timeFormat, $s)];
                    }
                }
                $s += $this->_config[Config::TIME_RANGE] * 60;
            }
            if (empty($hours[$value])) {
                unset($dates[$value]);
            }
        }

        $j = 1;
        while ($j < $maxDays) {
            $value = $firstTime + $j * 86400;
            $day = $this->_dateTime->date('l', $value);
            if (in_array($day, $availableDays)) {
                $indice = $this->_dateTime->date('Y-m-d', $value);
                $dates[$indice] = __($this->_dateTime->date('l', $value)) . " - " . $this->_dateTime->date($dateFormat, $value);

                $start = explode(':', $availableHours[$day]['from']);
                $end = explode(':', $availableHours[$day]['to']);
                $ls = 0;
                $le = 0;
                if (isset($availableHours[$day]['lunch_from']) && isset($availableHours[$day]['lunch_to'])) {
                    $lstart = explode(':', $availableHours[$day]['lunch_from']);
                    $lend = explode(':', $availableHours[$day]['lunch_to']);
                    $ls = $lstart[0] * 60 * 60 + $lstart[1] * 60;
                    $le = $lend[0] * 60 * 60 + $lend[1] * 60;
                }
                $s = $start[0] * 60 * 60 + $start[1] * 60;
                $e = $end[0] * 60 * 60 + $end[1] * 60;
                while ($s < $e) {
                    if ($ls == 0 || ($s < $ls || $le <= $s)) {
                        $hours[$indice][date('H:i', $s)] = [date($timeFormat, $s)];
                    }
                    $s += $this->_config[Config::TIME_RANGE] * 60;
                }
                if (empty($hours[$indice])) {
                    unset($dates[$indice]);
                }
            }

            $j++;
        }

        // Days / hours off
        $storeDaysOff = array_map('trim', explode("\n", $pos->getDaysOff()));

        foreach ($storeDaysOff as $dayOff) {
            $hoursOff = substr($dayOff, 11);
            $dayOff = substr($dayOff, 0, 10);

            if (false !== $hoursOff) {
                $hoursRangeToExclude = explode('-', $hoursOff);
                foreach ($hours[$dayOff] as $hourToTest => $hourOutput) {
                    if (($hourToTest >= $hoursRangeToExclude[0] && $hourToTest < $hoursRangeToExclude[1])) {
                        unset($hours[$dayOff][$hourToTest]);
                    }
                }
            } else {
                unset($dates[$dayOff]);
                unset($hours[$dayOff]);
            }
        }

        return ['dates' => $dates, 'hours' => $hours];
    }

    /**
     * Get config parameter
     *
     * @param string $parameter
     * @return type
     */
    public function getConfig($parameter)
    {
        return $this->_config[$parameter];
    }

    /**
     * Get the url to update the shipping method
     * @return string
     */
    public function getUpdateShippingMethodUrl()
    {
        return $this->getUrl('pickupatstore/update/shippingmethod');
    }
}