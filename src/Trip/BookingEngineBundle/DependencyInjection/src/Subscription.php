<?php

namespace Trip\BookingEngineBundle\DependencyInjection\src;
use Trip\BookingEngineBundle\DependencyInjection\src\Entity;

class Subscription extends Entity
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

    public function cancel()
    {
        $relativeUrl = $this->getEntityUrl() . $this->id . '/cancel';

        return $this->request('POST', $relativeUrl);
    }

    public function createAddon($attributes = array())
    {
        $relativeUrl = $this->getEntityUrl() . $this->id . '/addons';

        return $this->request('POST', $relativeUrl, $attributes);
    }
}