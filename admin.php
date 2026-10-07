<?php
// database connection එක සහ header එක සම්බන්ධ කිරීම
include 'includes/db_connect.php';
include 'includes/header.php';

$error = "";
$success = "";

// 1. අලුත් Event එකක් ඇතුළත් කිරීම (Insert Operation with File Upload)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_event'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $venue = trim($_POST['venue']);
    
    $file = $_FILES['event_image'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    if (empty($title) || empty($description) || empty($date) || empty($time) || empty($venue)) {
        $error = "All text fields are required!";
    } else {
        try {
            $imageName = null; // Default image එකක් නැතිනම් null

            // ඇඩ්මින් පින්තූරයක් තෝරාගෙන තිබේ නම් පමණක් upload එක සිදු කරයි
            if (!empty($fileName)) {
                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('jpg', 'jpeg', 'png');

                if (in_array($fileActualExt, $allowed)) {
                    if ($fileError === 0) {
                        if ($fileSize < 5000000) { // Max 5MB
                            $imageName = "event_" . uniqid('', true) . "." . $fileActualExt;
                            
                            if (!file_exists('uploads')) {
                                mkdir('uploads', 0777, true);
                            }
                            
                            move_uploaded_file($fileTmpName, 'uploads/' . $imageName);
                        } else {
                            $error = "Image is too big! Max 5MB allowed.";
                        }
                    } else {
                        $error = "Error uploading image.";
                    }
                } else {
                    $error = "Invalid image type. Only JPG, JPEG, & PNG are allowed.";
                }
            }

            // Error එකක් නැත්නම් Event එක ඩේටාබේස් එකට එකතු කිරීම
            if (empty($error)) {
                $sql = "INSERT INTO events (title, description, date, time, venue, image) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$title, $description, $date, $time, $venue, $imageName]);
                $success = "New campus event published successfully!";
            }
        } catch (Exception $e) {
            $error = "Failed to add event: " . $e->getMessage();
        }
    }
}

// 2. දැනට තියෙන Registrations ටික ඩේටාබේස් එකෙන් ලබා ගැනීම (JOIN Query)
try {
    // ශිෂ්‍යයාගේ නම සහ Event එකේ නම එකට පෙන්වීමට Tables 3ක් JOIN කර ඇත
    $query = "SELECT r.id, s.name AS student_name, s.email AS student_email, e.title AS event_title, r.status 
              FROM registrations r
              JOIN students s ON r.students_id = s.id
              JOIN events e ON r.events_id = e.id
              ORDER BY r.id DESC";
    $stmt = $pdo->query($query);
    $registrations = $stmt->fetchAll();
} catch (Exception $e) {
    $error = "Could not fetch registrations: " . $e->getMessage();
}
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
    
    <div>
        <h1 class="text-3xl font-bold text-white tracking-tight">Administrative Control Panel</h1>
        <p class="text-gray-400 mt-2">Manage event directory, publish website content, and monitor student registrations.</p>
    </div>

    <!-- Alerts -->
    <?php if (!empty($error)): ?>
        <div class="bg-red-950/50 border border-red-500 text-red-200 p-4 rounded-xl text-sm">⚠️ <?php echo $error; ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="bg-emerald-950/50 border border-emerald-500 text-emerald-200 p-4 rounded-xl text-sm">✅ <?php echo $success; ?></div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- වම් පැත්ත: Add Event Form (Column 1ක් ගනී) -->
        <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 shadow-xl">
            <h2 class="text-xl font-bold text-white mb-4">Publish New Event</h2>
            
            <form action="admin.php" method="POST" enctype="multipart/form-data" class="space-y-4">
                <input type="hidden" name="add_event" value="1">
                
                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1">Event Title</label>
                    <input type="text" name="title" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:border-indigo-500" placeholder="e.g., Badminton Tournament" required>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1">Description</label>
                    <textarea name="description" rows="3" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:border-indigo-500" placeholder="Event details..." required></textarea>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-medium text-gray-400 mb-1">Date</label>
                        <input type="date" name="date" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-400 mb-1">Time</label>
                        <input type="time" name="time" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:border-indigo-500" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1">Venue</label>
                    <input type="text" name="venue" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:border-indigo-500" placeholder="e.g., Indoor Stadium" required>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1">Event Banner Image</label>
                    <input type="file" name="event_image" class="w-full text-xs text-gray-400 cursor-pointer bg-gray-900 border border-gray-700 rounded-lg p-2" accept="image/*">
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg text-sm transition shadow-md">
                    Publish Event
                </button>
            </form>
        </div>

        <!-- දකුණු පැත්ත: Registrations Log Table (Columns 2ක් ගනී) -->
        <div class="lg:col-span-2 bg-gray-800 border border-gray-700 rounded-2xl p-6 shadow-xl overflow-hidden">
            <h2 class="text-xl font-bold text-white mb-4">Student Event Registrations</h2>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-700 text-gray-400 text-xs uppercase tracking-wider">
                            <th class="pb-3 pl-2">Reg ID</th>
                            <th class="pb-3">Student Name</th>
                            <th class="pb-3">Email</th>
                            <th class="pb-3">Selected Event</th>
                            <th class="pb-3 pr-2">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-300 divide-y divide-gray-700/50">
                        <?php if (!empty($registrations)): ?>
                            <?php foreach ($registrations as $row): ?>
                                <tr>
                                    <td class="py-3 pl-2 font-mono text-indigo-400">#REG-<?php echo $row['id']; ?></td>
                                    <td class="py-3 font-semibold text-white"><?php echo htmlspecialchars($row['student_name']); ?></td>
                                    <td class="py-3 text-gray-400"><?php echo htmlspecialchars($row['student_email']); ?></td>
                                    <td class="py-3 text-indigo-300"><?php echo htmlspecialchars($row['event_title']); ?></td>
                                    <td class="py-3 pr-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-950 text-amber-400 border border-amber-800">
                                            <?php echo htmlspecialchars($row['status']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-500">No student registrations found in the system.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>