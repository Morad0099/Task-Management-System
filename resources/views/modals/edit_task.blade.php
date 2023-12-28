<div class="modal fade" id="edit-cat-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Description</h5>
                <a href="#"><span class="close text-white" data-dismiss="modal" aria-label="Close"
                        aria-hidden="false">×</span></a>
            </div>
            <div class="modal-body">
                <form id="edit-task-form">
                    @csrf
                    <div class="form-group">
                        <input type="text" id="edit-cat-id" name="id" required hidden>
                        <label for="edit-cat-exp">Description</label>
                        <input type="text" name="desc" id="edit-cat-exp" placeholder="" class="form-control"
                            required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light btn-sm rounded" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-light btn-sm rounded" form="edit-task-form" type="reset">Reset</button>
                <button class="btn btn-primary btn-sm rounded" form="edit-task-form" type="submit" name="submit"> <i
                        class=""></i> Submit</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Construct the full URL using the route name
    const editTaskUrl = '/api/edit';
    var editTaskForm = document.getElementById("edit-task-form")
    $(editTaskForm).submit(function(e) {
        e.preventDefault();

        // After checking the required inputs are not empty and is valid the form is then submitted
        var formdata = new FormData(editTaskForm)
        Swal.fire({
            title: 'Are you sure you want to update task?',
            text: "Or click cancel to abort!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Submit'
        }).then((result) => {

            if (result.value) {
                Swal.fire({
                    text: "Updating please wait...",
                    showConfirmButton: false,
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });

                fetch(editTaskUrl, {
                    method: "POST",
                    body: formdata,
                    headers: {
                        "Authorization": "d16xA0oqWRi2barEd1Ru3JVM3uveym6nw2ntVsfSUl0kf8T5XNVhSykpoqswweeJI7OjiYTc1rtkDTKE",
                    }
                }).then(function(res) {
                    // Check the HTTP status code
                    if (!res.ok) {
                        throw new Error(`HTTP error! Status: ${res.status}`);
                    }

                    return res.json();
                }).then(function(data) {
                    // Assuming your JSON response contains a property named "success"
                    if (!data.success) {
                        Swal.fire({
                            text: data.msg || "Task update failed",
                            type: "success"
                        });
                        return;
                    }

                    Swal.fire({
                        text: "Task updated successfully",
                        type: "error"
                    });
                    $("#edit-cat-modal").modal('hide');
                    $("select").val(null).trigger('change');
                    requisitionCatTable.ajax.reload(null, false);
                    editCatForm.reset();

                }).catch(function(err) {
                    Swal.fire({
                        text: "Updating failed"
                    });
                });
            }
        });
    });
</script>
