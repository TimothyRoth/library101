<?php

$query = $_POST['query'] ?? null;
$app = new \App\App();

if (isset($query)):
    try {
        $query = $app->mysql($query);
        var_dump($query);
    } catch (\PDOException|Exception $e) {
        echo $e->getMessage();
    }
endif; ?>


<form method="POST">
    <input type="text" name="query"/>
    <input type="submit" value="Submit"/>
</form>
