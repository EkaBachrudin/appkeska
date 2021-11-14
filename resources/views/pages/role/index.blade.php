@extends("pages.master.master")
@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('body')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Roles</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">role</a></li>
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
                        <div class="btn btn-primary"  data-toggle="modal" data-target="#modalRole" onclick="add()">Tambah data role</div>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th> Nama Role </th>
                                    <th> Permission </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td> {{$role->name}} </td>
                                    <td>
                                        @if ($role->rolePolice->data_siswa == 1)
                                        <i class="m-1 btn btn-info btn-sm">siswa</i>
                                        @endif
                                        @if ($role->rolePolice->data_fasilitas == 1)
                                        <i class="m-1 btn btn-secondary btn-sm">fasilitas</i>
                                        @endif
                                        @if ($role->rolePolice->data_sekolah == 1)
                                        <i class="m-1 btn btn-primary btn-sm">sekolah</i>
                                        @endif
                                        @if ($role->rolePolice->data_guru == 1)
                                        <i class="m-1 btn btn-warning btn-sm">guru</i>
                                        @endif
                                        @if ($role->rolePolice->role_permission == 1)
                                        <i class="m-1 btn btn-danger btn-sm">role</i>
                                        @endif
                                    </td>
                                    <th>
                                        <div class="btn text-primary" data-toggle="modal" data-target="#modalRole" onclick="edit({{$role->id}})"><i class="far fa-edit"></i></div>
                                        <a href="/role/delete/{{$role->id}}" class="btn text-danger" onclick="return confirm('Are u sure delete this data ?')"><i class="far fa-trash-alt"></i></a>
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
        <div class="modal fade" id="modalRole" tabindex="-1" role="dialog" aria-labelledby="modalRoleLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalRoleLabel">Tambah Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="form">
                        @csrf
                        <div class="form-group">
                            <label>Role Name</label>
                            <input type="text" name="role" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Pilih sekolah <small class="text-danger">*role hanya dapat melihat data-data sekolah yg di pilih</small></label>
                            <select name="sekolah[]" id="" class="form-control select2" multiple>
                                @foreach ($sekolah as $item)
                                <option value="{{$item->id}}"> {{$item->jenjang}} {{$item->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <label>Select menu</label>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="dataSiswa">
                                    <label class="form-check-label">Data Siswa</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="dataFasilitas">
                                    <label class="form-check-label">Data Fasilitas</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="dataSekolah">
                                    <label class="form-check-label">Data Sekolah</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="dataGuru">
                                    <label class="form-check-label">Data guru</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="rolepermission">
                                    <label class="form-check-label">Role Permission</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="user">
                                    <label class="form-check-label">User</label>
                                </div>
                            </div>
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
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

    <script>
        $('.select2').select2({
            theme: 'bootstrap4'
        })
        function edit(id){
            $('#modalRoleLabel').text('Edit Data sekolah');
            $('#form').attr('action', ' ');
            $('#form').attr('action', '/role/update/'+id);
            $('#form').find('input[name="role"]').val(' ');
            $('#form').find('select[name="sekolah[]"]').val(' ').change();
            $('#form').find('input[name="dataSiswa"]').prop('checked', false);
            $('#form').find('input[name="dataFasilitas"]').prop('checked', false);
            $('#form').find('input[name="dataSekolah"]').prop('checked', false);
            $('#form').find('input[name="dataGuru"]').prop('checked', false);
            $('#form').find('input[name="rolepermission"]').prop('checked', false);
            $('#form').find('input[name="user"]').prop('checked', false);
            // Make a request for a user with a given ID
            axios.get('/role/getData/'+id)
            .then(function (response) {
                const role          = response.data.role;
                const rolePolice    = response.data.rolePolice;
                $('#form').find('input[name="role"]').val(role.name);
                rolePolice.data_siswa       == 1 ? $('#form').find('input[name="dataSiswa"]').prop('checked', true) : $('#form').find('input[name="dataSiswa"]').prop('checked', false);
                rolePolice.data_fasilitas   == 1 ? $('#form').find('input[name="dataFasilitas"]').prop('checked', true) : $('#form').find('input[name="dataFasilitas"]').prop('checked', false);
                rolePolice.data_sekolah     == 1 ? $('#form').find('input[name="dataSekolah"]').prop('checked', true) : $('#form').find('input[name="dataSekolah"]').prop('checked', false);
                rolePolice.data_guru        == 1 ? $('#form').find('input[name="dataGuru"]').prop('checked', true) : $('#form').find('input[name="dataGuru"]').prop('checked', false); 
                rolePolice.role_permission  == 1 ? $('#form').find('input[name="rolepermission"]').prop('checked', true) : $('#form').find('input[name="rolepermission"]').prop('checked', false);
                rolePolice.user             == 1 ? $('#form').find('input[name="user"]').prop('checked', true) : $('#form').find('input[name="user"]').prop('checked', false);
                const roleSekolah   = response.data.roleSekolah;
                var selected = [];
                roleSekolah.forEach(element => {
                    selected.push(element.sekolah_id);
                });
                $('#form').find('select[name="sekolah[]"]').val(selected).trigger("change");
                console.log(response);
            })
        }

        function add(){
            $('#modalRoleLabel').text('Tambah data role');
            $('#form').attr('action', ' ');
            $('#form').attr('action', '/role/store');
            $('#form').find('input[name="role"]').val(' ');
            $('#form').find('select[name="sekolah[]"]').val(' ').change();
            $('#form').find('input[name="dataSiswa"]').prop('checked', false);
            $('#form').find('input[name="dataFasilitas"]').prop('checked', false);
            $('#form').find('input[name="dataSekolah"]').prop('checked', false);
            $('#form').find('input[name="dataGuru"]').prop('checked', false);
            $('#form').find('input[name="rolepermission"]').prop('checked', false);
            $('#form').find('input[name="user"]').prop('checked', false);
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