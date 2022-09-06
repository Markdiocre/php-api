<?php

    class Post{

        protected $pdo, $gm;
        public function __construct(\PDO $pdo)
        {
            $this->pdo =$pdo;
        }

        public function add_student($data){
            $sql = "INSERT INTO `students_tbl`(`studnum`, `fname`, `mname`, `lname`, `is_deleted`) VALUES (?,?,?,?,?)";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->studnum, ]);
        }

    }

?>