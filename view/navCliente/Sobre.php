<?php include '../partials/header.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sobre Nós</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding-top: 40px;
        }
        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(2, 66, 0, 0.5);
            border-color: 198754 (0, 0, 0);
        }
        .sobre-container {
            background-color: #1e1e1e;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        p, li {
            font-size: 16px;
        }

        .accordion-button {
            background-color: #1e1e1e;
            color: rgb(29, 43, 29);
        }

        .accordion-button:not(.collapsed) {
            background-color:rgb(29, 43, 29);
            color: #ffffff;
        }

        .accordion-body {
            background-color: #1e1e1e;
        }
        .accordion-item{
            background-color: #1e1e1e;
        }
    </style>
</head>
<body>

<main class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 sobre-container">
            <section class="mb-5">
                <h2 class="text-success">Quem Somos</h2>
                <p>Somos uma empresa apaixonada por criar experiências de jogos inovadoras e envolventes. Desde nossa fundação, temos nos dedicado a oferecer entretenimento de alta qualidade para jogadores de todas as idades.</p>
            </section>

            <section class="mb-5">
                <h2 class="text-success">Missão</h2>
                <p class="text-light">Nossa missão é transformar ideias criativas em jogos que inspirem, desafiem e divirtam. Buscamos constantemente superar os limites da tecnologia e da narrativa para proporcionar experiências inesquecíveis.</p>
            </section>

            <section class="mb-5">
                <h2 class="text-success">Visão</h2>
                <p>Ser reconhecida como uma das principais empresas de jogos no mercado global, promovendo inovação e excelência em tudo o que fazemos.</p>
            </section>

            <section>
                <h2 class="text-success">Valores</h2>
                <div class="accordion" id="valoresAccordion">
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingInovacao">
                            <button class="accordion-button collapsed text-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInovacao" aria-expanded="false" aria-controls="collapseInovacao">
                                Inovação
                            </button>
                        </h2>
                        <div id="collapseInovacao" class="accordion-collapse collapse" aria-labelledby="headingInovacao" data-bs-parent="#valoresAccordion">
                            <div class="accordion-body text-white">
                                Buscamos constantemente novas ideias, tecnologias e abordagens para criar jogos únicos e envolventes.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingQualidade">
                            <button class="accordion-button collapsed text-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQualidade" aria-expanded="false" aria-controls="collapseQualidade">
                                Qualidade
                            </button>
                        </h2>
                        <div id="collapseQualidade" class="accordion-collapse collapse" aria-labelledby="headingQualidade" data-bs-parent="#valoresAccordion">
                            <div class="accordion-body text-white">
                                Priorizamos a excelência em cada etapa do desenvolvimento para garantir a melhor experiência ao jogador.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingPaixao">
                            <button class="accordion-button collapsed text-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePaixao" aria-expanded="false" aria-controls="collapsePaixao">
                                Paixão
                            </button>
                        </h2>
                        <div id="collapsePaixao" class="accordion-collapse collapse" aria-labelledby="headingPaixao" data-bs-parent="#valoresAccordion">
                            <div class="accordion-body text-white">
                                Criamos com coração. Nossa paixão por jogos guia todas as nossas decisões e inovações.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingCompromisso">
                            <button class="accordion-button collapsed text-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCompromisso" aria-expanded="false" aria-controls="collapseCompromisso">
                                Compromisso com os jogadores
                            </button>
                        </h2>
                        <div id="collapseCompromisso" class="accordion-collapse collapse" aria-labelledby="headingCompromisso" data-bs-parent="#valoresAccordion">
                            <div class="accordion-body text-white">
                                Trabalhamos pensando na comunidade, ouvindo feedbacks e buscando sempre entregar valor real aos jogadores.
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include '../partials/footer.php'; ?>

</body>
</html>
