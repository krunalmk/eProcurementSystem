<?php 
	SESSION_START();
?>
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
                
                if(responseInJSON.success){
                    alert("Logged In");
                    window.location = 'tenderViewPage.php';
                }
            }
            else{
   
                document.getElementById("logged").innerHTML = "<center><font class='f1'>Fields cannot be empty</font></center>";
            }
        }
    </script>
	
	<style>
		
.login 
{
	position:absolute;
	top:170px;
	left:270px;
	border: 1px;
	border-collapse: collapse;
	width:70%;
	height:50%;
	text-align:center;
	padding: 10px;
	background-color: #FFFFFF;
	table-layout: fixed;
}

.hp 
{
	margin-left:auto;
	margin-right:auto;
	border: 0px;
	border-collapse: collapse;
	width:60%;
	height:50%;
	padding: 10px;
	background-color: #FFFFFF;
	table-layout: fixed;
}

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
	font-size: 25px;
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
    width: 980px;
    margin:0 auto;
    padding:10px 35px;
    border:5px solid #3090C7;
    background:#CEECF5; 
}
.buttn {
	box-shadow:inset 0px 1px 0px 0px #CEECF5;
	background:linear-gradient(to bottom, #CEECF5 5%, #CEECF5 100%);
	background-color:#CEECF5;
	border-radius:6px;
	border:1px solid #84bbf3;
	display:inline-block;
	cursor:pointer;
	color:#CEECF5;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:5px 15px;
	text-decoration:none;
}
.buttn:hover {
	background:linear-gradient(to bottom, #80b5ea 5%, #bddbfa 100%);
	background-color:#CEECF5;
}
.buttn:active {
	position:relative;
	top:1px;
}
hr
{
	border:5px solid #3090C7;
	
}

		
		</style>
</head>
<body background="img/lb.jpg">
		<table class="login" width="70%">
		<tr>
			<td align="center" colspan=2><font class="f1">LOGIN</font></td>
		</tr>
		<tr>
			<td><font class="f3">EMAIL : </font></td>
			<td><input type = "text" id ="email" name = "email" placeholder="Enter Your Email" required></td>
		</tr>
		<tr>
			<td><font class="f3">PASSWORD : </font></td>
			<td><input type = "text" id ="password" name = "password" placeholder="Enter Your Password" required ></td>
		</tr>
		<tr>
			<td align="center" colspan="2" width=40%><button class="button" id="btn" onclick="handleOnClick()"> "SUBMIT"</button></td>
		</tr>
		</table>
		
        <div>
            <div id="logged"></div>
        </div>
</body>
</html>
