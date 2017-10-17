<?php if (!session_id()) session_start(); // start up the PHP session 
include_once '../includes/functions.php';
include_once '../includes/opendatabase.php';
set_include_path( $_SERVER['DOCUMENT_ROOT'].'/includes');

$last_name = GET_alphabetical_string("email");
if(!$last_name)
{
	header ("Location: ./staff.php");
}
$pub_id = GET_number("pub_id");

# the associative array to get a full name from the $last_name key to output as 'To: so and so' 
$full_name = array(					
	'AddConference' => 'Add a Calendar Event',
	'Marquand' => 'Abby Marquand',
	'Alameida' => 'Marshall Alameida',
	'Anderson' => 'Wayne Anderson',
	'Angelelli' => 'Joseph Angelelli',
	'Ask_Mike' => 'Ask Mike a Question',
	'Biswas' => 'Radha Biswas',
	'Chamberlin' => 'Judi Chamberlin',
	'Chapman' => 'Susan A. Chapman',
	'Chadiha' => 'Letha Chadiha',
	'Chattopadhyay' => 'Arpita Chattopadhyay',
	'Collins' => 'Mike Collins',
	'ConferenceHotel' => 'Conference Hotel Registration',
	'DeGraff' => 'Alfred H. DeGraff',
	'Dilworth' => 'Peggye Dilworth-Anderson',
	'DocumentRequest' => 'Document request',
	'Dowling' => 'Maggie Dowling',
	'Edelstein' => 'Steven Edelstein',
	'Eversley' => 'Rani Eversley',
	'Fries' => 'Brant Fries',
	'General_mailbox' => 'Center for PAS general mailbox',
	'Gershon' => 'Robyn Gershon',
	'Gold' => 'Stephen F. Gold',
	'Graham' => 'Carrie Graham',
	'Grossman' => 'Brian R. Grossman',
	'Harrington' => 'Charlene Harrington',
	'Hendricks' => 'D.J. Hendricks',
	'Henry' => 'Jill Tabbutt-Henry',
	'Hernandez' => 'Mauro Hernandez',
	'Hollister' => 'Brooke Hollister',
	'Houtrow' => 'Amy Houtrow',
	'Huda' => 'Amina Huda',
	'Humphrey' => 'Michael Humphrey',
	'James' => 'Mary James',
	'Jans' => 'Lita Jans',
	'Jones' => 'Erica C. Jones',
	'Kafka' => 'Bob Kafka',
	'Kailes' => 'June Kailes',
	'Kang' => 'Taewoon Kang',
	'Kaye' => 'Stephen Kaye',
	'Kahn' => 'Karen Kahn',
	'Kitchener' => 'Martin Kitchener',
	'Kraus' => 'Lewis Kraus',
	'LaPlante' => 'Mitch LaPlante',
	'Leef' => 'Elizabeth Leef',
	'Linnard' => 'David Linnard',
	'Mendelsohn' => 'Steve Mendelsohn',
	'Miller' => 'Nancy Miller',
	'Misra' => 'Sita Misra',
	'Morris' => 'Michael Morris',
	'Neri' => 'Melinda Neri',
	'draftFeedback' =>  'Draft feedback',
	'Newcomer' => 'Robert Newcomer',
	'Ng' => 'Terence Ng',
	'Oakes-Greenspan' => 'Marilyn Oakes-Greenspan',
	'Orslene' => 'Louis Orslene',
	'Oxford' => 'Mike Oxford',
	'Pazdral' => 'Liz Pazdral',
	'PAS_Stories' => 'PAS Stories',
	'Portacolone' => 'Elena Portacolone', 
	'Ripple' => 'Joan Ripple',
	'Ross' => 'Leslie Ross',
	'Scherzer' => 'Teresa Scherzer',
	'Schulz' => 'Lee Schulz',
	'Seavey' => 'Dorie Seavey',
	'Sherwin' => 'Liz Sherwin',
	'Solovieva' => 'Tatiana Solovieva',
	'SOS_Conference' => 'SOS Conference',
	'Napoles' => 'Anna M. N&aacute;poles',
	'Stone' => 'Robyn I. Stone',
	'Torres' => 'Fernando Torres-Gil',
	'Turnham' => 'Hollis Turnham',
	'Usiak' => 'Douglas J. Usiak',
	'Webmaster' => 'The Center for PAS Web Team',
	'Wiener' => 'Joshua Wiener',
	'Willmott' => 'Mickey Willmott',
	'Wong' => 'Alice Wong');

include '../includes/init.php'; ?>

<style type="text/css">
p
{
	padding-bottom:2ex;
}
</style>

<title>Email <?php echo $full_name["$last_name"]; ?></title>
<meta name="description" content="Send an email to a staff member.">

</head>

<body>
<?php include 'header.php';?>
<?php include 'sidebar.php';?>

<h1>Email the PAS Center</h1>
<p><span class="red bold">* Required fields</span></p>

<p>To: <?php echo $full_name["$last_name"]; ?></p>

<form method="POST" action="sendcontactemail.php">
	<input type='hidden' name='last_name' value='<?php echo $last_name; ?>'>
	<input type='hidden' name='full_name' value='<?php echo $full_name["$last_name"]; ?>'>
	<input type='hidden' name='pub_id' value='<?php echo $pub_id; ?>'>
	<input type='hidden' name='missing_fields_redirect' value="./email.php?email=<?php echo $last_name; ?>">

	<p><label for="e_mail">Your e-mail address:</label>
    <input NAME="e_mail" id="e_mail" type="text" SIZE="25" MAXSIZE="50" class="abc"> 
   	 <span class="red bold">*</span></p>
    
        <input name="email" id="email" type="text" SIZE="30" MAXSIZE="50" class="ghi">
            
     
         <?php if( $last_name=="AddConference"){ ?>
    <p><label for="comments">Please enter event details and or a website address:</label></p>
            <textarea id="comments" name="comments" rows="6" cols="70">Event details and or a website address.</textarea>
		<?php } else if( $last_name=="ConferenceHotel"){ ?>
			<label for="comments">Please fill in the registration request form below. On submission you will be contacted by Albert Chrost.<br></label>
            <textarea id="comments" name="comments" rows="6" cols="70">
Name:  
Address:  
Telephone:  
Special Communication needs:  
</textarea>
		<?php } else { ?>
    <label for="comments">Your message:</label><br><br>
<?php if( $last_name=="DocumentRequest"){ ?>
    <textarea id='comments' name='comments' rows='6' cols='70'>Request for electronic pdf of document</textarea>
<?php } else { ?>
    <textarea id='comments' name='comments' rows='6' cols='70'>Enter your comments here.</textarea>
<?php } } ?>
        <p><input type="submit" value="Submit"></p>
        </FORM>

      
<?php include 'foot.php';?>