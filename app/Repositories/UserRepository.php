<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\UserInterface;
use App\Models\User;

class UserRepository extends BaseRepository implements UserInterface
{
	/**
	 * @var
	 */
	protected $model;

	public function __construct(User $model)
	{
		parent::__construct($model);
	}

	public function paginated(array $criteria)
	{
		$perPage = $criteria['per_page'] ?? 5;
		$field = $criteria['sort_field'] ?? 'id';
		$sortOrder = $criteria['sort_order'] ?? 'desc';
		return $this->model->orderBy($field, $sortOrder)->paginate($perPage);
	}

}