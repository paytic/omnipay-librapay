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

    public $Name;
    public $ID;
    public $IDNumber;
    public $IssuedBy;
    public $Email;
    public $Phone;
    public $Address;
    public $City;
    public $PostalCode;
    public $District;
    public $Country;

    public static function fromCard(CreditCard $card)
    {
        $return          = new static();
        $return->Name    = $return->getValueFromCard($card, 'name');
//        $return->Email   = $return->getValueFromCard($card, 'email');
        $return->Phone   = $return->getValueFromCard($card, 'phone');
        $return->City    = $return->getValueFromCard($card, 'city');
        $return->Country = $return->getValueFromCard($card, 'country');

        $return->Address = $return->getValueFromCard($card, 'Address1')
                           . ' '
                           . $return->getValueFromCard($card, 'Address2');

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
        return $card->{'get' . static::TYPE . ucfirst($type)}();
    }
}
