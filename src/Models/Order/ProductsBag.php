<?php

namespace ByTIC\Omnipay\Librapay\Models\Order;

use Omnipay\Common\ItemBag;

/**
 * Class Product
 * @package ByTIC\Omnipay\Librapay\Models
 */
class ProductsBag
{

    /**
     * Item storage
     * @var Product[]
     */
    protected $items;

    /**
     * @param ItemBag $bag
     * @return ProductsBag|ItemBag
     */
    public static function fromItemBag(ItemBag $bag)
    {
        $return = new static();

        foreach ($bag as $item) {
            $return->items[] = Product::fromItemBag($item);
        }

        return $return;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $return = [];
        foreach ($this->items as $item) {
            $return[] = $item->toArray();
        }

        return $return;
    }
}
