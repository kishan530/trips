<?php

namespace Trip\BookingEngineBundle\DependencyInjection\src;
use Trip\BookingEngineBundle\DependencyInjection\src\Entity;

class Plan extends Entity
{
    public function create($attributes = array())
    {
        return parent::create($attributes);
    }

    public function fetch($id)
    {
        return parent::fetch($id);
    }

    public function all($options = array())
    {
        return parent::all($options);
    }
}