// open Modal 

function openModal(id, itemId) {
    const modal = document.getElementById(id);
    modal.classList.replace('hidden', 'flex');
}

// close Modal 

function closeModal(id) {
    const modal = document.getElementById(id);
    modal.classList.replace('flex', 'hidden');
}
// check filed for modal 

const checkFields = (modalId) => {
    const modal = document.getElementById(modalId);
    const inputs = modal.querySelectorAll('form input');
    const emptyInput = [...inputs].find(input => input.value.trim() === '');
    if (emptyInput) {
        emptyInput.classList.add('alert');
        emptyInput.setAttribute('placeholder', "I'm Empty");
        emptyInput.focus();
        return;
    }
}
// add category function

const addCategory = (modalId) => {
    const data = {
        title: $('#aCTIn').val(),
        description: $('#aCDescIn').val(),
    }
    checkFields(modalId);
    $.ajax({
        url: 'b_add_category.php',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                window.location.reload();
            } else {
                alert(response.message);
            }
        }
    });
}
// Add new ITEM
const addNewItem = (modalId) => {
    checkFields(modalId);

    const formData = new FormData();

    formData.append('image', document.getElementById('aTImgInp').files[0]);
    formData.append('name', document.getElementById('aINameInp').value);
    formData.append('category', document.getElementById('aICSInp').value);
    formData.append('price', document.getElementById('aIPriceInp').value);
    formData.append('status', document.getElementById('aIStatusSelect').value);
    formData.append('description', document.getElementById('aIDescInp').value);
    // console.log(document.getElementById('aTImgInp').files[0].name);

    $.ajax({
        url: 'b_add_item.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false, // Let the browser set multipart/form-data
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                alert(response.message);
                window.location.reload();
                // Optional: close modal or reset form
            } else {
                alert(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error(error);
            console.error(xhr.responseText);
            alert('An error occurred while adding the item.');
        }
    });
};
// number validation
const numInputs = document.querySelectorAll('.me_only_num');
numInputs.forEach(input => {
    input.addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9.]/g, '');
        const parts = this.value.split('.');
        if (parts.length > 2) {
            this.value = parts[0] + '.' + parts.slice(1).join('');
        }
    });
});

const max_inputs = document.querySelectorAll('.me_max');
max_inputs.forEach(input => {
    input.addEventListener('input', function () {
        const max = parseInt(this.dataset.max, 10);
        this.value = this.value.slice(0, max);
        const counter = document.getElementById('remLetDe');
        if (counter) {
            counter.textContent = `${this.value.length}/${max}`;
        }
    });
});

// loading categories while inputing
document.getElementById('aICSInp').addEventListener('input', () => {
    const dropDown = document.getElementById('aICDrop');
    const search = $('#aICSInp').val();
    $.ajax({
        url: 'b_category_list.php',
        type: 'POST',
        data: {
            search: search
        },
        dataType: "json",
        success: function (response) {
            let html = '';
            if (response.success) {
                const data = response.data;
                data.forEach(category => {
                    html += `
                            <button onclick='enterVal(this)' class="text-white px-4 py-2 border-b-1 w-full text-start outline-none hover:bg-[#15161640] focus:bg-[#15161640]">${category.name}</button>
                        `
                });
            } else {
                html += `
                    <option value="all" selected >Not Found</option>
                    `
            }
            dropDown.innerHTML = html;
            dropDown.classList.replace('hidden', 'flex');
        }
    })
})

// Enter value 
function enterVal(e) {
    document.getElementById("aICSInp").value = e.innerHTML;
    document.getElementById('aICDrop').classList.replace('flex', 'hidden');
}

// edit menu item modal 
function editItem(item_id) {
    const id = item_id;

    $.ajax({
        url: 'b_get_item.php',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                const data = response.data;
                console.log(data[0]);
                $("#ITEMID").val(data[0].id);
                $("#EditINameInp").val(data[0].food_name);
                $("#EditICSInp").val(data[0].category_name);
                $("#EditIPriceInp").val(data[0].price);
                $("#EditIStatusSelect").val(data[0].status);
                $("#EditIDescInp").val(data[0].description);
                $('#editItemModal').removeClass('hidden').addClass('flex');
            } else {
                alert('Server Error!');
            }
        }
    });
}
const editNewItem = (modalId) => {
    checkFields(modalId);

    const formData = new FormData();

    // Item ID
    formData.append('id', document.getElementById('ITEMID').value);

    // Only send image if selected
    const imageInput = document.getElementById('EditTImgInp');
    if (imageInput.files.length > 0) {
        formData.append('image', imageInput.files[0]);
    }

    // Other data
    formData.append('name', document.getElementById('EditINameInp').value);
    formData.append('category', document.getElementById('EditICSInp').value);
    formData.append('price', document.getElementById('EditIPriceInp').value);
    formData.append('status', document.getElementById('EditIStatusSelect').value);
    formData.append('description', document.getElementById('EditIDescInp').value);

    $.ajax({
        url: 'b_edit_item.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',

        success: function (response) {
            if (response.success) {
                alert(response.message);
                window.location.reload();
            } else {
                alert(response.message);
            }
        },

        error: function (xhr) {
            console.log(xhr.responseText);
            alert('Something went wrong.');
        }
    });
};