
<div class="col-md-12" style="background: #fff; margin-top: 10px; margin-bottom: 20px; padding: 25px; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.4);">
    <form action="{{ route('categories.store') }}" method="post">
        <div class="form-group">
            <label for="title">Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <button class="btn btn-primary" type="submit">Add Category</button>
        {{ csrf_field() }}
    </form>
</div>