<x-app-layout>
    @include('partials.sidebar')
    <x-header>
    </x-header>
    <x-mainPage>
    </x-mainPage>
    <x-footer>
    </x-footer>
    <script>
       
        var formData = document.getElementById("task-form");

        $(formData).submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure you want to make a task?',
                text: "Or click cancel to abort!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit'
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        text: "Adding task, please wait...",
                        showConfirmButton: false,
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    });

                    // Collect form data
                    var formData = new FormData(document.getElementById("task-form"));

                    $.ajax({
                            type: 'POST',
                            url: '{{ route('create') }}',
                            data: formData,
                            contentType: false,
                            processData: false,
                        })
                        .done(function(data) {
                            Swal.fire({
                                text: data.msg,
                                type: data.ok ? "success" : "error"
                            });

                            if (data.ok) {
                                // Reset the form after successful submission
                                formData.reset();
                            }
                        })
                        .fail(function(err) {
                            console.error(err);
                            Swal.fire({
                                text: "Adding failed",
                                type: "error"
                            });
                        });
                }
            });
        });
        
    </script>

</x-app-layout>
