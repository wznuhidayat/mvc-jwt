<?php

class Dashboard extends Controller
{

    public function index()
    {
        $data['title'] = 'dashboard page';
        // $data['name'] = $this->model('M_dashboard')->getGambar();
        $this->view('partials/header', $data);
        $this->view('dashboard/main', $data);
        $this->view('partials/footer');
    }
    public function savegambar()
    {
        $img = file_get_contents("php://input");
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);

        $str = "";
        $characters = array_merge(range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < 11; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }

        $fileName =   $str . '.png';

        $success = file_put_contents("./images/" . $fileName, $fileData);
        $str = "";
        $characters = array_merge(range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < 8; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }

        // move_uploaded_file($fileData,"./images/".  $fileName);
        $data = [
            'id' => intval($str),
            'gambar' => $fileName
        ];
        $this->model('M_dashboard')->saveImg($data);
        // var_dump( $this->model('M_dashboard')->saveImg($fileName));
        print $success ? $fileName . ' saved.' : "Failed";
    }
}
