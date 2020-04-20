<?php
    $room = $_POST['room'];

    if(strlen($room)>20 or strlen($room)<2){
        $message = "please choose name between 2 and 20 characters.....";
        echo '<script language="javascript">';
        echo "alert('$message');";
        echo 'window.location="http://localhost/chatroom";';
        echo '</script>';
    }
    else if(!ctype_alnum($room)){
        $message = "please choose an alphanumeric name...";
        echo '<script language="javascript">';
        echo "alert('$message');";
        echo 'window.location="http://localhost/chatroom";';
        echo '</script>';
    }
    else{
        // echo "connected to database";
        include 'db_connect.php';
    }
    // echo "Lets, chat now..."
    // check room has already created...
    $sql = "SELECT * FROM `rooms` WHERE roomname = '$room' ";
    $result = mysqli_query($conn,$sql);
    if($result){
        if(mysqli_num_rows($result) > 0){
            $message = "please choose a diffrent name. This name is already claimed...!";
            echo '<script language="javascript">';
            echo "alert('$message');";
            echo 'window.location="http://localhost/chatroom";';
            echo '</script>';
        }
        else{
        
            $sql = "INSERT INTO `rooms` (`roomname`, `stime`) VALUES ('$room', current_timestamp());";
            if(mysqli_query($conn,$sql)){
                $message = "Your room is ready and chat now..!";
                echo '<script language="javascript">';
                echo "alert('$message');";
                echo 'window.location="http://localhost/chatroom/rooms.php?roomname=' . $room .'";';
                echo '</script>';
            }
           
        }
        
    }
    else{
        echo "Error:". mysqli_error($conn);
    }
?>