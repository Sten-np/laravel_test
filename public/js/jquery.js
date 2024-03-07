$(document).ready(function () {
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

    $(document).on('click', '#createprod', function () {
        $('#createModal').show();
    });

    // Hide modal when close button or background is clicked

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
                category: $('#category').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                const product = response.product;
                const newRow = `
                <tr data-prod-id="${product.id}">
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${product.id}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${product.name}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${product.image}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${product.description}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">&euro; ${product.latest_price.price}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <form method="post" action="{{ route('products.update', ['product' => $product->id]) }}">
                            @csrf
                            @method('PUT')
                            <input type="checkbox" name="visibility" id="visibility" value="0" ${product.visibility ? 'checked' : ''}>
                        </form>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('products.show', ${product.id}) }}" class="text-blue-500 hover:text-blue-800">View</a>
                        <a href="{{ route('products.edit', ${product.id}) }}" class="text-blue-500 hover:text-blue-800">Edit</a>
                        <button id="delete" data-prod-id="${product.id}" class="text-red-500 hover:text-red-800">Delete</button>
                    </td>
                </tr>`;
                $('tbody').append(newRow); // Append the newly created product row to the table
                $('#createModal').hide(); // Hide the modal
            },
            error: function () {
                console.log('Error creating product');
            }
        });
    });


});
