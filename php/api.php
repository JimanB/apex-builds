<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

//api.php
//this script serves as the backend endpoint to fetch product data

//include the database connection file
//require_once ensures the file is included only once
require_once 'db_connect.php';

//set the content type header to application/json
//this tells the browser to expect JSON data
header('Content-Type: application/json');

//main logic
//will use a simple GET parameter to decide what action to take
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'get_products') {
    //prepare the SQL query to select all products
    $sql = "SELECT * FROM products ORDER BY FIELD(category, 'CPU', 'GPU', 'Motherboard', 'RAM', 'SSD', 'Cooler', 'PSU', 'Case', 'Fans', 'OS', 'HDD', 'Monitor', 'Keyboard', 'Mouse', 'Headset', 'Webcam', 'Microphone', 'Speakers', 'Wifi', 'Cables')";

    //execute the query
    $result = $conn->query($sql);

    $products_by_category = [];

    //check if the query returned any rows
    if ($result && $result->num_rows > 0) {
        //loop through each row of the result
        while ($row = $result->fetch_assoc()) {
            //group the products by their category
            $category = $row['category'];
            $displayName = $row['displayName'];

            //if this category is new, initialize it
            if (!isset($products_by_category[$category])) {
                $products_by_category[$category] = [
                    'category' => $category,
                    'displayName' => $displayName,
                    'options' => []
                ];
            }

            //add the product option to its category
            $products_by_category[$category]['options'][] = [
                'name' => $row['name'],
                'price' => (float)$row['price'], //cast price to a number
                'image' => $row['image']
            ];
        }
    }

    //convert the associative array back to a simple indexed array and output as JSON
    echo json_encode(array_values($products_by_category));

} else {
    //jf the action is unknown, return an error message
    echo json_encode(['error' => 'Invalid action']);
}

//close the database connection
$conn->close();

?>