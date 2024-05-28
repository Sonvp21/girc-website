<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.video')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        <x-admin.alerts.error />
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <form action="{{ route('admin.videos.update', ['video' => $video->id]) }}" method="POST"
                        class="space-y-4 needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <label class="form-control w-full">
                            <div class="label" for="album_id">
                                <span class="label-text">@lang('admin.album')</span>
                            </div>
                            <select name="album_id" required @class([
                                'input',
                                'input-bordered',
                                'input-error' => $errors->has('album_id'),
                                'w-full',
                            ])>
                                <option value="">Select Album</option>
                                @foreach ($albums as $album)
                                    <option value="{{ $album->id }}"
                                        {{ $video->album_id == $album->id ? 'selected' : '' }}>
                                        {{ $album->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.post.title')</span>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $video->name) }}"
                                placeholder="title video..." @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('name'),
                                    'w-full',
                                ]) />
                        </label>
                        <label class="form-control w-full">
                            <div class="label" for="source">
                                <span class="label-text">@lang('admin.videos.source')</span>
                            </div>
                            <select name="source" required @class([
                                'input',
                                'input-bordered',
                                'input-error' => $errors->has('source'),
                                'w-full',
                            ])>
                                @foreach (App\Enums\VideoSourceEnum::cases() as $source)
                                    <option value="{{ $source->value }}"
                                        {{ $video->source == $source ? 'selected' : '' }}>
                                        @lang('admin.' . $source->value)
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.videos.videoID')</span>
                            </div>
                            <input type="text" name="video_id" value="{{ old('video_id', $video->video_id) }}"
                                placeholder="put on video ID..." @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('video_id'),
                                    'w-full',
                                ]) />
                        </label>
                        <div class="flex items-center space-x-6">
                            <div class="shrink-0">
                                <img id="preview_img" class="h-16 w-16 rounded-full object-cover"
                                    src="{{ $video->getFirstMedia('album_video')->getUrl('thumb') }}"
                                    alt="{{ $video->getFirstMedia('album_video')->name }}" />
                            </div>
                            <label class="block">
                                <span class="sr-only">Choose</span>
                                <div class="input input-bordered flex items-center gap-2 border px-3 py-2">
                                    File:
                                    <span
                                        id="selected_file_name">{{ $video->getFirstMedia('album_video')->name }}</span>
                                </div>

                                <input class="hidden" type="file" name="image" onchange="loadFile(event)"
                                    value="{{ $video->getFirstMedia('album_video')->getUrl('thumb') }}" />
                            </label>
                        </div>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.videos.index') }}" class="btn-light btn">
                                @lang('admin.btn.cancel')
                            </a>
                            <button type="submit" class="btn btn-success ml-2">
                                @lang('admin.btn.submit')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
