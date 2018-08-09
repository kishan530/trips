<?php

namespace Trip\BookingEngineBundle\DependencyInjection\src;

interface ArrayableInterface
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray();
}