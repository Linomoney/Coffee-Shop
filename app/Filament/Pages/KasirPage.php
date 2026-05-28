<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use App\Models\Menu;
use App\Models\Kategori;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KasirPage extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Kasir';
    protected static ?string $title = 'Kasir';
    protected static string | \UnitEnum | null $navigationGroup = 'Kasir';
    protected static ?int $navigationSort = 1;
    protected string $view = 'filament.pages.kasir-page';

    // State
    public string $cariMenu = '';
    public ?int $kategoriAktif = null;
    public array $keranjang = [];
    public string $nomorMeja = '';
    public string $caraBayar = 'tunai';
    public ?int $detailMenuId = null;
    public bool $showDetail = false;
    public bool $showStruk = false;
    public ?array $strukData = null;

    public function mount(): void
    {
        $this->keranjang = [];
    }

    public function getMenuList()
    {
        return Menu::with('kategori')
            ->where('tersedia', true)
            ->when($this->kategoriAktif, fn($q) => $q->where('kategori_id', $this->kategoriAktif))
            ->when($this->cariMenu, fn($q) => $q->where('nama', 'like', '%'.$this->cariMenu.'%'))
            ->get();
    }

    public function getKategoriList()
    {
        return Kategori::withCount(['menu' => fn($q) => $q->where('tersedia', true)])->get();
    }

    public function getDetailMenu()
    {
        if (!$this->detailMenuId) return null;
        return Menu::with('kategori')->find($this->detailMenuId);
    }

    public function getTotalKeranjang(): int
    {
        return collect($this->keranjang)->sum('jumlah');
    }

    public function getTotalHarga(): int
    {
        return collect($this->keranjang)->sum(fn($item) => $item['harga'] * $item['jumlah']);
    }

    public function tambahKeKeranjang(int $menuId): void
    {
        $menu = Menu::find($menuId);
        if (!$menu || !$menu->tersedia) {
            Notification::make()->title('Menu tidak tersedia')->danger()->send();
            return;
        }

        $idx = collect($this->keranjang)->search(fn($i) => $i['id'] === $menuId);
        if ($idx !== false) {
            $this->keranjang[$idx]['jumlah']++;
        } else {
            $this->keranjang[] = [
                'id'     => $menu->id,
                'nama'   => $menu->nama,
                'harga'  => $menu->harga,
                'gambar' => $menu->gambar,
                'jumlah' => 1,
                'catatan'=> '',
            ];
        }
        $this->showDetail = false;
    }

    public function kurangiItem(int $menuId): void
    {
        $idx = collect($this->keranjang)->search(fn($i) => $i['id'] === $menuId);
        if ($idx === false) return;
        if ($this->keranjang[$idx]['jumlah'] > 1) {
            $this->keranjang[$idx]['jumlah']--;
        } else {
            array_splice($this->keranjang, $idx, 1);
        }
    }

    public function hapusItem(int $menuId): void
    {
        $this->keranjang = collect($this->keranjang)
            ->filter(fn($i) => $i['id'] !== $menuId)
            ->values()
            ->toArray();
    }

    public function kosongkanKeranjang(): void
    {
        $this->keranjang = [];
        $this->nomorMeja = '';
    }

    public function lihatDetail(int $menuId): void
    {
        $this->detailMenuId = $menuId;
        $this->showDetail   = true;
    }

    public function tutupDetail(): void
    {
        $this->showDetail   = false;
        $this->detailMenuId = null;
    }

    public function setKategori(?int $id): void
    {
        $this->kategoriAktif = $id;
    }

    public function checkout(): void
    {
        if (empty($this->keranjang)) {
            Notification::make()->title('Keranjang masih kosong!')->warning()->send();
            return;
        }
        if (empty($this->nomorMeja)) {
            Notification::make()->title('Nomor meja belum diisi!')->warning()->send();
            return;
        }

        $karyawan = Auth::user()->karyawan;

        $pesanan = Pesanan::create([
            'pengguna_id'  => Auth::id(),
            'karyawan_id'  => $karyawan?->id,
            'kode_pesanan' => 'PSN-' . strtoupper(Str::random(6)),
            'nomor_meja'   => $this->nomorMeja,
            'status'       => 'selesai',
            'total_harga'  => $this->getTotalHarga(),
            'cara_bayar'   => $this->caraBayar,
            'dipesan_pada' => now(),
        ]);

        foreach ($this->keranjang as $item) {
            DetailPesanan::create([
                'pesanan_id'   => $pesanan->id,
                'menu_id'      => $item['id'],
                'jumlah'       => $item['jumlah'],
                'harga_satuan' => $item['harga'],
                'subtotal'     => $item['harga'] * $item['jumlah'],
                'catatan'      => $item['catatan'] ?? '',
            ]);
        }

        // Siapkan data struk
        $this->strukData = [
            'kode'       => $pesanan->kode_pesanan,
            'meja'       => $this->nomorMeja,
            'cara_bayar' => $this->caraBayar,
            'items'      => $this->keranjang,
            'total'      => $this->getTotalHarga(),
            'kasir'      => Auth::user()->nama,
            'waktu'      => now()->format('d/m/Y H:i'),
        ];

        $this->showStruk = true;
        $this->keranjang = [];
        $this->nomorMeja = '';

        Notification::make()
            ->title('✅ Pesanan berhasil! Kode: ' . $pesanan->kode_pesanan)
            ->success()
            ->send();
    }

    public function tutupStruk(): void
    {
        $this->showStruk = false;
        $this->strukData = null;
    }
}