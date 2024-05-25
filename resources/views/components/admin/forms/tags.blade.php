<div>
    <label class="form-control w-full">
        <div class="label" for="tags">
            <span class="label-text">@lang('admin.post.tag')</span>
        </div>
        <input type="text" name="tags" id="tags" value="{{ old('tags', $value) }}"
            placeholder="Enter tags separated by spaces" @class([
                'input',
                'input-bordered',
                'input-error' => $errors->has('tags'),
                'w-full',
                'h-fit',
            ]) />
    </label>
    <link rel="stylesheet" href="{{ asset('vendor/tagify/tagify.css') }}" />
    <script src="{{ asset('vendor/tagify/tagify.js') }}"></script>

    <script>
        var input = document.querySelector('input[name=tags]');
        var tagify = new Tagify(input, {
            delimiters: "\n",
            pattern: /[^,]+/,
        });
        var existingTags = @json($tags);
        tagify.addTags(existingTags);
    </script>
</div>
