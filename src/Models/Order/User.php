<?php

namespace ByTIC\Omnipay\Librapay\Models\Order;

use ByTIC\Omnipay\Librapay\Models\AbstractModel;
use ByTIC\Omnipay\Librapay\Models\Traits\ToArrayTrait;
use Omnipay\Common\CreditCard;

/**
 * Class User
 * @package ByTIC\Omnipay\Librapay\Models\Order
 */
class User extends AbstractModel
{
    use ToArrayTrait;

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
     * @param $property
     * @return string
     */
    public function toArrayName($property)
    {
        return ucfirst($property);
    }
}