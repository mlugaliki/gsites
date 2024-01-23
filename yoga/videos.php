<?php
include './db.php';

class Videos{
    private $conn;
    public function __construct(){
        $database = new Database();
        $conn = $database->getConnection();
    }


     public function getVideo($name){
        $database = new Database();
        $conn = $database->getConnection();
        $sqlQuery = "SELECT id,video_name,image,title FROM video WHERE video_name=:video_name AND deleted_at IS NULL ORDER BY id ASC;";
        if($conn == null){
            echo ("<p>Invalid connection</p>");
        }
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindParam(":video_name", $name);
        $stmt->execute();
        return $stmt;
    }


    public function getVideoPlan($name){
        $database = new Database();
        $conn = $database->getConnection();
        $sqlQuery = "SELECT vc.id, vc.category_name,vc.image,vc.video_id,v.video_name,fn_day FROM vd_category vc INNER JOIN video v ON vc.video_id =v.id WHERE v.video_name=:name ORDER BY fn_day ASC";
        if($conn == null){
            echo ("<p>Invalid connection</p>");
        }
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindParam(":name", $name);
        $stmt->execute();
        return $stmt;
    }

       public function getVideoByCategoryId($planId){
        $database = new Database();
        $conn = $database->getConnection();
        $sqlQuery = "SELECT id, category_id, item_name, image, video_url,duration FROM vd_items WHERE ex_level=:plan_id ORDER BY ex_level ASC";
        if($conn == null){
            echo ("<p>Invalid connection</p>");
        }
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindParam(":plan_id", $planId);
        $stmt->execute();
        return $stmt;
    }
}

?>