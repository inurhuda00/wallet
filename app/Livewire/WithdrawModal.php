<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class WithdrawModal extends ModalComponent
{
    #[Validate('required|numeric|min:1000')]
    public $amount = 0;

    public $balance = 0;

    public function mount()
    {
        $this->balance = Auth::user()->balance();
    }

    public function boot()
    {
        $this->withValidator(function ($validator) {
            $validator->after(function ($validator) {
                // Validate saldo setelah transaksi
                if ($this->balance + $this->amount < 0) {
                    $validator->errors()->add('amount', 'Balance minus, Insufficient balance for Withdraw.');
                }
                // Validasi jumlah
                if ($this->balance >= 0) {
                    $validator->errors()->add('amount', 'Withdraw amount must be less than 0.');
                }
            });
        });
    }

    public function withdraw()
    {
        $this->validate();
        try {
            Auth::user()->withdraw($this->amount);
            $this->dispatch('toast', message: 'Success withdraw via ThirdParty', data: ['position' => 'top-right', 'type' => 'success']);

            $this->closeModal();

            $this->dispatch('refresh-list');
            $this->dispatch('deposit');
        } catch (\Throwable $th) {
            $this->dispatch('toast', message: $th->getMessage(), data: ['position' => 'top-right', 'type' => 'danger']);
        }

    }

    public function render()
    {
        return view('livewire.modal.withdraw-modal');
    }
}
