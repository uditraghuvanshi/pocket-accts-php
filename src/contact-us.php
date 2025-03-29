<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pocket Accts - Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="overflow-x-hidden bg-gray-100">
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center h-20">
            <div class="text-2xl font-bold">
                <a href="../index.html">Pocket Accts</a>
            </div>
            <a href="../index.html" class="bg-teal-500 hover:bg-teal-600 p-2 rounded-xl text-white text-xl">&#x25c2; Back</a>
        </div>
    </nav>

    <div class="container mx-auto max-w-7xl py-10 px-4 md:px-0">
        
        <!-- Contact Information Card -->
        <div class="max-w-7xl mx-auto px-6 py-10">
        <div class="bg-white shadow-xl rounded-xl p-6 space-y-4 border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">ℹ️ Contact Information</h2>
            <p>We'd love to hear from you! Whether you have questions about our services, need assistance with your
                financial management, or want to schedule a consultation, feel free to reach out to us through any of
                the following methods:</p>
            <p><strong>Phone 📞:</strong><a href="tel:+44 7587746206"> +44 7587746206</a></p>
            <p><strong>Email 📧:</strong><a href="mailto:info@pocket-accts.co.uk"> info@pocket-accts.co.uk</a></p>
            <p><strong>Address 🏠:</strong> 223, Brabazon Road, London, UK</p>
            <p><strong>Business Hours ⏰:</strong> Monday to Friday: 9:00 AM – 5:00 PM</p>
            <p> 👇 Alternatively, you can fill out the contact form below, and a member of our team will get back to you
                promptly!</p>

        </div>
    </div>

        <!-- Contact Form & Image Side by Side -->
        <div class="bg-white shadow-xl rounded-xl p-6 border border-gray-200 mx-4 md:mx-0 mt-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 text-center md:text-left">Contact Us</h1>

            <!-- Display success/error message -->
            <?php if (isset($_SESSION['message'])): ?>
                <div id="messageBox" class="text-center p-3 rounded-md text-white text-lg font-semibold 
                    <?php echo $_SESSION['status'] === 'success' ? 'bg-green-500' : 'bg-red-500'; ?>">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <script>
                    setTimeout(() => {
                        document.getElementById("messageBox").style.display = "none";
                    }, 5000);
                </script>
                <?php unset($_SESSION['message']); unset($_SESSION['status']); ?>
            <?php endif; ?>

            <!-- Flex container for form & image -->
            <div class="flex flex-col md:flex-row items-center gap-8 mt-6">
                
                <!-- Contact Form -->
                <div class="w-full md:w-1/2">
                    <form id="contactForm" action="./submit_contact_form.php" method="POST" class="space-y-4">
                        <input type="text" id="name" name="name" placeholder="Name"
                            class="border-2 border-gray-300 p-3 rounded-md w-full">

                        <div class="flex space-x-2">
                            <select id="country_code" name="country_code" class="border-2 border-gray-300 p-3 rounded-md w-1/3">
                                <option value="">Select Country Code</option>
                                <option value="+1">+1 (USA)</option>
                                <option value="+44">+44 (UK)</option>
                                <option value="+91">+91 (India)</option>
                            </select>
                            <input type="tel" id="phone" name="phone" placeholder="Phone No."
                                class="border-2 border-gray-300 p-3 rounded-md w-2/3">
                        </div>

                        <input type="email" id="email" name="email" placeholder="Email"
                            class="border-2 border-gray-300 p-3 rounded-md w-full">
                        
                        <input type="text" id="business_name" name="business_name" placeholder="Business Name"
                            class="border-2 border-gray-300 p-3 rounded-md w-full">
                        
                        <select id="services" name="service" class="border-2 border-gray-300 p-3 rounded-md w-full">
                            <option value="">Select Service</option>
                            <option value="Bookkeeping">Streamlined Bookkeeping</option>
                            <option value="Tax">Tax Preparation</option>
                        </select>

                        <textarea id="description" name="description" placeholder="Write a Description (Optional)..."
                            class="border-2 h-32 p-3 rounded-md w-full"></textarea>

                        <!-- Error/Success Message below textarea -->
                        <div id="formMessage" class="text-center p-3 rounded-md text-white text-lg font-semibold hidden"></div>

                        <button type="submit"
                            class="bg-teal-500 text-xl text-white p-3 rounded-xl hover:bg-teal-600 w-full">Submit</button>
                    </form>
                </div>

                <!-- Contact Us Image -->
                <div class="w-full md:w-1/2 flex justify-center">
                    <img class="rounded-lg  w-full h-auto max-h-[600px] object-contain" src="../images\Consultative sales.gif" alt="Contact Us">
                </div>

            </div>
        </div>
    </div>

    <script>
        document.getElementById("contactForm").addEventListener("submit", function(event) {
            let requiredFields = ["name", "country_code", "phone", "email", "business_name", "services"];
            let isValid = true;

            requiredFields.forEach(fieldId => {
                let field = document.getElementById(fieldId);
                if (!field.value.trim()) {
                    field.classList.add("border-red-500");
                    isValid = false;

                    setTimeout(() => {
                        field.classList.remove("border-red-500");
                    }, 2000);
                }
            });

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if any required field is empty
                let messageBox = document.getElementById("formMessage");
                messageBox.innerText = "All fields are required except the description.";
                messageBox.classList.remove("hidden");
                messageBox.classList.add("bg-red-500");
                setTimeout(() => {
                    messageBox.classList.add("hidden");
                }, 5000);
            }
        });
    </script>
</body>
</html>
