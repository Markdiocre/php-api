<?php

    class Delete{

        protected $pdo, $gm, $verb, $verb_past;
        public function __construct(\PDO $pdo)
        {
            $this->pdo =$pdo;
            $this->gm = new GlobalMethods($pdo);
            $this->verb = "delete";
            $this->verb_past = "deleted";
        }

        public function delete_student($req){
            $sql = "UPDATE `students_tbl` SET `is_deleted`=1 WHERE `studnum`='$req'";
            return $this->gm->cud($sql, null, $this->verb, $this->verb_past);
        }

        public function delete_class($req){
            $sql = "UPDATE `classes_tbl` SET `is_deleted`=1 WHERE `classcode`='$req'";
            return $this->gm->cud($sql, null, $this->verb, $this->verb_past);
        }

        public function delete_enrollment($req){
            $sql = "DELETE FROM `enrolledsubj_tbl` WHERE `recno`='$req'";
            return $this->gm->cud($sql, null, $this->verb, $this->verb_past);
        }

    }

?>