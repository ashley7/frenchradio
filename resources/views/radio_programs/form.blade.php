<div class="mb-3">

    <label class="form-label">Title</label>

    <input type="text"
           name="title"
           class="form-control"
           value="{{ old('title',$program->title ?? '') }}"
           required>

</div>


<div class="mb-3">

    <label>Description</label>

    <textarea name="description"
              class="form-control"
              rows="4"
              required>{{ old('description',$program->description ?? '') }}</textarea>

</div>
 

<div class="mb-3">

    <label>Start Time</label>

    <input type="datetime-local"
           name="start_time"
           class="form-control"
           value="{{ old('start_time',$program->start_time ?? '') }}">

</div>

<div class="mb-3">

    <label>End Time</label>

    <input type="datetime-local"
           name="end_time"
           class="form-control"
           value="{{ old('end_time',$program->end_time ?? '') }}">

</div>


<div class="mb-3">

    <label>Stream URL</label>

    <input type="text"
           name="stream_url"
           class="form-control"
           value="{{ old('stream_url',$program->stream_url ?? '') }}">

</div>


<div class="mb-3">

    <label>Recorded File</label>

    <input type="file"
           name="recorded_file"
           class="form-control">

</div>

 