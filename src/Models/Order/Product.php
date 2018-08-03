<?php

namespace ByTIC\Omnipay\Librapay\Models\Order;

use ByTIC\Omnipay\Librapay\Models\AbstractModel;
use Omnipay\Common\Item;

/**
 * Class Product
 * @package ByTIC\Omnipay\Librapay\Models
 */
class Product extends AbstractModel
{
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
     */
    public static function fromItemBag(Item $item)
    {
        $product = new self();
        $product->itemName = $item->getName();
        $product->itemDesc = $item->getDescription();
        $product->quantity = $item->getQuantity();
        $product->price = $item->getPrice();

        return $product;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $properties = get_object_vars($this);
        $return = [];
        foreach ($properties as $property) {
            $name = ucfirst($property);
            $return[$name] = $this->{$property};
        }
        return $return;
    }
}
