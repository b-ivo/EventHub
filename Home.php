<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventHub - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4 flex justify-between fixed w-full top-0 z-10 shadow-lg">
        <h1 class="text-2xl font-bold">EventHub</h1>
        <div class="space-x-4">
            <a href="home.php" class="hover:text-gray-300">Home</a>
            <a href="user_dashboard.php" class="hover:text-gray-300">Events</a>
            <a href="about.php" class="hover:text-gray-300">About</a>
            <a href="contact.php" class="hover:text-gray-300">Contact</a>
        </div>
    </nav>
    <div id="publishButtonContainer"></div>

    <!-- Hero Section -->
    <section class="text-center mt-24 p-12 bg-blue-500 text-white rounded-lg shadow-md max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold">Discover & Share Amazing Events</h1>
        <p class="text-lg mt-2">Join EventHub and explore events happening around you.</p>
        <div class="mt-6 flex flex-wrap justify-center gap-4">
            <button onclick="showPublishForm()" class="bg-white text-blue-500 px-6 py-3 font-bold rounded-lg shadow-md hover:bg-gray-200 transition">Publish Your Event</button>
            <button onclick="showLoginForm()" class="bg-white text-blue-500 px-6 py-3 font-bold rounded-lg shadow-md hover:bg-gray-200 transition">Login</button>
            <button onclick="showSignupForm()" class="bg-white text-blue-500 px-6 py-3 font-bold rounded-lg shadow-md hover:bg-gray-200 transition">Sign up</button>
        </div>
    </section>
    <div id="latestEvents" class="mt-6"></div>

    <!-- Include Signup, Login, Event Publishing Forms -->
    <div id="formContainer" class="hidden max-w-md mx-auto p-6 bg-white shadow-md rounded-lg mt-6">
        <div id="signupForm" class="hidden">
            <h3 class="text-lg font-bold">Sign Up</h3>
            <input type="text" id="signupEmail" class="border p-3 w-full mt-2 rounded-lg" placeholder="Email">
            <input type="password" id="signupPassword" class="border p-3 w-full mt-2 rounded-lg" placeholder="Password">
            <select id="signupRole" class="border p-3 w-full mt-2 rounded-lg">
                <option value="user">Regular User</option>
                <option value="admin">Admin</option>
            </select>
            <div class="mt-4 space-x-4">
                <button onclick="registerUser()" class="bg-green-500 text-white px-5 py-2 rounded-lg shadow-md hover:bg-green-600 transition">Sign Up</button>
                <button onclick="hideForms()" class="bg-red-500 text-white px-5 py-2 rounded-lg shadow-md hover:bg-red-600 transition">Cancel</button>
            </div>
        </div>

        <div id="loginForm" class="hidden">
            <h3 class="text-lg font-bold">Login</h3>
            <input type="text" id="loginEmail" class="border p-3 w-full mt-2 rounded-lg" placeholder="Email">
            <input type="password" id="loginPassword" class="border p-3 w-full mt-2 rounded-lg" placeholder="Password">
            <div class="mt-4 space-x-4">
                <button onclick="loginUser()" class="bg-green-500 text-white px-5 py-2 rounded-lg shadow-md hover:bg-green-600 transition">Login</button>
                <button onclick="hideForms()" class="bg-red-500 text-white px-5 py-2 rounded-lg shadow-md hover:bg-red-600 transition">Cancel</button>
            </div>
        </div>

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

    <!-- Include JavaScript -->
    <script src="eventhub.js"></script>

</body>