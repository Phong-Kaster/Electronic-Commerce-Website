<?php
/**
*Session Class
**/
class Session
{
    /*********************************************
     * @author Phong-Kaster
     * 
     * Initialize a new session
     *********************************************/
    public static function init()
    {
        if (version_compare(phpversion(), '5.4.0', '<')) 
        {
            if (session_id() == '') 
            {
                    session_start();
            }
        } 
        else 
        {
            if (session_status() == PHP_SESSION_NONE) 
            {
                session_start();
            }
        }
    }



    /********************************************
     * set $key to Session[$key] equals $val
     ********************************************/
    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }



    /********************************************
     * get session by $key
     ********************************************/
    public static function get($key)
    {
        if (isset($_SESSION[$key])) 
        {
            return $_SESSION[$key];
        } 
        else 
        {
            return false;
        }
    }



    /********************************************
     * check session for login. 
     * If no session have the key "login", return path: login.php
     ********************************************/
    public static function checkSession()
    {
        self::init();
        if (self::get("login") == false) 
        {
            self::destroy();
            Header("Location:login.php");
        }
    }


    /*********************************************
     * @author Phong-Kaster
     * 
     * if having session is gotten by the key "login", return path: index.php
     *********************************************/
    public static function checkLogin()
    {
        self::init();
        if (self::get("login")== true) 
        {
            Header("Location:index.php");
        }
    }


    /*********************************************
     * @author Phong-Kaster
     * delete current session
     *********************************************/
    public static function destroy()
    {
        session_destroy();
        Header("Location:login.php");
    }
}
?>
