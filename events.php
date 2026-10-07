<?php 
// database connection එක සහ header එක සම්බන්ධ කිරීම
include 'includes/db_connect.php'; 
include 'includes/header.php'; 

// Database එකෙන් events ටික අරගන්නා ආකාරය (Select Operation)
try {
    $stmt = $pdo->query("SELECT * FROM events ORDER BY Date ASC");
    $events = $stmt->fetchAll();
} catch (Exception $e) {
    $error_msg = "Could not fetch events.";
}
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white tracking-tight">Upcoming Events & Activities</h1>
        <p class="text-gray-400 mt-2">Explore and register for the latest campus activities, workshops, and sports tournaments.</p>
    </div>

    <!-- Error පණිවිඩයක් තිබේ නම් එය පෙන්වීම (Error Handling) -->
    <?php if (isset($error_msg)): ?>
        <div class="bg-red-900/50 border border-red-500 text-red-200 p-4 rounded-lg mb-6">
            <?php echo $error_msg; ?>
        </div>
    <?php endif; ?>

    <!-- Events Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $event): ?>
                <!-- Event Card -->
                <div class="bg-gray-800 rounded-xl overflow-hidden border border-gray-700 shadow-lg flex flex-col justify-between hover:border-indigo-500 transition">
                    
                    <!-- Event Image (Multimedia / Upload requirement එක සඳහා path එක ගන්නවා) -->
                    <img class="h-48 w-full object-cover" 
                         src="<?php echo !empty($event['image']) ? 'uploads/' . htmlspecialchars($event['image']) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=600' ?>" 
                         alt="<?php echo htmlspecialchars($event['title']); ?>">
                    
                    <div class="p-6 flex-grow">
                        <!-- Date & Venue -->
                        <div class="flex items-center text-xs text-indigo-400 font-semibold uppercase tracking-wider mb-2">
                            <span>📅 <?php echo htmlspecialchars($event['date']); ?></span>
                            <span class="mx-2">•</span>
                            <span>📍 <?php echo htmlspecialchars($event['venue']); ?></span>
                        </div>
                        
                        <!-- Title -->
                        <h3 class="text-xl font-bold text-white mb-2">
                            <?php echo htmlspecialchars($event['title']); ?>
                        </h3>
                        
                        <!-- Description -->
                        <p class="text-gray-400 text-sm line-clamp-3">
                            <?php echo htmlspecialchars($event['description']); ?>
                        </p>
                    </div>

                    <!-- Registration Action Button -->
                    <div class="p-6 pt-0">
                        <a href="register_event.php?id=<?php echo $event['id']; ?>" 
                           class="block text-center w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-4 rounded-lg transition shadow-md">
                            Register Online
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Event එකක්වත් නැති විට පෙන්වන message එක -->
            <div class="col-span-full text-center py-12 bg-gray-800 rounded-xl border border-gray-700">
                <p class="text-gray-400">No events found at the moment. Check back later!</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>