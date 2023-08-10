<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="index2.html"><b>New Trader</b></a>
        </div>
        <form id="forme_rest">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="name">{{(__('cms.name'))}}</label>
                    <input type="text" class="form-control @if($errors->any()) is-invalid @endif " id="name" name="name"
                        placeholder="{{__('cms.name')}}" value="{{old('name')}}">
                </div>

                <div class="form-group">
                    <label for="email">{{(__('cms.emaill'))}}</label>
                    <input type="email" class="form-control @if($errors->any()) is-invalid @endif " id="email"
                        name="email" placeholder="{{__('cms.emaill')}}" value="{{old('email')}}">
                </div>


                <div class="form-group">
                    <label for="phone">{{(__('cms.phone'))}}</label>
                    <input type="number" class="form-control @if($errors->any()) is-invalid @endif " id="phoneNumper"
                        name="phone" placeholder="{{__('cms.phone')}}" value="{{old('phone')}}">
                </div>

                <div class="form-group">
                    <label for="password">{{(__('cms.password'))}}</label>
                    <input type="password" class="form-control @if($errors->any()) is-invalid @endif " id="password"
                        name="password" placeholder="{{__('cms.password')}}" value="{{old('password')}}">
                </div>


                <div class="form-group">
                    <label for="age">{{(__('cms.age'))}}</label>
                    <input type="number" class="form-control @if($errors->any()) is-invalid @endif " id="age" name="age"
                        placeholder="{{__('cms.age')}}" value="{{old('age')}}">
                </div>


                <div class="form-group">
                    <label>{{__('cms.roles')}}</label>
                    <select class="form-control roles" style="width: 100%;" id="role_id">
                        @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
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
                <button type="button" onclick="performstore()" class="btn btn-primary">{{__('cms.send')}}</button>
            </div>
        </form>


        <!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
    <script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
    <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
    <script>
        function performstore(){
            let formData=new FormData ();
        formData.append('name',document.getElementById('name').value);
        formData.append('role_id',document.getElementById('role_id').value);
        formData.append('email',document.getElementById('email').value);
        formData.append('phoneNumper',document.getElementById('phoneNumper').value);
        formData.append('age',document.getElementById('age').value);
        formData.append('gender',document.getElementById('gender').value);
        formData.append('password',document.getElementById('password').value);
        formData.append('image',document.getElementById('image_file').files[0]);
            axios.post('/new/user/create', formData)
            .then(function (response) {
                console.log(response);
          toastr.success(response.data.message);
          window.location.href = '/cms/user/login';
          document.getElementById('forme_rest').reset();
            })
            .catch(function (error) {
                console.log(error);
          toastr.error(error.response.data.message);
            });
        }
    </script>
</body>

</html>