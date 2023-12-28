<div class="container mt-5">
    <h2>Create a New Task</h2>
    <form method="post" id="task-form">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending"><----></option>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
            </select>
        </div>
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

        <div class="form-group">
            <label for="due_date">Due Date:</label>
            <input type="date" class="form-control" id="due_date" name="due_date" required>
        </div>
        <div class="form-group">
            <label for="rate">Rate:</label>
            <input type="number" class="form-control" id="rate" name="rate" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary" onclick="submitForm()">Submit</button>
    </form>
</div>