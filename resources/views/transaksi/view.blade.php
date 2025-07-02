@extends('layoutbootstrap')

@section('konten')

<div class="body-wrapper">
  <style>
    /* Header Section */
    .section-header {
        text-align: center;
        padding: 20px 0;
        background: linear-gradient(90deg, #052bab, #4f8df3);
        color: white;
        border-radius: 15px;
        margin: 20px;
    }
    .section-header h1 { font-size: 2rem; margin-bottom: 5px; }
    .section-header p { font-size: 1rem; opacity: 0.9; }
    .underline {
        width: 80px;
        height: 4px;
        background: white;
        margin: 10px auto 0;
        border-radius: 2px;
    }

    /* Category Section */
    .category-section { margin: 20px 0; }
    .category-title {
        font-size: 1.5rem;
        color: #052bab;
        margin-left: 20px;
        margin-bottom: 10px;
        font-weight: 600;
    }

    /* Horizontal Scroll Container */
    .scroll-container {
        display: grid;
        grid-auto-flow: column;
        grid-auto-columns: calc((100% - 2rem) / 3);
        gap: 1rem;
        overflow-x: auto;
        padding: 0 20px;
    }
    .scroll-container::-webkit-scrollbar { height: 6px; }
    .scroll-container::-webkit-scrollbar-thumb {
        background-color: rgba(0,0,0,0.2);
        border-radius: 3px;
    }

    .product-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 2px solid #bddcff;
        position: relative;
        display: flex;
        flex-direction: column;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
    }
    .product-image {
        width: 100%;
        height: 140px;
        object-fit: cover;
        border-bottom: 2px solid #bddcff;
    }
    .product-body {
        padding: 1rem;
        background: #f8fbff;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .product-title {
        color: #052bab;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .product-price {
        color: #28a745;
        font-size: 0.95rem;
        font-weight: bold;
        margin-bottom: 0.75rem;
    }
    .product-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-order {
        background: #052bab;
        color: white;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        transition: background 0.3s ease;
    }
    .btn-order:hover { background: #001e6b; }
    .category-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: linear-gradient(45deg, #ff7b00, #ffa94d);
        color: white;
        font-size: 0.7rem;
        font-weight: bold;
        padding: 3px 8px;
        border-radius: 12px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    /* Terlaris Badge Animation */
    .badge.bg-success {
        font-size: 0.75rem;
        margin-left: 5px;
        animation: pulse 1.5s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.1); opacity: 0.8; }
        100% { transform: scale(1); opacity: 1; }
    }

    /* NEW QUANTITY CONTROLS */
    .quantity-control {
        display: flex;
        align-items: center;
        background: #f0f6ff;
        border-radius: 12px;
        padding: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .quantity-input {
        width: 45px;
        border: none;
        background: transparent;
        text-align: center;
        font-weight: bold;
        color: #052bab;
        font-size: 1rem;
        padding: 0.3rem;
        -moz-appearance: textfield;
    }
    .quantity-input::-webkit-outer-spin-button,
    .quantity-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .quantity-btn {
        width: 32px;
        height: 32px;
        border: none;
        background: #052bab;
        color: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .quantity-btn:hover {
        background: #001e6b;
        transform: scale(1.1);
    }
    .quantity-btn i {
        font-size: 1.2rem;
    }

    /* ENHANCED CHECKOUT SECTION */
    .cart-container {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        margin: 2rem 20px;
        border: 2px solid #e3f2ff;
    }
    .cart-title {
        font-size: 1.5rem;
        color: #052bab;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid #f0f6ff;
    }
    .cart-title i {
        font-size: 1.8rem;
        color: #4f8df3;
    }
    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #f0f6ff;
        font-size: 1rem;
        color: #333;
    }
    .cart-item:last-child {
        border-bottom: none;
    }
    .cart-total {
        text-align: right;
        font-size: 1.3rem;
        color: #052bab;
        padding: 1.5rem 0;
        margin-top: 1rem;
        border-top: 2px solid #f0f6ff;
    }
    .checkout-btn {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, #052bab 0%, #4f8df3 100%);
        color: white;
        border: none;
        border-radius: 15px;
        font-size: 1.1rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
    }
    .checkout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(79, 141, 243, 0.4);
    }
    .checkout-btn i {
        font-size: 1.4rem;
    }
  </style>

  <!-- Header -->
  <div class="section-header">
      <h1>Transaksi Penjualan</h1>
      <p>Pilih produk favoritmu di tiap kategori!</p>
      <div class="underline"></div>
  </div>

  @php
    $categories = [
      'Menu Utama' => 'Menu Utama',
      'Minuman' => 'Minuman',
      'Topping' => 'Topping',
      'Menu Tambahan' => 'Menu Tambahan',
    ];
  @endphp

  @foreach($categories as $key => $label)
    @php
      $group = $produk->where('kategori', $key);
      $topInCat = $group->sortByDesc('jumlah_laku')->pluck('id')->take(3)->toArray();
    @endphp
    @if($group->isNotEmpty())
    <div class="category-section">
      <div class="category-title">{{ $label }}</div>
      <div class="scroll-container">
        @foreach($group as $P)
        <div class="product-card">
          @if($P->kategori)
          <span class="category-badge">{{ $label }}</span>
          @endif
          @if($P->gambar)
          <img src="data:image/jpeg;base64,{{ base64_encode($P->gambar) }}" class="product-image" alt="{{ $P->nama_produk }}">
          @else
          <div class="product-image bg-light d-flex align-items-center justify-content-center">
            <i class="ti ti-photo-off" style="font-size: 1.5rem; color: #052bab;"></i>
          </div>
          @endif
          <div class="product-body">
            <div>
              <h3 class="product-title">
                {{ $P->nama_produk }}
                @if(in_array($P->id, $topInCat))
                @php $rank = array_search($P->id, $topInCat) + 1; @endphp
                <span class="badge bg-success">#{{ $rank }} Terlaris{!! str_repeat('!', $rank) !!}</span>
                @endif
              </h3>
              <div class="product-price">Rp {{ number_format($P->harga, 0, ',', '.') }}</div>
            </div>
            <div class="product-actions">
              <div class="quantity-control">
                <button class="quantity-btn decrement"><i class="ti ti-minus"></i></button>
                <input type="number" class="quantity-input" value="1" min="1" max="10">
                <button class="quantity-btn increment"><i class="ti ti-plus"></i></button>
              </div>
              <button class="btn-order" data-id="{{ $P->id }}" data-nama="{{ $P->nama_produk }}" data-harga="{{ $P->harga }}">
                <i class="ti ti-shopping-cart"></i> Beli
              </button>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif
  @endforeach

  <!-- Cart Section -->
  <div class="cart-container mx-3 mt-4">
      <div class="cart-title no-print"><i class="ti ti-shopping-cart"></i> Keranjang</div>
      <div id="cart-items"></div>
      <div class="cart-total mt-2"><strong>Total: Rp <span id="cart-total">0</span></strong></div>
      <button class="checkout-btn no-print" id="checkout-btn">Checkout</button>
  </div>
</div>

<script>
  let cart = [];

  // Quantity Control Logic
  document.querySelectorAll('.quantity-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const input = btn.parentElement.querySelector('.quantity-input');
      let value = parseInt(input.value);
      
      if(btn.classList.contains('increment')) {
        value = value < 10 ? value + 1 : 10;
      } else {
        value = value > 1 ? value - 1 : 1;
      }
      
      input.value = value;
    });
  });

  // Existing Order Logic
  document.querySelectorAll('.btn-order').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;
      const nama = btn.dataset.nama;
      const harga = parseInt(btn.dataset.harga);
      const qtyInput = btn.closest('.product-actions').querySelector('.quantity-input');
      const qty = parseInt(qtyInput.value);
      const existing = cart.find(i => i.id == id);
      if (existing) {
        existing.qty += qty;
        existing.subtotal = existing.qty * harga;
      } else {
        cart.push({ id, nama, harga, qty, subtotal: qty * harga });
      }
      updateCartUI();
      const card = btn.closest('.product-card');
      card.classList.add('animate-add'); setTimeout(() => card.classList.remove('animate-add'), 500);
    });
  });

  // Existing Checkout Logic
  document.getElementById('checkout-btn').addEventListener('click', () => {
    if (!cart.length) return Swal.fire('Keranjang kosong!', 'Silakan tambahkan produk.', 'warning');
    fetch('{{ route('transaksi.store') }}', {
      method: 'POST', headers: {'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
      body: JSON.stringify({ items: cart.map(i => ({ produk_id: i.id, jumlah: i.qty })) })
    })
    .then(r => r.json()).then(data => { Swal.fire('Berhasil!', data.message, 'success'); cart=[]; updateCartUI(); })
    .catch(() => Swal.fire('Error!', 'Gagal menyimpan transaksi.', 'error'));
  });

  function updateCartUI() {
    const itemsEl = document.getElementById('cart-items');
    const totalEl = document.getElementById('cart-total');
    itemsEl.innerHTML = '';
    let total = 0;
    cart.forEach(item => {
      const row = document.createElement('div');
      row.className = 'cart-item';
      row.innerHTML = `<span>${item.nama} x ${item.qty}</span><span>Rp ${item.subtotal.toLocaleString()}</span>`;
      itemsEl.appendChild(row);
      total += item.subtotal;
    });
    totalEl.innerText = total.toLocaleString();
  }
</script>

@endsection