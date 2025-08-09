<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserInterface;

class UserService extends BaseService 
{
	/**
	 * @var
	 */
	protected $model;

	public function __construct(UserInterface $interface)
	{
		parent::__construct($interface);
	}


}