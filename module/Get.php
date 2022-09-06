<?php

    class Get{

        protected $pdo, $gm;

        public function __construct(\PDO $pdo)
        {
            $this->pdo = $pdo;
            $this->gm  = new GlobalMethods($pdo);  
        }

        public function get_students($studnum = null){
            $sql = "SELECT * FROM students_tbl WHERE is_deleted = 0";
            if($studnum != null){
                $sql .= " AND studnum = $studnum";
            }

            $result = $this->gm->exec_query($sql);

            if($result['code']==200){
                return $this->gm->response_payload($result['data'], "sucess", "Succesfully retrieved data", $result['code']);
            }
            return $this->gm->response_payload(null, "failed", "Unable to retrieve data", $result['code']);
        }

        public function get_classes($classcode = null){
            $sql = "SELECT * FROM classes_tbl WHERE is_deleted=0";
            
            if($classcode != null){
                $sql .= " AND classcode = '$classcode'";
            }
            $result = $this->gm->exec_query($sql);

            if($result['code']==200){
                return $this->gm->response_payload($result['data'], "sucess", "Succesfully retrieved data", $result['code']);
            }
            return $this->gm->response_payload(null, "failed", "Unable to retrieve data", $result['code']);
        }

        public function get_enrolled($studnum = null){
            $sql = "SELECT * FROM enrolledsubj_tbl LEFT JOIN classes_tbl ON enrolledsubj_tbl.classcode = classes_tbl.classcode";
            if($studnum != null){
                $sql .= " WHERE enrolledsubj_tbl.studnum = $studnum";
            }

            $sql .= " AND classes_tbl.is_deleted = 0";

            $result = $this->gm->exec_query($sql);
            
            if($result['code']==200){
                return $this->gm->response_payload($result['data'], "sucess", "Succesfully retrieved data", $result['code']);
            }
            return $this->gm->response_payload(null, "failed", "Unable to retrieve data", $result['code']);
        }

        public function get_stud_subj($studnum){
            $sql = "SELECT * FROM enrolledsubj_tbl LEFT JOIN classes_tbl ON enrolledsubj_tbl.classcode = classes_tbl.classcode WHERE enrolledsubj_tbl.studnum='$studnum'";

            $result = $this->gm->exec_query($sql);
            if($result['code']==200){
                return $this->gm->response_payload($result['data'], "sucess", "Succesfully retrieved data", $result['code']);
            }
            return $this->gm->response_payload(null, "failed", "Unable to retrieve data", $result['code']);
        }

    }

?>