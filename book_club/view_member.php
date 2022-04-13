<?php

require_once('common.inc.php');

$member_id = isset( $_GET['member_id'] ) ? (int)$_GET['member_id'] : 0;

if( !$member = Member::getMember($member_id) ) {
    displayPageHeader( 'Error' );
    echo "<div>Member not found.</div>";
    displayPageFooter();
    exit();
}

$logEntries = LogEntry::getLogEntries( $member_id );
displayPageHeader( 'View member: ' . $member->getValueEncoded( 'first_name' ) . ' '. $member->getValueEncoded( 'last_name' ) );
?>

<dl>
    <dt>Username</dt>
    <dd><?php echo $member->getValueEncoded( 'username' ) ?></dd>
    <dt>First name</dt>
    <dd><?php echo $member->getValueEncoded( 'first_name' ) ?></dd>
    <dt>Last name</dt>
    <dd><?php echo $member->getValueEncoded( 'last_name' ) ?></dd>
    <dt>Joined on</dt>
    <dd><?php echo $member->getValueEncoded( 'join_date' ) ?></dd>
    <dt>Gender</dt>
    <dd><?php echo $member->getGenderString() ?></dd>
    <dt>Favorite genre</dt>
    <dd><?php echo $member->getFavouriteGenreString() ?></dd>
    <dt>Email address</dt>
    <dd><?php echo $member->getValueEncoded( 'email_address' ) ?></dd>
    <dt>Other interests</dt>
    <dd><?php echo $member->getValueEncoded( 'other_interests' ) ?></dd>
</dl>

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
    <a href="javascript: history.go(-1);">Back</a>
</div>

<?php
displayPageFooter();
?>