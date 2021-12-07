// Registration Page Validations

function form_validate() {
  var x = document.getElementById("name").value;
  x = x.replace(/(^\s*)|(\s*$)/gi, "");
  x = x.replace(/[ ]{2,}/gi, " ");
  x = x.replace(/\n /, "\n");
  var z = x.split(" ").length;
  var nameErr = "";
  var passErr = "";
  var cpassErr = "";
  var nidErr = "";
  var genderErr = "";
  var emailErr = "";
  if (x == "") {
    document.getElementById("nameError").innerHTML = "Name cannot be Empty";
    nameErr = "Error";
  } else {
    if (/[A-Za-z]/.test(x[0]) == false) {
      document.getElementById("nameError").innerHTML =
        "Name must start with a letter";
      nameErr = "Error";
    } else if (z < 2) {
      document.getElementById("nameError").innerHTML =
        "Name must contain at least two words";
      nameErr = "Error";
    } else {
      nameErr = "";
      document.getElementById("nameError").innerHTML = "";
    }
  }
  var y = document.getElementById("nid").value;
  if (y == "") {
    document.getElementById("nidError").innerHTML = "NID Field Cannot Be Empty";
    nidErr = "Error";
  } else {
    if (isNaN(y) == true) {
      document.getElementById("nidError").innerHTML = "NID can be numbers only";
      nidErr = "Error";
    } else if (y.length != 10) {
      document.getElementById("nidError").innerHTML =
        "NID can consist of 10 digits only";
      nidErr = "Error";
    } else {
      nidErr = "";
      document.getElementById("nidError").innerHTML = "";
    }
  }
  var pass = document.getElementById("pass").value;
  if (pass == "") {
    document.getElementById("passError").innerHTML =
      "Password Field Cannot be Empty";
    passErr = "Error";
  } else {
    if (/[a-z]+/.test(pass) == false) {
      document.getElementById("passError").innerHTML =
        "Your Password should contain at least one small letter";
      passErr = "Error";
    } else if (/[\'^£$%&*()}{@#~?><>,|=_+¬-]/.test(pass) == false) {
      document.getElementById("passError").innerHTML =
        "Your Password should contain at least one special character";
      passErr = "Error";
    } else if (/[0-9]+/.test(pass) == false) {
      document.getElementById("passError").innerHTML =
        "Your Password should contain at least one number";
      passErr = "Error";
    } else if (pass.length < 8) {
      document.getElementById("passError").innerHTML =
        "Your Password should contain at least 8 characters";
      passErr = "Error";
    } else {
      passErr = "";
      document.getElementById("passError").innerHTML = "";
    }
  }
  var c_pass = document.getElementById("c_pass").value;
  if (c_pass == "") {
    document.getElementById("cpassError").innerHTML =
      "Confirm Password Field Cannot be Empty";
    cpassErr = "Error";
  } else {
    if (c_pass != pass) {
      document.getElementById("cpassError").innerHTML =
        "Your Passwords does not match";
      cpassErr = "Error";
    } else {
      cpassErr = "";
      document.getElementById("cpassError").innerHTML = "";
    }
  }
  if (
    document.getElementById("m").checked == false &&
    document.getElementById("f").checked == false &&
    document.getElementById("p").checked == false
  ) {
    document.getElementById("genderError").innerHTML =
      "Gender Field cannot be empty";
    genderErr = "Error";
  } else {
    genderErr = "";
    document.getElementById("genderError").innerHTML = "";
  }

  mail = document.getElementById("email").value;
  var validRegex =
    /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)$/;

  if (mail == "") {
    document.getElementById("emailError").innerHTML =
      "Email Field cannot be empty";
    emailErr = "Error";
  } else {
    if (!document.getElementById("email").value.match(validRegex)) {
      document.getElementById("emailError").innerHTML =
        "Please enter a valid e-mail address";
      emailErr = "Error";
    } else if (mail != "") {
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
      xhttp.open("GET", "../controller/check_dup_email.php?mail=" + mail);
      xhttp.send();
    }
  }
  if (
    nameErr != "" ||
    nidErr != "" ||
    passErr != "" ||
    cpassErr != "" ||
    genderErr != "" ||
    emailErr != ""
  ) {
    return false;
  } else if (
    nameErr == "" &&
    nidErr == "" &&
    passErr == "" &&
    cpassErr == "" &&
    genderErr == "" &&
    emailErr == ""
  ) {
    return true;
  }
}

function name_verify() {
  var x = document.getElementById("name").value;
  x = x.replace(/(^\s*)|(\s*$)/gi, "");
  x = x.replace(/[ ]{2,}/gi, " ");
  x = x.replace(/\n /, "\n");
  var z = x.split(" ").length;
  var form_ok = 0;
  if (x == "") {
    document.getElementById("nameError").innerHTML = "Name cannot be Empty";
    document.getElementById("name").focus();
    form_ok = 1;
  } else {
    if (/[A-Za-z]/.test(x[0]) == false) {
      document.getElementById("nameError").innerHTML =
        "Name must start with a letter";
      document.getElementById("name").focus();
      form_ok = 1;
    } else if (z < 2) {
      document.getElementById("nameError").innerHTML =
        "Name must contain at least two words";
      document.getElementById("name").focus();
      form_ok = 1;
    } else {
      form_ok = 0;
      document.getElementById("nameError").innerHTML = "";
    }
  }
  if (form_ok == 1) {
    return false;
  } else if (form_ok == 0) {
    return true;
  }
}

function nidVerify() {
  var form_ok = 0;
  var y = document.getElementById("nid").value;
  if (y == "") {
    document.getElementById("nidError").innerHTML = "NID Field Cannot Be Empty";
    document.getElementById("nid").focus();
    form_ok = 1;
  } else {
    if (isNaN(y) == true) {
      document.getElementById("nidError").innerHTML = "NID can be numbers only";
      document.getElementById("nid").focus();
      form_ok = 1;
    } else if (y.length != 10) {
      document.getElementById("nidError").innerHTML =
        "NID can consist of 10 digits only";
      document.getElementById("nid").focus();
      form_ok = 1;
    } else {
      form_ok = 0;
      document.getElementById("nidError").innerHTML = "";
    }
  }
  if (form_ok == 1) {
    return false;
  } else if (form_ok == 0) {
    return true;
  }
}

function passVerify() {
  var form_ok = 0;
  var pass = document.getElementById("pass").value;
  if (pass == "") {
    document.getElementById("passError").innerHTML =
      "Password Field Cannot be Empty";
    form_ok = 1;
  } else {
    if (/[a-z]+/.test(pass) == false) {
      document.getElementById("passError").innerHTML =
        "Your Password should contain at least one small letter";
      document.getElementById("pass").focus();
      form_ok = 1;
    } else if (/[\'^£$%&*()}{@#~?><>,|=_+¬-]/.test(pass) == false) {
      document.getElementById("passError").innerHTML =
        "Your Password should contain at least one special character";
      document.getElementById("pass").focus();
      form_ok = 1;
    } else if (/[0-9]+/.test(pass) == false) {
      document.getElementById("passError").innerHTML =
        "Your Password should contain at least one number";
      document.getElementById("pass").focus();
      form_ok = 1;
    } else if (pass.length < 8) {
      document.getElementById("passError").innerHTML =
        "Your Password should contain at least 8 characters";
      document.getElementById("pass").focus();
      form_ok = 1;
    } else {
      form_ok = 0;
      document.getElementById("passError").innerHTML = "";
    }
  }
  if (form_ok == 1) {
    return false;
  } else if (form_ok == 0) {
    return true;
  }
}

function cpassVerify() {
  var form_ok = 0;

  var pass = document.getElementById("pass").value;

  var c_pass = document.getElementById("c_pass").value;

  if (c_pass == "") {
    document.getElementById("cpassError").innerHTML =
      "Confirm Password Field Cannot be Empty";
    document.getElementById("c_pass").focus();
    form_ok = 1;
  } else {
    if (c_pass != pass) {
      document.getElementById("cpassError").innerHTML =
        "Your Passwords does not match";
      document.getElementById("c_pass").focus();
      form_ok = 1;
    } else {
      form_ok = 0;
      document.getElementById("cpassError").innerHTML = "";
    }
  }
  if (form_ok == 1) {
    return false;
  } else if (form_ok == 0) {
    return true;
  }
}

function emailVerify() {
  var emailErr = "";

  mail = document.getElementById("email").value;
  var validRegex =
    /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)$/;

  if (mail == "") {
    document.getElementById("emailError").innerHTML =
      "Email Field cannot be empty";
    document.getElementById("email").focus();
    emailErr = "Error";
  } else {
    if (!document.getElementById("email").value.match(validRegex)) {
      document.getElementById("emailError").innerHTML =
        "Please enter a valid e-mail address";
      document.getElementById("email").focus();
      emailErr = "Error";
    } else if (mail != "") {
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function () {
        if (this.responseText == "true") {
          emailErr = "Email Already Exists.";
          document.getElementById("emailError").innerHTML = emailErr;
          document.getElementById("email").focus();
        } else if (this.responseText == "false") {
          emailErr = "";
          document.getElementById("emailError").innerHTML = emailErr;
        }
      };
      xhttp.open("GET", "../controller/check_dup_email.php?mail=" + mail);
      xhttp.send();
    }
  }
  if (emailErr != "") {
    return false;
  } else if (emailErr == "") {
    return true;
  }
}

//Login Page Validations

function login_validation() {
  var x = document.getElementById("login_nid").value;
  var nid_Error = "";
  var pass_Error = "";
  if (x == "") {
    document.getElementById("nid_Error").innerHTML = "NID Cannot be Empty";
    nid_Error = "Error";
  } else {
    nid_Error = "";
    document.getElementById("nid_Error").innerHTML = "";
  }
  var y = document.getElementById("login_pass").value;
  if (y == "") {
    document.getElementById("pass_Error").innerHTML =
      "Password Field Cannot be Empty";
    pass_Error = "Error";
  } else {
    pass_Error = "";
    document.getElementById("pass_Error").innerHTML = "";
  }

  if (nid_Error != "" || pass_Error != "") {
    return false;
  } else if (nid_Error == "" && pass_Error == "") {
    return true;
  }
}

function nid_validate() {
  var x = document.getElementById("login_nid").value;
  var nid_Error = "";
  if (x == "") {
    document.getElementById("nid_Error").innerHTML = "NID Cannot be Empty";
    document.getElementById("login_nid").focus();
    nid_Error = "Error";
  } else {
    nid_Error = "";
    document.getElementById("nid_Error").innerHTML = "";
  }

  if (nid_Error != "") {
    return false;
  } else if (nid_Error == "") {
    return true;
  }
}

function pass_validate() {
  var pass_Error = "";
  var y = document.getElementById("login_pass").value;
  if (y == "") {
    document.getElementById("pass_Error").innerHTML =
      "Password Field Cannot be Empty";
    document.getElementById("login_pass").focus();
    pass_Error = "Error";
  } else {
    pass_Error = "";
    document.getElementById("pass_Error").innerHTML = "";
  }

  if (pass_Error != "") {
    return false;
  } else if (pass_Error == "") {
    return true;
  }
}

//Search Ad Page Validations
function search_validate() {
  var key_error = "";
  var key = document.getElementById("keyword").value;

  if (key == "") {
    document.getElementById("k").innerHTML = "Search Field Cannot Be Empty";
    key_error = "Error";
  } else {
    key_error = "";
    document.getElementById("k").innerHTML = "";
  }

  if (key_error != "") {
    return false;
  } else if (key_error == "") {
    return true;
  }
}

function s_validate() {
  var key_error = "";
  var key = document.getElementById("keyword").value;

  if (key == "") {
    document.getElementById("k").innerHTML = "Search Field Cannot Be Empty";
    document.getElementById("keyword").focus();
    key_error = "Error";
  } else {
    key_error = "";
    document.getElementById("k").innerHTML = "";
  }

  if (key_error != "") {
    return false;
  } else if (key_error == "") {
    return true;
  }
}

// Give Notice Page form_validations

function give_notice_validation() {
  var ad_idError = "";
  var r_idError = "";
  var msg_Error = "";

  var notice_id = document.getElementById("notice_id").value;
  var renter_id = document.getElementById("rid").value;
  var message = document.getElementById("msg").value;

  if (notice_id == "") {
    ad_idError = "Error";
    document.getElementById("noticeIDErr").innerHTML =
      "Notice ID cannot be empty.";
  } else {
    ad_idError = "";
    document.getElementById("noticeIDErr").innerHTML = "";
  }

  if (renter_id == "") {
    r_idError = "Error";
    document.getElementById("renterIDErr").innerHTML =
      "Renter ID cannot be empty";
  } else {
    if (isNaN(renter_id) == true) {
      r_idError = "Error";
      document.getElementById("renterIDErr").innerHTML =
        "Renter ID can only be numbers";
    } else {
      r_idError = "";
      document.getElementById("renterIDErr").innerHTML = "";
    }
  }

  if (message == "") {
    msg_Error = "Error";
    document.getElementById("messageErr").innerHTML = "Message cannot be empty";
  } else {
    msg_Error = "";
    document.getElementById("messageErr").innerHTML = "";
  }

  if (ad_idError != "" || r_idError != "" || msg_Error != "") {
    return false;
  } else if (ad_idError == "" && r_idError == "" && msg_Error == "") {
    return true;
  }
}

function notice_id_validate() {
  var ad_idError = "";
  var notice_id = document.getElementById("notice_id").value;

  if (notice_id == "") {
    ad_idError = "Error";
    document.getElementById("noticeIDErr").innerHTML =
      "Notice ID cannot be empty.";
    document.getElementById("notice_id").focus();
  } else {
    ad_idError = "";
    document.getElementById("noticeIDErr").innerHTML = "";
  }

  if (ad_idError != "") {
    return false;
  } else if (ad_idError == "") {
    return true;
  }
}

function renter_id_validate() {
  var renter_id = document.getElementById("rid").value;

  var r_idError = "";

  if (renter_id == "") {
    r_idError = "Error";
    document.getElementById("renterIDErr").innerHTML =
      "Renter ID cannot be empty";
    document.getElementById("rid").focus();
  } else {
    if (isNaN(renter_id) == true) {
      r_idError = "Error";
      document.getElementById("renterIDErr").innerHTML =
        "Renter ID can only be numbers";
      document.getElementById("rid").focus();
    } else {
      r_idError = "";
      document.getElementById("renterIDErr").innerHTML = "";
    }
  }

  if (r_idError != "") {
    return false;
  } else if (r_idError == "") {
    return true;
  }
}

function message_validate() {
  var message = document.getElementById("msg").value;

  var msg_Error = "";

  if (message == "") {
    msg_Error = "Error";
    document.getElementById("messageErr").innerHTML = "Message cannot be empty";
    document.getElementById("msg").focus();
  } else {
    msg_Error = "";
    document.getElementById("messageErr").innerHTML = "";
  }

  if (msg_Error != "") {
    return false;
  } else if (msg_Error == "") {
    return true;
  }
}

//Edit Profile Validations

function edit_profile_validate() {
  var x = document.getElementById("name").value;
  x = x.replace(/(^\s*)|(\s*$)/gi, "");
  x = x.replace(/[ ]{2,}/gi, " ");
  x = x.replace(/\n /, "\n");
  var z = x.split(" ").length;
  var nameErr = "";
  var passErr = "";
  var cpassErr = "";
  var emailErr = "";
  if (x == "") {
    document.getElementById("nameError").innerHTML = "Name cannot be Empty";
    nameErr = "Error";
  } else {
    if (/[A-Za-z]/.test(x[0]) == false) {
      document.getElementById("nameError").innerHTML =
        "Name must start with a letter";
      nameErr = "Error";
    } else if (z < 2) {
      document.getElementById("nameError").innerHTML =
        "Name must contain at least two words";
      nameErr = "Error";
    } else {
      nameErr = "";
      document.getElementById("nameError").innerHTML = "";
    }
  }
  var pass = document.getElementById("pass").value;
  if (pass == "") {
    document.getElementById("passError").innerHTML =
      "Password Field Cannot be Empty";
    passErr = "Error";
  } else {
    if (/[a-z]+/.test(pass) == false) {
      document.getElementById("passError").innerHTML =
        "Your Password should contain at least one small letter";
      passErr = "Error";
    } else if (/[\'^£$%&*()}{@#~?><>,|=_+¬-]/.test(pass) == false) {
      document.getElementById("passError").innerHTML =
        "Your Password should contain at least one special character";
      passErr = "Error";
    } else if (/[0-9]+/.test(pass) == false) {
      document.getElementById("passError").innerHTML =
        "Your Password should contain at least one number";
      passErr = "Error";
    } else if (pass.length < 8) {
      document.getElementById("passError").innerHTML =
        "Your Password should contain at least 8 characters";
      passErr = "Error";
    } else {
      passErr = "";
      document.getElementById("passError").innerHTML = "";
    }
  }
  var c_pass = document.getElementById("c_pass").value;
  if (c_pass == "") {
    document.getElementById("cpassError").innerHTML =
      "Confirm Password Field Cannot be Empty";
    cpassErr = "Error";
  } else {
    if (c_pass != pass) {
      document.getElementById("cpassError").innerHTML =
        "Your Passwords does not match";
      cpassErr = "Error";
    } else {
      cpassErr = "";
      document.getElementById("cpassError").innerHTML = "";
    }
  }

  mail = document.getElementById("email").value;
  var validRegex =
    /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)$/;

  if (mail == "") {
    document.getElementById("emailError").innerHTML =
      "Email Field cannot be empty";
    document.getElementById("email").focus();
    emailErr = "Error";
  } else {
    if (!document.getElementById("email").value.match(validRegex)) {
      document.getElementById("emailError").innerHTML =
        "Please enter a valid e-mail address";
      document.getElementById("email").focus();
      emailErr = "Error";
    } else {
      emailErr = "";
      document.getElementById("emailError").innerHTML = "";
    }
  }

  if (nameErr != "" || passErr != "" || cpassErr != "" || emailErr != "") {
    return false;
  } else if (
    nameErr == "" &&
    passErr == "" &&
    cpassErr == "" &&
    emailErr == ""
  ) {
    return true;
  }
}

// Change Profile Picture Validations

function dp_validate() {
  var imgError = "";
  var img = document.getElementById("fileToUpload");
  var valid_ext = ["jpeg", "jpg", "png"];

  if (img.value == "") {
    document.getElementById("fileToUpload").value = "";
    document.getElementById("ImageError").innerHTML =
      "Please Select an Image First";
    imgError = "Error";
  } else {
    var image_ext = img.value.substring(img.value.lastIndexOf(".") + 1);
    var result = valid_ext.includes(image_ext);
    if (result == false) {
      document.getElementById("fileToUpload").value = "";
      document.getElementById("ImageError").innerHTML =
        "Only JPEG, PNG and JPG is allowed";
      imgError = "Error";
    } else if (parseFloat(img.files[0].size / (1024 * 1024)) >= 3) {
      document.getElementById("fileToUpload").value = "";
      document.getElementById("ImageError").innerHTML =
        "Maximum File Size is 3 MB";
      imgError = "Error";
    } else {
      imgError = "";
      document.getElementById("ImageError").innerHTML = "";
    }
  }

  if (imgError != "") {
    return false;
  } else if (imgError == "") {
    return true;
  }
}

// Ad Post Validations

function ad_post_validation() {
  var ad_idError = "";
  var rentError = "";
  var addError = "";
  var descError = "";
  var file1Error = "";
  var file2Error = "";
  var file3Error = "";
  var areaError = "";
  var file1 = document.getElementById("f1");
  var file2 = document.getElementById("f2");
  var file3 = document.getElementById("f3");
  var valid_ext = ["jpeg", "jpg", "png"];
  var x = document.getElementById("ad_id").value;
  if (x == "") {
    ad_idError = "Error";
    document.getElementById("idError").innerHTML = "AD_ID Cannot be Empty";
  } else {
    ad_idError = "";
    document.getElementById("idError").innerHTML = "";
  }
  var y = document.getElementById("ad_rent").value;
  if (y == "") {
    rentError = "Error";
    document.getElementById("rentError").innerHTML = "Rent cannot be empty";
  } else {
    if (isNaN(y) == true) {
      rentError = "Error";
      document.getElementById("rentError").innerHTML =
        "Rent can only be numbers";
    } else {
      rentError = "";
      document.getElementById("rentError").innerHTML = "";
    }
  }
  var z = document.getElementById("ad_address").value;
  if (z == "") {
    addError = "Error";
    document.getElementById("addressError").innerHTML =
      "Address Cannot be Empty";
  } else {
    addError = "";
    document.getElementById("addressError").innerHTML = "";
  }
  var ar = document.getElementById("ad_ar").value;
  if (ar == "") {
    areaError = "Error";
    document.getElementById("areaError").innerHTML = "Area cannot be Empty";
  } else {
    areaError = "";
    document.getElementById("areaError").innerHTML = "";
  }

  var a = document.getElementById("desc").value;
  if (a == "") {
    descError = "Error";
    document.getElementById("descError").innerHTML = "Description Needed";
  } else {
    descError = "";
    document.getElementById("descError").innerHTML = "";
  }
  if (file1.value == "") {
    file1Error = "Error";
    document.getElementById("f1Error").innerHTML = "Image not selected";
  } else {
    var image_ext = file1.value.substring(file1.value.lastIndexOf(".") + 1);
    var result = valid_ext.includes(image_ext);
    if (result == false) {
      file1Error = "Error";
      document.getElementById("f1Error").innerHTML =
        "Only JPEG, PNG and JPG is allowed";
    } else {
      file1Error = "";
      document.getElementById("f1Error").innerHTML = "";
    }
  }
  if (file2.value == "") {
    file2Error = "Error";
    document.getElementById("f2Error").innerHTML = "Image not selected";
  } else {
    var image_ext1 = file2.value.substring(file2.value.lastIndexOf(".") + 1);
    var result1 = valid_ext.includes(image_ext1);
    if (result1 == false) {
      file2Error = "Error";
      document.getElementById("f2Error").innerHTML =
        "Only JPEG, PNG and JPG is allowed";
    } else {
      file2Error = "";
      document.getElementById("f2Error").innerHTML = "";
    }
  }
  if (file3.value == "") {
    file3Error = "Error";
    document.getElementById("f3Error").innerHTML = "Image not selected";
  } else {
    var image_ext2 = file3.value.substring(file3.value.lastIndexOf(".") + 1);
    var result2 = valid_ext.includes(image_ext2);
    if (result2 == false) {
      file3Error = "Error";
      document.getElementById("f3Error").innerHTML =
        "Only JPEG, PNG and JPG is allowed";
    } else {
      file3Error = "";
      document.getElementById("f3Error").innerHTML = "";
    }
  }

  if (
    ad_idError != "" ||
    rentError != "" ||
    addError != "" ||
    descError != "" ||
    file1Error != "" ||
    areaError != "" ||
    file2Error != "" ||
    file3Error != ""
  ) {
    return false;
  } else if (
    ad_idError == "" &&
    rentError == "" &&
    addError == "" &&
    descError == "" &&
    file1Error == "" &&
    areaError == "" &&
    file2Error == "" &&
    file3Error == ""
  ) {
    return true;
  }
}

function aid_validate() {
  var ad_idError = "";

  var x = document.getElementById("ad_id").value;
  if (x == "") {
    ad_idError = "Error";
    document.getElementById("idError").innerHTML = "AD_ID Cannot be Empty";
    document.getElementById("ad_id").focus();
  } else {
    ad_idError = "";
    document.getElementById("idError").innerHTML = "";
  }

  if (ad_idError != "") {
    return false;
  } else if (ad_idError == "") {
    return true;
  }
}

function rent_validate() {
  var rentError = "";

  var y = document.getElementById("ad_rent").value;
  if (y == "") {
    rentError = "Error";
    document.getElementById("rentError").innerHTML = "Rent cannot be empty";
    document.getElementById("ad_rent").focus();
  } else {
    if (isNaN(y) == true) {
      rentError = "Error";
      document.getElementById("rentError").innerHTML =
        "Rent can only be numbers";
      document.getElementById("ad_rent").focus();
    } else {
      rentError = "";
      document.getElementById("rentError").innerHTML = "";
    }
  }

  if (rentError != "") {
    return false;
  } else if (rentError == "") {
    return true;
  }
}

function address_validate() {
  var addError = "";

  var z = document.getElementById("ad_address").value;
  if (z == "") {
    addError = "Error";
    document.getElementById("addressError").innerHTML =
      "Address Cannot be Empty";
    document.getElementById("ad_address").focus();
  } else {
    addError = "";
    document.getElementById("addressError").innerHTML = "";
  }

  if (addError != "") {
    return false;
  } else if (addError == "") {
    return true;
  }
}

function area_validate() {
  var areaError = "";

  var ar = document.getElementById("ad_ar").value;
  if (ar == "") {
    areaError = "Error";
    document.getElementById("areaError").innerHTML = "Area cannot be Empty";
    document.getElementById("ad_ar").focus();
  } else {
    areaError = "";
    document.getElementById("areaError").innerHTML = "";
  }

  if (areaError != "") {
    return false;
  } else if (areaError == "") {
    return true;
  }
}

function desc_validate() {
  var descError = "";

  var a = document.getElementById("desc").value;
  if (a == "") {
    descError = "Error";
    document.getElementById("descError").innerHTML = "Description Needed";
    document.getElementById("desc").focus();
  } else {
    descError = "";
    document.getElementById("descError").innerHTML = "";
  }

  if (descError != "") {
    return false;
  } else if (descError == "") {
    return true;
  }
}

//Edit Ad Validations

function edit_ad_validations() {
  var rentError = "";
  var addError = "";
  var descError = "";
  var file1Error = "";
  var file2Error = "";
  var file3Error = "";
  var areaError = "";
  var file1 = document.getElementById("f1");
  var file2 = document.getElementById("f2");
  var file3 = document.getElementById("f3");
  var valid_ext = ["jpeg", "jpg", "png"];
  var y = document.getElementById("ad_rent").value;
  if (y == "") {
    rentError = "Error";
    document.getElementById("rentError").innerHTML = "Rent cannot be empty";
  } else {
    if (isNaN(y) == true) {
      rentError = "Error";
      document.getElementById("rentError").innerHTML =
        "Rent can only be numbers";
    } else {
      rentError = "";
      document.getElementById("rentError").innerHTML = "";
    }
  }
  var z = document.getElementById("ad_address").value;
  if (z == "") {
    addError = "Error";
    document.getElementById("addressError").innerHTML =
      "Address Cannot be Empty";
  } else {
    addError = "";
    document.getElementById("addressError").innerHTML = "";
  }
  var ar = document.getElementById("ad_ar").value;
  if (ar == "") {
    areaError = "Error";
    document.getElementById("areaError").innerHTML = "Area cannot be Empty";
  } else {
    areaError = "";
    document.getElementById("areaError").innerHTML = "";
  }

  var a = document.getElementById("desc").value;
  if (a == "") {
    descError = "Error";
    document.getElementById("descError").innerHTML = "Description Needed";
  } else {
    descError = "";
    document.getElementById("descError").innerHTML = "";
  }
  if (file1.value == "") {
    file1Error = "Error";
    document.getElementById("f1Error").innerHTML = "Image not selected";
  } else {
    var image_ext = file1.value.substring(file1.value.lastIndexOf(".") + 1);
    var result = valid_ext.includes(image_ext);
    if (result == false) {
      file1Error = "Error";
      document.getElementById("f1Error").innerHTML =
        "Only JPEG, PNG and JPG is allowed";
    } else {
      file1Error = "";
      document.getElementById("f1Error").innerHTML = "";
    }
  }
  if (file2.value == "") {
    file2Error = "Error";
    document.getElementById("f2Error").innerHTML = "Image not selected";
  } else {
    var image_ext1 = file2.value.substring(file2.value.lastIndexOf(".") + 1);
    var result1 = valid_ext.includes(image_ext1);
    if (result1 == false) {
      file2Error = "Error";
      document.getElementById("f2Error").innerHTML =
        "Only JPEG, PNG and JPG is allowed";
    } else {
      file2Error = "";
      document.getElementById("f2Error").innerHTML = "";
    }
  }
  if (file3.value == "") {
    file3Error = "Error";
    document.getElementById("f3Error").innerHTML = "Image not selected";
  } else {
    var image_ext2 = file3.value.substring(file3.value.lastIndexOf(".") + 1);
    var result2 = valid_ext.includes(image_ext2);
    if (result2 == false) {
      file3Error = "Error";
      document.getElementById("f3Error").innerHTML =
        "Only JPEG, PNG and JPG is allowed";
    } else {
      file3Error = "";
      document.getElementById("f3Error").innerHTML = "";
    }
  }

  if (
    rentError != "" ||
    addError != "" ||
    descError != "" ||
    file1Error != "" ||
    areaError != "" ||
    file2Error != "" ||
    file3Error != ""
  ) {
    return false;
  } else if (
    rentError == "" &&
    addError == "" &&
    descError == "" &&
    file1Error == "" &&
    areaError == "" &&
    file2Error == "" &&
    file3Error == ""
  ) {
    return true;
  }
}

function check_valid() {
  check_Duplicate();
  if (document.getElementById("insert_Error").innerHTML == "") {
    return true;
  } else {
    return false;
  }
}

function get_spec_data() {
  var a_id = document.getElementById("a_id").value;
  //alert(a_id);

  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    //alert(this.responseText);
    document.getElementById("rid").value = this.responseText;
  };

  xhttp.open("GET", "../controller/check_ad_details.php?id=" + a_id);
  xhttp.send();
}