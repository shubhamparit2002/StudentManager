<?php
include 'db.php';

$query = "SELECT student.id, student.name, student.email, student.created_at, student.image, classes.name as class_name
          FROM student
          JOIN classes ON student.class_id = classes.class_id";
$stmt = $pdo->query($query);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold mb-6 text-gray-800">Students</h1>
        <a href="create.php" class="bg-purple-600 text-white text-lg font-semibold rounded-lg px-6 py-3 hover:bg-purple-700 transition duration-300 ease-in-out">Add New Student</a>

        <div class="mt-8 overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="py-3 px-4 border-b">Name</th>
                        <th class="py-3 px-4 border-b">Email</th>
                        <th class="py-3 px-4 border-b">Class</th>
                        <th class="py-3 px-4 border-b">Image</th>
                        <th class="py-3 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php foreach ($students as $student): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b"><?= htmlspecialchars($student['name']) ?></td>
                            <td class="py-3 px-4 border-b"><?= htmlspecialchars($student['email']) ?></td>
                            <td class="py-3 px-4 border-b"><?= htmlspecialchars($student['class_name']) ?></td>
                            <td class="py-3 px-4 border-b flex justify-center">
                                <img src="uploads/<?= htmlspecialchars($student['image']) ?>" class="w-12 h-12 object-cover rounded-full" alt="<?= htmlspecialchars($student['name']) ?>">
                            </td>
                            <td class="py-3 px-4 border-b text-center">
                                <a href="view.php?id=<?= htmlspecialchars($student['id']) ?>" class="text-blue-600 hover:text-blue-800">View</a> |
                                <a href="edit.php?id=<?= htmlspecialchars($student['id']) ?>" class="text-blue-600 hover:text-blue-800">Edit</a> |
                                <a href="delete.php?id=<?= htmlspecialchars($student['id']) ?>" class="text-red-600 hover:text-red-800">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
