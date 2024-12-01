<?php
    class Process{
        private $email;
        private $password;

        private static $file_path = "data.text";

        function __construct($emails, $passwords){
        $this->email = $emails; 
        $this->password = $passwords;
    }
    function propertyPuss(){
        return $this->email . "," . $this->password.PHP_EOL;
    }

    public function save(){
        file_put_contents(self::$file_path, $this->propertyPuss(), FILE_APPEND);
    }

    public static function displayShow(){
        $processes = file(self::$file_path);
        echo "<b>Email | Password</b> <br>";

        foreach($processes as $process){
            list($email, $password)= explode(" | " , trim($process));

            echo "$email , $password ";
        }
    }
}
?>