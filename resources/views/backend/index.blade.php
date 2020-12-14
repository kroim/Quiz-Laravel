@extends('layouts.back_layout')

@section('back-style')
    <link rel="stylesheet" href="{{ url('/common/croppie/croppie.css') }}" type="text/css">
    <style>
        #other_food_time::-webkit-outer-spin-button,
        #other_food_time::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        #other_food_time {
            -moz-appearance:textfield; /* Firefox */
        }
    </style>
@endsection
@section('back-content')
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>{{__('global.side.my_account')}}</h1>
            </header>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card profile">
                                <div class="profile__img">
                                    <img src="{{ Auth::user()->avatar }}" alt="Profile Avatar" id="profile_avatar">
                                    <a href="javascript:" class="zwicon-camera profile__img__edit" onclick="$('#crop-image-modal').modal()"></a>
                                </div>

                                <div class="profile__info">
                                    <ul class="icon-list">
                                        <li><i class="zwicon-user-circle"></i> {{ Auth::user()->name }}</li>
                                        <li><i class="zwicon-mail"></i> {{ Auth::user()->email }}</li>
                                        <li><i class="zwicon-password"></i> {{ (Auth::user()->role == 1)?'Administrator':((Auth::user()->role == 2)?'Teacher':'Student') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" id="profile_name" class="form-control" value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Useremail</label>
                                        <input type="text" id="profile_email" class="form-control" value="{{ Auth::user()->email }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('global.common.description') }}</label>
                                        <textarea class="form-control" id="profile_description" rows="4">{{ Auth::user()->description }}</textarea>
                                    </div>

                                    <div class="form-group" style="text-align: center">
                                        <button class="btn btn-outline-warning" onclick="changeProfile()">{{ __('global.common.change').' '.__('global.common.profile') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>{{ __('global.common.current').' '.__('global.common.password') }}*</label>
                                        <input type="password" id="profile_old_password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('global.common.new').' '.__('global.common.password') }}*</label>
                                        <input type="password" class="form-control" id="profile_new_password">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('global.common.confirm_password') }}*</label>
                                        <input type="password" class="form-control" id="profile_confirm_password">
                                    </div>
                                    <div class="form-group" style="text-align: center">
                                        <button class="btn btn-outline-danger" onclick="changePassword()">{{ __('global.common.change').' '.__('global.common.password') }}</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Crop Image Modal -->
    <div id="crop-image-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 style="text-align: center">{{ __('global.common.profile').' '.__('global.common.photo') }}</h3>
                    <div class="form-group" style="overflow: auto;">
                        <div id="upload-origin" style="width:100%;"></div>
                    </div>
                    <input type="file" id="upload-crop" style="display:none;" accept="image/*"/>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary form-control" onclick="$('#upload-crop').click();">
                                {{ __('global.common.select').' '.__('global.common.image') }}</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary form-control" data-dismiss="modal" onclick="uploadCropImg()">{{ __('global.common.crop') }}</button>
                        </div>
                    </div>
                </div><!-- end modal-bpdy -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div>
@stop
@section('back-script')
    <script type="text/javascript" src="{{ url('/common/croppie/croppie.js') }}"></script>
    <script type="text/javascript" src="{{ url('/common/croppie/upload_img.js') }}"></script>
    <script>
        var profile_messages = [
            "{{ __('global.errors.address_empty') }}",  // 0
            "{{ __('global.errors.postcode_empty') }}", // 1
            "{{ __('global.errors.city_empty') }}",     // 2
            "{{ __('global.errors.floor_empty') }}",    // 3
            "{{ __('global.errors.phone_empty') }}",    // 4
            "{{ __('global.errors.password_empty') }}",    // 5
            "{{ __('global.errors.password_length') }}",    // 6
            "{{ __('global.errors.confirm_password_empty') }}",    // 7
            "{{ __('global.errors.confirm_password_wrong') }}",    // 8
        ];
        function changeProfile() {
            let profile_avatar = $('#profile_avatar').attr('src');
            let profile_name = $('#profile_name').val();
            if (profile_name === "") {
                customAlert("Username is required");
                return;
            }
            let profile_email = $('#profile_email').val();
            if (profile_email === "") {
                customAlert("Useremail is required");
                return;
            }
            var profile_description = $('#profile_description').val();
            var profile_food_time = $('#profile_food_time').val();

            var url = '/user/my-account';
            var data = {
                _token: '<?php echo csrf_token() ?>',
                avatar: profile_avatar,
                name: profile_name,
                email: profile_email,
                description: profile_description,
            };
            $.ajax({
                url: url,
                method: 'post',
                data: data,
                success: function (res) {
                    if (res.status === 'success') {
                        customAlert(res.message, true);
                        setTimeout(function () {
                            location.reload()
                        }, 2500)
                    }
                    else customAlert(res.message);
                }
            })
        }
        function changePassword() {
            var current_password = $('#profile_old_password').val();
            var new_password = $('#profile_new_password').val();
            if (current_password === '' || new_password === '') {
                customAlert(profile_messages[5]);
                return;
            }
            if (new_password.length < 6) {
                customAlert(profile_messages[6]);
                return;
            }
            var confirm_password = $('#profile_confirm_password').val();
            if (new_password !== confirm_password) {
                customAlert(profile_messages[8]);
                return;
            }
            var url = '/user/my-account';
            var data = {
                _token: '<?php echo csrf_token() ?>',
                action: 'change_password',
                current_password: current_password,
                new_password: new_password
            };
            $.ajax({
                url: url,
                method: 'post',
                data: data,
                success: function (res) {
                    if (res.status === 'success') customAlert(res.message, true);
                    else customAlert(res.message);
                }
            })
        }
    </script>
@stop
