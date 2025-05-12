<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About EventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navigation Bar -->
    <nav class="bg-blue-600 text-white p-4 flex justify-between fixed w-full top-0 z-10">
        <h1 class="text-2xl font-bold">EventHub</h1>
        <div>
            <a href="./Home.php" class="mx-3 hover:text-gray-300">Home</a>
            <a href="./user_dashboard.php" class="mx-3 hover:text-gray-300">Events</a>
            <a href="About.php" class="mx-3 hover:text-gray-300">About</a>
            <a href="contact.php" class="mx-3 hover:text-gray-300">Contact</a>
        </div>
    </nav>

    <!-- Header -->
    <header class="text-center mt-16 p-12 bg-blue-500 text-white">
        <h1 class="text-4xl font-bold">About EventHub</h1>
        <p class="text-lg mt-2">Bringing people together through events, innovation, and community.</p>
    </header>

    <!-- Our Mission Section -->
    <section class="max-w-4xl mx-auto mt-8 bg-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-bold text-center">Our Mission</h2>
        <p class="mt-4 text-gray-600 text-center">At EventHub, our goal is to connect people with exciting events, 
            making it easier for everyone to discover, share, and participate in experiences that matter.</p>
    </section>

    <!-- How It Works -->
    <section class="max-w-4xl mx-auto mt-8 bg-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-bold text-center">How It Works</h2>
        <div class="mt-4">
            <p class="text-gray-600"><strong>✔ Discover Events:</strong> Browse events happening in your area.</p>
            <p class="text-gray-600"><strong>✔ Publish Your Event:</strong> Easily add and share your own event.</p>
            <p class="text-gray-600"><strong>✔ Engage & Participate:</strong> RSVP, comment, and get involved.</p>
        </div>
    </section>

    <!-- Why Choose EventHub -->
    <section class="max-w-4xl mx-auto mt-8 bg-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-bold text-center">Why Choose EventHub?</h2>
        <ul class="mt-4 list-disc text-gray-600 ml-6">
            <li> Easy event discovery and publishing</li>
            <li> User-friendly interface with real-time updates</li>
            <li>Engaged community of event organizers and participants</li>
            <li>Secure platform ensuring privacy and reliability</li>
        </ul>
    </section>

    <!-- Contact Section with Form -->
    <section class="max-w-4xl mx-auto mt-8 bg-white p-8 rounded shadow-md text-center">
        <h2 class="text-2xl font-bold">Contact Us</h2>
        <p class="text-gray-600 mt-2">Have questions or feedback? Reach out to us below.</p>

        <!-- Contact Form -->
        <div class="mt-6">
            <form id="contactForm" class="bg-gray-100 p-6 rounded-lg shadow-lg max-w-md mx-auto">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Your Name</label>
                    <input type="text" id="name" class="w-full p-3 border rounded focus:ring-2 focus:ring-blue-500" placeholder="Enter your name" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Your Email</label>
                    <input type="email" id="email" class="w-full p-3 border rounded focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
                </div>

                <div class="mb-4">
                    <label for="message" class="block text-gray-700 font-bold mb-2">Your Message</label>
                    <textarea id="message" class="w-full p-3 border rounded focus:ring-2 focus:ring-blue-500" placeholder="Write your message here..." required></textarea>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-6 py-3 font-bold rounded shadow-md hover:bg-blue-600">
                    Send Message
                </button>

                <!-- Success Message -->
                <p id="successMessage" class="hidden text-green-600 mt-4 font-bold">Message sent successfully!</p>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white text-center py-4 w-full relative mt-auto">
        <p class="text-sm">&copy; 2025 EventHub. All rights reserved.</p>
        <div class="mt-2">
            <a href="#" class="mx-2 hover:text-blue-400">Privacy Policy</a>
            <a href="#" class="mx-2 hover:text-blue-400">Terms of Service</a>
        </div>
    </footer>
    <!-- Script that makes it function -->
    <script>
        document.getElementById("contactForm").addEventListener("submit", function(event) {
            event.preventDefault();

            let name = document.getElementById("name").value.trim();
            let email = document.getElementById("email").value.trim();
            let message = document.getElementById("message").value.trim();

            if (name === "" || email === "" || message === "") {
                alert("Please fill in all fields.");
                return;
            }

            document.getElementById("successMessage").classList.remove("hidden");
            this.reset();
        });
    </script>

</body>
</html>