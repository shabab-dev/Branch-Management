@extends('admin.admin_dashboard')
@section('admin') 
 <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <a href="{{ route('add.manager') }}" class="btn btn-blue waves-effect waves-light">Add Manager</a>
                </ol>
            </div>
                                    <h4 class="page-title">All Manager </h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
 

        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Manager Name</th>
                    <th>Avatar</th>
                    <th>Phone No</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
        
        
            <tbody>
            	@foreach($alladminuser as $key=> $item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td><img src="{{ (!empty($item->photo)) ? url('upload/admin_images/'.$item->photo): url('upload/no_image.jpg') }} " style="width: :50px; height:50px;" ></td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->role }}</td>
                    <td>
                        @if($item->status == 'active')
                            <span class="badge badge-pill bg-success">Active</span>
                        @else
                            <span class="badge badge-pill bg-danger">InActive</span>
                        @endif
                    </td> 
                    <td>
                        <a href="{{ route('edit.manager',$item->id) }}" class="btn btn-primary rounded-pill waves-effect waves-light">Edit</a>

                        <a href="{{ route('delete.manager',$item->id) }}" id="delete" class="btn btn-danger rounded-pill waves-effect waves-light">Delete</a>
                        @if($item->status == 'active')
                            <a href="{{ route('inactive.manager',$item->id) }}" class="btn btn-primary rounded-pill waves-effect waves-light" title="Inactive Now"><i class="fa-solid fa-user-tie"></i> </a>
                        @else
                            <a href="{{ route('active.manager',$item->id) }}" class="btn btn-primary rounded-pill waves-effect waves-light" title="Active Now"><i class="fa-solid fa-user-slash"></i></a>
                        @endif
                    </td> 
                </tr>
                @endforeach
                 
            </tbody>
        </table>

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->

 
                        
                    </div> <!-- container -->

                </div> <!-- content -->

@endsection