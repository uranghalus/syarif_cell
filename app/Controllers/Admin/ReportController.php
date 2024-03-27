<?php

namespace App\Controllers\Admin;

use App\Controllers\AuthController;
use App\Controllers\BaseController;
use App\Models\CheckoutModel;
use App\Models\MerekModel;
use App\Models\PerangkatModel;
use \Mpdf\Mpdf;
use CodeIgniter\HTTP\ResponseInterface;

class ReportController extends BaseController
{
    protected $mpdf;
    protected $authenticate;
    protected $MerekModel;
    protected $PerangkatModel;
    protected $CheckoutModel;
    public function __construct()
    {
        $this->helpers = ['form', 'url', 'validation'];
        $this->mpdf = new mPDF();
        $this->authenticate = new AuthController();
        $this->MerekModel = new MerekModel();
        $this->PerangkatModel = new PerangkatModel();
        $this->CheckoutModel = new CheckoutModel();
    }

    public function generatePDF($content, $nama_file)
    {
        // Tulis konten ke file PDF
        $this->mpdf->WriteHTML($content);

        // Outputkan file PDF sebagai string
        return $this->mpdf->Output("" . $nama_file . ".pdf", 'I');
    }
    // LINK View Data Smartphone
    public function index()
    {
        // Cek Login
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => 'Report',
            'title' => 'Report Smartphone',
            'data_merek' => $this->MerekModel->findAll()
        ];
        return view('admin/report/smartphone/report_index', $data);
    }
    // LINK Print Smartphone
    public function print_smartphone()
    {
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        // Ambil data dari form
        $jenisLaporan = $this->request->getPost('jenis_laporan');
        $merek = $this->request->getPost('merek');
        $tahunRilis = $this->request->getPost('tahun_rilis');
        $tanggalMulai = $this->request->getPost('tanggal_mulai');
        $tanggalSelesai = $this->request->getPost('tanggal_selesai');

        if ($jenisLaporan == "per") {
            $data = [
                'pagetitle' => 'Report Smartphone',
                'title' => 'Report Smartphone',
                'jenis_laporan' => $jenisLaporan,
                'tahun_rilis' => ($tahunRilis == null) ? "Semua Tahun" : $tahunRilis,
                'data_perangkat' => $this->PerangkatModel->reportPerangkatByMerek($merek, $tahunRilis)
            ];
        } else {
            $where = ['perangkat.created_at >=' => $tanggalMulai, 'perangkat.created_at <=' => $tanggalSelesai];
            $data = [
                'pagetitle' => 'Report Smartphone',
                'title' => 'Report Smartphone',
                'jenis_laporan' => $jenisLaporan,
                'tahun_rilis' => "Periode " . $tanggalMulai . " S.d " . $tanggalSelesai,
                'data_perangkat' => $this->PerangkatModel->reportPerangkatByCreated($where)
            ];
        }
        return $this->generatePDF(view('admin/report/smartphone/report_result', $data), 'Smartphone Report ' . $jenisLaporan);
    }
    // LINK checkout_report
    public function checkout_report()
    {
        // Cek Login
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        $data = [
            'pagetitle' => 'Report',
            'title' => 'Report Pembelian',
            'data_merek' => $this->MerekModel->findAll()
        ];
        return view('admin/report/checkout/report_index', $data);
    }
    public function print_checkout()
    {
        if (!$this->authenticate->isLoggedIn()) {
            return redirect()->to(base_url('auth/login'));
        }
        // Ambil data dari form
        $jenisLaporan = $this->request->getPost('jenis_laporan');
        $merek = $this->request->getPost('merek');
        $tanggalMulai = $this->request->getPost('tanggal_mulai');
        $tanggalSelesai = $this->request->getPost('tanggal_selesai');
        if ($jenisLaporan == "per") {
            $where = ['perangkat.id_merek >=' => $merek];
            $data = [
                'pagetitle' => 'Report Pembelian',
                'title' => 'Report Pembelian',
                'jenis_laporan' => $jenisLaporan,
                'data_checkout' => $this->CheckoutModel->getDataCheckout($where)
            ];
        } else {
            $where = ['checkout.created_at >=' => $tanggalMulai, 'checkout.created_at <=' => $tanggalSelesai];
            $data = [
                'pagetitle' => 'Report Pembelian',
                'title' => 'Report Pembelian',
                'jenis_laporan' => $jenisLaporan,
                'tahun_rilis' => "Periode " . $tanggalMulai . " S.d " . $tanggalSelesai,
                'data_checkout' => $this->CheckoutModel->reportCheckout($where)
            ];
        }
        return $this->generatePDF(view('admin/report/checkout/report_result', $data), 'Checkout Report ' . $jenisLaporan);
    }
}
