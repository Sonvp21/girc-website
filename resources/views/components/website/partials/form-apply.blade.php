<div
class="modal-box group from-blue-600/30 to-blue-200/5 [background-image:linear-gradient(180deg,var(--tw-gradient-stops))]">
<form>
    <button
        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 focus:border-none focus:outline-none"
        onclick="event.preventDefault(); document.getElementById('modal_regiser').close()">✕</button>
</form>

<div class="text-center">
    <h1 class="font-bold text-2xl uppercase h-8">@lang('web.consulting_registration')</h1>
    <p>@lang('web.register_comment')</p>
</div>

<div class="p-4 pb-0">
    <div>
        <div class="overflow-hidden  sm:rounded-lg">
            <div class=" px-8 py-0 sm:rounded-lg">
                <form action="{{ route('admin.applies.store') }}" method="POST"
                    class="space-y-4 needs-validation" novalidate enctype="multipart/form-data">
                    @csrf

                    <label class="form-control relative w-full">
                        <input type="text" name="name" value="{{ old('name') }}"
                            placeholder="@lang('admin.applies.name')" class="input input-bordered w-full" />
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </label>
                    <label class="form-control relative w-full">
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            placeholder="@lang('admin.applies.phone')" class="input input-bordered w-full" />
                    </label>
                    <label class="form-control relative w-full">
                        <input type="text" name="email" value="{{ old('email') }}"
                            placeholder="@lang('admin.applies.email')" class="input input-bordered w-full" />
                    </label>
                    <label class="form-control relative w-full">
                        <input type="text" name="school" value="{{ old('school') }}"
                            placeholder="@lang('admin.applies.school')" class="input input-bordered w-full" />
                    </label>
                    <label class="form-control relative w-full">
                        <select name="major" required class="input input-bordered w-full">
                            <option value=""> @lang('admin.applies.select_major') </option>
                            @foreach (App\Enums\ApplyMajorEnum::cases() as $major)
                                <option @selected($major->value == old('major')) value="{{ $major->value }}">
                                    @lang('admin.' . $major->value)
                                </option>
                            @endforeach
                        </select>
                    </label>
                    <label class="form-control relative w-full">
                        <textarea name="question" placeholder="{{ __('admin.applies.question') }}" class="textarea textarea-bordered" required>{{ old('question') }}</textarea>
                    </label>


                    <div class="flex justify-center gap-4">
                        <button type="button" class="text-[#dff0ff] bg-[#4040a3] btn btn-primary"
                            id="ajaxSubmit">
                            Đăng ký ngay
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<style>
.error-message {
    position: absolute;
    color: #ff0000;
    font-size: 12px;
    top: 100%;
    left: 0;
    width: 100%;
    z-index: 5;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#ajaxSubmit').click(function(event) {
        event.preventDefault();
        var form = $(this).closest('form');
        var formData = form.serialize();

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(
                    'Bạn đã đăng ký thành công! Một thành viên trong đội ngũ tư vấn của chúng tôi sẽ sớm liên hệ để trò chuyện cụ thể hơn về nhu cầu của bạn.'
                    );
                form.trigger("reset");
                $('.error-message').remove();
                $('input, select, textarea').removeClass('input-error');
            },
            error: function(xhr) {
                if (xhr.status == 422) {
                    var errors = JSON.parse(xhr.responseText).errors;
                    $('.error-message').remove();
                    $('input, select, textarea').removeClass('input-error');
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            var errorMessages = errors[key].join("<br>");
                            var inputElement = $('input[name="' + key +
                                '"], select[name="' + key + '"], textarea[name="' +
                                key + '"]');
                            inputElement.addClass('input-error')
                                .after(
                                    '<span class="text-red-500 text-xs error-message">' +
                                    errorMessages + '</span>');
                        }
                    }
                } else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                }
            }
        });
    });
    $('input, select, textarea').on('input change', function() {
        $(this).removeClass('input-error');
        $(this).next('.error-message').remove();
    });
});
</script>