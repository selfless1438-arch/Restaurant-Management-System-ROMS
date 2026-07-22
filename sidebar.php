<!-- jquery cdn -->
 <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- side bar section -->
<div class=" w-[280px] shadow-lg fixed left-0 top-0 h-screen bg-[#FFFFFF]" id="sidebar">
    <!-- tit031le section -->
    <div class="w-full bg-[#fff] flex items-center gap-2 px-3 py-3 relative">
        <div class="w-[50px] bg-blue-50 rounded-lg">
            <img src="asserts/a_logo.webp" alt="">
        </div>
        <span class="me_appName text-[24px] font-bold text-[#FE8104] ">
            ROMS
        </span>
        <button type="button" id="toggleBtn" class="cursor-pointer w-[50px] h-[50px] absolute flex items-center justify-center rounded-lg right-4 hover:bg-[#dddddd] ">
            <img src="asserts/openFolder.svg" class="w-[32px] h-[32px]" alt="">
        </button>
    </div>
    <!-- list section -->
    <ul class="relative py-10">
        <li class="relative px-2">
            <a href="dashboard.php" class=" flex items-center text-[#FE8104] text-xl font-semibold rounded-lg cursor-pointer hover:bg-[#dddddd] gap-2 p-4">
                <i data-lucide="layout-dashboard"></i>
                <span >Dashboard</span>
            </a>
        </li>
        <li class="relative px-2">
            <a href="menu.php" class="flex items-center text-[#FE8104] text-xl font-semibold rounded-lg cursor-pointer hover:bg-[#dddddd] gap-2 p-4">
                <i data-lucide="square-menu"></i>
                <span >Menu</span>
            </a>
        </li>
        <li class="relative px-2">
            <a href="category.php" class="flex items-center text-[#FE8104] text-xl font-semibold rounded-lg cursor-pointer hover:bg-[#dddddd] gap-2 p-4">
                <i data-lucide="blocks"></i>
                <span >Categories</span>
            </a>
        </li>
        <li class="relative px-2">
            <a href="orders.php" class="flex items-center text-[#FE8104] text-xl font-semibold rounded-lg cursor-pointer hover:bg-[#dddddd] gap-2 p-4">
                <i data-lucide="notebook-pen"></i>
                <span >Orders</span>
            </a>
        </li>
    </ul>
</div>

<script src="sidebar.js"></script>