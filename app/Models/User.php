<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'tbl_users';

    protected $primaryKey = 'userId';

    public $timestamps = false;

    protected $fillable = [
        'roleId',
        'stripe_customer_id',
        'name',
        'email',
        'password',
        'mobile',
        'status',
        'isDeleted'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return array $result : This is result
     */
    public function userListing($searchText = '')
    {
        $query = DB::table($this->table)
            ->select('tbl_users.userId', 'tbl_users.email', 'tbl_users.name', 'tbl_users.mobile', 'tbl_roles.role')
            ->join('tbl_roles', 'tbl_roles.roleId', '=', 'tbl_users.roleId');
        if (!empty($searchText)) {
            $query = $query->where('tbl_users.email', 'LIKE', '%".$searchText."%')
                ->orWhere('tbl_users.name', 'LIKE', '%".$searchText."%')
                ->orWhere('tbl_users.mobile', 'LIKE', '%".$searchText."%');
        }
        $query = $query->where('tbl_users.isDeleted', 0)
            ->where('tbl_users.roleId', '!=', 1)
            ->orderBy('tbl_users.userId');
        $result = $query->paginate(5);
        return $result;
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return int $queryCount : This is row count
     */
    public function userListingCount($searchText = '')
    {
        $query = DB::table($this->table)
            ->select('tbl_users.userId, tbl_users.email, tbl_users.name, tbl_users.mobile, tbl_roles.role')
            ->join('tbl_roles', 'tbl_roles.roleId', '=', 'tbl_users.roleId');
        if (!empty($searchText)) {
            $query = $query->where('tbl_users.email', 'LIKE', '%".$searchText."%')
                ->orWhere('tbl_users.name', 'LIKE', '%".$searchText."%')
                ->orWhere('tbl_users.mobile', 'LIKE', '%".$searchText."%');
        }
        $query = $query->where('tbl_users.isDeleted', 0)
            ->where('tbl_users.roleId', '!=', 1);
        $queryCount = $query->count();

        return $queryCount;
    }

    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    public function getUserRoles()
    {
        $query = DB::table('tbl_roles')
            ->select('roleId', 'role')
            ->where('roleId', '!=', 1);
        $query = $query->get();
        return $query->toArray();
    }

    /**
     * This function is used to add new user to system
     * @return int $insert_id : This is last inserted id
     */
    public function addNewUser($userInfo)
    {
        $insert_id = DB::table($this->table)
            ->insertGetId($userInfo);
        return $insert_id;
    }

    /**
     * This function used to get user information by id
     * @param int $userId : This is user id
     * @return array $result : This is user information
     */
    public function getUserInfo($userId)
    {
        $query = DB::table($this->table)
            ->select('userId', 'name', 'email', 'mobile', 'roleId')
            ->where('isDeleted', 0)
            ->where('roleId', '!=', 1)
            ->where('userId', $userId)
            ->get();

        $result = $query->toArray();
        return $result;
    }

    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param int $userId : This is user id
     */
    public function editUser($userInfo, $userId)
    {
        DB::table($this->table)
            ->where('userId', $userId)
            ->update($userInfo);
        return true;
    }

    /**
     * This function is used to delete the user information
     * @param int $userId : This is user id
     * @return int $query
     */
    public function deleteUser($userId, $userInfo)
    {
        $query = DB::table($this->table)
            ->where('userId', $userId)
            ->update($userInfo);
        return $query;
    }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    public function checkEmailExists($email, $userId = 0)
    {
        $query = DB::table($this->table)
            ->select("email")
            ->where("email", $email)
            ->where("isDeleted", 0);
        if ($userId != 0) {
            $query = $query->where("userId !=", $userId);
        }
        $query = $query->get();

        return $query->toArray();
    }
}
