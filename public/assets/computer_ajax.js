$(document).ready(function (){

    $(document).on('click', '.addNewRecord', function(){
        $('#computerForm')[0].reset();
        $('#computerModal').modal('show');
        $('#modalTitleId').text('Add New Record');
    });//add-new-record

    function fetchComputers()
    {
        $.ajax({
            type: "GET",
            url: "computers/fetch",
            dataType: "json",
            success: function (response) {
                dataArrays = response;
                var tableBody = '';

                dataArrays.forEach(function (data, index) {
                    // console.log(data.id);
                    tableBody += '<tr>';
                    tableBody += '<td><input type="checkbox" id="checkbox_' + data.id + '" name="checkBox_id[]" data-id="' + data.id + '"/></td>';
                    tableBody += '<td>' + ++index + '</td>'; // Add index number
                    tableBody += '<td>' + data.name + '</td>';
                    tableBody += '<td>' + data.model + '</td>';
                    tableBody +=
                        '<td>' +
                        '<button class="btn btn-warning mb-2 ms-2 px-5 editRecord" data-id="' + data.id + '">Edit</button>' +
                        // '<button class="btn btn-danger mb-2 ms-2 deleteRecord" data-id="' + data.id + '">Delete</button>' +
                        '</td>';
                    tableBody += '</tr>';
                });

                $('#computers').html(tableBody);
            }

        });
    }//fetchComputers function

    fetchComputers();

    // $(document).on('click', '.btn-danger', function (e){
    //     e.preventDefault();
    //     var id = $(this).data('id');
    //     $.ajax({
    //         type: "GET",
    //         url: "computer/destroy/" + id,
    //         data: id,
    //         dataType: "json",
    //         success: function (response) {
    //             toastr.success(response.message);
    //             fetchComputers();
    //         }
    //     });
    // })//on delete button;

    $(document).on('click', '.btn-warning', function (e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "computer/edit/",
            data: {id: id},
            beforeSend: function() {
                $('.saveData').prop('disabled', true);
                $('.saveData').text('Updating...');
            },
            success: function (response) {
                if(response){
                    $('#computerForm')[0].reset();
                    $('#computerModal').modal('show');
                    $('#modalTitleId').text('Update Record');
                    $('.saveData').text('Update'); // Update the text of the correct button class
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#model').val(response.model);
                    fetchComputers();
                }
            },
            complete: function() {
                $('.saveData').prop('disabled', false);
                $('.saveData').text('Update');
            }
        });
    });//edit button

     // Form submit event for adding or updating a record
     $('#computerForm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: "computer/store",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('.saveData').prop('disabled', true);
                $('.saveData').text('Saving...');
            },
            success: function (response) {
                console.log(response);
                if (response) {
                    console.log(response)
                    $('#computerModal').modal('hide');
                    if(response.created)
                    {
                        toastr.success(response.created);
                    }else{
                        toastr.success(response.updated);

                    }

                    fetchComputers();
                }
            },
            error: function (error) {
                // Handle any errors here
                console.error(error);
            },
            complete: function () {
                $('.saveData').prop('disabled', false);
                $('.saveData').text('Save');
            }
        });
    });


    // $(document).on('change', 'input[name="checkBox_id[]"]', function () {
    //     var checkedCheckboxes = $('input[name="checkBox_id[]"]:checked');
    //     if (checkedCheckboxes.length > 0) {
    //         $('.deleteButton').show();
    //     } else {
    //         $('.deleteButton').hide();
    //     }
    // });

    // $('#selectAll').change(function () {
    //     $('input[name="checkBox_id[]"]').prop('checked', $(this).prop('checked'));
    // });


    // $(document).on('change', 'input[name="checkBox_id[]"]', function () {
    //     if (!$(this).prop('checked')) {
    //         $('#selectAll').prop('checked', false);
    //     }
    // });

    $(document).on('change', 'input[name="checkBox_id[]"]', function () {
        var checkedCheckboxes = $('input[name="checkBox_id[]"]:checked');

        $('.deleteButton').toggle(checkedCheckboxes.length > 0);

        if (!$(this).prop('checked')) {
            $('#selectAll').prop('checked', false);
        }
    });


    $('#selectAll').change(function () {
        $('input[name="checkBox_id[]"]').prop('checked', $(this).prop('checked'));
        $('.deleteButton').toggle($(this).prop('checked'));
    });


    $('.deleteButton').on('click', function () {
        var checkedIds = $('input[name="checkBox_id[]"]:checked').map(function () {
            return $(this).data('id');
        }).get();
        console.log("Delete IDs: ", checkedIds);
        if(confirm('Are you sure you want to delete ? ')){
            $.ajax({
                type: "POST",
                url: "computer/destroy",
                data: {checkedIds:checkedIds},
                success: function (response) {
                    toastr.success(response.message);
                    $('.deleteButton').hide();
                    $('#selectAll').prop('checked', false);
                    fetchComputers();
                }
            });
        }
    });


    $('#selectAll').prop('checked', false);
});//main
