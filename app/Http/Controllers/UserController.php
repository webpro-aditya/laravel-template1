<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    /**
    * This function is used to load the user list
    */
    public function userListing(Request $request)
    { 
        $searchText = $request->input('searchText');
        
        $userObj = new User();
        $count = $userObj->userListingCount($searchText);  
        $userRecords = $userObj->userListing($searchText);
            
        return view("admin.users.users", ['searchText' => $searchText,'userRecords' => $userRecords]);
    }

    /**
     * This function is used to load the add new form
     */
    public function addNew()
    {
        $userObj = new User();
        $roles = $userObj->getUserRoles();
        return view("admin.users.addNew", ['roles' => $roles]);
    }

    /**
     * This function is used to add new user to the system
     */
    function addNewUser(Request $request)
    {
        $validate = $request->validate([
            'fname' => 'required|string|max:128',
            'email' => 'required|email|email:rfc,filter',
            'password' => 'required|max:20',
            'cpassword' => 'required|max:20',
            'mobile' => 'required|max:10',
        ]);
            
        try{
            $name = ucwords(strtolower($request->input('fname')));
            $email = $request->input('email');
            $password = $request->input('password');
            $roleId = $request->input('role') ?? 3;  //Employee RoleId(3) added by default
            $mobile = $request->input('mobile');
                    
            $userInfo = [
                'email'=>$email, 
                'password'=>getHashedPassword($password), 
                'roleId'=>$roleId, 
                'name'=> $name,
                'mobile'=>$mobile, 
                'createdBy'=>Auth::user()->roleId, 
                'createdDtm'=>date('Y-m-d H:i:s')
            ];
                    
            $userObj = new User();
            $result = $userObj->addNewUser($userInfo);
                    
            if($result > 0)
            {
                Session::flash('success', 'New User created successfully');
            }
            else
            {
                Session::flash('error', 'User creation failed');
            }
            return redirect()->route('admin.user.addNew');
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * This function is used load user edit information
     * @param int $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    { 
        try{
            $userObj = new User();
            $roles = $userObj->getUserRoles();
            $userInfo = $userObj->getUserInfo($userId);
                
            return view("admin.users.editOld", ['roles' => $roles, 'userInfo' => $userInfo]);
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
        
    }

    /**
     * This function is used to edit the user information
     */
    function editUser(Request $request)
    {
       try{
            $userId = $request->input('userId');
            $name = ucwords(strtolower($request->input('fname')));
            $email = $request->input('email');
            $password = $request->input('password');
            $roleId = $request->input('role') ?? 3;  //Employee RoleId(3) added by default
            $mobile = $request->input('mobile');
                    
            $userInfo = array();
                    
            if(empty($password))
            {
                $userInfo = [
                    'email'=>$email, 
                    'roleId'=>$roleId, 
                    'name'=> $name,
                    'mobile'=>$mobile, 
                    'createdBy'=>Auth::user()->roleId, 
                    'createdDtm'=>date('Y-m-d H:i:s')
                ];
            }
            else
            {
                $userInfo = [
                    'email'=>$email, 
                    'password'=>getHashedPassword($password), 
                    'roleId'=>$roleId, 
                    'name'=> ucwords($name),
                    'mobile'=>$mobile, 
                    'createdBy'=>Auth::user()->roleId, 
                    'createdDtm'=>date('Y-m-d H:i:s')
                ];
            }

            $userObj = new User();
            $result = $userObj->editUser($userInfo, $userId);
                
            if($result == true)
            {
                Session::flash('success', 'User updated successfully');
            }
            else
            {
                Session::flash('error', 'User updation failed');
            }
                    
            return redirect()->route('admin.userListing');
       } catch(Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
       }
    }

    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser(Request $request)
    {
        try{
            $userId = $request->input('userId');
            $userInfo = [
                'isDeleted' => 1,
                'updatedBy' => Auth::user()->userId, 
                'updatedDtm' => date('Y-m-d H:i:s')
            ];
            $userObj = new User();
            $result = $userObj->deleteUser($userId, $userInfo);
            if ($result > 0) { 
                echo(json_encode(array('status'=>TRUE))); 
            } else {
                echo(json_encode(array('status'=>FALSE))); 
            }
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists(Request $request)
    {
        $userId = $request->userId;
        $email = $request->email;

        $userObj = new User();
        if(empty($userId)){
            $result = $userObj->checkEmailExists($email);
        } else {
            $result = $userObj->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }

}
