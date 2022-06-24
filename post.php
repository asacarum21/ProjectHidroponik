<?php
    require_once('helper.php');
    

        $conn = new mysqli('localhost', 'root', '','mydb');
        if ($conn->connect_error) {
            die("Connection failed: ". $conn->connect_error);
        }

        //Get current date and time
        date_default_timezone_set('Asia/Jakarta');
       
        $d = date("Y-m-d");
        //echo " Date:".$d."<BR>";
        $t = date("H:i:s");
        $sensor1 = data_post('status1');
        $sensor2 = data_post('status2');
        $sql = "INSERT INTO alat (Sensor1,Sensor2,Date, TIme)
		
		VALUES ('".$sensor1."','".$sensor2."','".$d."', '".$t."')";
        $data = [$sensor1,$sensor2];
		if ($conn->query($sql) === TRUE) {
		    echo "OK";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
        
        $conn->close();
        output('ok', '',$data);




?>


