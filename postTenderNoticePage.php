
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function getCategoryRadioValue( ele) {
            for(i = 0; i < ele.length; i++) {
                if(ele[i].checked){
                    return ele[i].value;
                }
            }
            return null;
        }
        async function formOperation(event){
            var tenderForm = document.forms["tendersetform"];
            var chosencategory = tenderForm["inputcategory"].value;//('input[name="inputcategory"]:checked').value;
            var contracttitle = tenderForm["contracttitle"].value;
            var description = tenderForm["description"].value;
            var reference = tenderForm["reference"].value;
            var estimatedtime = tenderForm["estimatedtime"].value;
            var agreementvalue = tenderForm["agreementvalue"].value;
            var dateinvited = tenderForm["dateinvited"].value;
            var datedue = tenderForm["datedue"].value;
            var conditions = tenderForm["conditions"].value;
            
            var postInfo = "inputcategory="+ chosencategory + "&contracttitle="+ contracttitle+ "&description="+ description+ "&reference="+ reference+ "&estimatedtime="+ estimatedtime+ 
                            "&agreementvalue="+ agreementvalue+ "&dateinvited="+ dateinvited+ "&datedue="+ datedue+ "&conditions="+ conditions;
            
            if( chosencategory != null){
                var response = await fetch("./tender_form_set_api.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: postInfo
                });
                
                var response = await response.text();
                console.log( response);
            }
            else{
                document.getElementById("info").innerHTML = "Fields cannot be empty";
            }
            event.preventDefault();
            return false;
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
	width:60%;
	height:50%;
	text-align:center;
	padding: 10px;
	background-color: #FFFFFF;
	table-layout: fixed;
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

input,textarea
{
	background-color: #FFFFFF;
	color: #2874A6;
	border: 1px solid #2874A6;
	padding: 15px;
	text-align: left;
	font-size: 25px;
	border-radius: 5px;
}
select
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
	width:980px;
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
	padding: 10px;
	
}


		
		</style>
</head>
<body>
    <button onclick="window.location='tenderViewPage.php'" class="button1">Back</button><br><br>
    <center><font class="f1">Set Tender</font></center><br><br><br>
    <form id = "tendersetform" name = "tendersetform" onsubmit="formOperation(event); return false;">
    	<div class="container">
    	<table align = "center">
    	<tr>
        <td><label class="f3" for = "inputcategory">Category</label></td>
        <!-- <input id = "inputcategory" name="inputcategory"> -->
        <td colspan=2 ><select id = "inputcategory" name="inputcategory">
            <option value="Textile">Textile</option>
            <option value="Hospitality">Hospitality</option>
            <option value="Logistics">Logistics</option>
            <option value="Carpentry">Carpentry</option>
            <option value="ABC">ABC</option>
        </select></td></tr>
        <tr>
        <td><label class="f3" for = "contracttitle">Contract Title :</label></td>
        <td><input type = "text" id = "contracttitle" name = "contracttitle" ></td>
        </tr>
        <tr>
        <td><label class="f3" for = "description">Description :</label></td>
        <td><input type = "text" id = "description" name = "description"></td>
        <tr>
        <td><label class="f3" for = "reference">Reference :</label></td>
        <td><input type = "text" id = "reference" name = "reference"></td>
        </tr>
        <tr>
        <td><label class="f3" for = "estimatedtime">Estimated Time (in days) :</label></td>
        <td><input type = "number" id = "estimatedtime" name = "estimatedtime"></td>
        </tr>
        <tr>
        <td><label class="f3" for = "agreementvalue">Agreement Value :</label></td>
        <td><input type = "number" id = "agreementvalue" name = "agreementvalue"></td>
        </tr>
        <tr>
        <td><label class="f3" for = "dateinvited">Date Invited :</label></td>
        <td><input type = "date" id = "dateinvited" name = "dateinvited"></td>
        </tr>
        <tr>
        <td><label class="f3" for = "datedue">Due Date :</label></td>
        <td><input type = "date" id = "datedue" name = "datedue"></td>
        </tr>
        <tr>
        <td><label class="f3" for = "conditions">Conditions :</label></td>
        <td><textarea type = "date" id = "conditions" name = "conditions" ></textarea></td>
        </tr>
        <tr>
        <td align='center' colspan=2><input class="button" type = "submit" value="submit"></td>
        </tr>
        </div>
    </form>
</body>
</html>
