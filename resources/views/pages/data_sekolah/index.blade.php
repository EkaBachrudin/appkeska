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
          <h1 class="m-0">Data Sekolah</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">data sekolah</a></li>
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
                        <div class="btn btn-primary"  data-toggle="modal" data-target="#modalSekolah" onclick="add()">Tambah data sekolah</div>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th> Nama Sekolahan </th>
                                    <th>Jenjang</th>
                                    <th> Lokasi </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($sekolahan as $sekolah)
                                    <tr>
                                        <td> {{$no++}} </td>
                                        <td> {{$sekolah->name}} </td>
                                        <td> {{$sekolah->jenjang}} </td>
                                        <td> {{$sekolah->lokasi}} </td>
                                        <th>
                                            <div class="btn text-primary" data-toggle="modal" data-target="#modalSekolah" onclick="edit({{$sekolah->id}})"><i class="far fa-edit"></i></div>
                                            <a href="/dataSekolah/delete/{{$sekolah->id}}" class="btn text-danger" onclick="return confirm('Are u sure delete this data ?')"><i class="far fa-trash-alt"></i></a>
                                        </th>
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
        <div class="modal fade" id="modalSekolah" tabindex="-1" role="dialog" aria-labelledby="modalSekolahLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalSekolahLabel">Tambah Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="form">
                        @csrf
                        <div class="form-group">
                            <label>Nama Seklolah</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                            @error('name') 
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jenjang</label>
                            <select name="jenjang" class="form-control @error('jenjang') is-invalid @enderror">
                                <option disabled selected> Pilih jenjang </option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                            </select>
                                @error('jenjang') 
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi">
                            @error('lokasi')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
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
        function edit(id){
            $('#modalSekolahLabel').text('Edit Data sekolah');
            $('#form').attr('action', ' ');
            $('#form').attr('action', '/dataSekolah/update/'+id);
            $('#form').find('input[name="name"]').val(' ');
            $('#form').find('select[name="jenjang"]').val(' ').change();
            $('#form').find('input[name="lokasi"]').val(' ');
            // Make a request for a user with a given ID
            axios.get('/dataSekolah/getData/'+id)
            .then(function (response) {
                const sekolah = response.data.sekolah;
                $('#form').find('input[name="name"]').val(sekolah.name);
                $('#form').find('select[name="jenjang"]').val(sekolah.jenjang).change();
                $('#form').find('input[name="lokasi"]').val(sekolah.lokasi);
                console.log(response);
            })
        }

        function add(){
            $('#modalSekolahLabel').text('Tambah data sekolah');
            $('#form').attr('action', ' ');
            $('#form').attr('action', '/dataSekolah/store');
            $('#form').find('input[name="name"]').val(' ');
            $('#form').find('select[name="jenjang"]').val(' ').change();
            $('#form').find('input[name="lokasi"]').val(' ');
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