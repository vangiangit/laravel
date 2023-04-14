<?php
namespace App\Services;


use Illuminate\Support\Facades\Session;

/**
 * Session Service
 */
class SessionService{

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public static function put($key, $value)
    {
        Session::put($key, $value);
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        return Session::get($key);
    }

    /**
     * @param $key
     * @param $values
     * @return void
     */
    public static function push($key, $values)
    {
        Session::push($key, $values);
    }

    /**
     * @param string|array $key
     * 
     * @return bool
     */
    public static function has($key)
    {
        return Session::has($key);
    }

    /**
     * @param string $key
     */
    public static function flush(){
        Session::flush();
    }

    /**
     * @param string $key
     * 
     * @return mixed
     */
    public static function remove($key){
        return Session::remove($key);
    }   
}