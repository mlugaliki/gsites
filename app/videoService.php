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
            $sqlQuery = "SELECT id,video_name,image,title,service_id FROM video WHERE video_name=:video_name AND deleted_at IS NULL ORDER BY id ASC;";
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

    public function showVideos($plan)
    {
        $videos = $this->getVideoPlan($plan);
        $i = 1;
        if ($videos != null) {
            foreach ($videos as $video) {
                if ($i == 1 || sizeof($videos) == 1) {
                    echo "<div class='row ui-mediabox  prods prods-boxed equal-height'>";
                }
                echo "<div class='col-md-6 s6'>
                                <div class='prod-img-wrap boxed'>
                                  <a class=img-wrap' href='view.php?plan-id=" . $video['id'] . "&&fn_day=" . $video['fn_day'] . "' data-caption='30 day Yoga challenge'>
                                    <img alt='image' class='z-depth-1' style='width: 100%;' src='" . $video['image'] . "'>
                                  </a>
                                <div class='prod-info boxed'>
                                  <a href='ui-app-products-view.html'>
                                    <h5 class='title truncate'>" . $video['category_name'] . "</h5>
                                  </a>    
                                </div>
                                </div>
                                
                              </div>";
                if ($i == 2 || sizeof($videos) == 1) {
                    echo "<div class='spacer-small'></div></div>";
                    $i = 1;
                } else {
                    $i++;
                }
            }
        } else {
            echo "No data to display";
        }
    }

    public function getSubscriberByService($msisdn, $service)
    {
        $conn = $this->database->getConnection();
        try {
            $sqlQuery = "SELECT id, subscriber_name, phone, service FROM subscribers WHERE phone=:phone AND service=:service";
            if ($conn == null) {
                echo("<p>Invalid connection</p>");
            }

            $stmt = $conn->prepare($sqlQuery);
            $stmt->bindParam(":phone", $msisdn);
            $stmt->bindParam(":service", $service);
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

    public function saveSubscriber($msisdn, $name, $service)
    {
        $database = new Database();
        $conn = $database->getConnection();
        if ($conn == null) {
            echo("<p>Invalid connection</p>");
        }
        try {
            $stmt = $conn->prepare("INSERT INTO subscribers(subscriber_name,phone,service)VALUES(?,?,?)");
            $stmt->execute([$name, $msisdn, $service]);
        } catch (PDOException $exception) {
            echo "Database could not be connected: " . $exception->getMessage();
        }
    }
}
