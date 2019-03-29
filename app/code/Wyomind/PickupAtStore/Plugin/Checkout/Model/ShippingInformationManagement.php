<?php

namespace Wyomind\PickupAtStore\Plugin\Checkout\Model;

class ShippingInformationManagement
{

    /**
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    public $quoteRepository = null;

    /**
     * @var null|\Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\CollectionFactory
     */
    protected $posCollectionFactory = null;

    /**
     * @var \Magento\Directory\Model\Region|null
     */
    protected $regionModel = null;

    /**
     * ShippingInformationManagement constructor.
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
     */
    public function __construct(
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        \Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\CollectionFactory $posCollectionFactory,
        \Magento\Directory\Model\Region $regionModel
    )
    {
        $this->quoteRepository = $quoteRepository;
        $this->posCollectionFactory = $posCollectionFactory;
        $this->regionModel = $regionModel;
    }

    /**
     * @param $subject
     * @param $proceed
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function aroundSaveAddressInformation(
        $subject,
        $proceed,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    )
    {
        $carrierCode = $addressInformation->getShippingCarrierCode();
        $methodCode = $addressInformation->getShippingMethodCode();
        $address = $addressInformation->getShippingAddress();

        if (stripos($carrierCode, "pickupatstore") !== false) {
            $storeId = str_replace("pickupatstore_", "", $methodCode);
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

            $address->addData($shippingData);
            $addressInformation->setAddress($address);
        }

        return $proceed($cartId, $addressInformation);
    }
}