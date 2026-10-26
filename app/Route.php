<?php
namespace App;
use WP_REST_Response;
class Route
{

  private static function namespace() {
    return 'dm/v1';
  }

  // Call Callback
  public static function callback($controller){
    $call = explode("@", $controller);
    return array( 'App\\Controllers\\' . $call[0], $call[1]);
  }

  // GET
  public static function get($route, $callback, $args = [], $permission = [] ){
      register_rest_route( self::namespace(), $route, array(
        'methods' => 'GET',
        'callback' => is_array($callback) ? $callback : self::callback($callback),
        'permission_callback' => $permission,
        'args' => $args
      ));

  }

  // POST
  public static function post($route, $callback, $args = [], $permission = []){
    register_rest_route( self::namespace(), $route, array(
      'methods' => 'POST',
      'callback' => is_array($callback) ? $callback : self::callback($callback),
      'permission_callback' => $permission,
      'args' => $args
    ));
  }

  // PUT
  public static function put($route, $callback, $args = [], $permission = []){
    register_rest_route( self::namespace(), $route, array(
      'methods' => 'PUT',
      'callback' => is_array($callback) ? $callback : self::callback($callback),
      'permission_callback' => $permission,
      'args' => $args
    ));
  }

  // DELETE
  public static function delete($route, $callback, $args = [], $permission = []){
    register_rest_route( self::namespace(), $route, array(
      'methods' => 'DELETE',
      'callback' => is_array($callback) ? $callback : self::callback($callback),
      'permission_callback' => $permission,
      'args' => $args
    ));
  }


}
