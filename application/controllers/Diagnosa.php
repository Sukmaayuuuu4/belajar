<?php 

class Diagnosa extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Gejala_model');
        $this->load->model('Diagnosa_model');
        $this->load->model('Penyakit_model');
        $this->load->helper('url'); 
    }

    public function index() {
        $data['gejala'] = $this->Gejala_model->get_all();
        $this->load->view('diagnosa_form', $data);
    }

    public function proses() {
        // Cek apakah data gejala dikirim
        if (!isset($_POST['gejala']) || empty($_POST['gejala'])) {
            echo "Error: Tidak ada data gejala yang dikirim.";
            return;
        }
    
        // Ambil data dari form
        $gejala_user = $_POST['gejala'];
    
        // Definisikan basis aturan penyakit dan MB/MD pakar
        $aturan = [
            'P001' => [
                'G001' => ['MB' => 0.8, 'MD' => 0], 
                'G002' => ['MB' => 0.7, 'MD' => 0],
                'G003' => ['MB' => 0.4, 'MD' => 0.05],
                // Tambahkan gejala lainnya sesuai database
            ],
            'P002' => [
                'G004' => ['MB' => 0.8, 'MD' => 0], 
                'G005' => ['MB' => 0.5, 'MD' => 0],
                'G006' => ['MB' => 0.3, 'MD' => 0.05],
                // Tambahkan gejala lainnya sesuai database
            ],
            'P003' => [
                'G007' => ['MB' => 0.7, 'MD' => 0], 
                'G008' => ['MB' => 0.3, 'MD' => 0.03],
                'G009' => ['MB' => 0.7, 'MD' => 0], 
                'G010' => ['MB' => 0.3, 'MD' => 0.02],
                // Tambahkan gejala lainnya sesuai database
            ],
            'P004' => [
                'G011' => ['MB' => 0.8, 'MD' => 0], 
                'G012' => ['MB' => 0.3, 'MD' => 0.1],
                'G013' => ['MB' => 0.4, 'MD' => 0.2], 
                'G014' => ['MB' => 0.6, 'MD' => 0],
                // Tambahkan gejala lainnya sesuai database
            ],
            'P005' => [
                'G015' => ['MB' => 0.6, 'MD' => 0], 
                'G016' => ['MB' => 0.6, 'MD' => 0],
            ],
            'P006' => [
                'G017' => ['MB' => 0.7, 'MD' => 0], 
                'G018' => ['MB' => 0.4, 'MD' => 0],
            ],
            'P007' => [
                'G019' => ['MB' => 0.8, 'MD' => 0], 
                'G020' => ['MB' => 0.7, 'MD' => 0.02],           
            ],
            'P008' => [
                'G021' => ['MB' => 0.85, 'MD' => 0], 
            ],
            'P009' => [
                'G022' => ['MB' => 0.85, 'MD' => 0], 
            ]
        ];
    
        // Hitung CF untuk setiap penyakit
        $hasil_diagnosa = [];
        foreach ($aturan as $kode_penyakit => $gejala_aturan) {
            $mb = 0; $md = 0;
            $first = true;
    
            foreach ($gejala_aturan as $kode_gejala => $nilai) {
                if (isset($gejala_user[$kode_gejala])) {
                    $mb_user = $gejala_user[$kode_gejala];
                    $mb_pakar = $nilai['MB'];
                    $md_pakar = $nilai['MD'];
    
                    $mb1 = $mb_user * $mb_pakar;
                    $md1 = $mb_user * $md_pakar;
    
                    if ($first) {
                        $mb = $mb1;
                        $md = $md1;
                        $first = false;
                    } else {
                        $mb = $mb + ($mb1 * (1 - $mb));
                        $md = $md + ($md1 * (1 - $md));
                    }
                }
            }
    
            // Hitung CF akhir
            $cf = $mb - $md;
            $hasil_diagnosa[$kode_penyakit] = $cf;
        }
    
        // Urutkan berdasarkan CF tertinggi
        arsort($hasil_diagnosa);
    
        // Tampilkan hasil
        echo "<h2>Hasil Diagnosa</h2>";
        foreach ($hasil_diagnosa as $penyakit => $cf) {
            echo "<p><strong>$penyakit</strong>: Certainty Factor = " . round($cf, 2) . "</p>";
        }
    }
    
    
}

?>