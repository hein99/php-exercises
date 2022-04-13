<?php
require_once('DataObject.class.php');

class Member extends DataObject {
    
    protected $data = array(
        'id' => '',
        'username' => '',
        'password' => '',
        'first_name' => '',
        'last_name' => '',
        'join_date' => '',
        'gender' => '',
        'favorite_genre' => '',
        'email_address' => '',
        'other_interests' => ''
    ); 

    private $_genres = array(
        'crime' => 'Crime',
        'horror' => 'Horror',
        'thriller' => 'Thriller',
        'romance' => 'Romance',
        'sciFi' => 'Sci-Fi',
        'adventure' => 'Adventure',
        'nonFiction' => 'Non-Fiction'
    );

    public static function getMembers( $start_row, $num_rows, $order ) {
        $conn = parent::connect();

        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TB_MEMBERS . " ORDER BY $order LIMIT :start_row, :num_rows";

        try {
            $statement = $conn->prepare( $sql );
            $statement->bindValue( ':start_row', $start_row, PDO::PARAM_INT );
            $statement->bindValue( ':num_rows', $num_rows, PDO::PARAM_INT );
            $statement->execute();

            $members = array();
            foreach( $statement->fetchAll() as $row ) {
                $members[] = new Member( $row );
            }

            $statement = $conn->query( 'SELECT found_rows() AS totalRows' );
            
            $row = $statement->fetch();

            parent::disconnect( $conn );

            return array( $members, $row['totalRows'] );
        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( 'Query failed: ' . $e->getMessage() );
        }
    }

    public static function getMember( $id ) {
        $conn = parent::connect();

        $sql = "SELECT * FROM " . TB_MEMBERS . " WHERE id = :id";

        try {
            $statement = $conn->prepare( $sql );
            $statement->bindValue( ':id', $id, PDO::PARAM_INT );
            $statement->execute();

            $row = $statement->fetch();

            parent::disconnect( $conn );

            if( $row ) return new Member( $row );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( 'Query failed: ' . $e->getMessage() );
        }
    }

    public static function getByUsername( $username ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TB_MEMBERS . " WHERE username = :username";

        try {
            $statement = $conn->prepare( $sql );
            $statement->bindValue( ":username", $username, PDO::PARAM_STR );
            $statement->execute();

            $row = $statement->fetch();

            parent::disconnect( $conn );

            if( $row ) return new Member( $row );
        } catch ( PDOException $e ) {
            parent::disconnect($conn);
            die ( "Query failed: " . $e->getMessage() );
        }
    }

    public static function getByEmailAddress( $email_address ) {
        $conn = parent::connect();
        $sql = 'SELECT * FROM ' . TB_MEMBERS . ' WHERE email_address = :email_address';

        try{
            $statement = $conn->prepare( $sql );
            $statement->bindValue( ':email_address', $email_address, PDO::PARAM_STR );
            $statement->execute();

            $row = $statement->fetch();

            parent::disconnect( $conn );

            if( $row ) return new Member( $row );
        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die ( "Query failed: " . $e->getMessage() );
        } 
    }

    public function insert() {
        $conn = parent::connect();
        $sql = "INSERT INTO " . TB_MEMBERS . ' (
            username,
            password,
            first_name,
            last_name,
            join_date,
            gender,
            favorite_genre,
            email_address,
            other_interests
        ) VALUES (
            :username,
            password(:password),
            :first_name,
            :last_name,
            :join_date,
            :gender,
            :favorite_genre,
            :email_address,
            :other_interests
        )';

        try {
            $statement = $conn->prepare( $sql );
            $statement->bindValue( ':username', $this->data['username'], PDO::PARAM_STR );
            $statement->bindValue( ':password', $this->data['password'], PDO::PARAM_STR );
            $statement->bindValue( ':first_name', $this->data['first_name'], PDO::PARAM_STR );
            $statement->bindValue( ':last_name', $this->data['last_name'], PDO::PARAM_STR );
            $statement->bindValue( ':join_date', $this->data['join_date'], PDO::PARAM_STR );
            $statement->bindValue( ':gender', $this->data['gender'], PDO::PARAM_STR );
            $statement->bindValue( ':favorite_genre', $this->data['favorite_genre'], PDO::PARAM_STR );
            $statement->bindValue( ':email_address', $this->data['email_address'], PDO::PARAM_STR );
            $statement->bindValue( ':other_interests', $this->data['other_interests'], PDO::PARAM_STR );
            $statement->execute();

            parent::disconnect( $conn );
        } catch (PDOException $e) {
            parent::disconnect( $conn );
            echo "Here: " . $sql . '<br>';
            die( "Query failed: " . $e->getMessage() );
        }
    }

    public function authenticate() {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TB_MEMBERS . ' WHERE username = :username AND password = password(:password)';

        try {
            $statement = $conn->prepare( $sql );
            $statement->bindValue( ':username', $this->data['username'], PDO::PARAM_STR );
            $statement->bindValue( ':password', $this->data['password'], PDO::PARAM_STR );
            $statement->execute();

            $row = $statement->fetch();
            
            parent::disconnect( $conn );
            if( $row ) return new Member( $row );
        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    public function getGenderString() {
        return ( $this->data['gender'] == 'f' ) ? 'Female' : 'Male';
    }

    public function getFavouriteGenreString() {
        return ( $this->_genres[$this->data['favorite_genre']] );
    }

    public function getGenres() {
        return $this->_genres;
    }


}