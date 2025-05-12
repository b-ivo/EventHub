<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact EventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <nav class="bg-blue-600 text-white p-4 flex justify-between fixed w-full top-0 z-10">
        <h1 class="text-2xl font-bold">EventHub</h1>
        <div>
            <a href="./Home.php" class="mx-3 hover:text-gray-300">Home</a>
            <a href="./user_dashboard.php" class="mx-3 hover:text-gray-300">Events</a>
            <a href="About.php" class="mx-3 hover:text-gray-300">About</a>
            <a href="contact.php" class="mx-3 hover:text-gray-300">Contact</a>
        </div>
    </nav>

    <header class="text-center mt-16 p-12 bg-blue-500 text-white">
        <h1 class="text-4xl font-bold">Contact Us</h1>
        <p class="text-lg mt-2">Reach out with questions, feedback, or collaboration ideas.</p>
    </header>

    <section class="max-w-4xl mx-auto mt-8 bg-white p-8 rounded shadow-md text-center">
        <h2 class="text-2xl font-bold">Our Contact Details</h2>
        <p class="text-gray-600 mt-4"><strong>📧 Email:</strong> support@eventhub.com</p>
        <p class="text-gray-600 mt-2"><strong>📞 Phone:</strong> +123 456 7890</p>
        <p class="text-gray-600 mt-2"><strong>📍 Address:</strong> 123 Event Street, Kigali, Rwanda</p>
    </section>

    <section class="max-w-4xl mx-auto mt-8 bg-white p-12 rounded shadow-2xl border border-gray-300">
        <h2 class="text-3xl font-bold text-center">Send Us a Message</h2>
        <form id="contactForm" class="mt-6 bg-gray-100 p-12 rounded-lg shadow-lg max-w-lg mx-auto">
            <div class="mb-6">
                <label for="name" class="block text-gray-700 font-bold mb-2 text-lg">Your Name</label>
                <input type="text" id="name" class="w-full p-4 border rounded focus:ring-2 focus:ring-blue-500" placeholder="Enter your name" required>
            </div>
    
            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-bold mb-2 text-lg">Your Email</label>
                <input type="email" id="email" class="w-full p-4 border rounded focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
            </div>
    
            <div class="mb-6">
                <label for="message" class="block text-gray-700 font-bold mb-2 text-lg">Your Message</label>
                <textarea id="message" class="w-full p-4 border rounded focus:ring-2 focus:ring-blue-500" placeholder="Write your message here..." required></textarea>
            </div>
    
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 text-lg font-bold rounded shadow-md hover:bg-blue-600">
                Send Message
            </button>

            <p id="successMessage" class="hidden text-green-600 mt-4 font-bold text-lg">Message sent successfully!</p>
        </form>
    </section>
    

    <section class="max-w-4xl mx-auto mt-8 bg-white p-8 rounded shadow-md text-center">
        <h2 class="text-2xl font-bold">Follow Us</h2>
        <div class="mt-4 flex justify-center space-x-6">
            <a href="#" class="text-blue-600 hover:text-blue-800 text-lg">🌍 Website</a>
            <a href="#" class="text-blue-600 hover:text-blue-800 text-lg">📘 Facebook</a>
            <a href="#" class="text-blue-600 hover:text-blue-800 text-lg">🐦 Twitter</a>
            <a href="#" class="text-blue-600 hover:text-blue-800 text-lg">📸 Instagram</a>
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