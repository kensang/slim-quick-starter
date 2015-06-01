<?php


class JsonHelper {

    public static $indentCharacters = '    ';
    public static $dataSeparator = ', ';
    public static $keyValueSeparator = ' : ';
    protected static $numIndent = 0;





    // @param $message a string to display
    public static function error($message="Unable to communicate with database") {
        header('Content-Type: application/json; charset=utf-8');

        self::curlyBracketOpen();

        self::printIndent();
        self::printKey('status');
        self::printValue('error');
        self::printDataSeparator();
        self::printLineBreak();

        self::printIndent();
        self::printKey('message');
        self::printValue($message);
        self::printLineBreak();

        self::curlyBracketClose();

        exit;
    }

    // @param $arrMessage an array with keys and values, the array only has the depth of 1
    public static function fail($arrMessage=array("message" => "data load failed")) {
        header('Content-Type: application/json; charset=utf-8');

        self::curlyBracketOpen();

        self::printIndent();
        self::printKey('status');
        self::printValue('fail');
        self::printDataSeparator();
        self::printLineBreak();

        self::printIndent();
        self::printKey('data');
        self::printValue($arrMessage);
        self::printLineBreak();

        self::curlyBracketClose();

        exit;
    }


    // @param $data an array with data (can handle array with depth of more than 1)
    public static function success($data) {
        header('Content-Type: application/json; charset=utf-8');

        self::curlyBracketOpen();

        self::printIndent();
        self::printKey('status');
        self::printValue('success');
        self::printDataSeparator();
        self::printLineBreak();

        self::printIndent();
        self::printKey('data');
        self::printValue($data);
        self::printLineBreak();

        self::curlyBracketClose();

        exit;
    }





    /**
     * 3 Main Cases for Value:
     *
     * 1) not an array, just print the value
     *
     *
     * 2) is an array with one row of record (), start with a curly bracket
     *
     *
     * 3) is an array with multiple row of records, start with a square bracket
     *
     */
    private static function printValue($value) {
        if(is_string($value)) {
            $value = str_replace('"', '\"', $value);
            $value = '"'.$value.'"';
            echo $value;
        }
        else if(is_numeric($value)) {
            // no processing is needed
            echo $value;
        }
        else if(is_bool($value)) {
            if($value) {
                $value = 'true';
            }
            else {
                $value = 'false';
            }
            echo $value;
        }
        else if(is_null($value)) {
            $value = 'null';
            echo $value;
        }
        else if(is_array($value)) {
            if(sizeof($value)>=1 && self::isAssoc($value)) { //$value is an array that contain a single row of record
                self::curlyBracketOpen();

                $data = $value;
                $keys = array_keys($data);

                for($n=0;$n<sizeof($data);$n++) {
                    self::printIndent();
                    self::printKey($keys[$n]);
                    self::printValue($data[$keys[$n]]);
                    if($n<sizeof($data)-1) {
                        self::printDataSeparator();
                    }
                    self::printLineBreak();
                }

                self::curlyBracketClose();
            }
            else { //$value is an array that contain multiple rows of records
                self::squareBracketOpen();

                for($i=0;$i<sizeof($value);$i++) {
                    $data = $value[$i];
                    self::printIndent();
                    self::printValue($data);
                    if($i<sizeof($value)-1) {
                        self::printDataSeparator();
                    }
                    self::printLineBreak();
                }

                self::squareBracketClose();
            }

        }

    }






    private static function isAssoc($array) {
        return (bool)count(array_filter(array_keys($array), 'is_string'));
    }

    private static function printIndent() {
        for($n=0;$n<self::$numIndent;$n++) {
            echo self::$indentCharacters;
        }
    }

    private static function indentIncrease() {
        self::$numIndent++;
    }

    private static function indentDecrease() {
        self::$numIndent--;
    }

    private static function curlyBracketOpen() {
        echo '{';
        echo "\r\n";
        self::$numIndent++;
    }

    private static function curlyBracketClose() {
        self::$numIndent--;
        self::printIndent();
        echo '}';
        //echo "\r\n";
    }

    private static function squareBracketOpen() {
        echo '[';
        echo "\r\n";
        self::$numIndent++;
    }

    private static function squareBracketClose() {
        self::$numIndent--;
        self::printIndent();
        echo ']';
        //echo "\r\n";
    }

    private static function printDataSeparator() {
        echo self::$dataSeparator;
    }

    private static function printKeyValueSeparator() {
        echo self::$keyValueSeparator;
    }

    private static function printLineBreak() {
        echo "\r\n";
    }

    private static function printKey($key) {
        echo '"'.$key.'"';
        self::printKeyValueSeparator();
    }


    








}