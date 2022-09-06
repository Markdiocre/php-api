<?php

    class GlobalMethods{
        
        protected $pdo;

        public function __construct(\PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function exec_query($sql){
            $data = array();
            $errmsg = '';
            $code = 0;

            try{
                if($result = $this->pdo->query($sql)->fetchAll()){
                    foreach($result as $record){
                        array_push($data, $record);
                    }

                    $result = null;
                    $code = 200;
                    return array("code"=>$code, "data"=>$data);
                }else{
                    $errmsg = 'No Data Found';
                    $code = 404;
                }
            }catch(\PDOException $e){
                $errmsg = $e->getMessage();
                $code = 403;
            }

            return array("code"=>$code, "errmsg"=>$errmsg);
        }

        public function response_payload($payload, $remarks, $message, $code){
            $status = array("remarks"=>$remarks, "message"=>$message);
            http_response_code($code);
            return array("status"=>$status, "payload"=>$payload, "timestamp"=>date_create(), "prepared_by"=>"Mark Thaddeus Manuel");
        }

        public function cud($sql, $arr, $verb, $verb_past){
            try{
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute($arr);
                return $this->response_payload(null,"success","Successfully $verb_past Data", 200);
            }catch(\PDOException $e){
                return $this->response_payload(null,"failed","Failed to $verb data", 400);
            }
        }

    }

?>