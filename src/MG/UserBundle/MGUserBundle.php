<?php

namespace MG\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MGUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
	}

