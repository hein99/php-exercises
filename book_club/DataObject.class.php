<?php

require_once('config.php');

abstract class DataObject {

    protected $data = array();

    public function __construct( $data ) {
        foreach( $data as $key => $val )
            if( array_key_exists( $key, $this->data ) ) $this->data[$key] = $val;
    }

    public function getValue( $field ) {
        if( array_key_exists( $field, $this->data ) ) 
            return $this->data[ $field ];
        else
            die( 'Field not found' );
    }

    public function getValueEncoded( $field ) {
        return htmlspecialchars( $this->getValue( $field ) );
    }

    public static function connect() {
        try {
            $conn = new PDO( 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD );
            $conn->setAttribute( PDO::ATTR_PERSISTENT, true );
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch ( PDOException $e ) {
            die( "Connection failed: " . $e->getMessage() );
        }
        
        return $conn;
    }

    public static function disconnect( $conn ) {
        $conn = null;
    }

}