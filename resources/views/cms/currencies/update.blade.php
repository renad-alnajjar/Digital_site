@extends('cms.parent')

@section('title',__('cms.dashbord'))
@section('page_name',__('cms.update'))
@section('main_name',__('cms.currencies'))
@section('small_page_name',__('cms.update'))
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
                        <h3 class="card-title">{{(__('cms.currencies'))}}</h3>
                    </div>

                    <form id="forme_rest">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{(__('cms.name'))}}</label>
                                <input type="text" class="form-control @if($errors->any()) is-invalid @endif " id="name"
                                    name="name" placeholder="{{__('cms.name')}}" value="{{$currency->name}}">
                            </div>


                            <div class="form-group">
                                <label for="price">{{(__('cms.currencyvalue'))}}</label>
                                <input type="number" class="form-control @if($errors->any()) is-invalid @endif "
                                    id="currencyvalue" name="price" placeholder="{{__('cms.currencyvalue')}}"
                                    value="{{$currency->currencyvalue}}">
                            </div>


                            <div class="form-group">
                                <label>content</label>
                                <textarea id="content" class="form-control" rows="3"
                                    placeholder="Enter ...">{{$currency->content}}</textarea>
                            </div>



                            <div class="form-group">
                                <label for="image_file">Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image_file">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
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
        formData.append('_method','PUT');
        formData.append('name',document.getElementById('name').value);
        formData.append('currencyvalue',document.getElementById('currencyvalue').value);
        formData.append('content',document.getElementById('content').value);

      if(document.getElementById('image_file').files[0] != undefined){
    formData.append('image',document.getElementById('image_file').files[0]);
    }

        axios.post('/cms/admin/currencies/{{$currency->id}}', formData)
        .then(function (response) {
            console.log(response);
        toastr.success(response.data.message);
        window.location.href = '/cms/admin/currencies';
      document.getElementById('forme_rest').reset();
        })
        .catch(function (error) {
            console.log(error);
      toastr.error(error.response.data.message);
        });
    }



//

</script>
@endsection