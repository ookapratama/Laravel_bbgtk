<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface UserInterface
{
	/**
	 * params string $search
	 * @return Collection
	*/

	public function paginated(array $request);
}