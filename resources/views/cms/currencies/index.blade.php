@extends('cms.parent')

@section('title',__('cms.dashbord'))
@section('page_name',__('cms.index'))
@section('main_name',__('cms.currencies'))
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
                        <h3 class="card-title ">{{(__('cms.currencies'))}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">{{__('cms.#')}}</th>
                                    <th>{{(__('cms.image'))}}</th>
                                    <th>{{(__('cms.name'))}}</th>
                                    <th>{{(__('cms.currencyvalue'))}}</th>
                                    <th>{{(__('cms.content'))}}</th>
                                    {{-- <th>{{(__('cms.active'))}}</th> --}}
                                    {{-- <th>{{(__('cms.updated_at'))}}</th> --}}
                                    <th>{{(__('cms.created_at'))}}</th>
                                    <th style="width: 15px">{{(__('cms.setting'))}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($currency as $currency)
                                    <td>{{$loop->index + 1 ?? ''}}</td>
                                    <td>
                                        <span>
                                            <img class="round" src="{{Storage::url ($currency->image)}}" alt="avatar"
                                                height="60" width="60"></span>
                                    </td>
                                    <td>{{$currency->name ?? ''}}</td>
                                    <td>{{$currency->currencyvalue ?? ''}}</td>
                                    <td>{{$currency->content ?? ''}}</td>
                                    {{-- <td> <span
                                            class="badge @if ($currency->active) bg-success @else bg-danger @endif">{{$currency->active_status
                                            }}</span>
                                    </td> --}}
                                    <td>{{$currency->created_at->diffForHumans()}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('currencies.edit',[$currency->id])}}"
                                                class="btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {{-- @if (auth()->id() !=$admins->id) --}}

                                            <a href="#" onclick="comforme('{{$currency->id}}',this)"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            </form>
                                        </div>
                                    </td>


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
        axios.delete('/cms/admin/currencies/'+id )
            .then(function (response) {
                    console.log(response);
                    toastr.success(response.data.message);
                    element.closest('tr').remove();
                 });
                 window.location.href = '/cms/admin/currencies'
         .catch(function (error) {
                    console.log(error);
                    toastr.error(error.response.data.message);
                });
        }



    }


</script>
@endsection