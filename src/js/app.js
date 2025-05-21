// Navbar sticky
window.onscroll = function () {
  const header = document.querySelector("header");
  const fixedNav = header.offsetTop;

  if (window.pageYOffset > fixedNav) {
    header.classList.add("bg-white/20", "backdrop-blur-md", "border-b");
  } else {
    header.classList.remove("bg-white/20", "backdrop-blur-md", "border-b");
  }
};

// Hamburger button
const hamburger = document.getElementById("hamburger");
const menu = document.getElementById("menu");
const menuAuth = document.getElementById("menu-auth");
const icon = hamburger.querySelector("i");
const links = menu.querySelectorAll("a");

// Action click hamburger
hamburger.addEventListener("click", () => {
  menu.classList.toggle("top-14");
  menuAuth.classList.toggle("top-12");

  if (icon.classList.contains("ri-menu-3-line")) {
    icon.classList.remove("ri-menu-3-line");
    icon.classList.add("ri-close-fill");
  } else {
    icon.classList.remove("ri-close-fill");
    icon.classList.add("ri-menu-3-line");
  }
});

const closeHumberger = () => {
  menu.classList.remove("top-14");
  menuAuth.classList.remove("top-12");

  icon.classList.remove("ri-close-fill");
  icon.classList.add("ri-menu-3-line");
};

// Action click outside humberger
document.addEventListener("click", (event) => {
  if (
    !hamburger.contains(event.target) &&
    !menu.contains(event.target) &&
    !menuAuth.contains(event.target)
  ) {
    if (
      menu.classList.contains("top-14") ||
      menuAuth.classList.contains("top-12")
    ) {
      closeHumberger();
    }
  }
});

// Action click link mnu
links.forEach((link) => {
  link.addEventListener("click", () => {
    closeHumberger();
  });
});

// Function Modal
function modal(btnModal, container, content, btnClose) {
  btnModal.addEventListener("click", () => {
    document.body.classList.toggle("overflow-hidden");
    container.classList.toggle("scale-0");
    content.classList.toggle("scale-0");
  });

  btnClose.addEventListener("click", () => {
    document.body.classList.remove("overflow-hidden");
    container.classList.add("scale-0");
    content.classList.add("scale-0");
  });

  window.addEventListener("click", (event) => {
    if (event.target === container) {
      document.body.classList.remove("overflow-hidden");
      container.classList.add("scale-0");
      content.classList.add("scale-0");
    }
  });
}

// Modal Cart
const cart = document.getElementById("cart");
const modalCart = document.getElementById("modalCart");
const modalContent = document.getElementById("modalContent");
const cartClose = document.getElementById("cartClose");

modal(cart, modalCart, modalContent, cartClose);

// Modal wishlist
const btnWishlist = document.getElementById("wishlist");
const modalWishlist = document.getElementById("modalWishlist");
const wishlistContent = document.getElementById("modalContentWishlist");
const btnWishlistClose = document.getElementById("wishlistClose");

modal(btnWishlist, modalWishlist, wishlistContent, btnWishlistClose);

// Modal detail product
const btnDetailProducts = document.querySelectorAll(".btn-add");
const modalDetailProduct = document.getElementById("modalDetailProduct");
const contentDetailProduct = document.getElementById("contentDetailProduct");
const detailClose = document.getElementById("detailClose");

btnDetailProducts.forEach((btnDetail) => {
  btnDetail.addEventListener("click", () => {
    modal(btnDetail, modalDetailProduct, contentDetailProduct, detailClose);
  });
});

// Button quantity
const quantityContainer = document.querySelectorAll(".quantity-contaier");

quantityContainer.forEach((container) => {
  const btnMinus = container.querySelector(".btn-minus");
  const btnPlus = container.querySelector(".btn-plus");
  const count = container.querySelector(".count");

  btnMinus.addEventListener("click", () => {
    let quantity = parseInt(count.textContent);
    if (quantity > 1) {
      quantity--;
      count.textContent = quantity;
    }

    if (quantity <= 1) {
      btnMinus.classList.add("cursor-not-allowed");
    } else {
      btnMinus.classList.remove("cursor-not-allowed");
    }
  });

  btnPlus.addEventListener("click", () => {
    let quantity = parseInt(count.textContent);
    quantity++;
    count.textContent = quantity;

    if (quantity > 1) {
      btnMinus.classList.remove("cursor-not-allowed");
    }
  });
});

// infinite scroll icon
const containerBrand = document.getElementById("containerBrand");

const scroller = document.getElementById("scroller");
const scrollerInner = scroller.querySelector("#scrollerInner");
const scrollerContent = Array.from(scrollerInner.children);
scrollerContent.forEach((item) => {
  const duplicateItem = item.cloneNode(true);

  duplicateItem.setAttribute("aria-hidden", true);
  scrollerInner.appendChild(duplicateItem);
});

// Duplicate infinite scroll brand
const duplicateScroller = scroller.cloneNode(true);
const duplicateScrollerInner =
  duplicateScroller.querySelector("#scrollerInner");
duplicateScrollerInner.classList.remove("animate-scroll-left");
duplicateScrollerInner.classList.add("animate-scroll-right");
containerBrand.appendChild(duplicateScroller);
