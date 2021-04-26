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
            txt += "<form id='applyfortender' name='applyfortender' method='POST' action='./apply_for_tender_api.php'><table border='1'>";
            txt += "<tr><th>Tender ID</th><th>Reference</th><th>Posted company ID</th><th>Contract title</th><th>Date due</th><th>Date invited</th><th>Description</th><th>Conditions</th><th>Estimated time</th><th>Agreement value ( in rs.)</th><th>Apply now</th></tr>";
            for (x in responseInJSON) {
                if( responseInJSON[x].open_close){
                    txt += "<tr><td>" + responseInJSON[x].tender_id + 
                            "</td><td>" + responseInJSON[x].reference +
                            "</td><td>" + responseInJSON[x].comp_id +
                            "</td><td>" + responseInJSON[x].contract_title +
                            "</td><td>" + responseInJSON[x].date_due +
                            "</td><td>" + responseInJSON[x].date_invited +
                            "</td><td>" + responseInJSON[x].description +
                            "</td><td>" + responseInJSON[x].conditions +
                            "</td><td>" + responseInJSON[x].estimated_time +
                            "</td><td>" + responseInJSON[x].agreement_value +
                            "</td><td>" +
                            "<input name='whyiamspecial' id='whyiamspecial' placeholder='Why you must get this tender'>"+ "<input type = 'submit' value ='Apply'>" +
                            "</td>";
                }
            }
            txt += "<input type='hidden' id='tender_id' value='"+ responseInJSON[x].tender_id + "' name = 'tender_id' >";
            txt += "<input type='hidden' id='company_id' value='"+ "<?=$_SESSION['company_id'];?>" + "' name = 'company_id' >";
            txt += "<input type='hidden' id='chosencategory' value='"+ chosencategoryValue + "' name = 'chosencategory' >";
            txt += "<input type='hidden' id='reference' value='"+ responseInJSON[x].reference + "' name = 'reference' >";
            txt += "<input type='hidden' id='contracttitle' value='"+ responseInJSON[x].contract_title + "' name = 'contracttitle' >";
            txt += "<input type='hidden' id='date_due' value='"+ responseInJSON[x].date_due + "' name = 'date_due' >";
            txt += "<input type='hidden' id='date_invited' value='"+ responseInJSON[x].date_invited + "' name = 'date_invited' >";
            txt += "<input type='hidden' id='description' value='"+ responseInJSON[x].description + "' name = 'description' >";
            txt += "<input type='hidden' id='agreement_value' value ='"+ responseInJSON[x].agreement_value + "' name = 'agreement_value' >";
            txt += "<input type='hidden' id='conditions' value='"+ responseInJSON[x].conditions + "' name = 'conditions' >";
            txt += "<input type='hidden' id='estimated_time' value='"+ responseInJSON[x].estimated_time + "' name = 'estimated_time' >";
            txt += "</table></form>";
            return txt;
        }

        function displayCloseTenders( responseInJSON){
            var txt = "";
            txt += "<table border='1'>";
            txt += "<tr><th>Tender ID</th><th>Reference</th><th>Posted company ID</th><th>Contract title</th><th>Date due</th><th>Date invited</th><th>Description</th><th>Conditions</th><th>Agreement value ( in rs.)</th></tr>";
            for (x in responseInJSON) {
                if( responseInJSON[x].open_close){
                    txt += "<tr><td>" + responseInJSON[x].tender_id + 
                            "</td><td>" + responseInJSON[x].reference +
                            "</td><td>" + responseInJSON[x].comp_id +
                            "</td><td>" + responseInJSON[x].contract_title +
                            "</td><td>" + responseInJSON[x].date_due +
                            "</td><td>" + responseInJSON[x].date_invited +
                            "</td><td>" + responseInJSON[x].description +
                            "</td><td>" + responseInJSON[x].conditions +
                            "</td><td>" + responseInJSON[x].agreement_value +
                            "</td></tr>";
                }
            }
            txt += "</table></form>";
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
</head>
<body>
    <div class = "categoryfilter">
        <input type = "radio" name="chosencategory" value = "Textile"> Textile
        <input type = "radio" name="chosencategory" value = "Logistics"> Logistics
        <input type = "radio" name="chosencategory" value = "Hospitality"> Hospitality
        <input type = "radio" name="chosencategory" value = "Carpentry"> Carpentry
    </div>
    <button onclick="handleOnClick()"> SUBMIT BOI</button>

    <div>
        <input type = "radio" name="openstatus" value = "Open" checked> Open
        <input type = "radio" name="openstatus" value = "Close"> Close
        <button onclick="handleOnClick()"> SUBMIT BOI</button>r
    </div>

    <div>
        <div id="info"></div>
    </div>
</body>
</html>
