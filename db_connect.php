<?php 

include_once("config.php");

$connection = mysqli_connect(
    $DB['host'],
    $DB['login'],
    $DB['password'],
    $DB['name'],
);

mysqli_query(
    $connection,
    "SET NAMES '" . $DB['charset'] . "_unicode_ci';"
);
mysqli_query(
    $connection,
    "SET CHARACTER SET '" . $DB['charset'] . "_unicode_ci';"
);
mysqli_query(
    $connection,
    "SET time_zone = '" . TIME_ZONE . "';"
);
mysqli_query(
    $connection,
    "SET group_concat_max_len = 999999;"
);

if(mysqli_connect_errno()){
    echo "Owibka podklucheniya k bd (" .
    mysqli_connect_errno . "): " . mysqli_connect_errno();
    exit();
}

if(!$connection->set_charset($DB['charset'])){
    printf(
        "Owibka pri zagruzke nabora simvolov " . $DB['charset']
        . ": %s\n",
        $connection->error
    );
    exit();
}