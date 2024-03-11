$(document).ready(function () {

    // Delete product request and modal.

    $(document).on('click', '#delete', function () {
        const prodId = $(this).data('prod-id');
        $('#confirmModal').show(); // Show the modal
        $('#confirmDelete').data('prod-id', prodId); // Set product ID as data attribute for confirmation button
    });

    // Hide modal when close button or background is clicked
    $('.modal .close, .modal').click(function () {
        $('#confirmModal').hide();
    });

    // Prevent modal from closing when clicking inside modal content
    $('.modal-content').click(function (event) {
        event.stopPropagation();
    });

    $('#confirmDelete').click(function () {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const prodId = $(this).data('prod-id');
        $.ajax({
            type: 'DELETE',
            url: '/admin/products/' + prodId,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function () {
                $(`tr[data-prod-id="${prodId}"]`).remove();
                $('#confirmModal').hide();
            },
            error: function () {
                console.log('Error deleting product');
            }
        });
    });

    // Create product request and modal.

    $(document).on('click', '#createprod', function () {
        $('#createModal').show();
    });


    $(' #closeModal ').click(function () {
        $('#createModal').hide();
    });

    $(' #createsubmit ').click(function () {
        $.ajax({
            type: 'POST',
            url: '/admin/products',
            data: {
                name: $('#name').val(),
                description: $('#description').val(),
                price: $('#price').val(),
                image: $('#image').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                const product = response.product;
                console.log(product);
                const newRow = `
                <tr data-prod-id="${product.id}">
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${product.id}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${product.name}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${product.image}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${product.description}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">&euro; ${product.latest_price.price}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <button id="showandeditproduct" data-prod-id="{{ $product->id }}">
                        Details and Edit
                        </button>
                        <button id="delete" data-prod-id="${product.id}" class="text-red-500 hover:text-red-800">Delete</button>
                    </td>
                </tr>`;
                $('tbody').append(newRow); // Append the newly created product row to the table
                $('#createModal').hide();

                $.getScript('/admin/products/modals/create');
                $.getScript('/admin/products/modals/delete');
                $.getScript('/admin/products/modals/showandedit');
            },
            error: function () {
                console.log('Error creating product');
            }
        });
    });

    // Edit product request and modal.

    $(document).on('click', '#showandeditproduct', function () {
        $('#showModal').show();
    });

    $(document).on('click', '#editprod', function (event) {
        event.preventDefault(); // Prevent default form submission if any
        let prodId = $(this).data('prod-id');
        console.log(prodId);

        // Validate input fields here if needed

        $.ajax({
            type: 'PATCH',
            url: '/admin/products/' + prodId,
            data: {
                name: $('#name').val(),
                description: $('#description').val(),
                price: $('#price').val(),
                image: $('#image').val(),
                visibility: $('#visibility').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                const product = response.product;
                console.log(product);
                // Update the product row in the table with the new data
                const updatedRow = `
                <tr data-prod-id="${product.id}">
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${product.id}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${product.name}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${product.image}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${product.description}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">&euro; ${product.latest_price.price}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('products.show', ${product.id}) }}" class="text-blue-500 hover:text-blue-800">View</a>
                        <a href="{{ route('products.edit', ${product.id}) }}" class="text-blue-500 hover:text-blue-800">Edit</a>
                        <button id="delete" data-prod-id="${product.id}" class="text-red-500 hover:text-red-800">Delete</button>
                    </td>
                </tr>`;
                $(`tr[data-prod-id="${prodId}"]`).replaceWith(updatedRow); // Replace the existing row with the updated one
                $('#showModal').hide(); // Hide the modal after successful update
            },
            error: function () {
                console.log('Error updating product');
                // Display error message to the user
            }
        });
    });


    $(' #closeShowModal ').click(function () {
        $('#showModal').hide();
    });
});
