<?php

namespace Wyomind\PickupAtStore\Plugin\Checkout\Model;


class TotalsInformationManagement
{


    /**
     * @var \Magento\Quote\Api\cartRepositoryInterface|null
     */
    protected $cartRepository = null;
    /**
     * @var null|\Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\CollectionFactory
     */
    protected $posCollectionFactory = null;

    /**
     * @var \Magento\Directory\Model\Region|null
     */
    protected $regionModel = null;

    /**
     * PaymentInformationManagement constructor.
     * @param \Magento\Quote\Api\cartRepositoryInterface $cartRepository
     * @param \Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\CollectionFactory $posCollectionFactory
     * @param \Magento\Directory\Model\Region $regionModel
     */
    public function __construct(
        \Magento\Quote\Api\CartRepositoryInterface $cartRepository,
        \Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\CollectionFactory $posCollectionFactory,
        \Magento\Directory\Model\Region $regionModel
    )
    {
        $this->cartRepository = $cartRepository;
        $this->posCollectionFactory = $posCollectionFactory;
        $this->regionModel = $regionModel;
    }


    public function aroundCalculate(
        $subject, $proceed,
        $cartId,
        \Magento\Checkout\Api\Data\TotalsInformationInterface $addressInformation
    )
    {

        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $this->cartRepository->get($cartId);

        $carrierCode = $quote->getShippingAddress()->getShippingMethod();
        if (stripos($carrierCode, "pickupatstore") !== false) {
            $storeId = str_replace("pickupatstore_pickupatstore_", "", $carrierCode);
            $store = $this->posCollectionFactory->create()->getPlace($storeId)->getFirstItem();

            $region = $this->regionModel->loadByCode($store->getState(), $store->getCountryCode());
            $shippingData = [
                "prefix" => "",
                "firstname" => "Store Pickup",
                "middlename" => "",
                "lastname" => $store->getName(),
                "suffix" => "",
                "company" => "",
                "street" => $store->getAddressLine1() . ($store->getAddressLine2() ? "\n" . $store->getAddressLine2() : ''),
                "city" => $store->getCity(),
                "region" => $region->getDefaultName(),
                "region_id" => $region->getRegionId(),
                "postcode" => $store->getPostalCode(),
                "country_id" => $store->getCountryCode(),
                "telephone" => $store->getMainPhone() ?: "0000000000",
                "fax" => "",
                "email" => $store->getEmail() ?: "no@contact.com",
                "save_in_address_book" => false
            ];

            $addressInformation->getAddress()->addData($shippingData);
        }
        return $proceed($cartId, $addressInformation);
    }
}