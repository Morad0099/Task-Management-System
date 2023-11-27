<x-app-layout>
    @include('partials.sidebar')
    <x-header>
    </x-header>
    <div class="container">
    <h1 style="text-align: center">YOUR TASKS</h1>
    <table width="100%"
    class="table table-bordered table-sm table-striped table-hover dataTable js-exportable"
    id="">
    <thead class="thead-light"> <!-- Bootstrap dark theme for thead -->
        <tr>
            <th style="width: 40%;">Task</th> <!-- Adjusted column width for "Task" -->
            <th style="width: 20%;">Due Date</th> <!-- Adjusted column width for "Due Date" -->
            <th style="width: 20%;">Status</th> <!-- Adjusted column width for "Status" -->
            <th style="width: 20%;">Action</th> <!-- Adjusted column width for "Action" -->
        </tr>
    </thead>
    <tbody>
        <!-- Data is fetched here using ajax -->
    </tbody>
</table>
    <x-footer>
    </x-footer>
</x-app-layout>

