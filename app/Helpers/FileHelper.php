<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('uploadFile')) {
  /**
   * Upload file to storage
   */
  function uploadFile(UploadedFile $file, $path = 'uploads', $disk = 'public')
  {
    try {
      $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
      $filePath = $file->storeAs($path, $fileName, $disk);

      return [
        'success' => true,
        'file_name' => $fileName,
        'file_path' => $filePath,
        'url' => Storage::disk($disk)->url($filePath),
        'size' => $file->getSize(),
        'mime_type' => $file->getMimeType()
      ];
    } catch (Exception $e) {
      return [
        'success' => false,
        'message' => $e->getMessage()
      ];
    }
  }
}

if (!function_exists('uploadImage')) {
  /**
   * Upload image with validation
   */
  function uploadImage(UploadedFile $file, $path = 'images', $maxSize = 2048, $disk = 'public')
  {
    try {
      // Validate image
      $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

      if (!in_array($file->getMimeType(), $allowedMimes)) {
        return [
          'success' => false,
          'message' => 'Invalid image type. Only JPEG, PNG, GIF, and WebP are allowed.'
        ];
      }

      if ($file->getSize() > $maxSize * 1024) {
        return [
          'success' => false,
          'message' => "Image size must be less than {$maxSize}KB."
        ];
      }

      return uploadFile($file, $path, $disk);
    } catch (Exception $e) {
      return [
        'success' => false,
        'message' => $e->getMessage()
      ];
    }
  }
}

if (!function_exists('deleteFile')) {
  /**
   * Delete file from storage
   */
  function deleteFile($filePath, $disk = 'public')
  {
    try {
      if (Storage::disk($disk)->exists($filePath)) {
        Storage::disk($disk)->delete($filePath);
        return true;
      }
      return false;
    } catch (Exception $e) {
      return false;
    }
  }
}

if (!function_exists('fileExists')) {
  /**
   * Check if file exists
   */
  function fileExists($filePath, $disk = 'public')
  {
    return Storage::disk($disk)->exists($filePath);
  }
}

if (!function_exists('getFileUrl')) {
  /**
   * Get file URL
   */
  function getFileUrl($filePath, $disk = 'public')
  {
    if (fileExists($filePath, $disk)) {
      return Storage::disk($disk)->url($filePath);
    }
    return null;
  }
}

if (!function_exists('formatFileSize')) {
  /**
   * Format file size to human readable format
   */
  function formatFileSize($bytes)
  {
    if ($bytes >= 1073741824) {
      $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
      $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
      $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
      $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
      $bytes = $bytes . ' byte';
    } else {
      $bytes = '0 bytes';
    }

    return $bytes;
  }
}

if (!function_exists('getFileExtension')) {
  /**
   * Get file extension from path
   */
  function getFileExtension($filePath)
  {
    return pathinfo($filePath, PATHINFO_EXTENSION);
  }
}

if (!function_exists('getFileName')) {
  /**
   * Get file name without extension
   */
  function getFileName($filePath)
  {
    return pathinfo($filePath, PATHINFO_FILENAME);
  }
}

if (!function_exists('generateFileName')) {
  /**
   * Generate unique file name
   */
  function generateFileName($originalName, $prefix = '')
  {
    $extension = getFileExtension($originalName);
    $name = $prefix . time() . '_' . Str::random(10);

    return $extension ? $name . '.' . $extension : $name;
  }
}

if (!function_exists('sanitizeFileName')) {
  /**
   * Sanitize file name
   */
  function sanitizeFileName($fileName)
  {
    // Remove special characters and replace spaces with underscores
    $fileName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $fileName);
    $fileName = preg_replace('/_{2,}/', '_', $fileName); // Remove multiple underscores

    return $fileName;
  }
}

if (!function_exists('createDirectory')) {
  /**
   * Create directory if not exists
   */
  function createDirectory($path, $disk = 'public')
  {
    try {
      if (!Storage::disk($disk)->exists($path)) {
        Storage::disk($disk)->makeDirectory($path, 0755, true);
      }
      return true;
    } catch (Exception $e) {
      return false;
    }
  }
}
