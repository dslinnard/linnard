<?php
// Start a session
if (!isset($_SESSION)) { session_start(); }

$title = "Contact Linndustries";
include_once '../includes/header.php';
include_once 'nav.php';
$emails = array();
//include_once 'test_emails.php';


function clean_input($param)
{
    if (isset($param)) {
        $param = trim($param);
        $param = stripslashes($param);
        $param = htmlspecialchars($param);
        return strip_tags($param);
    }
    else {
        return null;
    }
}

function email_valid( $email )
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email)) {
        return true;
    }
    else {
        return false;
    }
}

function clean_name($name)
{
    return preg_replace("/[^0-9a-zA-Z ]/", "", $name);
}

function clean_message($message)
{
    return preg_replace('~[^\p{Latin}0-9]+~u', '', $message); 
}

function clean_email($email)
{
    return filter_var($email, FILTER_SANITIZE_EMAIL);
}

function blackListedTerms($message)
{
    $blackList = "search engine optimization|search engine|seo";

    if (preg_match ("/$blackList/", strtolower($message))) {
        return true;
    }
    else {
        return false;
    }
}

function emailAddressTest($emailArray)
{
    foreach ($emailArray as $testEmail) {
        $clean_email = clean_input($testEmail);
        $clean_email = clean_email($clean_email);
        if (email_valid($clean_email)) {
            echo "<div style='color:green'>".$testEmail." is valid.</div>";
        }
        else {
            echo "<div style='color:red'>".$testEmail." is invalid.</div>";
        }
    }
}

//emailAddressTest($emails);

$firstNameErr = $lastNameErr = $emailErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submit = true;
    if (isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["_token"]) {
        $_SESSION = array();
        session_destroy();

        $firstName = clean_input($_POST["firstName"]);
        $lastName = clean_input($_POST["lastName"]);
        $gender =  clean_input($_POST["gender"]);
        $email = clean_input($_POST["email"]);
        $message = clean_input($_POST["message"]);
        $require_error = false;
        $email_error = false;
        $csrf_error = true;

        $firstName = clean_name($firstName);
        if (empty($firstName)) {
            $firstNameErr = "First name is required";
        }

        $lastName = clean_name($lastName);
        if (empty($lastName)) {
            $lastNameErr = "Last name is required";
        }      
        
        $email = clean_email($email);
        if (!email_valid($email)) {
            $emailErr = "A valid email is required";
        }

        if (!empty($required)) {
            eval(requireTest( $required )); 
            $email_error = !email_valid($email);
        }
    }
    else {
        $csrf_error = true;
    }
}
else {
    $submit = false;

    // make a random id
    $_SESSION["_token"] = md5(uniqid(mt_rand(), true));
}
?>
 <?php echo $firstNameErr;?>
<div class="row">
    <div class="col-md-12">


        <?php if (!$submit || !empty($firstNameErr) || !empty($lastNameErr) || !empty($emailErr) ) { ?>
            <h1 id="start">Contact Linndustries</h1>
            <form name="contact" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="row">
                            <input type="hidden" name="csrf" value="<?php echo $_SESSION["_token"]; ?>">
                            <input type="hidden" name="subject" value="Pacific ADA Form Submission">
                            <input type="hidden" name="required" value="firstName,lastName,email">
                            <input type="hidden" name="missing_fields_redirect" value="/contact/index.php">

                            <div class="form-group padding-6">
                                <div class="col-sm-12 pull-left">
                                    <label control-label first" for="firstName">*First name <span class="error"><?php echo $firstNameErr;?></span></label>
                                </div>
                                <div class="col-sm-12">
                                    <input id="firstName" name="firstName" type="text" class="form-control" required value="<?=$firstName;?>">
                                </div>
                            </div>

                            <div class="form-group padding-6">
                                <div class="col-sm-12 pull-left">
                                    <label for="col-sm-2 control-label lastName">*Last name <span class="error"><?php echo $lastNameErr;?></span></label>
                                </div>
                                <div class="col-sm-12">
                                    <input id="lastName" name="lastName" type="text" class="form-control" required value="<?=$lastName;?>">
                                </div>
                            </div>

                            <div class="form-group padding-6">
                                <div class="col-sm-12 pull-left">
                                    <label for="col-sm-2 control-label email pull-left">*E-mail Address <span class="error"><?php echo $emailErr;?></span></label>
                                </div>
                                <div class="col-sm-12">
                                    <input id="email" name="email" type="email" class="form-control" required value="<?=$email;?>">
                                </div>
                            </div> 
                            
                            <div class="form-group padding-6">
                                <div class="col-sm-12 pull-left">
                                    <label for="message">Please leave me a message</label>
                                </div>
                                <div class="col-sm-12">
                                    <textarea id="message" rows="5" name="message" class="form-control" required value="<?=$message;?>"></textarea>
                                </label>

                                <label for="gender" class="ghi">Gender
                                <input id='gender' name='gender' type='text' size='8' class="ghi">
                            </label>

                            <div class="form-group margin-top-20 padding-6">
                                <div class="col-sm-12 pull-right">
                                    <button type="submit" class="btn btn-default pull-right">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php 
        }
        else {
           $message = wordwrap("Sent from www.linnard.com\r\n\r\n The person entered: $email as the return email address.\r\n\r\nIf you reply to this message, it will be sent to $email\r\n\r\nFirst name: $firstName\r\n\r\nLast name: $lastName\r\n\r\nMessage: $message\r\n\r\n");

            $address = "dslinnard@yahoo.com";

            $from="From: $email";
            $subject="Contact From Linndustries";

            if (!blackListedTerms($message)) {
                if (!mail( "$address", "$subject", "$message", "$from")) {
                    echo "<p>There was a problem with email delivery of your address. Please contact the <a href='email.php?email=Webmaster'>Web Master</a> and let the web team know of the problem.</p>";
                }
            }
            ?>
            <h1>Thank you for your interest or comments</h1>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <p>I will contact you as soon as possible regarding your submission.</p>
                </div>
            </div>
        <?php } ?>
    </div>
</div> 
        
<?php include 'footer.php';?>
