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
</head>
<body>
    <form id = "tendersetform" name = "tendersetform" onsubmit="formOperation(event); return false;">
        <label for = "inputcategory">Category</label>
        <!-- <input id = "inputcategory" name="inputcategory"> -->
        <select id = "inputcategory" name="inputcategory">
            <option value="Textile">Textile</option>
            <option value="Hospitality">Hospitality</option>
            <option value="Logistics">Logistics</option>
            <option value="Carpentry">Carpentry</option>
            <option value="ABC">ABC</option>
        </select>
        <label for = "contracttitle">contracttitle</label>
        <input type = "text" id = "contracttitle" name = "contracttitle" >
        <label for = "description">description</label>
        <input type = "text" id = "description" name = "description" >
        <label for = "reference">reference</label>
        <input type = "text" id = "reference" name = "reference" >
        <label for = "estimatedtime">estimatedtime ( in days)</label>
        <input type = "number" id = "estimatedtime" name = "estimatedtime" >
        <label for = "agreementvalue">agreementvalue</label>
        <input type = "number" id = "agreementvalue" name = "agreementvalue" >
        <label for = "dateinvited">dateinvited</label>
        <input type = "date" id = "dateinvited" name = "dateinvited" >
        <label for = "datedue">datedue</label>
        <input type = "date" id = "datedue" name = "datedue" >
        <label for = "conditions">conditions</label>
        <textarea type = "date" id = "conditions" name = "conditions" ></textarea>
        <input type = "submit" value="submit">
    </form>
</body>
</html>
