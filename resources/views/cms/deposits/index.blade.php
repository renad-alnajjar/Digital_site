@extends('cms.parent')

@section('title',__('cms.dashbord'))
@section('page_name',__('cms.index'))
@section('main_name',__('cms.deposits'))
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
                        <h3 class="card-title ">{{(__('cms.deposits'))}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">{{__('cms.#')}}</th>
                                    <th>{{(__('cms.amount'))}}</th>
                                    <th>{{(__('cms.accountnumber'))}}</th>
                                    <th>{{(__('cms.TypeCurrencies'))}}</th>
                                    <th>{{(__('cms.status'))}}</th>
                                    <th>{{(__('cms.user'))}}</th>
                                    <th>{{(__('cms.created_at'))}}</th>
                                    @canany(['Update-Deposit', 'Delete-Deposit'])
                                    <th style="width: 15px">{{(__('cms.setting'))}}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($data as $data)
                                    <td>{{$loop->index + 1 ?? ''}}</td>

                                    <td>{{$data->amount ?? ''}}</td>
                                    <td>{{$data->accountnumber ?? ''}}</td>
                                    <td>{{$data->TypeCurrencies ?? ''}}</td>
                                    <td>
                                        @if ($data->status == 'waiting')
                                        <li class="btn btn-warning">{{$data->status ?? ''}}</li>
                                        @elseif ($data->status == 'Accredited')
                                        <li class="btn btn-success">{{$data->status ?? ''}}</li>
                                        @elseif ($data->status == 'canceled')
                                        <li class="btn btn-danger">{{$data->status ?? ''}}</li>
                                        @endif
                                    </td>
                                    <td>{{$data->userDeposit[0]->user->name ?? ''}}</td>
                                    <td>{{$data->created_at->diffForHumans()}}</td>
                                    @canany(['Update-Deposit', 'Delete-Deposit'])
                                    <td>
                                        <div class="btn-group">
                                            @can('Update-Deposit')
                                            <a href="{{route('deposits.edit',$data->id)}}" class="btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('Delete-Deposit')
                                            <a href="#" onclick="comforme('{{$data->id}}',this)" class="btn btn-danger">
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
        axios.delete('/cms/admin/deposits/'+id )
            .then(function (response) {
                    console.log(response);
                    toastr.success(response.data.message);
                    element.closest('tr').remove();
                 });
                 window.location.href = '/cms/admin/deposits'
         .catch(function (error) {
                    console.log(error);
                    toastr.error(error.response.data.message);
                });
        }



    }


</script>
@endsection