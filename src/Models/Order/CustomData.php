<?php

namespace ByTIC\Omnipay\Librapay\Models\Order;

use ByTIC\Omnipay\Librapay\Message\PurchaseRequest;

/**
 * Class CustomData
 * @package ByTIC\Omnipay\Librapay\Models\Order
 */
class CustomData
{
    /**
     * @var ProductsBag
     */
    protected $products;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var BillingInfo
     */
    protected $billing;

    /**
     * @var ShippingInfo
     */
    protected $shipping;

    protected function __construct()
    {
        $this->products = new ProductsBag();
        $this->user = new User();
        $this->billing = new BillingInfo();
        $this->shipping = new ShippingInfo();
    }

    /**
     * @param $params
     * @return CustomData
     */
    public static function fromParams( $params)
    {
        $data = new static();
        return $data;
    }

    /**
     * @param PurchaseRequest $request
     * @return CustomData
     */
    public static function fromRequest(PurchaseRequest $request)
    {
        $data = new static();
        $data->setProducts(ProductsBag::fromItemBag($request->getItems()));
        $data->setUser(User::fromCard($request->getCard()));
        $data->setBilling(BillingInfo::fromCard($request->getCard()));
        $data->setShipping(ShippingInfo::fromCard($request->getCard()));

        return $data;
    }

    /**
     * @return ProductsBag
     */
    public function getProducts(): ProductsBag
    {
        return $this->products;
    }

    /**
     * @param ProductsBag $products
     */
    public function setProducts(ProductsBag $products)
    {
        $this->products = $products;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return BillingInfo
     */
    public function getBilling(): BillingInfo
    {
        return $this->billing;
    }

    /**
     * @param BillingInfo $billing
     */
    public function setBilling(BillingInfo $billing)
    {
        $this->billing = $billing;
    }

    /**
     * @return ShippingInfo
     */
    public function getShipping(): ShippingInfo
    {
        return $this->shipping;
    }

    /**
     * @param ShippingInfo $shipping
     */
    public function setShipping(ShippingInfo $shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'ProductsData' => $this->getProducts()->toArray(),
            'UserData' => array_merge(
                $this->getUser()->toArray(),
                $this->getBilling()->toArray(),
                $this->getShipping()->toArray()
            ),
        ];
    }


    /**
     * @param $property
     * @return string
     */
    public function toArrayName($property)
    {
        return ucfirst($property);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return base64_encode(serialize($this->toArray()));
    }
}