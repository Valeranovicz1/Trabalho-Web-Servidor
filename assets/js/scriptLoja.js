
const carousels = document.querySelectorAll('.carousel-container');

carousels.forEach((carouselContainer) => {
    const carousel = carouselContainer.querySelector('.carousel');
    const prevBtn = carouselContainer.querySelector('.prev-btn');
    const nextBtn = carouselContainer.querySelector('.next-btn');

    let scrollPosition = 0;
    const itemWidth = carousel.querySelector('.carousel-item').offsetWidth + 10; // Largura do item + gap

    prevBtn.addEventListener('click', () => {
        scrollPosition = Math.max(scrollPosition - itemWidth, 0);
        carousel.style.transform = `translateX(-${scrollPosition}px)`;
    });

    nextBtn.addEventListener('click', () => {
        const maxScroll = carousel.scrollWidth - carousel.offsetWidth + 200; 
        if (scrollPosition + itemWidth >= maxScroll) {
            scrollPosition = 0;
        } else {
            scrollPosition += itemWidth;
        }
        carousel.style.transform = `translateX(-${scrollPosition}px)`;
    });
});
function openGameDetails(title, price, image, details = "Detalhes não disponíveis.") {
    const modal = document.getElementById('gameModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalPrice = document.getElementById('modalPrice');
    const modalDetails = document.getElementById('modalDetails');

    modalImage.src = image;
    modalTitle.textContent = title;
    modalPrice.textContent = `Preço: ${price}`;
    modalDetails.textContent = details;

    modal.style.display = 'flex';
}

function closeGameDetails() {
    const modal = document.getElementById('gameModal');
    modal.style.display = 'none';
}

window.addEventListener('click', (event) => {
    const modal = document.getElementById('gameModal');
    if (event.target === modal) {
        closeGameDetails();
    }
});

function toggleAccountMenu() {
    const dropdown = document.getElementById('accountDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

window.addEventListener('click', (event) => {
    const dropdown = document.getElementById('accountDropdown');
    const accountIcon = document.querySelector('.account-icon');
    if (event.target !== dropdown && event.target !== accountIcon) {
        dropdown.style.display = 'none';
    }
});
