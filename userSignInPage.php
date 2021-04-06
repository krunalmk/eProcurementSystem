<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script>
        async function handleOnClick(event) {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            if( email != null && password != null){
                var response = await fetch("./sign_in_api.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "email="+email+ "&password="+ password
                });
                
                var response = await response.text();
                var responseInJSON = JSON.parse(response);
                document.getElementById("logged").innerHTML = response;
                
                if( responseInJSON.success){
                    alert("Logged in");
                }
            }
            else{
                document.getElementById("logged").innerHTML = "Fields cannot be empty";
            }
        }
    </script>
</head>
<body>
        <input type = "text" id ="email" name = "email">
        <input type = "text" id ="password" name = "password">
        <button onclick="handleOnClick()"> "SUBMIT BOI"</button>
        <div>
            <div id="logged"></div>
        </div>
</body>
</html>