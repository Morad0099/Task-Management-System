<x-app-layout>
    @include('partials.sidebar')
    <x-header>
    </x-header>
    <x-mainPage>
    </x-mainPage>
    <x-footer>
    </x-footer>
    <script>
        function submitForm() {
            var formData;
            //Fetch the UserId from the backend
            $.ajax({
                type: "GET",
                url: '/api/fetchUserID',
                dataType: 'json',
                success: function(user) {
                    // Now that you have the user ID, set the hidden input value
                    $('#user_id').val(user.id);

                    // Now that you have the user ID, proceed with the AJAX request
                        formData = {
                        user_id: $('#user_id').val(), // Assuming the user ID is available in the response
                        title: $('#title').val(),
                        description: $('#description').val(),
                        status: $('#status').val(),
                        due_date: $('#due_date').val(),
                        rate: $('#rate').val()
                    };
                    //Send AJAX Request
                    $.ajax({
                        type: 'POST',
                        url: '/api/create',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            //Handle Success Response
                            
                            console.log(response);
                            alert('Task created successfully')
                        },
                        error: function(error) {
                            //Handle Error Response
                            console.error(error);
                            alert('Failed adding task')
                        },
                    });
                },
                error: function (error) {
                    console.error(error);
                    alert('Failed fetching user id')
                }
            });
        }
    </script>
    
</x-app-layout>
