@extends('cms.parent')

@section('title',__('cms.dashbord'))
@section('page_name',__('cms.create'))
@section('main_name',__('cms.courses'))
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
                        <h3 class="card-title">{{(__('cms.courses'))}}</h3>
                    </div>

                    <form id="forme_rest">
                        @csrf
                        <div class="card-body">

                            {{-- <div class="form-group">
                                <label>{{__('cms.Pharmaceutical')}}</label>
                                <select class="form-control roles" style="width: 100%;" id="cities">
                                    @foreach ($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name_ar}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label for="name">{{(__('cms.SubTitle'))}}</label>
                                <input type="text" class="form-control @if($errors->any()) is-invalid @endif "
                                    id="SubTitle" name="SubTitle" placeholder="{{__('cms.SubTitle')}}"
                                    value="{{old('SubTitle')}}">
                            </div>

                            <div class="form-group">
                                <label for="name">{{(__('cms.href'))}}</label>
                                <input type="url" class="form-control @if($errors->any()) is-invalid @endif "
                                    id="href" name="href" placeholder="{{__('cms.href')}}"
                                    value="{{old('href')}}">
                            </div>


                            <div class="form-group">
                                <label for="name">{{(__('cms.name'))}}</label>
                                <input type="text" class="form-control @if($errors->any()) is-invalid @endif " id="name"
                                    name="name" placeholder="{{__('cms.name')}}" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="price">{{(__('cms.price'))}}</label>
                                <input type="number" class="form-control @if($errors->any()) is-invalid @endif "
                                    id="price" name="price" placeholder="{{__('cms.price')}}" value="{{old('price')}}">
                            </div>
                            <div class="form-group">
                                <label>content</label>
                                <textarea id="content" class="form-control" rows="3" placeholder="Enter ..."></textarea>
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
                            <div class="form-group">
                                <label for="video_file">Video</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="video_file">
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
        formData.append('SubTitle',document.getElementById('SubTitle').value);
        formData.append('name',document.getElementById('name').value);
        formData.append('price',document.getElementById('price').value);
        formData.append('href',document.getElementById('href').value);
        formData.append('content',document.getElementById('content').value);
        formData.append('image',document.getElementById('image_file').files[0]);
        formData.append('video',document.getElementById('video_file').files[0]);
        axios.post('/cms/admin/courses', formData)
        .then(function (response) {
        console.log(response);
        toastr.success(response.data.message);
        window.location.href = '/cms/admin/courses';
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