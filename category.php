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
    <title>Category | ROMS </title>
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
            <div class="flex pt-3 px-4">
                <div class=" pr-3 w-1/2">
                    <div class="rounded-lg shadow-lg border-1 border-[#FE8104]">
                        <!-- title -->
                        <div class="flex items-center justify-between px-4 py-2 text-white bg-[#FE8104] rounded-t-lg">
                            <h2 class="text-xl">Categories List</h2>
                            <div class="flex items-center gap-2">
                                <div>
                                    <input type="text" name="cLisSearch" id="cLisSearch" placeholder="Search Category" class="border-2 border-white font-semibold px-4 py-2  rounded-lg outline-none">
                                </div>
                                <button onclick="openModal('addNewCategoryModal','')" class="bg-white px-4 py-2 rounded-lg my-1 text-[#FE8104] font-semibold">Add New</button>
                            </div>
                        </div>
                        <!-- body -->
                        <div>
                            <table class="w-full">
                                <thead class="bg-blue-100">
                                    <tr>
                                        <th class="py-1 px-3 text-start">Sr.</th>
                                        <th class="py-1 px-3 text-start">Title</th>
                                        <th colspan="2" class="text-start py-1 px-3">Description</th>
                                        <th class="py-1 px-3 text-start">Items</th>
                                        <th class="py-1 px-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="categoryTBody">
                                    <!-- data -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="pl-3 w-1/2">
                    <div class="rounded-lg shadow-lg border-1 border-[#FE8104]">
                        <!-- title -->
                        <div class="flex items-center justify-between px-4 py-2 text-white bg-[#FE8104] rounded-t-lg">
                            <div>
                                <label for="chSeInp" class="font-semibold ">Category</label>
                                <select name="chSeInp" class="border-2 border-white px-3 py-1 rounded-lg cursor-pointer" id="chSeInp">
                                    <option value="All" class="text-[#151616]">All</option>
                                    <option value="All" class="text-[#151616]">All</option>
                                    <option value="All" class="text-[#151616]">All</option>
                                    <option value="All" class="text-[#151616]">All</option>
                                </select>
                            </div>
                            <div class="flex  items-center gap-2">
                                <input type="date" class="border-2 border-white px-3 py-1 rounded-lg text-white" name="chFromDate" id="chFromDate">
                                <p class="font-semibold text-lg"> To </p>
                                <input type="date" class="border-2 border-white px-3 py-1 rounded-lg text-white" name="chToDate" id="chToDate">
                            </div>
                        </div>
                        <!-- body -->
                        <div class="h-100 text-center p-5">
                            <p>Hre will be chart </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include 'modals.php'; ?>
</body>
<script>
    function rediItem(category) {
        let fil = localStorage.getItem('itemFilterStorage');
        let stat = JSON.parse(fil).status;
        let itemFilterStorage = {
            status: stat,
            category: category,
        }
        localStorage.setItem('itemFilterStorage', JSON.stringify(itemFilterStorage));
        window.location = 'menu.php';
    }
    lucide.createIcons();
    // loading categories list
    const loadListCategory = () => {
        const search = $('#cLisSearch').val() ?? '';
        $.ajax({
            url: 'b_category_list.php',
            type: 'POST',
            data: {
                search: search
            },
            dataType: 'json',
            success: function(response) {
                let html = '';
                let tableBody = document.getElementById('categoryTBody');
                if (response.success) {
                    let count = 0;
                    let totalItems = 0;
                    const data = response.data;
                    data.forEach(item => {
                        totalItems += parseInt(item.items);
                        html += `
                            <tr class='hover:bg-[#FE810430]'>
                                <th class="py-2 px-3 text-start">${++count}</th>
                                <td class="py-2 px-3 text-start">${item.name}</td>
                                <td class="py-2 px-3" colspan="2">${item.description}</td>
                                <td class="py-2 px-3">${item.items}</td>
                                <td class="py-2 px-3 text-center flex items-center justify-center gap-1">
                                    <button onclick="rediItem('${item.name}')" class="bg-[#FE8104] px-3 py-1 rounded-lg font-semibold text-white cursor-pointer">Show</button>
                                    <button onclick="openModal('editCategoryModal',${item.id})" class="bg-[#FE8104] px-3 py-1 rounded-lg font-semibold text-white cursor-pointer">Edit</button>
                                </td>
                            </tr>
                        `
                    });
                    html += `
                        <tr>
                            <td colspan="3" class="py-2 px-3 text-[#FE8104] font-semibold text-center">Categories: <span class="text-[#151616]">${count}</span></td>
                            <td colspan="3" class="py-2 px-3 text-center text-[#FE8104] font-semibold"> Total Items: <span class="text-[#151616]">${totalItems}</span> </td>
                        </tr>
                    `
                }
                tableBody.innerHTML = html;
            },
            error: function(xhr, status, error) {
                console.error(error);
                console.error(xhr.responseText);
                alert('An error occurred while adding the item.');
            }
        })
    }
    loadListCategory();

    document.getElementById('cLisSearch').addEventListener('input', () => {
        loadListCategory();
    });
</script>

</html>