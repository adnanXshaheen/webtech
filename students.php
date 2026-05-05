<?php
header("Content-Type: application/json");

// Create student data array
$students = [
    [
        "name" => "Rahim Ahmed",
        "id" => "CSE101",
        "department" => "Computer Science",
        "cgpa" => "3.75"
    ],
    [
        "name" => "Karim Hasan",
        "id" => "EEE202",
        "department" => "Electrical Engineering",
        "cgpa" => "3.60"
    ],
    [
        "name" => "Ayesha Rahman",
        "id" => "BBA303",
        "department" => "Business Administration",
        "cgpa" => "3.90"
    ]
];

// Convert PHP array to JSON
echo json_encode($students);
?>
