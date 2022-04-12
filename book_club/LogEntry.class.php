<?php

require_once('DataObject.class.php');

class LogEntry extends DataObject {

    protected $data = array(
        'member_id' => '',
        'page_url' => '',
        'num_visits' => '',
        'last_access' => ''
    );

    public static function getLogEntries( $member_id ) {
        $conn = parent::connect();

        $sql = "SELECT * FROM ". TB_ACCESS_LOG . " WHERE member_id = :member_id ORDER BY last_access DESC";

        try {
            $statement = $conn->prepare( $sql );
            $statement->bindValue( ':member_id', $member_id, PDO::PARAM_INT );
            $statement->execute();

            $logEntries = array();
            foreach( $statement->fetchAll() as $row ) {
                $logEntries[] = new LogEntry( $row );
            }

            parent::disconnect( $conn );

            return $logEntries;
        } catch( PDOException $e ) {
            parent::disconnect( $conn );
            die( 'Query failed: ' . $e->getMessage() );
        }
    }
}

?>