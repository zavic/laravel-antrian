<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class UserListLivewire extends Component
{
    public $edit_user_id;
    public $edit_name;
    public $edit_role;
    public $edit_email;
    public $edit_address;
    public $edit_phone;

    public $search = '';

    public $isViewAddress = false;

    public function editUser($item)
    {
        $this->edit_user_id = $item['id'];
        $this->edit_name = $item['name'];
        $this->edit_role = $item['role'];
        $this->edit_email = $item['email'];
        $this->edit_address = $item['address'];
        $this->edit_phone = $item['phone'];
    }

    public function cancel()
    {
        $this->edit_user_id = NULL;
        $this->edit_name = NULL;
        $this->edit_role = NULL;
        $this->edit_email = NULL;
        $this->edit_address = NULL;
        $this->edit_phone = NULL;
    }

    public function update()
    {
        User::findOrFail($this->edit_user_id)->update([
            'name' =>  $this->edit_name,
            'role' => $this->edit_role,
            'email' => $this->edit_email,
            'address' => $this->edit_address,
            'phone' => $this->edit_phone,
        ]);

        $this->cancel();
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('user-list');
    }

    public function viewAddress()
    {
        $this->isViewAddress = !$this->isViewAddress;
    }

    public function render(Request $request)
    {
        $users = User::search($this->search)->paginate(5);

        return view('livewire.user-list-livewire', compact('users'));
    }
}
