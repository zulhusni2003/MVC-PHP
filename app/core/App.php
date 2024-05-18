<?php 
class App {
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];
    
    // The constructor method is automatically called when an instance of the App class is created.
    public function __construct()
    {
        // Call the parseURL method and store the result in the $url variable
        $url = $this->parseURL();
        
        // Controller
        if (!empty($url) && file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        } 

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Method
        if (isset($url[1])) {
            if( method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Params
        if( !empty($url)){
            $this->params = array_values($url);
        }
 
        // Jalankan method & controller, and send params if ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Method to parse the URL from the GET request
    public function parseURL()
    {
        // Check if 'url' is present in the GET parameters
        if(isset($_GET['url'])){
            // Remove any trailing slashes from the URL
            $url = rtrim($_GET['url'], '/');
            // Sanitize the URL to remove invalid characters
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // Split the sanitized URL into an array using '/' as the delimiter
            $url = explode('/', $url);
            // Return the resulting array
            return $url;
        }
    }
}

// Example usage (not part of the given code):
// Assuming the URL is: http://example.com/index.php?url=controller/method/param1/param2
// The output of var_dump($url) would be:
// array(3) { [0]=> string(10) "controller" [1]=> string(6) "method" [2]=> string(6) "param1" [3]=> string(6) "param2" }

// Creating an instance of the App class
$app = new App();
