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

    public function record() {
        $conn = parent::connect();
        
        $sql = "SELECT * FROM " . TB_ACCESS_LOG . " WHERE member_id = :member_id AND page_url = :page_url";
        
        try{
            $statement = $conn->prepare( $sql );
            $statement->bindValue( ':member_id', $this->data['member_id'], PDO::PARAM_INT );
            $statement->bindValue( ':page_url', $this->data['page_url'], PDO::PARAM_STR );
            $statement->execute();

            if( $statement->fetch() ) {
                $sql = "UPDATE " . TB_ACCESS_LOG . " SET num_visits = num_visits + 1 WHERE member_id = :member_id AND page_url = :page_url";
                $statement = $conn->prepare( $sql );
                $statement->bindValue( ':member_id', $this->data['member_id'], PDO::PARAM_INT );
                $statement->bindValue( ':page_url', $this->data['page_url'], PDO::PARAM_STR );
                $statement->execute();
            } else {
                $sql = "INSERT INTO " . TB_ACCESS_LOG . " ( member_id, page_url, num_visits ) VALUES ( :member_id, :page_url, 1 )";
                $statement = $conn->prepare( $sql );
                $statement->bindValue( ':member_id', $this->data['member_id'], PDO::PARAM_INT );
                $statement->bindValue( ':page_url', $this->data['page_url'], PDO::PARAM_STR );
                $statement->execute();
            }
            parent::disconnect( $conn );
        } catch( PDOException $e ) {
            parent::disconnect( $conn );
            die( 'Query failed: ' . $e->getMessage() );
        }
    }

    public static function deleteAllForMember( $member_id ) {
        $conn = parent::connect();
        $sql = "DELETE FROM " . TB_ACCESS_LOG . " WHERE member_id = :member_id";

        try {
            $statement = $conn->prepare( $sql );
            $statement->bindValue( ':member_id', $member_id, PDO::PARAM_INT );
            $statement->execute();
            parent::disconnect( $conn );
        } catch( PDOException $e ) {
            parent::disconnect( $conn );
            die( 'Query failed: ' . $e->getMessage() );
        }
    }
}

?>