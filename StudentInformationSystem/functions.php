<?php

function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}

function searchStudents($students, $keyword) {

    $keyword = trim($keyword);

    if ($keyword === "") {
        return $students;
    }

    $results = [];

    foreach ($students as $student) {

        $searchData = $student["id"] . " " .
                      $student["name"] . " " .
                      $student["course"] . " " .
                      $student["year"] . " " .
                      $student["email"];

        if (stripos($searchData, $keyword) !== false) {
            $results[] = $student;
        }
    }

    return $results;
}

function countStudents($students) {
    return count($students);
}

function countActiveStudents($students) {

    $total = 0;

    foreach ($students as $student) {

        if (strtolower($student["status"]) === "active") {
            $total++;
        }
    }

    return $total;
}

function displayName($name) {
    return strtoupper($name);
}

?>