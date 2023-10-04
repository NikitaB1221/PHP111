<?php

class ApiController
{
    public function serve()
    {
        // // echo 'OopController works';

        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $handler = "do_{$method}";
        if (method_exists($this, $handler)) {
            $this->$handler();
        } else {
            $this->send_error(405);
        }
    }
    protected function log_error($message)
    {
        $log_name = "logs/" . __CLASS__ . ".log";
        $log_file = fopen($log_name, "a");
        fwrite($log_file, date("y-m-d h:i:s") . " | " . $message . "\r\n");
        fclose($log_file);
    }

    protected function send_error($code, $message = false)
    {
        if ($message === false)
            if (isset($this->error_codes[$code])) {
                $message = $this->error_codes[$code];
            } else {
                $message = "Undefined error!";
            }
        http_response_code($code);
        echo $message;
        exit;
    }

    protected function get_db()
    {
        global $db;
        return $db;
    }

    protected $error_codes = [
        400 => "Bad request",
        403 => "Forbidden",
        405 => "HTTP method not allowed by the server",
        500 => "Server error",
    ];
}