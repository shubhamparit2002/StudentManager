<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];

    // Handle Image Upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png'];
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if (in_array($ext, $allowed)) {
            $image = uniqid() . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
        }
    }

    $stmt = $pdo->prepare("INSERT INTO student (name, email, address, class_id, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $address, $class_id, $image]);

    header('Location: index.php');
    exit;
}

// Fetch classes for dropdown
$query = "SELECT * FROM classes";
$stmt = $pdo->query($query);
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Student</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Add New Student</h1>
        <form action="" method="post" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" name="name" required 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" name="email" 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address:</label>
                <textarea name="address" 
                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <div>
                <label for="class_id" class="block text-sm font-medium text-gray-700">Class:</label>
                <select name="class_id" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <?php foreach ($classes as $class): ?>
                        <option value="<?= $class['class_id'] ?>"><?= $class['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image:</label>
                <input type="file" name="image" accept="image/*" 
                       class="mt-1 block w-full text-gray-700 file:mr-4 file:py-2 file:px-4 file:border file:border-gray-300 file:rounded-md file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
            </div>

            <div>
                <input type="submit" value="Create" 
                       class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            </div>
        </form>
    </div>
</body>

</html>
