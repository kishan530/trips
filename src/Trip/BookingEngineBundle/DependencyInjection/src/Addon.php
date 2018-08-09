<?php

namespace Trip\BookingEngineBundle\DependencyInjection\src;
use Trip\BookingEngineBundle\DependencyInjection\src\Entity;
class Addon extends Entity
{
    // To create an Addon,
    // use the createAddon method of the Subscription class

    public function fetch($id)
    {
        return parent::fetch($id);
    }

    public function delete()
    {
        $entityUrl = $this->getEntityUrl();

        return $this->request('DELETE', $entityUrl . $this->id);
    }
}
