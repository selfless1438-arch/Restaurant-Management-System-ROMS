<?php
session_start();
if (!isset($_SESSION['roms_loged']) && $_SESSION['roms_loged'] !== true) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | ROMS </title>
    <link rel="shortcut icon" href="asserts/roms_favicon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body class="select-none bg-blue-50 h-screen">
    <main>
        <?php include 'sidebar.php'; ?>
        <div class="me_cover w-[calc(100vw-280px-1rem)] p-4 relative left-[280px] h-screen ">
            <?php include 'navbar.php'; ?>
            <nav class="px-4">
                <div class="bg-white rounded-lg shadow-lg p-4 flex items-center justify-around">
                    <p class="text-[#FE8104] text-lg font-semibold">Total: <span class="text-[#151616]">28</span></p>
                    <p class="text-[#FE8104] text-lg font-semibold">Total: <span class="text-[#151616]">28</span></p>
                    <p class="text-[#FE8104] text-lg font-semibold">Total: <span class="text-[#151616]">28</span></p>
                    <p class="text-[#FE8104] text-lg font-semibold">Total: <span class="text-[#151616]">28</span></p>
                    <p class="text-[#FE8104] text-lg font-semibold">Total: <span class="text-[#151616]">28</span></p>
                </div>
            </nav>
            <div class="p-4">
                <h1 class="text-3xl font-semibold text-[#FE8104] mb-2">Add Order</h1>
                <div class="flex bg-white rounded-lg shadow-lg p-4 items-center">
                    <div class="border-r-2 ">
                        <img src="asserts/a_logo.webp" class="w-[200px]" alt="">
                    </div>
                    <div class="flex flex-wrap w-[calc(100%-500px)]">
                        <div class="mb-4 w-2/10 px-2">
                            <input type="text" class="border-2 border-[#FE8104] rounded-lg px-4 py-2 text-[#FE8104] font-semibold outline-none w-full" name="neOrID" id="neOrID">
                        </div>
                        <div class="mb-4 w-5/10 px-2">
                            <input type="text" class="border-2 border-[#FE8104] rounded-lg px-4 py-2 text-[#FE8104] font-semibold outline-none w-full" name="neOrDate" id="neOrDate">
                        </div>
                        <div class="mb-4 w-3/10">
                            <select class="border-2 border-[#FE8104] rounded-lg px-4 py-2 text-[#FE8104] font-semibold outline-none w-[calc(100%-10px)]" name="neOrType" id="neOrType">
                                <option selected value="Dine In">Dine In</option>
                                <option value="Take Away">Take Away</option>
                                <option value="Delivery">Delivery</option>
                            </select>
                        </div>
                        <div class="w-4/10 px-2">
                            <input type="text" class="border-2 border-[#FE8104] rounded-lg px-4 py-2 text-[#FE8104] font-semibold outline-none w-full" name="neOrDate" id="neOrDate" placeholder="Customer Name">
                        </div>
                        <div class="w-1/1 p-2 flex items-center justify-end">
                            <button class="bg-[#FE8104] px-4 py-2 rounded-lg font-semibold text-white">Done</button>
                        </div>
                    </div>
                    <div class="w-[300px] h-[150px] rounded-lg flex items-center justify-center text-5xl bg-[#444]">
                        <p class="text-[#FE8104] me_sos">1432.00</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script>
    lucide.createIcons();
</script>

</html>