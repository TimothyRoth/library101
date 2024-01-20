<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'autoloader.php';

use App\App;
use App\Controller\User;

$usersController= new User();
$app = new App(); ?>

<table>
    <thead>
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>ID</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($usersController->index() as $user): ?>
            <tr>
                <td><?php echo ucfirst($user->firstname); ?></td>
                <td><?php echo ucfirst($user->lastname); ?></td>
                <td><?php echo $user->id; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
