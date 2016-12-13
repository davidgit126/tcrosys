<?php
$output = shell_exec("ps aux | grep php");
if (!strpos($output, "setup-server.php")) {
shell_exec("php /home/gateway1/setup-server.php");
}
