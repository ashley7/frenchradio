    <div class="mb-3">

        <label>Program</label>

        <select name="radio_program_id"
        class="form-control">

        <option value="">--Select radio program --</option>

        @foreach($programs as $id => $name)

            <option value="{{ $id }}"
            {{ old('radio_program_id',$lesson->radio_program_id ?? '') == $id ? 'selected' : '' }}>

            {{ $name }}

            </option>

        @endforeach

        </select>

    </div>


    <div class="mb-3">

        <label>Title</label>

        <input type="text"
        name="title"
        class="form-control"
        value="{{ old('title',$lesson->title ?? '') }}">

    </div>


    <div class="mb-3">

        <label>Learning Objectives</label>

        <textarea name="learning_objectives"
        class="form-control">

        {{ old('learning_objectives',$lesson->learning_objectives ?? '') }}

        </textarea>

    </div>


    <div class="mb-3">

        <label>Content</label>

        <textarea name="content"
        class="form-control"
        rows="5">

        {{ old('content',$lesson->content ?? '') }}

        </textarea>

    </div>


    <div class="mb-3">

        <label>Activities</label>

        <textarea name="activities"
        class="form-control">

        {{ old('activities',$lesson->activities ?? '') }}

        </textarea>

    </div>


    <div class="mb-3">

        <label>Assessment</label>

        <textarea name="assessment"
        class="form-control">

        {{ old('assessment',$lesson->assessment ?? '') }}

        </textarea>

    </div>


    <div class="mb-3">

        <label>Material</label>

        <input type="file"
        name="downloadable_material"
        class="form-control">

    </div>