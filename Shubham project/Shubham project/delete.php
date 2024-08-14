<?php
include 'db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Delete student and image
    $stmt = $pdo->prepare("SELECT image FROM student WHERE id = ?");
    $stmt->execute([$id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($student) {
        if ($student['image'] && file_exists('uploads/' . $student['image'])) {
            unlink('uploads/' . $student['image']);
        }
        $stmt = $pdo->prepare("DELETE FROM student WHERE id = ?");
        $stmt->execute([$id]);
    }
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Student</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md text-center">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Are you sure you want to delete this student?</h1>
        <form action="" method="post" class="mb-4">
            <input type="submit" value="Delete"
                   class="bg-red-500 text-white font-semibold py-2 px-4 rounded-md shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 cursor-pointer">
        </form>
        <a href="index.php" class="text-gray-600 hover:text-gray-800 font-medium">Cancel</a>
    </div>
</body>

</html>
