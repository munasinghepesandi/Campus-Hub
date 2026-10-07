<?php
// database connection එක සහ header එක සම්බන්ධ කිරීම
include 'includes/db_connect.php';
include 'includes/header.php';

$event_title = "";
$error = "";
$success = "";

// 1. URL එකෙන් Event ID එක ලබා ගැනීම (Parameter Passing)
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // ඔයාගේ events table එකේ primary key එක 'id' නිසා
    $event_id = intval($_GET['id']); 
    
    try {
        $stmt = $pdo->prepare("SELECT title FROM events WHERE id = ?");
        $stmt->execute([$event_id]);
        $event = $stmt->fetch();
        
        if ($event) {
            $event_title = $event['title'];
        } else {
            $error = "Event not found.";
        }
    } catch (Exception $e) {
        $error = "Database error: " . $e->getMessage();
    }
} else {
    $error = "No event selected to register.";
}

// 2. Form එක Submit කළ පසු දත්ත Handle කිරීම
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($error)) {
    $student_email = trim($_POST['student_email']);
    
    // Validation
    if (empty($student_email)) {
        $error = "Please enter your campus email address.";
    } elseif (!filter_var($student_email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        try {
            // 2.1 ශිෂ්‍යයාගේ email එක 'students' table එකේ තියෙනවද කියා පරික්ෂා කිරීම
            $stmt = $pdo->prepare("SELECT id FROM students WHERE email = ?");
            $stmt->execute([$student_email]);
            $student = $stmt->fetch();
            
            if ($student) {
                $student_id = $student['id'];
                
                // 2.2 ශිෂ්‍යයා දැනටමත් මේ event එකට register වෙලාද කියා බැලීම (Duplicate Check)
                $check_stmt = $pdo->prepare("SELECT id FROM registrations WHERE students_id = ? AND events_id = ?");
                $check_stmt->execute([$student_id, $event_id]);
                
                if ($check_stmt->fetch()) {
                    $error = "You are already registered for this event!";
                } else {
                    // 2.3 සියල්ල හරි නම් registrations table එකට දත්ත ඇතුළත් කිරීම (Insert Operation)
                    // ඔයාගේ table columns: id, students_id, events_id, status
                    $sql = "INSERT INTO registrations (students_id, events_id, status) VALUES (?, ?, 'Pending')";
                    $insert_stmt = $pdo->prepare($sql);
                    $insert_stmt->execute([$student_id, $event_id]);
                    
                    $success = "Successfully registered for '" . htmlspecialchars($event_title) . "'!";
                }
            } else {
                // ශිෂ්‍යයා ඩේටාබේස් එකේ නැති විට දෙන පණිවිඩය
                $error = "Your email is not registered in the student directory. Please register as a student first.";
            }
        } catch (Exception $e) {
            $error = "Registration failed: " . $e->getMessage();
        }
    }
}
?>

<div class="max-w-2xl mx-auto px-4 py-12">
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-8 shadow-xl">
        
        <h2 class="text-3xl font-bold text-white mb-2">Event Registration</h2>
        
        <?php if (!empty($event_title)): ?>
            <p class="text-indigo-400 font-medium mb-6">Registering for: <span class="text-white bg-indigo-950 px-3 py-1 rounded-md border border-indigo-800"><?php echo htmlspecialchars($event_title); ?></span></p>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="bg-red-950/50 border border-red-500 text-red-200 p-4 rounded-xl mb-6 text-sm">
                ⚠️ <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="bg-emerald-950/50 border border-emerald-500 text-emerald-200 p-4 rounded-xl mb-6 text-sm">
                ✅ <?php echo $success; ?>
            </div>
            <div class="text-center">
                <a href="events.php" class="inline-block bg-gray-700 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-lg transition">Back to Events</a>
            </div>
        <?php else: ?>

            <?php if (empty($error) || (!empty($error) && $error != "Event not found." && $error != "No event selected to register.")): ?>
                <form action="register_event.php?id=<?php echo htmlspecialchars($event_id); ?>" method="POST" class="space-y-6">
                    
                    <div>
                        <label for="student_email" class="block text-sm font-medium text-gray-300 mb-2">Enter Your Registered Campus Email</label>
                        <input type="email" id="student_email" name="student_email" 
                               class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition"
                               placeholder="yourname@university.edu" required>
                        <p class="text-gray-500 text-xs mt-2">To register, your email must already exist in the CampusHub student directory.</p>
                    </div>

                    <button type="submit" 
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-4 rounded-lg transition shadow-md">
                        Confirm Registration
                    </button>
                </form>
            <?php endif; ?>

        <?php endif; ?>

    </div>
</div>

<?php include 'includes/footer.php'; ?>