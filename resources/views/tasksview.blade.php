<x-app-layout>
    @include('partials.sidebar')
    <x-header>
    </x-header>
    <div class="container">
        <nav>
            <h4 style="text-align: center">YOUR TASKS</h4>
        </nav>

        <div class="row mt-4 justify-content-center">

            <table width="100%" class="table table-bordered table-sm table-striped table-hover dataTable js-exportable"
                id="">
                <thead class="thead-light"> <!-- Bootstrap dark theme for thead -->
                    <tr>
                        <th style="background-color: #1E90FF; color: white;">Task</th>
                        <!-- Adjusted column width for "Task" -->
                        <th style="background-color: #1E90FF; color: white;">Description</th>
                        <!-- Adjusted column width for "Task" -->
                        <th style="background-color: #1E90FF; color: white;">Due Date</th>
                        <!-- Adjusted column width for "Due Date" -->
                        <th style="background-color: #1E90FF; color: white;">Status</th>
                        <!-- Adjusted column width for "Status" -->
                        <th style="background-color: #1E90FF; color: white;">Action</th>
                        <!-- Adjusted column width for "Action" -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($task as $item)
                        <tr>
                            <td>{{ $item->title ?? 'null' }}</td>
                            <td>{{ $item->description ?? 'null' }}</td>
                            <td>
                                <span id="dueDate{{ $item->id }}">{{ $item->due_date ?? 'null' }}</span>
                                <span id="countdown{{ $item->id }}" style="color: red; margin-left:150px"></span>
                            </td>
                            <td>{{ $item->status ?? 'null' }}</td>
                            <td>
                                <!-- Edit Button -->
                                <button class='btn btn-sm btn-outline-success rounded edit-req-btn'
                                    data-title="{{ $item->title }}" data-description="{{ $item->description }}"
                                    data-due_date="{{ $item->due_date }}" data-rate="{{ $item->rate }}"
                                    data-status="{{ $item->status }}" data-id="{{ $item->id }}">
                                    <i class='fas fa-edit'></i>
                                </button>

                                <!-- Delete Button -->
                                <button class='btn btn-sm btn-outline-danger rounded delete-req-btn'
                                    data-title="{{ $item->title }}" data-description="{{ $item->description }}"
                                    data-due_date="{{ $item->due_date }}" data-rate="{{ $item->rate }}"
                                    data-status="{{ $item->status }}" data-id="{{ $item->id }}">
                                    <i class='fas fa-trash'></i>
                                </button>

                                <!-- Completion button -->
                                <button class='btn btn-sm btn-outline-success rounded complete-req-btn'
                                    data-title="{{ $item->title }}" data-description="{{ $item->description }}"
                                    data-due_date="{{ $item->due_date }}" data-rate="{{ $item->rate }}"
                                    data-status="{{ $item->status }}" data-id="{{ $item->id }}">
                                    <i class='fas fa-check'></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No tasks found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @include('modals.edit_task')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @forelse($task as $item)
                    setupTimer("{{ $item->id }}", "{{ $item->due_date ?? 'null' }}");
                @empty
                    // Handle case where there are no tasks
                @endforelse

                function setupTimer(itemID, dueDateStr) {
                    var dueDate = new Date(dueDateStr);
                    var dueDateSpan = document.getElementById("dueDate" + itemID);
                    var countdownSpan = document.getElementById("countdown" + itemID);

                    function updateTimer() {
                        var now = new Date();
                        var timeDifference = dueDate - now;

                        if (timeDifference > 0) {
                            var days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                            var timerString = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                            countdownSpan.innerHTML = `<span style="color: green;">${timerString}</span>`;
                        } else {
                            countdownSpan.innerHTML = '<span style="color: red;">Time expired</span>';
                        }
                    }

                    // Update the timer every second
                    setInterval(updateTimer, 1000);

                    // Initial update
                    updateTimer();
                }
            });



            $(document).ready(function() {
                $(".edit-req-btn").click(function() {
                    var title = $(this).data("title");
                    var description = $(this).data("description");
                    var due_date = $(this).data("due_date");
                    var rate = $(this).data("rate");
                    var status = $(this).data("status");
                    var id = $(this).data("id");


                    console.log("Description:", description);

                    // Set values in the modal fields
                    $("#edit-cat-exp").val(description);
                    // Set values for other fields as needed
                    $("#edit-cat-id").val(id);

                    // Assuming the edit modal has the ID "edit-cat-modal"
                    $("#edit-cat-modal").modal("show");
                });
            });

            //Delete expense
            $(document).ready(function() {
                $(".delete-req-btn").click(function() {
                    var title = $(this).data("title");
                    var description = $(this).data("description");
                    var due_date = $(this).data("due_date");
                    var rate = $(this).data("rate");
                    var status = $(this).data("status");
                    var id = $(this).data("id");

                    console.log('id:', id);

                    // Ensure id is captured correctly before constructing the URL
                    const deleteTaskUrl = `/api/delete/${id}`;

                    Swal.fire({
                        title: "Are you sure you want to delete request?",
                        text: "Or you can click cancel to abort!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Delete"
                    }).then((result) => {
                        if (result.value) {
                            Swal.fire({
                                text: "Deleting please wait...",
                                showConfirmButton: false,
                                allowEscapeKey: false,
                                allowOutsideClick: false
                            });
                            $.ajax({
                                url: deleteTaskUrl,
                                type: "POST",
                            }).done(function(data) {
                                if (!data.ok) {
                                    Swal.fire({
                                        text: data.msg,
                                        type: "error"
                                    });
                                    return;
                                }
                                Swal.fire({
                                    text: "Deleted successfully",
                                    type: "success"
                                });
                                // requisitionTable.ajax.reload(null, false);

                            }).fail(() => {
                                alert('Processing failed');
                            });
                        }
                    });
                });
            });
        </script>
        <x-footer>
        </x-footer>
</x-app-layout>
