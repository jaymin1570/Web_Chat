<?php

$roomname = $_GET['roomname'];

include 'db_connect.php';

$sql = "SELECT * FROM `rooms` WHERE roomname = '$roomname' ";
$result = mysqli_query($conn, $sql);
if ($result) {
    if (mysqli_num_rows($result) == 0) {
        $message = "This room does not exist. Try creating a new room.";
        echo '<script language="javascript">';
        echo "alert('$message');";
        echo 'window.location="http://localhost/chatroom";';
        echo '</script>';
    }
} else {
    echo "Error:" . mysqli_error($conn);
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/product.css" rel="stylesheet">
    <style>
        body {
            margin: 0 auto;
            max-width: 800px;
            padding: 0 20px;
        }

        .container {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
        }

        .darker {
            border-color: #ccc;
            background-color: #ddd;
        }

        .container::after {
            content: "";
            clear: both;
            display: table;
        }

        .container img {
            float: left;
            max-width: 60px;
            max-height: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        .container img.right {
            float: right;
            margin-left: 20px;
            margin-right: 0;
        }

        .time-right {
            float: right;
            color: #aaa;
        }

        .time-left {
            float: left;
            color: #999;
        }

        .anyclass {
            height: 350px;
            overflow-y: scroll;
        }
    </style>
</head>

<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal">Jamu1570Chat.com</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="#">Home</a>
            <a class="p-2 text-dark" href="#">About</a>
            <a class="p-2 text-dark" href="#">Contact</a>

        </nav>

    </div>


    <h2>Chat Messages : <?php echo "$roomname";  ?></h2>

    <div class="container">
        <div class="anyclass">
            <!-- <div class="container">
                <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
                <p>Hello. How are you today?</p>
                <span class="time-right">11:00</span>
            </div>

            <div class="container darker">
                <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
                <p>Hey! I'm fine. Thanks for asking!</p>
                <span class="time-left">11:01</span>
            </div> -->



        </div>
    </div>


    <div class="form-group">
        <input type="text" name="usermsg" id="usermsg" class="form-control " placeholder="Type a Message"><br>
        <button class="btn btn-success" name="submitmsg" id="submitmsg">Send</button>
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script type="text/javascript">

        setInterval(runFunction,1000);
        function runFunction(){
            $.post("htcont.php",{room:'<?php echo $roomname ?>'},
            function(data,status){
                document.getElementsByClassName('anyclass')[0].innerHTML = data;
            }
            )
        }



        // Get the input field
        var input = document.getElementById("usermsg");

        // Execute a function when the user releases a key on the keyboard
        input.addEventListener("keyup", function(event) {
            // Number 13 is the "Enter" key on the keyboard
            if (event.keyCode === 13) {
                // Cancel the default action, if needed
                event.preventDefault();
                // Trigger the button element with a click
                document.getElementById("submitmsg").click();
            }
        });



        $("#submitmsg").click(function() {
            var clientmsg = $('#usermsg').val();
            $.post("postmsg.php", {
                    text: clientmsg,
                    room: '<?php echo $roomname ?>',
                    ip: '<?php echo $_SERVER['REMOTE_ADDR'] ?>'
                },
                function(data, status) {
                    document.getElementsByClassName('anyclass')[0].innerHTML = data;
                });
            $("#usermsg").val('');
            return false;
        });
    </script>
</body>

</html>