<?php
// Set the document root directory
$documentRoot = 'public/';

// Set the server host and port
$host = 'localhost';
$port = 8080;

// Start the MySQL server
// You should have MySQL installed and properly configured on your system for this to work
exec('mysql.server start');

// Start the server
echo "Server running on http://$host:$port\n";
exec("php -S $host:$port -t $documentRoot");