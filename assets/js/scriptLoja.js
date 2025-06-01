function toggleAccountMenu() {
    const dropdown = document.getElementById('accountDropdown');
    if (dropdown) {
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }
}

window.addEventListener('click', function (event) {
    const accountIcon = document.querySelector('.account-icon');
    const accountDropdown = document.getElementById('accountDropdown');
    if (accountIcon && !accountIcon.contains(event.target) && accountDropdown && !accountDropdown.contains(event.target)) {
        if (accountDropdown.style.display === 'block') {
            accountDropdown.style.display = 'none';
        }
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const gameModalElement = document.getElementById('gameModal');
    if (!gameModalElement) {
        console.error('Elemento do modal #gameModal não encontrado.');
        return;
    }

    const gameModalInstance = new bootstrap.Modal(gameModalElement);
    const gameCards = document.querySelectorAll('.game-card');

    gameCards.forEach(card => {
        card.style.cursor = 'pointer';
        card.addEventListener('click', function () {
            const gameName = this.dataset.gameName || 'Jogo';
            const gamePrice = this.dataset.gamePrice || 'R$ 0,00';
            const gameImage = this.dataset.gameImage || '';
            const gameId = this.dataset.gameId || '0';
            const gameCategory = this.dataset.gameCategory || 'N/A';
            const modalTitle = gameModalElement.querySelector('#modalTitle');
            const modalImageEl = gameModalElement.querySelector('#modalImage');
            const modalPriceEl = gameModalElement.querySelector('#modalPrice');
            const modalDetails = gameModalElement.querySelector('#modalDetails');
            const addToCartButton = gameModalElement.querySelector('#addToCartButton');

            if (modalTitle) modalTitle.textContent = gameName;
            if (modalImageEl) {
                modalImageEl.src = gameImage;
                modalImageEl.alt = gameName;
            }
            if (modalPriceEl) modalPriceEl.textContent = `Preço: ${gamePrice}`;
            if (modalDetails) {
                modalDetails.textContent = `Categoria: ${gameCategory}.`;
            }
            if (addToCartButton) {
                addToCartButton.setAttribute('data-game-id', gameId);
            }
            gameModalInstance.show();
        });
    });

    gameModalElement.addEventListener('hidden.bs.modal', function () {
        const modalTitle = gameModalElement.querySelector('#modalTitle');
        const modalImageEl = gameModalElement.querySelector('#modalImage');
        const modalPriceEl = gameModalElement.querySelector('#modalPrice');
        const modalDetails = gameModalElement.querySelector('#modalDetails');
        const addToCartButton = gameModalElement.querySelector('#addToCartButton');

        if (modalTitle) modalTitle.textContent = 'Título do Jogo';
        if (modalImageEl) {
            modalImageEl.src = '';
            modalImageEl.alt = 'Imagem do Jogo';
        }
        if (modalPriceEl) modalPriceEl.textContent = 'Preço: R$ 0,00';
        if (modalDetails) modalDetails.textContent = 'Detalhes do jogo serão exibidos aqui.';
        if (addToCartButton) addToCartButton.removeAttribute('data-game-id');
    });

    const accountIcon = document.querySelector('.account-icon');
    const accountDropdown = document.getElementById('accountDropdown');
    if (accountIcon && accountDropdown) {
        accountIcon.addEventListener('click', () => {
            toggleAccountMenu();
        });
        window.addEventListener('click', function (event) {
            if (accountDropdown.style.display === 'block' &&
                !accountIcon.contains(event.target) &&
                !accountDropdown.contains(event.target)) {
                accountDropdown.style.display = 'none';
            }
        });
    }
});

async function addToCart() {
    const button = document.getElementById('addToCartButton');
    const gameId = button ? button.getAttribute('data-game-id') : null;
    const gameModalElement = document.getElementById('gameModal');
    const modalTitleElement = gameModalElement ? gameModalElement.querySelector('#modalTitle') : null;
    const gameName = modalTitleElement ? modalTitleElement.textContent : 'Este jogo';

    if (gameId && gameId !== '0') {
        console.log(`Adicionando ao carrinho: Jogo ID ${gameId} (${gameName})`);

        try {
            const response = await fetch('/api/carrinho/adicionar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ game_id: gameId })
            });

            let result;
            try {
                result = await response.json();
            } catch (e) {
                result = {
                    success: false,
                    message: `Erro ${response.status}: ${response.statusText}. O servidor não retornou uma resposta JSON válida.`
                };
            }

            if (response.ok && result.success) {
                alert(result.message || `${gameName} adicionado ao carrinho!`);
                console.log('Resposta do servidor:', result);
            } else {
                alert(result.message || `Erro ao adicionar ${gameName} ao carrinho.`);
                console.error('Erro ao adicionar ao carrinho:', result);
            }
        } catch (error) {
            console.error('Erro na requisição fetch:', error);
            alert('Ocorreu um erro de comunicação ao tentar adicionar o jogo ao carrinho.');
        } finally {
            if (gameModalElement) {
                const modalInstance = bootstrap.Modal.getInstance(gameModalElement);
                if (modalInstance) {
                    modalInstance.hide();
                }
            }
        }
    } else {
        console.error("ID do jogo não encontrado ou inválido para adicionar ao carrinho.");
        alert("Erro ao adicionar ao carrinho: ID do jogo não encontrado ou inválido.");
    }
}
