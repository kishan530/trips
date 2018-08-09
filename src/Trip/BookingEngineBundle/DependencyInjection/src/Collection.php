<?php

namespace Trip\BookingEngineBundle\DependencyInjection\src;
use Trip\BookingEngineBundle\DependencyInjection\src\Entity;

use Countable;

class Collection extends Entity implements Countable
{
    public function count()
    {
        $count = 0;

        if (isset($this->attributes['count']))
        {
            return $this->attributes['count'];
        }

        return $count;
    }
}
