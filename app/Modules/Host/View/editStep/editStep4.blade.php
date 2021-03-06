<style>
    .progress .bar {
        width: 35%;
        background-color: #9987c0;
    }

    .box-description .right {
        display: inline-block;
    }

    .none {
        cursor: default;
        opacity: 0;
        transition: .2s;
    }

    .show {
        cursor: auto;
        opacity: 1;
        transition: .2s;
    }

    .line-height-35 {
        line-height: 35px;
    }
    span.btn.btn-primary.btn-file {
        padding: 30px 35px;
        border: 1px dashed #aaa;
        background: #f9f9f9;
        color: #7b7b7b;
        margin: 15px 0px;
    }
</style>

<div class="row text-center">
    <div class="col-md-12">
        <div class="row rows-address">
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        @if($hostModel->step >= 0)
                            <a href="{{route('EditHost', ['id' => $hostModel->id, 'step' => 1])}}">مشخصات اقامتگاه</a>
                        @else
                            <a>مشخصات اقامتگاه</a>
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        @if($hostModel->step > 1)
                            <a href="{{route('EditHost', ['id' => $hostModel->id, 'step' => 2])}}">موقعیت</a>
                        @else
                            <a>موقعیت</a>
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        @if($hostModel->step > 2)
                            <a href="{{route('EditHost', ['id' => $hostModel->id, 'step' => 3])}}">امکانات</a>
                        @else
                            <a>امکانات</a>
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly active">
                    <span>
                        @if($hostModel->step > 3)
                            <a href="{{route('EditHost', ['id' => $hostModel->id, 'step' => 4])}}">تصاویر</a>
                        @else
                            <a>تصاویر</a>
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        @if($hostModel->step > 4)
                            <a href="{{route('EditHost', ['id' => $hostModel->id, 'step' => 5])}}">قوانین صاحبخانه</a>
                        @else
                            <a>قوانین صاحبخانه</a>
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        @if($hostModel->step > 5)
                            <a href="{{route('EditHost', ['id' => $hostModel->id, 'step' => 6])}}">قیمت گذاری</a>
                        @else
                            <a>قیمت گذاری</a>
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">تصاویر اقامتگاه<span class="information-step"><i class="fas fa-info-circle"></i></span>
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        {{--                        <div class="row">--}}
                        {{--                            <div class="col-md-4">--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <label for="InputFileImgIndex">تصویر شاخص</label><span style="font-size: 18px;"--}}
                        {{--                                                                                           class="text-danger">*</span>(<span--}}
                        {{--                                            class="msgLabel">وارد کردن تصویر شاخص الزامی می باشد</span>)--}}
                        {{--                                    <br/>--}}
                        {{--                                    <img src="" style="width: 100%" class="images">--}}
                        {{--                                    <span class="btn btn-primary btn-file btn-green">--}}
                        {{--                                        انتخاب کنید ...--}}
                        {{--                                        <input type="file" onchange="readURL(this)" name="file" value="{{ old('img') }}" dir="rtl" id="InputFileImgIndex"/>--}}
                        {{--                                    </span>--}}
                        {{--                                    <p class="text-danger count-upload"></p>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputFileImg">گالری</label>
                                    <span style="font-size: 18px;" class="text-danger">*</span>(<span
                                            class="msgLabel">وارد کردن حداقل یک عکس الزامی می باشد</span>)
                                    <br/>
                                    <span class="btn btn-primary btn-file btn-green">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        <input type="file" name="file" value="{{ old('file') }}" dir="rtl" id="InputFileImg"/>
                                        <span class="PercentUpload"></span>
                                        <span class="Loading"></span>
                                    </span>
                                    <p class="text-danger count-upload"></p>
                                </div>
                                @if($errors->has('file'))
                                    <span style="color:red;">{{ $errors->first('file') }}</span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div id="ExtraGallery">
                                        @foreach($hostModel->getGallery as $key => $value)
                                            <div class="col-md-4 box-gallery-selector box-gallery{{$value->id}}"
                                                 data-first-img="@if($key == 0) 1 @else 0 @endif">
                                                <div class="box-img-host">
                                                    <img src="{{asset('Uploaded/Gallery/Img').'/'.$value->img}}"/>
                                                </div>
                                                <div class="box-img-remove">
                                                    <button onclick="removeGalleryHost({{$value->id}},{{$hostModel->id}})">حذف
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-information">
                            <p class="title-info">
                                تصاویر ملک
                            </p>
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


    $('#InputFileImg').on('change', function () {
        $('.PercentUpload').html('');
        $('.Loading').html('');
        $('.count-upload').text('');
        var img = '<div class="text-center box-loading"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/loading_calendar.gif') }}" /></div>';
        $('.Loading').append(img);
        var file = $(this)[0].files[0];
        var name = file.name;
        var size = file.size;
        var extension = name.split('.').pop().toLowerCase();
        if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            AlertToast('ارسال تصویر', 'فرمت فایل صحیح نیست.', 'warning');
            $('.Loading').html('');
            return false;
        } else if (size > 20000000) {
            AlertToast('ارسال تصویر', 'حجم فایل ارسالی بیش از حد مجاز است.', 'warning');
            $('.Loading').html('');
            return false;
        }
        var hostId = $('#host_id').val();
        var formData = new FormData();
        formData.append('img', file);
        formData.append('id', hostId);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('StoreImageHost')}}',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function () {
                //upload Progress
                var xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', function (event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //update progressbar
                        $('.PercentUpload').text(percent + "%");
                    }, true);
                }
                return xhr;
            },
            success: function (data) {
                if (data.Success == '1') {
                    $('#ExtraGallery').append(data.url.original);
                    $('.box-loading').remove();
                    $('.PercentUpload').html('');
                } else if (data.Success == '0' && data.Message == 'false') {
                    $('.count-upload').text('خطا در ذخیره سازی تصویر ، لطفا مجددا تلاش کنید');
                    $('.box-loading').remove();
                } else if (data.Success == '0' && data.Message == 'error') {
                    $('.count-upload').text('خطا در ارسال داده ها');
                    $('.box-loading').remove();
                } else if (data.Success == '0' && data.Message == 'none') {
                    $('.count-upload').text('تصویری ارسال نشده است');
                    $('.box-loading').remove();
                } else if (data.Success == '0' && data.Message == 'count_upload') {
                    $('.count-upload').text('محدودیت در تعداد ارسال تصاویر');
                    $('.box-loading').remove();
                } else if (data.Success == '0' && data.Message == 'count_upload') {
                    $('.count-upload').text('محدودیت در تعداد ارسال تصاویر');
                    $('.box-loading').remove();
                } else {
                    $('.count-upload').text(data.Message);
                    $('.box-loading').remove();
                }
            }
        });
    });


    /* Get the checkboxes values based on the class attached to each check box */
    $('#step3').click(function () {

        $(".box-loading-step").fadeIn("slow", function() {
            $(this).show();
        });
        var formData = new FormData();
        formData.append('host_id', $('#host_id').val());

        // var file = $('#InputFileImgIndex')[0].files[0];
        // if(file == undefined) {
        //     AlertToast('تصویر شاخص', 'تصویر شاخص نمی تواند خالی باشد.', 'warning');
        //     return false;
        // }
        // var name = file.name;
        // var size = file.size;
        // var extension = name.split('.').pop().toLowerCase();
        // if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        //     AlertToast('تصویر شاخص', 'فرمت عکس شاخص صحیح نیست.', 'warning');
        //     $('.Loading').html('');
        //     return false;
        // } else if (size > 2000000) {
        //     AlertToast('تصویر شاخص', 'حجم عکس شاخص بیش از حد مجاز است.', 'warning');
        //     $('.Loading').html('');
        //     return false;
        // }

        // formData.append('img', file);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('StoreHostStep4')}}',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.Success == 0) {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    $('#myModal').modal('show');
                    $('#MsgErrorStep').text(data.Message);
                } else {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    $('#ExtraFormHost').html(data.Message.original);
                }
            }
        });

    });


    /****************************************
     *         Edit By Step Address         *
     ***************************************/


    $('.BtnEditStep').click(function () {
        return false;
        $(".box-loading-step").fadeIn("slow", function () {
            $(this).show();
        });
        var step = $(this).attr('data-value');
        var host_id = $('#host_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('EditStep')}}',
            type: 'post',
            data: {
                host_id: host_id,
                step: step
            },
            success: function (data) {
                if (data.Success == 1) {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    $('#myModalEdit').modal('show');
                    $('#ExtraBoxEditStep').html(data.Message.original);
                }
            }
        });
    });
    $('span.information-step').click(function () {
        $('.box-information').toggleClass('show-information');
    });

    $('.check-description').click(function () {
        var key = $(this).attr('data-value');
        var input = $(this).parent().parent().parent().find('.input' + key);
        input.toggleClass('show');
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(input).parent().parent().find('.images').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

