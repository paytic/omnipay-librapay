<?php

namespace Paytic\Omnipay\Librapay\Models\Order;

use Paytic\Omnipay\Librapay\Models\AbstractModel;
use Paytic\Omnipay\Librapay\Models\Traits\ToArrayTrait;
use Omnipay\Common\CreditCard;

/**
 * Class User
 * @package Paytic\Omnipay\Librapay\Models\Order
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