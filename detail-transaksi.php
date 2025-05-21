<?php
include "functions.php";

checkLogin();

 $role = $_SESSION['role_user'];

$detail_transaksi = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $transaction_id = $_GET['id'];

    $detail_transaksi = get_transaksi_by_id($transaction_id);

} 
?>

<!DOCTYPE html>
<html x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shoe Store</title>

    <!-- Google Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="./src/css/output.css" />

    <!-- Alpine JS -->
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="./src/js/init-alpine.js"></script>
  </head>
  <body>
    <div
      class="flex h-screen bg-gray-50"
      :class="{ 'overflow-hidden': isSideMenuOpen}"
    >
      <!-- Desktop sidebar -->
      <aside
        class="z-20 flex-shrink-0 hidden w-64 overflow-y-auto bg-white md:block"
      >
        <div class="py-4 text-gray-500 border-r border-gray-100">
          <a class="ml-6 text-lg font-bold text-gray-800" href="#">
            Shoe Store
          </a>
          <!-- Admin menu - Dashboard -->
          <?php if ($role == 'admin') : ?>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800"
                href="home.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  ></path>
                </svg>
                <span class="ml-4">Dashboard</span>
              </a>
            </li>
          </ul>
          <?php endif; ?>
         <ul class="<?= $role == "Pegawai" ? "mt-6" : "mt-0" ?>">
            <!-- Menu admin - Data Pegawai -->
            <?php if ($role == "admin") : ?>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800"
                href="pegawai.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                  ></path>
                </svg>
                <span class="ml-4">Data Pegawai</span>
              </a>
            </li>
            <?php endif; ?>
            <!-- Menu sepatu -->
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800"
                href="sepatu.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                  ></path>
                </svg>
                <span class="ml-4">Sepatu</span>
              </a>
            </li>
            <!-- Riwayat Transaksi -->
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800"
                href="transaksi.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                  ></path>
                </svg>
                <span class="ml-4">Riwayat Transaksi</span>
              </a>
            </li>
          </ul>
          <div class="px-6 my-3">
            <a href="logout.php"
              class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
              <svg
                class="w-4 h-4 mr-3"
                aria-hidden="true"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                ></path>
              </svg>
              Logout
            </a>
          </div>
        </div>
      </aside>

      <!-- Mobile sidebar -->
      <!-- Backdrop -->
      <div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
      ></div>
      <aside
        class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white md:hidden"
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20"
        @click.away="closeSideMenu"
        @keydown.escape="closeSideMenu"
      >
        <div class="py-4 text-gray-500">
          <a class="ml-6 text-lg font-bold text-gray-800" href="#">
            Shoe Store
          </a>
          <?php if ($role == "admin") : ?>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800"
                href="home.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  ></path>
                </svg>
                <span class="ml-4">Dashboard</span>
              </a>
            </li>
          </ul>
          <?php endif; ?>
          <ul class="<?= $role == "Pegawai" ? "mt-6" : "mt-0" ?>">
            <!-- Menu admin - Data Pegawai -->
            <?php if ($role == "admin") : ?>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800"
                href="pegawai.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                  ></path>
                </svg>
                <span class="ml-4">Pegawai</span>
              </a>
            </li>
            <?php endif; ?>
            <!-- Menu sepatu -->
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800"
                href="sepatu.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                  ></path>
                </svg>
                <span class="ml-4">Sepatu</span>
              </a>
            </li>
             <!-- Riwayat Transaksi -->
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800"
                href="transaksi.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                  ></path>
                </svg>
                <span class="ml-4">Riwayat Transaksi</span>
              </a>
            </li>
          </ul>
          <div class="px-6 my-6">
            <a href="logout.php"
              class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
              <svg
                class="w-4 h-4 mr-3"
                aria-hidden="true"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                ></path>
              </svg>
              Logout
            </a>
          </div>
        </div>
      </aside>

      <div class="flex flex-col flex-1">
        <!-- Header Start -->
        <div class="z-10 py-4 bg-white shadow-md">
          <div
            class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 lg:justify-end"
          >
            <!-- Mobile hamburger -->
            <button
              class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
              @click="toggleSideMenu"
              aria-label="Menu"
            >
              <svg
                class="w-6 h-6"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </button>

            <ul class="flex items-center flex-shrink-0 space-x-6">
              <!-- Profile menu -->
              <li class="relative">
                <button
                  class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                  @click="toggleProfileMenu"
                  @keydown.escape="closeProfileMenu"
                  aria-label="Account"
                  aria-haspopup="true"
                >
                  <img
                    class="object-cover w-8 h-8 rounded-full"
                    src="https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82"
                    alt=""
                    aria-hidden="true"
                  />
                </button>
                <template x-if="isProfileMenuOpen">
                  <ul
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click.away="closeProfileMenu"
                    @keydown.escape="closeProfileMenu"
                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md"
                    aria-label="submenu"
                  >
                    <li class="flex">
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800"
                        href="logout.php"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                          ></path>
                        </svg>
                        <span>Log out</span>
                      </a>
                    </li>
                  </ul>
                </template>
              </li>
            </ul>
          </div>
        </div>
        <!-- Header End -->

        <main class="h-full pb-16 overflow-y-auto">
          <div class="container grid px-6 py-8 mx-auto ">
            
            <div class="z-10 py-4 bg-white rounded-t-md">
                <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 ">
                    <a href="transaksi.php" class="flex items-center text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        <span>Kembali ke Riwayat Transaksi</span>
                    </a>
                </div>
            </div>

            <?php if ($detail_transaksi) : ?>
                <div class="w-full p-8 mx-auto bg-white shadow-xl rounded-b-md dark:bg-gray-800">
                    <div class="flex items-center justify-between pb-4 mb-6 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">INVOICE</h1>
                            <p class="text-sm text-gray-600 dark:text-gray-400">#<?= htmlspecialchars($detail_transaksi['id_transaksi']); ?></p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-100">Shoe Store</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Jl. Contoh No. 123, Kota Anda</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Email: info@shoestore.com</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
                        <div>
                            <h3 class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">Informasi Pelanggan:</h3>
                            <p class="text-gray-600 dark:text-gray-400"><strong>Nama:</strong> <?= htmlspecialchars($detail_transaksi['nama_pelanggan']); ?></p>
                            <p class="text-gray-600 dark:text-gray-400"><strong>Alamat:</strong> <?= htmlspecialchars($detail_transaksi['alamat_pelanggan']); ?></p>
                            <p class="text-gray-600 dark:text-gray-400"><strong>Telepon:</strong> <?= htmlspecialchars($detail_transaksi['telepon_pelanggan']); ?></p>
                        </div>
                        <div class="md:text-right">
                            <h3 class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">Informasi Transaksi:</h3>
                            <p class="text-gray-600 dark:text-gray-400"><strong>Tanggal:</strong> <?= htmlspecialchars(date('d F Y', strtotime($detail_transaksi['tanggal']))); ?></p>
                            <p class="text-gray-600 dark:text-gray-400"><strong>Pegawai:</strong> <?= htmlspecialchars($detail_transaksi['nama_pegawai']); ?></p>
                        </div>
                    </div>

                    <div class="mb-8 overflow-x-auto">
                        <table class="min-w-full overflow-hidden bg-white rounded-lg dark:bg-gray-800">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-600 uppercase dark:text-gray-300">Item</th>
                                    <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-600 uppercase dark:text-gray-300">Merek</th>
                                    <th class="px-4 py-2 text-xs font-medium tracking-wider text-left text-gray-600 uppercase dark:text-gray-300">Ukuran</th>
                                    <th class="px-4 py-2 text-xs font-medium tracking-wider text-right text-gray-600 uppercase dark:text-gray-300">Jumlah</th>
                                    <th class="px-4 py-2 text-xs font-medium tracking-wider text-right text-gray-600 uppercase dark:text-gray-300">Harga Satuan</th>
                                    <th class="px-4 py-2 text-xs font-medium tracking-wider text-right text-gray-600 uppercase dark:text-gray-300">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                <tr>
                                    <td class="px-4 py-3 text-gray-800 dark:text-gray-200"><?= htmlspecialchars($detail_transaksi['nama_sepatu']); ?></td>
                                    <td class="px-4 py-3 text-gray-800 dark:text-gray-200"><?= htmlspecialchars($detail_transaksi['merek']); ?></td>
                                    <td class="px-4 py-3 text-gray-800 dark:text-gray-200"><?= htmlspecialchars($detail_transaksi['ukuran']); ?></td>
                                    <td class="px-4 py-3 text-right text-gray-800 dark:text-gray-200"><?= htmlspecialchars($detail_transaksi['jumlah']); ?></td>
                                    <td class="px-4 py-3 text-right text-gray-800 dark:text-gray-200">Rp. <?= number_format($detail_transaksi['harga'], 0, ',', '.'); ?></td>
                                    <td class="px-4 py-3 text-right text-gray-800 dark:text-gray-200">Rp. <?= number_format($detail_transaksi['jumlah'] * $detail_transaksi['harga'], 0, ',', '.'); ?></td>
                                </tr>
                                </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end mt-6">
                        <div class="w-full md:w-1/2">
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                                <span class="text-lg font-semibold text-gray-800 dark:text-gray-100">TOTAL</span>
                                <span class="text-xl font-bold text-purple-600 dark:text-purple-400">Rp. <?= number_format($detail_transaksi['total'], 0, ',', '.'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-8 text-sm text-center text-gray-600 border-t border-gray-200 dark:border-gray-700 dark:text-gray-400">
                        Terima kasih atas pembelian Anda!
                    </div>

                </div>
            <?php elseif (isset($_GET['id']) && is_numeric($_GET['id'])) : ?>
                <div class="p-6 text-center bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <p class="text-lg text-red-600 dark:text-red-400">
                        Transaksi dengan ID #<?= htmlspecialchars($_GET['id']); ?> tidak ditemukan.
                    </p>
                    <a href="transaksi.php" class="inline-block px-4 py-2 mt-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Kembali
                    </a>
                </div>
            <?php else : ?>
                <div class="p-6 text-center bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <p class="text-lg text-red-600 dark:text-red-400">ID transaksi tidak valid atau tidak diberikan.</p>
                    <a href="transaksi.php" class="inline-block px-4 py-2 mt-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Kembali
                    </a>
                </div>
            <?php endif; ?>

          </div>
        </main>
      </div>
    </div>
  </body>
</html>
