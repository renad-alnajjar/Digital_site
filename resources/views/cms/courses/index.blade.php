@extends('cms.parent')

@section('title',__('cms.dashbord'))
@section('page_name',__('cms.index'))
@section('main_name',__('cms.courses'))
@section('small_page_name',__('cms.index'))

@section('styles')

@endsection

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title ">{{(__('cms.courses'))}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">{{__('cms.#')}}</th>
                                    <th>{{(__('cms.SubTitle'))}}</th>
                                    <th>{{(__('cms.image'))}}</th>
                                    <th>{{(__('cms.name'))}}</th>
                                    <th>{{(__('cms.price'))}}</th>
                                    <th>{{(__('cms.href'))}}</th>
                                    <th>{{(__('cms.created_at'))}}</th>
                                    @canany(['Update-Course', 'Delete-Course'])
                                    <th style="width: 15px">{{(__('cms.setting'))}}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($courses as $courses)
                                    <td>{{$loop->index + 1 ?? ''}}</td>
                                    <td>{{$courses->SubTitle ?? ''}}</td>
                                    <td>
                                        <span>
                                            <img class="round" src="{{Storage::url ($courses->image)}}" alt="avatar"
                                                height="60" width="60"></span>
                                    </td>

                                    <td>{{$courses->name ?? ''}}</td>
                                    <td>{{$courses->price ?? ''}}</td>
                                    <td>
                                        <a href="{{$courses->href}}" target="_blank">
                                            <h6 class="btn btn-danger">اظغط هنا </h6>
                                        </a>
                                    </td>

                                    <td>{{$courses->created_at->diffForHumans()}}</td>

                                    @canany(['Update-Course', 'Delete-Course'])
                                    <td>
                                        <div class="btn-group">
                                            @can('Update-Course')
                                            <a href="{{route('courses.edit',$courses->id)}}" class="btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('Delete-Course')
                                            <a href="#" onclick="comforme('{{$courses->id}}',this)"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            @endcan


                                            </form>
                                        </div>
                                    </td>
                                    @endcanany


                                </tr>
                                @endforeach
                                <tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">

                    </div>
                </div>

                <!-- /.card -->
            </div>


        </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('cms/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
<script>
    function  comforme(id, element){

        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            performdtore(id, element)
        }
        })


         function performdtore(id,element){
        axios.delete('/cms/admin/courses/'+id )
            .then(function (response) {
                    console.log(response);
                    toastr.success(response.data.message);
                    element.closest('tr').remove();
                 });
                 window.location.href = '/cms/admin/courses'
         .catch(function (error) {
                    console.log(error);
                    toastr.error(error.response.data.message);
                });
        }



    }


</script>
@endsection