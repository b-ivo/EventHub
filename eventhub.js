document.addEventListener("DOMContentLoaded", () => {
    setupAdminFeatures();

    // Ensure eventCategories exists before calling showEvents
    if (document.getElementById("eventCategories")) {
        showEvents();
    } else {
        console.error("Error: eventCategories container not found in DOM at page load.");
    }
});
function loginUser() {
    let email = document.getElementById("loginEmail")?.value.trim();
    let password = document.getElementById("loginPassword")?.value.trim();

    if (!email || !password) {
        alert("Please enter both email and password.");
        return;
    }

    fetch("login.php", {
    method: "POST",
    body: new URLSearchParams({ email, password }),
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    })
    .then(response => response.text()) // Fetch raw text first
    .then(text => {
        try {
            let data = JSON.parse(text); // Parse JSON safely
            console.log("Login Response:", data);
            if (data.status === "success") {
                localStorage.setItem("loggedInUser", email);
                localStorage.setItem("userRole", data.userRole);
                window.location.href = './admin_dashboard.php'; // Redirect to dashboard
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error("Error parsing JSON response:", error, "Raw Response:", text);
        }
    })
    .catch(error => console.error("Network error:", error));
}


function registerUser() {
    let email = document.getElementById("signupEmail").value.trim();
    let password = document.getElementById("signupPassword").value.trim();
    let role = document.getElementById("signupRole").value;

    if (!email || !password || !role) {
        alert("Please fill in all fields.");
        return;
    }

    fetch("signup.php", {
    method: "POST",
    body: new URLSearchParams({ email, password, role }),
    headers: { "Content-Type": "application/x-www-form-urlencoded" }
        })
        .then(response => {
            return response.text(); // First check raw response
        })
        .then(text => {
            try {
                let data = JSON.parse(text); // Parse JSON safely
                console.log("Signup Response:", data);
                alert(data.message);
            } catch (error) {
                console.error("Error parsing JSON response:", error, "Raw Response:", text);
            }
        })
        .catch(error => console.error("Network error:", error));


    }


// Show & Hide Forms
function showSignupForm() {
    document.getElementById("signupForm")?.classList.remove("hidden");
    document.getElementById("formContainer")?.classList.remove("hidden");
}

function showLoginForm() {
    document.getElementById("loginForm")?.classList.remove("hidden");
    document.getElementById("formContainer")?.classList.remove("hidden");
}

function showPublishForm() {
    document.getElementById("publishFeatureForm")?.classList.remove("hidden");
    document.getElementById("formContainer")?.classList.remove("hidden");
    document.getElementById("adminFunctions")?.classList.remove("hidden"); 
}

function hideForms() {
    document.getElementById("signupForm")?.classList.add("hidden");
    document.getElementById("loginForm")?.classList.add("hidden");
    document.getElementById("publishFeatureForm")?.classList.add("hidden");
    document.getElementById("formContainer")?.classList.add("hidden");
    document.getElementById("adminFunctions")?.classList.add("hidden"); 
}

// Admin Feature Setup
function setupAdminFeatures() {
    let userRole = localStorage.getItem("userRole");
    let publishButtonContainer = document.getElementById("publishButtonContainer");

    if (!publishButtonContainer) {
        console.warn("Warning: publishButtonContainer not found.");
        return;
    }

    publishButtonContainer.innerHTML = userRole === "admin"
        ? `<button onclick="showPublishForm()" class="bg-white text-blue-500 px-6 py-3 font-bold rounded-lg shadow-md hover:bg-gray-200 transition">Publish an Event</button>`
        : "";
}

// Event Publishing Functionality
function addFeature() {
    let categoryElement = document.getElementById("categoryInput");
    let titleElement = document.getElementById("featureTitle");
    let locationElement = document.getElementById("featureLocation");
    let dateElement = document.getElementById("featureDate");
    let descElement = document.getElementById("featureDesc");

    if (!categoryElement || !titleElement || !locationElement || !dateElement || !descElement) {
        console.error("Error: Missing form fields!");
        alert("Please fill in all fields.");
        return;
    }

    let category = categoryElement.value.trim();
    let title = titleElement.value.trim();
    let location = locationElement.value.trim();
    let date = dateElement.value.trim();
    let desc = descElement.value.trim();

    if (!category || !title || !location || !date || !desc) {
        alert("Please fill in all fields.");
        return;
    }

    fetch("publish_event.php", {
        method: "POST",
        body: new URLSearchParams({ category, title, location, date, desc }),
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    })
    .then(response => response.json())
    .then(data => {
        console.log("Publish Response:", data);
        alert(data.message);
        if (data.status === "success") {
            hideForms();
            showEvents(); // Reload events after publishing
        }
    })
    .catch(error => console.error("Error:", error));
}

// Load Events from Database
function showEvents() {
    fetch("get_events.php")
        .then(response => response.json())
        .then(events => {
            console.log("Fetched Events:", events); // Debugging log

            let container = document.getElementById("eventCategories");
            if (!container) {
                console.error("Error: eventCategories container not found!");
                return;
            }

            container.innerHTML = "";

            if (!Array.isArray(events) || events.length === 0) {
                container.innerHTML = "<p class='text-center text-gray-600'>No upcoming events.</p>";
                return;
            }

            events.forEach(event => {
                console.log("Rendering event:", event.title);
                let eventDiv = document.createElement("div");
                eventDiv.className = "bg-white p-4 shadow-md rounded-md hover:shadow-lg transition";
                eventDiv.innerHTML = `
                    <h3 class="text-lg font-bold">${event.title}</h3>
                    <p><strong>Category:</strong> ${event.category}</p>
                    <p><strong>Location:</strong> ${event.location}</p>
                    <p><strong>Date:</strong> ${event.date}</p>
                    <p><strong>Description:</strong> ${event.description}</p>
                `;
                container.appendChild(eventDiv);
            });
        })
        .catch(error => console.error("Error fetching events:", error));
}

function logoutUser() {
    localStorage.removeItem("loggedInUser");
    localStorage.removeItem("userRole");
    window.location.href = "home.php"; // Redirect to homepage after logout
}