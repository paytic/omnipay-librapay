<?php

namespace ByTIC\Omnipay\Librapay\Models\Order;

use Omnipay\Common\CreditCard;

/**
 * Class AbstractInfo
 * @package ByTIC\Omnipay\Librapay\Models\Order
 */
abstract class AbstractInfo
{
    const TYPE = 'Billing';

    public $name;
    public $ID;
    public $IDNumber;
    public $issuedBy;
    public $email;
    public $phone;
    public $address;
    public $city;
    public $postalCode;
    public $district;
    public $country;

    /**
     * @param CreditCard $card
     * @return static
     */
    public static function fromCard(CreditCard $card)
    {
        $return = new static();
        $return->name = $return->getValueFromCard($card, 'name');
//        $return->Email   = $return->getValueFromCard($card, 'email');
        $return->phone = $return->getValueFromCard($card, 'phone');
        $return->city = $return->getValueFromCard($card, 'city');
        $return->country = $return->getValueFromCard($card, 'country');

        $return->address = $return->getValueFromCard($card, 'Address1')
            .' '
            .$return->getValueFromCard($card, 'Address2');

        return $return;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $properties = get_object_vars($this);
        $return = [];
        foreach ($properties as $property) {
            $name = static::TYPE.ucfirst($property);
            $return[$name] = $this->{$property};
        }

        return $return;
    }

    /**
     * @param CreditCard $card
     * @param $type
     *
     * @return
     */
    protected function getValueFromCard(CreditCard $card, $type)
    {
        return $card->{'get'.static::TYPE.ucfirst($type)}();
    }
}
