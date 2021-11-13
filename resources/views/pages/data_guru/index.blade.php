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
          <h1 class="m-0">Data Guru</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">data guru</a></li>
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
                        <div class="btn btn-primary"  data-toggle="modal" data-target="#modalGuru" onclick="add()">Tambah data guru</div>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama guru</th>
                                    <th>NIP</th>
                                    <th>Sekolah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($guru as $item)
                                    <tr>
                                        <td> {{$no++}} </td>
                                        <td> {{$item->name}} </td>
                                        <td> {{$item->nip}} </td>
                                        <td> {{$item->sekolah->jenjang}} {{$item->sekolah->name}} </td>
                                        <td>
                                            <div class="btn text-primary" data-toggle="modal" data-target="#modalGuru" onclick="edit({{$item->id}})"><i class="far fa-edit"></i></div>
                                            <a href="/dataGuru/delete/{{$item->id}}" class="btn text-danger" onclick="return confirm('Are u sure delete this data ?')"><i class="far fa-trash-alt"></i></a>
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
        <div class="modal fade" id="modalGuru" tabindex="-1" role="dialog" aria-labelledby="modalGuruLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalGuruLabel">Tambah Guru</h5>
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
                                <option value="{{$item->id}}">{{$item->jenjang}} {{$item->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Guru</label>
                            <input type="text" name="guru" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" name="nip" class="form-control">
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
            $('#modalguruLabel').text('Edit Data Guru');
            $('#form').attr('action', ' ');
            $('#form').attr('action', '/dataGuru/update/'+id);
            $('#form').find('input[name="guru"]').val(' ');
            $('#form').find('select[name="sekolah"]').val(' ').change();
            $('#form').find('input[name="nip"]').val(' ');
            // Make a request for a user with a given ID
            axios.get('/dataGuru/getData/'+id)
            .then(function (response) {
                console.log(response);
                const guru = response.data.guru;
                $('#form').find('input[name="guru"]').val(guru.name);
                $('#form').find('select[name="sekolah"]').val(guru.sekolah_id).change();
                $('#form').find('input[name="nip"]').val(guru.nip);
            })
        }

        //add
        function add(){
            $('#modalguruLabel').text('Tambah data Guru');
            $('#form').attr('action', ' ');
            $('#form').attr('action', '/dataGuru/store');
            $('#form').find('input[name="guru"]').val(' ');
            $('#form').find('select[name="sekolah"]').val(' ').change();
            $('#form').find('input[name="nip"]').val(' ');
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