<div>
    <div class="relative bg-white px-6 pb-8 pt-10 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
      <div class="mx-auto max-w-md">
        <div class="flex min-h-[64px] w-full items-center justify-start gap-y-1 rounded-md bg-gray-50 p-4">
          <x-icon.arrow-down class="mr-4 h-8 w-8 rounded-full border p-2" />
          <span class="font-bold">ThirdParty</span>
        </div>
        <form wire:submit="deposit" class="divide-y divide-gray-300/50">
          <div class="space-y-6 py-8 text-base leading-7 text-gray-600">
            <span>Deposit melalui <span class="font-bold">ThirdParty</span> tidak dikenakan biaya apapun.</span>
            <x-ui.input 
            label="Masukan Jumlah Deposit" 
            type="number" 
            id="amount" 
            name="amount" 
            wire:model="amount"
            className="[appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"/>            
          </div>
          <x-ui.button type="primary" submit="true">
            {{ __('Deposit Sekarang') }}
          </x-ui.button>
        </form>
      </div>
    </div>
  </div>
  
