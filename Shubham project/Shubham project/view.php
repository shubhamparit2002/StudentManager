<?php
include 'db.php';

$id = $_GET['id'];

$query = "SELECT student.*, classes.name as class_name 
          FROM student 
          JOIN classes ON student.class_id = classes.class_id 
          WHERE student.id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Student</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-3xl font-semibold mb-6 text-gray-800">Student Details</h1>
        <div class="space-y-4">
            <img src="uploads/<?= $student['image'] ?>" class="w-32 h-32 object-cover rounded-md border border-gray-300">
            <p class="text-lg"><span class="font-medium text-gray-700">Name:</span> <?= $student['name'] ?></p>
            <p class="text-lg"><span class="font-medium text-gray-700">Email:</span> <?= $student['email'] ?></p>
            <p class="text-lg"><span class="font-medium text-gray-700">Address:</span> <?= $student['address'] ?></p>
            <p class="text-lg"><span class="font-medium text-gray-700">Class:</span> <?= $student['class_name'] ?></p>
            <p class="text-lg"><span class="font-medium text-gray-700">Created At:</span> <?= $student['created_at'] ?></p>
           
        </div>
        <a href="index.php" class="block mt-6 text-blue-500 hover:text-blue-600 font-medium text-center">Back to Home</a>
    </div>
</body>

</html>
