<?php
require_once 'db.php';

class VideoService
{
    private $conn;
    private $database;

    public function __construct()
    {
        $this->database = new Database();
        //$conn = $database->getConnection();
    }


    public function getVideo($name)
    {
        $conn = $this->database->getConnection();
        try {
            $sqlQuery = "SELECT id,video_name,image,title FROM video WHERE video_name=:video_name AND deleted_at IS NULL ORDER BY id ASC;";
            if ($conn == null) {
                echo("<p>Invalid connection</p>");
            }
            $stmt = $conn->prepare($sqlQuery);
            $stmt->bindParam(":video_name", $name);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        } finally {
            if ($conn != null) {
                $this->database->CloseCon($conn);
            }
        }
    }

    public function getVideoPlanByDay($fnDay, $categoryId)
    {
        $conn = $this->database->getConnection();
        try {
            $sqlQuery = "SELECT vdc.category_name,vdc.fn_day FROM vd_category vdc WHERE vdc.fn_day=:fn_day AND vdc.id=:categoryId ORDER BY fn_day ASC";
            if ($conn == null) {
                echo("<p>Invalid connection</p>");
                return;
            }
            $stmt = $conn->prepare($sqlQuery);
            $stmt->bindParam(":fn_day", $fnDay);
            $stmt->bindParam(":categoryId", $categoryId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        } finally {
            if ($conn != null) {
                $this->database->CloseCon($conn);
            }
        }
    }

    public function getVideoPlan($name)
    {
        $conn = $this->database->getConnection();
        try {
            $sqlQuery = "SELECT vc.id, vc.category_name,vc.image,vc.video_id,v.video_name,fn_day,service_id FROM vd_category vc INNER JOIN video v ON vc.video_id =v.id WHERE v.video_name=:name ORDER BY fn_day ASC";
            if ($conn == null) {
                echo("<p>Invalid connection</p>");
            }
            $stmt = $conn->prepare($sqlQuery);
            $stmt->bindParam(":name", $name);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        } finally {
            if ($conn != null) {
                $this->database->CloseCon($conn);
            }
        }
    }

    public function getVideoByCategoryId($planId)
    {
        $conn = $this->database->getConnection();
        try {
            $sqlQuery = "SELECT vdi.id, vdi.category_id, vdi.item_name, vdi.image, vdi.video_url,vdi.duration FROM vd_items vdi WHERE category_id=:plan_id ORDER BY ex_level ASC";
            if ($conn == null) {
                echo("<p>Invalid connection</p>");
            }
            $stmt = $conn->prepare($sqlQuery);
            $stmt->bindParam(":plan_id", $planId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        } finally {
            $this->database->CloseCon($conn);
        }

        return null;
    }
}
