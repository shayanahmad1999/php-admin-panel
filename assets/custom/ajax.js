function submitForm(form) {
    let url = $(form).attr('action');
    let data = $(form).serialize();

    $.ajax({
        method: 'POST',
        url: url,
        data: data,
        dataType: 'json',
        success: function (res) {
            if (res.status === 'success') {
                console.log(res);
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Record added successfully.',
                    showConfirmButton: false,
                    timer: 2000
                });
                $('#datarecords').find('table tbody').prepend(res.data);
                form.reset();
            } else if (res.status === 'update') {
                console.log(res);
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Record updated successfully.',
                    showConfirmButton: false,
                    timer: 2000
                });
                form.reset();
                $('table tbody').find('button[data-id="' + res.id + '"]').closest('tr').replaceWith(res.data);
            } else if (res.status === 'error') {
                // Display validation errors or other errors
                console.error('Validation errors:', res.data);
                // Example: Display error messages in your form
                $('#nameerror').html(res.data.name);
                $('#priceerror').html(res.data.price);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX error:', error);
            // Handle AJAX errors (e.g., network issues)
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong! Please try again later.',
                showConfirmButton: false,
                timer: 3000
            });
        }
    });
}

function statusChange(url, id) {
    $.ajax({
        method: 'GET',
        url: url,
        dataType: 'json',
        success: function (res) {
            console.log(res);
            $('#datarecords').find('a[data-id="' + id + '"]').replaceWith(res.status);
        },
        error: function (xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });
}

function ajaxLoad(url, id) {
    $.ajax({
        type: "GET",
        url: url,
        data: {
            id: id
        },
        dataType: 'json',
        success: function (res) {
            if (res.status === 'success') {
                $('table tbody').find('button[data-id="' + id + '"]').closest('tr').remove();
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Record deleted successfully.',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if (res.status === 'edit') {
                if (res.data) {
                    $.each(res.data, function (key, value) {
                        var sanitizedValue = $('<div>').text(value).html();
                        $('#' + key).val(sanitizedValue);
                    });
                } else {
                    alert("User data not found.");
                }
                $('input[name="update_key"]').val(id);
            } else {
                Swal.fire('Error!', res.status, 'error');
            }
        },
        error: function (xhr, status, error) {
            Swal.fire('Error!', 'An error occurred while processing your request.', 'error');
        }
    });
}
