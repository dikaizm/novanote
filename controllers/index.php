<?php

view("index.view.php", [
    'heading' => ($_SESSION['user'] ? 'Hello, ' . $_SESSION['user']['name'] : 'Welcome')
]);