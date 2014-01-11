<?php

namespace Drupal\at_base\Tests;

class ConfigTest extends \DrupalWebTestCase {
  public function getInfo() {
    return array(
      'name' => 'AT Base: Config',
      'description' => 'Make sure the at_config() is working correctly.',
      'group' => 'AT Base',
    );
  }

  public function setUp() {
    $this->profile = 'testing';
    parent::setUp('atest_config', 'atest_base', 'atest2_base');
  }

  /**
   * Make sure at_modules() function is working correctly.
   */
  public function testAtModules() {
    $this->assertTrue(in_array('atest_base', at_modules()));
    $this->assertTrue(in_array('atest2_base', at_modules('atest_base')));
  }

  /**
   * Module weight can be updated correctly
   */
  public function testWeight() {
    at_base_flush_caches();

    $query = "SELECT weight FROM {system} WHERE name = :name";
    $weight = db_query($query, array(':name' => 'atest_base'))->fetchColumn();

    $this->assertEqual(10, $weight);
  }
}
