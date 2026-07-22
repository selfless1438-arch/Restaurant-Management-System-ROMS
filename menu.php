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
        <div class="me_cover w-[calc(100vw-280px-1rem)] relative left-[280px] min-h-screen ">
            <?php include 'navbar.php'; ?>
            <!-- body of dashboard -->
            <div class="px-4">
                <div class="p-5 bg-white shadow-lg rounded-lg flex justify-between items-center">
                    <p class="text-[#FE8104] font-semibold">Total Items: <span id="tItCount" class="text-[#151616]">0</span> </p>
                    <p class="text-[#FE8104] font-semibold">Available: <span id="availItCount" class="text-[#151616]">0</span> </p>
                    <div class="flex items-center gap-2">
                        <label for="statusSelect" class="text-[#FE8104] font-semibold">Status</label>
                        <select name="statusSelect" id="statusSelect" class="border-2 border-[#FE8104] outline-none active:border-[#FE0004] focus:border-[#FE0004] px-3 py-1 rounded-lg text-[#151616]">
                            <option value="all">All</option>
                            <option value="Available">Available</option>
                            <option value="Not Available">Not Available</option>
                            <option value="Died">Died</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2">
                        <label for="categorySelect" class="text-[#FE8104] font-semibold">Category</label>
                        <select name="categorySelect" id="categorySelect" class="border-2 border-[#FE8104] outline-none active:border-[#FE0004] focus:border-[#FE0004] px-3 py-1 rounded-lg text-[#151616]">
                            <!-- option will be given -->
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex justify-between mx-4 pt-4 items-center gap-3">
                <div>
                    <button onclick="openModal('addItemModal','')" class="bg-[#FE8104] px-4 py-2 text-white rounded-lg shadow-lg cursor-pointer">Add New</button>
                </div>
                <div>
                    <label for="searchMenuItem" class="font-semibold text-xl">Search</label>
                    <input type="text" name="searchMenuItem" id="searchMenuItem" class="border-2 border-[#FE8104] px-4 py-2 w-70 rounded-lg outline-none focus:border-[#FE0004]">
                </div>
            </div>
            <!-- cards cont  -->
            <div id="menuContainer" class="pt-4 flex flex-wrap">
                <!-- Cards will be here -->
            </div>
    </main>
    <?php include 'modals.php'; ?>
</body>
<script>
    lucide.createIcons();
    const fetchCategories = () => {
        const selectInput = document.getElementById('categorySelect');
        const search = "";
        $.ajax({
            url: 'b_category_list.php',
            type: 'POST',
            data: {
                search: search
            },
            dataType: "json",
            success: function(response) {
                let html = '';
                if (response.success) {
                    const data = response.data;
                    html += `
                        <option value="all" >All</option>
                    `
                    data.forEach(category => {
                        html += `
                            <option value="${category.name}">${category.name.toUpperCase()}</option>
                        `
                    });
                } else {
                    html += `
                    <option value="all" selected >Not Found</option>
                    `
                    selectInput.disabled = true;
                }
                selectInput.innerHTML = html;
            }
        })
    }

    fetchCategories();


    const loadItems = () => {
        const data = {
            status: $('#statusSelect').val() ?? '',
            category: $('#categorySelect').val() ?? 'all',
            search: $('#searchMenuItem').val() ?? ''
        }

        $.ajax({
            url: 'b_menu_items.php',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                const itemsBody = document.getElementById('menuContainer');
                let html = '';
                if (response.success) {
                    const counts = response.counts;
                    document.getElementById('tItCount').innerHTML = counts.totalItems;
                    document.getElementById('availItCount').innerHTML = counts.availableItems;
                    const data = response.data;
                    if (data.length === 0) {
                        html = `<p class="m-4 p-4 font-semibold bg-white rounded-lg shadow-lg">No Item Founded!</p>`;
                        itemsBody.innerHTML = html;
                        return;
                    }
                    data.forEach(item => {
                        html += `
                            <div class="w-1/3 lg:w-1/4 xl:w-1/5 p-4">
                                <!-- card cont -->
                                <div class="bg-white shadow-lg rounded-3xl border-1 border-[#FE8104] oveflow-hidden">
                                    <div class="bg-blue-100 w-full aspect-video border-1 border-[#FE8104] relative overflow-hidden rounded-t-2xl">
                                        <img class="absolute w-full h-full object-cover" src="${item.image_path}" onerror="this.onerror=null; this.src='item_thumbnails/default_item_bg.jpg'" alt="sd">
                                        <p class="absolute bottom-2 right-2 font-semibold bg-[#FE810480] text-white px-3 py-1 rounded-full border-1 border-[1e1e1e] shadow-lg backdrop-blur-2xl">${item.status}</p>
                                    </div>
                                    <div class="p-4 pt-2">
                                        <p class="text-center text-[#151616] font-semibold text-xl">${item.food_name}</p>
                                        <p class="text-[#FE8104] font-medium">Category: <span class="text-[#7E8183] font-normal">${item.category_name}</span> </p>
                                        <p class="text-[#FE8104] font-medium">Price: <span class="text-[#7E8183] font-normal">${item.price}</span> </p>
                                        <p class="text-[#FE8104] font-medium">Description: <span class="text-[#7E8183] font-normal">${item.description}</span> </p>
                                        <div class="flex gap-2 justify-between items-center mt-2">
                                            <button onclick='editItem(${item.id});' class="bg-[#FE8104] rounded-lg cursor-pointer text-white px-3 py-2 font-semibold     text-sm " type="button">EDIT</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `
                    });
                    itemsBody.innerHTML = html;
                } else {
                    html = `<p class="m-4 px-4 font-semibold bg-white rounded-lg shadow-lg">No Item Founded!</p>`;
                    itemsBody.innerHTML = html;
                }
            }
        })
    }
    loadItems();

    const arry = [document.getElementById('statusSelect'), document.getElementById('categorySelect'), document.getElementById('searchMenuItem')];
    arry.forEach(input => {
        input.addEventListener('input', () => {
            let itemFilterStorage = {
                status: document.getElementById('statusSelect').value,
                category: document.getElementById('categorySelect').value,
            }
            localStorage.setItem('itemFilterStorage', JSON.stringify(itemFilterStorage));
            loadItems();
        });
    });
    let filter = JSON.parse(localStorage.getItem("itemFilterStorage"))
    setTimeout(() => {
        $('#statusSelect').val(filter.status);
        $('#categorySelect').val(filter.category);
        loadItems();
    }, 100);
</script>

</html>