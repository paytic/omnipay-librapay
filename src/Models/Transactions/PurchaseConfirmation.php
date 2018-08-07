<?php

namespace ByTIC\Omnipay\Librapay\Models\Transactions;

use ByTIC\Omnipay\Librapay\Models\Traits\ToArrayTrait;

/**
 * Class PurchaseConfirmation
 * @package ByTIC\Omnipay\Librapay\Models\Transactions
 */
class PurchaseConfirmation extends Purchase
{
    use ToArrayTrait;

    /**
     * @var
     */
    protected $action;

    /**
     * @var
     */
    protected $amount;

    /**
     * @var
     */
    protected $rc;

    /**
     * @var
     */
    protected $message;

    /**
     * @var
     */
    protected $rrn;

    /**
     * @var
     */
    protected $int_ref;

    /**
     * @var
     */
    protected $approval;

    /**
     * @param \Symfony\Component\HttpFoundation\ParameterBag $request
     * @return void
     */
    public function populateFromHttpRequest($request)
    {
        $this->action = $request->get('ACTION');
        $this->rc = $request->get('RC');
        $this->message = $request->get('MESSAGE');
        $this->rrn = $request->get('RRN');
        $this->int_ref = $request->get('INT_REF');
        $this->approval = $request->get('APPROVAL');
        $this->timestamp = $request->get('TIMESTAMP');
        $this->nonce = $request->get('NONCE');
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $fields = static::getFieldsForString();
        $return = '';
        $txt = [
            'approval' => (trim($this->approval) == '') ? "-" : strlen($this->approval).$this->approval,
            'rrn' => (trim($this->rrn) == '') ? "-" : strlen($this->rrn).$this->rrn,
            'int_ref' => (trim($this->int_ref) == '') ? "-" : strlen($this->int_ref).$this->int_ref,
        ];
        foreach ($fields as $field) {
            $return .= in_array($field, ['rrn', 'int_ref', 'approval'])
                ? $txt[$field]
                : $this->generatePropertyString($field);
        }

        return $return;
    }

    /** @noinspection PhpMissingParentCallCommonInspection
     * @return array
     */
    protected static function getFieldsForString()
    {
        return [
            'terminal',
            'trtype',
            'order',
            'amount',
            'currency',
            'desc',
            'action',
            'rc',
            'message',
            'rrn',
            'int_ref',
            'approval',
            'timestamp',
            'nonce',
        ];
    }
}
