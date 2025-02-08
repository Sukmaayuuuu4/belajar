<?php
class Diagnosa_model extends CI_Model {
    public function hitung_cf($gejala_user) {
        $hasil_diagnosa = [];

        foreach ($gejala_user as $id_gejala => $cf_user) {
            // Ambil aturan dari database berdasarkan gejala
            $aturan = $this->db->get_where('aturan', ['id_gejala' => $id_gejala])->result();

            foreach ($aturan as $rule) {
                $cf_rule = $cf_user * $rule->mb; // Mengalikan CF user dengan MB pakar

                if (!isset($hasil_diagnosa[$rule->id_penyakit])) {
                    $hasil_diagnosa[$rule->id_penyakit] = $cf_rule;
                } else {
                    // Menggunakan rumus CF kombinasi
                    $hasil_diagnosa[$rule->id_penyakit] = $hasil_diagnosa[$rule->id_penyakit] + 
                        ($cf_rule * (1 - $hasil_diagnosa[$rule->id_penyakit]));
                }
            }
        }

        arsort($hasil_diagnosa); // Urutkan berdasarkan CF terbesar
        return $hasil_diagnosa;
    }
}
