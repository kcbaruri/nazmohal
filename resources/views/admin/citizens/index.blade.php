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
                                <h3 class="page-title">{{ __('sidebar.citizens') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('sidebar.dashboard') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:(0);">{{ __('sidebar.citizens') }}</a></li>
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
                                        <a class="btn btn-primary" data-toggle="" href="{{ route('admin.citizens.create') }}">
                                            <i class="fa fa-plus"> </i> <span>{{ __('pages.add_new') }} </span>
                                        </a>
                                    </div>
                                    <div class="search-area">
                                        <h2>{{ __('pages.search') }}</h2>
                                        <form action="{{ route('admin.citizens') }}" method="get">
                                                                                       
                                            <div class="row">
                                                <div class="col-md-2 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="text" value="{{ Request::get('nid')}}" name="nid" class="form-control" placeholder="NID">
                                                        </div>
                                                    </div>
                                                </div>

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
                                                            <select id="district_id" name="district_id" class="form-control" onchange="getThana(this.value,'thana_id','')">
                                                            <option value="">Select District</option>
                                                            @foreach ($districts as $var)
                                                            <option value="{{ $var->id }}" <?php if($var->id == Request::get('district_id')) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="thana_id" name="thana_id" class="form-control" onchange="getUnion(this.value,'union_id','')">
                                                            <option value="">Select Upazila</option>
                                                            @foreach ($thanas as $var)
                                                            <option value="{{ $var->id }}" <?php if($var->id == Request::get('thana_id')) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 p-0">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <select id="union_id" name="union_id" class="form-control">
                                                            <option value="">Select Union</option>
                                                            @foreach ($unions as $var)
                                                            <option value="{{ $var->id }}" <?php if($var->id == Request::get('union_id')) echo "selected=selected"; else echo "";?>>{{ $var->name }}</option>
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
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="datatable table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('pages.tbl_sl_number_column') }}</th>
                                                    <th>{{ __('pages.tbl_photo_column') }}</th>
                                                    <th>{{ __('pages.tbl_name_column') }}</th>
                                                    <th>{{ __('sidebar.vatatypes') }}</th>
                                                    <th>{{ __('pages.nid') }}</th>
                                                    <th>{{ __('pages.tbl_action_column') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($citizens) > 0) {
                                                    $conuter  = 0;
                                                    foreach($citizens as $citizen) {  $conuter++;?>
                                                <tr>
                                                     <td>
                                                        <?php echo $conuter;?>
                                                    </td>
                                                    <td>
                                                         <img style="border-radius: 50%;" src="<?php echo asset($citizen->image);?>" width="100px" height="100px">
                                                    </td>    
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"><?php echo $citizen->name;?></a>
                                                        </h2>
                                                    </td>                                      <td><?php echo $citizen->vatatype->name;?></td>              
                                                    <td><?php echo $citizen->nid;?></td>
                                                    <td class="">
                                                        <div class="actions">
                                                            <a class="btn btn-sm btn-info" href="{{ route('admin.citizens.view', $citizen->id) }}">
                                                                <i class="fe fe-eye"></i> {{ __('pages.view') }}
                                                            </a>
                                                            <a class="btn btn-sm btn-secondary" href="{{ route('admin.citizens.vata-handover', $citizen->id) }}">
                                                                <i class="fe fe-pencil"></i> {{ __('pages.vata_handover') }}
                                                            </a>
                                                            <a class="btn btn-sm bg-success-light" href="{{ route('admin.citizens.edit', $citizen->id) }}">
                                                                <i class="fe fe-pencil"></i> {{ __('pages.edit') }}
                                                            </a>
                                                            <form action="{{ route('admin.citizens.delete', $citizen->id) }}" method="post" class="btn-group">
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

function getThana(district_id, id, selected = '') {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{url('admin/get-thana')}}",
        type: "post",
        data: {
            _token: CSRF_TOKEN,
            district_id: district_id
        },
        success: function (json_data) {
            var data = $.parseJSON(json_data);
            var element = '<option value="">Select Thana</option>';

            $.each(data, function (index, value) {
              var s = (selected == index) ? "selected" : "";
              element += '<option value="' + index + '" ' + s + '>' + value + '</option>';
            });
            $("#" + id).html(element);
            $('#thana_id').trigger('change');
        },
        error: function (data) {
            console.log("Error: ", data);
        }
    });
}

function getUnion(thana_id, id, selected = '') {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{url('admin/get-union')}}",
        type: "post",
        data: {
            _token: CSRF_TOKEN,
            thana_id: thana_id
        },
        success: function (json_data) {
            var data = $.parseJSON(json_data);
            var element = '<option value="">Select Union</option>';

            $.each(data, function (index, value) {
              var s = (selected == index) ? "selected" : "";
              element += '<option value="' + index + '" ' + s + '>' + value + '</option>';
            });
            $("#" + id).html(element);
            $('#union_id').trigger('change');
        },
        error: function (data) {
            console.log("Error: ", data);
        }
    });
}

function getVillage(union_id, id, selected = '') {
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$.ajax({
url: "{{url('admin/get-village')}}",
type: "post",
data: {
    _token: CSRF_TOKEN,
    union_id: union_id
},
success: function (json_data) {
    var data = $.parseJSON(json_data);
    var element = '<option value="">Select Union</option>';

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