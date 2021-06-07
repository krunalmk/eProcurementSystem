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
            var mgr = '<?=$_SESSION["mgr_id"];?>';
            var name = '<?=$_SESSION["name"];?>';
            var pass = '<?=$_SESSION["password"];?>';
            var comp = '<?=$_SESSION["company_id"];?>';
            
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
                console.log(response);
                response="<table border='1px' cellspacing='10' cellpadding='10'><tr><td>Email</td><td>Mgr_id</td><td>Name</td><td>Password</td><td>Company_id</td></tr>";
                response+="<tr><td>"+email+"</td><td>"+mgr+"</td><td>"+name+"</td><td>"+pass+"</td><td>"+comp+"</td></tr></table>";
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
    
<style>
.f1 
{
	font-size: 40px;
	color: #2874A6;
	font-weight:bold;
	text-decoration:underline;
}

.f2 
{
	font-size: 20px;
	color: #2874A6;
	font-weight:bold;
}

.f3 
{
	font-size: 30px;
	color: #2874A6;
	font-weight:bold;
	text-decoration:none;
}

input 
{
	background-color: #FFFFFF;
	color: #2874A6;
	border: 1px solid #2874A6;
	padding: 15px;
	text-align: left;
	font-size: 20px;
	border-radius: 5px;
}

.button 
{
	background-color: #FFFFFF;
	color: #2874A6;
	border: 2px solid #2874A6;
	padding: 15px 32px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 25px;
	border-radius: 15px;
	width:20%;
	height:90px;
}
.button:hover 
{
	background-color: #2874A6;
	color: white;
	padding: 15px 32px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 25px;
	border-radius: 15px;
}

.button1
{
	background-color: #FFFFFF;
	color: #2874A6;
	border: 2px solid #2874A6;
	text-align: center;
	text-decoration: none;
	
	font-size: 15px;
	border-radius: 15px;
	width:30%;
	height:50px;
}
.button1:hover 
{
	background-color: #2874A6;
	color: white;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 15px;
	border-radius: 15px;
}

.button3
{
	background-color: #FFFFFF;
	color: #2874A6;
	border: 2px solid #2874A6;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 25px;
	border-radius: 15px;
	width: 10%;
	height: 7%;
}
.button3:hover 
{
	background-color: #2874A6;
	color: white;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 25px;
	border-radius: 15px;
	width: 10%;
	height: 7%;
}

.role 
{
	height:60%;
	width:70%;
}

.role:hover 
{
	border-radius: 50%;
	box-shadow: 0 0 2px 1px;
}
.container 
{
    width:95%;
    height:500px;
    margin:0 auto;
    padding:10px 35px;
    border:5px solid #3090C7;
    background:#CEECF5; 
}

hr
{
	border:5px solid #3090C7;
	
}
table,
th,
td{
	position:center;
	border-spacing: 0 20px;
	
}


		
		</style>
</head>
<body>
	<button onclick="window.location='tenderViewPage.php'" class="button3">Back</button>
    <center><font class="f1">User Profile</font></center>
    <br><br><br>
    <center><button class="button" id = "userinfobutton" onclick="getUserInfo(event);">show info</button></center>
    <br>
    <div class="f3" align="center" id = "userinfo"></div>
    <center>
    <div class="container">
    <table width="60%" align="center"><br><br>
    <tr><td></td><td></td><td></td></tr><tr>
    <form id = "password_edit" name="password_edit" onsubmit = "formOperation1(event);" method="POST">
    <td>
        <label class="f3" for = "password">Password</label></td><td colspan="2">
        <input type = "text" id = "password" name = "password">
        <input class="button1" type="submit" value = "Change"></td>
    </form></tr>
    <tr><td>
    <form id = "phone_edit" name="phone_edit" onsubmit = "formOperation2(event);" method="POST">
        <label class="f3" for = "phone">Phone number</label></td><td colspan="2">
        <input type = "text" id = "phone" name = "phone" >
        <input class="button1" type="submit" value = "Change"></td>
    </form></tr>
    <tr><td>
    <form id = "email_edit" name="email_edit" onsubmit = "formOperation3(event);" method="POST">
        <label class="f3" for = "email">Email</label></td><td colspan="2">
        <input type = "email" id = "email" name = "email" >
        <input class="button1" type="submit" value = "Change"></td>
    </form></tr>
    </table>
    </div>
    <div class="f3" align="center" id = "info" ></div>
    <br>
    <button class="button" id = "userdelete" onclick="deleteUserInfo(event);">Delete my account</button></center>
</body>
</html>
