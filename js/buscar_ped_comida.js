function buscarPedComida() {
    var comida = document.getElementById("comida").value;
    if (comida == "") {
        document.getElementById("informacion1").innerHTML = "";
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                //alert("llegue");
                document.getElementById("informacion1").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "buscarPedCom.php?comida=" + comida, true);
        xmlhttp.send();
    }
    return false;
}