@extends('layouts.admin.app')

@section('title', translate('messages.edit_supplier'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Heading -->
    <div class="page-header">
        <h1 class="page-header-title">
            <span class="page-header-icon">
                <img src="{{asset('public/assets/admin/img/role.png')}}" class="w--26" alt="">
            </span>
            <span>
                {{ translate('messages.edit_supplier') }}
            </span>
        </h1>
    </div>
    <!-- Content Row -->
    <form action="{{ route('admin.suppliers.update', $supplier->id) }}" method="post" enctype="multipart/form-data" class="js-validate">
        @csrf
        @method('PUT')
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">
                    <span class="card-header-icon">
                        <i class="tio-user"></i>
                    </span>
                    <span>{{ translate('messages.general_information') }}</span>
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="input-label qcont" for="name">{{ translate('messages.supplier_name') }}<span class="form-label-secondary text-danger" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('messages.Required.') }}"> *</span></label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="{{ translate('messages.supplier_name') }}" value="{{ old('name', $supplier->name) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="h-100 d-flex flex-column">
                            <div class="text-center input-label qcont py-3 my-auto">
                                {{ translate('messages.supplier_image') }} <small class="text-danger">* ( {{ translate('messages.ratio') }} 1:1 )</small>
                            </div>
                            <div class="text-center py-3 my-auto">
                                <img class="img--100" id="viewer" src="{{ asset($supplier->image) }}" alt="Supplier thumbnail"/>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="image" id="customFileUpload" class="custom-file-input" accept=".webp, .jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" value="{{ old('image') }}">
                                <div class="custom-file-label">{{ translate('messages.choose_file') }}</div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="btn--container justify-content-end mt-4">
            <button type="reset" id="reset_btn" class="btn btn--reset">{{ translate('messages.reset') }}</button>
            <button type="submit" class="btn btn--primary">{{ translate('messages.submit') }}</button>
        </div>
    </form>
</div>
@endsection

@push('script_2')
    <script src="{{ asset('public/assets/admin/js/view-pages/supplier.js') }}"></script>
    <script>
        "use strict";
        $(document).on('ready', function () {
            // INITIALIZATION OF SHOW PASSWORD
            $('.js-toggle-password').each(function () {
                new HSTogglePassword(this).init();
            });

            // INITIALIZATION OF FORM VALIDATION
            $('.js-validate').each(function() {
                $.HSCore.components.HSValidation.init($(this), {
                    rules: {
                        confirmPassword: {
                            equalTo: '#signupSrPassword'
                        }
                    }
                });
            });
        });

        $('#reset_btn').click(function(){
            $('#viewer').attr('src', "{{ asset('public/assets/admin/img/400x400/img2.jpg') }}");
            $('#customFileUpload').val(null);
        });
    </script>
@endpush