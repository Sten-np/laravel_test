$(document).ready(function () {
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
            // Use a relative URL and pass the product ID as data
            url: '/cart/remove/' + productId,
            data: {
                id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },

            success: function (data) {
                console.log('Product removed from cart!');
                $('#message').html('<br><div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">\n' +
                    '                    <strong class="font-bold">Product removed from cart!</strong>\n' +
                    '                </div><br>');

                $(' .items ').remove();

                // Update the cart count in the header
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

                setTimeout(function () {
                    $('#message').html('');
                }, 5000);
            },
            error: function (data) {
                console.log('Error removing product from cart!');
            }
        });
    });
});
