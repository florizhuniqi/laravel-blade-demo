<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.coding-squared.com/blog/
 * @since             1.0.0
 * @package           Laravel_Blade_Demo
 *
 * @wordpress-plugin
 * Plugin Name:       Laravel Blade Demo
 * Plugin URI:        https://www.coding-squared.com/blog/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Derek Chafin
 * Author URI:        https://www.coding-squared.com/blog/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       laravel-blade-demo
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require plugin_dir_path( __FILE__ ) . '/vendor/autoload.php';
require plugin_dir_path( __FILE__ ) . '/white-screen-of-death.php';

use Philo\Blade\Blade;

class LaravelBladeDemo {


  public function hello() {
    $views = __DIR__ . '/views';
    $cache = __DIR__ . '/cache';

    $blade = new Blade($views, $cache);
    $factory = $blade->view();

    $name = 'Derek Chafin';
    $age = '30';

    echo $factory->make('hello', compact('name', 'age'))->render();
  }

}

function run_laravel_blade_demo() {
  $page       = "hello";
  $page_title = "Laravel Hello";
  $menu_title = "Laravel Hello";
  $capability = "manage_options";
  $menu_slug  = "laravel-blade-demo" . $page;

  $demo = new LaravelBladeDemo();

  add_management_page( $page_title, $menu_title, $capability, $menu_slug, array( $demo, 'hello' ) );
}
add_action( 'admin_menu', 'run_laravel_blade_demo' );

