<?php
$name = $email =$un=$gender=$pass=$Cpass=$dob=$nid="";
    
    $UploadConfirmation = "";
    $target_file="";
$nameErr =$emailErr=$unErr=$genderErr=$passErr=$CpassErr=$dobErr=$pictureErr=$ImgErr=$nidErr="";
$nameError = $nidError= $passError=$cpassError= $emailError=$genderError=$dobError="";
$text="";
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if(isset($_POST["submit"]))
{
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $nid =  test_input($_POST["nid"]);
    $pass = $_POST["pass"];
    $Cpass = $_POST["Cpass"];
    if(!empty($_POST["gender"]))
    {
        $gender=$_POST["gender"];
    }
    else{
        $gender="";
    }
    if(!empty($_POST["dob"])){
        $dob=$_POST["dob"];
    }
     $data= array(
        'name'=> $_POST["name"],
        'email'=>$_POST["email"],
        'nid'=>$_POST["nid"],
        'pass'=>$_POST["pass"],
        'Cpass'=>$_POST["Cpass"],
        'dob'=>$_POST["dob"],
        'gender'=>$_POST["gender"]
    );
    require_once "../controller/renterform.php";
    $renterhome= new renters($data);

    $renterhome->addData($data);

    $error=$renterhome->get_error();
    $text=$renterhome->get_text();

    echo "Here";

    $nameErr=$error["nameError"];
    
    $emailErr=$error["emailError"];
    
    $nidErr=$error["nidError"];
    
    $passErr=$error["passError"];
     
    $CpassErr=$error["cpassError"];
    
    $genderErr=$error["genderError"];
    
    $dobErr=$error["dobError"];

}

?>

<!DOCTYPE html>
<html>
<title>Renter Registration</title>
<!--Importing bootstrap 5-->
<link rel="shortcut icon" href="../images/logo-home.ico">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/registration_styles.css">

<body class="bd">
<div class="container-sm mb-6 mt-3 bg-light shadow" style="background: linear-gradient(to right, #e0eafc, #cfdef3);">
    <div>
    <h1 style="font-family: 'Acme', sans-serif; color:#396afc;">Renter Registration Form</h1>
    <h4 style="color:red; font-family: 'Satisfy', cursive;">Please Fill it with correct informations</h4>
</div>

    <div class="form-group">
    <form method="POST" class="row g-3" onsubmit="return formvalidation()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <div class="col-md-6">
        <label class="form-label">Name</label>
        <input type="text" name="name" id="name" placeholder="Full Name"onkeyup="return nameverification()" onblur="return nameverification()"  class="form-control" data-toggle="tooltip" data-placement="top" title="">
        <span id="nameError" style="color: red;"><?php
        if ($nameError != "") {
        echo "* - " . $nameError;
        }
        ?>
        </span><br>
        </div>
        <div class="col-md-6">
        <label class="form-label">National ID</label>
        <input type="text" name="nid" id="nid" placeholder="NID No." class="form-control"onkeyup="return nidVerification()" onblur="return nidVerification()" 
         data-toggle="tooltip" data-placement="top" title=""><span id="nidError" style="color: red;">
            <?php
        if ($nidError != "") {
        echo "* - " . $nidError;
        }
        ?>
        </span><br>
        </div>
        <div class="col-md-6">
        <label class="form-label">Password</label>
        <input type="password" name="pass" id="pas" onkeyup="return passVerification()" 
        onblur="return passVerification()"  placeholder="Password" class="form-control" data-toggle="tooltip" data-placement="top" title="" >
        <span id="passError" style="color: red;">
            <?php
        if ($passError != "") {
        echo "* - " . $passError;
        }
        ?></span>
        <br>
        <script>
            function myFunction() {
                var x = document.getElementById("pas");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
        <input type="checkbox" onclick="myFunction()" class="form-check-input"> Show Password <br>
        </div>
        <div class="col-md-6">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="Cpass" id="Cpass" onkeyup="return cpassVerification()" 
        onblur="return cpassVerification()" placeholder="Confirm Password" class="form-control"  data-toggle="tooltip" data-placement="top" 
        title="">
         <span id="cpassError" style="color: red;">
        <?php
         if ($cpassError != "") {
         echo "* - " . $cpassError;
         }
        ?></span><br>
        <script>
            function myFunction1() {
                var x = document.getElementById("Cpass");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
        <input type="checkbox" onclick="myFunction1()" class="form-check-input"> Show Password <br>
        </div>
        <div class="col-12">
        <label class="form-label">Email</label>
        <input type="text" name="email" id="email"onkeyup="return emailVerification()" onblur="return emailVerification()" placeholder="Email" class="form-control"
         data-toggle="tooltip" data-placement="top" title=""><span id="emailError" style="color: red;"><?php
         if ($emailError != "") {
         echo "* - " . $emailError;
         }
        ?></span>
        <br>
        </div>
        <label class="form-label">Gender</label>
        <div class="form-check form-check-inline">
        <input type="radio" id="m" name="gender" class="form-check-input" onclick="return genderVerification()" value="Male"> <label for="m" class="form-check-label">Male</label></div>
        <div class="form-check form-check-inline">
        <input type="radio" id="f" name="gender" class="form-check-input" onclick="return genderVerification()" value="Female"><label for="f" class="form-check-label">Female</label></div>
        <div class="form-check form-check-inline">
        <input type="radio" id="p" name="gender" class="form-check-input" onclick="return genderVerification()" value="Others"><label for="p" class="form-check-label">Prefer Not to Say</label></div>
        <span id="genderError" style="color: red;">
        <?php
        if ($genderError != "") {
        echo "* - " . $genderError;
        }
        ?></span>
        <div class="col-md-6">
        <label class="form-label">Date of birth&nbsp;</label>
        <input type="date" name="dob" id="dob" class="form-control">
        <span id="dobError" style="color: red;"><?php
         if ($dobError != "") {
         echo "* - " . $dobError;
         }
        ?></span>
        <br>
        </div>
        <div class="col-12">
        <input type="submit" name="submit" value="Submit" class="btn btn-success" style="background: linear-gradient(to right, #348f50, #56b4d3);">
        <a href="../../Login Module/view/homepage.php" class="btn btn-outline-dark" target="_self" class="button1"> Go to Homepage</a></div><br>
        <?php
        if ($text!="") {
            echo "<span style='color:green'>" . $text . "</span><br>";
        }
        ?>
    </form>
    </div><br>
    </div>
    <?php
    include 'footer.php';
    ?>
    <script type="text/javascript">
        
function formvalidation(){
    
    var x=document.getElementById("name").value;
    x= x.replace(/(^\s*)|(\s*$)/gi,"");
    x = x.replace(/[ ]{2,}/gi," ");
    x = x.replace(/\n /,"\n");
    var z=x.split(" ").length;
    var nameError="";
     var nidError="";
      var passError="";
      var cpassError="";
      var emailError="";
      var genderError="";
      var dobError="";
    if(x==""){
        document.getElementById("nameError").innerHTML="Name is required";
        nameError="Error";
    }
    else{
        if((/[A-Za-z]/.test(x[0]))==false){
            document.getElementById("nameError").innerHTML="Name must start with a letter";
            nameError="Error";
        }
        else if(z<2){
            document.getElementById("nameError").innerHTML="Name must contain at least two words";
            nameError="Error";
        }
         
        else{
            nameError="";
            document.getElementById("nameError").innerHTML="";
        }
    }
    
    var y=document.getElementById("nid").value;
    if(y==""){
        document.getElementById("nidError").innerHTML="NID is required";
        nidError="Error";
    }
    else{
        if(isNaN(y)==true){
            document.getElementById("nidError").innerHTML="NID can have numbers only";
            nidError="Error";
        }
        else if(y.length!=10){
            document.getElementById("nidError").innerHTML="NID must consist 10 digits only";
            nidError="Error";
        }
        else if (y != "") {
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function () {
        if (this.responseText == "true") {
          nidErr="Error";
          document.getElementById("nidError").innerHTML = "NID Already Exists";
        } else if (this.responseText == "false") {
          nidErr="";
          document.getElementById("nidError").innerHTML = "";
        }
      };
      xhttp.open("GET", "../controller/check_dup_nid.php?nid=" + y);
      xhttp.send();
    }
        else{
            nidError="";
            document.getElementById("nidError").innerHTML="";
        }
    }
    var pass=document.getElementById("pas").value;
    if(pass==""){
        document.getElementById("passError").innerHTML="Password is required";
        passError="Error";
    }
    else{
        if((/[a-z]+/.test(pass))==false){
        document.getElementById("passError").innerHTML="Password must contain at least one small letter";
        passError="Error";
        }
        
        else if((/[0-9]+/.test(pass))==false){
            document.getElementById("passError").innerHTML="Password must contain at least one number";
            passError="Error";
        }
        else if(pass.length<8){
            document.getElementById("passError").innerHTML="Password should contain at least 8 characters";
            passError="Error";
        }
        else{
            passError="";
            document.getElementById("passError").innerHTML="";
        }
    }

    var Cpass = document.getElementById("Cpass").value;
    if(Cpass==""){
        document.getElementById("cpassError").innerHTML="Confirm Password is required";
        cpassError="Error";
    }
    else{
        if(Cpass!=pass){
        document.getElementById("cpassError").innerHTML="Re-type password must be matched with password";
        cpassError="Error";
        }
        else{
            cpassError="";
            document.getElementById("cpassError").innerHTML="";
        }
    }

    email=document.getElementById("email").value;
    var validRegex = /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)$/;

    if(email==""){
        document.getElementById("emailError").innerHTML="Email is required";
        emailError="Error";

    }else{
        if (!document.getElementById("email").value.match(validRegex)){  
            document.getElementById("emailError").innerHTML="This is not a valid e-mail address"; 
            emailError="Error"; 
        }
        
        else if (email != "") {
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function () {
        if (this.responseText == "true") {
          emailErr = "Email Already Exists.";
          document.getElementById("emailError").innerHTML = emailErr;
        } else if (this.responseText == "false") {
          emailErr = "";
          document.getElementById("emailError").innerHTML = emailErr;
        }
      };
      xhttp.open("GET", "../controller/check_dup_email.php?mail=" + email);
      xhttp.send();
    }
        else{
            emailError="";
            document.getElementById("emailError").innerHTML="";
        }
    }


    if(document.getElementById("m").checked==false && document.getElementById("f").checked==false && document.getElementById("p").checked==false)
    {
        document.getElementById("genderError").innerHTML="Gender is required";
        genderError="Error";
    }
    else{
        genderError="";
        document.getElementById("genderError").innerHTML="";
    }

     

        var error="";
    var dob=document.getElementById("dob").value;

     if (dob == "") {
        error = "Date of Birth is required.";
        document.getElementById("dobError").innerHTML = error;
        document.getElementById("dob");
       
    } else {
        error = "";
        document.getElementById("dobError").innerHTML = error;
        document.getElementById("dob");
      
    }
    

    if(nameError!="" || nidError!="" ||passError!="" || cpassError!="" || genderError!="" || emailError!=""||error!=""){
        return false;
    }else if(nameError=="" && nidError=="" && passError=="" && cpassError==""  && genderError=="" && emailError==""&& error==""){
        return true;
    }
}





function nameverification(){
    var x=document.getElementById("name").value;
    x= x.replace(/(^\s*)|(\s*$)/gi,"");
    x = x.replace(/[ ]{2,}/gi," ");
    x = x.replace(/\n /,"\n");
    var z=x.split(" ").length;
    var form_ok=0;
    if(x==""){
        document.getElementById("nameError").innerHTML="Name is required";
        document.getElementById("name").focus();
        form_ok=1;
    }
    else{
        if((/[A-Za-z]/.test(x[0]))==false){
            document.getElementById("nameError").innerHTML="Name must have start with a letter";
            document.getElementById("name").focus();
            form_ok=1;
        }
        else if(z<2){
            document.getElementById("nameError").innerHTML=" At least two words  needed";
            document.getElementById("name").focus();
            form_ok=1;
        }
        else{
            form_ok=0;
            document.getElementById("nameError").innerHTML="";
        }
    }
    if(form_ok==1){
        return false;
    }else if(form_ok==0){
        return true;
    }
}
    
    function nidVerification(){
    var form_ok=0;
    var y=document.getElementById("nid").value;
    if(y==""){
        document.getElementById("nidError").innerHTML="NID is required";
        document.getElementById("nid").focus();
        form_ok=1;
    }
    else{
        if(isNaN(y)==true){
            document.getElementById("nidError").innerHTML="NID can have numbers only";
            document.getElementById("nid").focus();
            form_ok=1;
        }
        else if(y.length!=10){
            document.getElementById("nidError").innerHTML="NID must consist of 10 digits only";
            document.getElementById("nid").focus();
            form_ok=1;
        }
        else if (y != "") {
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function () {
        if (this.responseText == "true") {
          form_ok==1;
          document.getElementById("nidError").innerHTML = "NID Already Exists";
        } else if (this.responseText == "false") {
            form_ok=0;
          document.getElementById("nidError").innerHTML = "";
        }
      };
      xhttp.open("GET", "../controller/check_dup_nid.php?nid=" + y);
      xhttp.send();
    }
        else{
            form_ok=0;
            document.getElementById("nidError").innerHTML="";
        }
    }
    if(form_ok==1){
        return false;
    }else if(form_ok==0){
        return true;
    }
}

function passVerification(){
     var form_ok=0;
    var pass=document.getElementById("pas").value;
    if(pass==""){
        document.getElementById("passError").innerHTML="Password is required";
        form_ok=1;
    }
    else{
        if((/[a-z]+/.test(pass))==false){
        document.getElementById("passError").innerHTML=" Password must contain at least one small letter";
        document.getElementById("pas").focus();
        form_ok=1;
        }
        else if((/['^£$%&*()}{@#~?><>,|=+¬-]/.test(pass))==false){
        document.getElementById("passError").innerHTML=" Password must contain at least one special character";
        document.getElementById("pas").focus();
        form_ok=1;
        }
        else if((/[0-9]+/.test(pass))==false){
            document.getElementById("passError").innerHTML="Password must contain at least one number";
            document.getElementById("pas").focus();
            form_ok=1;
        }
        else if(pass.length<8){
            document.getElementById("passError").innerHTML="Password must contain at least 8 characters";
            document.getElementById("pas").focus();
            form_ok=1;
        }
        else{
            form_ok=0;
            document.getElementById("passError").innerHTML="";
        }
    }
    if(form_ok==1){
        return false;
    }else if(form_ok==0){
        return true;
    }
}
function cpassVerification(){

    var form_ok=0;

    var pass=document.getElementById("pas").value;

    var Cpass = document.getElementById("Cpass").value;

    if(Cpass==""){
        document.getElementById("cpassError").innerHTML="Confirm password is required";
        document.getElementById("Cpass").focus();
        form_ok=1;
    }
    else{
        if(Cpass!=pass){
        document.getElementById("cpassError").innerHTML="Re-type password must be matched with password";
        document.getElementById("Cpass").focus();
        form_ok=1;
        }
        else{
            form_ok=0;
            document.getElementById("cpassError").innerHTML="";
        }
    }
    if(form_ok==1){
        return false;
    }else if(form_ok==0){
        return true;
    }
    

}
function emailVerification(){

    var emailError="";

    email=document.getElementById("email").value;
    var validRegex = /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)$/;

    if(email==""){
        document.getElementById("emailError").innerHTML="Email is required";
        document.getElementById("email").focus();
        emailError="Error";

    }else{
        if (!document.getElementById("email").value.match(validRegex)){  
            document.getElementById("emailError").innerHTML="This is not a valid e-mail address"; 
            document.getElementById("email").focus();
            emailError="Error"; 
        }  
        else if (email != "") {
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function () {
        if (this.responseText == "true") {
          emailErr = "Email Already Exists.";
          document.getElementById("emailError").innerHTML = emailErr;
        } else if (this.responseText == "false") {
          emailErr = "";
          document.getElementById("emailError").innerHTML = emailErr;
        }
      };
      xhttp.open("GET", "../controller/check_dup_email.php?mail=" + email);
      xhttp.send();
    } 
        else{
            emailError="";
            document.getElementById("emailError").innerHTML="";
        }
    }
    if(emailError!=""){
        return false;
    }
    else if(emailError==""){
        return true;
    }
}
function genderVerification(){


if(document.getElementById("m").checked==false && document.getElementById("f").checked==false && document.getElementById("p").checked==false)
    {
        document.getElementById("genderError").innerHTML="Gender is required";
        genderError="Error";
        return false;

    }
    else{
        genderError="";
        document.getElementById("genderError").innerHTML="";
         return true;
    }
}




    


    
</script>
</body>
</html>
         


