<?php

use Livewire\Volt\Component;
use Illuminate\Validation\ValidationException;

new class extends Component {

    public $email;
    public $password;
    
    public function submit()
    {
        $request = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:4'],
        ]);

        if(! Auth::attempt(['email' => $this->email, 'password' => $this->password]))
        {
            throw ValidationException::withMessages([
                'email' => 'Email or password do not match!'
            ]);
        }
        session()->regenerate();
        Auth::user()->role !== 'hr' ? $this->redirect('/dashboard') : $this->redirect('/admin-dashboard');
    }
    
}; ?>

<form class="space-y-4" wire:submit="submit">
    <x-input wire:model='email' label="Email" />
    <x-input type="password" wire:model='password' label="Password" />
    <x-button type="submit" label="Login" class="w-full" />
</form>
