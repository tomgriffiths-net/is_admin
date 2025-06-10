<?php
class is_admin{
    private static $state = null;
    public static function init():void{
        if(self::check()){
            mklog(1,"Starting with administrator permissions");
        }
    }
    public static function check():bool{
        if(!is_bool(self::$state)){
            mklog(0,"Checking for Administrator privilages");
            exec("net session >nul 2>&1",$output,$resultCode);

            self::$state = ($resultCode === 0);
        }

        return self::$state;
    }
    public static function refresh():bool{
        self::$state = null;
        return self::check();
    }
}