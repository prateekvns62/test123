<?php

/**
 * Copyright © 2019 Wyomind. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Wyomind\PickupAtStore\Model;

/**
 * WebAPI implementation
 */
class PickupAtStore implements \Wyomind\PickupAtStore\Api\PickupAtStoreInterface
{

    /**
     * @var \Magento\Sales\Model\OrderRepository
     */
    public $orderRepository = null;

    /**
     * @param \Magento\Sales\Model\OrderRepository $orderRepository
     */
    public function __construct(
    \Magento\Sales\Model\OrderRepository $orderRepository
    )
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @see \Wyomind\PickupAtStore\Api\PickupAtStoreInterface::getSalesOrderData
     */
    public function getSalesOrderData($orderId)
    {
        try {
            $order = $this->orderRepository->get($orderId);
            $orderData = $order->getData();
            foreach ($orderData as $key => $value) {
                if (is_array($value) || is_object($value)) {
                    unset($orderData[$key]);
                }
            }
            return json_encode(["error" => false, "pickup_store" => $orderData['pickup_store'], "order" => $orderData]);
        } catch (\Exception $e) {
            return json_encode(["error" => true, "message" => $e->getMessage()]);
        }
    }

}
