<?php

namespace ByTIC\Omnipay\Librapay\Models\Order;

use ByTIC\Omnipay\Librapay\Models\AbstractModel;
use Omnipay\Common\CreditCard;

/**
 * Class User
 * @package ByTIC\Omnipay\Librapay\Models\Order
 */
class User extends AbstractModel
{
    public $loginName;
    public $email;
    public $name;
    public $cnp;
    public $phone;

    /**
     * @param CreditCard $card
     * @return User
     */
    public static function fromCard(CreditCard $card)
    {
        $user = new static();
        $user->name = $card->getName();
        $user->email = $card->getEmail();
        $user->phone = $card->getPhone();
        return $user;
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