<style>
    .border-hover {
        /*border: 2px solid rgb(0, 123, 140) !important;*/
        /*border-radius: 5px;*/
        background-color: #fe884a;
        color: white!important;
    }
</style>
<div id="BoxCalendar">
    <link href="{{asset('frontend/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/style-calendar.css')}}" rel="stylesheet">
    {{--روز های گذشته  calendar-day-past--}}
    {{--امروز  calendar-day-today--}}
    {{--تعطیل  calendar-day-holidays--}}
    {{--خالی  calendar-day-noItem--}}
    @php
        //dd($detailMonth);
        $past_day = $detailMonth['start_day_month']['day_id'] - 1; // تعداد روز های گذشته شده از هفته برای محاسبه شروع تقویم
        $future = end($detailMonth['detail_days']); // تعداد روز برای تکمیل کردن اخر هفته که خالی نباشد
        $prev = $detailMonth['detail_days'][0];
        $future_day = abs($future['day_id'] - 7);
    @endphp
    <div class="set__calendar">
        <header class="header__calendar">
            <button class="btn__right" type="button">
                <i class="fas fa-angle-right"></i>
            </button>
            <div class="title__calendar">
                {{$detailMonth['today']['day'].' '.$detailMonth['today']['name_month'].' '.$detailMonth['today']['year']}}
                <input type="hidden" value="{{$detailMonth['today']['year']}}" id="InputYear"/>
                <input type="hidden" value="{{$detailMonth['today']['num_month']}}" id="InputMonth"/>
            </div>
            <button type="button" class="btn__left">
                <i class="fas fa-angle-left"></i>
            </button>
        </header>
        <section class="body__calendar">
            <div class="ring-left"></div>
            <div class="ring-right"></div>
            <div class="calendar-body">
                <div class="month-container">

                    <div id="RowLoading" class="text-center"></div>
                    <div class="calendar-day-row" id="daysOfWeek">
                        @foreach($week as $key => $value)
                            <main class="@if($value == 'جمعه') calendar-day-holidays @endif">
                                <div class="info-container">
                                    @if($value == 'شنبه')
                                        ش
                                    @elseif($value == 'یکشنبه')
                                        ی
                                    @elseif($value == 'دوشنبه')
                                        د
                                    @elseif($value == 'سه شنبه')
                                        س
                                    @elseif($value == 'چهارشنبه')
                                        چ
                                    @elseif($value == 'پنجشنبه')
                                        پ
                                    @elseif($value == 'جمعه')
                                        ج
                                    @endif
                                </div>
                            </main>
                        @endforeach
                    </div>
                    <div class="spinner calendarLoading" style="display: none;">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                    <div class="calendar-month">
                        <div class="calendar-day-row">
                            @for($i = 0; $i < $past_day; $i++)
                                <main class="calendar-day-noItem"></main>
                            @endfor

                            @foreach($detailMonth['detail_days'] as $key => $value)
                                <main class="calendar-day-item @if($value['day_id'] == 7 || in_array($value['day'], $holidays_now_month)) calendar-day-holidays @endif @if($value['day'] == $detailMonth['today']['day']) calendar-day-today @endif @if($value['day'] < $detailMonth['today']['day'] || $value['block_day'] == 1) last-day-item block_day @endif date{{$value['day']}}">
                                    <div class="info-container">
                                        <div class="calendar-day-item-date">{{$value['day']}}</div>
                                        <div class="calendar-day-item-price">{{substr($value['price'],0,-3)}}</div>
                                    </div>
                                </main>
                                @if($value['day_id'] == 7)
                        </div>
                        <div class="calendar-day-row">
                            @endif
                            @endforeach

                            @for($i = 0; $i < $future_day; $i++)
                                <main class="calendar-day-noItem"></main>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="calendar-footer">
                    <div class="calendar-footer-txt">
                        <div class="calendar-price-tip">
                            <i aria-hidden="true" class="fa fa-info-circle"></i>
                            <main> قیمت‌ به هزار تومان</main>
                        </div>
                        {{--<div class="calendar-bookedDays">حداقل مدت رزرو: ۱ شب</div>--}}
                    </div>
                    <div class="footer-last-update">
                        {{--<main>آخرین بروزرسانی تقویم توسط میزبان:</main>--}}
                        {{--<main class="footer-last-update-date">۱۳۹۷/۰۹/۲۱</main>--}}
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>


        var num;
        var numHover;
        var year = $('#InputYear').val();
        var month = $('#InputMonth').val();
        var calendar_day_item = $('.calendar-day-item');
        var last_day_item = $('.last-day-item');

        $('#BoxCalendar .calendar-day-item').click(function () { // item calendar
            if($('#InputDateFrom').val() != '' && $(this).hasClass('last-day-item')) {
                AlertMessage('رزرو اقامتگاه', 'امکان ثبت این تاریخ وجود ندارد', 'warning');
                return false;
            }
            $('.calendar-day-item').removeClass('border-hover');
            $(this).addClass('border-hover');
            $(this).addClass('calendar-hover');
            num = parseInt($(this).find('.calendar-day-item-date').text());
            if ($('#InputDateFrom').val() != '')
            {
                /** for check block day when change calendar */
                start_day = 0;
                start_month = 0;
                start_year = 0;
                /** **************************************** */
                $('#InputDateTo').val(year + '/' + month + '/' + num);
                $('.box-calendar').hide("slow");
                var date_from = $('#InputDateFrom').val();
                var date_to = $('#InputDateTo').val();
                // fill input date in form login and register
                $('#DateFromRegister').val(date_from);
                $('#DateToRegister').val(date_to);
                $('#DateFromLogin').val(date_from);
                $('#DateToLogin').val(date_to);
                /////////////////////////////////////////////
                var host_id = {{$hostModel->id}};
                $('.calendar-day-item').removeClass('calendar-hover');
                var img = '<div class="text-center"><img style="height:50px;width:auto;margin-bottom: 15px;transition: 0.5s;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
                $('#MsgCalculatePrice').html(img);
                $.ajax({
                    url: '{{route('CalculateReserveHostByDateAjax')}}',
                    type: 'get',
                    data: {
                        date_from: date_from,
                        date_to: date_to,
                        count_person: $('#CountGuest').val(),
                        host_id: host_id
                    },
                    success: function (data) {
                        // console.log(data);
                        // $('#ExtraFactorReserve').html(data.Message.original);
                        // $('#BtnShowFactor').click();
                        $('#MsgCalculatePrice').html(data.Message.original);
                        // $('#MsgCalculatePrice').empty();
                    }
                });
            } else {
                $('#InputDateFrom').val(year + '/' + month + '/' + num);
                start_day = num;
                start_month = month;
                start_year = year;
            }


            /** block date after first reserve*/
            start_date = parseInt($(this).find('.calendar-day-item-date').text());

            /** before first date */
            $.each(calendar_day_item, function(index_2, element_2){
                var num_2 = parseInt($(element_2).find('.calendar-day-item-date').text());
                if(num_2 < start_date) {
                    $(element_2).addClass('last-day-item');
                    $(element_2).addClass('temporary-block'); // temporary-block for change again calendar
                }
            });

            /** after first date */
            $.each(last_day_item, function(index, element){
                var element_number_block_day = $(element);
                var number_block_day = parseInt($(element).find('.calendar-day-item-date').text());
                if(number_block_day > num) {
                    $.each(calendar_day_item, function(index_2, element_2){
                        var num_2 = parseInt($(element_2).find('.calendar-day-item-date').text());
                        if(num_2 > number_block_day) {
                            check_block_day = number_block_day; // for block days after first day block
                            element_number_block_day.removeClass('last-day-item');
                            $(element_2).addClass('last-day-item');
                            $(element_2).addClass('temporary-block'); // temporary-block for change again calendar
                        }
                    });
                    return false;
                }
            });
        });

        if(check_block_day > 0) {
            /** block date after first block date */
            $.each(calendar_day_item, function(index, element){
                var num = parseInt($(element).find('.calendar-day-item-date').text());
                if((start_month == month && num >= check_block_day) || month > start_month || year > start_year) {
                    $(element).addClass('last-day-item');
                    $(element).addClass('temporary-block'); // temporary-block for change again calendar
                }
            });
        }

        if(start_day > 0 || start_month > 0 || start_year > 0) {
            if((start_month > month && year <= start_year) || year < start_year) {
                /** block date after start reserve */
                $.each(calendar_day_item, function(index, element){
                    $(element).addClass('last-day-item');
                    $(element).addClass('temporary-block'); // temporary-block for change again calendar
                });
            } else if(start_month == month) {
                /** block date after start reserve */
                $.each(calendar_day_item, function(index, element){
                    var num = parseInt($(element).find('.calendar-day-item-date').text());
                    if(num < start_day) {
                        $(element).addClass('last-day-item');
                        $(element).addClass('temporary-block'); // temporary-block for change again calendar
                    } else {
                        return false;
                    }
                });

                /** after first date */
                $.each(last_day_item, function(index, element){
                    var element_number_block_day = $(element);
                    var number_block_day = parseInt($(element).find('.calendar-day-item-date').text());
                    if(number_block_day > num) {
                        $.each(calendar_day_item, function(index_2, element_2){
                            var num_2 = parseInt($(element_2).find('.calendar-day-item-date').text());
                            if(num_2 > number_block_day) {
                                element_number_block_day.removeClass('last-day-item');
                                $(element_2).addClass('last-day-item');
                                $(element_2).addClass('temporary-block'); // temporary-block for change again calendar
                            }
                        });
                        return false;
                    }
                });
            } else {

            }
        }

        $('#BoxCalendar .calendar-day-item').hover(function () {
            /** remove bg orange from all object calendar */
            $('.calendar-day-item').removeClass('border-hover');
            $(this).addClass('border-hover');
            /** *******************************************/
            $('.calendar-day-item').removeClass('calendar-hover');
            if($('#InputDateFrom').val() != '') {
                numHover = parseInt($(this).find('.calendar-day-item-date').text());
                for (var i = num; i <= numHover; i++) {
                    $('.date' + i).addClass('calendar-hover');
                }
            }
        });

        $('#InputDateFrom').click(function () {
            $('.calendar-day-item').removeClass('calendar-hover');
            $('#InputDateTo').val('');
            $('#InputDateFrom').val('');
            $('.box-calendar').show("slow");
            $('#MsgCalculatePrice').html('');
            ClearCalendar();
        });

        $('.btn__left').click(function () {
            $('#RowLoading').html('<img style="width:50px;" src="{{asset('backend/img/img_loading/loading_calendar.gif')}}"/>');
            $('.calendar-month').css('opacity', '0.2');
            // var year = $('#InputYear').val();
            var day_id = '{{$future['day_id']}}';
            var name_day = '{{$future['name_day']}}';
            var num_month = '{{$detailMonth['today']['num_month']}}';
            var formData = new FormData();
            formData.append('year', year);
            formData.append('day_id', day_id);
            formData.append('name_day', name_day);
            formData.append('num_month', num_month);
            formData.append('host_id', {{$hostModel->id}});
            // Send data with ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('CalendarChangeUserNext')}}',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    // console.log(data);
                    $('#BoxCalendar').html(data)
                }
            });
        });

        $('.btn__right').click(function () {
            alert();
            if($('#MonthNumberNow').val() == $('#InputMonth').val()) {
                return false;
            }
            $('#RowLoading').html('<img style="width:50px;" src="{{asset('backend/img/img_loading/loading_calendar.gif')}}"/>');
            $('.calendar-month').css('opacity', '0.2');
            // var year = $('#InputYear').val();
            var day_id = '{{$prev['day_id']}}';
            var name_day = '{{$prev['name_day']}}';
            var num_month = '{{$detailMonth['today']['num_month']}}';
            var formData = new FormData();
            formData.append('year', year);
            formData.append('day_id', day_id);
            formData.append('name_day', name_day);
            formData.append('num_month', num_month);
            formData.append('host_id', {{$hostModel->id}});
            // Send data with ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('CalendarChangeUserPrev')}}',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    // console.log(data);
                    $('#BoxCalendar').html(data)
                }
            });
            return false;
        });

        $('.calendar-day-item').click(function () {
            if ($(this).hasClass('last-day-item')) {
                $.Toast("<p>روز های خاص</p>", "<p>امکان ثبت این تاریخ وجود ندارد .</p>", "warning", {
                    has_icon: true,
                    has_close_btn: true,
                    stack: true,
                    fullscreen: false,
                    timeout: 4000,
                    sticky: false,
                    has_progress: true,
                    rtl: true,
                });
            } else {
                var day = $(this).find('.calendar-day-item-date').text();
                // var month = $('#InputMonth').val();
                // var year = $('#InputYear').val();
                var date = year + '/' + month + '/' + day;
                $('#InputDateSpecial').val(date);
            }
        });

        $('.btn-eraser-date').click(function () {
            $('#InputDate').val('');
        });

        $('.btn-eraser-description').click(function () {
            $('#InputDescription').val('');
        });


        $('#BtnClear').click(function () {
            ClearCalendar();
        });

        function ClearCalendar() {
            check_block_day = 0;
            /** for check block day when change calendar */
            start_day = 0;
            start_month = 0;
            start_year = 0;
            /** **************************************** */
            num = null;
            var day_item = $('.temporary-block');
            $.each(day_item, function(index, element) {
                $(element).removeClass('temporary-block');
                $(element).removeClass('last-day-item');
            });
            var block_day = $('.block_day');
            $.each(block_day, function(index, element) {
                $(element).addClass('last-day-item');
            });
            $('.calendar-day-item').removeClass('calendar-hover');
            $('#InputDateTo').val('');
            $('#InputDateFrom').val('');
            // $('.box-calendar').hide("slow");
            $('.box-calendar').show("slow");
        }

    </script>


</div>