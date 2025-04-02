<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

new class extends Component {
    use WithFileUploads;

    public $profile_pic;

    public function submit()
    {
        $this->validate([
            'profile_pic' => ['required', File::types(['png', 'jpg', 'jpeg'])]
        ]);

        $user = Auth::user();
        
        if ($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)){
            Storage::disk('public')->delete($user->profile_pic);
        }

        $file = $this->profile_pic->store('profiles', 'public');

        $user->profile_pic = $file;

        $user->save();

        $this->redirect('/my-profile');
    }
    
}; ?>

<div class="space-y-3">
    <div>Change Profile</div>
    <form wire:submit='submit' class="space-y-3">
        <x-input wire:model='profile_pic' type="file" />
        <x-button type="submit" class="w-full" label="save" />
    </form>
</div>
