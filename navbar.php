<nav class="p-4">
    <div class="shadow-lg bg-white flex items-center justify-between rounded-lg px-5 py-3">
        <div class="flex gap-3 items-center">
            <div class="oveflow-hidden w-[60px] h-[60px] rounded-lg bg-blue-50">
                <img src="asserts/r_logo.webp" class="w-full h-full" alt="">
            </div>
            <div class="w-[3px] h-[70px] bg-[#151616]"></div>
            <h1 class="text-3xl font-semibold text-[#FFBB00]">The Spice <span class="text-[#7E8183]">Garden</span></h1>
        </div>
        <div class="flex gap-3 items-center">
            <!-- <select class="px-4 text-white font-semibold rounded-lg cursor-pointer py-3 bg-[#FE8104]" name="quickLinksSelect" id="quickLinksSelect">
                <option class=" bg-[#fff] text-[#151616] font-medium" value="">Select Option</option>
                <option class=" bg-[#fff] text-[#151616] font-medium" value="">New Order</option>
                <option class=" bg-[#fff] text-[#151616] font-medium" value="">New Category</option>
                <option class=" bg-[#fff] text-[#151616] font-medium" value="">New Item</option>
            </select> -->
            <button onclick="window.location = 'logout.php'" class="flex px-4 text-white font-semibold rounded-lg cursor-pointer py-2 bg-red-500 items-center gap-2 hover:bg-red-600">
                <i data-lucide="layout-dashboard"></i>
                <p class="text-xl">Log Out</p>
            </button>
        </div>
    </div>
</nav>