import $ from 'jquery';
$(document).ready(function() {
    $(document).on('click', '#createcategory', function(event) {
        event.stopPropagation();
        $('.Modal').show();
    });

    $('#closeModal').on('click' , function(event) {
        event.stopPropagation();
        $('.Modal').hide();
    });

    $(' #submitcategory ').on('click', function(event) {
        event.stopPropagation();

        let category = $('#catname').val();

        $.ajax({
            type: 'POST',
            url: '/admin/category',
            data: {
                name: category,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('.Modal').hide();
                const dataRow =
                    `<tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${response.category.id}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${response.category.name}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="/admin/category/${response.category.id}/edit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">Edit</a>
                        </td>
                    </tr>`;

                $('#categoryTable').append(dataRow);
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
});
