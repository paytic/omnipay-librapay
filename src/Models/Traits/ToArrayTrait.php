<?php

namespace ByTIC\Omnipay\Librapay\Models\Traits;

trait ToArrayTrait
{
    /**
     * @return array
     */
    public function toArray()
    {
        $properties = $this->toArrayProperties();
        $return = [];
        foreach ($properties as $property) {
            $name = $this->toArrayName($property);
            $return[$name] = $this->toArrayValue($property);
        }
        return $return;
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
     * @param $property
     * @return mixed
     */
    public function toArrayValue($property)
    {
        return $this->{$property};
    }

    public function toArrayProperties()
    {
        $properties = get_object_vars($this);
        return array_keys($properties);
    }
}