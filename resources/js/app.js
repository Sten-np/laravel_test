import $ from 'jquery';

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
            url: '/admin/product/' + prodId,
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
            url: '/admin/product',
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

    // Show and edit product request and modal.

    $(document).on('click', '#showandeditproduct', function () {
        const prodId = $(this).data('prod-id');
        $.ajax({
            type: 'GET',
            url: `/admin/product/${prodId}`, // Assuming there's an endpoint to fetch product details
            success: function (response) {
                populateEditModal(response.product); // Populate modal with product data
                $('#showModal').show(); // Show the modal
            },
            error: function () {
                console.log('Error fetching product details');
            }
        });
    });

    function populateEditModal(product) {

    }


    $(document).on('click', '#editprod', function (event) {
        event.preventDefault(); // Prevent default form submission if any
        let prodId = $(this).data('prod-id');
        console.log(prodId);

        // Validate input fields here if needed

        $.ajax({
            type: 'PATCH',
            url: '/admin/product/' + prodId,
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



    // Cart request and modal.

    function updateCartCount() {
        $.ajax({
            type: 'GET',
            url: '/cart/count',
            success: function (data) {
                $(' #cartCount ').text(data.count.toString());
            },
            error: function (data) {
                console.log('Error updating cart count!');
            }
        })
    }

    function updateCartPrice() {
        $.ajax({
            type: 'GET',
            url: '/cart/price',
            success: function (data) {
                $(' #totalWithTax ').text(data.totalWithTax.toString());
                $(' #subtotal ').text(data.subtotal.toString());
            },
            error: function (data) {
                console.log('Error updating cart price!');
            }
        })
    }


    $(document).on('click', '.addToCart', function () {
        // Find the corresponding product ID based on its context in the DOM
        let productId = $(this).data('prod-id')
        // $(' .addToCart ').data('prod-id')

        $.ajax({
            type: 'POST',
            // Use a relative URL and pass the product ID as data
            url: '/cart/add',
            data: {
                id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                console.log('Product added to cart!');
                $('#message').html('<br><div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">\n' +
                    '                    <strong class="font-bold">Product added to cart!</strong>\n' +
                    '                </div><br>');

                // Update the cart count in the header
                updateCartCount();


                setTimeout(function () {
                    $('#message').html('');
                }, 5000);
            },
            error: function (data) {
                console.log('Error adding product to cart!');
            }
        });
    });


    $(document).on('click', '.removeItem', function () {
        // Find the corresponding product ID based on its context in the DOM
        let productId = $(this).data('prod-id');

        $.ajax({
            type: 'DELETE',
            url: '/cart/remove/' + productId,
            data: {
                id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $(`div[data-prod-id="${productId}"]`).remove();
                // Update the cart count in the header
                updateCartCount();
                updateCartPrice();
            },
            error: function (data) {
                console.log('Error removing product from cart!');
            }
        });
    });


    function generatePDFAndDownload() {
        $.ajax({
            type: 'GET',
            url: '/cart/checkout', // Endpoint to generate PDF
            success: function (data) {
                // No need to create a Blob or URL
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(data); // Create temporary URL for streamed content
                link.download = 'cart_invoice.pdf';
                link.click();
                // No need to remove or revoke URL as data is streamed
            },
            error: function () {
                console.log('Error generating PDF!');
            }
        });
    }

    $(document).on('click', '#checkout', function () {
        generatePDFAndDownload();
    });

});
