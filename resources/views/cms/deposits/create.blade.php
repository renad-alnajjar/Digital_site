@extends('cms.parent')

@section('title',__('cms.dashbord'))
@section('page_name',__('cms.create'))
@section('main_name',__('cms.deposits'))
@section('small_page_name',__('cms.create'))
@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
@endsection

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{(__('cms.deposits'))}}</h3>
                    </div>

                    <form id="forme_rest">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="amount">{{(__('cms.amount'))}}</label>
                                <input type="number" class="form-control @if($errors->any()) is-invalid @endif "
                                    id="amount" name="amount" placeholder="{{__('cms.amount')}}"
                                    value="{{old('amount')}}">
                            </div>
                            <div class="form-group">
                                <label for="accountnumber">{{(__('cms.accountnumber'))}}</label>
                                <input type="accountnumber" class="form-control @if($errors->any()) is-invalid @endif "
                                    id="accountnumber" name="accountnumber" placeholder="{{__('cms.accountnumber')}}"
                                    value="{{old('accountnumber')}}">
                            </div>
                            {{-- <div class="form-group">
                                <label for="TypeCurrencies">{{(__('cms.TypeCurrencies'))}}</label>
                                <input type="TypeCurrencies" class="form-control @if($errors->any()) is-invalid @endif "
                                    id="TypeCurrencies" name="amount" placeholder="{{__('cms.TypeCurrencies')}}"
                                    value="{{old('TypeCurrencies')}}">
                            </div>
                            <div class="form-group">
                                <label for="status">{{(__('cms.status'))}}</label>
                                <input type="status" class="form-control @if($errors->any()) is-invalid @endif "
                                    id="status" name="amount" placeholder="{{__('cms.status')}}"
                                    value="{{old('status')}}">
                            </div> --}}
                        </div>
                        <div class="card-footer">
                            <button type="button" onclick="performstore()"
                                class="btn btn-primary">{{__('cms.send')}}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
</section>
@endsection

@section('scripts')
<script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>


<script>
    function performstore(){
        let formData=new FormData ();
        formData.append('amount',document.getElementById('amount').value);
        formData.append('accountnumber',document.getElementById('accountnumber').value);
        axios.post('/cms/admin/deposits', formData)
        .then(function (response) {
        console.log(response);
        toastr.success(response.data.message);
        window.location.href = '/cms/admin/deposits';
        document.getElementById('forme_rest').reset();
        })
        .catch(function (error) {
        console.log(error);
        toastr.error(error.response.data.message);
        });;
    }



//

</script>
@endsection