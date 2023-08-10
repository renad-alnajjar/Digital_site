@extends('cms.parent')

@section('title',__('cms.dashbord'))
@section('page_name',__('cms.update'))
@section('main_name',__('cms.Users'))
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
                        <h3 class="card-title">{{(__('cms.Users'))}}</h3>
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
                                <label for="name">{{(__('cms.name'))}}</label>
                                <input type="text" class="form-control @if($errors->any()) is-invalid @endif " id="name"
                                    name="name" placeholder="{{__('cms.name')}}" value="{{$user->name}}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{(__('cms.email'))}}</label>
                                <input type="email" class="form-control @if($errors->any()) is-invalid @endif "
                                    id="email" name="email" placeholder="{{__('cms.email')}}" value="{{$user->email}}">
                            </div>

                            {{-- <div class="form-group">
                                <label>{{__('cms.roles')}}</label>
                                <select class="form-control roles" style="width: 100%;" id="role_id">
                                    @foreach ($roles as $roles)
                                    <option value="{{$roles->id}}" @if ($roles->id == $user->id) selected
                                        @endif>{{$roles->name}}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            {{-- <div class="form-group">
                                <label>{{__('cms.city')}}</label>
                                <select class="form-control citys" style="width: 100%;" id="city_id">
                                    @foreach ($cities as $citys)
                                    <option value="{{$citys->id}}" @if ($user->city_id== $citys->id) selected
                                        @endif>{{$citys->name_en}}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            <div class="form-group">
                                <label for="phone">{{(__('cms.phone'))}}</label>
                                <input type="number" class="form-control @if($errors->any()) is-invalid @endif "
                                    id="phoneNumper" name="phone" placeholder="{{__('cms.phone')}}"
                                    value="{{$user->phoneNumper}}">
                            </div>
                            <div class="form-group">
                                <label for="age">{{(__('cms.age'))}}</label>
                                <input type="number" class="form-control @if($errors->any()) is-invalid @endif "
                                    id="age" name="age" placeholder="{{__('cms.age')}}" value="{{old('age')}}">
                            </div>
                            <div class="form-group">
                                <label>{{__('cms.gender')}}</label>
                                <select class="form-control gender" style="width: 100%;" id="gender">
                                    <option value="M">{{__('cms.male')}}</option>
                                    <option value="F">{{__('cms.female')}}</option>
                                </select>
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
                                class="btn btn-primary">{{__('cms.edit')}}</button>
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
        formData.append('email',document.getElementById('email').value);
        formData.append('phoneNumper',document.getElementById('phoneNumper').value);
        formData.append('age',document.getElementById('age').value);
        formData.append('gender',document.getElementById('gender').value);
        formData.append('image',document.getElementById('image_file').files[0]);
        axios.post('/cms/admin/users/{{$user->id}}', formData)
        .then(function (response) {
            toastr.success(response.data.message);
            document.getElementById('forme_rest').reset();
        })
        .catch(function (error) {
            toastr.error(error.response.data.message);
        });
    }


//

</script>
@endsection