<?php
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    //set Timezone
    // date_default_timezone_set('Asia/Kolkata');

    require 'phpmailer/vendor/autoload.php';
    require 'dotenv/vendor/autoload.php';


    class Config
    {
        public $baseURL;
        private string $SMTP_HOST;
        private string $SMTP_USERNAME;
        private string $SMTP_PASSWORD;
        private string $SMTP_FROM_ADDRESS;
        private string $SMTP_FROM_NAME;
        private string $SMTP_SECURE;
        private int $SMTP_PORT;
        //database
        private string $DATABASE_HOST;
        private string $DATABASE_USERNAME;
        private string $DATABASE_PASSWORD;
        private string $DATABASE_NAME;
        //build
        private string $BUILD_ENVIRONMENT;

        public function __construct()
        {
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'./../');
            $dotenv->safeLoad();
            
            $this->baseURL = "http://localhost/Ecom/v2";

            $this->SMTP_HOST = $_ENV['SMTP_HOST'];
            $this->SMTP_USERNAME = $_ENV['SMTP_USERNAME'];
            $this->SMTP_PASSWORD = $_ENV['SMTP_PASSWORD'];
            $this->SMTP_FROM_ADDRESS = $_ENV['SMTP_FROM_ADDRESS'];
            $this->SMTP_FROM_NAME = $_ENV['SMTP_FROM_NAME'];
            $this->SMTP_SECURE = $_ENV['SMTP_SECURE'];
            $this->SMTP_PORT = $_ENV['SMTP_PORT'];

            $this->DATABASE_HOST = $_ENV['DATABASE_HOST'];
            $this->DATABASE_USERNAME = $_ENV['DATABASE_USERNAME'];
            $this->DATABASE_PASSWORD = $_ENV['DATABASE_PASSWORD'];
            $this->DATABASE_NAME = $_ENV['DATABASE_NAME'];

            $this->BUILD_ENVIRONMENT = $_ENV['BUILD_ENVIRONMENT'];
        }

        // public function baseURL()
        // {
        //     return $this->baseURL;
        // }

        public function baseURL()
        {
            if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {
                // If local, use local base URL
                $baseURL = "http://localhost/Ecom/v2";
        
                $uid="";
                if(isset($_COOKIE['uid'])){
                    $uid=$_COOKIE['uid'];
                }else{
                    // header("Location: $baseURL");
                }
                
            }elseif($_SERVER['HTTP_HOST'] == '192.168.2.128'){
                $baseURL = "http://192.168.2.128/Ecom/v2";
        
                $uid="";
                if(isset($_COOKIE['uid'])){
                    $uid=$_COOKIE['uid'];
                }else{
                    // header("Location: $baseURL");
                }
            } else {
                // If live, use live base URL
                $baseURL = "http://192.168.2.128/Ecom/v2";
        
                $uid="";
                if(isset($_COOKIE['uid'])){
                    $uid=$_COOKIE['uid'];
                }else{
                    // header("Location: $baseURL");
                }
            }
            return $baseURL;
        }
        

        public function connection() {
            $conn=mysqli_connect("".$this->DATABASE_HOST."","".$this->DATABASE_USERNAME."","".$this->DATABASE_PASSWORD."","".$this->DATABASE_NAME."");
            if(!$conn){
                echo json_encode(['status' => 'error', 'message' => 'Connection Failed!']);
                die;
            }else{
                // echo "Connection Success";
            }
            return $conn;
        }


    }
?>