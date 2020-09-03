@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">TinTuc
                    <small>danh sách</small>
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
                        <th>Tên</th>
                        <th>Hình ảnh</th>
                        <th>Nội Dung</th>
                        <th>link</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($slide as $sld)
                    <tr class="odd gradeX" align="center">
                        <td>{{$sld->id}}</td>
                        <td>
                            <p>{{$sld->Ten}}</p>
                            {{-- <img width="100px" src="uploai/tintuc/"> --}}
                        </td>
                        <td>
                            <img width="400px" src="upload/slide/{{ $sld->Hinh }}" alt="">
                        </td>
                        <td>{{$sld->NoiDung}}</td>
                        <td>{{$sld->link}}</td>
                    

                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/xoa/{{$sld->id}}"> Xóa</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/sua/{{$sld->id}}">Sửa</a></td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection