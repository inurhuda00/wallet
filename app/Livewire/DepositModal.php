<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class DepositModal extends ModalComponent
{
    public $amount = 0;

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function deposit()
    {
        $this->validate([
            'amount' => 'required|numeric|max_digits:9|min:1000',
        ]);

        Auth::user()->deposit($this->amount);

        $this->dispatch('toast', message: 'Success deposit via ThirdParty', data: ['position' => 'top-right', 'type' => 'success']);

        $this->closeModal();

        $this->dispatch('refresh-list');
        $this->dispatch('deposit');
    }

    public function render()
    {
        return view('livewire.modal.deposit-modal');
    }
}
