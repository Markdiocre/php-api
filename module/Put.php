<?php

    class Put{

        protected $pdo, $gm, $verb, $verb_past;
        public function __construct(\PDO $pdo)
        {
            $this->pdo = $pdo;
            $this->gm = new GlobalMethods($pdo);
            $this->verb = "update";
            $this->verb_past = "updated";
        }

        public function update_student($data, $req){
            $sql = "UPDATE `students_tbl` SET `studnum`=?,`fname`=?,`mname`=?,`lname`=? WHERE `studnum`='$req'";
            $arr = [$data->studnum, $data->fname,$data->mname,$data->lname];
            return $this->gm->cud($sql, $arr, $this->verb, $this->verb_past);
        }

        public function update_class($data, $req){
            $sql = "UPDATE `classes_tbl` SET `classcode`=?,`subjdesc`=?,`timeslot`=? WHERE `classcode`='$req'";
            $arr = [$data->classcode, $data->subjdesc ,$data->timeslot];
            return $this->gm->cud($sql, $arr, $this->verb, $this->verb_past);
        }

        public function update_enrollment($data, $req){
            $sql = "UPDATE `enrolledsubj_tbl` SET `classcode`=?,`studnum`=? WHERE `recno`='$req'";
            $arr = [$data->classcode, $data->studnum];
            return $this->gm->cud($sql, $arr, $this->verb, $this->verb_past);
        }

    }

?>