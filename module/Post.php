<?php

    class Post{

        protected $pdo, $gm, $verb, $verb_past;
        public function __construct(\PDO $pdo)
        {
            $this->pdo =$pdo;
            $this->gm = new GlobalMethods($pdo);
            $this->verb = "insert";
            $this->verb_past = "inserted";
        }

        public function add_student($data){
            $sql = "INSERT INTO `students_tbl`(`studnum`, `fname`, `mname`, `lname`, `is_deleted`) VALUES (?,?,?,?,0)";
            $arr = [$data->studnum, $data->fname, $data->mname, $data->lname];
            return $this->gm->cud($sql, $arr, $this->verb, $this->verb_past);
        }

        public function add_classes($data){
            $sql = "INSERT INTO `classes_tbl`(`classcode`, `subjdesc`, `timeslot`, `is_deleted`) VALUES (?,?,?,0)";
            $arr = [$data->classcode, $data->subjdesc, $data->timeslot];
            return $this->gm->cud($sql, $arr, $this->verb, $this->verb_past);
        }

        public function add_enrollment($data){
            $sql = "INSERT INTO `enrolledsubj_tbl`(`classcode`, `studnum`) VALUES (?,?)";
            $arr = [$data->classcode, $data->studnum];
            return $this->gm->cud($sql, $arr, $this->verb, $this->verb_past);
        }

    }

?>