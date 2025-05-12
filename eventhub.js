// Show & Hide Forms
function showSignupForm() {
    document.getElementById("signupForm").classList.remove("hidden");
    document.getElementById("formContainer").classList.remove("hidden");
}

function showLoginForm() {
    document.getElementById("loginForm").classList.remove("hidden");
    document.getElementById("formContainer").classList.remove("hidden");
}

function showPublishForm() {
    document.getElementById("publishFeatureForm").classList.remove("hidden");
    document.getElementById("formContainer").classList.remove("hidden");
}

function hideForms() {
    document.getElementById("signupForm").classList.add("hidden");
    document.getElementById("loginForm").classList.add("hidden");
    document.getElementById("publishFeatureForm").classList.add("hidden");
    document.getElementById("formContainer").classList.add("hidden");
}

function showPublishForm() {
    document.getElementById("publishFeatureForm").classList.remove("hidden");
    document.getElementById("adminFunctions").classList.remove("hidden");
}

function showUserManagement() {
    alert("User management feature coming soon!");
}

function showAnalytics() {
    alert("Analytics dashboard coming soon!");
}

function hideForms() {
    document.getElementById("publishFeatureForm").classList.add("hidden");
    document.getElementById("adminFunctions").classList.add("hidden");
}
document.addEventListener("DOMContentLoaded", () => {
    console.log("Admin Dashboard JS Loaded!"); // Debugging Log
});


// Signup Functionality
function registerUser() {
    let emailInput = document.getElementById("signupEmail");
    let passwordInput = document.getElementById("signupPassword");
    let roleInput = document.getElementById("signupRole");

    if (!emailInput || !passwordInput || !roleInput) {
        console.error("One or more input fields are missing!");
        return;
    }

    let email = emailInput.value.trim();
    let password = passwordInput.value.trim();
    let role = roleInput.value;

    if (!email || !password || !role) {
        alert("Please fill in all fields.");
        return;
    }

    fetch("signup.php", {
        method: "POST",
        body: new URLSearchParams({ email, password, role }),
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    })
    .then(response => response.json())
    .then(data => {
        console.log("Signup Response:", data);
        alert(data.message);
    })
    .catch(error => console.error("Error:", error));
}


// Login Functionality (Fixes duplicate issue)
function loginUser() {
    let email = document.getElementById("loginEmail").value;
    let password = document.getElementById("loginPassword").value;

    fetch("login.php", {
        method: "POST",
        body: new URLSearchParams({ email, password }),
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    })
    .then(response => response.json())
    .then(data => {
        console.log("Login Response:", data); // Debugging Log
        if (data.status === "success") {
            localStorage.setItem("userRole", data.userRole);
            window.location.href = data.redirect; // 🚀 Redirects to correct dashboard
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error("Error:", error));
}


// Admin Feature Setup (Fixes unexpected "s" issue)
function setupAdminFeatures() {
    let userRole = localStorage.getItem("userRole");
    let publishButtonContainer = document.getElementById("publishButtonContainer");

    if (!publishButtonContainer) {
        console.warn("publishButtonContainer not found."); 
        return;
    }

    if (userRole === "admin") {
        publishButtonContainer.innerHTML = `<button onclick="showPublishForm()" class="bg-white text-blue-500 px-6 py-3 font-bold rounded-lg shadow-md hover:bg-gray-200 transition">Publish an Event</button>`;
    } else {
        publishButtonContainer.innerHTML = "";
    }
}
setupAdminFeatures();

// Event Publishing Functionality
function addFeature() {
    let category = document.getElementById("categoryInput")?.value.trim();
    let title = document.getElementById("featureTitle")?.value.trim();
    let location = document.getElementById("featureLocation")?.value.trim();
    let date = document.getElementById("featureDate")?.value.trim();
    let desc = document.getElementById("featureDesc")?.value.trim();

    if (!category || !title || !location || !date || !desc) {
        console.error("Missing form fields!", { category, title, location, date, desc });
        alert("Please fill in all fields.");
        return;
    }

    console.log("Publishing event:", { category, title, location, date, desc }); // Debugging log

    fetch("publish_event.php", {
        method: "POST",
        body: new URLSearchParams({ category, title, location, date, desc }),
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    })
    .then(response => response.json())
    .then(data => {
        console.log("Publish Response:", data); // Debugging log
        alert(data.message);
        if (data.status === "success") {
            hideForms();
        }
    })
    .catch(error => console.error("Error:", error));
}


// Delete Event Functionality (Admin Only)
function deleteEvent(eventId) {
    fetch("delete_event.php", {
        method: "POST",
        body: new URLSearchParams({ id: eventId }),
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            alert("Event deleted successfully!");
            showEvents();
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => console.error("Error:", error));
}

// Load Events from Database (Fix element reference issue)
function showEvents() {
    fetch("get_events.php")
    .then(response => response.json())
    .then(events => {
        console.log("Raw Events Response:", events); // Debugging log

        if (!Array.isArray(events)) {
            console.error("Error: events is not an array!", events);
            return;
        }

        let eventContainer = document.getElementById("latestEvents");
        if (!eventContainer) {
            console.warn("latestEvents container not found.");
            return;
        }

        eventContainer.innerHTML = ""; 

        if (events.length === 0) {
            eventContainer.innerHTML = "<p class='text-center text-gray-600'>No upcoming events.</p>";
            return;
        }

        events.forEach(event => {
            let eventDiv = document.createElement("div");
            eventDiv.className = "bg-white p-4 shadow-md rounded-md hover:shadow-lg transition transform duration-200";
            eventDiv.innerHTML = `
                <h3 class="text-lg font-bold">${event.title}</h3>
                <p><strong>Category:</strong> ${event.category}</p>
                <p><strong>Location:</strong> ${event.location}</p>
                <p><strong>Date:</strong> ${event.date}</p>
                <p><strong>Description:</strong> ${event.description}</p>
            `;
            eventContainer.appendChild(eventDiv);
        });
    })
    .catch(error => console.error("Error fetching events:", error));
}


// Ensure everything runs when page loads
document.addEventListener("DOMContentLoaded", () => {
    document.querySelector(".bg-green-500").addEventListener("click", registerUser);
    document.querySelector(".bg-red-500").addEventListener("click", hideForms);
});

