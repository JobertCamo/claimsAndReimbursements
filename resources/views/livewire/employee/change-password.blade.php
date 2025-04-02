<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

new class extends Component {
    
    public $current_password;
    public $password;
    public $password_confirmation;

    public function submit()
    {
        $validated = $this->validate([
            "current_password" => ['required', 'current_password'],
            "password" => ['required', 'confirmed'],
            "password_confirmation" => ['required']
        ]);

        $user = Auth::user();
        $user->update([
            "password" => Hash::make($this->password),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');
        $this->dispatch('success');
    }
    
}; ?>

<div class="p-4 space-y-5">
    <x-notification on="success" >
        <x-alert title="Password Changed!" positive solid />
    </x-notification>
    <div class="text-xl">Change Password</div>
    <form wire:submit='submit' class="space-y-5">
        <div class=" p-2">
            <x-input type="password" wire:model="current_password" label="Current Password" />
        </div>
        <div class=" p-2">
            <x-input type="password" wire:model="password" label="New Password" />
        </div>
        <div class=" p-2">
            <x-input type="password" wire:model="password_confirmation" label="Confirm New Password" />
        </div>
        <x-button type="submit" label="Change Password" class="w-full" />
    </form>
    
</div>
