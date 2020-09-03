 @extends('admin.layout.index')
 @section('content')
 <!-- Page Content -->
  <div id="page-wrapper">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12">
                  <h1 class="page-header">Tin Tức
                      <small>Danh sách</small>
                  </h1>
              </div>
              @if (session('thongbao'))
                  <div class="alert alert-success">
                        {{ session('thongbao') }}
                  </div>
              @endif
              <!-- /.col-lg-12 -->
              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                      <tr align="center">
                          <th>ID</th>
                          <th>Tên Loại Tin</th>
                          <th>Thể Loại</th>
        
                          <th>Xóa</th>
                          <th>Sửa</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($loaitin as $lt)
                      <tr class="even gradeC" align="center">
                        <td>{{$lt->id}}</td>
                        <td>{{$lt->Ten}}</td>
                        <td>{{$lt->theloai->Ten}}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/loaitin/xoa/{{$lt->id}}"> Xóa</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/loaitin/sua/{{$lt->id}}">Sửa</a></td>
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