<?php
  class DB{
    //   Remote Settings
    // public $host = "localhost";
    // public $user = "u15231748";
    // public $password = "cxgnxdbk";
    // public $database = "dbu15231748";
    // public $connection = null;
    // Local Settings
    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $database = "curve";
    public $connection = null;

    public function __construct() 
    {
        try{
            $this->connection = new Mysqli($this->host, $this->user, $this->password, $this->database);
            if(mysqli_connect_errno())
                throw new Exception();
        }
        catch(Exception $err){
            $base = basename(dirname(dirname(dirname(__FILE__))));
            header("Location: http://$this->host/$base/curve/components/errors/connection.html");
        }
    }

    public function connectionObject(){
        return $this->connection;
    }

    public static function _instance(){
        static $instance = null;
        if($instance == null)
        {
            $instance = new DB();
            return $instance->connectionObject();
        }
        else
            return $instance->connectionObject();
    }
  }

  $connection = DB::_instance();
?>