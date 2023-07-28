<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Notification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendNotification(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $request->validate([
                    'message' => 'required|string|max:255',
                ]);
                $userIds = User::where('is_role', 1)->pluck('id');
                if(isset($userIds[1]) && !empty($userIds[1])){
                    foreach($userIds as $key=>$val){
                        $noti = new Notification();
                        $noti->user_id = $val;
                        $noti->message = $this->textTOspech($request->message);
                        $noti->save();
                    }
                    return redirect()->back()->with([
                        'status' => 'success',
                        'message' => 'Notification sent successfully.'
                    ]);
                } else {
                    return redirect()->back()->with([
                        'status' => 'danger',
                        'message' => 'User not found, Please add user.'
                    ]);               
                }
            } else {
                return view('admin.users.notification');
            }
        } catch(\Exception $e){
            return redirect()->back()->with([
                'status' => 'danger',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('is_role', 1)->orderBy('id', 'DESC')->get();
        return view('admin.users.form', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Added user successfully.'
        ]);
    }

    public function textTOspech($message)
    {
            $message1 = htmlspecialchars($message);
            $message2 = rawurlencode($message1);
            $decodeFile = file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$message.'&tl=en');
            $file = "<audio controls='controls' autoplay='autoplay'><source src='<?php echo $decodeFile; ?>' type='audio/mp3'/></audio>";
            return $file;  
    }
}
