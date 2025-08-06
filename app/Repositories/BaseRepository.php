<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
  protected $model;

  public function __construct(Model $model)
  {
    $this->model = $model;
  }

  public function all()
  {
    return $this->model->all();
  }

  public function paginate($perPage = 15)
  {
    return $this->model->paginate($perPage);
  }

  public function find($id)
  {
    return $this->model->find($id);
  }

  public function findOrFail($id)
  {
    return $this->model->findOrFail($id);
  }

  public function create(array $data)
  {
    return $this->model->create($data);
  }

  public function update($id, array $data)
  {
    $record = $this->findOrFail($id);
    $record->update($data);
    return $record;
  }

  public function delete($id)
  {
    $record = $this->findOrFail($id);
    return $record->delete();
  }

  public function where(array $conditions)
  {
    $query = $this->model->newQuery();

    foreach ($conditions as $field => $value) {
      if (is_array($value)) {
        $query->whereIn($field, $value);
      } else {
        $query->where($field, $value);
      }
    }

    return $query->get();
  }

  public function firstWhere(array $conditions)
  {
    $query = $this->model->newQuery();

    foreach ($conditions as $field => $value) {
      $query->where($field, $value);
    }

    return $query->first();
  }

  public function with($relations)
  {
    return $this->model->with($relations);
  }

  public function orderBy($column, $direction = 'asc')
  {
    return $this->model->orderBy($column, $direction);
  }

  public function count()
  {
    return $this->model->count();
  }

  public function exists($id)
  {
    return $this->model->where('id', $id)->exists();
  }

  public function search($query, array $columns)
  {
    $search = $this->model->newQuery();

    foreach ($columns as $column) {
      $search->orWhere($column, 'LIKE', "%{$query}%");
    }

    return $search->get();
  }

  /**
   * Get model instance
   */
  public function getModel()
  {
    return $this->model;
  }

  /**
   * Set model instance
   */
  public function setModel($model)
  {
    $this->model = $model;
    return $this;
  }

  /**
   * Reset model to original state
   */
  public function resetModel()
  {
    $this->model = new $this->model;
    return $this;
  }
}
