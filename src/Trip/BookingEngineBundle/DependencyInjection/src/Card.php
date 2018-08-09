<?php

namespace Trip\BookingEngineBundle\DependencyInjection\src;
use Trip\BookingEngineBundle\DependencyInjection\src\Entity;

class Card extends Entity
{
    /**
     * @param $id Card id
     */
    public function fetch($id)
    {
        return parent::fetch($id);
    }
}
