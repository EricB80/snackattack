$(document).ready(function () {

    /**
     * force token to be sent with all AJAX requests
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    /**
     * Load the information for full snack details
     * @param {type} snackId
     * @returns {jqXHR}
     */
    function getSnackDetails(snackId) {
        return $.ajax({
            url: 'snacks/getSnack',
            method: 'GET',
            data: {snack: snackId}
        });
    }

    /**
     * Updates the edit fields with values
     * @param {JSON} data
     * @returns {undefined}
     */
    function updateEditFields(data) {
        $('#editLabel').html(data.snack_name);
        $('#editName').val(data.snack_name);
        $('#editQty').val(data.pieces);
        $('#editDesc').val(data.description);
        $('#editId').val(data.id);
    }

    /**
     * Show editor modal
     * @returns {null}
     */
    function showEditor() {
        $('#editModal').modal('show');
    }

    /**
     * Send the POST request to add/update a snack for the logged in user
     * @param {obj} snack a snack data
     * @returns {NULL} renders HTML on page
     */
    function saveSnack(data) {
        return $.ajax({
            url: 'snacks/addSnack',
            method: 'POST',
            data: data,
            success: function (data) {
                var table = buildTable(data);
                $('#listHolder').html(table);
            },
            error: function (data) {
                window.showErrors(data.responseJSON);
            }
        });
    }

    /**
     * Clear the New Snack fields
     * @returns {null}
     */
    function clearForm() {
        $('#snackName').val('');
        $('#snackQty').val('');
    }

    /**
     * Promise interface to load snacks for user
     * @returns {jqXHR}
     */
    function loadUserSnacks() {
        return $.ajax({
            url: '/snacks/getSnackData',
            method: 'GET'
        });
    }

    /**
     * Build the snacklist table
     * @param {array} data  array of JSON returned from server
     * @returns {String}    HTML string of snack list table
     */
    function buildTable(data) {
        var table = '<table class="table table-striped"><thead><tr><th>Snack Name</th><th>Pcs</th><th>Desc.</th><th>Edit</th><th>Delete</th>';
        table += '<tbody>';
        $.each(data, function (idx, elem) {
            table += '<tr data-snack-id ="' + elem.id + '">';
            table += '<td>' + elem.snack_name + '</td>';
            table += '<td>' + elem.pieces + '</td>';
            table += '<td><span class="small">' + elem.description + '</span></td>';
            table += '<td><button class="snackEditor btn btn-success">Edit</button></td>';
            table += '<td><button class="snackDeleter btn btn-danger">Delete</button></td>';
            table += '</tr>';
        });
        table += '</tbody></table>';
        return table;
    }

    /**
     * wrapper function to build the list
     * @returns {NULL}  see functions called by this method
     */
    function buildList() {
        var snacks = loadUserSnacks().done(
                function (data) {
                    var table = buildTable(data);
                    $('#listHolder').html(table);
                });
    }


    /**
     * Event Listeners below here
     */

    /**
     * initial load functions
     */
    buildList();

    //save button listener
    $('#saveSnack').click(function () {
        var name = $('#snackName').val();
        var pcs = $('#snackQty').val();
        var newSnack = {name: name, quantity: pcs};
        saveSnack(newSnack)
                .done(function (data) {
                    var table = buildTable(data);
                    $('#listHolder').html(table);
                })
                .fail(function (data) {
                    window.showErrors(data.responseJSON);
                });
    });

    //listener for edit button
    $(document.body).on('click', '.snackEditor', function () {
        var snackId = $(this).parents('tr').attr('data-snack-id');
        var snackDetails = getSnackDetails(snackId)
                .done(function (data) {
                    updateEditFields(data);
                    showEditor();
                })
                .fail(function (data) {
                    window.showErrors(data.responseJSON);
                });
    });

    //listener for save changes button
    $(document.body).on('click', '#saveChanges', function () {
        var id = $('#editId').val();
        var name = $('#editName').val();
        var desc = $('#editDesc').val();
        var qty = $('#editQty').val();
        var changeSnack = {id: id, name: name, quantity: qty, description: desc};
        console.log(changeSnack);
        saveSnack(changeSnack)
                .done(function (data) {
                    var table = buildTable(data);
                    $('#listHolder').html(table);
                })
                .fail(function (data) {
                    window.showErrors(data.responseJSON);
                });
    });

});