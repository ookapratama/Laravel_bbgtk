<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;

class BaseController extends Controller
{
    protected $service;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 15);
            $search = $request->get('search');

            if ($search) {
                $data = $this->service->search($search, $this->getSearchableColumns());
            } else {
                $data = $this->service->getPaginated($perPage);
            }

            if ($request->expectsJson()) {
                return successResponse('Data retrieved successfully', $data);
            }

            return view($this->getIndexView(), compact('data'));
        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return errorResponse('Failed to retrieve data: ' . $e->getMessage());
            }

            return back()->with('error', 'Failed to retrieve data: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->getCreateView());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateRequest($request);
            $data = $this->service->create($validatedData);

            if ($request->expectsJson()) {
                return successResponse('Data created successfully', $data, 201);
            }

            return redirect()->route($this->getRouteIndex())
                ->with('success', 'Data created successfully');
        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return errorResponse('Failed to create data: ' . $e->getMessage(), 422);
            }

            return back()->withInput()
                ->with('error', 'Failed to create data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        try {
            $data = $this->service->findById($id);

            if ($request->expectsJson()) {
                return successResponse('Data retrieved successfully', $data);
            }

            return view($this->getShowView(), compact('data'));
        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return errorResponse('Data not found: ' . $e->getMessage(), 404);
            }

            return back()->with('error', 'Data not found: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $data = $this->service->findById($id);
            return view($this->getEditView(), compact('data'));
        } catch (Exception $e) {
            return back()->with('error', 'Data not found: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $this->validateRequest($request, $id);
            $data = $this->service->update($id, $validatedData);

            if ($request->expectsJson()) {
                return successResponse('Data updated successfully', $data);
            }

            return redirect()->route($this->getRouteIndex())
                ->with('success', 'Data updated successfully');
        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return errorResponse('Failed to update data: ' . $e->getMessage(), 422);
            }

            return back()->withInput()
                ->with('error', 'Failed to update data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            $this->service->delete($id);

            if ($request->expectsJson()) {
                return successResponse('Data deleted successfully');
            }

            return redirect()->route($this->getRouteIndex())
                ->with('success', 'Data deleted successfully');
        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return errorResponse('Failed to delete data: ' . $e->getMessage(), 422);
            }

            return back()->with('error', 'Failed to delete data: ' . $e->getMessage());
        }
    }

    /**
     * Get searchable columns (override in child class)
     */
    protected function getSearchableColumns(): array
    {
        return [];
    }

    /**
     * Get index view path (override in child class)
     */
    protected function getIndexView(): string
    {
        return '';
    }

    /**
     * Get create view path (override in child class)
     */
    protected function getCreateView(): string
    {
        return '';
    }

    /**
     * Get edit view path (override in child class)
     */
    protected function getEditView(): string
    {
        return '';
    }

    /**
     * Get show view path (override in child class)
     */
    protected function getShowView(): string
    {
        return '';
    }

    /**
     * Get route index name (override in child class)
     */
    protected function getRouteIndex(): string
    {
        return '';
    }

    /**
     * Validate request data (override in child class)
     */
    protected function validateRequest(Request $request, $id = null): array
    {
        return [];
    }
}
