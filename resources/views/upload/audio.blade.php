
<div class="container">
    <h2>Upload Audio</h2>
    <form action="{{ route('audios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="file">Audio File:</label>
            <input type="file" class="form-control" id="file" name="file" accept="audio/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload Audio</button>
    </form>
</div>

