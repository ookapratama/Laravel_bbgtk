<?php

use Carbon\Carbon;

if (!function_exists('formatDate')) {
  /**
   * Format date to readable format
   */
  function formatDate($date, $format = 'd M Y')
  {
    if (!$date) return null;

    return Carbon::parse($date)->format($format);
  }
}

if (!function_exists('formatDateTime')) {
  /**
   * Format datetime to readable format
   */
  function formatDateTime($date, $format = 'd M Y H:i')
  {
    if (!$date) return null;

    return Carbon::parse($date)->format($format);
  }
}

if (!function_exists('diffForHumans')) {
  /**
   * Get human readable time difference
   */
  function diffForHumans($date)
  {
    if (!$date) return null;

    return Carbon::parse($date)->diffForHumans();
  }
}

if (!function_exists('isToday')) {
  /**
   * Check if date is today
   */
  function isToday($date)
  {
    if (!$date) return false;

    return Carbon::parse($date)->isToday();
  }
}

if (!function_exists('isYesterday')) {
  /**
   * Check if date is yesterday
   */
  function isYesterday($date)
  {
    if (!$date) return false;

    return Carbon::parse($date)->isYesterday();
  }
}

if (!function_exists('isTomorrow')) {
  /**
   * Check if date is tomorrow
   */
  function isTomorrow($date)
  {
    if (!$date) return false;

    return Carbon::parse($date)->isTomorrow();
  }
}

if (!function_exists('startOfDay')) {
  /**
   * Get start of day
   */
  function startOfDay($date = null)
  {
    $date = $date ? Carbon::parse($date) : Carbon::now();
    return $date->startOfDay();
  }
}

if (!function_exists('endOfDay')) {
  /**
   * Get end of day
   */
  function endOfDay($date = null)
  {
    $date = $date ? Carbon::parse($date) : Carbon::now();
    return $date->endOfDay();
  }
}

if (!function_exists('startOfMonth')) {
  /**
   * Get start of month
   */
  function startOfMonth($date = null)
  {
    $date = $date ? Carbon::parse($date) : Carbon::now();
    return $date->startOfMonth();
  }
}

if (!function_exists('endOfMonth')) {
  /**
   * Get end of month
   */
  function endOfMonth($date = null)
  {
    $date = $date ? Carbon::parse($date) : Carbon::now();
    return $date->endOfMonth();
  }
}

if (!function_exists('addDays')) {
  /**
   * Add days to date
   */
  function addDays($date, $days)
  {
    return Carbon::parse($date)->addDays($days);
  }
}

if (!function_exists('subDays')) {
  /**
   * Subtract days from date
   */
  function subDays($date, $days)
  {
    return Carbon::parse($date)->subDays($days);
  }
}

if (!function_exists('daysBetween')) {
  /**
   * Get days between two dates
   */
  function daysBetween($startDate, $endDate)
  {
    return Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate));
  }
}

if (!function_exists('monthsBetween')) {
  /**
   * Get months between two dates
   */
  function monthsBetween($startDate, $endDate)
  {
    return Carbon::parse($startDate)->diffInMonths(Carbon::parse($endDate));
  }
}

if (!function_exists('yearsBetween')) {
  /**
   * Get years between two dates
   */
  function yearsBetween($startDate, $endDate)
  {
    return Carbon::parse($startDate)->diffInYears(Carbon::parse($endDate));
  }
}

if (!function_exists('age')) {
  /**
   * Calculate age from birthdate
   */
  function age($birthDate)
  {
    return Carbon::parse($birthDate)->age;
  }
}

if (!function_exists('getMonthName')) {
  /**
   * Get month name in Indonesian
   */
  function getMonthName($month)
  {
    $months = [
      1 => 'Januari',
      2 => 'Februari',
      3 => 'Maret',
      4 => 'April',
      5 => 'Mei',
      6 => 'Juni',
      7 => 'Juli',
      8 => 'Agustus',
      9 => 'September',
      10 => 'Oktober',
      11 => 'November',
      12 => 'Desember'
    ];

    return $months[$month] ?? '';
  }
}

if (!function_exists('getDayName')) {
  /**
   * Get day name in Indonesian
   */
  function getDayName($dayOfWeek)
  {
    $days = [
      0 => 'Minggu',
      1 => 'Senin',
      2 => 'Selasa',
      3 => 'Rabu',
      4 => 'Kamis',
      5 => 'Jumat',
      6 => 'Sabtu'
    ];

    return $days[$dayOfWeek] ?? '';
  }
}
