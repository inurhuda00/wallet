<div>
    <div class="relative bg-white px-6 pb-8 pt-10 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
        <div class="mx-auto max-w-md">
            <div
                class="flex min-h-[120px] flex-col items-center gap-y-1 bg-gray-50 p-4 rounded-md">
                <x-icon.arrow-down
                    class="mr-4 border rounded-full p-2 w-8 h-8"
                />
                <p class="mt-2 text-2xl font-bold">
                    Rp. {{ number_format(1000000, 2, ",", ".") }}
                </p>
                <p>Deposit</p>
            </div>
            <div class="divide-y divide-gray-300/50">
                <div class="space-y-6 py-8 text-base leading-7 text-gray-600">
                    <p>Rincian Transaksi</p>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <p>status</p>
                            <p class="ml-auto text-green-600 font-medium">
                                Success
                            </p>
                        </li>
                        <li class="flex items-center">
                            <p>waktu</p>
                            <p class="ml-auto">{{ now()->format('h:iA')}}</p>
                        </li>
                        <li class="flex items-center">
                            <p>tanggal</p>
                            <p class="ml-auto">{{ now()->format('d M Y') }}</p>
                        </li>
                        <li class="flex items-center">
                            <p>ID transaksi</p>
                            <p class="ml-auto">{{ uniqid() }}</p>
                        </li>
                        <li class="flex items-center pt-4">
                            <p>Jumlah</p>
                            <p class="ml-auto">
                                Rp. {{ number_format(1000000, 2, ",", ".") }}
                            </p>
                        </li>
                        <hr />
                        <li class="flex items-center font-medium">
                            <p>Total</p>
                            <p class="ml-auto">
                                Rp. {{ number_format(1000000, 2, ",", ".") }}
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
