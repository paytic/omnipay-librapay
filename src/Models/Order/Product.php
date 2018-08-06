<?php

namespace ByTIC\Omnipay\Librapay\Models\Order;

use ByTIC\Omnipay\Librapay\Models\AbstractModel;
use ByTIC\Omnipay\Librapay\Models\Traits\ToArrayTrait;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Item;

/**
 * Class Product
 * @package ByTIC\Omnipay\Librapay\Models
 */
class Product extends AbstractModel
{
    use ToArrayTrait;

    protected $itemName;
    protected $itemDesc;
    protected $categ;
    protected $subcateg;
    protected $quantity;
    protected $price;
    protected $productId;

    /**
     * @param Item $item
     * @return Product
     * @throws InvalidRequestException
     */
    public static function fromItemBag(Item $item)
    {
        $product = new self();
        $product->itemName = $item->getName();
        $product->itemDesc = $item->getDescription();
        $product->quantity = $item->getQuantity();
        $product->price = $item->getPrice();

        $product->validateData();

        return $product;
    }

    protected function validateDataFields()
    {
        return ['itemName', 'quantity', 'price'];
    }

}
