<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
  /**
   * Get all records
   */
  public function all();

  /**
   * Get records with pagination
   */
  public function paginate($perPage = 15);

  /**
   * Find record by ID
   */
  public function find($id);

  /**
   * Find record by ID or fail
   */
  public function findOrFail($id);

  /**
   * Create new record
   */
  public function create(array $data);

  /**
   * Update record
   */
  public function update($id, array $data);

  /**
   * Delete record
   */
  public function delete($id);

  /**
   * Get records by conditions
   */
  public function where(array $conditions);

  /**
   * Get first record by conditions
   */
  public function firstWhere(array $conditions);

  /**
   * Get records with relationships
   */
  public function with($relations);

  /**
   * Order by column
   */
  public function orderBy($column, $direction = 'asc');

  /**
   * Get count of records
   */
  public function count();

  /**
   * Check if record exists
   */
  public function exists($id);

  /**
   * Get records with search
   */
  public function search($query, array $columns);
}
