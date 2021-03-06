<?php

namespace Drupal\adaptive;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller routines for page example routes.
 */
class SortController extends ControllerBase {

  public static function swapElement(&$array, $i, $j) {
    $buf = $array[$i];
    $array[$i] = $array[$j];
    $array[$j] = $buf;
  }

  public static function bubleSort(&$array, $key, $reverse = FALSE) {
    if (count($array) && isset($array[0][$key])) {
      for ($j = 1; $j < count($array); $j++) {
        for ($i = 0; $i < count($array) - $j; $i++) {
          if ($array[$i][$key] > $array[$i + 1][$key]) {
            self::swapElement($array, $i, $i + 1);
          }
        }
      }
    }
    if ($reverse) {
      $array = array_reverse($array);
    }
  }

  public static function associativeArraySort(&$array, $reverse = FALSE) {
    $simpleArray = [];
    foreach ($array as $key => $value) {
      $simpleArray[] = [
        'key' => $key,
        'value' => $value,
      ];
    }
    self::bubleSort($simpleArray, 'value', $reverse);
    $array = [];
    foreach ($simpleArray as $element) {
      $array[$element['key']] = $element['value'];
    }
  }

  public static function associativeArraySortWithKey(&$array, $insideKey, $reverse = FALSE) {
    $simpleArray = [];
    foreach ($array as $key => $value) {
      $simpleArray[] = [
        'key' => $key,
        'value' => $value,
        'inside' => $value[$insideKey],
      ];
    }
    self::bubleSort($simpleArray, 'inside', $reverse);
    $array = [];
    foreach ($simpleArray as $element) {
      $array[$element['key']] = $element['value'];
    }
  }

}
