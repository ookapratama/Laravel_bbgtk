<?php

if (!function_exists('validateEmail')) {
  /**
   * Validate email address
   */
  function validateEmail($email)
  {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
  }
}

if (!function_exists('validatePhone')) {
  /**
   * Validate Indonesian phone number
   */
  function validatePhone($phone)
  {
    // Remove all non-digit characters
    $phone = preg_replace('/[^0-9]/', '', $phone);

    // Check if it starts with 08, +62, or 62
    if (preg_match('/^(08|628|62)/', $phone)) {
      return strlen($phone) >= 10 && strlen($phone) <= 15;
    }

    return false;
  }
}

if (!function_exists('formatPhone')) {
  /**
   * Format Indonesian phone number
   */
  function formatPhone($phone)
  {
    // Remove all non-digit characters
    $phone = preg_replace('/[^0-9]/', '', $phone);

    // Convert to standard format
    if (substr($phone, 0, 2) === '08') {
      $phone = '62' . substr($phone, 1);
    } elseif (substr($phone, 0, 3) === '628') {
      // Already in correct format
    } elseif (substr($phone, 0, 2) === '62') {
      // Already in correct format
    }

    return $phone;
  }
}

if (!function_exists('validateNIK')) {
  /**
   * Validate Indonesian NIK (Nomor Induk Kependudukan)
   */
  function validateNIK($nik)
  {
    // NIK must be 16 digits
    if (strlen($nik) !== 16 || !is_numeric($nik)) {
      return false;
    }

    // Basic validation: check if all digits are not the same
    if (strlen(array_unique(str_split($nik))) === 1) {
      return false;
    }

    return true;
  }
}

if (!function_exists('validateNPWP')) {
  /**
   * Validate Indonesian NPWP
   */
  function validateNPWP($npwp)
  {
    // Remove dots and dashes
    $npwp = preg_replace('/[.-]/', '', $npwp);

    // NPWP must be 15 digits
    return strlen($npwp) === 15 && is_numeric($npwp);
  }
}

if (!function_exists('validatePostalCode')) {
  /**
   * Validate Indonesian postal code
   */
  function validatePostalCode($postalCode)
  {
    // Indonesian postal code is 5 digits
    return strlen($postalCode) === 5 && is_numeric($postalCode);
  }
}

if (!function_exists('validateURL')) {
  /**
   * Validate URL
   */
  function validateURL($url)
  {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
  }
}

if (!function_exists('validateRequired')) {
  /**
   * Check if value is not empty
   */
  function validateRequired($value)
  {
    if (is_null($value)) {
      return false;
    }

    if (is_string($value) && trim($value) === '') {
      return false;
    }

    if (is_array($value) && empty($value)) {
      return false;
    }

    return true;
  }
}

if (!function_exists('validateMinLength')) {
  /**
   * Validate minimum length
   */
  function validateMinLength($value, $min)
  {
    return strlen($value) >= $min;
  }
}

if (!function_exists('validateMaxLength')) {
  /**
   * Validate maximum length
   */
  function validateMaxLength($value, $max)
  {
    return strlen($value) <= $max;
  }
}

if (!function_exists('validateNumeric')) {
  /**
   * Check if value is numeric
   */
  function validateNumeric($value)
  {
    return is_numeric($value);
  }
}

if (!function_exists('validateInteger')) {
  /**
   * Check if value is integer
   */
  function validateInteger($value)
  {
    return filter_var($value, FILTER_VALIDATE_INT) !== false;
  }
}

if (!function_exists('validateFloat')) {
  /**
   * Check if value is float
   */
  function validateFloat($value)
  {
    return filter_var($value, FILTER_VALIDATE_FLOAT) !== false;
  }
}

if (!function_exists('validateDate')) {
  /**
   * Validate date format
   */
  function validateDate($date, $format = 'Y-m-d')
  {
    $dateTime = DateTime::createFromFormat($format, $date);
    return $dateTime && $dateTime->format($format) === $date;
  }
}

if (!function_exists('validateDateRange')) {
  /**
   * Validate if date is within range
   */
  function validateDateRange($date, $startDate, $endDate)
  {
    $date = strtotime($date);
    $startDate = strtotime($startDate);
    $endDate = strtotime($endDate);

    return $date >= $startDate && $date <= $endDate;
  }
}

if (!function_exists('validateAge')) {
  /**
   * Validate age from birth date
   */
  function validateAge($birthDate, $minAge = 17, $maxAge = 100)
  {
    $age = age($birthDate);
    return $age >= $minAge && $age <= $maxAge;
  }
}

if (!function_exists('validateAlpha')) {
  /**
   * Check if value contains only alphabetic characters
   */
  function validateAlpha($value)
  {
    return preg_match('/^[a-zA-Z\s]+$/', $value);
  }
}

if (!function_exists('validateAlphaNum')) {
  /**
   * Check if value contains only alphanumeric characters
   */
  function validateAlphaNum($value)
  {
    return preg_match('/^[a-zA-Z0-9\s]+$/', $value);
  }
}

if (!function_exists('sanitizeInput')) {
  /**
   * Sanitize input data
   */
  function sanitizeInput($input)
  {
    if (is_array($input)) {
      return array_map('sanitizeInput', $input);
    }

    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
  }
}

if (!function_exists('validateFileType')) {
  /**
   * Validate file type
   */
  function validateFileType($file, array $allowedTypes)
  {
    $fileType = $file->getMimeType();
    return in_array($fileType, $allowedTypes);
  }
}

if (!function_exists('validateFileSize')) {
  /**
   * Validate file size (in KB)
   */
  function validateFileSize($file, $maxSize)
  {
    $fileSize = $file->getSize() / 1024; // Convert to KB
    return $fileSize <= $maxSize;
  }
}
