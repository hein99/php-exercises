<?php

require_once('common.inc.php');

$member_id = isset( $_REQUEST['member_id'] ) ? (int)$_REQUEST['member_id'] : 0;

if( !$member = Member::getMember($member_id) ) {
    displayPageHeader( 'Error' );
    echo "<div>Member not found.</div>";
    displayPageFooter();
    exit();
}

if( isset( $_POST['action'] ) and $_POST['action'] == 'save_changes' ) {
    saveMember();
} elseif( isset( $_POST['action'] ) and $_POST['action'] == 'delete_member' ) {
    deleteMember();
} else {
    displayForm( array(), array(), $member );
}

function displayForm( $error_messages, $missing_fields, $member ) {

$start = isset( $_REQUEST['start'] ) ? (int)$_REQUEST['start'] : 0;
$order = isset( $_REQUEST['order'] ) ? preg_replace( '/[^ a-zA-Z]/', '', $_REQUEST['order'] ) : 'username';

$logEntries = LogEntry::getLogEntries( $member->getValue( 'id' ) );
displayPageHeader( 'View member: ' . $member->getValueEncoded( 'first_name' ) . ' '. $member->getValueEncoded( 'last_name' ) );

if( $error_messages ) {
    foreach( $error_messages as $error_message )
        echo $error_message;
}
?>

<form action="view_member.php" method="post" class="register-form">
    <input type="hidden" name="member_id" value="<?php echo $member->getValueEncoded( 'id' ) ?>">
    <input type="hidden" name="start" value="<?php echo $start ?>">
    <input type="hidden" name="order" value="<?php echo $order ?>">

    <label for="username"<?php validateField( 'username', $missing_fields ) ?>>Username *</label>
    <input type="text" name="username" id="username" value="<?php echo $member->getValueEncoded( 'username' ) ?>">

    <label for="password">New password</label>
    <input type="password" name="password" id="password" value="">

    <label for="email_address"<?php validateField( 'email_address', $missing_fields ) ?>>Email Address *</label>
    <input type="email" name="email_address" id="email_address" value="<?php echo $member->getValueEncoded( 'email_address' ) ?>">

    <label for="first_name"<?php validateField( 'fist_name', $missing_fields ) ?>>First name *</label>
    <input type="text" name="first_name" id="first_name" value="<?php echo $member->getValueEncoded( 'first_name' ) ?>">

    <label for="last_name"<?php validateField( 'last_name', $missing_fields ) ?>>Last name *</label>
    <input type="text" name="last_name" id="last_name" value="<?php echo $member->getValueEncoded( 'last_name' ) ?>">

    <label for="join_date"<?php validateField( 'join_date', $missing_fields ) ?>>Join on *</label>
    <input type="text" name="join_date" id="join_date" value="<?php echo $member->getValueEncoded( 'join_date' ) ?>">

    <label <?php validateField( 'gender', $missing_fields ) ?> style="display: block;">Gender *</label>
    <label for="gender_male">Male</label>
    <input type="radio" name="gender" id="gender_male" value="m"<?php setChecked( $member, 'gender', 'm' ) ?>>
    <label for="gendr_female">Female</label>
    <input type="radio" name="gender" id="gender_female" value="f"<?php setChecked( $member, 'gender', 'f' ) ?>>

    <label for="favorite_genre">Favorite Genre</label>
    <select name="favorite_genre" id="favorite_genre">
        <?php foreach( $member->getGenres() as $key => $value ) : ?>
            <option value="<?php echo $key ?>"<?php setSelected( $member, 'favorite_genre', $value ) ?>><?php echo $value ?></option>
        <?php endforeach; ?>
    </select>

    <label for="other_interests">Other interests</label>
    <textarea name="other_interests" id="other_interests" cols="30" rows="10"><?php echo $member->getValueEncoded( "other_interests" ) ?></textarea>

    <input type="submit" name="action" value="save_changes">
    <input type="submit" name="action" value="delete_member">
</form>
 
<h2>Access Log</h2>

<table>
    <thead>
        <tr>
            <th>Web page</th>
            <th>Number of visits</th>
            <th>Last visit</th>
        </tr>
    <thead>

    <tbody>
        <?php foreach( $logEntries as $logEntry ) : ?>
            <tr>
                <td><?php echo $logEntry->getValueEncoded( 'page_url' ) ?></td>
                <td><?php echo $logEntry->getValueEncoded( 'num_visits' ) ?></td>
                <td><?php echo $logEntry->getValueEncoded( 'last_access' ) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="nav-under-table">
    <a href="view_members.php?start=<?php echo $start ?>&amp;order=<?php echo $order ?>">Back</a>
</div>

<?php
displayPageFooter();
}

function saveMember() {
    $required_fields = array( 'username', 'email_address', 'first_name', 'last_name', 'join_date', 'gender' );
    $missing_fields = array();
    $error_messages = array();

    $member = new Member( array(
        'id' => isset( $_POST['member_id'] ) ? (int)$_POST['member_id'] : '',
        'username' => isset( $_POST['username'] ) ? preg_replace( '/[^ \-\_a-zA-Z0-9]/', '', $_POST['username'] ) : '',
        'password' => isset( $_POST['password'] ) ? $_POST['password'] : '',
        'email_address' => isset( $_POST['email_address'] ) ? preg_replace( '/[^\@\.\-\_a-zA-Z0-9]/', '', $_POST['email_address'] ) : '',
        'first_name' => isset( $_POST['first_name'] ) ? preg_replace( '/[^ \'\-a-zA-Z0-9]/', '', $_POST['first_name'] ) : '' ,
        'last_name' => isset( $_POST['last_name'] ) ? preg_replace( '/[^ \'\-a-zA-Z0-9]/', '', $_POST['last_name'] ) : '' ,
        'join_date' => isset( $_POST['join_date'] ) ? preg_replace( '/[^ \-0-9]/', '', $_POST['join_date'] ) : '' ,
        'gender' => isset( $_POST['gender'] ) ? preg_replace( '/[^mf]/', '', $_POST['gender'] ) : '' ,
        'favorite_genre' => isset( $_POST['favorite_genre'] ) ? preg_replace( '/[^a-zA-z]/', '', $_POST['favorite_genre'] ) : '',
        'other_interests' => isset( $_POST['other_interests'] ) ? preg_replace( '/[^ \'\,\.\-a-zA-Z0-9]/', '', $_POST['other_interests'] ) : ''
    ) );

    foreach( $required_fields as $required_field ) {
        if( !$member->getValue( $required_field ) ) $missing_fields[] = $required_field;
    }

    if( $missing_fields ) {
        $error_messages[] = '<p class="error">There were some missing fields in the form you submitted.
        Please complete the fields highlighted below and click Save Changes to resend the form.</p>';
    }

    if( $existing_member =  Member::getByUsername( $member->getValue( 'username' ) ) and $existing_member->getValue( 'id' ) != $member->getValue( 'id' ) ) {
        $error_messages[] = '<p class="error">A member with that username already exists in the database. Please choose another username.</p>';
    }

    if( $existing_member = Member::getByUsername( $member->getValue( 'email_address' ) ) and $existing_member->getValue( 'id' ) != $member->getValue( 'id' ) ) {
        $error_messages[] = '<p class="error">A member with that email address already exists in the database. Please choose another email address.</p>';
    }

   if( $error_messages ) {
        displayForm( $error_messages, $missing_fields, $member );
    } else {
        $member->update();
        displaySuccess();
    }
}

function deleteMember() {
    $member = new Member( array(
        'id' => isset( $_POST['member_id'] ) ? (int)$_POST['member_id'] : '',
    ) );
    LogEntry::deleteAllForMember( $member->getValue( 'id' ) );
    $member->delete();
    displaySuccess();
}

function displaySuccess() {
    $start = isset( $_REQUEST['start'] ) ? (int)$_REQUEST['start'] : 0;
    $order = isset( $_REQUEST['order'] ) ? preg_replace( '/[^ a-zA-Z]/', '', $_REQUEST['order'] ) : 'username';

    displayPageHeader( 'Changes saved' );
?>
    <p>Your changes have been saved. <a href="view_members.php?start=<?php echo $start ?>&amp;order=<?php echo $order ?>">Return to member list</a></p>

<?php
    displayPageFooter();
}
?>