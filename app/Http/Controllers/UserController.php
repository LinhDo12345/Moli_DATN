<?php

namespace App\Http\Controllers;


use App\Models\Staff;
use App\Models\User;
use App\Repositories\StaffRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Twilio\Jwt\JWT;

class UserController extends Controller
{

    private $request;
    private $staffRepository;
    private $userRepository;

    public function __construct(
        Request $request,
        StaffRepository $staffRepository,
        UserRepository $userRepository
    ) {
        $this->request         = $request;
        $this->staffRepository = $staffRepository;
        $this->userRepository  = $userRepository;
    }

    public function getListUser()
    {
        $listUser = $this->userRepository->getAll();
        return view('admin.user.list', ['listUser' => $listUser]);
    }

    public function getListStaff()
    {
        $staffs = $this->staffRepository->getList();
        $roles  = Staff::ROLE;
        return view('admin.staff.list', ['roles' => $roles, 'staffs' => $staffs]);
    }

    public function getAddStaff()
    {
        if (!$this->checkPermissionManagement()) {
            return redirect('admin/dashboard/report-total')->with('message-fail', 'Bạn không có quyền truy cập chức năng này');
        }
        $roles = Staff::ROLE;
        return view('admin.staff.add', ['roles' => $roles]);
    }

    public function postAddStaff()
    {
        if (!$this->checkPermissionManagement()) {
            return redirect('admin/dashboard/report-total')->with('message-fail', 'Bạn không có quyền truy cập chức năng này');
        }
        $this->validateAddStaff();
        $data       = $this->getDataAddStaff();
        $checkEmail = $this->staffRepository->getStaffByEmail($data['email']);
        if ($checkEmail) {
            return redirect()->back()->with('message-error', 'Email này đã được sử dụng');
        } else {
            $data['time_created'] = time();
            $this->staffRepository->insert($data);
            return redirect('admin/staff/list-staff')->with('message', 'Thêm nhân sự thành công');
        }
    }

    private function validateAddStaff($flag = true)
    {
        $rules = [
            'name'       => 'required|min:3|max:50',
            'email'      => ($flag) ? 'required' : '',
            'password'   => 'required|min:6|max:30',
            'repassword' => 'same:password'
        ];

        $message = [
            'name.required'     => 'Bạn chưa nhập tên',
            'name.min'          => 'Tên có độ dài từ 3 đến 50 ký tự',
            'name.max'          => 'Tên có độ dài từ 3 đến 50 ký tự',
            'email.required'    => 'Bạn chưa nhập địa chỉ email',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min'      => 'Mật khẩu chứa từ 6 ký tự trở lên',
            'password.max'      => 'Độ dài mật khẩu tối đa là 30 ký tự',
            'repassword.same'   => 'Mật khẩu không trùng khớp'
        ];

        $this->validate($this->request, $rules, $message);
    }

    private function getDataAddStaff()
    {
        $dataInsert = [
            'name'         => $this->request->input('name'),
            'email'        => $this->request->input('email'),
            'password'     => bcrypt($this->request->input('password')),
            'role'         => $this->request->input('role'),
            'status'       => $this->request->input('status') != null ? $this->request->input('status') : '1',
            'time_updated' => time()
        ];

        return $dataInsert;
    }

    public function getDelete($id)
    {
        if (!$this->checkPermissionManagement()) {
            return redirect('admin/dashboard/report-total')->with('message-fail', 'Bạn không có quyền truy cập chức năng này');
        }
        $this->staffRepository->update($id, ['status' => Staff::IS_CANCEL]);
        return redirect('admin/staff/list-staff')->with('message', 'Xóa nhân sự thành công!');
    }

    public function getEditStaff($id)
    {
        if (!$this->checkPermissionManagement()) {
            return redirect('admin/dashboard/report-total')->with('message-fail', 'Bạn không có quyền truy cập chức năng này');
        }
        $staff = $this->staffRepository->find($id);
        return view('admin.staff.edit', ['staff' => $staff]);
    }

    private function checkPermissionManagement()
    {
        if (Auth::user()->role != Staff::MANAGEMENT) {
            return false;
        }
        return true;
    }

    public function postEditStaff()
    {
        if (!$this->checkPermissionManagement()) {
            return redirect('admin/dashboard/report-total')->with('message-fail', 'Bạn không có quyền truy cập chức năng này');
        }
        $this->validateAddStaff(false);
        $data = $this->getDataAddStaff();
        unset($data['email']);

        $id = $this->request->input('id');
        $this->staffRepository->update($id, $data);
        return redirect('admin/staff/list-staff')->with('message', 'Cập nhật nhân sự thành công');
    }

    public function getAdminLogin()
    {
        return view('admin.auth.login');
    }

    public function postAdminLogin()
    {
        $rules = [
            'email'    => 'required',
            'password' => 'required'
        ];

        $message = [
            'email.required'    => 'Bạn chưa nhập emai',
            'password.required' => 'Bạn chưa nhập mật khẩu'
        ];

        $this->validate($this->request, $rules, $message);

        $email    = $this->request->input('email');
        $password = $this->request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1])) {
            return redirect('admin/dashboard/report-total');
        } else {
            return redirect('admin/login')->with('message', 'Tài khoản hoặc mật khẩu không đúng');
        }
    }

    public function register(Request $request)
    {
        $email    = trim($request->input('email'));
        $name     = trim($request->input('name'));
        $password = trim($request->input('password'));

        if (!$email || !$name || !$password) {
            return ['status' => 'error', 'message' => 'Invalid params'];
        }

        $user = $this->userRepository->getUser($email);
        if ($user) {
            return ['status' => 'error', 'message' => 'Email used'];
        }

        $isValid = $this->validEmail($email);
        if (!$isValid) {
            return ['status' => 'error', 'message' => 'Email not correct'];
        }

        $password = Hash::make($request->input('password'));

        try {
            $user               = new User();
            $user->email        = $email;
            $user->password     = $password;
            $user->name         = $name;
            $user->time_created = time();

            if ($user->save()) {
                return response()->json(['status' => 'success', 'message' => 'user created successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function validEmail($str)
    {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? false : true;
    }

    public function login(Request $request)
    {
        $email    = trim($request->input('email'));
        $password = trim($request->input('password'));

        if (!$email || !$password) {
            return ['status' => 'error', 'message' => 'Invalid params'];
        }

        $user = $this->userRepository->getUser($email);
        if (!$user) {
            return ['status' => 'error', 'message' => 'Account not exist'];
        }

        if (Hash::check($password, $user->password)) {
            $data['access_token'] = $this->genToken($user, 60 * 60 * 24, 'W74B9zi1yZnzTxyKPaxw');
            $data['token_type']   = 'bearer';
            $data['user']         = $user;
            $data['expires_in']   = 60 * 60 * 24;
            return response()->json($data);
        } else {
            return ['status' => 'error', 'message' => 'Password not correct'];
        }
    }

    public function genToken(&$data, $exp, $key)
    {
        $data['exp'] = time() + $exp;
        $encoded     = JWT::encode($data, $key);
        return $encoded;
    }

    public function logout(Request $request)
    {
        return response()->json(['message' => 'Successfully logged out', 'status' => 'success']);
    }

}
