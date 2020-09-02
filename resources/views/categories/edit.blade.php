
<div class="col-md-12" style="background: #fff; margin-top: 10px; margin-bottom: 20px; padding: 25px; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.4);">
    <form action="{{ route('categories.update', $category->id) }}" method="post">
        <div class="form-group">
            {{ method_field('patch') }}
            <label for="title">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}">
        </div>
        <button class="btn btn-primary" type="submit">Update Category</button>
        {{ csrf_field() }}
    </form>
</div>