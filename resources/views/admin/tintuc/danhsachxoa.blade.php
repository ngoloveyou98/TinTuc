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
              @if (session('thongbaoRestore'))
                  <div class="alert alert-success">
                        {{ session('thongbaoRestore') }}
                  </div>
              @endif
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Tóm tắt</th>
                        <th>Loại tin</th>
                        <th>Thể loại</th>
                        <th>Hình ảnh</th>
                        <th>Nổi bật</th>
                        <th>Xem</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tintuc as $tt)
                    <tr class="odd gradeX" align="center">
                        <td>{{$tt->id}}</td>
                        <td>
                            <p>{{$tt->TieuDe}}</p>
                            {{-- <img width="100px" src="uploai/tintuc/8.jpg"> --}}
                        </td>
                        <td>{{$tt->TomTat}}</td>
                        <td>{{$tt->loaitin->Ten}}</td>
                        <td>{{$tt->loaitin->theloai->Ten}}</td>
                        <td>
                             <img width="100px" src="upload/tintuc/{{ $tt->Hinh }}"> 
                        </td>
                        <td>
                            @if ($tt->NoiBat != 0)
                                {{ 'Có' }}
                            @else
                                {{ 'Không' }}
                            @endif
                        </td>
                        <td>{{$tt->SoLuotXem}}</td>

                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/danhsachxoa/xoa/{{$tt->id}}"> Xóa</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/danhsachxoa/khoiphuc/{{$tt->id}}">Khôi phục</a></td>
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