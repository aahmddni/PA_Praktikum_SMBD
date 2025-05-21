<?php
include "functions.php";

$shoes = get_all_sepatu();
?>

<!DOCTYPE html>
<html class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <!-- Remix Icon CDn -->
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
      rel="stylesheet"
    />

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style type="text/tailwindcss">
      @layer components {
        .menu {
          @apply absolute right-0 z-40 flex flex-col w-auto px-5 py-4 transition-all duration-300 bg-white border rounded-md shadow-xl md:bg-transparent md:border-none md:p-0 md:w-auto md:shadow-none md:flex-row md:static md:gap-x-5 gap-y-2 -top-96;
        }

        .menu-auth {
          @apply right-0 flex mt-5 transition-all duration-300 md:w-48 md:shadow-xl md:rounded-md md:p-4 md:border gap-y-2.5 gap-x-5 md:flex-col flex-row md:absolute -top-96 bg-white;
        }

        .card {
          @apply md:w-[20rem] lg:w-[18rem] w-full sm:w-[17rem] xl:w-[16.5rem] h-auto p-5 border border-gray-200 rounded-3xl;
        }

        .card-btn {
          @apply px-3 w-full mt-4 py-1.5 rounded-lg text-base font-medium bg-blue-400 text-white;
        }

        /* Modal */
        .modal-container {
          @apply fixed inset-0 flex items-center justify-center bg-black/25 backdrop-blur z-[100];
        }

        .modal-content {
          @apply w-[20rem] md:w-[32rem] bg-white shadow-md p-4 rounded-lg transition-all duration-300;
        }
      }
    </style>

    <!-- Tailwind Config -->
    <script>
      tailwind.config = {
        theme: {
          container: {
            center: true,
            padding: {
              DEFAULT: "1rem",
              sm: "2rem",
              lg: "3rem",
              xl: "4rem",
            },
          },
          extend: {
            fontFamily: {
              poppins: ["Poppins", "sans-serif"],
            },
          },
        },
      };
    </script>
  </head>
  <body class="font-poppins">
    <!-- Header Start -->
    <header class="fixed top-0 z-50 w-full py-3 md:py-4">
      <div class="container">
        <nav class="relative flex items-center justify-between">
          <a href="index.php" class="flex items-center">
            ShoesTrift
          </a>

          <ul class="menu" id="menu">
            <li>
              <a href="index.php">Home</a>
            </li>
            <li>
              <a href="#">Products</a>
            </li>

            <div class="menu-auth" id="menu-auth">
              <li class="group">
                <a href="login.php" class="flex items-center">
                  <div class="me-3">
                    <i class="text-2xl ri-login-circle-line"></i>
                  </div>
                  <span
                    class="transition-all duration-200 md:group-hover:ps-1.5"
                    >Login</span
                  >
                </a>
              </li>
            </div>
          </ul>

          <div class="flex gap-x-3">
            <button id="wishlist">
              <i class="text-2xl ri-heart-line"></i>
            </button>
            <button id="cart">
              <i class="text-2xl ri-shopping-cart-2-line"></i>
            </button>
            <button class="transition-all duration-300" id="hamburger">
              <i
                class="text-2xl transition-transform duration-300 ri-menu-3-line"
              ></i>
            </button>
          </div>
        </nav>
      </div>
    </header>
    <!-- Header End -->

    <!-- Main Start -->
    <main class="py-20">
      <!-- Kategori -->
      <section class="container">
        <div class="mt-10">
          <div
            class="flex flex-col items-center justify-between mb-5 lg:flex-row"
          >
            <div
              class="order-1 w-full mt-2 space-y-2 md:space-y-0 lg:mt-0 lg:space-x-2"
            >
              <button
                class="px-4 py-2 text-sm text-white bg-black rounded-full md:text-base"
              >
                All Producs
              </button>
              <button
                class="px-4 py-2 text-sm border border-gray-300 rounded-full md:text-base"
              >
                Running
              </button>
              <button
                class="px-4 py-2 text-sm border border-gray-300 rounded-full md:text-base"
              >
                Sneakers
              </button>
              <button
                class="px-4 py-2 text-sm border border-gray-300 rounded-full md:text-base"
              >
                Casual
              </button>
            </div>

            <div class="flex items-center w-full gap-4 lg:order-1">
              <form class="w-full">
                <input
                  type="text"
                  name="Search"
                  id="search"
                  placeholder="Search shoe..."
                  class="w-full px-5 py-2.5 text-sm border border-gray-200 outline-none rounded-full"
                />
              </form>
              <button
                class="w-12 h-12 px-3 py-2 bg-gray-700 rounded-full"
                id="filter"
              >
                <i class="text-lg text-white ri-equalizer-line"></i>
              </button>
            </div>
          </div>
        </div>
      </section>

      <!-- Products -->
      <section class="container">
        <div class="flex flex-wrap gap-6 mt-8">
          <?php foreach ($shoes as $shoe) : ?>
            <div class="card">
              <div class="relative mb-4">
                <figure class="w-full h-40 mb-3 rounded-2xl">
                  <img
                    src="src/img/shoe/<?= $shoe["gambar"]; ?>"
                    alt="nike"
                    class="object-contain object-center w-full h-full"
                  />
                </figure>
                <button class="absolute top-0 right-0">
                  <i class="text-2xl ri-heart-3-line"></i>
                </button>
              </div>

              
              <div class="flex justify-between">
                <h5 class="text-xs text-gray-400"><?= $shoe["kategori"] ?></h5>
                <h5 class="text-xs text-gray-800"><?= $shoe["ukuran"] ?></h5>
              </div>
              <h1 class="mt-2 text-sm font-semibold"><?= $shoe["nama_sepatu"] ?></h1>
              <h1 class="my-2 text-sm font-semibold">Rp. <?= number_format($shoe["harga"], 0, ',', '.') ?></h1>
              <button class="card-btn btn-add">Add to cart</button>
            </div>
          <?php endforeach ; ?>
        </div>
      </section>
    </main>
    <!-- Main End -->

    <!-- Modal Cart Start -->
    <div id="modalCart" class="scale-0 modal-container">
      <div id="modalContent" class="scale-0 modal-content">
        <div class="flex items-center">
          <button id="cartClose" class="bg-gray-100 rounded">
            <i class="text-3xl font-medium ri-arrow-left-s-line"></i>
          </button>
          <h1 class="w-full text-xl font-semibold text-center">Cart</h1>
        </div>
        <div class="overflow-y-auto h-[55vh] my-2">
          <div
            class="flex justify-between w-full py-4 space-x-2 border-b border-dashed"
          >
            <figure class="w-20 h-auto">
              <img
                src="https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/064afac6-d5c0-4be2-aa48-1ecebae0cf7d/AIR+JORDAN+1+LOW.png"
                alt="nike"
                class="object-contain w-full h-full"
              />
            </figure>
            <div class="w-full">
              <h5 class="relative text-sm font-medium">
                Nike Dunk
                <button
                  class="absolute top-0 bg-gray-100 rounded-full h-7 w-7 right-3"
                >
                  <i class="text-lg ri-close-line"></i>
                </button>
              </h5>
              <p class="my-0.5 text-xs text-gray-400">Men's Shoe</p>
              <p class="my-0.5 text-sm">Size : 41</p>
              <div class="flex justify-between mr-3">
                <h3 class="mt-2 text-sm font-medium">Rp. 500.000</h3>
                <div
                  class="quantity-contaier flex px-2.5 py-1.5 rounded-full border h-min space-x-4"
                >
                  <button class="btn-minus">-</button>
                  <div class="count">1</div>
                  <button class="btn-plus">+</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-4">
          <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">Total</h1>
            <h2 class="text-xl font-normal">Rp. 100.000</h2>
          </div>
          <button
            class="w-full py-2 mt-2 text-xl font-medium text-white bg-green-400 rounded-md"
          >
            Chekout
          </button>
        </div>
      </div>
    </div>
    <!-- Modal Cart End -->

    <!-- Modal Wishlist Start -->
    <div id="modalWishlist" class="scale-0 modal-container">
      <div id="modalContentWishlist" class="scale-0 modal-content">
        <div class="flex items-center">
          <button id="wishlistClose" class="bg-gray-100 rounded">
            <i class="text-3xl font-medium ri-arrow-left-s-line"></i>
          </button>
          <h1 class="w-full text-xl font-semibold text-center">Wishlist</h1>
        </div>
        <div class="overflow-y-auto h-[55vh] my-2">
          <div
            class="flex justify-between w-full py-4 space-x-2 border-b border-dashed"
          >
            <figure class="w-20 h-auto">
              <img
                src="https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/064afac6-d5c0-4be2-aa48-1ecebae0cf7d/AIR+JORDAN+1+LOW.png"
                alt="nike"
                class="object-contain w-full h-full"
              />
            </figure>
            <div class="w-full">
              <h5 class="relative text-sm font-medium">
                Nike Dunk
                <button
                  class="absolute top-0 bg-gray-100 rounded-full h-7 w-7 right-3"
                >
                  <i class="text-lg ri-close-line"></i>
                </button>
              </h5>
              <h5 class="mb-1.5 text-xs text-gray-400">Men's Shoe</h5>
              <div class="flex items-center justify-between mr-3">
                <h3 class="mt-2 text-base font-medium">Rp. 500.000</h3>
                <a class="px-2.5 py-1.5 rounded-lg border">Add to cart</a>
              </div>
            </div>
          </div>
          <div
            class="flex justify-between w-full py-4 space-x-2 border-b border-dashed"
          >
            <figure class="w-20 h-auto">
              <img
                src="https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/064afac6-d5c0-4be2-aa48-1ecebae0cf7d/AIR+JORDAN+1+LOW.png"
                alt="nike"
                class="object-contain w-full h-full"
              />
            </figure>
            <div class="w-full">
              <h5 class="relative text-sm font-medium">
                Nike Dunk
                <button
                  class="absolute top-0 bg-gray-100 rounded-full h-7 w-7 right-3"
                >
                  <i class="text-lg ri-close-line"></i>
                </button>
              </h5>
              <h5 class="mb-1.5 text-xs text-gray-400">Men's Shoe</h5>
              <div class="flex items-center justify-between mr-3">
                <h3 class="mt-2 text-base font-medium">Rp. 500.000</h3>
                <a class="px-2.5 py-1.5 rounded-lg border">Add to cart</a>
              </div>
            </div>
          </div>
          <div
            class="flex justify-between w-full py-4 space-x-2 border-b border-dashed"
          >
            <figure class="w-20 h-auto">
              <img
                src="https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/064afac6-d5c0-4be2-aa48-1ecebae0cf7d/AIR+JORDAN+1+LOW.png"
                alt="nike"
                class="object-contain w-full h-full"
              />
            </figure>
            <div class="w-full">
              <h5 class="relative text-sm font-medium">
                Nike Dunk
                <button
                  class="absolute top-0 bg-gray-100 rounded-full h-7 w-7 right-3"
                >
                  <i class="text-lg ri-close-line"></i>
                </button>
              </h5>
              <h5 class="mb-1.5 text-xs text-gray-400">Men's Shoe</h5>
              <div class="flex items-center justify-between mr-3">
                <h3 class="mt-2 text-base font-medium">Rp. 500.000</h3>
                <a class="px-2.5 py-1.5 rounded-lg border">Add to cart</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Wishlist End -->

    <!-- Modal Detail Start -->
    <div id="modalDetailProduct" class="scale-0 modal-container">
      <div id="contentDetailProduct" class="scale-0 modal-content">
        <div class="flex items-center">
          <button id="detailClose" class="bg-gray-100 rounded">
            <i class="text-3xl font-medium ri-arrow-left-s-line"></i>
          </button>
          <h1 class="w-full text-xl font-semibold text-center">
            Detail Product
          </h1>
        </div>
        <div class="h-[55vh] m-2 overflow-y-auto">
          <div class="flex flex-col justify-between w-full pt-4 pb-3">
            <figure class="mx-auto h-52">
              <img
                src="assets/img/shoe/NIKE DUNK PANDA - no bg.png"
                alt="nike"
                class="object-contain h-full w-[20rem]"
              />
            </figure>
            <h3 class="mt-4 text-lg font-semibold">Nike Dunk</h3>

            <h4 class="mt-3 text-sm font-semibold">Deskripsi</h4>
            <p class="mt-1.5 text-justify text-sm mr-4">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio eum
              mollitia sint eligendi, repudiandae nobis porro totam ullam
              voluptas ut laboriosam tempore quisquam assumenda atque sit.
              Beatae eveniet nisi repellendus.
            </p>
            <div class="flex mt-4 space-x-3">
              <button
                class="py-1.5 focus:border-2 focus:border-black focus:font-semibold px-2.5 border"
              >
                37
              </button>
              <button
                class="py-1.5 focus:border-2 focus:border-black focus:font-semibold px-2.5 border"
              >
                38
              </button>
              <button
                class="py-1.5 focus:border-2 focus:border-black focus:font-semibold px-2.5 border"
              >
                39
              </button>
              <button
                class="py-1.5 focus:border-2 focus:border-black focus:font-semibold px-2.5 border"
              >
                40
              </button>
              <button
                class="py-1.5 focus:border-2 focus:border-black focus:font-semibold px-2.5 border"
              >
                41
              </button>
              <button
                class="py-1.5 focus:border-2 focus:border-black focus:font-semibold px-2.5 border"
              >
                42
              </button>
            </div>
            <div class="inline-flex items-center mt-5 gap-x-3">
              <span class="font-semibold">Quatity : </span>
              <div
                class="quantity-contaier flex w-20 px-2.5 py-1.5 rounded-full border h-min space-x-4"
              >
                <button class="btn-minus">-</button>
                <div class="count">1</div>
                <button class="btn-plus">+</button>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-4">
          <button
            class="w-full py-2 mt-2 text-xl font-medium text-white bg-green-400 rounded-md"
          >
            Add to cart <span> | Rp. 800.000</span>
          </button>
        </div>
      </div>
    </div>
    <!-- Modal Detail End -->

    <!-- Footer Start -->
    <footer class="container">
      <div class="flex flex-col justify-between pt-4 pb-7 md:flex-row">
        <div class="md:w-[60%]">
          <h1 class="mb-2 text-3xl font-bold">Shoe Trift</h1>
          <p class="mb-1 text-base font-normal">shoestrift@gmail.com</p>
          <p class="mb-1 text-base font-normal">08xx - xxxx - xxxx</p>
        </div>
        <div class="md:w-[40%]">
          <div class="flex flex-col justify-between w-full md:flex-row">
            <div class="">
              <h2 class="my-3 text-xl font-semibold md:mb-3 md:my-0">Home</h2>

              <ul class="space-y-1">
                <li>
                  <a href="index.php" class="text-base font-normal">Home</a>
                </li>
                <li>
                  <a href="products.php" class="text-base font-normal"
                    >Products</a
                  >
                </li>
              </ul>
            </div>
            <div class="">
              <h2 class="my-3 text-xl font-semibold md:mb-3 md:my-0">
                Sosial Media
              </h2>

              <ul class="space-y-1">
                <li>
                  <a
                    href="https://instagram.com/"
                    target="_blank"
                    class="text-base font-normal"
                    >Instagram</a
                  >
                </li>
                <li>
                  <a
                    href="https://x.com"
                    target="_blank"
                    class="text-base font-normal"
                    >Twitter</a
                  >
                </li>
                <li>
                  <a
                    href="https://www.tiktok.com"
                    target="_blank"
                    class="text-base font-normal"
                    >Tiktok</a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer End -->

    <!-- My JS -->
    <script src="src/js/app.js"></script>
  </body>
</html>