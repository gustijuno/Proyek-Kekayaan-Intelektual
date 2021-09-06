<?php

namespace App\Http\Controllers;
use App\Models\Data;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = Data::where([
            ['nama', '!=', Null],
            [function ($query) use ($request){
                if(($term = $request->term)){
                    $query->orWhere('nama', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
            ->orderBy('id', 'desc')
            ->paginate(5);
        return view('datas.index', compact('datas'));
        with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusan = Jurusan::all(); //mendapatkan data dari tabel
        return view('datas.create',['jurusan' =>$jurusan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'nama' => 'required',
            'NIDN' => 'required',
            'studi' => 'required',
            'hp' => 'required',
            'jenisKl' => 'required',
            'judulKl' => 'required',
            'noSertif' => 'required',
            'pemegangKl' => 'required',
            'file1' => 'required',
            'file2' => 'required',
            'file3' => 'required'

        ]);
       
        $data = new Data;
        $data->email = $request->get('email');
        $data->nama = $request->get('nama');
        $data->NIDN = $request->get('NIDN');
        $data->studi = $request->get('studi');
        $data->hp = $request->get('hp');
        $data->jenisKl = $request->get('jenisKl');
        $data->judulKl = $request->get('judulKl');
        $data->noSertif = $request->get('noSertif');
        $data->pemegangKl = $request->get('pemegangKl');
        //file1
        if ($request->file('file1')) {
            $file1_name = $request->file('file1')->store('files1', 'public');
        }
        $data->fileSertif = $file1_name;

        //file2
        if ($request->file('file2')) {
            $file2_name = $request->file('file2')->store('files2', 'public');
        }
        $data->filePernyataan = $file2_name;

        //file3
        if ($request->file('file3')) {
            $file3_name = $request->file('file3')->store('files3', 'public');
        }
        $data->fileIdentitas = $file3_name;
        //$mahasiswa->save();

        $jurusan = new Jurusan;
        $jurusan->id = $request->get('Jurusan');

        //fungsi eloquent untuk menambhkan data dengan relaasi belongso
        $data->jurusan()->associate($jurusan);
        $data->save();

        return redirect()->route('datas.index')
            ->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Data = Data::with('jurusan')->where('id', $id)->first();
        $jurusan = Jurusan::all();
        return view('datas.edit', compact('Data', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required',
            'nama' => 'required',
            'NIDN' => 'required',
            'studi' => 'required',
            'hp' => 'required',
            'jenisKl' => 'required',
            'judulKl' => 'required',
            'noSertif' => 'required',
            'pemegangKl' => 'required',
        ]);
        $data = Data::with('jurusan')->where('id', $id)->first();
        $data->email = $request->get('email');
        $data->nama = $request->get('nama');
        $data->NIDN = $request->get('NIDN');
        $data->hp = $request->get('hp');
        $data->jenisKl = $request->get('jenisKl');
        $data->judulKl = $request->get('judulKl');
        $data->noSertif = $request->get('noSertif');
        $data->pemegangKl = $request->get('pemegangKl');
        //file1
        if($data->file1 && file_exists('app/public/' . $data->fileSertif)) {
            \Storage::delete('public/' . $data->fileSertif);
        }
        $file1_name = $request->file('file1')->store('files1', 'public');
        $data->fileSertif = $file1_name;

        //file2
        if($data->file2 && file_exists('app/public/' . $data->filePernyataan)) {
            \Storage::delete('public/' . $data->filePernyataan);
        }
        $file2_name = $request->file('file2')->store('files2', 'public');
        $data->filePernyataan = $file2_name;

        //file3
        if($data->file3 && file_exists('app/public/' . $data->fileIdentitas)) {
            \Storage::delete('public/' . $data->fileIdentitas);
        }
        $file3_name = $request->file('file3')->store('files3', 'public');
        $data->fileIdentitas = $file3_name;
        //$mahasiswa->save();

        $jurusan = new Jurusan;
        $jurusan->id = $request->get('Jurusan');

        //fungsi eloquent untuk menambhkan data dengan relaasi belongso
        $data->jurusan()->associate($jurusan);
        $data->save();


        return redirect()->route('datas.index')
            ->with('success', 'Data Berhasil Diupdate');
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Data::find($id)->delete();

        return redirect()->route('datas.index')
            -> with('success', 'Data Berhasil Dihapus');
    }
}
