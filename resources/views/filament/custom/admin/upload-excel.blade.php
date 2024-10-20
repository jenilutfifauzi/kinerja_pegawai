<div>
    <x-filament::breadcrumbs :breadcrumbs="[
        '/admin/data-penilaians' => 'Data Penilaian',
        '' => 'List',
    ]">

    </x-filament::breadcrumbs>
    <div class="flex justify-between mt-1">
        <h2 class="text-3xl font-bold">Data Penilaian </h2>
    </div>
    <div class="mt-4">
        <form wire:submit="save" class="w-full max-w-sm flex mt-2">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="fileinput">
                    Pilih berkas
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-3"
                    id="fileinput" type="file" wire:model="file">
            </div>
            <div class="flex items-center justify-between mt-3 space-x-4">
                <x-filament::button type="submit">
                    Submit
                </x-filament::button>
                <x-filament::button
                    href="{{ asset('assets/files/template form data penilaian - kinerja pegawai.xlsx') }}"
                    icon="heroicon-s-arrow-down-tray"
                    tag="a"
                    color="success"
                    >Template
                    
                </x-filament::button>
            </div>
        </form>
    </div>
</div>
