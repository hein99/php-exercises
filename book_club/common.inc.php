<?php
require_once('config.php');
require_once('Member.class.php');
require_once('LogEntry.class.php');

function displayPageHeader( $page_title, $member_area = false ) {

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_title ?></title>
        <link rel="stylesheet" href="<?php echo ($member_area) ? '../' : '' ?>common.css">
    </head>
    <body>
        <h1><?php echo $page_title ?></h1>

<?php
}

function displayPageFooter() {
?>
    </body>
    </html>
<?php
}

function validateField( $field_name, $missing_fields ) {
    if( in_array( $field_name, $missing_fields ) ) echo ' class="error"';
}

function setChecked( DataObject $obj, $field_name, $field_value ) {
    if( $obj->getValue( $field_name ) == $field_value ) echo ' checked="checked"';
}

function setSelected( DataObject $obj, $field_name, $field_value ) {
    if( $obj->getValue( $field_name ) == $field_value ) echo ' selected="selected"';
}

function checkLogin() {
    session_start();
    if( !$_SESSION['member'] or !$_SESSION['member'] == Member::getMember( $_SESSION['member']->getValue( 'id' ) ) ) {
        $_SESSION['member'] = '';
        header( 'Location: login.php' );
    } else {
        $logEntry = new LogEntry( array(
            'member_id' => $_SESSION['member']->getValue( 'id' ),
            'page_url' => basename( $_SERVER['PHP_SELF'] )
        ) );
        $logEntry->record();
    }
}
?>