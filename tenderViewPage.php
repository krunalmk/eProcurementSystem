<?php
    session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script>

        function displayOpenTenders( responseInJSON){
            var chosencategory = document.getElementsByName("chosencategory");
            var chosencategoryValue = displayRadioValue( chosencategory);
            var txt = "";
            txt += "<form id='applyfortender' name='applyfortender' method='POST' action='./apply_for_tender_api.php'><table>";
            txt += "<tr><th><font class='f2'>Tender ID</font></th><th><font class='f2'>Reference</font></th><th><font class='f2'>Posted company ID</font></th><th><font class='f2'>Contract title</font></th><th><font class='f2'>Date due</font></th><th><font class='f2'>Date invited</font></th><th><font class='f2'>Description</font></th><th><font class='f2'>Conditions</font></th><th><font class='f2'>Estimated time</font></th><th><font class='f2'>Apply now</font></th></tr>";
            for (x in responseInJSON) {
                if( responseInJSON[x].open_close){
                    txt += "<tr><td><font class='f2'>" + responseInJSON[x].tender_id + 
                            "</font></td><td><font class='f2'>" + responseInJSON[x].reference +
                            "</font></td><td><font class='f2'>" + responseInJSON[x].comp_id_owner +
                            "</font></td><td><font class='f2'>" + responseInJSON[x].contracttitle +
                            "</font></td><td><font class='f2'>" + responseInJSON[x].date_due +
                            "</font></td><td><font class='f2'>" + responseInJSON[x].date_invited +
                            "</font></td><td><font class='f2'>" + responseInJSON[x].description +
                            "</font></td><td><font class='f2'>" + responseInJSON[x].conditions +
                            "</font></td><td><font class='f2'>" + responseInJSON[x].estimated_time +
                            // "</td><td>" + responseInJSON[x].agreement_value +
                            "</td><td>" +
                            "<input name='whyiamspecial' id='whyiamspecial' placeholder='Why you must get this tender'>"+ 
                            "<input type='number' name='comp_estimate' id='comp_estimate' placeholder='Enter your estimate amount'>"+ "<input type = 'submit' value ='Apply'>" +
                            "</td>";
                }
            }
            txt += "<input type='hidden' id='tender_id' value='"+ responseInJSON[x].tender_id + "' name = 'tender_id' >";
            txt += "<input type='hidden' id='company_id' value='"+ "<?=$_SESSION['company_id'];?>" + "' name = 'company_id' >";
            txt += "<input type='hidden' id='chosencategory' value='"+ chosencategoryValue + "' name = 'chosencategory' >";
            txt += "<input type='hidden' id='reference' value='"+ responseInJSON[x].reference + "' name = 'reference' >";
            txt += "<input type='hidden' id='contracttitle' value='"+ responseInJSON[x].contracttitle + "' name = 'contracttitle' >";
            txt += "<input type='hidden' id='date_due' value='"+ responseInJSON[x].date_due + "' name = 'date_due' >";
            txt += "<input type='hidden' id='date_invited' value='"+ responseInJSON[x].date_invited + "' name = 'date_invited' >";
            txt += "<input type='hidden' id='description' value='"+ responseInJSON[x].description + "' name = 'description' >";
            txt += "<input type='hidden' id='agreement_value' value ='"+ responseInJSON[x].agreement_value + "' name = 'agreement_value' >";
            txt += "<input type='hidden' id='conditions' value='"+ responseInJSON[x].conditions + "' name = 'conditions' >";
            txt += "<input type='hidden' id='estimated_time' value='"+ responseInJSON[x].estimated_time + "' name = 'estimated_time' >";
            txt += "<input type='hidden' id='comp_id_owner' value='"+ responseInJSON[x].comp_id_owner + "' name = 'comp_id_owner' >";
            txt += "</table></form>";
            return txt;
        }

        function displayCloseTenders( responseInJSON){
            var chosencategory = document.getElementsByName("chosencategory");
            var chosencategoryValue = displayRadioValue( chosencategory);
            var txt = "";
            txt += "<form id='applyfortender' name='applyfortender' method='POST' action='./apply_for_tender_api.php'><table border='1'>";
            txt += "<tr><th><font class='f2'>Tender ID</font></th><th><font class='f2'>Reference</font></th><th><font class='f2'>Posted company ID</font></th><th><font class='f2'>Contract title</font></th><th><font class='f2'>Date due</font></th><th><font class='f2'>Date invited</font></th><th><font class='f2'>Description</font></th><th><font class='f2'>Conditions</font></th><th><font class='f2'>Estimated time</font></th></tr>";
            for (x in responseInJSON) {
                if( !responseInJSON[x].open_close){
                    txt += "<tr><td><font class='f2'>" + responseInJSON[x].tender_id + 
                            "</font></td><td><font class='f2'>" + responseInJSON[x].reference +
                            "</font></td><td><font class='f2'>" + responseInJSON[x].comp_id_owner +
                            "</font></td><td><font class='f2'>" + responseInJSON[x].contracttitle +
                            "</font></td><td><font class='f2'>" + responseInJSON[x].date_due +
                            "</font></td><td><font class='f2'>" + responseInJSON[x].date_invited +
                            "</font></td><td><font class='f2'>" + responseInJSON[x].description +
                            "</font></td><td><font class='f2'>" + responseInJSON[x].conditions +
                            "</font></td><td><font class='f2'>" + responseInJSON[x].estimated_time +
                            // "</td><td>" + responseInJSON[x].agreement_value +
                            "</td><td>" +
                            "<input name='whyiamspecial' id='whyiamspecial' placeholder='Why you must get this tender'>"+ "<input type = 'submit' value ='Apply'>" +
                            "</td>";
                }
            }
            return txt;
        }
        
        
        


        function displayRadioValue( ele) {
            for(i = 0; i < ele.length; i++) {
                if(ele[i].checked){
                    return ele[i].value;
                }
            }
            return null;
        }

        async function handleOnClick(event) {
            var chosencategory = document.getElementsByName("chosencategory");
            var openStatus = document.getElementsByName("openstatus");
            var chosencategoryValue = displayRadioValue( chosencategory);
            console.log( chosencategoryValue);
            
            if( chosencategory != null){
                var response = await fetch("./display_tenders_categorywise_api.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "chosencategory="+chosencategoryValue 
                });
                
                var response = await response.text();
                var responseInJSON = JSON.parse(response);
                if( openStatus[0].checked ){
                    document.getElementById("info").innerHTML = "";
                    document.getElementById("info").innerHTML = displayOpenTenders( responseInJSON);
                }
                else{
                    document.getElementById("info").innerHTML = "";
                    document.getElementById("info").innerHTML = displayCloseTenders( responseInJSON);
                }
            }
            else{
                document.getElementById("info").innerHTML = "Fields cannot be empty";
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
.big{
	width: 20px; height: 20px;
}

.navbar {
  overflow: hidden;
  background-color: #2874A6;
  position: fixed; 
  top: 0; 
  width: 100%; 
  text-align: center;
}
.navbar a {
  float: left;
  font-size: 30px;
  color: white;
  display: inline-block;
  text-align:center;
  padding: 20px 16px;
  text-decoration: none;
  
}


.navbar a:hover{
  background-color: #ffffff;
  color: #2874A6;
}
table,th,td{
border: 2px solid #2874A6;
}
.header img {
  float: left;
  width: 20%;
  height: 20%;
}

imgcontainer { float:left }
marquee { width:80% } 

    </style>
</head>
<body>
<div class="navbar">
<center>
  <a href="postTenderNoticePage.php">Set Tender Form</a>
  <a href="applicationStatusCheckPage.php">Application Status</a>
  <a href="profile.php">Profile</a>
  <a href="mod4.php">Set Tender Status</a>
  <a href="logout.php">Logout</a>
  </center>
</div><br><br>
<div class="header">
  <div id="imgcontainer">
  <img src="img/logo.jpeg"/>
  </div><br><br><br>
  <marquee>
    <font class="f1">Welcome to E-Procure !</font>
  </marquee>
</div>
<br><br><br><br><br><br>
<div class="container">
    <center><font class="f3">Select Category :</font><br><br><br>
    <div align="center" class = "categoryfilter">
        <input class="big" type = "radio" name="chosencategory" value = "Textile"><font class="f3"> Textile</font>
        <input class="big" type = "radio" name="chosencategory" value = "Logistics"> <font class="f3">Logistics</font>
        <input class="big" type = "radio" name="chosencategory" value = "Hospitality"><font class="f3"> Hospitality</font>
        <input class="big" type = "radio" name="chosencategory" value = "Carpentry"><font class="f3"> Carpentry</font>
    </div>
    <br><br>
    <button class="button" onclick="handleOnClick()"> SUBMIT </button><br><br>

    <div>
        <input class="big" type = "radio" name="openstatus" value = "Open" checked><font class="f3"> Open</font>
        <input class="big" type = "radio" name="openstatus" value = "Close"> <font class="f3">Close</font><br><br>
        <button class="button" onclick="handleOnClick()">SUBMIT</button>
    </div>
   </div>
<br><br><br>
    <div>
        <div id="allotedtenders">
           
                <center><font class="f1"></font></center>
            
        </div>
    </center>
        <div id="info"></div>
    </div>
</body>
</html>
