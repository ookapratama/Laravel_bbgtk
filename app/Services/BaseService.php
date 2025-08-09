<?php

namespace App\Services;

use App\Repositories\Contracts\BaseInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BaseService
{
  protected $repository;

  public function __construct(BaseInterface $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Get all records
   */
  public function getAll()
  {
    try {
      return $this->repository->all();
    } catch (Exception $e) {
      Log::error('Error getting all records: ' . $e->getMessage());
      throw $e;
    }
  }

  /**
   * Get paginated records
   */
  public function getPaginated($perPage = 15)
  {
    try {
      return $this->repository->paginate($perPage);
    } catch (Exception $e) {
      Log::error('Error getting paginated records: ' . $e->getMessage());
      throw $e;
    }
  }

  /**
   * Find record by ID
   */
  public function findById($id)
  {
    try {
      return $this->repository->findOrFail($id);
    } catch (Exception $e) {
      Log::error("Error finding record with ID {$id}: " . $e->getMessage());
      throw $e;
    }
  }

  /**
   * Create new record
   */
  public function create(array $data)
  {
    try {
      DB::beginTransaction();

      $record = $this->repository->create($data);

      DB::commit();
      return $record;
    } catch (Exception $e) {
      DB::rollback();
      Log::error('Error creating record: ' . $e->getMessage());
      throw $e;
    }
  }

  /**
   * Update record
   */
  public function update($id, array $data)
  {
    try {
      DB::beginTransaction();

      $record = $this->repository->update($id, $data);

      DB::commit();
      return $record;
    } catch (Exception $e) {
      DB::rollback();
      Log::error("Error updating record with ID {$id}: " . $e->getMessage());
      throw $e;
    }
  }

  /**
   * Delete record
   */
  public function delete($id)
  {
    try {
      DB::beginTransaction();

      $result = $this->repository->delete($id);

      DB::commit();
      return $result;
    } catch (Exception $e) {
      DB::rollback();
      Log::error("Error deleting record with ID {$id}: " . $e->getMessage());
      throw $e;
    }
  }

  /**
   * Search records
   */
  public function search($query, array $columns)
  {
    try {
      return $this->repository->search($query, $columns);
    } catch (Exception $e) {
      Log::error('Error searching records: ' . $e->getMessage());
      throw $e;
    }
  }

  /**
   * Get records by conditions
   */
  public function getByConditions(array $conditions)
  {
    try {
      return $this->repository->where($conditions);
    } catch (Exception $e) {
      Log::error('Error getting records by conditions: ' . $e->getMessage());
      throw $e;
    }
  }

  /**
   * Check if record exists
   */
  public function exists($id)
  {
    try {
      return $this->repository->exists($id);
    } catch (Exception $e) {
      Log::error("Error checking if record exists with ID {$id}: " . $e->getMessage());
      throw $e;
    }
  }

  /**
   * Get count of records
   */
  public function getCount()
  {
    try {
      return $this->repository->count();
    } catch (Exception $e) {
      Log::error('Error getting count of records: ' . $e->getMessage());
      throw $e;
    }
  }
}
