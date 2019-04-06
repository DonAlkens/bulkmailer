<?php 

  require("inc/dbconnect.php");

  function getprevious($mysqli){
    $get_all = $mysqli->query("SELECT * FROM mail_status ORDER BY sn DESC");
      if($get_all->num_rows > 0) {
        $all = [];
        $i = 0;

        while($row = $get_all->fetch_assoc()) {
          $all[$i] = $row;
          $i++;
        }

        echo json_encode($all);
      }
  }

  if(isset($_GET["previous"])) {
    getprevious($mysqli);
  }


  if(isset($_GET["subject"]) && isset($_GET["body"])) {
    if($_GET["subject"] !== "" && $_GET["body"] !== "") {


      $mail_subject = $_GET["subject"];
      $body = $_GET["body"];
      $mails = str_replace(" ", "", $_GET["mails"]);
      $mails = explode(",", $mails);

      $response = [];
      $result = array("email" => '', "status" => true, "error" => null, "date"=> date("d-m-Y h:i:s"));


          // $to = $mails;

          $subject = $mail_subject;

          $headers = "From: " . "info@ourcompnay.com" . "\r\n";
          $headers .= "Reply-To: ". "<no-reply>" . "\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

          $message = '<!DOCTYPE html><html>';
          $message .= '<head>';
          $message .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
          $message .= '<style>';
          $message .= 'body {font-family: "Lato", sans-serif; background-color:#f2f2f2f; font-size:15px;}';

          $message .= '.sidenav {height: 100%;width:100%;position:fixed;z-index:1;top:0;left:0;background-color:dodgerblue;overflow-x:hidden;padding-top:20px;}';

          $message .= '.sidenav a {padding: 6px 8px 6px 16px;text-decoration: none;font-size: 25px;color: #818181;display: block;}';

          $message .= '.sidenav a:hover {color: #f1f1f1;}';

          $message .= '.main {margin-left: 160px;font-size: 28px; padding: 0px 10px;}';

          $message .= '@media screen and (max-height: 450px) {.sidenav {padding-top: 15px;}.sidenav a {font-size: 18px;}}</style></head><body><div class="sidenav"><a href="#about">About</a><a href="#services">Services</a><a href="#clients">Clients</a><a href="#contact">Contact</a></div>';

          $message .= '<div class="main"><h5>Sidebar</h5><p>'.$body.'</p></div></body></html> ';



      // akinniyiakinpelumi@gmail.com, akinniyiakinpelumi@yahoo.com


          // if(mail($to, $subject, $message, $headers)) {
          //   $mails = explode(",", $to);
          //   for($i = 0; $i < count($mails); $i++) {
          //     $email = $mails[$i];
          //     $status = $result["status"];
          //     $date = $result["date"];
          //     $save_status = $mysqli->query("INSERT INTO mail_status(email,status,date) VALUES('$email','$status','$date')");
          //   }
          // }


      for($i = 0; $i < count($mails); $i++) {
          $receiver = $mails[$i];
          $to = $receiver;

          
          $result["email"] = $to;
          if(mail($to, $subject, $message, $headers)) {
              
          } 
          else {
            $result["status"] = false;
            $result["error"] = array("message"=> "Failed to send mail to this user");
          }

          $response[$i] = $result;  
      }

      // echo json_encode($response);

      for($j = 0; $j < count($response); $j++) {
        $data = $response[$j];
        $email = $data["email"];
        $status = $data["status"];
        $date = $data["date"];
        $save_status = $mysqli->query("INSERT INTO mail_status(email,status,date) VALUES('$email','$status','$date')");
      }


      getprevious($mysqli);
    }

  }


  function getTitles($mysqli) {
    $allTitle = $mysqli->query("SELECT * FROM mail_title ORDER BY sn DESC");
    $titles = [];
    if($allTitle->num_rows > 0) {
      $i = 0;
      while ($row = $allTitle->fetch_assoc()) {
        $titles[$i] = $row;
        $i++;
      }
    }

    echo json_encode($titles);
  }


  if(isset($_POST["title"])) {
    $title = $_POST["title"];
    $date = date("d-m-Y h:i:s");
    $addTitle = $mysqli->query("INSERT INTO mail_title(title,date) VALUES('$title','$date')");

    if($addTitle) {
      getTitles($mysqli);
    } else {
      echo "failed";
    }
  }

  if(isset($_GET["title"])) {
    getTitles($mysqli);
  }

  if(isset($_GET["remove"])) {
    $sn = $_GET["remove"];

    $delete = $mysqli->query("DELETE FROM mail_title WHERE sn = '$sn'");
    if($delete) {
      getTitles($mysqli);
    }
  }

  if(isset($_GET["status"])) {
    $status = $_GET["status"];

    $get = $mysqli->query("SELECT * FROM mail_status WHERE status = '$status' ORDER BY sn DESC");
    if($get->num_rows > 0) {
      $i = 0; $data = [];
      while($row = $get->fetch_assoc()) {
        $data[$i] = $row;
        $i++;
      }
      echo json_encode($data);
    } else {
      $get = $mysqli->query("SELECT * FROM mail_status ORDER BY sn DESC");
      if($get->num_rows > 0) {
      $i = 0; $data = [];
      while($row = $get->fetch_assoc()) {
        $data[$i] = $row;
        $i++;
      }
      echo json_encode($data);
    } 
  }
}
?>