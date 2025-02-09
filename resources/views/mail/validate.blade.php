<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Validation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-[#123524]">

<div class="bg-[#1D3A12] shadow-lg rounded-lg p-8 w-[31rem] text-center">
    <h2 class="text-2xl font-bold text-white mb-4">Validate Your Email</h2>
    <p class="text-white opacity-[0.71] mb-6">Enter your email to confirm your account and get access to exclusive content.</p>

    <form>
        <input type="email" placeholder="Enter your email"
               class="w-full px-4 py-4 border-2 border-[#5CB338] rounded-lg focus:outline-none text-white mb-4 bg-transparent" required>

        <button type="submit"
                class="w-full bg-[#5CB338] text-white font-bold py-5 rounded-lg hover:bg-[#123524] transition">
            Validate Email
        </button>
    </form>
</div>

</body>
</html>


{{--  page for enter email for activate accout (route after click link from email) --}}
