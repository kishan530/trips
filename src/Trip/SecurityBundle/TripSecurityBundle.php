<?php

namespace Trip\SecurityBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TripSecurityBundle extends Bundle
{
    public function getParent()
	{
		return 'FOSUserBundle';
	}
}
