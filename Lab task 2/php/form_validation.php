<html>
<title>Form Validation</title>
<link rel="shortcut icon" href="../images/icons8_form.ico">
<link rel="stylesheet" type="text/css" href="../css/form_validation_styles.css">

<body>
    <?php

    $Name = $Email = $Gender = $Degree = $Blood_Group = $DoB = "";
    $dobday = $dobmonth = $dobyear = 0;
    $nameError = $emailError = $dobError = $genderError = $degreeError = $blood_group_error = "";

    if (($_SERVER["REQUEST_METHOD"] == "POST")) {
        $name_words = $_POST["name"];
        $dobday = $_POST["day"];
        $dobmonth = $_POST["month"];
        $dobyear = $_POST["year"];
        $degreeCount = 0;
        if (!empty($_POST["degree"])) {
            foreach ($_POST["degree"] as $select) {
                $degreeCount++;
            }
        } else {
            $degreeError = "At Least two boxes needs to be checked";
        }

        if (empty($_POST["name"])) {
            $nameError = "Name is required";
        } else {
            $Name = validateInput($_POST["name"]);
            if ((!preg_match("/^[a-zA-Z-'._ ]*$/", $Name)) or (str_word_count($name_words) < 2)) {
                $nameError = "Only letters and white space allowed and minimum two words needed";
            }
        }
        if (empty($_POST["email"])) {
            $emailError = "Email is required";
        } else {
            $Email = validateInput($_POST["email"]);
        }
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid Email Format Type it correctly";
        }
        if ((empty($_POST["day"])) or (empty($_POST["month"])) or (empty($_POST["year"]))) {
            $dobError = "Enter all the fields";
        }
        if (($dobday >= 1 and $dobday <= 31) and ($dobmonth >= 1 and $dobmonth <= 12) and ($dobyear >= 1953 and $dobyear <= 1998)) {
            $DoB = strval($dobday) . "-" . strval($dobmonth) . "-" . strval($dobyear);
        } else {
            $dobError = "Invalid Date Entered [dd - (1-31) mm - (1-12) yy - (1953-1998)]";
        }

        if (empty($_POST["gender"])) {
            $genderError = "Gender Required";
        } else {
            $Gender = validateInput($_POST["gender"]);
        }
        if (empty($_POST["degree"])) {
            $degreeError = "No Degree Selected";
        }
        if ($degreeCount >= 2) {
            $Degree = $_POST["degree"];
        } else {
            $degreeError = "At Least two boxes needs to be checked";
        }
        if (empty($_POST["bloodgroup"])) {
            $blood_group_error = "One needs to be Selected";
        } else {
            $Blood_Group = validateInput($_POST["bloodgroup"]);
        }
    }

    function validateInput($information)
    {
        $information = trim($information);
        $information = stripslashes($information);
        $information = htmlspecialchars($information);
        return $information;
    }

    ?>
    <div><img src="../images/website.png" alt="A Student" height="160px" width="180px"><br>
        <h1 style="font-family: Londrina Solid; font: size 20px;">Registration Form</h1>
        <p style="font-family: Londrina Solid; font: size 20px; color:red">Please Enter your details correctly</p>
    </div>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <fieldset>
                <legend class="lcolors" ><img src="../images/name_icon.png" alt="" height="25px" width="25px"></legend>
                <label class="lcolors" style="color: black;" >NAME&nbsp;</label>
                <input type="text" id="name" name="name" value="" placeholder="NAME" size="15"><span class="red">
                    <?php if ($nameError != "") {
                        echo "* - ";
                        echo $nameError;
                    }
                    ?>
                </span>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend><img src="../images/email_icon.png" alt="" height="25px" width="25px"></legend>
                <label class="lcolors" style="color: black;">EMAIL &nbsp; </label>
                <input type="text" id="email" name="email" value="" placeholder="EMAIL"><span class="red">
                    <?php if ($emailError != "") {
                        echo "* - ";
                        echo $emailError;
                    }
                    ?>
                </span>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend><img src="../images/birthdate_icon.png" alt="" height="25px" width="25px"></legend>
                <label class="lcolors" style="color: black;">DOB&nbsp;</label>
                <input type="text" id="day" name="day" value="" placeholder="dd" class="removeBorders" size="3"> -
                <input type="text" id="month" name="month" value="" placeholder="mm" class="removeBorders" size="3"> -
                <input type="text" id="year" name="year" value="" placeholder="yy" class="removeBorders" size="5"> <span class="red">
                    <?php if ($dobError != "") {
                        echo "* - ";
                        echo $dobError;
                    }
                    ?>
                </span>
            </fieldset>
        </div>
        <div>
            <fieldset class="item">
                <legend><img src="../images/gender_icon.png" alt="" height="25px" width="25px"></legend>
                <label class="lcolors" style="color: black;">GENDER&nbsp;</label>
                <input type="radio" id="gender" name="gender" value="Male"> Male
                <input type="radio" id="gender" name="gender" value="Female"> Female
                <input type="radio" id="gender" name="gender" value="Other"> Other <span class="red">
                    <?php
                    if ($genderError != "") {
                        echo "* - ";
                        echo $genderError;
                    }
                    ?>
                </span>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend><img src="../images/graduate_icon.png" alt="" height="25px" width="25px"></legend>
                <label class="lcolors" style="color: black;">DEGREE&nbsp;</label>
                <input type="checkbox" id="degree" name="degree[]" value="SSC"> SSC
                <input type="checkbox" id="degree" name="degree[]" value="HSC"> HSC
                <input type="checkbox" id="degree" name="degree[]" value="BSc"> BSc
                <input type="checkbox" id="degree" name="degree[]" value="MSc"> MSc <span class="red">
                    <?php
                    if ($degreeError != "") {
                        echo "* - ";
                        echo $degreeError;
                    }
                    ?>
                </span>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend><img src="../images/blood_icon.png" alt="" height="30px" width="30px"></legend>
                <label class="lcolors" style="color: black;">BLOOD GROUP&nbsp;</label>
                <select name="bloodgroup">
                    <option disabled selected value> Select An Option </option>
                    <option value="A Positive">A+</option>
                    <option value="A Negative">A-</option>
                    <option value="B Positive">B+</option>
                    <option value="B Negative">B-</option>
                    <option value="B Negative">B-</option>
                    <option value="AB Positive">AB+</option>
                    <option value="AB Negative">AB-</option>
                    <option value="O Positive">O+</option>
                    <option value="O Negative">O-</option>
                </select>
                <span class="red">
                    <?php
                    if ($blood_group_error != "") {
                        echo "* - ";
                        echo $blood_group_error;
                    }
                    ?>
                </span>
            </fieldset>
        </div><br>
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>
</body>
</html>