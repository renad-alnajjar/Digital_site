@extends('cms.parent')
@section('title', __('cms.dashbord'))
@section('content')
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    @canany(['Read-AllCourses','Read-AllAdmin','Read-AllDeposits'])
    <div class="row">
      @can('Read-AllAdmin')
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$allAdmin}}</h3>

            <p>All Admin</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      @endcan


      @can('Read-AllCourses')
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$allUser}}</h3>

            <p>AllCourses</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      @endcan
      @can('Read-AllDeposits')
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$allUser}}</h3>

            <p>AllDeposits</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      @endcan

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>65</h3>

            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    @endcanany
</section>

<div class="center">
  <video controls width="1000" height="400px" autoplay loop
    style="margin-top: 100px; margin-left: 200px; background-color: #000;">
    <source src="{{asset('cms/dist/img/video.mp4')}}" type="video/mp4">
  </video>
</div>

@endsection