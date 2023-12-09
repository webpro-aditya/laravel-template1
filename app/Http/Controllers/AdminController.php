<?php

namespace App\Http\Controllers;


use App\Models\Login;
use App\Models\User;
use App\Services\EmailService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;



class AdminController extends Controller
{
    /**
     * Login Authentication
     * 
     * @param \Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $validator = $request->validate([
            'email' => 'required|email:rfc,filter',
            'password' => 'required',
        ]);

      try{
        if (Auth::attempt($validator)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard.index');
        }
      } catch (Exception $e) {
        return back()->with('error', $e->getMessage());
      }

        return back()->with([
            'error' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Logout
     * 
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended('login')->with(['success' => __('You\'ve been logged out.')]);
    }


    /**
     * Change Password View
     * 
     */
    public function changePass()
    {
        return view('admin.loadChangePass');
    }

    /**
     * Change Password Update
     * 
     */
    public function updatePass(Request $request)
    {

        try {
            $oldPassword = $request->oldPassword;  //Old Password filled
            $newPassword = $request->newPassword;     // New Password filled
            $cNewPassword = $request->cNewPassword;    // New Password confirmed

            $userPassword = Auth::user()->password;  //Password of logged in User

            $validate = $request->validate([
                'oldPassword' => 'required|max:20',
                'newPassword' => 'required|max:20',
                'cNewPassword' => 'required|max:20'
            ]);

            //Old Password Not Match with Current User's Password
            if (!Hash::check($oldPassword, $userPassword)) {
                return redirect()->back()->with('error', 'Your old password not correct');
            }

            //New Password and Confirm Pasword Not Match
            if ($newPassword != $cNewPassword) {
                return redirect()->back()->with('error', 'The Confirm new password field does not match the New password field');
            }

            $userId = Auth::user()->userId;  //Id of logged in User

            $userObj = User::findOrFail($userId);

            $userObj->password = bcrypt($cNewPassword);
            $userObj->updatedBy = $userId;
            $userObj->updatedDtm = date('Y-m-d H:m:s');
            $userObj->update();

            return redirect()->back()->with('success', 'Password updation successful');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * This function used to load forgot password view
     */
    public function forgotPassword()
    {
        return view('admin.forgotPassword');
    }

    /**
     * This function used to generate reset password request link
     */
    function resetPasswordUser(Request $request)
    {
        try{
            $status = '';

            $validate = $request->validate([
                'login_email' => 'required|email|email:rfc,filter'
            ]);

            if (!$validate) {
                $this->forgotPassword();
            } else {
                $email = $request->get('login_email');
                $loginObj = new Login();
                if ($loginObj->checkEmailExist($email)) {
                    $encoded_email = urlencode($email);

                    $data['email'] = $email;
                    $data['activation_id'] = random_string('alnum', 15);
                    $data['createdDtm'] = date('Y-m-d H:i:s');
                    // $data['agent'] = getBrowserAgent();
                    $data['agent'] = '';
                    $data['client_ip'] = request()->ip();

                    $save = $loginObj->resetPasswordUser($data);

                    if ($save) {
                        $data1['reset_link'] = url("/resetPasswordConfirmUser/" . $data['activation_id'] . "/" . $encoded_email);
                        $userInfo = $loginObj->getCustomerInfoByEmail($email);

                        if (!empty($userInfo)) {
                            $data1["name"] = $userInfo[0]->name;
                            $data1["email"] = $userInfo[0]->email;
                            $data1["message"] = "Reset Your Password";
                        }

                        $emailSer = new EmailService();
                        $sendStatus = $emailSer->resetPasswordEmail($data1);

                        if ($sendStatus) {
                            $status = "success";
                            Session::flash($status, "Reset password link sent successfully, please check mails.");
                        } else {
                            $status = "error";
                            Session::flash($status, "Email has been failed, try again.");
                        }
                    } else {
                        $status = 'error';
                        Session::flash($status, "It seems an error while sending your details, try again.");
                    }
                } else {
                    $status = 'error';
                    Session::flash($status, "This email is not registered with us.");
                }
                return redirect()->route('admin.forgotPassword');
            }
        } catch(Exception $e) {
            return redirect()->route('login')->with('error', 'Something went wrong');
        }
    }

    // This function used to reset the password 
    function resetPasswordConfirmUser($activation_id, $email)
    {
       try{
            // Get email and activation code from URL values at index 3-4
            $email = urldecode($email);

            // Check activation id in database
            $logObj = new Login();
            $is_correct = $logObj->checkActivationDetails($email, $activation_id);
    
            if ($is_correct == 1) {
                return view('mail.newPassword', ['email' => $email, 'activation_code' => $activation_id]);
            } else {
                return redirect()->route('login');
            }
        } catch(Exception $e) {
            return redirect()->route('login')->with('error', 'Something went wrong');
        }
    }

    // This function used to create new password
    function createPasswordUser(Request $request)
    {
        try {
            $status = '';
            $message = '';
            $email = $request->get("email");
            $activation_id = $request->get("activation_code");

            $validate = $request->validate([
                'password' => 'required|max:20',
                'password_confirmation' => 'required|max:20',
            ]);

            if (!$validate) {
                $this->resetPasswordConfirmUser($activation_id, urlencode($email));
            } else {
                $password = $request->get('password');
                $cpassword = $request->get('password_confirmation');

                if ($password != $cpassword) {
                    return redirect()->back()->with('error', 'Passwords do not match.');
                }

                // Check activation id in database
                $logObj = new Login();
                $is_correct = $logObj->checkActivationDetails($email, $activation_id);

                if ($is_correct == 1) {
                    $logObj->createPasswordUser($email, $password);
                    $status = 'success';
                    $message = 'Password changed successfully';
                } else {
                    $status = 'error';
                    $message = 'Password change failed';
                }
                return redirect()->route('login')->with($status, $message);
            }
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Something went wrong');
        }
    }
}
