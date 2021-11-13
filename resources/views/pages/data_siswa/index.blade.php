@extends("pages.master.master")
@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('body')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Siswa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">data siswa</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  

  
  <div class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="btn btn-primary"  data-toggle="modal" data-target="#modalSiswa" onclick="add()">Tambah data siswa</div>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <td> Sekolah </td>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($siswa as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td> {{$item->nis}} </td>
                                    <td> {{$item->name}} </td>
                                    <td> {{$item->kelas}} </td>
                                    <td> {{$item->sekolah->name}} </td>
                                    <td>
                                        <div class="btn text-primary" data-toggle="modal" data-target="#modalSiswa" onclick="edit({{$item->id}})"><i class="far fa-edit"></i></div>
                                        <a href="/dataSiswa/delete/{{$item->id}}" class="btn text-danger" onclick="return confirm('Are u sure delete this data ?')"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
          </div>
      </div>
</div>

    <!-- Modal -->
        <div class="modal fade" id="modalSiswa" tabindex="-1" role="dialog" aria-labelledby="modalSiswaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalSiswaLabel">Tambah Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="form">
                        @csrf
                        <div class="form-group">
                            <label> Pilih sekolah </label>
                            <select name="sekolah" class="form-control">
                                <option selected disabled>Pilih Sekolah</option>
                                @foreach ($sekolahan as $item)
                                <option value="{{$item->id}}"> {{$item->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" name="siswa" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>NIS</label>
                            <input type="text" name="nis" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <input type="text" name="kelas" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save data</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <script>
        //edit
        function edit(id){
            $('#modalSiswaLabel').text('Edit Data Siswa');
            $('#form').attr('action', ' ');
            $('#form').attr('action', '/dataSiswa/update/'+id);
            $('#form').find('input[name="siswa"]').val(' ');
            $('#form').find('input[name="kelas"]').val(' ');
            $('#form').find('input[name="nis"]').val(' ');
            $('#form').find('select[name="sekolah"]').val(' ').change();
            // Make a request for a user with a given ID
            axios.get('/dataSiswa/getData/'+id)
            .then(function (response) {
                console.log(response);
                const siswa = response.data.siswa;
                $('#form').find('input[name="siswa"]').val(siswa.name);
                $('#form').find('input[name="kelas"]').val(siswa.kelas);
                $('#form').find('input[name="nis"]').val(siswa.nis);
                $('#form').find('select[name="sekolah"]').val(siswa.sekolah_id).change();
            })
        }

        //add
        function add(){
            $('#modalSiswaLabel').text('Tambah data Siswa');
            $('#form').attr('action', ' ');
            $('#form').attr('action', '/dataSiswa/store');
            $('#form').find('input[name="siswa"]').val(' ');
            $('#form').find('input[name="kelas"]').val(' ');
            $('#form').find('input[name="nis"]').val(' ');
            $('#form').find('select[name="sekolah"]').val(' ').change();
        }

       
            $('.table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            });
       
    </script>
@endsection