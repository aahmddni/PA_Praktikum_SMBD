<?php
  include 'functions.php';
  $sepatuTerbaru = get_sepatu_terbaru(5);

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
        /* Infinite scroll */
        .brand {
          @apply flex items-center w-auto h-12 px-4 py-2 border shadow-md rounded-3xl;
        }
        .brand-image {
          @apply inline-block object-contain w-full h-full aspect-square;
        }

        /* Hero Section */
        .grid-pattern {
          @apply absolute inset-0 -z-10 h-full w-full bg-[linear-gradient(to_right,#80808018_1px,transparent_1px),linear-gradient(to_bottom,#80808018_1px,transparent_1px)] bg-[size:30px_30px] [mask-image:radial-gradient(ellipse_50%_50%_at_50%_0%,#000_80%,transparent_100%)];
        }

        /* Header */
        .menu {
          @apply absolute right-0 z-40 flex flex-col w-auto px-5 py-4 transition-all duration-300 bg-white border rounded-md shadow-xl lg:bg-transparent lg:border-none lg:p-0 lg:w-auto lg:shadow-none lg:flex-row lg:static lg:gap-x-5 gap-y-2 -top-96;
        }

        .menu-auth {
          @apply right-0 flex mt-5 transition-all duration-300 lg:w-48 lg:shadow-xl lg:rounded-md lg:p-4 lg:border gap-y-2.5 gap-x-5 lg:flex-col flex-row lg:absolute -top-96 bg-white;
        }

        /* Popular Product */
        .scroll {
          @apply w-full overflow-x-scroll;
        }

        .scroll::-webkit-scrollbar {
          @apply hidden;
          scroll-snap-type: x mandatory;
        }

        .popular-product {
          @apply lg:w-[18rem] xl:w-[23rem] sm:w-[17rem] md:w-[21rem] w-full h-auto p-5 border border-gray-200 rounded-3xl hover:scale-95 transition-all duration-200 ease-in-out hover:shadow-lg snap-center;
        }

        .popular-product img {
          @apply object-contain object-center w-[20rem] sm:w-[22rem] mx-auto h-full -rotate-[25deg] hover:scale-95 transition-all duration-200 hover:-rotate-[20deg];
        }

        .btn-popular-product {
          @apply px-3 py-1.5 rounded-lg text-base font-medium bg-blue-400 text-white;
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
            keyframes: {
              "scroll-left": {
                from: {
                  transform: "translateX(0)",
                },
                to: {
                  transform: "translate(calc(-50% - .5rem))",
                },
              },
              "scroll-right": {
                from: {
                  transform: "translateX(calc(-50% - .5rem))",
                },
                to: {
                  transform: "translateX(0)",
                },
              },
            },
            animation: {
              "scroll-left": "scroll-left 40s linear infinite",
              "scroll-right": "scroll-right 40s linear infinite",
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
          <a href="index.html" class="flex items-center"> ShoesStore </a>

          <ul class="menu" id="menu">
            <li>
              <a href="#">Home</a>
            </li>
            <li>
              <a href="index.html#popular">Popular</a>
            </li>
            <li>
              <a href="index.html#about">About Me</a>
            </li>
            <li>
              <a href="index.html#contact">Contact Me</a>
            </li>
            <li>
              <a href="products.php">Products</a>
            </li>

            <div class="menu-auth" id="menu-auth">
              <li class="group">
                <a href="login.php" class="flex items-center">
                  <div class="me-3">
                    <i class="text-2xl ri-login-circle-line"></i>
                  </div>
                  <span
                    class="transition-all duration-200 lg:group-hover:ps-1.5"
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

    <!-- Main Content Start -->
    <main>
      <section>
        <div class="grid-pattern"></div>
        <div class="container">
          <div
            class="flex flex-col items-center justify-center min-h-[calc(100vh-72px)] md:min-h-screen"
          >
            <h1
              class="text-3xl font-semibold text-center sm:text-4xl md:text-5xl lg:text-7xl"
            >
              <span
                class="block text-transparent bg-gradient-to-r from-blue-500 to-[#80D0C7] bg-clip-text"
                >Sustainable
                <div
                  class="inline-block border-b-2 border-pink-400 border-dashed"
                >
                  Fashion
                </div></span
              >
              Langkahmu, Pilihanmu!
            </h1>
            <p class="mt-5 text-center w-[80%]">
              Selamat datang di Shoe Store! Kami menyediakan koleksi sepatu
              berkualitas dan stylish dengan harga terjangkau. Temukan pilihan
              unik yang sempurna untuk gayamu.
            </p>

            <a
              href="products.html"
              class="px-3 py-2.5 mt-6 text-white bg-blue-400 rounded-lg"
              >Belanja Sekarang</a
            >
          </div>
        </div>
      </section>

      <!-- Brand Scroll Infinite Start -->
      <section>
        <div class="container" id="containerBrand">
          <div class="overflow-hidden" id="scroller">
            <div
              class="flex gap-4 py-4 flex-nowrap w-max animate-scroll-left"
              id="scrollerInner"
            >
              <div class="brand">
                <figure class="w-10 me-3">
                  <img
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Adidas_2022_logo.svg/150px-Adidas_2022_logo.svg.png"
                    alt="Adidas"
                    class="brand-image"
                  />
                </figure>
                <h3>Adidas</h3>
              </div>
              <div class="brand">
                <figure class="w-10 me-3">
                  <img
                    src="https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg"
                    alt="Adidas"
                    class="brand-image"
                  />
                </figure>
                <h3>NIKE</h3>
              </div>
              <div class="brand">
                <figure class="w-10 me-3">
                  <img
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/ea/New_Balance_logo.svg/300px-New_Balance_logo.svg.png"
                    alt="Adidas"
                    class="brand-image"
                  />
                </figure>
                <h3>New Balance</h3>
              </div>
              <div class="brand">
                <figure class="w-10 me-3">
                  <img
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/30/Converse_logo.svg/149px-Converse_logo.svg.png"
                    alt="Adidas"
                    class="brand-image"
                  />
                </figure>
                <h3>Converse</h3>
              </div>
              <div class="brand">
                <figure class="w-10 me-3">
                  <img
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/Vans_%28brand%29_logo.png/220px-Vans_%28brand%29_logo.png"
                    alt="Adidas"
                    class="brand-image"
                  />
                </figure>
                <h3>Vans</h3>
              </div>
              <div class="brand">
                <figure class="w-10 me-3">
                  <img
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Under_armour_logo.svg/150px-Under_armour_logo.svg.png"
                    alt="Adidas"
                    class="brand-image"
                  />
                </figure>
                <h3>Under Armour</h3>
              </div>
              <div class="brand">
                <figure class="w-10 me-3">
                  <img
                    src="https://upload.wikimedia.org/wikipedia/en/thumb/d/da/Puma_complete_logo.svg/220px-Puma_complete_logo.svg.png"
                    alt="Adidas"
                    class="brand-image"
                  />
                </figure>
                <h3>Puma</h3>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Brand Scroll Infinite End -->

      <!-- Popular product Start -->
      <section>
        <div class="container">
          <div
            class="flex flex-col justify-center min-h-screen pt-20"
            id="popular"
          >
            <h1 class="mb-4 text-2xl font-semibold">New Products</h1>

            <div class="scroll">
              <div class="flex gap-5 w-max">
                <?php foreach ($sepatuTerbaru as $s) : ?>
                <div class="popular-product">
                  <div class="relative mb-4 bg-gray-50 rounded-3xl">
                    <figure class="w-full mb-3 rounded-2xl h-60">
                      <img src="src/img/shoe/<?= $s['gambar']; ?>" alt="nike" />
                    </figure>
                    <button class="absolute top-3 right-4">
                      <i class="text-2xl ri-heart-3-line"></i>
                    </button>
                  </div>

                  <div class="md:w-full lg:w-auto">
                    <h5 class="mt-5 text-xs text-gray-400"><?= $s['merek']; ?></h5>
                    <h1 class="mt-2 text-sm font-semibold md:text-lg">
                      <?= $s['nama_sepatu']; ?>
                    </h1>

                    <div class="flex mt-1.5 items-center justify-between">
                      <h1 class="text-sm font-semibold md:text-lg">
                        <?= $s['harga']; ?>
                      </h1>
                      <button class="btn-add btn-popular-product">
                        Add to cart
                      </button>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>

            <a href="products.php" class="mt-4 text-center">
              <span class="my-auto"
                ><i class="text-2xl ri-corner-down-right-line"></i
              ></span>
              Lihat semua Produk
            </a>
          </div>
        </div>
      </section>
      <!-- Popular product End -->

      <!-- About Start -->
      <section class="container">
        <div class="min-h-screen py-20" id="about">
          <h1 class="text-3xl font-semibold text-center mb-7">Tentang Kami</h1>

          <div class="flex flex-col gap-10 md:flex-row">
            <div class="w-full md:w-1/2">
              <figure
                class="w-full h-[15rem] md:h-[26rem] rounded-3xl overflow-hidden"
              >
                <img
                  src="src/img/toko-septu.jpg"
                  alt="Image Toko - Frepik"
                  class="object-cover w-full h-full transition-all duration-300 hover:scale-110"
                />
              </figure>
            </div>
            <div class="w-full md:w-1/2">
              <h1 class="text-2xl font-semibold">Shoe Store</h1>
              <p class="my-3 text-justify">
                Shoe Store adalah toko sepatu yang menyediakan sepatu
                berkualitas dengan harga terjangkau. Kami menawarkan berbagai
                pilihan sepatu, mulai dari sneakers, running, hingga casual
                semua dalam kondisi terbaik.
              </p>
              <p class="my-3 text-justify">
                Kami berkomitmen untuk memberikan pengalaman berbelanja yang
                ramah lingkungan dan menyenangkan. Temukan sepatu impian Anda
                bersama kami dan nikmati gaya tanpa merogoh kocek dalam-dalam!
              </p>

              <div class="space-x-1">
                <a
                  href="https://x.com/"
                  target="_blank"
                  class="text-4xl text-gray-600 transition-all ease-linear hover:text-blue-500"
                >
                  <i class="ri-twitter-line"></i>
                </a>
                <a
                  href="https://instagram.com/"
                  target="_blank"
                  class="text-4xl text-gray-600 transition-all ease-linear hover:bg-[linear-gradient(45deg,#C13584,#E1306C,#F77737,#FDCB4D)] hover:text-transparent bg-clip-text"
                >
                  <i class="ri-instagram-line"></i>
                </a>
                <a
                  href="https://www.tiktok.com/"
                  target="_blank"
                  class="text-4xl text-gray-600 transition-all ease-linear hover:text-black"
                >
                  <i class="ri-tiktok-line"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- About End -->

      <!-- Contact Start -->
      <section class="container">
        <div class="min-h-screen py-20" id="contact">
          <h1 class="mb-5 text-3xl font-semibold text-center">Kontak Kami</h1>

          <div class="flex flex-col gap-5 md:gap-10 md:flex-row">
            <div class="w-full md:w-1/2">
              <iframe
                class="object-cover w-full h-[20rem] lg:h-full"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126646.25766572154!2d112.63028057980561!3d-7.275441715002019!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbf8381ac47f%3A0x3027a76e352be40!2sSurabaya%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1728048150543!5m2!1sid!2sid"
                width="600"
                height="450"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
            <div class="w-full md:w-1/2">
              <form>
                <div class="mb-4">
                  <label for="name" class="block mb-1.5">Nama</label>
                  <input
                    type="text"
                    placeholder="Nama Anda"
                    class="w-full px-3 py-2 border rounded-lg outline-none"
                  />
                </div>
                <div class="mb-4">
                  <label for="message" class="block mb-1.5">Pesan</label>
                  <textarea
                    placeholder="pesan"
                    class="w-full h-40 px-3 py-2 border rounded-lg outline-none resize-none"
                  ></textarea>
                </div>
                <div class="mb-4">
                  <button
                    class="w-full py-2 font-semibold text-white bg-blue-400 rounded-lg"
                  >
                    Kirim
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- About End -->
    </main>
    <!-- Main Content End -->

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
            <figure class="me-4 h-52">
              <img
                src="https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/064afac6-d5c0-4be2-aa48-1ecebae0cf7d/AIR+JORDAN+1+LOW.png"
                alt="nike"
                class="object-contain w-full h-full"
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
            Chekout <span> | Rp. 800.000</span>
          </button>
        </div>
      </div>
    </div>
    <!-- Modal Detail End -->

    <!-- Footer Start -->
    <footer class="container">
      <div class="flex flex-col justify-between pt-4 pb-7 md:flex-row">
        <div class="md:w-[60%]">
          <h1 class="mb-2 text-3xl font-bold">Shoe Store</h1>
          <p class="mb-1 text-base font-normal">shoestore@gmail.com</p>
          <p class="mb-1 text-base font-normal">08xx - xxxx - xxxx</p>
        </div>
        <div class="md:w-[40%]">
          <div class="flex flex-col justify-between w-full md:flex-row">
            <div class="">
              <h2 class="my-3 text-xl font-semibold md:mb-3 md:my-0">Links</h2>

              <ul class="space-y-1">
                <li>
                  <a href="index.html" class="text-base font-normal">Home</a>
                </li>
                <li>
                  <a href="index.html#popular" class="text-base font-normal"
                    >Popular</a
                  >
                </li>
                <li>
                  <a href="index.html#about" class="text-base font-normal"
                    >About</a
                  >
                </li>
                <li>
                  <a href="index.html#contact" class="text-base font-normal"
                    >Contact</a
                  >
                </li>
                <li>
                  <a href="products.html" class="text-base font-normal"
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
                  <a href="#" target="_blank" class="text-base font-normal"
                    >Instagram</a
                  >
                </li>
                <li>
                  <a href="#" target="_blank" class="text-base font-normal"
                    >Twitter</a
                  >
                </li>
                <li>
                  <a href="#" target="_blank" class="text-base font-normal"
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
