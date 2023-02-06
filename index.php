<?php 

include_once("config.php");
include_once("err_handler.php");
include_once("db_connect.php");
include_once("functions.php");
include_once("find_token.php");

if(!isset($_GET['type'])) {
    echo ajax_echo(
        "Error", 
        "You didn't specify the GET type parameter", 
        true, 
        "Detected", 
        null 
    );
    exit();
}
// Список имеющейся железнодорожной продукции
if(preg_match_all("/^(show_railway_products)$/ui", $_GET['type'])){
    $query = "SELECT `product_id`, `train_name`, `train_status`, `train_status`, `Direction`  FROM `Railway_products`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Error", 
            "Error in request with railway_products", 
            true, 
            "Detected", 
            null 
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }

    
    echo ajax_echo(
        "Railway products",
        "List of railway products",
        false, 
        "Not detected", 
        $arr_list 
    );

    exit();
}
// Список имеющихся клиентов
if(preg_match_all("/^(show_clients)$/ui", $_GET['type'])){
    $query = "SELECT `First_name`, `Last_name`, `Middle_name`, `Number_of_trips`, `Last_trip` FROM `Clients`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Error", 
            "Error with clients", 
            true, 
            "Detected", 
            null 
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }

    
    echo ajax_echo(
        "Clients",
        "List of clients",
        false, 
        "Not detected", 
        $arr_list 
    );

    exit();
}

// Список имеющихся водителей железнодорожного транспорта
if(preg_match_all("/^(show_drivers)$/ui", $_GET['type'])){
    $query = "SELECT `First_Name`, `Middle_Name`, `Last_Name`, `Linked_train_name` FROM `Drivers`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Error", 
            "Error with drivers", 
            true, 
            "Detected", 
            null 
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }

    
    echo ajax_echo(
        "Drivers",
        "List of drivers",
        false, 
        "Not detected", 
        $arr_list 
    );

    exit();
}

// Список возможных состояний поездов
if(preg_match_all("/^(show_train_status)$/ui", $_GET['type'])){
    $query = "SELECT `id`, `description_of_train_status` FROM `train_status`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Error", 
            "Error with train_status", 
            true, 
            "Detected", 
            null 
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }

    
    echo ajax_echo(
        "Train_status",
        "List of train status",
        false, 
        "Not detected", 
        $arr_list 
    );

    exit();
}

// Список возможных состояний поездок
if(preg_match_all("/^(show_trip_status)$/ui", $_GET['type'])){
    $query = "SELECT `id`, `description_of_trip_status` FROM `trip_status`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Error", 
            "Error with trip_status", 
            true, 
            "Detected", 
            null 
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }

    
    echo ajax_echo(
        "Trip_status",
        "List of trip status",
        false, 
        "Not detected", 
        $arr_list 
    );

    exit();
}

// Список имеющихся поездок
if(preg_match_all("/^(show_trips)$/ui", $_GET['type'])){
    $query = "SELECT `date_of_execution_trip`, `train_name`, `trip_status`, `trip_price` FROM `Trips`";
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Error", 
            "Error with trips", 
            true, 
            "Detected", 
            null 
        );
        exit();
    }

    $arr_list = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_list, $row);
    }

    
    echo ajax_echo(
        "Trips",
        "List of trips",
        false, 
        "Not detected", 
        $arr_list 
    );

    exit();
}

// Возможность добавления нового продукта в базу
else if(preg_match_all("/^new_poduct$/ui", $_GET['type'])){

    if(!isset($_GET['train_name'])){
        echo ajax_echo(
            "Error",
            "you didn't specify the get parameter on train name in new product",
            "Detected",
            null
        );
        exit;
    }
    if(!isset($_GET['types_of_wagon'])){
        echo ajax_echo(
            "Error",
            "you didn't specify the get parameter on types of wagon in new product",
            "Detected",
            null
        );
        exit;
    }
    if(!isset($_GET['train_status'])){
        echo ajax_echo(
            "Error",
            "you didn't specify the get parameter on train status in new product",
            "Detected",
            null
        );
        exit;
    }
    if(!isset($_GET['Direction'])){
        echo ajax_echo(
            "Error",
            "you didn't specify the get parameter on direction in new product",
            "Detected",
            null
        );
        exit;
    }

    $query = "INSERT INTO `Railway_products`(`train_name`, `types_of_wagon`, `train_status`, `Direction`) 
    VALUES ('".$_GET['train_name']."', '".$_GET['types_of_wagon']."', '".$_GET['train_status']."', '".$_GET['Direction']."')";
    
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Error!",
            "Error with new railway product",
            true,
            null
        );
        exit;
    }
    
    echo ajax_echo(
        "Error",
        "+ New railway product",
        false,
        "Not detected"
    );
    exit;
}
// Возможность добавления нового клиента в базу
else if(preg_match_all("/^new_client$/ui", $_GET['type'])){

    if(!isset($_GET['First_name'])){
        echo ajax_echo(
            "Error",
            "you didn't specify the get parameter on first name in new clients",
            "Detected",
            null
        );
        exit;
    }
    if(!isset($_GET['Last_name'])){
        echo ajax_echo(
            "Error",
            "you didn't specify the get parameter on last name in new clients",
            "Detected",
            null
        );
        exit;
    }
    if(!isset($_GET['Middle_name'])){
        echo ajax_echo(
            "Error",
            "you didn't specify the get parameter on middle name in new clients",
            "Detected",
            null
        );
        exit;
    }

    
    $query = "INSERT INTO `Clients`(`First_name`, `Last_name`, `Middle_name`) 
    VALUES ('".$_GET['First_name']."', '".$_GET['Last_name']."', '".$_GET['Middle_name']."')";
    
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Error",
            "Error with new clients",
            true,
            "Detected"
        );
        exit;
    }
    
    echo ajax_echo(
        "Error",
        "+ new clients",
        false,
        "Not detected"
    );
    exit;
}

// Возможность добавления новой поездки
else if(preg_match_all("/^new_trip$/ui", $_GET['type'])){

    if(!isset($_GET['train_name'])){
        echo ajax_echo(
            "Error",
            "you didn't specify the get parameter on train name in new trip",
            "Detected",
            null
        );
        exit;
    }

    if(!isset($_GET['trip_status'])){
        echo ajax_echo(
            "Error!",
            "you didn't specify the get parameter on trip status in new trip",
            "Detected",
            null
        );
        exit;
    }

    if(!isset($_GET['trip_price'])){
        echo ajax_echo(
            "Error!",
            "you didn't specify the get parameter on trip price in new trip",
            "Detected",
            null
        );
        exit;
    }
    
    $query = "INSERT INTO `Trips`(`train_name`, `trip_status`, `trip_price`) 
    VALUES ('".$_GET['train_name']."','".$_GET['trip_status']."','".$_GET['trip_price']."')";
    
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Error",
            "Error with new trip",
            true,
            "Detected"
        );
        exit;
    }
    
    echo ajax_echo(
        "Error",
        "+ new trip",
        false,
        "Not detected"
    );
    exit;
}
// Возможность изменения данных о водителе
else if(preg_match_all("/^change_driver$/ui", $_GET['type'])){

    if(!isset($_GET['Linked_train_name'])){
        echo ajax_echo(
            "Error",
            "you didn't specify the get parameter on linked train name with change driver",
            "Detected",
            null
        );
        exit;
    }
    if(!isset($_GET['ban'])){
        echo ajax_echo(
            "Error",
            "you didn't specify the get parameter on ban with change driver",
            "Detected",
            null
        );
        exit;
    }
    
    $query = "UPDATE `Drivers` SET `Linked_train_name`='".$_GET['Linked_train_name']."',`ban`='".$_GET['ban']."' WHERE `driver_id` = ".$_GET['driver_id'];

    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Error",
            "Error with change driver ",
            true,
            "Detected"
        );
        exit;
    }
    
    echo ajax_echo(
        "Error",
        "Driver on specify id has been changed",
        false,
        "Not detected"
    );
    exit;
}

// Возможность изменения данных о поездке
else if(preg_match_all("/^change_trip$/ui", $_GET['type'])){

    if(!isset($_GET['train_name'])){
        echo ajax_echo(
            "Error",
            "you didn't specify the get parameter on train name in change trip",
            "Detected",
            null
        );
        exit;
    }

    if(!isset($_GET['trip_status'])){
        echo ajax_echo(
            "Error!",
            "you didn't specify the get parameter on trip status in change trip",
            "Detected",
            null
        );
        exit;
    }

    if(!isset($_GET['trip_price'])){
        echo ajax_echo(
            "Error",
            "you didn't specify the get parameter on trip price in change trip",
            "Detected",
            null
        );
        exit;
    }
    
    $query = "UPDATE `Trips` 
    SET `train_name`='".$_GET['train_name']."',`trip_status`='".$_GET['trip_status']."',`trip_price`='".$_GET['trip_price']."' 
    WHERE `trip_id` = ".$_GET['trip_id'];
    
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Error!",
            "Error with change trip",
            true,
            "Detected"
        );
        exit;
    }
    
    echo ajax_echo(
        "Error",
        "Trip on your specify id has been changed",
        false,
        "Not detected"
    );
    exit;
}
// Возможность изменения данных о клиенте
else if(preg_match_all("/^change_client$/ui", $_GET['type'])){

    if(!isset($_GET['Number_of_trips'])){
        echo ajax_echo(
            "Error",
            "you didn't specify the get parameter on number of trips in change client",
            "Detected",
            null
        );
        exit;
    }

    if(!isset($_GET['Last_trip'])){
        echo ajax_echo(
            "Error",
            "you didn't specify the get parameter on last trip in change client",
            "Detected",
            null
        );
        exit;
    }

    if(!isset($_GET['ban'])){
        echo ajax_echo(
            "Error",
            "you didn't specify the get parameter on ban in change client",
            "Detected",
            null
        );
        exit;
    }

    $query = "UPDATE `Clients` 
    SET `Number_of_trips`='".$_GET['Number_of_trips']."',`Last_trip`='".$_GET['Last_trip']."',`ban`='".$_GET['ban']."' 
    WHERE `client_id` = ".$_GET['client_id'];
    
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Error",
            "Error with change client",
            true,
            "Detected"
        );
        exit;
    }
    
    echo ajax_echo(
        "Error",
        "Client on your specify id has been changed",
        false,
        "Not detected"
    );
    exit;
}