@extends('layouts.admin.app')

@section('title', translate('messages.supplier_list'))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
    <div class="page-header">
    <!-- Page Heading -->
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <h1 class="page-header-title mb-3 mr-1">
                <span class="page-header-icon">
                    <img src="{{ asset('public/assets/admin/img/role.png') }}" class="w--26" alt="">
                </span>
                <span>
                    {{ translate('messages.supplier_list') }}
                </span>
            </h1>
            <a href="{{ route('admin.users.suppliers.create') }}" class="btn btn--primary mb-3">
                <i class="tio-add-circle"></i>
                <span class="text">{{ translate('messages.add_new') }}</span>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2 border-0">
                    <div class="search--button-wrapper">
                        <h5 class="card-title">{{ translate('messages.supplier_table') }} <span class="badge badge-soft-dark ml-2" id="itemCount">{{ $suppliers->total() }}</span></h5>
                        <form class="search-form min--200">
                            <!-- Search -->
                            <div class="input-group input--group">
                                <input id="datatableSearch_" type="search" name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="{{ translate('messages.ex_:_search_name') }}" aria-label="Search">
                                <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                            </div>
                            <!-- End Search -->
                        </form>

                        @if(request()->get('search'))
                        <button type="reset" class="btn btn--primary ml-2 location-reload-to-base" data-url="{{ url()->full() }}">{{ translate('messages.reset') }}</button>
                        @endif

                        <!-- Unfold -->
                        <div class="hs-unfold mr-2">
                            <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle h--45px min-height-40" href="javascript:;" data-hs-unfold-options='{
                                "target": "#suppliersExportDropdown",
                                "type": "css-animation"
                            }'>
                                <i class="tio-download-to mr-1"></i> {{ translate('messages.export') }}
                            </a>

                            <div id="suppliersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                <span class="dropdown-header">{{ translate('messages.download_options') }}</span>
                                <a id="export-excel" class="dropdown-item" href="{{ route('admin.users.suppliers.export', ['type'=>'excel', request()->getQueryString()]) }}">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{ asset('public/assets/admin/svg/components/excel.svg') }}" alt="Excel Icon">
                                    {{ translate('messages.excel') }}
                                </a>
                                <a id="export-csv" class="dropdown-item" href="{{ route('admin.users.suppliers.export', ['type'=>'csv', request()->getQueryString()]) }}">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{ asset('public/assets/admin/svg/components/placeholder-csv-format.svg') }}" alt="CSV Icon">
                                    .{{ translate('messages.csv') }}
                                </a>
                            </div>
                        </div>
                        <!-- End Unfold -->
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100" data-hs-datatables-options='{
                            "order": [],
                            "orderCellsTop": true,
                            "paging": false
                        }'>
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0">{{ translate('sl') }}</th>
                                    <th class="border-0">{{ translate('messages.name') }}</th>
                                    <th class="border-0">{{ translate('messages.phone') }}</th>
                                    <th class="border-0">{{ translate('messages.email') }}</th>
                                    <th class="border-0 text-center">{{ translate('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody id="set-rows">
                                @foreach($suppliers as $k => $supplier)
                                    <tr>
                                        <th scope="row">{{ $k + $suppliers->firstItem() }}</th>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->phone }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>
                                            <div class="btn--container justify-content-center">
                                                <a class="btn action-btn btn--primary btn-outline-primary" href="{{ route('admin.users.suppliers.edit', [$supplier->id]) }}" title="{{ translate('messages.edit_supplier') }}"><i class="tio-edit"></i></a>
                                                <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:" data-id="supplier-{{$supplier->id}}" data-message="{{ translate('messages.want_to_delete_this_supplier') }}" title="{{ translate('messages.delete_supplier') }}"><i class="tio-delete-outlined"></i></a>
                                            </div>
                                            <form action="{{ route('admin.users.suppliers.destroy', [$supplier->id]) }}" method="post" id="supplier-{{$supplier->id}}">
                                                @csrf @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(count($suppliers) !== 0)
                    <hr>
                @endif
                <div class="page-area">
                    {!! $suppliers->links() !!}
                </div>
                @if(count($suppliers) === 0)
                    <div class="empty--data">
                        <img src="{{ asset('/public/assets/admin/svg/illustrations/sorry.svg') }}" alt="No Data">
                        <h5>{{ translate('no_data_found') }}</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('script_2')

@endpush