<?php
//Your Settings can be read here: settings::read('myArray/settingName') = $settingValue;
//Your Settings can be saved here: settings::set('myArray/settingName',$settingValue,$overwrite = true/false);
class is_admin{
    //public static function command($line):void{}//Run when base command is class name, $line is anything after base command (string). e.g. > [base command] [$line]
    public static function init():void{
        if(self::check()){
            mklog("general","Starting with administrator permissions",false);
        }
    }//Run at startup
    public static function check():bool{
        
        if(isset($GLOBALS['is_admin']['check_state'])){
            if(is_bool($GLOBALS['is_admin']['check_state'])){
                return $GLOBALS['is_admin']['check_state'];
            }
        }

        $result = false;

        mklog('general',"Checking for Administrator privilages");
        exec("net session >nul 2>&1",$output,$resultCode);

        if($resultCode === 0){
            $result = true;
        }

        $GLOBALS['is_admin']['check_state'] = $result;

        return $result;

    }
    public static function refresh():bool{
        if(isset($GLOBALS['is_admin']['check_state'])){
            unset($GLOBALS['is_admin']['check_state']);
        }
        return self::check();
    }
}