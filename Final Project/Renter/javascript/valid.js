function msg_verify() {

    var x = document.getElementById("n_msg").value;

    var error=false;
    if (x=="") {

        error = true;

    } else if(x!="") {
       
        error = false;
    }
    if(!error) {
        document.getElementById("msgError").innerHTML="";
        return true;
    }
    else if(error){
        document.getElementById("msgError").innerHTML="Message cannot be empty";
        return false;
    }
}