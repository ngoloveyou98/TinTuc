@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loại Tin đã xóa
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                @if (session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif
                @if (session('thongbaoRestore'))
                    <div class="alert alert-success">
                        {{session('thongbaoRestore')}}

                    </div>
                @endif
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Tên Loại Tin</th>
                            <th>Thê Loại</th>
                            <th>Xóa hẳn</th>
                            <th>Khôi phục</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loaitin as $lt)
                        <tr class="even gradeC" align="center">
                            <td>{{$lt->id}}</td>
                            <td>{{$lt->Ten}}</td>
                            <td>{{$lt->theloai->Ten}}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/loaitin/danhsachxoa/xoa/{{$lt->id}}"> Xóa hẳn</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/loaitin/danhsachxoa/restore/{{$lt->id}}">Khôi phục</a></td>
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