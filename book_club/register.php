<?php

require_once( 'common.inc.php' );

if( isset( $_POST['action'] ) and $_POST['action'] == 'register' ) {
    processForm();
} else {
    displayForm( array(), array(), new Member( array() ) );
}

function displayForm( $error_messages, $missing_fields, $member ) {
    displayPageHeader( "Sign up for the book club!" );

    if( $error_messages ) {
        foreach( $error_messages as $error_message )
            echo $error_message;
    } else { 
?>
    <p>Thanks for choosing to join our book club</p>
    <p>To register, please fill in your details below and click Send Details.</p>
    <p>Fields marked with an asterisk (*) are required.</p>
<?php } ?>
    <form action="register.php" method="post" class="register-form">
        <input type="hidden" name="action" value="register">

        <label for="username" <?php validateField( 'username', $missing_fields ) ?>>Choose a username *</label>
        <input type="text" name="username" id="username" value="<?php echo $member->getValueEncoded('username') ?>" required>

        <label for="password1" <?php if( $missing_fields ) echo ' class="error"' ?>>Choose a password *</label>
        <input type="password" name="password1" id="password1" value="" required>

        <label for="password2" <?php if( $missing_fields ) echo ' class="error"' ?>>Retype password *</label>
        <input type="password" name="password2" id="password2" value="" required>
        
        <label for="email-address" <?php validateField( 'email_address', $missing_fields ) ?>>Email address *</label>
        <input type="email" name="email_address" id="email-address" value="<?php echo $member->getValueEncoded('email_address') ?>" required>

        <label for="first-name" <?php validateField( 'first_name', $missing_fields ) ?>>First name *</label>
        <input type="text" name="first_name" id="first-name" value="<?php echo $member->getValueEncoded('first_name') ?>" required>

        <label for="last-name" <?php validateField( 'last_name', $missing_fields ) ?>>Last name *</label>
        <input type="text" name="last_name" id="last-name" value="<?php echo $member->getValueEncoded('last_name') ?>" required>

        <label <?php validateField( 'gender', $missing_fields ) ?> style="display: block;">Your gender: *</label>
        <label for="gender-male">Male</label>
        <input type="radio" name="gender" id="gender-male" value="m" <?php setChecked( $member, 'gender', 'm' ) ?>>
        <label for="gender-female">Female</label>
        <input type="radio" name="gender" id="gender-female" value="f" <?php setChecked( $member, 'gender', 'f' ) ?>>

        <label for="favorite-genre">What's your favorite genre?</label>
        <select name="favorite_genre" id="favorite-genre">
            <?php foreach( $member->getGenres() as $key => $value ) : ?>
                <option value="<?php echo $key ?>" <?php setSelected( $member, 'favorite_genre', $key ) ?>><?php echo $value ?></option>
            <?php endforeach; ?>
        </select>

        <label for="other-interests">What are your other interests?</label>
        <textarea name="other_interests" id="other-interests" cols="30" rows="10"><?php echo $member->getValueEncoded('other_interests') ?></textarea>

        <input type="submit" name="submit-button" value="Send Details">

    </form>
<?php
    displayPageFooter();
}

function processForm() {
    $required_fields = array( 'username', 'password', 'email_address', 'first_name', 'last_name', 'gender' );
    $missing_fields = array();
    $error_messages = array();

    $member = new Member( array(
        'username' => isset( $_POST['username'] ) ? preg_replace( '/[^ \-\_a-zA-z0-9]/', '', $_POST['username'] ) : '',
        'password' => ( isset( $_POST['password1'] ) and isset( $_POST['password2'] ) and $_POST['password1'] == $_POST['password2'] ) ? $_POST['password1'] : '',
        'first_name' => isset( $_POST['first_name'] ) ? preg_replace( '/[^ \-\_a-zA-z0-9]/', '', $_POST['first_name'] ) : '',
        'last_name' => isset( $_POST['last_name'] ) ? preg_replace( '/[^ \-\_a-zA-z0-9]/', '', $_POST['last_name'] ) : '',
        'gender' => isset( $_POST['gender'] ) ? preg_replace( '/[^mf]/', '', $_POST['gender'] ) : '',
        'favorite_genre' => isset( $_POST['favorite_genre'] ) ? preg_replace( '/[^a-zA-z]/', '', $_POST['favorite_genre'] ) : '',
        'email_address' => isset( $_POST['email_address'] ) ? preg_replace( '/[^ \@\.\-\_a-zA-Z0-9]/', '', $_POST['email_address'] ) : '',
        'other_interests' => isset( $_POST['other_interests'] ) ? preg_replace( '/[^ \'\,\.\-a-zA-Z0-9]/', '', $_POST['other_interests'] ) : '',
        'join_date' => date( 'Y-m-d' )
    ) );

    foreach( $required_fields as $required_field ) {
        if( !$member->getValue( $required_field ) ) $missing_fields[] = $required_field;
    }

    if( $missing_fields ) {
        $error_messages[] = '<p class="error">There were some missing fields in the form you submitted. 
        Please complete the fields highlighted below and click Send Details to resend the form.</p>';
    }

    if( Member::getByUsername( $member->getValue( 'username' ) ) ) {
        $error_message[] = '<p class="error">> A member with that username 
        already exists in the database. Please choose another username.</p>';
    }

    if( Member::getByEmailAddress( $member->getValue( 'email_address' ) ) ) {
        $error_message[] = '<p class="error">A member with that email address 
        already exists in the database. Please choose another email address, or 
        contact the webmaster to retrieve your password.</p>';
    }

    if( $error_messages ) {
        displayForm( $error_messages, $missing_fields, $member );
    } else {
        $member->insert();
        displayThanks();
    }
}

function displayThanks() {
    displayPageHeader( "Thanks for registering!" );
?>
    <p>Thank you, you are now a registered member of the book club.</p>
<?php
    displayPageFooter();
}
?>