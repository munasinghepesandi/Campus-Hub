<?php include 'includes/header.php'; ?>

<!-- 🚀 Ultimate 3D Eye-Catchy Hero Section -->
<div class="relative overflow-hidden bg-slate-900 py-28 sm:py-36 border-b border-slate-800">
    
    <!-- 3D Grid Backdrop Effect -->
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#33415515_1px,transparent_1px),linear-gradient(to_bottom,#33415515_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]"></div>

    <!-- Glowing Futuristic Blobs -->
    <div class="absolute top-0 right-1/4 -z-10 h-[400px] w-[400px] rounded-full bg-indigo-500/10 blur-[120px]"></div>
    <div class="absolute bottom-0 left-1/4 -z-10 h-[350px] w-[350px] rounded-full bg-purple-500/10 blur-[100px]"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <!-- Left Side: Text and CTA -->
            <div class="text-left space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800 border border-slate-700 text-indigo-300 text-xs font-bold uppercase tracking-wider">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-400 animate-ping"></span>
                    Next-Gen Campus Hub
                </div>
                <h1 class="text-5xl sm:text-7xl font-black text-white tracking-tight leading-[1.1]">
                    Connecting <br>Campus Life <span class="bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-500 bg-clip-text text-transparent drop-shadow-[0_10px_10px_rgba(99,102,241,0.2)]">In One Place</span>
                </h1>
                <p class="text-base sm:text-lg text-slate-300 max-w-xl leading-relaxed">
                    Discover student clubs, upcoming sports activities, tech workshops, and vibrant student communities across multiple institutions.
                </p>
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="events.php" class="relative group overflow-hidden bg-indigo-600 text-white font-bold px-8 py-4 rounded-xl shadow-xl shadow-indigo-600/20 transition-all duration-300 hover:shadow-indigo-500/40 hover:-translate-y-1">
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-purple-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <span class="relative z-10">Explore Events</span>
                    </a>
                    <a href="student_signup.php" class="bg-slate-800 hover:bg-slate-700 text-slate-200 font-semibold px-8 py-4 rounded-xl border border-slate-700 backdrop-blur-sm transition-all duration-300 hover:-translate-y-1">
                        Create Account
                    </a>
                </div>
            </div>

            <!-- Right Side: 3D Isometric Floating Image Frame -->
            <div class="relative lg:mt-0 mt-12 flex justify-center perspective-1000">
                <div class="relative w-full max-w-md sm:max-w-lg transition-all duration-500 [transform:rotateY(-15deg)_rotateX(10deg)] hover:[transform:rotateY(0deg)_rotateX(0deg)] group">
                    
                    <!-- 3D Drop Neon Shadow behind the card -->
                    <div class="absolute -inset-2 rounded-3xl bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 opacity-30 blur-xl group-hover:opacity-50 transition-opacity duration-500"></div>
                    
                    <!-- Main Image Card Frame with Glassmorphism Border -->
                    <div class="relative overflow-hidden rounded-2xl bg-slate-850 border border-slate-700/60 shadow-2xl aspect-[4/3] backdrop-blur-md">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1200&auto=format&fit=crop" 
                             alt="Campus Student Life" 
                             class="w-full h-full object-cover opacity-85 transition-transform duration-700 group-hover:scale-105 group-hover:opacity-100">
                        
                        <!-- 3D Floating Overlay Box -->
                        <div class="absolute bottom-5 left-5 right-5 bg-slate-900/80 backdrop-blur-lg border border-slate-700 rounded-xl p-4 flex items-center justify-between shadow-[0_20px_50px_rgba(0,0,0,0.5)] transform translate-z-10 group-hover:translate-y-[-5px] transition-transform duration-500">
                            <div>
                                <div class="flex items-center gap-1.5">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <p class="text-[10px] text-emerald-400 font-black uppercase tracking-widest">Live Portal</p>
                                </div>
                                <p class="text-sm text-white font-bold mt-0.5">1,200+ Active Students</p>
                            </div>
                            <div class="flex -space-x-2">
                                <img class="w-8 h-8 rounded-full border-2 border-slate-900" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100" alt="user">
                                <img class="w-8 h-8 rounded-full border-2 border-slate-900" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100" alt="user">
                                <img class="w-8 h-8 rounded-full border-2 border-slate-900" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100" alt="user">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- 📊 Main Content Area (Fixed background width & alignment) -->
<div class="bg-slate-900 w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <!-- 🏛️ Left: Features and Multimedia Section (2 Columns) -->
        <div class="lg:col-span-2 space-y-20">
            
            <!-- Features Cards Grid -->
            <div>
                <div class="mb-10">
                    <h2 class="text-3xl font-black text-white tracking-tight">What We Coordinate</h2>
                    <p class="text-slate-400 text-sm mt-1">Bridging the gap between students, sports, and academics.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Card 1 -->
                    <div class="group relative rounded-2xl bg-slate-800/50 p-8 border border-slate-700/60 hover:border-indigo-500/50 transition-all duration-300 shadow-xl hover:shadow-[0_20px_40px_rgba(99,102,241,0.05)] hover:-translate-y-1.5">
                        <div class="w-12 h-12 rounded-xl bg-slate-900 border border-slate-700 flex items-center justify-center text-2xl group-hover:bg-gradient-to-br group-hover:from-indigo-500 group-hover:to-purple-600 group-hover:text-white group-hover:scale-110 transition-all duration-300">
                            🏆
                        </div>
                        <h3 class="text-xl font-bold text-white mt-5 mb-2 group-hover:text-indigo-400 transition-colors">Sports &amp; Competitions</h3>
                        <p class="text-slate-300 text-sm leading-relaxed">Stay updated with inner and inter-university sports tournaments and athletic leaderboards.</p>
                    </div>
                    
                    <!-- Card 2 -->
                    <div class="group relative rounded-2xl bg-slate-800/50 p-8 border border-slate-700/60 hover:border-purple-500/50 transition-all duration-300 shadow-xl hover:shadow-[0_20px_40px_rgba(168,85,247,0.05)] hover:-translate-y-1.5">
                        <div class="w-12 h-12 rounded-xl bg-slate-900 border border-slate-700 flex items-center justify-center text-2xl group-hover:bg-gradient-to-br group-hover:from-purple-500 group-hover:to-pink-600 group-hover:text-white group-hover:scale-110 transition-all duration-300">
                            💻
                        </div>
                        <h3 class="text-xl font-bold text-white mt-5 mb-2 group-hover:text-purple-400 transition-colors">Workshops &amp; Tech</h3>
                        <p class="text-slate-300 text-sm leading-relaxed">Enhance your skillset by registering online for hands-on technical workshops and tech talks.</p>
                    </div>
                </div>
            </div>

            <!-- HTML5 Multimedia Section -->
            <div class="bg-slate-800/40 p-6 sm:p-8 rounded-2xl border border-slate-700/80 shadow-xl relative overflow-hidden">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-white tracking-tight">Life at CampusHub</h2>
                    <p class="text-slate-400 text-sm mt-1">Watch our official orientation video to learn more about our student ecosystem.</p>
                </div>
                
                <!-- 3D Framed Video Player -->
                <div class="relative aspect-video rounded-xl overflow-hidden bg-black shadow-2xl border border-slate-700 group hover:border-slate-600 transition-colors duration-300">
                    <video class="w-full h-full object-cover" controls poster="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=800">
                        <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>

                <!-- Audio Player Component -->
                <div class="mt-8 p-4 bg-slate-900/60 border border-slate-700 rounded-xl flex flex-col sm:flex-row items-center justify-between gap-4 shadow-inner">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-950 to-purple-950 border border-indigo-900 flex items-center justify-center text-indigo-400 text-sm">
                            🎵
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">Listen to CampusHub Anthem</p>
                            <p class="text-xs text-slate-500">Official student community theme song</p>
                        </div>
                    </div>
                    <audio controls class="w-full sm:w-auto opacity-80 hover:opacity-100 transition-opacity">
                        <source src="https://www.w3schools.com/html/horse.mp3" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            </div>

        </div>

        <!-- 📢 Right: Dynamic XML Announcements Section (1 Column) -->
        <div class="space-y-6">
            <div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Latest Announcements</h2>
                <p class="text-slate-400 text-sm mt-1">Live updates directly synced from the campus board.</p>
            </div>
            
            <div class="space-y-4">
                <?php
                $xmlFile = 'announcements.xml';
                if (file_exists($xmlFile)) {
                    $announcements = simplexml_load_file($xmlFile);
                    
                    if ($announcements) {
                        foreach ($announcements->announcement as $item) {
                            ?>
                            <!-- Announcement Card -->
                            <div class="bg-slate-800/60 p-6 rounded-xl border border-slate-700/70 relative overflow-hidden group hover:border-indigo-500/30 hover:shadow-[0_10px_30px_rgba(99,102,241,0.05)] transition-all duration-300">
                                <!-- Left Glowing Highlight -->
                                <div class="absolute top-0 left-0 w-1 h-0 bg-gradient-to-b from-indigo-500 to-purple-500 group-hover:h-full transition-all duration-300"></div>
                                
                                <div class="flex justify-between items-center text-xs text-slate-400 mb-3 group-hover:translate-x-1 transition-transform duration-300">
                                    <span class="bg-slate-900 text-indigo-300 px-2.5 py-0.5 rounded-md border border-slate-700 font-bold uppercase tracking-wider text-[9px]">
                                        <?php echo htmlspecialchars($item->category); ?>
                                    </span>
                                    <span class="flex items-center gap-1 text-slate-500 font-medium">
                                        📅 <?php echo htmlspecialchars($item->date); ?>
                                    </span>
                                </div>
                                
                                <h3 class="text-base font-bold text-white mb-2 group-hover:text-indigo-400 group-hover:translate-x-1 transition-all duration-300">
                                    <?php echo htmlspecialchars($item->title); ?>
                                </h3>
                                
                                <p class="text-slate-300 text-xs leading-relaxed group-hover:translate-x-1 transition-all duration-300">
                                    <?php echo htmlspecialchars($item->content); ?>
                                </p>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<div class="p-4 bg-slate-800 rounded-xl border border-slate-700 text-slate-400 text-sm text-center">Failed to load announcements.</div>';
                    }
                } else {
                    echo '<div class="p-4 bg-slate-800 rounded-xl border border-slate-700 text-slate-400 text-sm text-center">No announcements file found.</div>';
                }
                ?>
            </div>
        </div>

    </div>
</div>

<!-- Custom Helper CSS Styles for 3D Perspective Support -->
<style>
    .perspective-1000 {
        perspective: 1000px;
    }
    .translate-z-10 {
        transform: translateZ(20px);
    }
</style>

<?php include 'includes/footer.php'; ?>