<?php

use App\Models\Resident;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public $family_number = "";

    // Kepala Keluarga
    public $headSearch = "";
    public $head_id = null;

    // Anggoat keluarga
    public $memberSearch = "";
    public $members = [];


    #[Computed]
    public function headResults(){
        if(strlen($this->headSearch) < 2){
            return collect();
        }

        return Resident::where('name', 'like', "%{$this->headSearch}%")
            ->orWhere('nik', 'like' , "%{$this->headSearch}%")
            ->limit(5)
            ->get();
    }

    public function selectHead($residentId){
        $this->head_id = $residentId;
        $this->headSearch = '';
    }

    #[Computed]
    public function selectedHead(){
        return $this->head_id ? Resident::find($this->head_id) : null;
    }

    public function removeHead(){
        $this->head_id = null;
    }
    
    #[Computed]
    public function memberResults(){
        if(strlen($this->memberSearch) < 2){
            return collect();
        }

        $excludeIds = collect($this->members)->pluck('resident_id')
            ->push($this->head_id)
            ->filter();

        return Resident::where(function ($q) {
                $q->where('name', 'like', "%{$this->memberSearch}%")
                  ->orWhere('nik', 'like', "%{$this->memberSearch}%");
            })
            ->whereNotIn('id', $excludeIds)
            ->limit(5)
            ->get();
    }


    public function addMember($residentId)
    {
        $resident = Resident::find($residentId);

        $this->members[] = [
            'resident_id' => $resident->id,
            'name' => $resident->name,
            'nik' => $resident->nik,
            'relation' => 'anak',
        ];

        $this->memberSearch = '';
    }

    public function removeMember($index)
    {
        unset($this->members[$index]);
        $this->members = array_values($this->members);
    }

    public function save(){
        
    }
};
?>

<div >
    <form wire:submit="save" class="max-w-6xl mx-auto space-y-6 pb-8">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-purple-600">Data keluarga baru</p>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-1">Tambah Keluarga</h2>
                <p class="text-sm text-gray-500 mt-2">Lengkapi informasi KK dan susun anggota keluarga.</p>
            </div>
            <div class="text-sm text-gray-500">Data keluarga baru</div>
        </div>

        {{-- No Kartu Keluarga --}}
        <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-6">
            <div class="flex items-start gap-3 mb-5">
                <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center text-xl">01</div>
                <div>
                    <h3 class="font-bold text-gray-900">Nomor Kartu Keluarga</h3>
                    <p class="text-sm text-gray-500">Masukkan nomor KK yang akan digunakan untuk keluarga ini.</p>
                </div>
            </div>
            <label for="family_number" class="block text-sm font-semibold text-gray-700 mb-2">Nomor KK <span class="text-red-600">*</span></label>
            <div class="relative max-w-xl">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">#</span>
                <input type="text" id="family_number" value="7201010101010001" maxlength="16" inputmode="numeric" pattern="[0-9]{16}" placeholder="Masukkan 16 digit nomor KK" class="input w-full pl-10 pr-4 py-3 text-lg tracking-widest font-mono" wire:model="family_number">
            </div>
        </section>
        

        {{-- Kepala Keluarga --}}
        <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-6">
            <div class="flex items-start gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl">02</div>
                <div class="flex items-start gap-3">
                    <div><h3 class="font-bold text-gray-900">Tentukan Keluarga</h3><p class="text-sm text-gray-500">Cari warga, pilih kepala keluarga, lalu pilih anggota beserta statusnya.</p></div>
                </div>
            </div>
            <div class="rounded-xl border border-purple-200 bg-purple-50/50 p-4 sm:p-5 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <div><h4 class="font-bold text-gray-900">Kepala Keluarga</h4><p class="text-sm text-gray-500">Pilih satu warga dari daftar.</p></div>
                    <input type="search" wire:model.live="headSearch" placeholder="Cari nama atau NIK..." class="input px-4 py-2.5 w-full sm:w-64">
                </div>

                {{-- Sudah Dipilih --}}
                @if($this->selectedHead)
                    <div class="flex items-center gap-3 p-4 bg-white rounded-xl border border-purple-300">
                        <span class="w-10 h-10 rounded-full bg-purple-700 text-white flex items-center justify-center font-bold">
                            {{ substr($this->selectedHead->name, 0, 1) }}
                        </span>
                        <span class="min-w-0 flex-1">
                            <strong class="block text-gray-900">{{ $this->selectedHead->name }}</strong>
                            <small class="block text-gray-500 font-mono">{{ $this->selectedHead->nik }}</small>
                        </span>
                        <button type="button" wire:click="removeHead" class="text-red-500 text-sm font-semibold">Ganti</button>
                    </div>
                @else
                    @if ($this->headSearch)
                        <div class="rounded-xl border border-gray-200 bg-white divide-y divide-gray-100 overflow-hidden">
                            @forelse ($this->headResults as $resident)
                                <button type="button" wire:click="selectHead({{ $resident->id }})"
                                    class="w-full flex items-center gap-3 p-4 hover:bg-gray-50 text-left">
                                    <span class="w-10 h-10 rounded-full bg-purple-700 text-white flex items-center justify-center font-bold">
                                        {{ substr($resident->name, 0, 1) }}
                                    </span>
                                    <span class="min-w-0 flex-1">
                                        <strong class="block text-gray-900">{{ $resident->name }}</strong>
                                        <small class="block text-gray-500 font-mono">{{ $resident->nik }}</small>
                                    </span>
                                </button>
                            @empty
                                <p class="p-4 text-sm text-gray-400">Tidak ada warga ditemukan.</p>
                            @endforelse
                        </div>
                    @endif
                @endif
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                <div><h4 class="font-bold text-gray-900">Anggota Keluarga</h4><p class="text-sm text-gray-500">Pilih warga lain dan tentukan status dalam keluarga.</p></div>
                <input type="search" wire:model.live="memberSearch" placeholder="Cari nama atau NIK..." class="input px-4 py-2.5 w-full sm:w-64">
            </div>

            {{-- Hasil pencarian anggota --}}
            @if ($this->memberSearch)
                <div class="rounded-xl border border-gray-200 bg-white divide-y divide-gray-100 overflow-hidden mb-4">
                    @forelse ($this->memberResults as $resident)
                        <button type="button" wire:click="addMember({{ $resident->id }})"
                            class="w-full flex items-center gap-3 p-4 hover:bg-gray-50 text-left">
                            <span class="min-w-0 flex-1">
                                <strong class="block text-gray-900">{{ $resident->name }}</strong>
                                <small class="block text-gray-500 font-mono">{{ $resident->nik }}</small>
                            </span>
                            <span class="text-purple-600 text-sm font-semibold">+ Tambah</span>
                        </button>
                    @empty
                        <p class="p-4 text-sm text-gray-400">Tidak ada warga ditemukan.</p>
                    @endforelse
                </div>
            @endif

            {{-- Daftar anggota yang sudah dipilih --}}
            <div class="rounded-xl border border-gray-200 divide-y divide-gray-100 overflow-hidden">
                @forelse ($members as $index => $member)
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3 p-4">
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-gray-900">{{ $member['name'] }}</div>
                            <div class="text-xs font-mono text-gray-500 mt-0.5">{{ $member['nik'] }}</div>
                        </div>
                        <div class="sm:w-56">
                            <select wire:model="members.{{ $index }}.relation" class="input px-3 py-2 w-full">
                                <option value="suami">Suami</option>
                                <option value="istri">Istri</option>
                                <option value="anak">Anak</option>
                                <option value="orang_tua">Orang Tua</option>
                                <option value="saudara">Saudara</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <button type="button" wire:click="removeMember({{ $index }})"
                            class="shrink-0 text-red-500 hover:bg-red-50 rounded-lg p-2 transition">🗑</button>
                    </div>
                @empty
                    <p class="p-4 text-sm text-gray-400">Belum ada anggota ditambahkan.</p>
                @endforelse
            </div>
        </section>

        {{-- Anggota Keluarga --}}
        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
            <a href="{{ route('dashboard.list-family') }}" class="text-center bg-gray-100 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-200 transition-colors">Batal</a>
            <button type="submit" class="bg-purple-700 text-white px-6 py-3 rounded-xl hover:bg-purple-800 transition-colors shadow-md">💾 Simpan Keluarga</button>
        </div>
    </form>
</div>
