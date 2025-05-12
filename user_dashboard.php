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
            <a href="./contact.php" class="hover:text-gray-300">Contact</a>
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

    <!-- Footer -->
    <footer class="bg-gray-900 text-white text-center py-4 w-full fixed bottom-0">
        <p class="text-sm">&copy; 2025 Latest Events. All rights reserved.</p>
        <div class="mt-2">
            <a href="#" class="mx-2 hover:text-blue-400">Privacy Policy</a>
            <a href="#" class="mx-2 hover:text-blue-400">Terms of Service</a>
        </div>
    </footer>

    <script>
        let userRole = localStorage.getItem("userRole") || "guest";  
        let loggedInUser = localStorage.getItem("loggedInUser");

        function showEvents() {
            let events = JSON.parse(localStorage.getItem("events")) || [];
            let categories = ["Conference", "Meetup", "Party", "Workshop"];
            let container = document.getElementById("eventCategories");
            container.innerHTML = "";

            categories.forEach(category => {
                let categoryDiv = document.createElement("div");
                categoryDiv.className = "bg-gray-200 p-6 rounded-lg shadow-md mt-6";
                categoryDiv.innerHTML = `<h3 class="text-xl font-bold text-gray-700">${category}</h3><div id="${category.toLowerCase()}Events" class="mt-4 space-y-4"></div>`;
                container.appendChild(categoryDiv);
            });

            events.forEach((event, index) => {
                let eventDiv = document.createElement("div");
                eventDiv.className = "bg-white p-4 shadow-md rounded-md hover:scale-105 transition transform duration-200";
                eventDiv.innerHTML = `
                    <h3 class="text-lg font-bold">${event.eventName}</h3>
                    <p><strong>Location:</strong> ${event.location}</p>
                    <p><strong>Date:</strong> ${event.date}</p>
                    <p><strong>Description:</strong> ${event.desc}</p>
                    <p><strong>RSVP:</strong> <span id="goingCount-${index}">0</span> Going, <span id="interestedCount-${index}">0</span> Interested</p>
                    <button onclick="rsvp('${index}', 'Going')" class="bg-green-500 text-white px-3 py-1 mt-2 rounded shadow-md hover:bg-green-700">Going</button>
                    <button onclick="rsvp('${index}', 'Interested')" class="bg-yellow-500 text-white px-3 py-1 mt-2 rounded shadow-md hover:bg-yellow-700">Interested</button>
                    ${userRole === "admin" ? `<button onclick="deleteEvent('${index}')" class="bg-red-500 text-white px-3 py-1 mt-2 rounded shadow-md hover:bg-red-700">Delete</button>` : ""}
                `;

                document.getElementById(`${event.category.toLowerCase()}Events`).appendChild(eventDiv);
            });

            updateRSVPCounts();
        }

        function rsvp(eventIndex, status) {
            let rsvpData = JSON.parse(localStorage.getItem("rsvpData")) || {};
            rsvpData[eventIndex] = rsvpData[eventIndex] || { Going: 0, Interested: 0 };
            rsvpData[eventIndex][status]++;
            localStorage.setItem("rsvpData", JSON.stringify(rsvpData));

            updateRSVPCounts();
        }

        function updateRSVPCounts() {
            let rsvpData = JSON.parse(localStorage.getItem("rsvpData")) || {};
            Object.keys(rsvpData).forEach(eventIndex => {
                document.getElementById(`goingCount-${eventIndex}`).textContent = rsvpData[eventIndex].Going || 0;
                document.getElementById(`interestedCount-${eventIndex}`).textContent = rsvpData[eventIndex].Interested || 0;
            });
        }

        function deleteEvent(eventIndex) {
            let events = JSON.parse(localStorage.getItem("events")) || [];
            events.splice(eventIndex, 1);
            localStorage.setItem("events", JSON.stringify(events));
            showEvents();
        }

        function setupAdminFeatures() {
            let userRole = localStorage.getItem("userRole");

            if (userRole === "admin") {
                document.getElementById("publishButtonContainer").innerHTML = `
                    <button onclick="showPublishForm()" class="bg-white text-blue-500 px-6 py-3 font-bold rounded-lg shadow-md hover:bg-gray-200 transition">Publish an Event</button>
                `;
            } else {
                document.getElementById("publishButtonContainer").innerHTML = ""; // Hide button for non-admins
            }
        }
        setupAdminFeatures();

        showEvents();
    </script>
</body>
</html>
