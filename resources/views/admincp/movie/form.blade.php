@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Thêm phim') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!isset($movie))
                        {!! Form::open(['route'=>'movie.store','method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                    @else
                         {!! Form::open(['route'=>['movie.update',$movie->id],'method'=>'PUT', 'enctype' => 'multipart/form-data'])!!}
                    @endif
                 <div class="form-group">
                    {!! Form::label('title','Tên phim',[])!!}
                    {!! Form::text('title',isset($movie) ? $movie->title:'',['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu...','id'=>'slug','onkeyup'=>'ChangeToSlug()','required' => 'required'])!!}
                 </div>
                 <div class="form-group">
                    {!! Form::label('slug','Slug',[])!!}
                    {!! Form::text('slug',isset($movie) ? $movie->slug:'',['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu...','id'=>'convert_slug'])!!}
                 </div>
                 <div class="form-group">
                  {!! Form::label('English Name','English Name',[])!!}
                  {!! Form::text('name_eng',isset($movie) ? $movie->name_eng:'',['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu...','id'=>'name_eng','required' => 'required'])!!}
               </div>
               <div class="form-group">
                  {!! Form::label('year','Năm',[])!!}
                  {!! Form::selectYear('year',1980,2025,' ',['class'=>'form-select form-select-sm','name'=>'year','aria-label'=>"Default select example"]) !!} 
               </div>
                 <div class="form-group">
                    {!! Form::label('description','Mô tả',[])!!}
                    {!! Form::textarea('description',isset($movie) ? $movie->description:'',['style'=>'resize:none','class'=>'form-control','placeholder'=>'Nhập vào mô tả...','id'=>'description','required' => 'required'])!!}
                 </div>
                 <div class="form-group">
                  {!! Form::label('Tags','Tags',[])!!}
                  {!! Form::textarea('tags',isset($movie) ? $movie->tags:'',['style'=>'resize:none','class'=>'form-control','placeholder'=>'...',])!!}
               </div>
               <div class="form-group">
                  {!! Form::label('duration','Thời lượng',[])!!}
                  {!! Form::text('duration',isset($movie) ? $movie->duration:'',['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu...','required' => 'required'])!!}
               </div>
               <div class="form-group">
                  {!! Form::label('sotap','Số tập',[])!!}
                  {!! Form::text('sotap',isset($movie) ? $movie->sotap:1,['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu...','required' => 'required'])!!}
               </div>
                 <div class="form-group">
                  {!! Form::label('Resolution',' Trạng thái',[])!!}
                  {!! Form::select('resolution',['0'=>'HD','1'=>'SD','2'=>'HDCAM','3'=>'SDCAM','4'=>'FullHD','5'=>'Trailer'],isset($movie)? $movie->resolution:'',['class'=>'form-control'])!!}
               </div>
               <div class="form-group">
                  {!! Form::label('Phụ đề','Phụ đề',[])!!}
                  {!! Form::select('phude',['1'=>'Phụ đề','0'=>'Không phụ đề'],isset($movie)? $movie->phude:'',['class'=>'form-control'])!!}
               </div>
               <div class="form-group">
                  {!! Form::label('thuocphim','Thuộc phim',[])!!}
                  {!! Form::select('thuocphim',['2'=>'Phim bộ','1'=>'Phim lẻ'],isset($movie)? $movie->thuocphim:'',['class'=>'form-control'])!!}
               </div>
               <div class="form-group">
                  {!! Form::label('trailer','Trailer',[])!!}
                  {!! Form::text('trailer',isset($movie) ? $movie->trailer:'',['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu...'])!!}
               </div>
                 <div class="form-group">
                    {!! Form::label('ative','Active',[])!!}
                    {!! Form::select('status',['1'=>'Hiển thị','0'=>'Không'],isset($movie)? $movie->status:'',['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                    {!! Form::label('category_id','Danh mục',[])!!}
                    {!! Form::select('category_id',$category,isset($movie)? $movie->category_id:'',['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                    {!! Form::label('genre_id','Thể loại',[])!!} <br>
                    @foreach ($listGenre as $item)
                    @if(isset($movieGenre))
                     {!! Form::checkbox('genre[]',$item->id,isset($movieGenre) && $movieGenre->contains($item->id)? true:false)!!} 
                     @else
                     {!! Form::checkbox('genre[]',$item->id)!!} 
                     @endif
                     {!! Form::label('genre[]',$item->title)!!}
                    @endforeach
                 </div>
                 <div class="form-group">
                    {!! Form::label('country_id','Quốc gia',[])!!}
                    {!! Form::select('country_id',$country,isset($movie)? $movie->country_id:'',['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                    {!! Form::label('Phim hot','Phim Hot',[])!!}
                    {!! Form::select('phimhot',['1'=>'Phim hot','0'=>'Không'],isset($movie)? $movie->phimhot:'',['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                  {!! Form::label('topview',' Top view',[])!!}
                  {!! Form::select('topview',['0'=>'Không nằm top view','1'=>'Tuần','2'=>'Tháng','3'=>'Qúy'],isset($movie)? $movie->topview:'',['class'=>'form-control'])!!}
               </div>
                 <div class="form-group">
                    {!! Form::label('hinhanh','Hình ảnh',[])!!}
                    {!! Form::file('hinhanh',['class'=>'form-control'] )!!}
                    @if (isset($movie))
                        <img width="200px" src="{{asset('upload/movie/'.$movie->image)}}" alt="">
                    @endif
                 </div>
               
                 @if (!isset($movie))
                     {!! Form::submit('Thêm dữ liệu',['class'=>'btn btn-success'])!!}
                 @else
                     {!! Form::submit('Cập nhật',['class'=>'btn btn-success'])!!}
                 @endif
                 {!! Form::close('')!!}
                </div>
            </div>
       </div>
    </div>
</div>
@endsection
