@extends('index')
@section('index_content')
    <div class="container">
        <center><h1>Category</h1></center>
        <div class="row">
        @foreach($all_category as $key => $cate)
            <a href="{{URL::to('/course-of-category/'.$cate->category_id)}}">
                <div class="col-sm-4 spacetop">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{asset('public/uploads/category/'.$cate->category_image)}}" alt="Category_IMG" class="img-source"  />
                                <h2>{{ $cate -> category_name }}</h2>
                                <p class="shownameproduct">{{ $cate -> category_des }}</p>
                                <a href="{{URL::to('/course-of-category/'.$cate->category_id)}}" class="btn btn-primary" style="margin-bottom: 5px;">Course Of Category</a>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
        </div>
    </div>
    <div class="submissionstatustable">
  <center><a class="btn btn-dark" href="{{ url()->previous() }}"> ⬅ Back</a></center>
</div>
@endsection