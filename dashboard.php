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
            <!-- body of dashboard -->
            <div class="flex flex-wrap px-2">
                <div class="h-[150px] w-6/10 2xl:w-1/4  p-2">
                    <div class="flex items-center px-3 gap-5 bg-white w-full h-full rounded-lg shadow-xl">
                        <div class="w-[80px] h-[80px] bg-blue-50 rounded-full flex items-center justify-center">
                            <i data-lucide="circle-dollar-sign" class="w-[35px] h-[35px] text-[#FE8104]"></i>
                        </div>
                        <div class="flex flex-col relative bottom-2">
                            <p class="font-semibold text-[#FE8104] text-sm">Today Revenue</p>
                            <h2 class="font-semibold text-4xl text-[#151616]">12,121,123.01</h2>
                        </div>
                    </div>
                </div>
                <div class="h-[150px] w-4/10 2xl:w-1/4  p-2">
                    <div class="flex items-center px-3 gap-5 bg-white w-full h-full rounded-lg shadow-xl">
                        <div class="w-[80px] h-[80px] bg-blue-50 rounded-full flex items-center justify-center">
                            <i data-lucide="hamburger" class="w-[35px] h-[35px] text-[#FE8104]"></i>
                        </div>
                        <div class="flex flex-col relative bottom-2">
                            <p class="font-semibold text-[#FE8104] text-sm">Today Orders</p>
                            <h2 class="font-semibold text-4xl text-[#151616]">12,121,123.01</h2>
                        </div>
                    </div>
                </div>
                <div class="h-[150px] w-4/10 2xl:w-1/4  p-2">
                    <div class="flex items-center px-3 gap-5 bg-white w-full h-full rounded-lg shadow-xl">
                        <div class="w-[80px] h-[80px] bg-blue-50 rounded-full flex items-center justify-center">
                            <i data-lucide="chef-hat" class="w-[35px] h-[35px] text-[#FE8104]"></i>
                        </div>
                        <div class="flex flex-col relative bottom-2">
                            <p class="font-semibold text-[#FE8104] text-sm">This Month Revenue</p>
                            <h2 class="font-semibold text-4xl text-[#151616]">12,121,123.01</h2>
                        </div>
                    </div>
                </div>
                <div class="h-[150px] w-6/10 2xl:w-1/4  p-2">
                    <div class="flex items-center px-3 gap-5 bg-white w-full h-full rounded-lg shadow-xl">
                        <div class="w-[80px] h-[80px] bg-blue-50 rounded-full flex items-center justify-center">
                            <i data-lucide="wallet" class="w-[35px] h-[35px] text-[#FE8104]"></i>
                        </div>
                        <div class="flex flex-col relative bottom-2">
                            <p class="font-semibold text-[#FE8104] text-sm">This Month Revenue</p>
                            <h2 class="font-semibold text-4xl text-[#151616]">12,121,123.01</h2>
                        </div>
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