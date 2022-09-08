<?php 


class Login extends Controller{
    public function index()
    {
        $data['title'] = 'Login page';
        $data['name'] = $this->model('M_user')->getUser();
        var_dump($data);
        $this->view('partials/header', $data);
        $this->view('auth/login',$data);
        $this->view('partials/footer');
    }
}