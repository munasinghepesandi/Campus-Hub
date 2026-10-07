<?php
// database connection එක සහ header එක සම්බන්ධ කිරීම
include 'includes/db_connect.php';
include 'includes/header.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // File upload විස්තර ලබා ගැනීම
    $file = $_FILES['profile_pic'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    
    // 1. Basic Fields Validation (Error Handling Requirement)
    if (empty($name) || empty($email) || empty($password) || empty($fileName)) {
        $error = "All fields including the profile picture are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } 
    // 2. Password Length Validation (උපරිම අකුරු 10 සීමාව පරීක්ෂා කිරීම)
    elseif (strlen($password) > 10) {
        $error = "Password is too long! Maximum length is 10 characters.";
    } else {
        try {
            // 3. Email එක දැනටමත් ඩේටාබේස් එකේ තියෙනවද කියා පරික්ෂා කිරීම (Duplicate Check)
            $stmt = $pdo->prepare("SELECT id FROM students WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->fetch()) {
                $error = "This email is already registered. Please use another one.";
            } else {
                // 4. Profile Picture Upload එක Handle කිරීම (File Upload Requirement)
                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('jpg', 'jpeg', 'png'); // ඉඩ දෙන file වර්ග
                
                if (in_array($fileActualExt, $allowed)) {
                    if ($fileError === 0) {
                        if ($fileSize < 5000000) { // Max size 5MB
                            $fileNewName = "profile_" . uniqid('', true) . "." . $fileActualExt;
                            
                            if (!file_exists('uploads')) {
                                mkdir('uploads', 0777, true);
                            }
                            
                            $fileDestination = 'uploads/' . $fileNewName;
                            
                            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                                
                                // 5. දත්ත Students Table එකට ඇතුළත් කිරීම (Insert Operation)
                                // මෙතනදී $password එක hash නොකර කෙලින්ම ඩේටාබේස් එකට ඇතුළත් වේ (අකුරු 10 සීමාව නිසා)
                                $sql = "INSERT INTO students (name, email, password, profile_pic) VALUES (?, ?, ?, ?)";
                                $insert_stmt = $pdo->prepare($sql);
                                $insert_stmt->execute([$name, $email, $password, $fileNewName]);
                                
                                $success = "Account created successfully! You can now register for events.";
                                
                                // Form fields clear කිරීම සඳහා
                                $name = $email = "";
                            } else {
                                $error = "There was an error moving your uploaded file.";
                            }
                        } else {
                            $error = "Your file is too big! Maximum size is 5MB.";
                        }
                    } else {
                        $error = "There was an error uploading your file.";
                    }
                } else {
                    $error = "You cannot upload files of this type. Only JPG, JPEG, & PNG are allowed.";
                }
            }
        } catch (Exception $e) {
            $error = "Registration failed: " . $e->getMessage();
        }
    }
}
?>

<div class="max-w-2xl mx-auto px-4 py-12">
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-8 shadow-xl">
        
        <h2 class="text-3xl font-bold text-white mb-2">Student Sign Up</h2>
        <p class="text-gray-400 mb-6">Create your student profile to join communities and register for upcoming events.</p>

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
                <a href="events.php" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-6 rounded-lg transition shadow-md">Go to Events</a>
            </div>
        <?php else: ?>

            <form action="student_signup.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                    <input type="text" id="name" name="name" 
                           class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition"
                           placeholder="Pesandi Munasinghe" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Campus Email Address</label>
                    <input type="email" id="email" name="email" 
                           class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition"
                           placeholder="student@campushub.edu" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password (Max 10 characters)</label>
                    <input type="password" id="password" name="password" maxlength="10"
                           class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition"
                           placeholder="••••••••" required>
                    <p class="text-gray-500 text-xs mt-2">For security compliance, passwords must not exceed 10 characters.</p>
                </div>

                <div>
                    <label for="profile_pic" class="block text-sm font-medium text-gray-300 mb-2">Upload Profile Picture</label>
                    <input type="file" id="profile_pic" name="profile_pic" 
                           class="w-full text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-950 file:text-indigo-400 hover:file:bg-indigo-900 file:transition cursor-pointer bg-gray-900 border border-gray-700 rounded-lg p-2"
                           accept="image/*" required>
                    <p class="text-gray-500 text-xs mt-2">Accepted formats: JPG, JPEG, PNG. Max size 5MB.</p>
                </div>

                <button type="submit" 
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-4 rounded-lg transition shadow-md">
                    Create Student Account
                </button>
            </form>

        <?php endif; ?>

    </div>
</div>

<?php include 'includes/footer.php'; ?>