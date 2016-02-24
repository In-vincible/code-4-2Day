<!DOCTYPE html>
<html>
<head>
<title>FootBall Friend</title>
<style>
form {

    

    display: block;

    padding: 15px;

}

input[type=text], input[type=password], input[type=submit] {

    -moz-border-radius: 2px;

    -ms-border-radius: 2px;

    -o-border-radius: 2px;

    -webkit-border-radius: 2px;

    border-radius: 2px;

}

input[type=text], input[type=password], select {

    background-color: rgb(246, 254, 231);

    border-color: rgb(180, 207, 94);

    border-style: solid;

    border-width: 1px;

    font-size: 16px;

    height: 25px;

    margin-right: 10px;

    width: 200px;

}

input[type=submit]{

    cursor: pointer;

    font-size: 16px;

    height: 35px;

    padding: 5px;

}

input.wrong {

    border-color: rgb(180, 207, 94);

    background-color: rgb(255, 183, 183);

}

input.correct {

    border-color: rgb(180, 207, 94);

    background-color: rgb(220, 251, 164);

}

#pass_result {

    float: right;

}

</style>
<script>
//We are simply printing the length of fields so that user is aware of how much he has written
function updatelength(field, output){

    curr_length = document.getElementById(field).value.length;

    field_mlen = document.getElementById(field).maxLength;

    document.getElementById(output).innerHTML = curr_length+'/'+field_mlen;

    return 1;

}
//we are checking the strength of password by checking if it has lower case +1,if upper case again +1, etc, at last we judge strength with this point
function check_v_pass(field, output) {

    pass_buf_value = document.getElementById(field).value;

    pass_level = 0;

    if (pass_buf_value.match(/[a-z]/g)) {

        pass_level++;

    }

    if (pass_buf_value.match(/[A-Z]/g)) {

        pass_level++;
    }

    if (pass_buf_value.match(/[0-9]/g)) {

        pass_level++;

    }

    if (pass_buf_value.length < 5) {

        if(pass_level >= 1) pass_level--;
    } else if (pass_buf_value.length >= 20) {

        pass_level++;

    }

    output_val = '';

    switch (pass_level) {

        case 1: output_val='Weak'; break;

        case 2: output_val='Normal'; break;

        case 3: output_val='Strong'; break;

        case 4: output_val='Very strong'; break;

        default: output_val='Very weak'; break;

    }

    if (document.getElementById(output).value != pass_level) {

        document.getElementById(output).value = pass_level;

        document.getElementById(output).innerHTML = output_val;

    }

    return 1;

}
//checking if password and confirmed password are same
function compare_valid(field, field2) {

    fld_val = document.getElementById(field).value;

    fld2_val = document.getElementById(field2).value;

    if (fld_val == fld2_val) {

        update_css_class(field2, 2);

        p_valid_r = 1;

    } else {

        update_css_class(field2, 1);

        p_valid_r = 0;

    }

    return p_valid_r;

}
//checking if mail is valid
function check_v_mail(field) {

    fld_value = document.getElementById(field).value;

    is_m_valid = 0;

    if (fld_value.indexOf('@') >= 1) {//checking if @ exists in mail

        m_valid_dom = fld_value.substr(fld_value.indexOf('@')+1);

        if (m_valid_dom.indexOf('@') == -1) {

            if (m_valid_dom.indexOf('.') >= 1) {//checking if . exists in mail

                m_valid_dom_e = m_valid_dom.substr(m_valid_dom.indexOf('.')+1);

                if (m_valid_dom_e.length >= 1) {//cheching if . and @ are separated 

                    is_m_valid = 1;

                }

            }

        }

    }

    if (is_m_valid) {

        update_css_class(field, 2);

        m_valid_r = 1;

    } else {

        update_css_class(field, 1);

        m_valid_r = 0;

    }

    return m_valid_r;

}
function valid_length(field) {//checking for length of fields

    length_df = document.getElementById(field).value.length;

    if (length_df >= 1 && length_df <= document.getElementById(field).maxLength) {

        update_css_class(field, 2);

        ret_len = 1;

    } else {

        update_css_class(field, 1);

        ret_len = 0;

    }

    return ret_len;

}

function update_css_class(field, class_index) {//this function simply updates the css to show if credentiols are correct or incorrect

    if (class_index == 1) {

        class_s = 'wrong';
    } else if (class_index == 2) {

        class_s = 'correct';

    }

    document.getElementById(field).className = class_s;

    return 1;

}
function validate_all(output) {//Now this is the mother function all functions above are called by this one. and it is called on submit

    t1 = valid_length('login');

    t2 = valid_length('password');

    t3 = compare_valid('password', 'c_password');

    t4 = check_v_mail('email');

    t5 = check_v_pass('password', 'pass_result');

 

    errorlist = '';

    if (! t1) {

        errorlist += 'Login is too short/long<br />';

    }

    if (! t2) {

        errorlist += 'Password is too short/long<br />';

    }

    if (! t3) {

        errorlist += 'Passwords are not the same<br />';

    }

    if (! t4) {

        errorlist += 'Mail is wrong<br />';

    }

    if (errorlist) {

        document.getElementById(output).innerHTML = errorlist;

        return false;

    }

    return true;

}
</script>
</head>
<body>
<h1>Please Register If you wish to get key for the usage of Api</h1>

<form action="user.php" method="post" id="form" onsubmit="return validate_all('results');">

    <table cellspacing="10">

        <tr><td>User Name</td><td><input type="text" name="user" maxlength="25" id="login" onKeyUp="updatelength('login', 'login_length')"><br /><div id="login_length"></div> </td></tr>

        <tr><td>Password</td><td><input type="password" name="pass" maxlength="25" id="password" onKeyUp="updatelength('password', 'pass_length')"><div id="pass_result"></div><br /><div id="pass_length"></div></td></tr>

        <tr><td>Confirm Password</td><td><input type="password" name="cpass" maxlength="25" id="c_password"></td></tr>
        <tr><td>Gender</td><td><select name="gender"><option value="1">male</option><option value="0">female</option></select></td></tr>

        <tr><td>Email</td><td><input type="text" name="email" maxlength="50" id="email" onKeyUp="updatelength('email', 'email_length')"><br /><div id="email_length"></div></td></tr>

        <tr><td colspan="2"><input type="submit" name="submit" value="Register"></td></tr>

    </table>

    <h3 id="results"></h3>
<?php 
if(isset($_GET['badkey']))
echo'<font color="red">Incorrect Api key Used.</font>Please Register to get a new Key.
';
	?>
	</form>
</body>
</html>