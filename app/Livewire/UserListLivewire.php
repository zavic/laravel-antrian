<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class UserListLivewire extends Component
{
    use WithPagination;

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
        $this->edit_user_id = null;
        $this->edit_name = null;
        $this->edit_role = null;
        $this->edit_email = null;
        $this->edit_address = null;
        $this->edit_phone = null;
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

        return redirect()->route('user-list')->with('success', 'User Berhasil Diupdate');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('user-list')->with('success', 'User berhasil dihapus');
    }

    public function viewAddress()
    {
        $this->isViewAddress = !$this->isViewAddress;
    }

    public function render(Request $request)
    {
        $users = User::search($this->search)->paginate(10);

        return view('livewire.user-list-livewire', compact('users'));
    }
}
