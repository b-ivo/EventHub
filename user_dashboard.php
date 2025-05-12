<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navigation Bar -->
    <nav class="bg-blue-600 text-white p-4 flex justify-between fixed w-full top-0 z-10 shadow-md">
        <h1 class="text-2xl font-bold">EventHub</h1>
        <div class="space-x-4">
            <a href="./home.php" class="hover:text-gray-300">Home</a>
            <a href="./About.php" class="hover:text-gray-300">About</a>
            <a href="./contact.php" class="hover:text-gray-300">Contact</a><button onclick="logoutUser()" class="bg-red-500 text-white px-6 py-3 font-bold rounded-lg shadow-md hover:bg-red-600 transition">Logout</button>
        </div>
    </nav>

    <!-- Header -->
    <div class="flex justify-between items-center bg-blue-500 p-4 mt-16 shadow-md rounded-lg"> 
        <h1 class="text-3xl font-bold text-white">Latest Events</h1>
        <div id="publishButtonContainer"></div>
    </div>

    <!-- Success Message -->
    <div id="successMessage" class="hidden bg-green-500 text-white p-3 rounded-md text-center transition-opacity duration-500 mt-4">
        Event published successfully!
    </div>

    <!-- Event Categories -->
    <section class="max-w-4xl mx-auto mt-6 space-y-6">
        <h2 class="text-2xl font-bold text-center">Browse Events by Category</h2>
        <div id="eventCategories"></div>
    </section>

    <!-- Event Publishing Form -->
    <div id="formContainer" class="hidden max-w-md mx-auto p-6 bg-white shadow-md rounded-lg mt-12 mb-16">
        <div id="publishFeatureForm" class="hidden">
            <h3 class="text-lg font-bold">Publish a New Event</h3>
            <select id="categoryInput" class="border p-3 w-full rounded-lg mt-2">
                <option value="">Select a Category</option>
                <option value="Conference">Conference</option>
                <option value="Meetup">Meetup</option>
                <option value="Party">Party</option>
                <option value="Workshop">Workshop</option>
            </select>

            <input type="text" id="featureTitle" class="border p-3 w-full mt-2 rounded-lg" placeholder="Event Name">
            <input type="text" id="featureLocation" class="border p-3 w-full mt-2 rounded-lg" placeholder="Location">
            <input type="date" id="featureDate" class="border p-3 w-full mt-2 rounded-lg">
            <textarea id="featureDesc" class="border p-3 w-full mt-2 rounded-lg" placeholder="Event Description"></textarea>
            <button onclick="addFeature()" class="bg-green-500 text-white px-5 py-2 rounded-lg shadow-md hover:bg-green-600 transition">Publish</button>
            <button onclick="hideForms()" class="bg-red-500 text-white px-5 py-2 rounded-lg shadow-md hover:bg-red-600 transition">Cancel</button>
        </div>
    </div>

    <!-- Footer -->
     <footer class="bg-gray-900 text-white text-center py-4 w-full">
        <p class="text-sm">&copy; 2025 Latest Events. All rights reserved.</p>
        <div class="mt-2">
            <a href="#" class="mx-2 hover:text-blue-400">Privacy Policy</a>
            <a href="#" class="mx-2 hover:text-blue-400">Terms of Service</a>
        </div>
    </footer>
    <script src="eventhub.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            setupAdminFeatures();
            showEvents();
        });

        function setupAdminFeatures() {
            let userRole = localStorage.getItem("userRole");
            let publishButtonContainer = document.getElementById("publishButtonContainer");

            if (!publishButtonContainer) {
                console.error("Error: publishButtonContainer not found!");
                return;
            }

            if (userRole === "admin") {
                publishButtonContainer.innerHTML = `<button onclick="showPublishForm()" class="bg-white text-blue-500 px-6 py-3 font-bold rounded-lg shadow-md hover:bg-gray-200 transition">Publish an Event</button>`;
            } else {
                publishButtonContainer.innerHTML = ""; // Hide for non-admin users
            }
        }

        function showPublishForm() {
            let form = document.getElementById("publishFeatureForm");
            if (!form) {
                console.error("Error: publishFeatureForm not found!");
                return;
            }
            form.classList.remove("hidden");
            document.getElementById("formContainer")?.classList.remove("hidden");
        }

        function hideForms() {
            document.getElementById("publishFeatureForm")?.classList.add("hidden");
            document.getElementById("formContainer")?.classList.add("hidden");
        }

        function showEvents() {
            let container = document.getElementById("eventCategories");
            if (!container) {
                console.error("Error: eventCategories container not found!");
                return;
            }

            fetch("get_events.php")
                .then(response => response.json())
                .then(events => {
                    console.log("Fetched Events:", events);

                    container.innerHTML = "";
                    let categories = ["Conference", "Meetup", "Party", "Workshop"];
                    
                    categories.forEach(category => {
                        let categoryDiv = document.createElement("div");
                        categoryDiv.className = "bg-gray-200 p-6 rounded-lg shadow-md mt-6";
                        categoryDiv.innerHTML = `<h3 class="text-xl font-bold text-gray-700">${category}</h3><div id="${category.toLowerCase()}Events" class="mt-4 space-y-4"></div>`;
                        container.appendChild(categoryDiv);
                    });

                    events.forEach(event => {
                        let eventContainer = document.getElementById(`${event.category.toLowerCase()}Events`);
                        if (!eventContainer) {
                            console.warn(`Warning: Category container for ${event.category} not found.`);
                            return;
                        }

                        let eventDiv = document.createElement("div");
                        eventDiv.className = "bg-white p-4 shadow-md rounded-md hover:scale-105 transition transform duration-200";
                        eventDiv.innerHTML = `
                            <h3 class="text-lg font-bold">${event.title}</h3>
                            <p><strong>Location:</strong> ${event.location}</p>
                            <p><strong>Date:</strong> ${event.date}</p>
                            <p><strong>Description:</strong> ${event.description}</p>
                        `;

                        eventContainer.appendChild(eventDiv);
                    });
                })
                .catch(error => console.error("Error fetching events:", error));
        }
    </script>
</body>
</html>
