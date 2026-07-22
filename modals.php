<!-- Category Modal -->
<div id="addNewCategoryModal" class="fixed hidden left-0 top-0 z-40 items-center justify-center w-screen h-screen bg-[#15161650]">
    <div class="bg-white max-w-[450px] w-full rounded-lg">
        <!-- card title  -->
        <div class="flex items-center me_bg_liner px-4 py-3 rounded-t-lg justify-between">
            <p class="font-semibold">Add Category</p>
            <div class="flex items-center gap-2">
                <button onclick="closeModal('addNewCategoryModal')" class="bg-white text-[#FE8104] font-semibold px-3 py-1 rounded-lg">Close</button>
            </div>
        </div>
        <!-- body -->
        <div class="px-5 py-3">
            <form onsubmit="event.preventDefault()">
                <div class="flex flex-col gap-2 mb-3 w-full">
                    <label for="updateCTIn" class="text-[#FE8104] font-semibold">Title</label>
                    <input type="text" name="updateCTIn" id="updateCTIn" placeholder="Eg: Pizza, Burger, etc." class="border-2 border-[#FE8104] px-4 py-2  rounded-lg outline-none">
                </div>
                <div class="flex flex-col gap-2 mb-5">
                    <label for="updateCDescIn" class="text-[#FE8104] font-semibold">Description</label>
                    <input type="text" name="updateCDescIn" id="updateCDescIn" placeholder="" class="border-2 border-[#FE8104] px-4 py-2  rounded-lg outline-none">
                </div>
                <div class="flex items-center gap-2 mb-3">
                    <button onclick="addCategory('addNewCategoryModal')" class="font-semibold px-4 py-2 rounded-lg me_bg_liner ">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add new Item Modal -->
<div id="addItemModal" class="fixed left-0 top-0 z-40 hidden items-center justify-center w-screen h-screen bg-[#15161650]">
    <div class="bg-white max-w-[450px] w-full rounded-lg">
        <!-- card title  -->
        <div class="flex items-center me_bg_liner px-4 py-3 rounded-t-lg justify-between">
            <p class="font-semibold">Add New Item</p>
            <div class="flex items-center gap-2">
                <button class="bg-white text-[#FE8104] font-semibold px-3 py-1 rounded-lg" onclick="closeModal('addItemModal')">Close</button>
            </div>
        </div>
        <!-- body -->
        <div class="px-5 py-3">
            <form onsubmit="event.preventDefault()" class="flex flex-wrap">
                <div class="flex flex-col gap-2 mb-3 w-full">
                    <label for="aTImgInp" class="text-[#FE8104] font-semibold">Select Image</label>
                    <input type="file" name="aTImgInp" id="aTImgInp" placeholder="aTImgInp" class="border-2 border-[#FE8104] file:bg-[#FE8104] file:font-semibold file:text-white file:border-0 file:me-4 file:py-2 file:px-4  rounded-lg outline-none">
                </div>
                <div class="flex flex-col gap-2 mb-3 w-full">
                    <label for="aINameInp" class="text-[#FE8104] font-semibold">Name</label>
                    <input type="text" name="aINameInp" id="aINameInp" placeholder="Eg: Extra Cheese Large Pizza " class="border-2 border-[#FE8104] px-4 py-2  rounded-lg outline-none">
                </div>
                <div class="flex flex-col gap-2 mb-3 w-full relative">
                    <label for="aICSInp" class="text-[#FE8104] font-semibold">Category</label>
                    <input type="text" name="aICSInp" id="aICSInp" placeholder="Select Category" class="border-2 border-[#FE8104] px-4 py-2  rounded-lg outline-none">
                    <!-- drop down -->
                    <div id="aICDrop" class="bg-[#FE8104] flex flex-wrap absolute left-0 top-19 z-40 border-2 border-white rounded-lg shadow-lg w-full">
                       <!-- drop down items -->
                    </div>
                </div>
                <div class="flex flex-col w-5/12 gap-2 mb-3 ">
                    <label for="aIPriceInp" class="text-[#FE8104] font-semibold">Price</label>
                    <input type="text" name="aIPriceInp" id="aIPriceInp" placeholder="1250.15" class="me_only_num border-2 border-[#FE8104] px-4 py-2  rounded-lg outline-none w-[calc(100%-10px)]">
                </div>
                <div class="flex flex-col w-7/12 gap-2 mb-3 relative">
                    <label for="aIStatusSelect" class="text-[#FE8104] font-semibold">Status</label>
                    <select name="aIStatusSelect" id="aIStatusSelect" class="border-2 border-[#FE8104] px-4 py-2  rounded-lg outline-none">
                        <option value="Available" selected>Available</option>
                        <option value="Not Available">Not Available</option>
                        <option value="Sleeped">Sleeped</option>
                    </select>
                </div>
                <div class="flex flex-col w-full gap-2 mb-3 ">
                    <label for="aIDescInp" class="text-[#FE8104] font-semibold flex items-center justify-between">Description <span id="remLetDe">0/50</span></label>
                    <textarea name="aIDescInp" data-max="50" placeholder="" id="aIDescInp" class="me_max border-2 border-[#FE8104] px-4 py-2  rounded-lg outline-none "></textarea>
                </div>
                <div class="flex items-center gap-2 mb-3">
                    <button onclick="addNewItem('addItemModal')" class="font-semibold px-4 py-2 rounded-lg me_bg_liner ">Add Item</button>
                    <button type="reset" class="font-semibold px-4 py-2 rounded-lg border-2 border-[#FE8104] text-[#FE8104]">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category -->

<div id="editCategoryModal" class="fixed left-0 top-0 z-40 hidden items-center justify-center w-screen h-screen bg-[#15161650]">
    <div class="bg-white max-w-[450px] w-full rounded-lg">
        <!-- card title  -->
        <div class="flex items-center me_bg_liner px-4 py-3 rounded-t-lg justify-between">
            <p class="font-semibold">Edit Category</p>
            <div class="flex items-center gap-2">
                <button onclick="closeModal('editCategoryModal')" class="bg-white text-[#FE8104] font-semibold px-3 py-1 rounded-lg">Close</button>
            </div>
        </div>
        <!-- body -->
        <div class="px-5 py-3">
            <form onsubmit="event.preventDefault()">
                <div class="flex flex-col gap-2 mb-3 w-full">
                    <label for="editCTIn" class="text-[#FE8104] font-semibold">Title</label>
                    <input type="text" name="editCTIn" id="editCTIn" placeholder="Eg: Pizza, Burger, etc." class="border-2 border-[#FE8104] px-4 py-2  rounded-lg outline-none">
                </div>
                <div class="flex flex-col gap-2 mb-5">
                    <label for="editCDescIn" class="text-[#FE8104] font-semibold">Description</label>
                    <input type="text" name="editCDescIn" id="editCDescIn" placeholder="" class="border-2 border-[#FE8104] px-4 py-2  rounded-lg outline-none">
                </div>
                <div class="flex items-center gap-2 mb-3">
                    <button onclick="editCategory('editCategoryModal')" class="font-semibold px-4 py-2 rounded-lg me_bg_liner ">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Menu Item -->
<div id="editItemModal" class="fixed left-0 top-0 z-40 hidden items-center justify-center w-screen h-screen bg-[#15161650]">
    <div class="bg-white max-w-[450px] w-full rounded-lg">
        <!-- card title  -->
        <div class="flex items-center me_bg_liner px-4 py-3 rounded-t-lg justify-between">
            <p class="font-semibold">Edit Item</p>
            <div class="flex items-center gap-2">
                <button onclick="closeModal('editItemModal');" class="bg-white text-[#FE8104] font-semibold px-3 py-1 rounded-lg">Close</button>
            </div>
        </div>
        <!-- body -->
        <div class="px-5 py-3">
            <form onsubmit="event.preventDefault()" class="flex flex-wrap">
                <input type="hidden" name="ITEMID" id="ITEMID">
                <div class="flex flex-col gap-2 mb-3 w-full">
                    <label for="EditTImgInp" class="text-[#FE8104] font-semibold">Select Image</label>
                    <input type="file" name="EditTImgInp" id="EditTImgInp" placeholder="aTImgInp" class="border-2 border-[#FE8104] file:bg-[#FE8104] file:font-semibold file:text-white file:border-0 file:me-4 file:py-2 file:px-4  rounded-lg outline-none">
                </div>
                <div class="flex flex-col gap-2 mb-3 w-full">
                    <label for="EditINameInp" class="text-[#FE8104] font-semibold">Name</label>
                    <input type="text" name="EditINameInp" id="EditINameInp" placeholder="Eg: Extra Cheese Large Pizza " class="border-2 border-[#FE8104] px-4 py-2  rounded-lg outline-none">
                </div>
                <div class="flex flex-col gap-2 mb-3 w-full relative">
                    <label for="EditICSInp" class="text-[#FE8104] font-semibold">Category</label>
                    <input type="text" name="EditICSInp" id="EditICSInp" placeholder="Select Category" class="border-2 border-[#FE8104] px-4 py-2  rounded-lg outline-none">
                    <!-- drop down -->
                    <div id="EditICDrop" class="bg-[#FE8104] flex flex-wrap absolute left-0 top-19 z-40 border-2 border-white rounded-lg shadow-lg w-full">
                       <!-- drop down items -->
                    </div>
                </div>
                <div class="flex flex-col w-5/12 gap-2 mb-3 ">
                    <label for="EditIPriceInp" class="text-[#FE8104] font-semibold">Price</label>
                    <input type="text" name="EditIPriceInp" id="EditIPriceInp" placeholder="1250.15" class="me_only_num border-2 border-[#FE8104] px-4 py-2  rounded-lg outline-none w-[calc(100%-10px)]">
                </div>
                <div class="flex flex-col w-7/12 gap-2 mb-3 relative">
                    <label for="EditIStatusSelect" class="text-[#FE8104] font-semibold">Status</label>
                    <select name="EditIStatusSelect" id="EditIStatusSelect" class="border-2 border-[#FE8104] px-4 py-2  rounded-lg outline-none">
                        <option value="Available" selected>Available</option>
                        <option value="Not Available">Not Available</option>
                        <option value="Sleeped">Sleeped</option>
                    </select>
                </div>
                <div class="flex flex-col w-full gap-2 mb-3 ">
                    <label for="EditIDescInp" class="text-[#FE8104] font-semibold flex items-center justify-between">Description <span id="remLetDe">0/50</span></label>
                    <textarea name="EditIDescInp" data-max="50" placeholder="" id="EditIDescInp" class="me_max border-2 border-[#FE8104] px-4 py-2  rounded-lg outline-none "></textarea>
                </div>
                <div class="flex items-center gap-2 mb-3">
                    <button onclick="editNewItem('editItemModal')" class="font-semibold px-4 py-2 rounded-lg me_bg_liner ">Save Changes</button>
                    <button type="reset" class="font-semibold px-4 py-2 rounded-lg border-2 border-[#FE8104] text-[#FE8104]">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- TEmplate of Modal -->
<div class="fixed left-0 top-0 z-40 hidden items-center justify-center w-screen h-screen bg-[#15161650]">
    <div class="bg-white max-w-[450px] w-full rounded-lg">
        <!-- card title  -->
        <div class="flex items-center me_bg_liner px-4 py-3 rounded-t-lg justify-between">
            <p class="font-semibold">Template</p>
            <div class="flex items-center gap-2">
                <button class="bg-white text-[#FE8104] font-semibold px-3 py-1 rounded-lg">Close</button>
            </div>
        </div>
        <!-- body -->
        <div class="px-5 py-3">
            <form onsubmit="event.preventDefault()">
                <div class="flex flex-col gap-2 mb-3 w-full">
                    <label for="Template" class="text-[#FE8104] font-semibold">Template</label>
                    <input type="text" name="Template" id="Template" placeholder="TEmplate" class="border-2 border-[#FE8104] px-4 py-2  rounded-lg outline-none">
                </div>
                <div class="flex items-center gap-2 mb-3">
                    <button class="font-semibold px-4 py-2 rounded-lg me_bg_liner ">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- script -->

<script src="modals.js"></script>