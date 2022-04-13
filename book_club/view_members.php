<?php

require_once( 'common.inc.php' );

$start = isset( $_GET['start'] ) ? (int)$_GET['start'] : 0;
$order = isset( $_GET['order'] ) ? preg_replace( '/[^_a-zA-z]/', '', $_GET['order'] ) : 'username';

list( $members, $total_rows ) = Member::getMembers( $start, ROW_OF_MEMBERS, $order );
// echo '<pre>'; print_r($members); echo '</pre>';
displayPageHeader( 'Book club members' );

?>

<h2>Displaying members <?php echo $start + 1 ?> - <?php echo min( $start + ROW_OF_MEMBERS, $total_rows) ?> of <?php echo $total_rows ?> </h2>

<table>
    <thead>
        <tr>
            <th>
                <?php if( $order == 'username' ) : ?>
                    Username
                <?php else : ?>
                    <a href="view_members.php?order=username" >Username</a>
                <?php endif; ?>
            </th>
            <th>
                <?php if( $order == 'first_name' ) : ?>
                    First name
                <?php else : ?>
                    <a href="view_members.php?order=first_name" >First name</a>
                <?php endif; ?>
            </th>
            <th>
                <?php if( $order == 'last_name' ) : ?>
                    Last name
                <?php else : ?>
                    <a href="view_members.php?order=last_name" >Last name</a>
                <?php endif; ?>
            </th>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach( $members as $member ) : ?>
            <tr>
                <td>
                    <a href="view_member.php?member_id=<?php echo $member->getValueEncoded("id") ?>"><?php echo $member->getValueEncoded("username") ?></a>
                </td>
                <td><?php echo $member->getValueEncoded("first_name") ?></td>
                <td><?php echo $member->getValueEncoded("last_name") ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="nav-under-table">
    <?php if( $start > 0 ) : ?>
        <a href="view_members.php?start=<?php echo max($start - ROW_OF_MEMBERS, 0) . '&amp;order=' . $order ?>">Previous Page</a>
    <?php endif; ?>

    <?php if( $start + ROW_OF_MEMBERS < $total_rows ) : ?>
        <a href="view_members.php?start=<?php echo min($start + ROW_OF_MEMBERS, $total_rows) . '&amp;order=' . $order ?>">Next Page</a>
    <?php endif; ?>
</div>

<?php
displayPageFooter();
?>