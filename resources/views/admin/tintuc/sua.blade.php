@extends('admin.layout.index')
@section('content')
    
<!-- Page Content -->
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Túc
                            <small>{{$tintuc->TieuDe}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $er )
                                    {{$er }} 
                                @endforeach
                            </div>
                        @endif

                        @if (session('thongbao'))
                            <div class="alert alert-success">
                                    {{ session('thongbao') }}
                            </div>
                        @endif

                        <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Thể Loại</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                    @foreach ($theloai as $tl)
                                        <option 
                                        @if($tl->Ten == $tintuc->loaitin->theloai->Ten)
                                            {{ "selected" }}
                                        @endif
                                        value="{{ $tl ->id }}">{{ $tl->Ten }}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại Tin</label>
                                <select class="form-control" name="LoaiTin" id="LoaiTin">
                                    @foreach ($loaitin as $lt)
                                        <option 
                                        @if($tl->Ten == $tintuc->loaitin->theloai->Ten)
                                            {{ "selected" }}
                                        @endif
                                        value="{{ $lt->id }}">{{ $lt->Ten }}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" placeholder="Nhập Tiêu đề" value="{{ $tintuc->TieuDe }}" />
                            </div>
                            <div class="form-group">
                                <label>Tóm Tắt</label>
                                <textarea name="TomTat" id="demo" class="form-control ckeditor" rows="3">
                                    {!! $tintuc->TomTat !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="4">
                                    {!! $tintuc->NoiDung !!}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <p><img src="upload/tintuc/{{ $tintuc->Hinh }}" alt=""></p>
                                <input type="file" name="Hinh" class="form-control" >
                                @if (session('loi'))
                                    <div class="alert alert-danger">
                                        {{ session('loi') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" 
                                    @if ($tintuc->NoiBat == 0)
                                        {{ "checked" }}
                                    @endif
                                    type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" 
                                    @if ($tintuc->NoiBat == 1)
                                        {{ "checked" }}
                                    @endif
                                    type="radio">Có
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
                {{-- comment --}}
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Coment
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        @if (session('thongbao'))
                            <div class="alert alert-success">
                                    {{ session('thongbao') }}
                            </div>
                        @endif
                        @if (session('loixoa'))
                          <div class="alert alert-danger">
                                {{ session('loixoa') }}
                          </div>
                      @endif
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Nội dung</th>
                                <th>Thời gian Coment</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tintuc->comment as $cm)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cm->id}}</td>
                                <td>
                                    <p>{{$cm->user->name}}</p>
                                    {{-- <img width="100px" src="uploai/tintuc/8.jpg"> --}}
                                </td>
                                <td>{{$cm->NoiDung}}</td>
                                <td>{{$cm->create_at}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/comment/xoa/{{$cm->id}}/{{ $tintuc->id }}"> Delete</a></td>
                            </tr>
                            @endforeach
        
        
                        </tbody>
                    </table>
                </div>
                {{-- endComment --}}
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#TheLoai").change(function(){
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loaitin/"+ idTheLoai,function(data){
                    $("#LoaiTin").html(data);
                });
            })
        });
    </script>
@endsection