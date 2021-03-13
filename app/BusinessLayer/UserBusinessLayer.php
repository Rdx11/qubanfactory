<?php

namespace App\BusinessLayer;

use App\DTO\UserDTO;
use App\Mail\VerifyMail;
use App\Models\User;
use App\Models\UserProviderAcc;
use App\Models\VerifyUser;
use App\DTO\DatatableDTO;
use App\PresentationLayer\ResponseCreatorPresentationLayer;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;
use Validator, DB, Carbon\Carbon;
use JWTAuth;
use Mail;
use File;

class UserBusinessLayer extends GenericBusinessLayer
{
    public function getUser(UserDTO $params)
    {
        try{
            $idUser = $params->getIdUser();
            $data = User::find($idUser);

            if ($data != null) {
                $response = new ResponseCreatorPresentationLayer(200, 'Data ditemukan!', $data);
            }else{
                $response = new ResponseCreatorPresentationLayer(500, 'data tidak ditemukan!', null);
            }
        }catch(\Exception $e){
            $response = new ResponseCreatorPresentationLayer(500, 'Terjadi kesalahan pada server', null);
        }

        return $response->getResponse();
    }

    public function actionSave(UserDTO $params)
    {
        try{
            DB::beginTransaction();

            $idUser = $params->getIdUser();
            $name = $params->getName();
            $email = $params->getEmail();
            $password = $params->getPassword();
            $phoneNumber = $params->getPhoneNumber();
            $role = $params->getRole();

            $data = [
              'name' => $name,
              'email' => $email,
              'phoneNumber' => $phoneNumber,
              'role' => $role,
            ];

            if(is_null($password) || $password == ""){
                $data = $data;
            }else{
                $data = array_merge($data, ['password' => Hash::make($password)]);
            }

            $rules = $this->rules();
            $rulesUpdate = $this->rulesUpdate();
            if(is_null($idUser)){
                $validator = Validator::make($data, $rules);
                if ($validator->fails()) {
                    $error = $validator->errors()->first();
                    $response = new ResponseCreatorPresentationLayer(404, $error, null);
                    return $response->getResponse();
                }

                $user = User::create($data);
                $data['id_user'] = $user->id_user;

                $expDate = mktime(
                    date("H"), date("i"), date("s"), date("m") ,date("d")+3, date("Y")
                );

                $verifyUser = VerifyUser::create([
                    'id_user' => $user->id_user,
                    'token' => sha1(time()),
                    'expired' => date("Y-m-d H:i:s",$expDate)
                ]);

                $time = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                $data['verify_token_email'] =  $verifyUser->token;
                // $data['data'] = $data;

                // Mail::send('email.verify', $data, function($message) use ($email, $data)  {
                //     $message->from('im.acidopal@gmail.com', 'Registrasi Berhasil - Qurban Factiory');

                //     $message->to($email, $data['name'], $data['verify_token_email'])
                //             ->subject('Registrasi Berhasil '.$data['name'].'- Qurban Factiory');
                // });

                 $dataUser = User::where('email', $params->getEmail())
                            ->first();

                DB::commit();

                $response = new responseCreatorPresentationLayer(200, 'Data berhasil disimpan!', $dataUser);
            }else{
                $validate = $this->validate($idUser, $email);

                if($validate['code'] == 200){
                    $validator = Validator::make($data,$rulesUpdate);
                    if ($validator->fails()) {
                        $error = $validator->errors()->first();
                        $response = new ResponseCreatorPresentationLayer(404, $error, null);
                        return $response->getResponse();
                    }
                }

                $input = collect($data)->filter()->all();

                User::find($idUser)->update($input);
                $dataUser = User::where('id_user', $idUser)->first();

                $response = new responseCreatorPresentationLayer(200, 'Data berhasil diperbarui!', $dataUser);
                DB::commit();
            }

        }catch (\Exception $e){
            DB::rollback();
            $response = new ResponseCreatorPresentationLayer(500, $e->getMessage(), $e->getMessage());
        }

        return $response->getResponse();
    }

    private function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:user',
            'phoneNumber' => 'required',
        ];

        return $rules;
    }

    private function rulesUpdate()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
        ];

        return $rules;
    }

    public function actionCheckLogin(UserDTO $params)
    {
        try{
            if(is_null($params->getEmail()) || $params->getEmail()==""){
                $response = new ResponseCreatorPresentationLayer(400, 'Silakan mengisi Email', null);
                return $response->getResponse();
            }

            if(is_null($params->getPassword()) || $params->getPassword()==""){
                $response = new ResponseCreatorPresentationLayer(400, 'Silakan mengisi password', null);
                return $response->getResponse();
            }

            $data = User::where('email', $params->getEmail())
                            ->first();

            if(is_null($data)){
                $response = new ResponseCreatorPresentationLayer(404, 'Data pengguna tidak ditemukan', null);
                return $response->getResponse();
            }

            $loginType = filter_var($params->getEmail(), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            $loginData = [
                $loginType => $params->getEmail(),
                'password' => $params->getPassword(),
            ];

            if (!auth()->attempt($loginData)) {
                $response = new ResponseCreatorPresentationLayer(401, 'Password tidak sesuai', null);
                return $response->getResponse();
            }

            $response = new ResponseCreatorPresentationLayer(200, 'Login berhasil', $data);
        }catch (\Exception $e){
            $data = null;
            $response = new ResponseCreatorPresentationLayer(500, 'Terjadi kesalahan pada server', null);
        }

        return $response->getResponse();
    }


    public function actionCreateNewInstance()
    {
        try{
            $data = new User();
            $response = new ResponseCreatorPresentationLayer(200, 'Data berhasil dibuat', $data);
        }catch (\Exception $e){
            $data = null;
            $response = new ResponseCreatorPresentationLayer(500, 'Terjadi kesalahan pada server', $data);
        }

        return $response->getResponse();
    }


    private function validate($idUser, $email)
    {
          $checkUser = User::where('id_user','<>',$idUser)->where('email','=',$email);

          if ($checkUser->count() > 0) {
              $response = new ResponseCreatorPresentationLayer(500, 'Data has been already taken', null);
          }else{
              $response = new ResponseCreatorPresentationLayer(200, 'Data tersedia!', null);
          }
          return $response->getResponse();
    }


    public function forgetPassword(UserDTO $params)
    {
        $email = $params->getEmail();

        if(is_null($email) || $email == ""){
            $response = new ResponseCreatorPresentationLayer(404, 'Parameter email tidak tersedia', null);
            return $response->getResponse();
        }

        $activeUser = User::where(['email' => $email])->first();

        if(!is_null($activeUser)){
            $expDate = Carbon::now()->addDays(2);

            $dataReset = [
                'user_id' => $activeUser->id,
                'token' => md5($email),
                'expired' => $expDate
            ];

            DB::table('password_resets')->insert($dataReset);

            $data['title'] = "Reset Password";
            $data['url'] = config('config.app_url')."/reset-password/".$dataReset['token'];
            $data['dataUser'] = $activeUser;

            Mail::send('email.reset', $data, function($message) use ($email, $activeUser)  {
                $message->from('im.acidopal@gmail.com', 'Reset Password - Qurban Factiory');

                $message->to($email, $activeUser->name)
                        ->subject('Reset Password '.$activeUser->name.'- Qurban Factiory');
            });

            $response = new ResponseCreatorPresentationLayer(200, 'Permintaan reset password berhasil dikirim silahkan cek email!', $activeUser);

            return $response->getResponse();
        }else{
            $response = new ResponseCreatorPresentationLayer(404, 'Email tidak terdaftar!', null);
            return $response->getResponse();
        }
    }

    public function actionDatatable(DatatableDTO $params)
    {
        try{
            $columDescriptions = [
                0 => 'no',
                1 => 'name',            
                2 => 'email',            
                3 => 'phone',            
                4 => 'photo',            
                5 => 'info',            
                6 => 'opsi'
            ];
    
            $limit = $params->getLimit();            
            $start = $params->getStart();            
            $order = $columDescriptions[$params->getOrder()];
            $dir = $params->getDir();
            $search=$params->getSearch();
            $draw=$params->getDraw();

            if ($params->getFrom() != null) {
                $getFrom = $params->getFrom();
                $from = decrypt($getFrom);
            }

            $numberOfRows = User::count();

            $totalFiltered = $numberOfRows;
    
            if(empty($search)){
                $userData = User::offset($start)
                                    ->limit($limit)
                                    ->orderBy('id', 'desc')
                                    ->get();
            }else{
                $userData =  User::where('name', 'LIKE',"%{$search}%")
                                    ->offset($start)
                                    ->limit($limit)
                                    ->orderBy('id', 'desc')
                                    ->get();


                $totalFiltered =  User::where('name', 'LIKE',"%{$search}%")
                                         ->count();
            }   

            $data = [];
            if(count($userData) > 0){
                foreach($userData as $num => $user){
                    $currentData = [];
                    $currentData['no'] = $num+1;
                    $currentData['name'] = $user->name;                    
                    $currentData['email'] = $user->email;                    
                    $currentData['phone'] = $user->phone;                    
                    $currentData['photo'] = ($user->photo) ? '<img src="'.asset($user->photo).'" alt="'.$user->name.'"  width="50px">' : '-';                                 
                    $currentData['info'] = ''
                        // 'Status : '.$user->is_active.'<br>'.
                        // 'Verfied : '.$user->is_verified.'<br>'
                    ;                    
                    $currentData['opsi'] = "
                    <a href=".url('/user/form?id='.encrypt($user->id_user)).".  class='btn btn-warning mr-1 mb-1 waves-effect waves-light'><i class='fa fa-edit'></i> Edit</a>

                    <a onclick=deleteData('".encrypt($user->id_user)."') class='btn btn-danger mr-1 mb-1 waves-effect waves-light'><i class='fa fa-trash'></i> Hapus</a>";

                    $data[] = $currentData;
                }
            }

            $jsonData = [
                "draw"            => intval($draw),
                "recordsTotal"    => intval($numberOfRows),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            ];

            $response = new ResponseCreatorPresentationLayer(200, 'Data ditemukan!', $jsonData);

        }catch(\Exception $e){
            $jsonData = [
                "draw"            => 0,
                "recordsTotal"    => 0,
                "recordsFiltered" => 0,
                "data"            => []
            ];

            $response = new ResponseCreatorPresentationLayer(200, 'Data ditemukan!', $e->getMessage());
        }

        return $response->getResponse();
    }

    public function actionDelete(UserDTO $params)
    {
        try{
            try {
                $idUser = decrypt($params->getIdUser());
            } catch (DecryptException $e) {
                $idUser = 0;
            }

            $data = User::find($idUser);
            if(is_null($data)){
                $response = new ResponseCreatorPresentationLayer(404, 'Data perusahaan tidak ditemukan', $data);
                return $response->getResponse();
            }

             if (!is_null($data->photo)) {
                if(file_exists($data->photo)){ unlink($data->photo);}
             }

            $data->delete();
            $response = new ResponseCreatorPresentationLayer(200, 'Data berhasil dihapus', null);

        }catch(\Exception $e){
            $response = new ResponseCreatorPresentationLayer(500, 'Operation is not allowed! Data is in used by another entities ', null);
        }

        return $response->getResponse();
    }
}
