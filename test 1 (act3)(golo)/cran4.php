<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["num1"]) && isset($_GET["num2"])) {
    $x = $_GET["num1"];
    $y = $_GET["num2"];
    $operation = $_GET["operation"];

    if (is_numeric($x) && is_numeric($y)) {
        switch ($operation) {
            case "add":
                $result = $x + $y;
                echo "<p>Result: $x + $y = $result</p>";
                break;
            case "subtract":
                $result = $x - $y;
                echo "<p>Result: $x - $y = $result</p>";
                break;
            case "multiply":
                $result = $x * $y;
                echo "<p>Result: $x * $y = $result</p>";
                break;
            case "divide":
                if ($y != 0) {
                    $result = $x / $y;
                    echo "<p>Result: $x / $y = $result</p>";
                } else {
                    echo "<p>Cannot divide by zero!</p>";
                }
                break;
            default:
                echo "<p>Invalid operation selected.</p>";
        }
    } else {
        echo "<p>Please enter valid numbers.</p>";
    }
}
?>
