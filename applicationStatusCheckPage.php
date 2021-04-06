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
            txt += "<table border='1'>";
            txt += "<tr><th>Tender ID</th><th>Reference</th><th>Posted company ID</th><th>Contract title</th><th>Date due</th><th>Date invited</th><th>Description</th><th>Conditions</th><th>Agreement value ( in rs.)</th></tr>";
            for (x in responseInJSON) {
                if( responseInJSON[x].open_close){
                    txt += "<tr><td>" + responseInJSON[x].tender_id + 
                            "<td>" + responseInJSON[x].reference +
                            "<td>" + responseInJSON[x].comp_id +
                            "<td>" + responseInJSON[x].contract_title +
                            "<td>" + responseInJSON[x].date_due +
                            "<td>" + responseInJSON[x].date_invited +
                            "<td>" + responseInJSON[x].description +
                            "<td>" + responseInJSON[x].conditions +
                            "<td>" + responseInJSON[x].agreement_value +
                            "</td></tr>";
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
                body: null
            });
            
            var response = await response.text();
            var responseInJSON = JSON.parse(response);

            document.getElementById("info").innerHTML = displayOpenTenders( responseInJSON);
        }
    </script>
</head>
<body>
    <button onclick="handleOnClick()"> SUBMIT BOI</button>

    <div>
        <div id="info"></div>
    </div>
</body>
</html>