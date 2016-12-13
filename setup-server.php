<?php
//error_reporting(E_ALL);

/* Allow the script to hang around waiting for connections. */
set_time_limit(0);

/* Turn on implicit output flushing so we see what we're getting
 * as it comes in. */
ob_implicit_flush();

// Set the ip and port we will listen on 
$address = '127.0.0.1';
$port = 9523;

// Create a TCP Stream socket 
$sock = socket_create(AF_INET, SOCK_STREAM, 0);
echo "PHP Socket Server started at " . $address . " " . $port . "\n";

// Bind the socket to an address/port 
socket_bind($sock, $address, $port) or die('Could not bind to address');
// Start listening for connections 
socket_listen($sock);

//loop and listen

$password = "!L2owtHYwoT634";

while (true) {
    /* Accept incoming requests and handle them as child processes */
    $client = socket_accept($sock);

    // Read the input from the client . 1024 bytes
    $input = socket_read($client, 1024);

    // Strip all white spaces from input
    $output = preg_replace("([ \t\n\r]+)", "", $input) . "\0";
    if (strpos($output, $password)) {
        if (strpos("-".$output, "delpop")) {
            $output = str_replace("delpop", "", str_replace($password, "", $output));
            if (preg_match("/[A-Za-z0-9]+@[A-Za-z0-9-]+\\.[A-Za-z]+/", $output, $match)) {
                $cmd = "/scripts/delpop --email=" . $match[0];
                echo $cmd;
                exec($cmd);
            }
        } elseif (strpos("-".$output, "verifyaccount")) {
            $output = str_replace("verifyaccount", "", str_replace($password, "", $output));
            if (preg_match("/###([A-Za-z0-9]+)##([A-Za-z0-9-]+)\\.([A-Za-z]+)###/", $output, $match)) {
                $domainFile = file_get_contents("/var/cpanel/users/" . $match[1]);
                if (strpos("-".$domainFile, $match[2].".".$match[3])) {
                    file_put_contents("/home/score700/public_html/verifyaccount", "1");
                } else {
                    socket_write($client, "fail");
                }
            }
        } elseif (strpos("-".$output, "maintenance")) {
            exec("php /home/gateway1/maintenance.php");
        } else {
            if (preg_match("/[A-Za-z0-9]+@[A-Za-z0-9-]+\\.[A-Za-z]+:[A-Za-z0-9]+/", $output, $match)) {
                $output = explode(":", $match[0]);
                // Display output back to client
                // socket_write($client, "you wrote " . $input . "\n");
                $cmd = "/scripts/addpop --email=" . $output[0] . " --password=" . $output[1] . " --quota=1024";
                echo $cmd;
                exec($cmd);
            }
        }
    }
}

// Close the client (child) socket 
socket_close($client);

// Close the master sockets 
socket_close($sock);
