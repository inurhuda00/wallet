<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

class TransactionModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.modal.transaction-modal');
    }
}
