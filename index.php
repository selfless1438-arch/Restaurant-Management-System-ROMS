<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ROMS </title>
    <link rel="shortcut icon" href="asserts/roms_favicon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="select-none">
    <main class="flex h-screen oveflow-hidden">
        <div class="w-full flex flex-col items-center justify-center lg:w-1/2">
            <!-- top section of page -->
            <div>
                <div class="flex justify-center items-center gap-4">
                    <img src="asserts/logo.jpg" class="w-[160px]" alt="sdf">
                    <div class="w-[3px] bg-black h-[170px]"></div>
                    <img src="asserts/r_logo.png" class="w-[160px]" alt="sdf">
                </div>
                <h1 class="font-semibold text-[3rem] text-center ">Welcome Back!</h1>
            </div>
            <!-- bottom section -->
            <div class="max-w-sm w-full">
                <form class="flex flex-col mb-4 gap-4">
                    <div class="flex flex-col gap-1">
                        <label for="email" class="font-semibold">Email Address</label>
                        <input type="text" class="border-2 rounded px-5 py-2 outline-none font-medium text-[#7E8183] border-[#FE8104]" name="email" id="email">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="password" class="font-semibold">Password</label>
                        <input type="password" class="border-2 rounded px-5 py-2 outline-none font-medium text-[#7E8183] border-[#FE8104]" name="password" id="password">
                    </div>
                    <button type="button" onclick="checkLogin()" class="bg-[#FE8104] hover:bg-[#ffbb00] cursor-pointer active:bg-[#151616] text-white px-5 py-2 rounded font-semibold">Log In</button>
                </form>
                <p class="text-[#151616] font-semibold">Don't have account <a href="" class="ms-1 underline text-blue-500">Register.</a></p>
            </div>
        </div>
        <div class="w-0 lg:w-1/2 relative oveflow-hidden">
            <img src="asserts/login_bg.webp" class="absolute left-0 top-0 w-full object-cover object-center h-full" alt="bg img">
        </div>
    </main>
    <script>
        lucide.createIcons();
        function checkLogin() {
            const data = {
                email: $('#email').val() ?? '',
                password: $('#password').val() ?? ''
            }

            // Validations 

            if (data.email.trim() === '' || !(data.email.includes('@')) || !(data.email.includes('.'))) {
                document.getElementById('email').classList.add('border-red-600');
                return;
            } else if (data.password.trim() === '') {
                document.getElementById('password').classList.add('border-red-600');
                return;
            }


            $.ajax({
                url: 'b_check_login.php',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        window.location = 'dashboard.php';
                    } else {
                        alert(response.message);
                    }
                }
            })
        }
    </script>
</body>

</html>