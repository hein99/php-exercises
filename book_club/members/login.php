<?php

require_once( '../common.inc.php' );
session_start();

if( isset( $_POST['action'] ) and $_POST['action'] == 'login' ) {
    processForm();
} else {
    displayForm( array(), array(), new Member( array() ) );
}

function displayForm( $error_messages, $missing_fields, $member ) {
    displayPageHeader( "Login to the book club members's area", true );

    if( $error_messages ) {
        foreach( $error_messages as $error_message )
            echo $error_message;
    } else {
?>
    <p>To access the members' area, please enter your username and password below then click Login.</p>
<?php } ?>

    <form action="login.php" method="post" class="login-form">
        <input type="hidden" name="action" value="login">

        <label for="username" <?php validateField( 'username', $missing_fields ) ?>>Username</label>
        <input type="text" name="username" id="username" value="<?php echo $member->getValueEncoded( 'username' ) ?>">

        <label for="password" <?php if( $missing_fields ) echo ' class=error' ?>>Password</label>
        <input type="password" name="password" id="password" value="">

        <input type="submit" name="submit-button" value="Login">
    </form>

<?php
    displayPageFooter();
}

function processForm() {
    $required_fields = array( 'username', 'password' );
    $missing_fields = array();
    $error_messages = array();

    $member = new Member( array(
        'username' => isset( $_POST['username'] ) ? preg_replace( '/[^ \-\_a-zA-Z0-9]/', '', $_POST['username'] ) : '',
        'password' => isset( $_POST['password'] ) ? $_POST['password'] : '',
    ) );

    foreach( $required_fields as $required_field ) {
        if( !$member->getValue( $required_field ) ) $missing_fields[] = $required_field;
    }

    if( $missing_fields ) {
        $error_messages[] = '<p class="error">There were some missing fields in the form you submitted. 
        Please complete the fields highlighted below and click Login to resend the form.</p>';
    } elseif( !$logged_in_member = $member->authenticate() ) {
        $error_messages[] = '<p class="error">Sorry, we could not log you in with 
        those details. Please check your username and password, and try again.</p>';
    }

    if( $error_messages ) {
        displayForm( $error_messages, $missing_fields, $member );
    } else {
        $_SESSION['member'] = $logged_in_member;
        displayThanks();
    }
}

function displayThanks() {
    displayPageHeader( "Thanks for logging in!", true );
?>
    <p>Thank you for logging in. Please proceed to the <a href="index.php">members' area</a>.</p>
<?php
    displayPageFooter();
}
?>