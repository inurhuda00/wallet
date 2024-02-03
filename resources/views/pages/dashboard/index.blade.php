<?php

use App\Models\Transaction;
use function Laravel\Folio\{middleware, name};
use function Livewire\Volt\{state, rules};
use function Livewire\Volt\{with, usesPagination};
use function Livewire\Volt\{on};

name('dashboard');
middleware(['auth', 'verified']);

usesPagination();

on(['deposit']);

with(
    fn() => [
        'transactions' => Auth::user()
            ->transactions()
            ->latest()
            ->paginate(10),
        'balance' => Auth::user()->total(),
    ],
);
?>

<x-layouts.app>
    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @volt('dashboard')
        <div class="h-full py-12">
            <div class="h-full mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="relative min-h-[500px] w-full h-full px-4">
                    <div
                        class="rounded-lg bg-gray-50 px-4 py-6 sm:flex sm:items-center sm:justify-between sm:space-x-6 sm:px-6 lg:space-x-8">
                        <dl
                            class="flex-auto space-y-6 divide-y divide-gray-200 text-sm text-gray-600 sm:grid sm:grid-cols-3 sm:gap-x-6 sm:space-y-0 sm:divide-y-0 lg:w-1/2 lg:flex-none lg:gap-x-8">
                            <div class=" pt-6 font-medium text-gray-900 sm:block sm:pt-0">
                                <dt>Balance</dt>
                                <dd class="flex items-center gap-x-4 mt-1 font-bold text-2xl whitespace-nowrap">
                                    @currency($balance)
                                    <x-ui.badge background="bg-gray-200" class=" w-8 h-8 cursor-pointer border border-black"
                                        wire:click="$refresh">
                                        <x-icon.reload />
                                    </x-ui.badge>
                                </dd>

                            </div>
                        </dl>


                        <div class="inline-flex gap-x-2 mt-6 sm:mt-0">
                            <x-ui.button class="inline-block" type="primary" x-data
                                wire:click="$dispatch('openModal', { component: 'deposit-modal' })">
                                <x-icon.arrow-down class="mr-4 border rounded-full p-2 w-8 h-8" />
                                Deposit
                            </x-ui.button>
                            <x-ui.button class="inline-block" type="primary" x-data
                                wire:click="$dispatch('openModal', { component: 'withdraw-modal' })">
                                <x-icon.arrow-top-right class="mr-4 border rounded-full p-2 w-8 h-8" />
                                Withdraw
                            </x-ui.button>
                        </div>
                    </div>

                    <table class="w-full text-gray-500 mt-6">
                        <caption class="mb-4 font-medium text-left text-xl">
                            Transaction History
                        </caption>
                        <tbody class="divide-y divide-gray-200 border-b border-gray-200 text-sm sm:border-t">

                            @forelse ($transactions as $transaction)
                                <tr x-data wire:click="$dispatch('openModal', { component: 'transaction-modal' })"
                                    class="cursor-pointer">
                                    <td class="py-6 pr-8">
                                        @if (App\Enums\TransactionType::DEPOSIT->equals($transaction->type))
                                            <x-icon.arrow-down class="mr-4 border rounded-full p-2 w-8 h-8" />
                                        @elseif (App\Enums\TransactionType::WITHDRAW->equals($transaction->type))
                                            <x-icon.arrow-top-right class="mr-4 border rounded-full p-2 w-8 h-8" />
                                        @endif
                                    </td>
                                    <td class="py-6 pr-8 sm:table-cell capitalize">{{ $transaction->type }} from third
                                        party</td>
                                    <td class="hidden py-6 pr-8 sm:table-cell capitalize">
                                        @if (App\Enums\TransactionType::DEPOSIT->equals($transaction->type))
                                            <x-ui.badge background="text-green-600">
                                                {{ $transaction->type }}
                                            </x-ui.badge>
                                        @elseif (App\Enums\TransactionType::WITHDRAW->equals($transaction->type))
                                            <x-ui.badge background="text-red-600">
                                                {{ $transaction->type }}
                                            </x-ui.badge>
                                        @endif

                                    </td>
                                    <td class="whitespace-nowrap py-6 text-right grid">
                                        <span class="font-medium">
                                            @currency($transaction->add)
                                        </span>
                                        <span>{{ $transaction->created_at->format('d M Y') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">No Transactions records</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    @endvolt


</x-layouts.app>
