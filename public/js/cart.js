$(document).ready(function () {

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
            url: '/cart/remove/'+ productId,
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
