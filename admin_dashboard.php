<?php
session_start();
if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== "admin") {
    header("Location: user_dashboard.php"); // Redirect non-admin users
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4 flex justify-between fixed w-full top-0 shadow-lg">
        <h1 class="text-2xl font-bold">Admin Panel</h1>
        <div class="space-x-4">
            <a href="admin_dashboard.php" class="hover:text-gray-300">Dashboard</a>
            <a href="user_dashboard.php" class="hover:text-gray-300">Events</a>
            <a href="analytics.php" class="hover:text-gray-300">Analytics</a>
            <a href="logout.php" class="hover:text-gray-300">Logout</a>
        </div>
    </nav>

    <!-- Admin Controls -->
    <section class="text-center mt-24 p-12 bg-blue-500 text-white rounded-lg shadow-md max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold">Admin Control Panel</h1>
        <p class="text-lg mt-2">Manage events, track analytics, and control user roles.</p>
        <div class="mt-6 flex flex-wrap justify-center gap-4">
            <button onclick="showPublishForm()" id="publishButtonContainer">Publish Event</button>
            <button onclick="showUserManagement()" class="bg-white text-blue-500 px-6 py-3 font-bold rounded-lg shadow-md hover:bg-gray-200 transition">Manage Users</button>
            <button onclick="showAnalytics()" class="bg-white text-blue-500 px-6 py-3 font-bold rounded-lg shadow-md hover:bg-gray-200 transition">View Analytics</button>
        </div>
    </section>

    <div id="adminFunctions" class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg mt-6 hidden">
        <div id="publishFeatureForm" class="hidden">
            <h3 class="text-lg font-bold">Publish a New Event</h3>
            <label class="block mt-3 font-bold">Event Category</label>
            <select id="categoryInput" class="border p-3 w-full rounded-lg">
                <option value="Conference">Conference</option>
                <option value="Meetup">Meetup</option>
                <option value="Party">Party</option>
                <option value="Workshop">Workshop</option>
            </select>
            <input type="text" id="featureTitle" class="border p-3 w-full mt-2 rounded-lg" placeholder="Event Name">
            <input type="text" id="featureLocation" class="border p-3 w-full mt-2 rounded-lg" placeholder="Location">
            <input type="date" id="featureDate" class="border p-3 w-full mt-2 rounded-lg">
            <textarea id="featureDesc" class="border p-3 w-full mt-2 rounded-lg" placeholder="Event Description"></textarea>
            <div class="mt-4 space-x-4">
                <button onclick="addFeature()" class="bg-green-500 text-white px-5 py-2 rounded-lg shadow-md hover:bg-green-600 transition">Publish</button>
                <button onclick="hideForms()" class="bg-red-500 text-white px-5 py-2 rounded-lg shadow-md hover:bg-red-600 transition">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Latest Events Section -->
    <section class="mt-6 p-6 bg-white shadow-md rounded-lg max-w-4xl mx-auto">
        <h3 class="text-2xl font-bold mb-4">Recent Events</h3>
        <div id="eventCategories"></div>
    </section>

    <!-- Include JavaScript -->
    <script src="eventhub.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            setupAdminFeatures(); 
            showEvents(); 
        });
    </script>
</body>
</html>