<?php

namespace Trip\BookingEngineBundle\DependencyInjection\src;
use Trip\BookingEngineBundle\DependencyInjection\src\Entity;

class VirtualAccount extends Entity
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

    public function close()
    {
        $relativeUrl = $this->getEntityUrl() . $this->id;

        $data = [
            'status' => 'closed'
        ];

        return $this->request('PATCH', $relativeUrl, $data);
    }

    public function payments()
    {
        $relativeUrl = $this->getEntityUrl() . $this->id . '/payments';

        return $this->request('GET', $relativeUrl);
    }
}