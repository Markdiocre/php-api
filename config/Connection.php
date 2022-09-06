<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json: charset=utf8");
    header("Access-Control-Allow-Methods: GET, PUT, POST, PATCH, DELETE");

    date_default_timezone_set("Asia/Manila");
    set_time_limit(1000);

    define("DBNAME","enrollment_db");
    define("USER","root");
    define("PASS","");
    define("HOST","localhost");

    class Connection{
        protected $con_string = "mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8mb4";
        protected $options=[
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false
        ];


        public function connect(){
            try{
                return new \PDO($this->con_string, USER,PASS,$this->options);
            }catch(\PDOException $e){
                echo $e->getMessage();
            }
            
        }
    }
