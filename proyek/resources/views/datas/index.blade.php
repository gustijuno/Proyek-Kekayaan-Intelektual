@include('layouts.navbar')

<link rel="stylesheet" type="text/css" href="table.css">
 <div class="row">
 <div class="col-lg-12 margin-tb">
 <div class="pull-left mt-2">
 <h2>Pendaftaran Insentif KI</h2>
 </div>
 <div class="float-right my-2">
 <div>
        <div class="mx-auto pull-right">
            <div class="">
                <form action="{{ route('datas.index') }}" method="GET" role="search">

                    <div class="input-group">
                        <span class="input-group-btn mr-5 mt-1">
                            <button class="btn btn-info" type="submit" title="Search names">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>
                        <input type="text" class="form-control mr-2" name="term" placeholder="Search names" id="term">
                        <a href="{{ route('datas.index') }}" class=" mt-1">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button" title="Refresh page">
                                    <span class="fas fa-sync-alt"></span>
                                </button>
                            </span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
 
 <a class="btn btn-success" href="{{ route('datas.create') }}"> Input Data</a>
 </div>
 </div>
 </div>
 
 @if ($message = Session::get('success'))
 <div class="alert alert-success">
 <p>{{ $message }}</p>
 </div>
 @endif
 
 <table class="table table-bordered">
 <tr>
 <th>Email</th>
 <th>Nama Lengkap</th>
 <th>NIDN</th>
 <th>Jurusan</th>
 <th>Program Studi</th>
 <th>No HP</th>
 <th>Jenis KI</th>
 <th>Judul KI </th>
 <th>No Sertifikat </th>
 <th>Pemegang Kekayaan Intelektual</th>
 <th>file Sertikat Hak Cipta atau Bukti pendaftaran Paten / Paten sederhana</th>
 <th>Surat Pernyataan Pengajuan Insentif</th>
 <th>Identitas Usulan Insentif KI</th>
 @if (Auth::user() && Auth::user()->name == 'Administrator')
 <th width="280px">Action</th>
 @elseif(Auth::user() && Auth::user()->name == 'UPT-P2M')
 <th width="280px">Action</th>
 @endif
 </tr>
 @foreach ($datas as $Data)
 <tr>
 
 <td >{{ $Data->email }}</td>
 <td>{{ $Data->nama }}</td>
 <td>{{ $Data->NIDN }}</td>
 <td>{{ $Data->jurusan->nama_jurusan}}</td>
 <td>{{ $Data->studi }}</td>
 <td>{{ $Data->hp }}</td>
 <td>{{ $Data->jenisKl }}</td>
 <td>{{ $Data->judulKl }}</td>
 <td>{{ $Data->noSertif }}</td>
 <td>{{ $Data->pemegangKl }}</td>
 <td>
 <a href="{{asset('storage/'.$Data->fileSertif)}}">Download File</a>
</td>
<td>
 <a href="{{asset('storage/'.$Data->filePernyataan)}}">Download File</a>
</td>
<td>
 <a href="{{asset('storage/'.$Data->fileIdentitas)}}">Download File</a>
</td>
 <td>
 <form action="{{ route('datas.destroy',$Data->id) }}" method="POST">
 
 @if (Auth::user() && Auth::user()->name == 'Administrator')
 <a class="btn btn-primary" href="{{ route('datas.edit',$Data->id) }}">Edit</a>
 @csrf @method('DELETE')
 <button type="submit" class="btn btn-danger">Delete</button>
 @elseif(Auth::user() && Auth::user()->name == 'UPT-P2M')
 <a class="btn btn-primary" href="{{ route('datas.edit',$Data->id) }}">Edit</a>
 @csrf @method('DELETE')
 <button type="submit" class="btn btn-danger">Delete</button>
 @endif
 </form>
 </td>
 </tr>
 @endforeach
 </table>
 <div class="d-flex">
    {{ $datas->links() }}
 




     





