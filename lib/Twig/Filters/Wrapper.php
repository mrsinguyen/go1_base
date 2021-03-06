<?php

namespace Drupal\go1_base\Twig\Filters;

/**
 * Handler for drupalEntity Twig filter.
 *
 * @see Drupal\go1_base\Twig\Filter_Fetcher::makeContructiveClassBasedFilter()
 */
class Wrapper {
  public static function __callStatic($name, $arguments) {
    $def = go1_container('helper.config_fetcher')->getItem('go1_base', 'twig_filters', 'twig_filters' , "__{$name}", TRUE);

    if (!$def) {
      throw new \Exception("Can not find definition for Twig filter: {$name}");
    }

    list($class, $method) = $def;
    return go1_newv($class, $arguments)->{$method}();
  }
}
