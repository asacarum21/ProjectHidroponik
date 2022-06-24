<?php
    require_once('helper.php');
    

        $conn = new mysqli('localhost', 'root', '','mydb');
        if ($conn->connect_error) {
            die("Connection failed: ". $conn->connect_error);
        }

        $sql = "SELECT * FROM alat ORDER BY id DESC";
        $result = $conn->query($sql);

        $data = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = [
                    'id' => $row['id'],
                    'sensor1' => $row['Sensor1'],
                    'sensor2' => $row['Sensor2'],
                    'date' => $row['Date'],
                    'time' => $row['TIme']
                ];
            }
        } else {
            echo "0 result";
        }
        $conn->close();
        output('ok', '',$data);

?>