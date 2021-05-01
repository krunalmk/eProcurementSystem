<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <script>
        async function formOperation1(event){
            var password_edit = document.forms["password_edit"];
            var password = password_edit["password"].value;
            
            var postInfo = "password="+ password;
            if( password != null){
                var response = await fetch("./change_password_api.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: postInfo
                });
                
                var response = await response.text();
                console.log( response);
                document.getElementById("info").innerHTML = "Updated password";
            }
            else{
                document.getElementById("info").innerHTML = "Field cannot be empty";
            }
            event.preventDefault();
            return false;
        }

        async function formOperation2(event){
            var phone_edit = document.forms["phone_edit"];
            var phone = phone_edit["phone"].value;
            
            var postInfo = "phone="+ phone;
            if( phone != null){
                var response = await fetch("./change_phone_api.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: postInfo
                });
                
                var response = await response.text();
                console.log( response);
                document.getElementById("info").innerHTML = "Updated phone";
            }
            else{
                document.getElementById("info").innerHTML = "Field cannot be empty";
            }
            event.preventDefault();
            return false;
        }

        async function formOperation3(event){
            var email_edit = document.forms["email_edit"];
            var email = email_edit["email"].value;
            
            var postInfo = "email="+ email;
            if( email != null){
                var response = await fetch("./change_email_api.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: postInfo
                });
                
                var response = await response.text();
                console.log( response);
                document.getElementById("info").innerHTML = "Updated email";
            }
            else{
                document.getElementById("info").innerHTML = "Field cannot be empty";
            }
            event.preventDefault();
            return false;
        }

        async function getUserInfo(event){
            var email = '<?=$_SESSION["email"];?>';
            
            var postInfo = "email="+ email;
            if( email != null){
                var response = await fetch("./user_info_api.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: postInfo
                });
                
                var response = await response.text();
                console.log( response);
                document.getElementById("userinfo").innerHTML = response;
            }
            else{
                document.getElementById("userinfo").innerHTML = "Error";
            }
            event.preventDefault();
            return false;
        }

        async function deleteUserInfo(event){
            var email = '<?=$_SESSION["email"];?>';
            
            var postInfo = "email="+ email;
            if( email != null){
                var response = await fetch("./delete_profile_api.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: postInfo
                });
                
                var response = await response.text();
                console.log( response);
                document.getElementById("userinfo").innerHTML = response;
            }
            else{
                document.getElementById("userinfo").innerHTML = "Error";
            }
            event.preventDefault();
            return false;
        }
    </script>
</head>
<body>
    
    <button id = "userinfobutton" onclick="getUserInfo(event);">show info</button>
    <div id = "userinfo"></div>
    <form id = "password_edit" name="password_edit" onsubmit = "formOperation1(event);" method="POST">
        <label for = "password">Password</label>
        <input type = "text" id = "password" name = "password" >
        <input type="submit" value = "Change">
    </form>
    <form id = "phone_edit" name="phone_edit" onsubmit = "formOperation2(event);" method="POST">
        <label for = "phone">Phone number</label>
        <input type = "text" id = "phone" name = "phone" >
        <input type="submit" value = "Change">
    </form>
    <form id = "email_edit" name="email_edit" onsubmit = "formOperation3(event);" method="POST">
        <label for = "email">Email</label>
        <input type = "email" id = "email" name = "email" >
        <input type="submit" value = "Change">
    </form>
    <div id = "info" ></div>
    <button id = "userdelete" onclick="deleteUserInfo(event);">Delete my account</button>
</body>
</html>