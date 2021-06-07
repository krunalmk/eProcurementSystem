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
            var txt = "";
            txt += "<br><br><br><font class='f1'>Remaining Tenders :</font><br><br><br><table>";
            txt += "<tr><th><font class='f3'>Tender ID</font></th><th><font class='f3'>Reference</font></th><th><font class='f3'>Posted company ID</font></th><th><font class='f3'>Contract title</font></th><th><font class='f3'>Date due</font></th><th><font class='f3'>Date invited</font></th><th><font class='f3'>Description</font></th><th><font class='f3'>Conditions</font></th><th><font class='f3'>Agreement value ( in rs.)</font></th><th><font class='f3'>Why I must get this contract</font></th></tr>";
            for (x in responseInJSON) {
                if( responseInJSON[x].open_close){
                    txt += "<tr><td><font class='f3'>" + responseInJSON[x].tender_id + 
                            "</font></td><td><font class='f3'>" + responseInJSON[x].reference +
                            "</font></td><td><font class='f3'>" + responseInJSON[x].comp_id_owner +
                            "</font></td><td><font class='f3'>" + responseInJSON[x].contracttitle +
                            "</font></td><td><font class='f3'>" + responseInJSON[x].date_due +
                            "</font></td><td><font class='f3'>" + responseInJSON[x].date_invited +
                            "</font></td><td><font class='f3'>" + responseInJSON[x].description +
                            "</font></td><td><font class='f3'>" + responseInJSON[x].conditions +
                            "</font></td><td><font class='f3'>" + responseInJSON[x].agreement_value +
                            "</font></td><td><font class='f3'>" + responseInJSON[x].whyiamspecial +
                            "</font></td></tr>";
                }
            }
            txt += "</table>";
            return txt;
        }
        
        function displayAllotedTenders( responseInJSON){
            var chosencategory = document.getElementsByName("chosencategory");
            var chosencategoryValue = displayRadioValue( chosencategory);
            var txt = "";
            txt += "<font class='f1'>Alloted Tenders :</font><br><br><br><table border='1'>";
            txt += "<tr><th><font class='f3'>Tender ID</font></th><th><font class='f3'>Reference</font></th><th><font class='f3'>Posted company ID</font></th><th><font class='f3'>Contract title</font></th><th><font class='f3'>Date due</font></th><th><font class='f3'>Date invited</font></th><th><font class='f3'>Description</font></th><th><font class='f3'>Conditions</font></th><th><font class='f3'>Estimated time</font></th></tr>";
            for (x in responseInJSON) {
                if( responseInJSON[x].open_close == 2){
                    txt += "<tr><td><font class='f3'>" + responseInJSON[x].tender_id + 
                            "</font></td><td><font class='f3'>" + responseInJSON[x].reference +
                            "</font></td><td><font class='f3'>" + responseInJSON[x].comp_id_owner +
                            "</font></td><td><font class='f3'>" + responseInJSON[x].contracttitle +
                            "</font></td><td><font class='f3'>" + responseInJSON[x].date_due +
                            "</font></td><td><font class='f3'>" + responseInJSON[x].date_invited +
                            "</font></td><td><font class='f3'>" + responseInJSON[x].description +
                            "</font></td><td><font class='f3'>" + responseInJSON[x].conditions +
                            "</font></td><td><font class='f3'>" + responseInJSON[x].estimated_time +
                            // "</td><td>" + responseInJSON[x].agreement_value +
                            "</font></td><td>";
                }
            }
            txt += "</table>";
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
            var response = await fetch("./application_status_check_api.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "company_id="+ "<?=$_SESSION['company_id'];?>"
            });
            
            var response = await response.text();
            var responseInJSON = JSON.parse(response);

            document.getElementById("info").innerHTML = displayOpenTenders( responseInJSON);
            document.getElementById("allotedtenders").innerHTML = displayAllotedTenders( responseInJSON);
        }
    </script>
      <style>

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



.button 
{
	background-color: #FFFFFF;
	color: #2874A6;
	border: 2px solid #2874A6;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 25px;
	border-radius: 15px;
	width: 30%;
	height: 7%;
}
.button:hover 
{
	background-color: #2874A6;
	color: white;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 25px;
	border-radius: 15px;
	width: 30%;
	height: 7%;
}
.button1 
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
.button1:hover 
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
    width:50%;
    margin:0 auto;
    padding:10px 35px;
    border:5px solid #3090C7;
    background:#CEECF5; 
}
hr
{
	border:5px solid #3090C7;
	
}
input 
{
	background-color: #FFFFFF;
	color: #2874A6;
	border: 1px solid #2874A6;
	padding: 15px;
	text-align: left;
	font-size: 15px;
	border-radius: 5px;
}
table,
th,
td{
	padding: 10px;
	border: 1px solid #2874A6 ;
	border-collapse: collapse;
}
</style>
</head>
<body>
    <button onclick="window.location='tenderViewPage.php'" class="button1">Back</button>
    <center><font class="f1">Application Status Check </font><br><br><br><br>
    <div class="container">
    <font class="f3"> Click to check status : </font><br><br>
    <button class="button" onclick="handleOnClick()"> SUBMIT</button>
</div>
    <br><br><br><br>
    <div>
        <div id="allotedtenders">
            <font class="f1">
                
            </font>
        </div>
        <div id="info"></div>
    </div>
</body>
</html>
