@extends('admin.layouts.admin')

@section('content')

            <!-- Main Wrapper -->
        <div class="main-wrapper">
                @include('admin.layouts.topbar')
                @include('admin.layouts.sidebar')
            
            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
                
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">{{ __('sidebar.upazilas') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('sidebar.dashboard') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:(0);">{{ __('sidebar.upazilas') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    @if(session()->has('message'))
                                    <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                    </div>
                                    @endif
                                    <div class="col-md-12 text-right p-0">
                                        <a class="btn btn-primary" data-toggle="" href="{{ route('admin.thanas.create') }}">
                                            <i class="fa fa-plus"> </i> <span>{{ __('pages.add_new') }} </span>
                                        </a>
                                    </div>
                                    <div class="search-area">
                                        <h2>{{ __('pages.search') }}</h2>
                                        <form action="{{ route('admin.thanas') }}" method="get">
                                                                                       
                                            <div class="row">
                                                <div class="col-md-2 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="division_id" name="division_id" class="form-control" onchange="getDistrict(this.value,'district_id','')">
                                                            <option value="">Select Division</option>
                                                            @foreach ($divisions as $var)
                                                            <option value="{{ $var->id }}" <?php if($var->id == Request::get('division_id')) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="district_id" name="district_id" class="form-control">
                                                            <option value="">Select District</option>
                                                            @foreach ($districts as $var)
                                                            <option value="{{ $var->id }}" <?php if($var->id == Request::get('district_id')) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-primary" type="submit">{{ __('pages.search') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-primary" type="submit" name="search" value="download">{{ __('pages.download') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="datatable table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('pages.tbl_sl_number_column') }}</th>
                                                    <th>{{ __('pages.tbl_name_column') }}</th>
                                                    <th>{{ __('sidebar.districts') }}</th>
                                                    <th>{{ __('sidebar.divisions') }}</th>
                                                    <th>{{ __('pages.tbl_description_column') }}</th>
                                                    <th>{{ __('pages.tbl_action_column') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($thanas) > 0) {
                                                    $counter = 0;
                                                    foreach($thanas as $thana) {  $counter++; ?>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo $counter;?></a>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo $thana->name;?></a>
                                                        </h2>
                                                    </td>
                                                    <td><?php echo $thana->district->name;?></td>
                                                    <td><?php echo $thana->division->name;?></td>
                                                    <td style="max-width:220px; white-space: normal;"><?php  echo $thana->description; ?></td>                                                   
                                                    <td class="">
                                                        <div class="actions">
                                                            <a class="btn btn-sm bg-success-light" href="{{ route('admin.thanas.edit', $thana->id) }}">
                                                                <i class="fe fe-pencil"></i> {{ __('pages.edit') }}
                                                            </a>
                                                            <form action="{{ route('admin.thanas.delete', $thana->id) }}" method="post" class="btn-group">
                                                            {{ csrf_field() }}
                                                            <button title="Delete" type="submit" class="btn btn-sm bg-danger-light" onclick="return confirm('Are you sure you want to delete?')"><i class="fe fe-trash"></i> {{ __('pages.delete') }}&nbsp;</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } }
                                                else 
                                                echo "<tr><td colspan=5>No Data Found</td></tr>";?>
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>          
                    </div>
                    
                </div>          
            </div>
            <!-- /Page Wrapper -->
        
        </div>
        <!-- /Main Wrapper -->
@endsection
@section('pagescript')
<script type="text/javascript">
function getDistrict(division_id, id, selected = '') {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{url('admin/get-district')}}",
        type: "post",
        data: {
            _token: CSRF_TOKEN,
            division_id: division_id
        },
        success: function (json_data) {
            var data = $.parseJSON(json_data);
            var element = '<option value="">Select District</option>';

            $.each(data, function (index, value) {
              var s = (selected == index) ? "selected" : "";
              element += '<option value="' + index + '" ' + s + '>' + value + '</option>';
            });
            $("#" + id).html(element);
        },
        error: function (data) {
            console.log("Error: ", data);
        }
    });
}
</script>
@endsection