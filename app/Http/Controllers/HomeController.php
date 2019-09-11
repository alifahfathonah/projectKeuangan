<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengeluaranModels;
use App\KeuanganModels;
use App\PenggajianModels;
use App\TransModels;
use App\WaktuModel;
use DB;
use Session;
use Str;
use Hash;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $r)
    {
       
        $dasles  = KeuanganModels::where('jenis', 'les')
        ->where('tgl_bayar', 'LIKE', '%'.date('Y-m').'%')
        ->get();
        $dasprog = KeuanganModels::where('jenis', 'pprogram')
        ->where('tgl_bayar', 'LIKE', '%'.date('Y-m').'%')
        ->get();
        $dasjasa = KeuanganModels::where('jenis', 'jasa')
        ->where('tgl_bayar', 'LIKE', '%'.date('Y-m').'%')
        ->get();
        $kridithariles = KeuanganModels::where('tgl_kridit', 'LIKE','%'.date('Y-m-d').'%')
        ->where('status','kridit')
        ->where('jenis','les')
        ->get();
        $kriditbulanles = KeuanganModels::where('tgl_kridit', 'LIKE','%'.date('Y-m').'%')
        ->where('status','kridit')
        ->where('jenis','les')
        ->get();
        $kridittahunles = KeuanganModels::where('tgl_kridit', 'LIKE','%'.date('Y').'%')
        ->where('status','kridit')
        ->where('jenis','les')
        ->get();
        $kridithariprog = KeuanganModels::where('tgl_kridit', 'LIKE','%'.date('Y-m-d').'%')
        ->where('status','kridit')
        ->where('jenis','pprogram')
        ->get();
        $kriditbulanprog = KeuanganModels::where('tgl_kridit', 'LIKE','%'.date('Y-m').'%')
        ->where('status','kridit')
        ->where('jenis','pprogram')
        ->get();
        $kridittahunprog = KeuanganModels::where('tgl_kridit', 'LIKE','%'.date('Y').'%')
        ->where('status','kridit')
        ->where('jenis','pprogram')
        ->get();
        $cekbulan = WaktuModel::where('tgl','LIKE','%'.date('Y-m').'%')
        ->get();
        $cektahun = WaktuModel::GroupBy(DB::raw('YEAR(tgl),MONTH(tgl)'))
         ->select(DB::raw('YEAR(tgl) as tahun,MONTH(tgl) as bulan'))
        ->where('tgl','LIKE','%'.date('Y').'%')
        ->get();
        $datacombo = KeuanganModels::GroupBy(DB::raw('YEAR(tgl_bayar),MONTH(tgl_bayar)'))
         ->select(DB::raw('YEAR(tgl_bayar) as tahun,MONTH(tgl_bayar) as bulan'))
         ->orderBy('tgl_bayar', 'desc')
         ->get();
         $datacombotahun = KeuanganModels::GroupBy(DB::raw('YEAR(tgl_bayar)'))
         ->select(DB::raw('YEAR(tgl_bayar) as tahun'))
         ->orderBy('tgl_bayar', 'desc')
         ->get();
         $cektahunvalue = @$r->caritahun ? @$r->caritahun : '';
         $cekbulanvalue = @$r->cari ? @$r->cari : '';
         if(@$r->cari)
         {
            $cekbulan = WaktuModel::where('tgl','LIKE','%'.$r->cari.'%')
            ->get();
            // dd($cekbulanvalue);
         }
         elseif(@$r->caritahun)
         {
            $cektahun = WaktuModel::GroupBy(DB::raw('YEAR(tgl),MONTH(tgl)'))
            ->select(DB::raw('YEAR(tgl) as tahun,MONTH(tgl) as bulan'))
            ->where('tgl','LIKE','%'.$r->caritahun.'%')
            ->get();
         }
        return view('home.section.index',
            compact(
                'dasjasa',
                'dasprog',
                'dasles',
                'kridithariles',
                'kriditbulanles',
                'kridittahunles',
                'kridithariprog',
                'kriditbulanprog',
                'kridittahunprog',
                'cekbulan',
                'cektahun',
                'cekbulanvalue',
                'cektahunvalue',
                'datacombo',
                'datacombotahun'
            ));
    }
    public function pengeluaran()
    {
         $cekhari = PengeluaranModels::where('tanggal', 'LIKE','%'.date('Y-m-d').'%')->get();
         $cekbulan = PengeluaranModels::where('tanggal', 'LIKE','%'.date('Y-m').'%')->get();
         $cektahun = PengeluaranModels::where('tanggal', 'LIKE','%'.date('Y').'%')->get();
         $hariini  = PengeluaranModels::where('tanggal', 'LIKE','%'.date('Y-m-d').'%')->get();
        return view('home.section.input.pengeluaran', compact('cekhari', 'cektahun', 'cekbulan','hariini'));
    }
    public function svpengeluaran(Request $r)
    {
        $r->validate([
            'nama_kpn'  => 'required',
            'jumlah'    => 'required',
            'total'     => 'required',
            'tanggal'   => 'required',
            'level'   => 'required',
        ]);
        $input = $r->all();
        $input['total'] = str_replace(".", "", $r->total);
        $save = PengeluaranModels::create($input);
        if($save)
        {
            Session::flash('sukses', 'data berhasi disimpan!');
        }
        else
        {
            Session::flash('gagal', 'data gagal  disimpan!');
        }
        return back();
    }
    public function jasa()
    {
        $lunashari = TransModels::join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('keuangan_models.jenis','jasa')
         ->where('keuangan_models.status','tunai')
         ->where('trans_models.tglbayar', 'LIKE', '%'.date('Y-m-d').'%')
         ->get();
         $lunasbulan = TransModels::GroupBy(DB::raw('YEAR(tglbayar),MONTH(tglbayar)'))
         ->select(DB::raw('YEAR(tglbayar) as tahun,MONTH(tglbayar) as bulan,sum(jlmbayar) as totalgr'))
         ->join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('keuangan_models.jenis','jasa')
         ->where('keuangan_models.status','tunai')
         ->get();
         $lunastahun = TransModels::GroupBy('tahun')
         ->select(DB::raw('YEAR(tglbayar) as tahun, sum(jlmbayar) as totalgr'))
         ->join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('keuangan_models.jenis','jasa')
         ->where('keuangan_models.status','tunai')
         ->get();
         $kridithari = KeuanganModels::where('tgl_kridit', 'LIKE','%'.date('Y-m-d').'%')
         ->where('status','kridit')
         ->where('jenis','jasa')
         ->get();
         $kriditbulan = KeuanganModels::where('tgl_kridit', 'LIKE','%'.date('Y-m').'%')
         ->where('status','kridit')
         ->where('jenis','jasa')
         ->get();
         $kridittahun = KeuanganModels::where('tgl_kridit', 'LIKE','%'.date('Y').'%')
         ->where('status','kridit')
         ->where('jenis','jasa')
         ->get();
         $hariini  = TransModels::join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('keuangan_models.jenis','jasa')
         ->where('trans_models.tglbayar', 'LIKE', '%'.date('Y-m-d').'%')
         ->get();
        return view('home.section.input.jasa' ,
            compact(
                'lunashari',
                'lunasbulan',
                'lunastahun',
                'kridithari',
                'kriditbulan',
                'kridittahun',
                'hariini'
            ));
    }
    public function svjasa(Request $r)
    {
        $harga = str_replace(".", "", $r->harga);
        $r->validate([
            'nama'           => 'required',
            'harga'          => 'required',
            'keterangan'     => 'required',
        ]);
        $input             = new KeuanganModels();
        $input->nama       = $r->nama;
        $input->jenis      = 'jasa';
        $input->type       = 'Jasa';
        $input->status     = 'tunai';
        $input->harga      = $harga;
        $input->bayar      = $harga;
        $input->nohp       = $r->nohp;
        $input->tgl_bayar  = $r->tgl_bayar;
        $input->tgl_lunas  = $r->tgl_bayar;
        $input->keterangan = $r->keterangan;
        $input->save();
        $cc = KeuanganModels::orderBy('id_trans', 'desc')
        ->first();
        $trans             = new TransModels();
        $trans->tglbayar   = $cc->tgl_bayar;
        $trans->id_trans   = $cc->id_trans;
        $trans->jlmbayar   = $cc->bayar;
        $trans->save();
         if($input)
        {
            Session::flash('sukses', 'data berhasil disimpan!');
        }
        else
        {
            Session::flash('gagal', 'data gagal disimpan!');
        }
        return back();
    }
    public function les()
    {
         $lunashari = TransModels::join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('keuangan_models.jenis','les')
         ->where('keuangan_models.status','tunai')
         ->where('trans_models.tglbayar', 'LIKE', '%'.date('Y-m-d').'%')
         ->get();
         $lunasbulan = TransModels::GroupBy(DB::raw('YEAR(tglbayar),MONTH(tglbayar)'))
         ->select(DB::raw('YEAR(tglbayar) as tahun,MONTH(tglbayar) as bulan,sum(jlmbayar) as totalgr'))
         ->join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('keuangan_models.jenis','les')
         ->where('keuangan_models.status','tunai')
         ->get();
         $lunastahun = TransModels::GroupBy('tahun')
         ->select(DB::raw('YEAR(tglbayar) as tahun, sum(jlmbayar) as totalgr'))
         ->join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('keuangan_models.jenis','les')
         ->where('keuangan_models.status','tunai')
         ->get();
         $kridithari = KeuanganModels::where('tgl_kridit', 'LIKE','%'.date('Y-m-d').'%')
         ->where('status','kridit')
         ->where('jenis','les')
         ->get();
         $kriditbulan = KeuanganModels::where('tgl_kridit', 'LIKE','%'.date('Y-m').'%')
         ->where('status','kridit')
         ->where('jenis','les')
         ->get();
         $kridittahun = KeuanganModels::where('tgl_kridit', 'LIKE','%'.date('Y').'%')
         ->where('status','kridit')
         ->where('jenis','les')
         ->get();
         $hariini  = TransModels::join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('keuangan_models.jenis','les')
         ->where('trans_models.tglbayar', 'LIKE', '%'.date('Y-m-d').'%')
         ->get();
        return view('home.section.input.les' ,
            compact(
                'lunashari',
                'lunasbulan',
                'lunastahun',
                'kridithari',
                'kriditbulan',
                'kridittahun',
                'hariini'
            ));
    }
    public function updles($id)
    {
         $cekdata = KeuanganModels::find($id);
         $hariini  = TransModels::where('id_trans', $id)->get();
        return view('home.section.input.uples' ,
            compact(
                'hariini',
                'cekdata'
            ));
    }
    public function svles(Request $r)
    {
        $r->validate([
            'nama'           => 'required',
            'harga'          => 'required',
            'keterangan'     => 'required',
        ]);
        $input             = new KeuanganModels();
        $input->nama       = $r->nama;
        $input->jenis      = 'les';
        $input->type       = 'Les';
        $input->nohp       = $r->nohp;
        $input->status     = $r->status;
        $input->tgl_bayar  = $r->tgl_bayar;
        if($r->status == 'kridit')
        {
            $input->tgl_kridit = date('Y-m-d', strtotime('+4 days', strtotime($r->tgl_bayar)));
        }
        else
        {
            $input->tgl_lunas = $r->tgl_bayar;
        }
        $input->harga      = str_replace(".", "", $r->harga);
        $input->bayar      = str_replace(".", "", $r->bayar);
        $input->keterangan = $r->keterangan;
        $input->save();
        $cc = KeuanganModels::orderBy('id_trans', 'desc')
        ->first();
        $trans             = new TransModels();
        $trans->tglbayar   = $cc->tgl_bayar;
        $trans->id_trans   = $cc->id_trans;
        $trans->jlmbayar   = $cc->bayar;
        $trans->save();
        if($input)
        {
            Session::flash('sukses', 'data berhasi disimpan!');
        }
        else
        {
            Session::flash('gagal', 'data gagal disimpan!');
        }
        return back();
    }
    public function uples(Request $r, $id)
    {
        $status = '';
        $angka = 0;
        $bayar = str_replace(".", "", $r->bayar);
        $cek = TransModels::where('id_trans', $id)->get();
        foreach($cek as $ck)
        {
            $angka += $ck->jlmbayar;
        }
        $tambah = $bayar + $angka;
        $input             = KeuanganModels::find($id);
        if($tambah >= $input->harga)
        {
            $status = 'tunai';
        }
        else
        {
            $status = $r->status;
        }
        $input->nama       = $r->nama;
        $input->bayar      = $bayar;
        $input->status     = $status;
        if($r->status == 'kridit')
        {
            $input->tgl_kridit = date('Y-m-d', strtotime('+4 days', strtotime($r->tgl_bayar)));
        }
        else
        {
            $input->tgl_lunas = date('Y-m-d');
        }
        $input->keterangan = $r->keterangan;
        $input->update();
        $cc = KeuanganModels::find($id);
        $trans             = new TransModels();
        $trans->tglbayar   = $r->tgl_bayar;
        $trans->id_trans   = $cc->id_trans;
        $trans->jlmbayar   = $cc->bayar;
        $trans->save();
         if($input)
        {
            Session::flash('sukses', 'data berhasi diupdate!');
        }
        else
        {
            Session::flash('gagal', 'data gagal diupdate!');
        }
        return redirect('/home/keuangan/les');
    }
    public function pprogram()
    {
        $url = $_SERVER['REQUEST_URI'];
        $costem = "";
        if($url == '/home/keuangan/program/mahasiswa')
        {
            $costem = "mahasiswa";
        }
        elseif($url == '/home/keuangan/program/pemerintah/swasta')
        {
            $costem = "pemeswas";
        }
         $lunashari = TransModels::join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('keuangan_models.jenis','pprogram')
         ->where('keuangan_models.status','tunai')
         ->where('keuangan_models.costem',$costem)
         ->where('trans_models.tglbayar', 'LIKE', '%'.date('Y-m-d').'%')
         ->get();
         $lunasbulan = TransModels::GroupBy(DB::raw('YEAR(tglbayar),MONTH(tglbayar)'))
         ->select(DB::raw('YEAR(tglbayar) as tahun,MONTH(tglbayar) as bulan,sum(jlmbayar) as totalgr'))
         ->join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('keuangan_models.jenis','pprogram')
         ->where('keuangan_models.status','tunai')
         ->where('keuangan_models.costem',$costem)
         ->get();
         $lunastahun = TransModels::GroupBy('tahun')
         ->select(DB::raw('YEAR(tglbayar) as tahun, sum(jlmbayar) as totalgr'))
         ->join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('keuangan_models.jenis','pprogram')
         ->where('keuangan_models.status','tunai')
         ->where('keuangan_models.costem',$costem)
         ->get();
         $kridithari = KeuanganModels::where('tgl_kridit', 'LIKE','%'.date('Y-m-d').'%')
         ->where('status','kridit')
         ->where('jenis','pprogram')
         ->where('keuangan_models.costem',$costem)
         ->get();
         $kriditbulan = KeuanganModels::where('tgl_kridit', 'LIKE','%'.date('Y-m').'%')
         ->where('status','kridit')
         ->where('jenis','pprogram')
         ->where('keuangan_models.costem',$costem)
         ->get();
         $kridittahun = KeuanganModels::where('tgl_kridit', 'LIKE','%'.date('Y').'%')
         ->where('status','kridit')
         ->where('jenis','pprogram')
         ->where('keuangan_models.costem',$costem)
         ->get();
         $hariini  = TransModels::join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('keuangan_models.jenis','pprogram')
         ->where('keuangan_models.costem',$costem)
         ->where('trans_models.tglbayar', 'LIKE', '%'.date('Y-m-d').'%')
         ->get();
        return view('home.section.input.pprogram',
         compact(
            'lunashari',
            'lunasbulan',
            'lunastahun',
            'kridithari',
            'kriditbulan',
            'kridittahun',
            'hariini',
            'costem'
        ));
    }
    public function svpprogram(Request $r)
    {
        $input             = new KeuanganModels();
        $input->nama       = $r->nama;
        $input->jenis      = 'pprogram';
        $input->type       = 'Pembuatan Program';
        $input->status     = $r->status;
        $input->costem     = $r->costem;
        $input->tgl_bayar  = $r->tgl_bayar;
        if($r->status == 'kridit')
        {
            if($r->costem == 'mahasiswa')
            {
              $input->tgl_kridit = date('Y-m-d', strtotime('+5 days', strtotime($r->tgl_bayar)));
            }
            else
            {
                $input->tgl_kridit = date('Y-m-d', strtotime('+31 days', strtotime($r->tgl_bayar)));
            }

        }
        else
        {
            $input->tgl_lunas = $r->tgl_bayar;
        }
        $input->harga      = str_replace(".", "", $r->harga);
        $input->bayar      = str_replace(".", "", $r->bayar);
        $input->nohp       = $r->nohp;
        $input->keterangan = $r->keterangan;
        $input->save();
        $cc = KeuanganModels::orderBy('id_trans', 'desc')->first();
        $trans             = new TransModels();
        $trans->tglbayar   = $cc->tgl_bayar;
        $trans->id_trans   = $cc->id_trans;
        $trans->jlmbayar   = $cc->bayar;
        $trans->save();
        if($input)
        {
            Session::flash('sukses', 'data berhasi disimpan!');
        }
        else
        {
            Session::flash('gagal', 'data gagal disimpan!');
        }
        return back();
    }
    public function editpprogram($id)
    {
        $hariini  = TransModels::where('id_trans', $id)->get();
         $cekdata = KeuanganModels::find($id);
        return view('home.section.input.upprogram',
         compact(
            'hariini',
            'cekdata'
        ));
    }
    public function uppprogram(Request $r, $id)
    {
        $status = '';
        $angka = 0;
        $bayar = str_replace(".", "", $r->bayar);
        $cek = TransModels::where('id_trans', $id)->get();
        foreach($cek as $ck)
        {
            $angka += $ck->jlmbayar;
        }
        $tambah = $bayar + $angka;
        $input             = KeuanganModels::find($id);
        if($tambah >= $input->harga)
        {
            $status = 'tunai';
        }
        else
        {
            $status = $r->status;
        }
        $input->nama       = $r->nama;
        $input->status     = $status;
        $input->bayar      = $bayar;
        $input->tgl_bayar  = $r->tgl_bayar;
        if($status == 'kridit')
        {
            if($input->costem == 'mahasiswa')
            {
              $input->tgl_kridit = date('Y-m-d', strtotime('+5 days', strtotime($r->tgl_bayar)));
            }
            else
            {
                $input->tgl_kridit = date('Y-m-d', strtotime('+31 days', strtotime($r->tgl_bayar)));
            }
        }
        else
        {
            $input->tgl_lunas = $r->tgl_bayar;
        }
        $input->keterangan = $r->keterangan;
        $input->Update();
        $cc = KeuanganModels::find($id);
        $trans             = new TransModels();
        $trans->tglbayar   = $r->tgl_bayar;
        $trans->id_trans   = $cc->id_trans;
        $trans->jlmbayar   = $cc->bayar;
        $trans->save();
        if($input)
        {
            Session::flash('sukses', 'data berhasi diupdate!');
        }
        else
        {
            Session::flash('gagal', 'data gagal diupdate!');
        }
        return redirect('/home/pencarian/data');
    }
    public function penggajian()
    {
        $datapgn = PenggajianModels::orderBy('tglbayar', 'desc')->get();
        return view('home.section.input.pengajian',
            compact(
                'datapgn'
            ));
    }
    public function svpenggajian(Request $r)
    {
        //dd(str_replace(".", "", $r->jumlah));
        $r->validate([
            'tglbayar'          => 'required',
            'keteranggan'       => 'required',
            'jumlah'            => 'required',
        ]);
        $input = $r->all();
        $input['jumlah'] = str_replace(".", "", $r->jumlah);
        $savedata = PenggajianModels::create($input);
        if($savedata)
        {
            Session::flash('sukses', 'data berhasi disimpan!');
        }
        else
        {
            Session::flash('gagal', 'data gagal disimpan!');
        }
        return back();
    }
    public function editpenggajian($id)
    {
        $cekdata = PenggajianModels::find($id);
        return view('home.section.input.uppenggajian',
            compact(
                'cekdata'
            ));
    }
    public function uppenggajian(Request $r, $id)
    {
        $up              = PenggajianModels::find($id);
        $up->keteranggan = $r->keteranggan;
        $up->tglbayar    = $r->tglbayar;
        $up->jumlah      = str_replace(".", "", $r->jumlah);
        $up->update();
        if($up)
        {
            Session::flash('sukses', 'data berhasi diupdate!');
        }
        else
        {
            Session::flash('gagal', 'data gagal diupdate!');
        }
        return redirect('/home/keuangan/penggajian');
    }
    public function delpenggajian($id)
    {
        $del = PenggajianModels::find($id);
        $del->delete();
        if($del)
        {
            Session::flash('sukses', 'data berhasi dihapus!');
        }
        else
        {
            Session::flash('gagal', 'data gagal dihapus!');
        }
        return back();

    }
    public function lharian(Request $r)
    {
        if(auth()->user()->level != 'Pimpinan')
        {
            return redirect('/home');
        }
        $datacombo = TransModels::GroupBy('tglbayar')->select('tglbayar')
         ->join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('trans_models.tglbayar', 'LIKE', '%'.date('Y-m').'%')
         ->orderBy('tglbayar', 'desc')
         ->get();
        $cekdata = TransModels::join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('trans_models.tglbayar', 'LIKE', '%'.date('Y-m-d').'%')
         ->orderBy('trans_models.tglbayar', 'asc')
         ->get();
         $tangal = date('Y-m-d');
         $dari = @$r->dari ? @$r->dari : '';
         $sampai = @$r->sampai ? @$r->sampai : '';
         if($r->cari)
         {
            $tangal = $r->cari;
         }
         if(@$r->btncari)
         {
            $cekdata = TransModels::join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
            ->whereBetween('trans_models.tglbayar', [$dari, $sampai])
            ->orderBy('trans_models.tglbayar', 'asc')
            ->get();
         }
         elseif(@$r->btncetak)
         {
            $cekdata = TransModels::join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
            ->whereBetween('trans_models.tglbayar', [$dari, $sampai])
            ->get();
            return view('home.section.output.charian',
            compact(
                'cekdata',
                'tangal'
            ));
         }
        return view('home.section.output.harian',
            compact(
                'cekdata',
                'datacombo',
                'tangal',
                'dari',
                'sampai'
            ));
    }

    public function lbulanan(Request $r)
    {
        if(auth()->user()->level != 'Pimpinan')
        {
            return redirect('/home');
        }
        $datacombo = TransModels::GroupBy(DB::raw('YEAR(tglbayar),MONTH(tglbayar)'))
         ->select(DB::raw('YEAR(tglbayar) as tahun,MONTH(tglbayar) as bulan,sum(jlmbayar) as totalgr'))
         ->join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->orderBy('tglbayar', 'desc')
         ->get();
        $cekdata = TransModels::join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('trans_models.tglbayar', 'LIKE', '%'.date('Y-m').'%')
         ->orderBy('tglbayar', 'asc')
         ->get();
         $cekdatakusus = TransModels::join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('trans_models.tglbayar', 'LIKE', '%'.date('Y-m').'%')
         ->orderBy('tglbayar', 'asc')
         ->where('keuangan_models.costem', 'pemeswas')
         ->get();
         $tangal = date('Y-m');
         if($r->cari)
         {
            $tangal = $r->cari;
         }
         if(@$r->btncari)
         {
            $cekdata = TransModels::join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
             ->where('trans_models.tglbayar', 'LIKE', '%'.$r->cari.'%')
             ->get();
             // dd($cekdata);
             $cekdatakusus = TransModels::join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
             ->where('trans_models.tglbayar', 'LIKE', '%'.$r->cari.'%')
             ->where('keuangan_models.costem', 'pemeswas')
             ->get();
         }
         elseif(@$r->btncetak)
         {
            $cekdata = TransModels::join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
             ->where('trans_models.tglbayar', 'LIKE', '%'.$r->cari.'%')
             ->get();
            return view('home.section.output.cbulanan',
            compact(
                'cekdata',
                'tangal'
            ));
         }
        return view('home.section.output.bulanan',
            compact(
                'cekdata',
                'cekdatakusus',
                'datacombo',
                'tangal'
            ));
    }
    public function ltahunan(Request $r)
    {
        if(auth()->user()->level != 'Pimpinan')
        {
            return redirect('/home');
        }
        $datacombo = TransModels::GroupBy(DB::raw('YEAR(tglbayar)'))
         ->select(DB::raw('YEAR(tglbayar) as tahun,sum(jlmbayar) as totalgr'))
         ->join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->orderBy('tglbayar', 'desc')
         ->get();
        $cekdata = TransModels::GroupBy(DB::raw('YEAR(tglbayar),MONTH(tglbayar)'))
         ->select(DB::raw('YEAR(tglbayar) as tahun,MONTH(tglbayar) as bulan,sum(jlmbayar) as totalgr'))
         ->join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
         ->where('tglbayar', 'LIKE','%'.date('Y').'%')
         ->get();
         $tangal = date('Y');
         if($r->cari)
         {
            $tangal = $r->cari;
         }
         if(@$r->btncari)
         {
             $cekdata = TransModels::GroupBy(DB::raw('YEAR(tglbayar),MONTH(tglbayar)'))
             ->select(DB::raw('YEAR(tglbayar) as tahun,MONTH(tglbayar) as bulan,sum(jlmbayar) as totalgr'))
             ->join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
             ->where('trans_models.tglbayar', 'LIKE', '%'.$r->cari.'%')
             ->get();
         }
         elseif(@$r->btncetak)
         {
            $cekdata = TransModels::GroupBy(DB::raw('YEAR(tglbayar),MONTH(tglbayar)'))
             ->select(DB::raw('YEAR(tglbayar) as tahun,MONTH(tglbayar) as bulan,sum(jlmbayar) as totalgr'))
             ->join('keuangan_models','trans_models.id_trans','=','keuangan_models.id_trans')
             ->where('trans_models.tglbayar', 'LIKE', '%'.$r->cari.'%')
             ->get();
            return view('home.section.output.ctahunan',
            compact(
                'cekdata',
                'tangal'
            ));
         }
        return view('home.section.output.tahunan',
            compact(
                'cekdata',
                'datacombo',
                'tangal'
            ));
    }
    public function setting()
    {
        return view('home.section.input.setting');
    }
    public function upsetting(Request $r)
    {
        $up = User::find(auth()->user()->id);
        $up->name = $r->name;
        $up->email = $r->email;
        if(!$r->password)
        {
            $up->password = $up->password;
        }
        else
        {
            $up->password = Hash::make($r->password);
        }
        $up->update();
        if($up)
        {
            Session::flash('sukses', 'data Anda berhasi diupdate!');
        }
        else
        {
            Session::flash('gagal', 'data Anda Gagal diupdate!');
        }
        return back();
    }
    public function pencariandata()
    {
        $cekdata = KeuanganModels::orderBy('tgl_bayar', 'desc')->get();
        return view('home.section.input.pencarian',
            compact(
                'cekdata'
            ));
    }
        public function cekedit($lokasi, $id)
    {
        $cekdata = KeuanganModels::find($id);
        return view('home.section.update.update', compact('cekdata', 'lokasi'));
    }
    public function updata(Request $r,$lokasi,$id)
    {
        $input             = KeuanganModels::find($id);
        $input->nama       = $r->nama;
        $input->harga      = str_replace(".", "", $r->harga);
        $input->status     = $r->status;
        $input->keterangan = $r->keterangan;
        $input->update();
         if($input)
        {
            Session::flash('sukses', 'data berhasi diupdate!');
        }
        else
        {
            Session::flash('gagal', 'data gagal diupdate!');
        }
        return redirect('/home/pencarian/data');
    }
    public function deldata($lokasi, $id)
    {
        $del = KeuanganModels::find($id);
        $cekdell = TransModels::where('id_trans',$del->id_trans)->get();
        if(@count($cekdell) > 0)
        {
            foreach($cekdell as $deltran)
            {
                $dell = TransModels::find($deltran->id);
                $dell->delete();
            }
        }
        $del->delete();
        if($del)
        {
            Session::flash('sukses', 'data berhasi dihapus!');
        }
        else
        {
            Session::flash('gagal', 'data gagal dihapus!');
        }
        return redirect('/home/pencarian/data');
    }
    public function edtrans($id)
    {
        $data = TransModels::find($id);
        return view('home.section.update.edtrans',
            compact(
                'data'
            ));

    }
    public function uptrans(Request $r, $id)
    {
        $up = TransModels::find($id);
        $up->jlmbayar = str_replace('.', "", $r->jumlah);
        $up->update();
        if($up)
        {
            Session::flash('sukses', 'data berhasi diupdate!');
        }
        else
        {
            Session::flash('gagal', 'data gagal diupdate!');
        }
        return redirect('/home/pencarian/data');
    }
    public function deltrans($id)
    {
        $del = TransModels::find($id);
        $del->delete();
        if($del)
        {
            Session::flash('sukses', 'data berhasi dihapus!');
        }
        else
        {
            Session::flash('gagal', 'data gagal dihapus!');
        }
        return redirect('/home/pencarian/data');
    }
    public function edpengeluaran($id)
    {
        $data = PengeluaranModels::find($id);
        return view('home.section.update.edpengeluaran', compact('data'));
    }
    public function uppengeluaran(Request $r, $id)
    {
        $up = PengeluaranModels::find($id);
        $up->nama_kpn = $r->nama_kpn;
        $up->jumlah   = $r->jumlah;
        $up->total    = str_replace(".", "", $r->total);
        $up->tanggal  = $r->tanggal;
        $up->update();
        if($up)
        {
            Session::flash('sukses', 'data berhasi dihapus!');
        }
        else
        {
            Session::flash('gagal', 'data gagal diupdate!');
        }
        return redirect('/home/pengeluaran');
    }
    public function delpengeluaran($id)
    {
        $del = PengeluaranModels::find($id);
        // dd($del);
        $del->delete();
        if($del)
        {
            Session::flash('sukses', 'data berhasi dihapus!');
        }
        else
        {
            Session::flash('gagal', 'data gagal dihapus!');
        }
        return redirect('/home/pengeluaran');
    }

}
