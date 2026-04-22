<?php
$nameInput = isset($_GET['name']) ? $_GET['name'] : "Guest";


$marks = array(75, 48, 90, 62, 55);


echo "<h3>Student Marks:</h3>";
foreach ($marks as $mark) {
    echo $mark . "<br>";
}


function calculateAverage($arr) {
    $total = array_sum($arr);
    return $total / count($arr);
}


$total = 0;
$max = $marks[0];
$min = $marks[0];
$pass = 0;
$fail = 0;

foreach ($marks as $mark) {
    $total += $mark;

    if ($mark > $max) {
        $max = $mark;
    }

    if ($mark < $min) {
        $min = $mark;
    }

    // PASS/FAIL CHECK
    if ($mark >= 50) {
        $pass++;
    } else {
        $fail++;
    }
}


$average = (float) calculateAverage($marks);


echo "<h3>Results:</h3>";
echo "Total Marks: " . $total . "<br>";
echo "Average Marks: " . $average . "<br>";
echo "Maximum Marks: " . $max . "<br>";
echo "Minimum Marks: " . $min . "<br>";
echo "Passed Students: " . $pass . "<br>";
echo "Failed Students: " . $fail . "<br>";


echo "<h3>Sorted Marks:</h3>";
sort($marks);
foreach ($marks as $mark) {
    echo $mark . "<br>";
}


$student = array(
    "name" => "Adnan Faiz",
    "id" => "1101",
    "cgpa" => 3.75
);

echo "<h3>Student Details:</h3>";
foreach ($student as $key => $value) {
    echo $key . " : " . $value . "<br>";
}


echo "<h3>String Operations:</h3>";
$upperName = strtoupper($student["name"]);
$nameLength = strlen($student["name"]);

echo "Uppercase Name: " . $upperName . "<br>";
echo "Name Length: " . $nameLength . "<br>";


echo "<h3>User Input:</h3>";
echo "Hello, " . htmlspecialchars($nameInput);
?>
